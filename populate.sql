-- Iniciar Transação
BEGIN;

--
-- 1. População de Utilizadores (registered_user)
-- Nota: Todas as passwords são 'password' (hash Bcrypt: $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi)
--
INSERT INTO registered_user (id_user, username, name, email, password, biography, profile_picture, is_public) VALUES
(1, 'hvegan', 'Hugo Vegano', 'hugo@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Adepto do veganismo e do fitness. Correr é vida! 🏃‍♂️', 'img/users/hugo.png', TRUE),
(2, 'ffrioli', 'Franchesco Frioli', 'franco@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Calcio, pasta e golo! Forza Italia! 🍕', 'img/users/franco.png', TRUE),
(3, 'acoutinho', 'André Coutinho', 'andre@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Programador de dia, basquetebolista à noite. 🏀', 'img/users/andre.png', TRUE),
(4, 'admin', 'Maria Silva (Admin)', 'admin@sportsnet.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'A manter a rede a funcionar.', 'img/users/admin.png', TRUE),
(5, 'cr7', 'Cristiano Ronaldo', 'cr7@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'SIUUUU! 🐐', 'img/users/cr7.png', TRUE),
(6, 'jmarques', 'Joana Marques', 'joana@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Amante de Padel e corridas de fim-de-semana.', 'img/users/joana.png', TRUE),
(7, 'rcosta', 'Rui Costa', 'rui@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Sempre a ver futebol.', 'img/users/rui.png', FALSE); -- Utilizador Privado

--
-- 2. População de Papéis (Roles)
--
INSERT INTO administrator (id_admin) VALUES (4);
INSERT INTO verified_user (id_verified) VALUES (5);
INSERT INTO group_owner (id_group_owner) VALUES (1);
INSERT INTO group_owner (id_group_owner) VALUES (2);
INSERT INTO group_owner (id_group_owner) VALUES (6);

--
-- 3. População de Labels, Sports e Categories
--
INSERT INTO label (id_label, designation, image) VALUES
(101, 'Futebol', 'img/labels/futebol.png'),
(102, 'Basquetebol', 'img/labels/basket.png'),
(103, 'Corrida', 'img/labels/running.png'),
(104, 'Padel', 'img/labels/padel.png'),
(105, 'Nutrição', 'img/labels/nutri.png'),
(106, 'Equipamento', 'img/labels/equip.png'),
(107, 'Ginásio', 'img/labels/gym.png');

INSERT INTO sport (id_sport) VALUES (101), (102), (103), (104), (107);
INSERT INTO category (id_category) VALUES (105), (106);

--
-- 4. População de Interesses dos Utilizadores (user_label)
--
INSERT INTO user_label (id_user, id_label) VALUES
(1, 103), -- Hugo (Corrida)
(1, 105), -- Hugo (Nutrição)
(2, 101), -- Franchesco (Futebol)
(3, 102), -- André (Basquetebol)
(5, 101), -- CR7 (Futebol)
(5, 107), -- CR7 (Ginásio)
(6, 104), -- Joana (Padel)
(6, 103); -- Joana (Corrida)

--
-- 5. População de Posts
--
INSERT INTO post (id_post, id_creator, image, description, date) VALUES
(201, 5, 'img/posts/cr7_golo.jpg', 'Dia de jogo! Foco total. ⚽️ #Futebol #CR7', NOW() - INTERVAL '2 days'),
(202, 1, 'img/posts/hugo_run.jpg', 'Mais 10km para começar o dia. A energia vegan a funcionar! 🏃‍♂️ #running #vegan', NOW() - INTERVAL '1 day'),
(203, 3, 'img/posts/andre_basket.jpg', 'Grande jogo ontem com a malta! 🏀 #basketamador #LBAW', NOW() - INTERVAL '10 hours'),
(204, 2, 'img/posts/franco_pizza.jpg', 'A preparar o pre-jogo! Non c''è partita senza una buona pizza. 🍕 #italia #futebol', NOW() - INTERVAL '5 hours'),
(205, 5, 'img/posts/cr7_gym.jpg', 'Sem dias de folga. 💪 #gym #foco', NOW() - INTERVAL '3 hours'),
(206, 6, 'img/posts/joana_padel.jpg', 'Manhã de Padel. Quem alinha para a próxima? #padel', NOW() - INTERVAL '1 hour');

--
-- 6. População de Tags de Utilizadores em Posts (user_tag)
--
INSERT INTO user_tag (id_post, id_user) VALUES
(203, 1), -- André (post 203) tagou o Hugo (user 1)
(204, 5); -- Franchesco (post 204) tagou o CR7 (user 5)

--
-- 7. População de Likes e Saves
--
INSERT INTO post_like (id_post, id_user) VALUES
(201, 1), -- Hugo gostou do post 201 (CR7)
(201, 2), -- Franchesco gostou do post 201 (CR7)
(201, 3), -- André gostou do post 201 (CR7)
(202, 3), -- André gostou do post 202 (Hugo)
(202, 6), -- Joana gostou do post 202 (Hugo)
(205, 1), -- Hugo gostou do post 205 (CR7 Gym)
(206, 1); -- Hugo gostou do post 206 (Joana)

INSERT INTO post_save (id_post, id_user) VALUES
(202, 6), -- Joana guardou o post 202 (Hugo Running)
(205, 3); -- André guardou o post 205 (CR7 Gym)

--
-- 8. População de Comentários
--
INSERT INTO comments (id_comment, id_post, id_user, id_reply, text, date) VALUES
(301, 201, 2, NULL, 'Grande!! Il migliore del mondo! 🇮🇹', NOW() - INTERVAL '1 day'), -- Franchesco no post do CR7
(302, 202, 3, NULL, 'Boa Hugo! Eu fico-me pelo basket 😅', NOW() - INTERVAL '10 hours'), -- André no post do Hugo
(303, 202, 1, 302, 'Obrigado André! Temos de combinar um treino um dia destes.', NOW() - INTERVAL '9 hours'), -- Hugo responde ao André
(304, 201, 1, NULL, 'Máquina! 🔥', NOW() - INTERVAL '8 hours'), -- Hugo no post do CR7
(305, 206, 3, NULL, 'Eu alinho Joana!', NOW() - INTERVAL '30 minutes'); -- André no post da Joana

--
-- 9. População de Likes em Comentários
--
INSERT INTO comment_like (id_comment, id_user) VALUES
(301, 5), -- CR7 gostou do comentário do Franchesco
(301, 1), -- Hugo gostou do comentário do Franchesco
(302, 1), -- Hugo gostou do comentário do André
(305, 6); -- Joana gostou do comentário do André

--
-- 10. População de Amizades e Pedidos
-- (Assumindo que a amizade é bi-direcional e precisa de 2 registos)
--
INSERT INTO user_friend (id_user, id_friend) VALUES
(1, 3), (3, 1), -- Hugo e André
(1, 6), (6, 1), -- Hugo e Joana
(2, 5), (5, 2); -- Franchesco e CR7

INSERT INTO user_friend_request (id_user, id_requester) VALUES
(1, 2), -- Franchesco (2) enviou pedido ao Hugo (1)
(7, 3); -- André (3) enviou pedido ao Rui Costa (7)

--
-- 11. População de Blocos
--
INSERT INTO user_block (id_user, id_blocked) VALUES
(7, 5); -- Rui Costa (7) bloqueou o CR7 (5) (demasiado spam do SIU)

--
-- 12. População de Grupos
--
INSERT INTO groups (id_group, id_owner, name, description, picture, is_public) VALUES
(401, 1, 'Vegan Runners PT', 'Grupo para partilhar corridas e receitas vegan.', 'img/groups/group_run.png', TRUE),
(402, 2, 'Calcio Amatori 🇮🇹', 'Só para verdadeiros fãs da Serie A.', 'img/groups/group_calcio.png', TRUE),
(403, 6, 'Padel LBAW', 'Grupo privado da malta de Padel.', 'img/groups/group_padel.png', FALSE);

--
-- 13. População de Membros de Grupos
--
INSERT INTO group_membership (id_group, id_member) VALUES
(401, 1), -- Hugo (Owner)
(401, 6), -- Joana
(402, 2), -- Franchesco (Owner)
(402, 5), -- CR7
(403, 6); -- Joana (Owner)

INSERT INTO group_join_request (id_group, id_requester) VALUES
(403, 3); -- André (3) quer juntar-se ao Padel LBAW (403)

--
-- 14. População de Mensagens (Base)
--
INSERT INTO message (id_message, text, image, date) VALUES
(501, 'Olá André, tudo bem?', NULL, NOW() - INTERVAL '1 hour'),
(502, 'Tudo! E contigo? Vi o teu post da corrida, grande forma!', NULL, NOW() - INTERVAL '55 minutes'),
(503, 'Forza! Stasera si vince! ⚽️', 'img/msg/italia_flag.png', NOW() - INTERVAL '30 minutes'),
(504, 'Onde é o jogo de Padel amanhã?', NULL, NOW() - INTERVAL '10 minutes');

--
-- 15. População de Mensagens (Tipos)
--
INSERT INTO private_message (id_message, id_sender, id_receiver) VALUES
(501, 1, 3), -- Hugo (1) para André (3)
(502, 3, 1); -- André (3) para Hugo (1)

INSERT INTO group_message (id_message, id_group, id_sender) VALUES
(503, 402, 2), -- Franchesco (2) no grupo Calcio (402)
(504, 403, 6); -- Joana (6) no grupo Padel (403)

--
-- 16. População de Notificações (Base)
--
INSERT INTO notification (id_notification, id_receiver, id_emitter, text, date) VALUES
(601, 5, 1, 'Hugo Vegano gostou do seu post.', NOW() - INTERVAL '2 days'), -- Like Post
(602, 1, 3, 'André Coutinho comentou o seu post.', NOW() - INTERVAL '10 hours'), -- Comment
(603, 3, 1, 'Hugo Vegano gostou do seu comentário.', NOW() - INTERVAL '9 hours'), -- Like Comment
(604, 1, 2, 'Franchesco Frioli enviou-lhe um pedido de amizade.', NOW() - INTERVAL '1 day'), -- Friend Request
(605, 3, 1, 'Hugo Vegano enviou-lhe uma mensagem.', NOW() - INTERVAL '1 hour'), -- Private Message
(606, 5, 2, 'Nova mensagem no grupo ''Calcio Amatori 🇮🇹''.', NOW() - INTERVAL '30 minutes'), -- Group Message
(607, 6, 3, 'André Coutinho quer juntar-se ao grupo ''Padel LBAW''.', NOW() - INTERVAL '5 minutes'); -- Join Group Request

--
-- 17. População de Notificações (Sub-tipos)
--
INSERT INTO like_post_notification (id_notification, id_post) VALUES (601, 201);
INSERT INTO comment_notification (id_notification, id_comment) VALUES (602, 302);
INSERT INTO like_comment_notification (id_notification, id_comment) VALUES (603, 302);
INSERT INTO friend_request_notification (id_notification, accepted) VALUES (604, NULL); -- Pendente
INSERT INTO private_message_notification (id_notification, id_message) VALUES (605, 501);
INSERT INTO group_message_notification (id_notification, id_message) VALUES (606, 503);
INSERT INTO join_group_request_notification (id_notification, id_group, accepted) VALUES (607, 403, NULL); -- Pendente

--
-- 18. População de Reports (Base)
--
INSERT INTO report (id_report, description) VALUES
(701, 'Este comentário é spam e ofensivo.'),
(702, 'Este post é fake news sobre nutrição.');

--
-- 19. População de Reports (Sub-tipos)
--
INSERT INTO report_comment (id_report, id_comment) VALUES (701, 301); -- Report ao comentário 301 (Franchesco)
INSERT INTO report_post (id_report, id_post) VALUES (702, 202); -- Report ao post 202 (Hugo)


-- Fim da Transação
COMMIT;