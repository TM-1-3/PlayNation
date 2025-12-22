CREATE SCHEMA IF NOT EXISTS lbaw2551;

-- drop tables 

DROP TABLE IF EXISTS join_group_request_result_notification CASCADE;
DROP TABLE IF EXISTS join_group_request_notification CASCADE;
DROP TABLE IF EXISTS group_message_notification CASCADE;
DROP TABLE IF EXISTS private_message_notification CASCADE;
DROP TABLE IF EXISTS like_comment_notification CASCADE;
DROP TABLE IF EXISTS comment_notification CASCADE;
DROP TABLE IF EXISTS like_post_notification CASCADE;
DROP TABLE IF EXISTS friend_request_result_notification CASCADE;
DROP TABLE IF EXISTS friend_request_notification CASCADE;
DROP TABLE IF EXISTS group_message CASCADE;
DROP TABLE IF EXISTS private_message CASCADE;
DROP TABLE IF EXISTS report_post CASCADE;
DROP TABLE IF EXISTS report_group CASCADE;
DROP TABLE IF EXISTS report_user CASCADE;
DROP TABLE IF EXISTS report_comment CASCADE;
DROP TABLE IF EXISTS report CASCADE;
DROP TABLE IF EXISTS comment_like CASCADE;
DROP TABLE IF EXISTS comments CASCADE;
DROP TABLE IF EXISTS post_save CASCADE;
DROP TABLE IF EXISTS post_like CASCADE;
DROP TABLE IF EXISTS post_label CASCADE;
DROP TABLE IF EXISTS post CASCADE;
DROP TABLE IF EXISTS user_label CASCADE;
DROP TABLE IF EXISTS category CASCADE;
DROP TABLE IF EXISTS sport CASCADE;
DROP TABLE IF EXISTS label CASCADE;
DROP TABLE IF EXISTS group_membership CASCADE;
DROP TABLE IF EXISTS group_join_request CASCADE;
DROP TABLE IF EXISTS groups CASCADE;
DROP TABLE IF EXISTS user_friend_request CASCADE;
DROP TABLE IF EXISTS user_friend CASCADE;
DROP TABLE IF EXISTS notification CASCADE;
DROP TABLE IF EXISTS group_owner CASCADE;
DROP TABLE IF EXISTS verified_user CASCADE;
DROP TABLE IF EXISTS administrator CASCADE;
DROP TABLE IF EXISTS registered_user CASCADE;
DROP TABLE IF EXISTS user_block CASCADE;
DROP TABLE IF EXISTS user_ban CASCADE;
DROP TABLE IF EXISTS user_tag CASCADE;
DROP TABLE IF EXISTS comment_tag CASCADE;
DROP TABLE IF EXISTS message CASCADE;
DROP TABLE IF EXISTS admin_block CASCADE;
DROP TABLE IF EXISTS admin_ban CASCADE;
DROP TABLE IF EXISTS password_reset_tokens CASCADE;


-- create tables

CREATE TABLE registered_user(
    id_user SERIAL PRIMARY KEY,
    username TEXT UNIQUE NOT NULL,
    name TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    biography TEXT,
    profile_picture TEXT,
    is_public BOOLEAN DEFAULT TRUE
);

CREATE TABLE administrator(
    id_admin INTEGER PRIMARY KEY REFERENCES registered_user (id_user) ON DELETE CASCADE
);

CREATE TABLE verified_user(
    id_verified INTEGER PRIMARY KEY REFERENCES registered_user (id_user) ON DELETE CASCADE
);

CREATE TABLE group_owner(
    id_group_owner INTEGER PRIMARY KEY REFERENCES registered_user (id_user) ON DELETE CASCADE
);

CREATE TABLE user_friend(
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    id_friend INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_user, id_friend)
);

CREATE TABLE user_friend_request(
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    id_requester INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_user, id_requester)
);

CREATE TABLE label(
    id_label SERIAL PRIMARY KEY,
    designation TEXT NOT NULL,
    image TEXT NOT NULL
);

CREATE TABLE sport(
    id_sport INTEGER PRIMARY KEY REFERENCES label (id_label) ON DELETE CASCADE
);

CREATE TABLE category(
    id_category INTEGER PRIMARY KEY REFERENCES label (id_label) ON DELETE CASCADE
);

CREATE TABLE user_label(
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    id_label INTEGER NOT NULL REFERENCES label (id_label) ON DELETE CASCADE,
    PRIMARY KEY (id_user, id_label)
);

