-- TRANSACTIONS

-- enviar um pedido de amizade
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO user_friend_request (id_user, id_requester)
VALUES ($id_user, $id_requester);

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_user, $id_requester, $text, NOW(), FALSE);

INSERT INTO friend_request_notification (id_notification, accepted)
VALUES (currval(pg_get_serial_sequence('notification', 'id_notification')), NULL);

COMMIT;


-- aceitar um pedido de amizade

BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO user_friend (id_user, id_friend)
VALUES ($id_accepter, $id_requester), ($id_requester, $id_accepter);

DELETE FROM user_friend_request
WHERE id_user = $id_accepter AND id_requester = $id_requester;

UPDATE friend_request_notification
SET accepted = TRUE
WHERE id_notification = $original_notification_id;

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_requester, $id_accepter, $text, NOW(), FALSE);

INSERT INTO friend_request_result_notification (id_notification)
VALUES (currval(pg_get_serial_sequence('notification', 'id_notification')));

COMMIT;


-- remover amizade
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

DELETE FROM user_friend
WHERE (id_user = $id_user AND id_friend = $id_friend) OR (id_user = $id_friend AND id_friend = $id_user);

COMMIT;


-- criar um post

BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO post (id_creator, image, description, date)
VALUES ($id_creator, $image, $description, NOW());

INSERT INTO post_label (id_post, id_label)
VALUES (currval(pg_get_serial_sequence('post', 'id_post')), $id_label);

COMMIT;


-- Like Post
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO post_like (id_post, id_user)
VALUES ($id_post, $id_user);

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_receiver, $id_user, $text, NOW(), FALSE);

INSERT INTO like_post_notification (id_notification, id_post)
VALUES (currval(pg_get_serial_sequence('notification', 'id_notification')), $id_post);

COMMIT;


-- Comment on Post

BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO comments (id_post, id_user, id_reply, text, date)
VALUES ($id_post, $id_user, $id_reply, $text, NOW());

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_receiver, $id_user, $text, NOW(), FALSE);

INSERT INTO comment_notification (id_notification, id_comment)
VALUES (currval(pg_get_serial_sequence('notification', 'id_notification')), currval(pg_get_serial_sequence('comments', 'id_comment')));

COMMIT;


-- Share Post (via mensagem privada)
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO message (text, image, date)
VALUES ($text, $image, NOW());

INSERT INTO private_message (id_message, id_sender, id_receiver)
VALUES (currval(pg_get_serial_sequence('message', 'id_message')), $id_sender, $id_receiver);

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_receiver, $id_sender, $text, NOW(), FALSE);

INSERT INTO private_message_notification (id_notification, id_message)
VALUES (currval(pg_get_serial_sequence('notification', 'id_notification')), currval(pg_get_serial_sequence('message', 'id_message')));

COMMIT;


-- Send Message to Friend
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO message (text, image, date)
VALUES ($text, NULL, NOW());

INSERT INTO private_message (id_message, id_sender, id_receiver)
VALUES (currval(pg_get_serial_sequence('message', 'id_message')), $id_sender, $id_receiver);

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_receiver, $id_sender, $text, NOW(), FALSE);

INSERT INTO private_message_notification (id_notification, id_message)
VALUES (currval(pg_get_serial_sequence('notification', 'id_notification')), currval(pg_get_serial_sequence('message', 'id_message')));

COMMIT;


-- Post on Group

CREATE OR REPLACE FUNCTION post_group_message(
    sender_id INTEGER,
    group_id INTEGER,
    message_text TEXT,
    message_image TEXT
)
RETURNS VOID AS $$
DECLARE
    new_message_id INTEGER;
    notification_id INTEGER;
    receiver_id INTEGER;
BEGIN

    INSERT INTO message (text, image, date)
    VALUES (message_text, message_image, NOW())
    RETURNING id_message INTO new_message_id;

    INSERT INTO group_message (id_message, id_sender, id_group)
    VALUES (new_message_id, sender_id, group_id);

    FOR receiver_id IN
        SELECT id_member
        FROM group_membership
        WHERE id_group = group_id AND id_member <> sender_id
    LOOP
        INSERT INTO notification (id_receiver, id_emitter, text, date, read)
        VALUES (receiver_id, sender_id, message_text, NOW(), FALSE)
        RETURNING id_notification INTO notification_id;

        INSERT INTO group_message_notification (id_notification, id_message)
        VALUES (notification_id, new_message_id);
    END LOOP;

END;
$$ LANGUAGE plpgsql;


-- Create Group
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO group_owner (id_group_owner)
VALUES ($id_group_owner)
ON CONFLICT (id_group_owner) DO NOTHING;

INSERT INTO groups (id_owner, name, description, picture, is_public)
VALUES ($id_group_owner, $name, $description, $picture, TRUE);

INSERT INTO group_membership (id_group, id_member)
VALUES (currval(pg_get_serial_sequence('groups', 'id_group')), $id_group_owner);

COMMIT;


-- enviar um pedido de adesão ao grupo
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO group_join_request (id_group, id_requester)
VALUES ($id_group, $id_requester);

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_receiver, $id_emitter, $text, NOW(), FALSE);

INSERT INTO join_group_request_notification (id_notification, id_group, accepted)
VALUES (currval(pg_get_serial_sequence('notification', 'id_notification')), $id_group, NULL);

COMMIT;


-- aceitar pedido de adesão ao grupo
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

DELETE FROM group_join_request
WHERE id_group = $id_group AND id_requester = $id_requester;

INSERT INTO group_membership (id_group, id_member)
VALUES ($id_group, $id_requester);

UPDATE join_group_request_notification
SET accepted = TRUE
WHERE id_notification = $original_notification_id;

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_requester, $id_group_owner, $text, NOW(), FALSE);

INSERT INTO join_group_request_result_notification (id_notification, id_group)
VALUES (currval(pg_get_serial_sequence('notification', 'id_notification')), $id_group);

COMMIT;


-- Report Post

-- same logic is applied to Report a comment, Report a profile and to Report a group
BEGIN TRANSACTION ISOLATION LEVEL READ COMMITTED;

INSERT INTO report (description)
VALUES ($description);

INSERT INTO report_post (id_report, id_post)
VALUES (currval(pg_get_serial_sequence('report', 'id_report')), $id_post);

COMMIT;


-- Delete Account

-- the majority will be done via ON DELETE CASCADE
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

DELETE FROM registered_user
WHERE id_user = $id_user;

COMMIT;


-- Banir um utilizador



-- Block
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

INSERT INTO user_block (id_user, id_blocked)
VALUES ($id_user, $id_blocked);

DELETE FROM user_friend
WHERE (id_user = $id_user AND id_friend = $id_blocked)
OR (id_user = $id_blocked AND id_friend = $id_user);

COMMIT;


-- Unblock
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

DELETE FROM user_block
WHERE id_user = $id_user AND id_blocked = $id_blocked;

COMMIT;


-- Moderate: remove reported post
BEGIN TRANSACTION ISOLATION LEVEL SERIALIZABLE;

DELETE FROM post
WHERE id_post = $id_post;

INSERT INTO notification (id_receiver, id_emitter, text, date, read)
VALUES ($id_receiver, NULL, $text, NOW(), FALSE);

COMMIT;
