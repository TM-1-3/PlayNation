BEGIN;


INSERT INTO registered_user (username, name, email, password, biography, profile_picture, is_public) VALUES
('hvegan', 'Hugo Vegano', 'hugo@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Adepto do veganismo e do fitness. Correr é vida! 🏃‍♂️', 'img/users/hugo.png', TRUE),
('ffrioli', 'Franchesco Frioli', 'franco@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Calcio, pasta e golo! Forza Italia! 🍕', 'img/users/franco.png', TRUE),
('acoutinho', 'André Coutinho', 'andre@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Programador de dia, basquetebolista à noite. 🏀', 'img/users/andre.png', TRUE),
('admin', 'Maria Silva (Admin)', 'admin@sportsnet.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'A manter a rede a funcionar.', 'img/users/admin.png', TRUE),
('cr7', 'Cristiano Ronaldo', 'cr7@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'SIUUUU! 🐐', 'img/users/cr7.png', TRUE),
('jmarques', 'Joana Marques', 'joana@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Amante de Padel e corridas de fim-de-semana.', 'img/users/joana.png', TRUE),
('rcosta', 'Rui Costa', 'rui@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Sempre a ver futebol.', 'img/users/rui.png', FALSE);


INSERT INTO administrator (id_admin) VALUES (4);
INSERT INTO verified_user (id_verified) VALUES (5);
INSERT INTO group_owner (id_group_owner) VALUES (1), (2), (6);


INSERT INTO label (designation, image) VALUES
('Futebol', 'img/labels/futebol.png'),
('Basquetebol', 'img/labels/basket.png'),
('Corrida', 'img/labels/running.png'),
('Padel', 'img/labels/padel.png'),
('Nutrição', 'img/labels/nutri.png'),
('Equipamento', 'img/labels/equip.png'),
('Ginásio', 'img/labels/gym.png');

INSERT INTO sport (id_sport) VALUES (1), (2), (3), (4), (7);
INSERT INTO category (id_category) VALUES (5), (6);


INSERT INTO user_label (id_user, id_label) VALUES
(1, 3), (1, 5), (2, 1), (3, 2), (5, 1), (5, 7), (6, 4), (6, 3);


INSERT INTO post (id_creator, image, description, date) VALUES
(5, 'img/posts/cr7_golo.jpg', 'Dia de jogo! Foco total. ⚽️ #Futebol #CR7', NOW() - INTERVAL '2 days'),
(1, 'img/posts/hugo_run.jpg', 'Mais 10km para começar o dia. A energia vegan a funcionar! 🏃‍♂️ #running #vegan', NOW() - INTERVAL '1 day'),
(3, 'img/posts/andre_basket.jpg', 'Grande jogo ontem com a malta! 🏀 #basketamador #LBAW', NOW() - INTERVAL '10 hours'),
(2, 'img/posts/franco_pizza.jpg', 'A preparar o pre-jogo! Non c''è partita senza una buona pizza. 🍕 #italia #futebol', NOW() - INTERVAL '5 hours'),
(5, 'img/posts/cr7_gym.jpg', 'Sem dias de folga. 💪 #gym #foco', NOW() - INTERVAL '3 hours'),
(6, 'img/posts/joana_padel.jpg', 'Manhã de Padel. Quem alinha para a próxima? #padel', NOW() - INTERVAL '1 hour');


INSERT INTO user_tag (id_post, id_user) VALUES
(3, 1), (4, 5);


INSERT INTO post_like (id_post, id_user) VALUES
(1, 1), (1, 2), (1, 3), (2, 3), (2, 6), (5, 1), (6, 1);

INSERT INTO post_save (id_post, id_user) VALUES
(2, 6), (5, 3);


INSERT INTO comments (id_post, id_user, id_reply, text, date) VALUES
(1, 2, NULL, 'Grande!! Il migliore del mondo! 🇮🇹', NOW() - INTERVAL '1 day'),
(2, 3, NULL, 'Boa Hugo! Eu fico-me pelo basket 😅', NOW() - INTERVAL '10 hours'),
(2, 1, 2, 'Obrigado André! Temos de combinar um treino um dia destes.', NOW() - INTERVAL '9 hours'),
(1, 1, NULL, 'Máquina! 🔥', NOW() - INTERVAL '8 hours'),
(6, 3, NULL, 'Eu alinho Joana!', NOW() - INTERVAL '30 minutes');


INSERT INTO comment_like (id_comment, id_user) VALUES
(1, 5), (1, 1), (2, 1), (5, 6);


INSERT INTO user_friend (id_user, id_friend) VALUES
(1, 3), (3, 1), (1, 6), (6, 1), (2, 5), (5, 2);

INSERT INTO user_friend_request (id_user, id_requester) VALUES
(1, 2), (7, 3);


INSERT INTO user_block (id_user, id_blocked) VALUES
(7, 5);


INSERT INTO groups (id_owner, name, description, picture, is_public) VALUES
(1, 'Vegan Runners PT', 'Grupo para partilhar corridas e receitas vegan.', 'img/groups/group_run.png', TRUE),
(2, 'Calcio Amatori 🇮🇹', 'Só para verdadeiros fãs da Serie A.', 'img/groups/group_calcio.png', TRUE),
(6, 'Padel LBAW', 'Grupo privado da malta de Padel.', 'img/groups/group_padel.png', FALSE);


INSERT INTO group_membership (id_group, id_member) VALUES
(1, 1), (1, 6), (2, 2), (2, 5), (3, 6);

INSERT INTO group_join_request (id_group, id_requester) VALUES
(3, 3);


INSERT INTO message (text, image, date) VALUES
('Olá André, tudo bem?', NULL, NOW() - INTERVAL '1 hour'),
('Tudo! E contigo? Vi o teu post da corrida, grande forma!', NULL, NOW() - INTERVAL '55 minutes'),
('Forza! Stasera si vince! ⚽️', 'img/msg/italia_flag.png', NOW() - INTERVAL '30 minutes'),
('Onde é o jogo de Padel amanhã?', NULL, NOW() - INTERVAL '10 minutes');


INSERT INTO private_message (id_message, id_sender, id_receiver) VALUES
(1, 1, 3), (2, 3, 1);

INSERT INTO group_message (id_message, id_group, id_sender) VALUES
(3, 2, 2), (4, 3, 6);


INSERT INTO notification (id_receiver, id_emitter, text, date) VALUES
(5, 1, 'Hugo Vegano gostou do seu post.', NOW() - INTERVAL '2 days'),
(1, 3, 'André Coutinho comentou o seu post.', NOW() - INTERVAL '10 hours'),
(3, 1, 'Hugo Vegano gostou do seu comentário.', NOW() - INTERVAL '9 hours'),
(1, 2, 'Franchesco Frioli enviou-lhe um pedido de amizade.', NOW() - INTERVAL '1 day'),
(3, 1, 'Hugo Vegano enviou-lhe uma mensagem.', NOW() - INTERVAL '1 hour'),
(5, 2, 'Nova mensagem no grupo ''Calcio Amatori 🇮🇹''.', NOW() - INTERVAL '30 minutes'),
(6, 3, 'André Coutinho quer juntar-se ao grupo ''Padel LBAW''.', NOW() - INTERVAL '5 minutes');


INSERT INTO like_post_notification (id_notification, id_post) VALUES (1, 1);
INSERT INTO comment_notification (id_notification, id_comment) VALUES (2, 2);
INSERT INTO like_comment_notification (id_notification, id_comment) VALUES (3, 2);
INSERT INTO friend_request_notification (id_notification, accepted) VALUES (4, NULL);
INSERT INTO private_message_notification (id_notification, id_message) VALUES (5, 1);
INSERT INTO group_message_notification (id_notification, id_message) VALUES (6, 3);
INSERT INTO join_group_request_notification (id_notification, id_group, accepted) VALUES (7, 3, NULL);


INSERT INTO report (description) VALUES
('Este comentário é spam e ofensivo.'),
('Este post é fake news sobre nutrição.');


INSERT INTO report_comment (id_report, id_comment) VALUES (1, 1);
INSERT INTO report_post (id_report, id_post) VALUES (2, 2);


COMMIT;