CREATE TABLE post(
    id_post SERIAL PRIMARY KEY,
    id_creator INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE SET NULL,
    image TEXT NOT NULL,
    description TEXT NOT NULL,
    date TIMESTAMP NOT NULL CHECK (date<=now())
);

CREATE TABLE post_label(
    id_post INTEGER NOT NULL REFERENCES post (id_post) ON DELETE CASCADE,
    id_label INTEGER NOT NULL REFERENCES label (id_label) ON DELETE CASCADE,
    PRIMARY KEY (id_post, id_label)
);

CREATE TABLE post_like(
    id_post INTEGER NOT NULL REFERENCES post (id_post) ON DELETE CASCADE,
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_post, id_user)
);

CREATE TABLE post_save(
    id_post INTEGER NOT NULL REFERENCES post (id_post) ON DELETE CASCADE,
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_post, id_user)
);

CREATE TABLE comments(
    id_comment SERIAL PRIMARY KEY,
    id_post INTEGER NOT NULL REFERENCES post (id_post) ON DELETE CASCADE,
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE SET NULL,
    id_reply INTEGER REFERENCES comments (id_comment) ON DELETE CASCADE,
    text TEXT NOT NULL,
    date TIMESTAMP NOT NULL CHECK (date<=now())
);

CREATE TABLE comment_like(
    id_comment INTEGER NOT NULL REFERENCES comments (id_comment) ON DELETE CASCADE,
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_comment, id_user)
);

CREATE TABLE groups(
    id_group SERIAL PRIMARY KEY,
    id_owner INTEGER NOT NULL REFERENCES group_owner (id_group_owner) ON DELETE SET NULL,
    name TEXT UNIQUE NOT NULL,
    description TEXT,
    picture TEXT,
    is_public BOOLEAN DEFAULT TRUE
);

CREATE TABLE group_membership(
    id_group INTEGER NOT NULL REFERENCES groups (id_group) ON DELETE CASCADE,
    id_member INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_group, id_member)
);

CREATE TABLE group_join_request(
    id_group INTEGER NOT NULL REFERENCES groups (id_group) ON DELETE CASCADE,
    id_requester INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_group, id_requester)
);

CREATE TABLE message(
    id_message SERIAL PRIMARY KEY,
    text TEXT NOT NULL,
    image TEXT,
    date TIMESTAMP NOT NULL CHECK (date<=now())
);

CREATE TABLE private_message(
    id_message INTEGER PRIMARY KEY REFERENCES message (id_message) ON DELETE CASCADE,
    id_sender INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    id_receiver INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE
);

CREATE TABLE group_message(
    id_message INTEGER PRIMARY KEY REFERENCES message (id_message) ON DELETE CASCADE,
    id_group INTEGER NOT NULL REFERENCES groups (id_group) ON DELETE CASCADE,
    id_sender INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE
);

CREATE TABLE report(
    id_report SERIAL PRIMARY KEY,
    description TEXT NOT NULL
);

--
CREATE TABLE report_comment(
    id_report INTEGER NOT NULL REFERENCES report (id_report) ON DELETE CASCADE,
    id_comment INTEGER NOT NULL REFERENCES comments (id_comment) ON DELETE CASCADE,
    PRIMARY KEY (id_report, id_comment)
);

CREATE TABLE report_user(
    id_report INTEGER NOT NULL REFERENCES report (id_report) ON DELETE CASCADE,
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_report, id_user)
);

CREATE TABLE report_group(
    id_report INTEGER NOT NULL REFERENCES report (id_report) ON DELETE CASCADE,
    id_group INTEGER NOT NULL REFERENCES groups (id_group) ON DELETE CASCADE,
    PRIMARY KEY (id_report, id_group)
);

CREATE TABLE report_post(
    id_report INTEGER NOT NULL REFERENCES report (id_report) ON DELETE CASCADE,
    id_post INTEGER NOT NULL REFERENCES post (id_post) ON DELETE CASCADE,
    PRIMARY KEY (id_report, id_post)
);

CREATE TABLE notification(
    id_notification SERIAL PRIMARY KEY,
    id_receiver INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    id_emitter INTEGER REFERENCES registered_user (id_user) ON DELETE SET NULL,
    text TEXT NOT NULL,
    date TIMESTAMP NOT NULL CHECK (date<=now())
);

CREATE TABLE friend_request_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE,
    accepted BOOLEAN
);

CREATE TABLE friend_request_result_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE
);

CREATE TABLE like_post_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE,
    id_post INTEGER NOT NULL REFERENCES post (id_post) ON DELETE CASCADE
);

CREATE TABLE comment_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE,
    id_comment INTEGER NOT NULL REFERENCES comments (id_comment) ON DELETE CASCADE
);

CREATE TABLE like_comment_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE,
    id_comment INTEGER NOT NULL REFERENCES comments (id_comment) ON DELETE CASCADE
);

CREATE TABLE private_message_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE,
    id_message INTEGER NOT NULL REFERENCES message (id_message) ON DELETE CASCADE
);

CREATE TABLE group_message_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE,
    id_message INTEGER NOT NULL REFERENCES group_message (id_message) ON DELETE CASCADE
);

CREATE TABLE join_group_request_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE,
    id_group INTEGER NOT NULL REFERENCES groups (id_group) ON DELETE CASCADE,
    accepted BOOLEAN
);


CREATE TABLE join_group_request_result_notification(
    id_notification INTEGER PRIMARY KEY REFERENCES notification (id_notification) ON DELETE CASCADE,
    id_group INTEGER NOT NULL REFERENCES groups (id_group) ON DELETE CASCADE
);

CREATE TABLE user_block(
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    id_blocked INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_user, id_blocked)
);

CREATE TABLE user_ban(
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    id_banned INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_user, id_banned)
);

CREATE TABLE user_tag(
    id_post INTEGER NOT NULL REFERENCES post (id_post) ON DELETE CASCADE,
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_post, id_user)
);

CREATE TABLE comment_tag(
    id_comment INTEGER NOT NULL REFERENCES comments (id_comment) ON DELETE CASCADE,
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_comment, id_user)
);

CREATE TABLE admin_block(
    id_admin INTEGER NOT NULL REFERENCES administrator (id_admin) ON DELETE CASCADE,
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_admin, id_user)
);

CREATE TABLE admin_ban(
    id_admin INTEGER NOT NULL REFERENCES administrator (id_admin) ON DELETE CASCADE,
    id_user INTEGER NOT NULL REFERENCES registered_user (id_user) ON DELETE CASCADE,
    PRIMARY KEY (id_admin, id_user)
);

CREATE TABLE password_reset_tokens (
    email VARCHAR(255) NOT NULL,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP(0) WITHOUT TIME ZONE NULL,
    PRIMARY KEY (email)
);

-- Indexes

DROP FUNCTION IF EXISTS post_search_update() CASCADE;
DROP FUNCTION IF EXISTS user_search_update() CASCADE;
DROP FUNCTION IF EXISTS group_search_update() CASCADE;

CREATE INDEX idx_post_creator ON post USING btree (id_creator);

CREATE INDEX idx_comment_post ON comments USING btree(id_post);
CLUSTER comments USING idx_comment_post;

CREATE INDEX idx_notification_receiver_date ON notification USING btree(id_receiver);
CLUSTER notification USING idx_notification_receiver_date;

-- FTS Indexes

ALTER TABLE post
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION post_search_update() RETURNS TRIGGER AS $$
BEGIN
    IF TG_OP = 'INSERT' THEN
        NEW.tsvectors := to_tsvector('portuguese', NEW.description);
    ELSIF TG_OP = 'UPDATE' THEN
        IF NEW.description <> OLD.description THEN
            NEW.tsvectors := to_tsvector('portuguese', NEW.description);
        END IF;
    END IF;
    RETURN NEW;
END $$ LANGUAGE plpgsql;

CREATE TRIGGER post_search_update
BEFORE INSERT OR UPDATE ON post
FOR EACH ROW
EXECUTE PROCEDURE post_search_update();

CREATE INDEX search_post ON post USING GIN (tsvectors);

ALTER TABLE registered_user
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION user_search_update() RETURNS TRIGGER AS $$
BEGIN
    IF TG_OP = 'INSERT' THEN
        NEW.tsvectors := 
            setweight(to_tsvector('portuguese', NEW.name), 'A') ||
            setweight(to_tsvector('portuguese', NEW.username), 'B');
    ELSIF TG_OP = 'UPDATE' THEN
        IF NEW.name <> OLD.name OR NEW.username <> OLD.username THEN
            NEW.tsvectors := 
                setweight(to_tsvector('portuguese', NEW.name), 'A') ||
                setweight(to_tsvector('portuguese', NEW.username), 'B');
        END IF;
    END IF;
    RETURN NEW;
END $$ LANGUAGE plpgsql;

CREATE TRIGGER user_search_update
BEFORE INSERT OR UPDATE ON registered_user
FOR EACH ROW
EXECUTE PROCEDURE user_search_update();

CREATE INDEX search_user ON registered_user USING GIN (tsvectors);

ALTER TABLE groups
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION group_search_update() RETURNS TRIGGER AS $$
BEGIN
    IF TG_OP = 'INSERT' THEN
        NEW.tsvectors := 
            setweight(to_tsvector('portuguese', NEW.name), 'A') ||
            setweight(to_tsvector('portuguese', NEW.description), 'B');
    ELSIF TG_OP = 'UPDATE' THEN
        IF NEW.name <> OLD.name OR NEW.description <> OLD.description THEN
            NEW.tsvectors := 
                setweight(to_tsvector('portuguese', NEW.name), 'A') ||
                setweight(to_tsvector('portuguese', NEW.description), 'B');
        END IF;
    END IF;
    RETURN NEW;
END $$ LANGUAGE plpgsql;

CREATE TRIGGER group_search_update
BEFORE INSERT OR UPDATE ON groups
FOR EACH ROW
EXECUTE PROCEDURE group_search_update();

CREATE INDEX search_group ON groups USING GIN (tsvectors);



-- Triggers

DROP FUNCTION IF EXISTS check_profile_visibility() CASCADE;
DROP FUNCTION IF EXISTS check_group_visibility() CASCADE;
DROP FUNCTION IF EXISTS prevent_duplicate_group_join() CASCADE;
DROP FUNCTION IF EXISTS prevent_self_friendship() CASCADE;
DROP FUNCTION IF EXISTS prevent_self_friend_request() CASCADE;
DROP FUNCTION IF EXISTS prevent_existing_friend_request() CASCADE;
DROP FUNCTION IF EXISTS check_post_interaction_access() CASCADE;
DROP FUNCTION IF EXISTS check_group_post_permission() CASCADE;
DROP FUNCTION IF EXISTS prevent_duplicate_likes() CASCADE;
DROP FUNCTION IF EXISTS check_post_content() CASCADE;

-- BR01: Profile Visibility
CREATE FUNCTION check_profile_visibility() RETURNS TRIGGER AS $$
BEGIN
    IF NOT EXISTS (
        SELECT 1 FROM registered_user WHERE id_user = NEW.id_user AND is_public = TRUE
    ) AND NOT EXISTS (
        SELECT 1 FROM user_friend WHERE id_user = NEW.id_user AND id_friend = NEW.id_friend
    ) THEN
        RAISE EXCEPTION 'Cannot access private profile content without being friends';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER profile_visibility_trigger
BEFORE INSERT OR UPDATE ON user_friend
FOR EACH ROW
EXECUTE FUNCTION check_profile_visibility();

-- BR02: Group Visibility
CREATE FUNCTION check_group_visibility() RETURNS TRIGGER AS $$
BEGIN
    IF NOT EXISTS (
        SELECT 1 FROM groups WHERE id_group = NEW.id_group AND is_public = TRUE
    ) AND NOT EXISTS (
        SELECT 1 FROM group_membership WHERE id_group = NEW.id_group AND id_member = NEW.id_member
    ) THEN
        RAISE EXCEPTION 'Cannot access private group without being a member';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER group_visibility_trigger
BEFORE INSERT OR UPDATE ON group_membership
FOR EACH ROW
EXECUTE FUNCTION check_group_visibility();

-- BR07: Group Join Restriction
CREATE FUNCTION prevent_duplicate_group_join() RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS (
        SELECT 1 FROM group_membership 
        WHERE id_group = NEW.id_group AND id_member = NEW.id_requester
    ) THEN
        RAISE EXCEPTION 'User is already a member of this group';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER no_duplicate_group_join_trigger
BEFORE INSERT ON group_join_request
FOR EACH ROW
EXECUTE FUNCTION prevent_duplicate_group_join();

-- BR08: Self-Friending Prohibition
CREATE FUNCTION prevent_self_friendship() RETURNS TRIGGER AS $$
BEGIN
    IF NEW.id_user = NEW.id_friend THEN
        RAISE EXCEPTION 'A user cannot be friends with themselves';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER no_self_friendship_trigger
BEFORE INSERT OR UPDATE ON user_friend
FOR EACH ROW
EXECUTE FUNCTION prevent_self_friendship();

-- BR09: Self-Request Prohibition
CREATE FUNCTION prevent_self_friend_request() RETURNS TRIGGER AS $$
BEGIN
    IF NEW.id_user = NEW.id_requester THEN
        RAISE EXCEPTION 'A user cannot send a friend request to themselves';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER no_self_friend_request_trigger
BEFORE INSERT ON user_friend_request
FOR EACH ROW
EXECUTE FUNCTION prevent_self_friend_request();

-- BR10: Existing Friend Request Prohibition
CREATE FUNCTION prevent_existing_friend_request() RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS (
        SELECT 1 FROM user_friend 
        WHERE (id_user = NEW.id_user AND id_friend = NEW.id_requester)
        OR (id_user = NEW.id_requester AND id_friend = NEW.id_user)
    ) THEN
        RAISE EXCEPTION 'Cannot send friend request to existing friend';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER no_existing_friend_request_trigger
BEFORE INSERT ON user_friend_request
FOR EACH ROW
EXECUTE FUNCTION prevent_existing_friend_request();


-- BR12: Post Interaction Access
CREATE FUNCTION check_post_interaction_access() RETURNS TRIGGER AS $$
BEGIN
    -- Check if post creator is public
    IF EXISTS (
        SELECT 1 FROM post p
        JOIN registered_user ru ON p.id_creator = ru.id_user
        WHERE p.id_post = NEW.id_post AND ru.is_public = TRUE
    ) THEN
        RETURN NEW;
    END IF;

    -- Check if user is friend with post creator
    IF EXISTS (
        SELECT 1 FROM post p
        JOIN user_friend uf ON p.id_creator = uf.id_user
        WHERE p.id_post = NEW.id_post AND uf.id_friend = NEW.id_user
    ) THEN
        RETURN NEW;
    END IF;

    -- Check if post is in a group where user is member
    IF EXISTS (
        SELECT 1 FROM post p
        JOIN group_membership gm ON p.id_group = gm.id_group
        WHERE p.id_post = NEW.id_post AND gm.id_member = NEW.id_user
    ) THEN
        RETURN NEW;
    END IF;

    RAISE EXCEPTION 'User does not have permission to interact with this post';
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER post_interaction_access_comments_trigger
BEFORE INSERT ON comments
FOR EACH ROW
EXECUTE FUNCTION check_post_interaction_access();

CREATE TRIGGER post_interaction_access_likes_trigger
BEFORE INSERT ON post_like
FOR EACH ROW
EXECUTE FUNCTION check_post_interaction_access();


-- BR13: Group Post Membership Required
CREATE FUNCTION check_group_post_permission() RETURNS TRIGGER AS $$
BEGIN
    IF NOT EXISTS (
        SELECT 1 FROM group_membership
        WHERE id_group = NEW.id_group AND id_member = NEW.id_sender
    ) THEN
        RAISE EXCEPTION 'User must be a member of the group to send messages';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER group_post_permission_trigger
BEFORE INSERT ON group_message
FOR EACH ROW
EXECUTE FUNCTION check_group_post_permission();


-- BR14: Single Like Constraint
CREATE FUNCTION prevent_duplicate_likes() RETURNS TRIGGER AS $$
BEGIN
    IF TG_TABLE_NAME = 'post_like' THEN
        IF EXISTS (
            SELECT 1 FROM post_like
            WHERE id_post = NEW.id_post AND id_user = NEW.id_user
        ) THEN
            RAISE EXCEPTION 'User has already liked this post';
        END IF;
    ELSIF TG_TABLE_NAME = 'comment_like' THEN
        IF EXISTS (
            SELECT 1 FROM comment_like
            WHERE id_comment = NEW.id_comment AND id_user = NEW.id_user
        ) THEN
            RAISE EXCEPTION 'User has already liked this comment';
        END IF;
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER single_post_like_trigger
BEFORE INSERT ON post_like
FOR EACH ROW
EXECUTE FUNCTION prevent_duplicate_likes();

CREATE TRIGGER single_comment_like_trigger
BEFORE INSERT ON comment_like
FOR EACH ROW
EXECUTE FUNCTION prevent_duplicate_likes();

-- BR15: Post Content Requirement
CREATE FUNCTION check_post_content() RETURNS TRIGGER AS $$
BEGIN
    IF NEW.description IS NULL AND NEW.image IS NULL THEN
        RAISE EXCEPTION 'Post must have either a description or an image';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER post_content_trigger
BEFORE INSERT OR UPDATE ON post
FOR EACH ROW
EXECUTE FUNCTION check_post_content();

DROP TRIGGER profile_visibility_trigger ON user_friend;
