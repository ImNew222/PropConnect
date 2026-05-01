-- ============================================
-- PropConnect Data INSERT Statements
-- Generated: 2026-01-25 09:07:57
-- 
-- Run schema.sql FIRST before running this!
-- ============================================

-- ============================================
-- USERS (53 records)
-- ============================================

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(3, 'Veruska', 'test@gmail.com', 'landlord', '+634654891', NULL, FALSE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T09:04:16.000000Z', '2026-01-21T09:04:16.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(4, 'Wendy Casey', 'wendy.casey@outlook.com', 'landlord', '+63 995 474 3661', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:20.000000Z', '2026-01-21T10:39:20.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(5, 'Jeremy Duarte', 'jeremy.duarte@outlook.com', 'landlord', '+63 985 524 9921', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:21.000000Z', '2026-01-21T10:39:21.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(6, 'Kathryn Guzman', 'kathryn.guzman@gmail.com', 'landlord', '+63 986 735 8188', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:22.000000Z', '2026-01-21T10:39:22.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(7, 'Erika Cannon', 'erika.cannon@gmail.com', 'landlord', '+63 918 982 1178', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:24.000000Z', '2026-01-21T10:39:24.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(8, 'Tammy Carroll', 'tammy.carroll@outlook.com', 'landlord', '+63 985 878 2828', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:25.000000Z', '2026-01-21T10:39:25.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(9, 'Anne Howard', 'anne.howard@gmail.com', 'landlord', '+63 958 836 6543', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:26.000000Z', '2026-01-21T10:39:26.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(10, 'Dr. Nicole Holmes', 'dr..nicole.holmes@email.com', 'landlord', '+63 943 637 4034', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:27.000000Z', '2026-01-21T10:39:27.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(11, 'Bradley Burch', 'bradley.burch@email.com', 'landlord', '+63 945 929 8976', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:29.000000Z', '2026-01-21T10:39:29.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(12, 'Samuel Gonzalez', 'samuel.gonzalez@outlook.com', 'landlord', '+63 949 256 1487', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:30.000000Z', '2026-01-21T10:39:30.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(13, 'Larry Ruiz', 'larry.ruiz@yahoo.com', 'landlord', '+63 953 231 2284', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:31.000000Z', '2026-01-21T10:39:31.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(14, 'Gabrielle Tate', 'gabrielle.tate@yahoo.com', 'landlord', '+63 972 617 9747', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:33.000000Z', '2026-01-21T10:39:33.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(15, 'Jeffrey Lewis', 'jeffrey.lewis@outlook.com', 'landlord', '+63 981 166 7405', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:34.000000Z', '2026-01-21T10:39:34.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(16, 'Erika White', 'erika.white@outlook.com', 'landlord', '+63 979 460 2494', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:35.000000Z', '2026-01-21T10:39:35.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(17, 'Samantha Charles', 'samantha.charles@gmail.com', 'landlord', '+63 949 192 3681', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:36.000000Z', '2026-01-21T10:39:36.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(18, 'Ricardo Carpenter', 'ricardo.carpenter@gmail.com', 'landlord', '+63 928 921 9352', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:38.000000Z', '2026-01-21T10:39:38.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(19, 'Mary Flores', 'mary.flores@yahoo.com', 'landlord', '+63 913 765 4694', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:39.000000Z', '2026-01-21T10:39:39.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(20, 'Emily Miller', 'emily.miller@outlook.com', 'landlord', '+63 964 117 4182', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:40.000000Z', '2026-01-21T10:39:40.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(21, 'Gregory Freeman', 'gregory.freeman@yahoo.com', 'landlord', '+63 946 730 5744', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:42.000000Z', '2026-01-21T10:39:42.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(22, 'Dennis Pacheco', 'dennis.pacheco@gmail.com', 'landlord', '+63 983 951 6049', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:43.000000Z', '2026-01-21T10:39:43.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(23, 'Jacqueline Baird', 'jacqueline.baird@yahoo.com', 'landlord', '+63 943 317 8268', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:44.000000Z', '2026-01-21T10:39:44.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(24, 'Pamela Williams', 'pamela.williams@email.com', 'landlord', '+63 968 484 9900', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:46.000000Z', '2026-01-21T10:39:46.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(25, 'Gary Ho', 'gary.ho@email.com', 'landlord', '+63 933 280 9946', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:47.000000Z', '2026-01-21T10:39:47.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(26, 'Mark Molina', 'mark.molina@gmail.com', 'landlord', '+63 914 597 2750', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:48.000000Z', '2026-01-21T10:39:48.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(27, 'Rebecca Flores', 'rebecca.flores@yahoo.com', 'landlord', '+63 964 941 8605', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:49.000000Z', '2026-01-21T10:39:49.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(28, 'Jerry Norton', 'jerry.norton@email.com', 'landlord', '+63 967 776 7571', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:51.000000Z', '2026-01-21T10:39:51.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(29, 'Melissa Reeves', 'melissa.reeves@email.com', 'landlord', '+63 989 873 7195', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:52.000000Z', '2026-01-21T10:39:52.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(30, 'Stephanie Dyer', 'stephanie.dyer@outlook.com', 'landlord', '+63 963 681 7249', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:53.000000Z', '2026-01-21T10:39:53.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(31, 'Rebecca Hunt', 'rebecca.hunt@email.com', 'landlord', '+63 994 106 5404', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:55.000000Z', '2026-01-21T10:39:55.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(32, 'Kevin Thomas', 'kevin.thomas@outlook.com', 'landlord', '+63 919 244 6074', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:56.000000Z', '2026-01-21T10:39:56.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(33, 'Jesus Zimmerman', 'jesus.zimmerman@email.com', 'landlord', '+63 965 983 5802', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:57.000000Z', '2026-01-21T10:39:57.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(34, 'Debra Cisneros', 'debra.cisneros@yahoo.com', 'landlord', '+63 997 846 2088', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:39:59.000000Z', '2026-01-21T10:39:59.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(35, 'Alex English MD', 'alex.english.md@yahoo.com', 'landlord', '+63 942 388 4726', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:40:00.000000Z', '2026-01-21T10:40:00.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(36, 'Eric Ortiz', 'eric.ortiz@email.com', 'landlord', '+63 984 567 5757', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:40:02.000000Z', '2026-01-21T10:40:02.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(37, 'Ryan Nixon', 'ryan.nixon@gmail.com', 'landlord', '+63 942 407 1449', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:40:03.000000Z', '2026-01-21T10:40:03.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(38, 'Catherine Villarreal', 'catherine.villarreal@email.com', 'landlord', '+63 933 257 5112', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:40:04.000000Z', '2026-01-21T10:40:04.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(39, 'Samantha Kelley', 'samantha.kelley@email.com', 'landlord', '+63 978 117 1645', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:40:06.000000Z', '2026-01-21T10:40:06.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(40, 'Patrick Nash', 'patrick.nash@email.com', 'landlord', '+63 955 141 3147', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:40:07.000000Z', '2026-01-21T10:40:07.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(41, 'Barbara Garza', 'barbara.garza@yahoo.com', 'landlord', '+63 968 639 2039', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:40:08.000000Z', '2026-01-21T10:40:08.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(2, 'Alinghawa', 'mikealinghawa@gmail.com', 'renter', '+634654891', NULL, FALSE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T08:46:59.000000Z', '2026-01-21T08:46:59.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(42, 'Donna Cuevas', 'donna.cuevas@yahoo.com', 'landlord', '+63 923 847 4822', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:40:09.000000Z', '2026-01-21T10:40:09.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(43, 'Tracy Russell', 'tracy.russell@outlook.com', 'landlord', '+63 974 409 7444', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:40:11.000000Z', '2026-01-21T10:40:11.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(44, 'Mrs. Brittany Johnson DDS', 'mrs..brittany.johnson.dds@email.com', 'landlord', '+63 945 382 9780', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:40:12.000000Z', '2026-01-21T10:40:12.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(45, 'Michael Ortiz', 'michael.ortiz@yahoo.com', 'landlord', '+63 979 770 8233', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:40:13.000000Z', '2026-01-21T10:40:13.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(46, 'Anne Braun', 'anne.braun@yahoo.com', 'landlord', '+63 944 723 5898', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:40:15.000000Z', '2026-01-21T10:40:15.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(47, 'Brandi Gonzalez', 'brandi.gonzalez@yahoo.com', 'landlord', '+63 976 263 7402', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:40:16.000000Z', '2026-01-21T10:40:16.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(48, 'Katie Marshall', 'katie.marshall@email.com', 'landlord', '+63 968 511 6805', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:40:17.000000Z', '2026-01-21T10:40:17.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(49, 'Amanda Maldonado', 'amanda.maldonado@gmail.com', 'landlord', '+63 962 906 1742', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:40:19.000000Z', '2026-01-21T10:40:19.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(50, 'Isabel Mcclain', 'isabel.mcclain@outlook.com', 'landlord', '+63 968 223 5766', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:40:20.000000Z', '2026-01-21T10:40:20.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(51, 'Rachel Anderson', 'rachel.anderson@outlook.com', 'landlord', '+63 949 864 6288', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:40:21.000000Z', '2026-01-21T10:40:21.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(52, 'Victoria Lynch', 'victoria.lynch@outlook.com', 'landlord', '+63 966 461 2406', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:40:22.000000Z', '2026-01-21T10:40:22.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(53, 'Taylor Cobb', 'taylor.cobb@yahoo.com', 'landlord', '+63 910 852 8014', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T10:40:24.000000Z', '2026-01-21T10:40:24.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES
(1, 'Demo Landlord', 'landlord@propconnect.demo', 'landlord', '+63 912 345 6789', NULL, TRUE, NULL, NULL, NULL, NULL, NULL, '$2y$12$default', NULL, '2026-01-21T08:20:53.000000Z', '2026-01-21T08:20:53.000000Z')
ON CONFLICT (id) DO NOTHING;

-- Reset users sequence
SELECT setval('users_id_seq', (SELECT MAX(id) FROM users));

-- ============================================
-- PROPERTIES (62 records)
-- ============================================

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(1, 1, 'Modern Studio in IT Park', 'Fully furnished studio unit in the heart of Cebu IT Park. Perfect for young professionals. Walking distance to restaurants, cafes, and offices. 24/7 security, swimming pool, and gym access included.', 'studio', '18000.00', '36000.00', 0, 1, '28.00', 12, 'Avida Towers IT Park, Lahug', 'Cebu City', '10.32710000', '123.90560000', '[\"wifi\",\"aircon\",\"furnished\",\"pool\",\"gym\",\"security\",\"elevator\"]', 'available', 491, TRUE, TRUE, '2026-01-21T08:20:54.000000Z', '2026-01-21T08:20:54.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(2, 1, 'Cozy 1BR Condo at Baseline', 'Spacious 1-bedroom condo with city views. Located in the popular Baseline Center with shopping mall access. Fully furnished with modern appliances.', 'condo', '22000.00', '44000.00', 1, 1, '35.00', 8, 'Baseline Residences, Cebu Business Park', 'Cebu City', '10.31820000', '123.89330000', '[\"wifi\",\"aircon\",\"furnished\",\"parking\",\"security\",\"elevator\"]', 'available', 412, TRUE, TRUE, '2026-01-21T08:20:54.000000Z', '2026-01-21T08:20:54.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(3, 1, 'Spacious 2BR near SM City', 'Large 2-bedroom apartment just 5 minutes from SM City Cebu. Great for families. Pet-friendly building with playground for kids.', 'apartment', '28000.00', '56000.00', 2, 2, '55.00', 5, 'Mango Avenue, Capitol Site', 'Cebu City', '10.30840000', '123.89350000', '[\"wifi\",\"aircon\",\"kitchen\",\"washer\",\"pet_friendly\",\"parking\"]', 'available', 323, FALSE, TRUE, '2026-01-21T08:20:54.000000Z', '2026-01-21T08:20:54.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(4, 1, 'Luxury Penthouse at Ayala', 'Premium penthouse unit with panoramic city and sea views. 3 bedrooms, modern kitchen, private balcony. Located in the prestigious Ayala Center Cebu area.', 'condo', '85000.00', '170000.00', 3, 3, '120.00', 25, 'The Alcoves, Ayala Center Cebu', 'Cebu City', '10.31900000', '123.90500000', '[\"wifi\",\"aircon\",\"furnished\",\"pool\",\"gym\",\"security\",\"elevator\",\"balcony\",\"parking\"]', 'available', 260, TRUE, TRUE, '2026-01-21T08:20:55.000000Z', '2026-01-21T08:20:55.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(5, 1, 'Budget-Friendly Room in Banilad', 'Affordable private room in a shared house. Perfect for students near UPCEBU. All utilities included in the rent.', 'room', '8000.00', '16000.00', 1, 1, '15.00', 1, 'Gov. M. Cuenco Ave, Banilad', 'Cebu City', '10.34190000', '123.91120000', '[\"wifi\",\"furnished\"]', 'available', 281, FALSE, TRUE, '2026-01-21T08:20:55.000000Z', '2026-01-21T08:20:55.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(6, 1, 'Brand New 2BR in Talamban', 'Newly constructed 2-bedroom apartment in a quiet residential area. Near universities and hospitals. Great for families or students.', 'apartment', '20000.00', '40000.00', 2, 1, '48.00', 3, 'Nasipit, Talamban', 'Cebu City', '10.35450000', '123.91230000', '[\"wifi\",\"aircon\",\"kitchen\",\"parking\"]', 'available', 357, FALSE, TRUE, '2026-01-21T08:20:56.000000Z', '2026-01-21T08:20:56.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(7, 1, 'Stylish Loft at One Pavilion', 'Unique loft-style condo with high ceilings. Modern design, fully furnished. Located near the Cebu Provincial Capitol.', 'condo', '32000.00', '64000.00', 1, 1, '42.00', 6, 'One Pavilion Place, Capitol Site', 'Cebu City', '10.30990000', '123.89120000', '[\"wifi\",\"aircon\",\"furnished\",\"pool\",\"gym\",\"elevator\"]', 'available', 276, FALSE, TRUE, '2026-01-21T08:20:56.000000Z', '2026-01-21T08:20:56.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(8, 1, 'Family House in Mabolo', '3-bedroom house with front and back yard. Private parking for 2 cars. Quiet neighborhood, near schools and churches.', 'house', '45000.00', '90000.00', 3, 2, '90.00', NULL, 'Mabolo Proper', 'Cebu City', '10.32260000', '123.90290000', '[\"wifi\",\"aircon\",\"kitchen\",\"parking\",\"pet_friendly\",\"washer\",\"dryer\"]', 'available', 234, FALSE, TRUE, '2026-01-21T08:20:56.000000Z', '2026-01-21T08:20:56.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(9, 1, 'Executive Suite at Marco Polo', 'Hotel-style living in the famous Marco Polo Plaza. Includes housekeeping, room service, and access to all hotel amenities.', 'hotel', '65000.00', '130000.00', 1, 1, '45.00', 18, 'Marco Polo Plaza, Nivel Hills', 'Cebu City', '10.32800000', '123.89900000', '[\"wifi\",\"aircon\",\"furnished\",\"pool\",\"gym\",\"security\",\"tv\"]', 'available', 403, TRUE, TRUE, '2026-01-21T08:20:57.000000Z', '2026-01-21T08:20:57.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(10, 1, 'Affordable Studio in Ramos', 'Clean and well-maintained studio near Fuente Osmeña. Walking distance to malls, restaurants, and public transport.', 'studio', '12000.00', '24000.00', 0, 1, '22.00', 4, 'Ramos Street Extension', 'Cebu City', '10.31050000', '123.88880000', '[\"wifi\",\"aircon\"]', 'available', 87, FALSE, TRUE, '2026-01-21T08:20:57.000000Z', '2026-01-21T08:20:57.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(11, 1, 'Sea View Condo in SRP', 'Modern condo with stunning sea views. Located in the new SRP development. Near SM Seaside City.', 'condo', '38000.00', '76000.00', 2, 2, '58.00', 15, 'The Reef Residences, SRP', 'Cebu City', '10.28990000', '123.87550000', '[\"wifi\",\"aircon\",\"furnished\",\"pool\",\"gym\",\"security\",\"balcony\"]', 'available', 149, FALSE, TRUE, '2026-01-21T08:20:57.000000Z', '2026-01-21T08:20:57.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(12, 1, 'Cozy 1BR near Ayala', 'Well-appointed 1-bedroom condo in Cebu Business Park. Minutes from Ayala Center. Includes parking slot.', 'condo', '25000.00', '50000.00', 1, 1, '38.00', 10, 'Solinea Tower, Cebu Business Park', 'Cebu City', '10.31750000', '123.90100000', '[\"wifi\",\"aircon\",\"furnished\",\"pool\",\"gym\",\"parking\",\"elevator\"]', 'available', 244, FALSE, TRUE, '2026-01-21T08:20:58.000000Z', '2026-01-21T08:20:58.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(13, 4, 'Serviced Apartment for Rent at Pacific Mansion', 'Luxury serviced apartment in an upscale development. Premium finishes and top-notch security. Experience sophisticated urban living at its finest.', 'apartment', '27600.00', '27600.00', 3, 1, '48.00', 31, 'Jones Avenue, Cebu City', 'Cebu City', '10.30140000', '123.89010000', '[\"pool\",\"furnished\",\"elevator\",\"laundry\",\"kitchen\",\"rooftop\"]', 'available', 455, TRUE, TRUE, '2026-01-21T10:39:20.000000Z', '2026-01-21T10:39:20.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(14, 5, 'Studio Unit for Rent at Skyline Suites', 'Newly renovated studio unit featuring contemporary design. Strategic location with easy access to major roads. Perfect for city living with all amenities nearby.', 'studio', '15000.00', '15000.00', 0, 1, '22.00', 38, 'Busay, Cebu City', 'Cebu City', '10.31230000', '123.88490000', '[\"wifi\",\"furnished\",\"laundry\",\"kitchen\"]', 'available', 126, TRUE, TRUE, '2026-01-21T10:39:21.000000Z', '2026-01-21T10:39:21.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(15, 6, 'Serviced Apartment for Rent at Pacific Point', 'Cozy serviced apartment in a prime location. Well-maintained building with friendly management. Great for solo living or couples. Close to schools and hospitals.', 'apartment', '27000.00', '27000.00', 3, 1, '36.00', 29, 'A.S. Fortuna Street, Mandaue City', 'Cebu City', '10.34690000', '123.93550000', '[\"elevator\"]', 'available', 278, TRUE, TRUE, '2026-01-21T10:39:23.000000Z', '2026-01-21T10:39:23.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(16, 7, '1-Bedroom Condo for Rent at Diamond Place', 'Modern and spacious 1-bedroom condo with stunning views. Ideal for those looking for comfort and convenience in Cebu City. Walking distance to IT hubs and commercial areas.', 'condo', '21900.00', '21900.00', 1, 1, '48.00', 35, 'Mabolo, Cebu City', 'Cebu City', '10.31780000', '123.89550000', '[\"furnished\",\"pet_friendly\"]', 'available', 196, TRUE, TRUE, '2026-01-21T10:39:24.000000Z', '2026-01-21T10:39:24.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(17, 8, 'Studio Unit for Rent at Horizon Court', 'Charming studio unit with a homey atmosphere. Building has excellent maintenance and responsive admin. Near grocery stores, banks, and cafes.', 'studio', '15000.00', '15000.00', 0, 1, '35.00', 12, 'Banilad, Cebu City', 'Cebu City', '10.33760000', '123.89910000', '[\"wifi\",\"gym\",\"laundry\",\"kitchen\"]', 'available', 72, TRUE, TRUE, '2026-01-21T10:39:25.000000Z', '2026-01-21T10:39:25.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(18, 9, 'Apartment for Rent at Sunset Living', 'Luxury apartment in an upscale development. Premium finishes and top-notch security. Experience sophisticated urban living at its finest.', 'apartment', '24000.00', '24000.00', 2, 1, '36.00', 10, 'Banilad, Cebu City', 'Cebu City', '10.33810000', '123.89720000', '[\"wifi\",\"gym\",\"furnished\",\"laundry\",\"kitchen\"]', 'available', 283, FALSE, TRUE, '2026-01-21T10:39:26.000000Z', '2026-01-21T10:39:26.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(19, 10, 'Studio Unit for Rent at Grand Square', 'Charming studio unit with a homey atmosphere. Building has excellent maintenance and responsive admin. Near grocery stores, banks, and cafes.', 'studio', '18300.00', '36600.00', 0, 1, '28.00', 37, 'Mandaue City (near Cebu City)', 'Cebu City', '10.34190000', '123.93710000', '[\"pool\",\"furnished\",\"security\",\"laundry\",\"kitchen\"]', 'available', 415, FALSE, TRUE, '2026-01-21T10:39:28.000000Z', '2026-01-21T10:39:28.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(20, 11, '1-Bedroom Condo for Rent at Laguna Homes', 'Cozy 1-bedroom condo in a prime location. Well-maintained building with friendly management. Great for solo living or couples. Close to schools and hospitals.', 'condo', '16800.00', '33600.00', 1, 1, '39.00', 12, 'Mandaue City (near Cebu City)', 'Cebu City', '10.34620000', '123.93990000', '[\"parking\",\"elevator\",\"kitchen\"]', 'available', 376, FALSE, TRUE, '2026-01-21T10:39:29.000000Z', '2026-01-21T10:39:29.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(21, 12, '2-Bedroom Condo for Rent at Urban Tower', 'Modern and spacious 2-bedroom condo with stunning views. Ideal for those looking for comfort and convenience in Cebu City. Walking distance to IT hubs and commercial areas.', 'condo', '53200.00', '53200.00', 2, 1, '79.00', 11, 'Kasambagan, Cebu City', 'Cebu City', '10.30850000', '123.88280000', '[\"aircon\",\"gym\",\"balcony\"]', 'available', 443, FALSE, TRUE, '2026-01-21T10:39:30.000000Z', '2026-01-21T10:39:30.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(22, 13, 'Loft Unit for Rent at Diamond Court', 'Luxury loft unit in an upscale development. Premium finishes and top-notch security. Experience sophisticated urban living at its finest.', 'studio', '33800.00', '67600.00', 1, 1, '67.00', 2, 'Capitol Site, Cebu City', 'Cebu City', '10.31770000', '123.89360000', '[\"security\"]', 'available', 195, FALSE, TRUE, '2026-01-21T10:39:32.000000Z', '2026-01-21T10:39:32.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(23, 14, 'Serviced Apartment for Rent at Elite Homes', 'Affordable serviced apartment with complete facilities. Quiet neighborhood yet close to the bustling city center. Ideal for those who value peace and accessibility.', 'apartment', '35300.00', '70600.00', 2, 1, '52.00', 37, 'Guadalupe, Cebu City', 'Cebu City', '10.30140000', '123.91260000', '[\"furnished\",\"balcony\",\"laundry\",\"kitchen\"]', 'available', 304, FALSE, TRUE, '2026-01-21T10:39:33.000000Z', '2026-01-21T10:39:33.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(24, 15, 'Apartment for Rent at Oasis Point', 'Affordable apartment with complete facilities. Quiet neighborhood yet close to the bustling city center. Ideal for those who value peace and accessibility.', 'apartment', '18900.00', '18900.00', 1, 1, '39.00', 40, 'Talamban, Cebu City', 'Cebu City', '10.35010000', '123.91340000', '[\"furnished\"]', 'available', 274, FALSE, TRUE, '2026-01-21T10:39:34.000000Z', '2026-01-21T10:39:34.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(25, 16, 'Serviced Apartment for Rent at Grand Condotel', 'Beautiful serviced apartment located in the heart of Mabolo. Perfect for young professionals and students. Near malls, restaurants, and public transportation.', 'apartment', '30100.00', '60200.00', 1, 1, '41.00', 27, 'Mabolo, Cebu City', 'Cebu City', '10.31300000', '123.88960000', '[\"furnished\",\"laundry\",\"rooftop\"]', 'available', 109, FALSE, TRUE, '2026-01-21T10:39:35.000000Z', '2026-01-21T10:39:35.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(26, 17, 'Studio Unit for Rent at Prime Terrace', 'Well-designed studio unit maximizing space and natural light. Located in a developing area with growing commercial establishments. Great investment opportunity.', 'studio', '15100.00', '30200.00', 0, 1, '23.00', 26, 'Mango Avenue, Cebu City', 'Cebu City', '10.31230000', '123.89080000', '[\"furnished\",\"security\",\"rooftop\"]', 'available', 130, FALSE, TRUE, '2026-01-21T10:39:37.000000Z', '2026-01-21T10:39:37.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(27, 18, 'Loft Unit for Rent at Crystal Gardens', 'Cozy loft unit in a prime location. Well-maintained building with friendly management. Great for solo living or couples. Close to schools and hospitals.', 'studio', '24400.00', '48800.00', 1, 1, '56.00', 19, 'Busay, Cebu City', 'Cebu City', '10.31910000', '123.89610000', '[\"wifi\",\"parking\",\"elevator\"]', 'available', 463, FALSE, TRUE, '2026-01-21T10:39:38.000000Z', '2026-01-21T10:39:38.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(28, 19, 'Studio Unit for Rent at Grand Condotel', 'Luxury studio unit in an upscale development. Premium finishes and top-notch security. Experience sophisticated urban living at its finest.', 'studio', '11800.00', '23600.00', 0, 1, '18.00', 22, 'A.S. Fortuna Street, Mandaue City', 'Cebu City', '10.34710000', '123.93000000', '[\"aircon\",\"laundry\",\"kitchen\"]', 'available', 409, FALSE, TRUE, '2026-01-21T10:39:39.000000Z', '2026-01-21T10:39:39.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(29, 20, 'Serviced Apartment for Rent at Metro Heights', 'Newly renovated serviced apartment featuring contemporary design. Strategic location with easy access to major roads. Perfect for city living with all amenities nearby.', 'apartment', '28100.00', '28100.00', 2, 1, '52.00', 10, 'IT Park, Lahug, Cebu City', 'Cebu City', '10.32400000', '123.90550000', '[\"gym\",\"parking\",\"pet_friendly\",\"kitchen\",\"rooftop\"]', 'available', 301, FALSE, TRUE, '2026-01-21T10:39:41.000000Z', '2026-01-21T10:39:41.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(30, 21, 'Serviced Apartment for Rent at Pacific Residences', 'Affordable serviced apartment with complete facilities. Quiet neighborhood yet close to the bustling city center. Ideal for those who value peace and accessibility.', 'apartment', '41200.00', '82400.00', 3, 2, '58.00', 19, 'Guadalupe, Cebu City', 'Cebu City', '10.30930000', '123.91180000', '[\"balcony\"]', 'available', 107, FALSE, TRUE, '2026-01-21T10:39:42.000000Z', '2026-01-21T10:39:42.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(31, 22, '1-Bedroom Condo for Rent at Elite Estate', 'Cozy 1-bedroom condo in a prime location. Well-maintained building with friendly management. Great for solo living or couples. Close to schools and hospitals.', 'condo', '29800.00', '29800.00', 1, 1, '39.00', 1, 'Banilad, Cebu City', 'Cebu City', '10.34310000', '123.90120000', '[\"pool\",\"parking\",\"security\",\"laundry\",\"kitchen\"]', 'available', 99, FALSE, TRUE, '2026-01-21T10:39:43.000000Z', '2026-01-21T10:39:43.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(32, 23, 'Loft Unit for Rent at Crystal Mansion', 'Charming loft unit with a homey atmosphere. Building has excellent maintenance and responsive admin. Near grocery stores, banks, and cafes.', 'studio', '37600.00', '75200.00', 1, 1, '49.00', 14, 'Apas, Cebu City', 'Cebu City', '10.30760000', '123.89680000', '[\"aircon\",\"gym\",\"parking\",\"kitchen\"]', 'available', 147, FALSE, TRUE, '2026-01-21T10:39:45.000000Z', '2026-01-21T10:39:45.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(33, 24, 'Hotel Room for Rent at Laguna Square', 'Beautiful hotel room located in the heart of Gorordo Avenue. Perfect for young professionals and students. Near malls, restaurants, and public transportation.', 'hotel', '19300.00', '38600.00', 2, 1, '27.00', 19, 'Gorordo Avenue, Cebu City', 'Cebu City', '10.30730000', '123.88910000', '[\"pool\",\"furnished\",\"security\",\"laundry\"]', 'available', 72, FALSE, TRUE, '2026-01-21T10:39:46.000000Z', '2026-01-21T10:39:46.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(34, 25, 'Hotel Room for Rent at The Homes', 'Modern and spacious hotel room with stunning views. Ideal for those looking for comfort and convenience in Cebu City. Walking distance to IT hubs and commercial areas.', 'hotel', '14800.00', '29600.00', 2, 1, '22.00', 6, 'Escario Street, Cebu City', 'Cebu City', '10.30310000', '123.89940000', '[\"wifi\",\"parking\",\"elevator\",\"balcony\",\"security\",\"kitchen\"]', 'available', 459, FALSE, TRUE, '2026-01-21T10:39:47.000000Z', '2026-01-21T10:39:47.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(35, 26, 'Serviced Apartment for Rent at Crystal Heights', 'Charming serviced apartment with a homey atmosphere. Building has excellent maintenance and responsive admin. Near grocery stores, banks, and cafes.', 'apartment', '23100.00', '46200.00', 1, 2, '44.00', 4, 'Escario Street, Cebu City', 'Cebu City', '10.31160000', '123.88730000', '[\"aircon\",\"gym\",\"furnished\"]', 'available', 193, FALSE, TRUE, '2026-01-21T10:39:49.000000Z', '2026-01-21T10:39:49.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(36, 27, '1-Bedroom Condo for Rent at Skyline Lodge', 'Cozy 1-bedroom condo in a prime location. Well-maintained building with friendly management. Great for solo living or couples. Close to schools and hospitals.', 'condo', '14600.00', '29200.00', 1, 1, '33.00', 15, 'Ayala Business Park, Cebu City', 'Cebu City', '10.31660000', '123.88070000', '[\"pool\",\"furnished\",\"security\",\"kitchen\"]', 'available', 479, FALSE, TRUE, '2026-01-21T10:39:50.000000Z', '2026-01-21T10:39:50.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(37, 28, 'Studio Unit for Rent at Sunset Plaza', 'Well-designed studio unit maximizing space and natural light. Located in a developing area with growing commercial establishments. Great investment opportunity.', 'studio', '16200.00', '32400.00', 0, 1, '25.00', 39, 'Gorordo Avenue, Cebu City', 'Cebu City', '10.31390000', '123.89900000', '[]', 'available', 132, FALSE, TRUE, '2026-01-21T10:39:51.000000Z', '2026-01-21T10:39:51.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(38, 29, 'Hotel Room for Rent at Azure Haven', 'Well-designed hotel room maximizing space and natural light. Located in a developing area with growing commercial establishments. Great investment opportunity.', 'hotel', '16200.00', '16200.00', 1, 1, '33.00', 6, 'Archbishop Reyes Avenue, Cebu City', 'Cebu City', '10.31480000', '123.89570000', '[\"pet_friendly\",\"balcony\"]', 'available', 135, FALSE, TRUE, '2026-01-21T10:39:52.000000Z', '2026-01-21T10:39:52.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(39, 30, 'Hotel Room for Rent at Diamond Lodge', 'Luxury hotel room in an upscale development. Premium finishes and top-notch security. Experience sophisticated urban living at its finest.', 'hotel', '17600.00', '17600.00', 1, 1, '24.00', 37, 'Gorordo Avenue, Cebu City', 'Cebu City', '10.30750000', '123.89210000', '[\"wifi\",\"aircon\",\"gym\",\"security\"]', 'available', 260, FALSE, TRUE, '2026-01-21T10:39:54.000000Z', '2026-01-21T10:39:54.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(40, 31, 'Apartment for Rent at Marina Heights', 'Charming apartment with a homey atmosphere. Building has excellent maintenance and responsive admin. Near grocery stores, banks, and cafes.', 'apartment', '20100.00', '20100.00', 1, 1, '49.00', 10, 'Archbishop Reyes Avenue, Cebu City', 'Cebu City', '10.31550000', '123.88940000', '[\"security\"]', 'available', 71, FALSE, TRUE, '2026-01-21T10:39:55.000000Z', '2026-01-21T10:39:55.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(41, 32, 'Serviced Apartment for Rent at Prime Point', 'Modern and spacious serviced apartment with stunning views. Ideal for those looking for comfort and convenience in Cebu City. Walking distance to IT hubs and commercial areas.', 'apartment', '22000.00', '44000.00', 2, 1, '53.00', 23, 'Archbishop Reyes Avenue, Cebu City', 'Cebu City', '10.30660000', '123.90110000', '[\"wifi\",\"balcony\",\"security\",\"laundry\",\"kitchen\",\"rooftop\"]', 'available', 115, FALSE, TRUE, '2026-01-21T10:39:56.000000Z', '2026-01-21T10:39:56.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(42, 33, 'Apartment for Rent at Crystal Court', 'Luxury apartment in an upscale development. Premium finishes and top-notch security. Experience sophisticated urban living at its finest.', 'apartment', '29300.00', '58600.00', 3, 2, '46.00', 32, 'Salinas Drive, Lahug, Cebu City', 'Cebu City', '10.32910000', '123.89330000', '[\"wifi\",\"pool\",\"gym\",\"furnished\",\"balcony\",\"kitchen\"]', 'available', 403, FALSE, TRUE, '2026-01-21T10:39:58.000000Z', '2026-01-21T10:39:58.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(43, 34, 'Apartment for Rent at Pacific Mansion', 'Newly renovated apartment featuring contemporary design. Strategic location with easy access to major roads. Perfect for city living with all amenities nearby.', 'apartment', '15300.00', '15300.00', 3, 2, '37.00', 29, 'Salinas Drive, Lahug, Cebu City', 'Cebu City', '10.32540000', '123.89430000', '[\"furnished\",\"pet_friendly\",\"security\",\"laundry\",\"kitchen\"]', 'available', 172, FALSE, TRUE, '2026-01-21T10:39:59.000000Z', '2026-01-21T10:39:59.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(44, 35, '2-Bedroom Condo for Rent at Sunset Villas', 'Cozy 2-bedroom condo in a prime location. Well-maintained building with friendly management. Great for solo living or couples. Close to schools and hospitals.', 'condo', '50300.00', '50300.00', 2, 1, '77.00', 28, 'Mango Avenue, Cebu City', 'Cebu City', '10.31470000', '123.89080000', '[\"furnished\",\"pet_friendly\",\"laundry\"]', 'available', 80, FALSE, TRUE, '2026-01-21T10:40:00.000000Z', '2026-01-21T10:40:00.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(45, 36, 'Studio Unit for Rent at Crystal Villas', 'Newly renovated studio unit featuring contemporary design. Strategic location with easy access to major roads. Perfect for city living with all amenities nearby.', 'studio', '15300.00', '15300.00', 0, 1, '27.00', 2, 'Mabolo, Cebu City', 'Cebu City', '10.31270000', '123.89840000', '[\"aircon\",\"laundry\",\"rooftop\"]', 'available', 147, FALSE, TRUE, '2026-01-21T10:40:02.000000Z', '2026-01-21T10:40:02.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(46, 37, 'Hotel Room for Rent at Marina Square', 'Cozy hotel room in a prime location. Well-maintained building with friendly management. Great for solo living or couples. Close to schools and hospitals.', 'hotel', '12800.00', '25600.00', 1, 1, '22.00', 28, 'Talamban, Cebu City', 'Cebu City', '10.35280000', '123.91040000', '[\"wifi\",\"aircon\",\"pet_friendly\",\"kitchen\"]', 'available', 76, FALSE, TRUE, '2026-01-21T10:40:03.000000Z', '2026-01-21T10:40:03.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(47, 38, '1-Bedroom Condo for Rent at Horizon Court', 'Beautiful 1-bedroom condo located in the heart of Escario Street. Perfect for young professionals and students. Near malls, restaurants, and public transportation.', 'condo', '24500.00', '24500.00', 1, 1, '31.00', 4, 'Escario Street, Cebu City', 'Cebu City', '10.30590000', '123.89120000', '[\"elevator\",\"security\",\"laundry\",\"rooftop\"]', 'available', 82, FALSE, TRUE, '2026-01-21T10:40:05.000000Z', '2026-01-21T10:40:05.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(48, 39, 'Serviced Apartment for Rent at The Plaza', 'Newly renovated serviced apartment featuring contemporary design. Strategic location with easy access to major roads. Perfect for city living with all amenities nearby.', 'apartment', '23800.00', '23800.00', 2, 2, '54.00', 7, 'Capitol Site, Cebu City', 'Cebu City', '10.31750000', '123.88600000', '[\"pool\",\"parking\",\"pet_friendly\",\"elevator\",\"laundry\",\"rooftop\"]', 'available', 382, FALSE, TRUE, '2026-01-21T10:40:06.000000Z', '2026-01-21T10:40:06.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(49, 40, 'Hotel Room for Rent at Urban Gardens', 'Well-designed hotel room maximizing space and natural light. Located in a developing area with growing commercial establishments. Great investment opportunity.', 'hotel', '26200.00', '26200.00', 1, 1, '40.00', 10, 'Busay, Cebu City', 'Cebu City', '10.30090000', '123.88170000', '[\"laundry\",\"rooftop\"]', 'available', 116, FALSE, TRUE, '2026-01-21T10:40:07.000000Z', '2026-01-21T10:40:07.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(50, 41, '2-Bedroom Condo for Rent at Urban Place', 'Beautiful 2-bedroom condo located in the heart of Baseline Residences. Perfect for young professionals and students. Near malls, restaurants, and public transportation.', 'condo', '40200.00', '40200.00', 2, 1, '56.00', 28, 'Baseline Residences, Capitol Site, Cebu City', 'Cebu City', '10.31270000', '123.89020000', '[\"parking\",\"elevator\",\"laundry\"]', 'available', 54, FALSE, TRUE, '2026-01-21T10:40:08.000000Z', '2026-01-21T10:40:08.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(51, 42, 'Apartment for Rent at Paradise Haven', 'Affordable apartment with complete facilities. Quiet neighborhood yet close to the bustling city center. Ideal for those who value peace and accessibility.', 'apartment', '46000.00', '92000.00', 1, 2, '65.00', 30, 'Ayala Business Park, Cebu City', 'Cebu City', '10.31220000', '123.88150000', '[\"gym\",\"furnished\",\"security\",\"laundry\"]', 'available', 228, FALSE, TRUE, '2026-01-21T10:40:10.000000Z', '2026-01-21T10:40:10.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(52, 43, 'Hotel Room for Rent at Elite Square', 'Affordable hotel room with complete facilities. Quiet neighborhood yet close to the bustling city center. Ideal for those who value peace and accessibility.', 'hotel', '9300.00', '9300.00', 1, 1, '23.00', 20, 'Archbishop Reyes Avenue, Cebu City', 'Cebu City', '10.30870000', '123.89480000', '[\"gym\",\"pet_friendly\",\"elevator\",\"kitchen\"]', 'available', 298, FALSE, TRUE, '2026-01-21T10:40:11.000000Z', '2026-01-21T10:40:11.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(53, 44, 'Serviced Apartment for Rent at Elite Point', 'Luxury serviced apartment in an upscale development. Premium finishes and top-notch security. Experience sophisticated urban living at its finest.', 'apartment', '27100.00', '54200.00', 1, 2, '38.00', 4, 'Capitol Site, Cebu City', 'Cebu City', '10.31960000', '123.88860000', '[\"aircon\",\"pet_friendly\",\"laundry\",\"kitchen\",\"rooftop\"]', 'available', 128, FALSE, TRUE, '2026-01-21T10:40:12.000000Z', '2026-01-21T10:40:12.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(54, 45, 'Studio Unit for Rent at Laguna Heights', 'Cozy studio unit in a prime location. Well-maintained building with friendly management. Great for solo living or couples. Close to schools and hospitals.', 'studio', '22000.00', '22000.00', 0, 1, '35.00', 26, 'Mandaue City (near Cebu City)', 'Cebu City', '10.34450000', '123.93640000', '[\"aircon\",\"gym\",\"furnished\",\"laundry\",\"kitchen\",\"rooftop\"]', 'available', 414, FALSE, TRUE, '2026-01-21T10:40:14.000000Z', '2026-01-21T10:40:14.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(55, 46, '2-Bedroom Condo for Rent at Horizon Lodge', 'Charming 2-bedroom condo with a homey atmosphere. Building has excellent maintenance and responsive admin. Near grocery stores, banks, and cafes.', 'condo', '44700.00', '89400.00', 2, 1, '59.00', 29, 'IT Park, Lahug, Cebu City', 'Cebu City', '10.32700000', '123.91050000', '[\"furnished\",\"kitchen\"]', 'available', 103, FALSE, TRUE, '2026-01-21T10:40:15.000000Z', '2026-01-21T10:40:15.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(56, 47, 'Serviced Apartment for Rent at Oasis Heights', 'Well-designed serviced apartment maximizing space and natural light. Located in a developing area with growing commercial establishments. Great investment opportunity.', 'apartment', '25700.00', '25700.00', 1, 1, '52.00', 9, 'Jones Avenue, Cebu City', 'Cebu City', '10.30790000', '123.89660000', '[\"aircon\",\"parking\",\"balcony\",\"kitchen\"]', 'available', 468, FALSE, TRUE, '2026-01-21T10:40:16.000000Z', '2026-01-21T10:40:16.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(57, 48, '2-Bedroom Condo for Rent at Urban Tower', 'Luxury 2-bedroom condo in an upscale development. Premium finishes and top-notch security. Experience sophisticated urban living at its finest.', 'condo', '49300.00', '49300.00', 2, 2, '78.00', 29, 'Mango Avenue, Cebu City', 'Cebu City', '10.31230000', '123.89430000', '[\"aircon\",\"pool\",\"balcony\",\"kitchen\",\"rooftop\"]', 'available', 52, FALSE, TRUE, '2026-01-21T10:40:18.000000Z', '2026-01-21T10:40:18.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(58, 49, '1-Bedroom Condo for Rent at Crystal Park', 'Modern and spacious 1-bedroom condo with stunning views. Ideal for those looking for comfort and convenience in Cebu City. Walking distance to IT hubs and commercial areas.', 'condo', '21600.00', '21600.00', 1, 1, '47.00', 33, 'Kasambagan, Cebu City', 'Cebu City', '10.31930000', '123.88200000', '[\"wifi\",\"security\"]', 'available', 490, FALSE, TRUE, '2026-01-21T10:40:19.000000Z', '2026-01-21T10:40:19.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(59, 50, 'Hotel Room for Rent at Crown Place', 'Well-designed hotel room maximizing space and natural light. Located in a developing area with growing commercial establishments. Great investment opportunity.', 'hotel', '9200.00', '9200.00', 2, 1, '21.00', 19, 'Nivel Hills, Lahug, Cebu City', 'Cebu City', '10.33170000', '123.89160000', '[\"wifi\",\"pool\",\"laundry\",\"rooftop\"]', 'available', 263, FALSE, TRUE, '2026-01-21T10:40:20.000000Z', '2026-01-21T10:40:20.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(60, 51, 'Serviced Apartment for Rent at Paradise Living', 'Newly renovated serviced apartment featuring contemporary design. Strategic location with easy access to major roads. Perfect for city living with all amenities nearby.', 'apartment', '49000.00', '98000.00', 2, 1, '69.00', 12, 'Gorordo Avenue, Cebu City', 'Cebu City', '10.30970000', '123.89620000', '[\"wifi\",\"furnished\",\"kitchen\"]', 'available', 105, FALSE, TRUE, '2026-01-21T10:40:21.000000Z', '2026-01-21T10:40:21.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(61, 52, 'Apartment for Rent at The Condotel', 'Beautiful apartment located in the heart of Kamputhaw. Perfect for young professionals and students. Near malls, restaurants, and public transportation.', 'apartment', '27000.00', '54000.00', 1, 1, '46.00', 34, 'Kamputhaw, Cebu City', 'Cebu City', '10.30990000', '123.89070000', '[\"aircon\",\"elevator\",\"security\"]', 'available', 353, FALSE, TRUE, '2026-01-21T10:40:23.000000Z', '2026-01-21T10:40:23.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES
(62, 53, 'Hotel Room for Rent at Grand Haven', 'Luxury hotel room in an upscale development. Premium finishes and top-notch security. Experience sophisticated urban living at its finest.', 'hotel', '13500.00', '27000.00', 1, 1, '26.00', 18, 'Nivel Hills, Lahug, Cebu City', 'Cebu City', '10.33190000', '123.89530000', '[\"pool\",\"kitchen\"]', 'available', 368, FALSE, TRUE, '2026-01-21T10:40:24.000000Z', '2026-01-21T10:40:24.000000Z')
ON CONFLICT (id) DO NOTHING;

-- Reset properties sequence
SELECT setval('properties_id_seq', (SELECT MAX(id) FROM properties));

-- ============================================
-- PROPERTY IMAGES (248 records)
-- ============================================

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(1, 1, 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800', TRUE, 0, '2026-01-21T15:53:31.000000Z', '2026-01-21T15:53:31.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(2, 1, 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800', FALSE, 1, '2026-01-21T15:53:31.000000Z', '2026-01-21T15:53:31.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(3, 1, 'https://images.unsplash.com/photo-1560185893-a55cbc8c57e8?w=800', FALSE, 2, '2026-01-21T15:53:32.000000Z', '2026-01-21T15:53:32.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(4, 1, 'https://images.unsplash.com/photo-1552321554-5fefe8c9ef14?w=800', FALSE, 3, '2026-01-21T15:53:32.000000Z', '2026-01-21T15:53:32.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(5, 2, 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800', TRUE, 0, '2026-01-21T15:53:32.000000Z', '2026-01-21T15:53:32.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(6, 2, 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800', FALSE, 1, '2026-01-21T15:53:33.000000Z', '2026-01-21T15:53:33.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(7, 2, 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=800', FALSE, 2, '2026-01-21T15:53:33.000000Z', '2026-01-21T15:53:33.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(8, 2, 'https://images.unsplash.com/photo-1600573472592-401b489a3cdc?w=800', FALSE, 3, '2026-01-21T15:53:33.000000Z', '2026-01-21T15:53:33.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(9, 3, 'https://images.unsplash.com/photo-1560185127-6a8b0f8f7a66?w=800', TRUE, 0, '2026-01-21T15:53:34.000000Z', '2026-01-21T15:53:34.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(10, 3, 'https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=800', FALSE, 1, '2026-01-21T15:53:34.000000Z', '2026-01-21T15:53:34.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(11, 3, 'https://images.unsplash.com/photo-1493809842364-78817add7ffb?w=800', FALSE, 2, '2026-01-21T15:53:34.000000Z', '2026-01-21T15:53:34.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(12, 3, 'https://images.unsplash.com/photo-1484154218962-a197022b5858?w=800', FALSE, 3, '2026-01-21T15:53:35.000000Z', '2026-01-21T15:53:35.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(13, 4, 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800', TRUE, 0, '2026-01-21T15:53:35.000000Z', '2026-01-21T15:53:35.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(14, 4, 'https://images.unsplash.com/photo-1630699144867-37acec97df5a?w=800', FALSE, 1, '2026-01-21T15:53:35.000000Z', '2026-01-21T15:53:35.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(15, 4, 'https://images.unsplash.com/photo-1617325247661-675ab4b64ae2?w=800', FALSE, 2, '2026-01-21T15:53:36.000000Z', '2026-01-21T15:53:36.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(16, 4, 'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=800', FALSE, 3, '2026-01-21T15:53:36.000000Z', '2026-01-21T15:53:36.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(17, 5, 'https://images.unsplash.com/photo-1499793983690-e29da59ef1c2?w=800', TRUE, 0, '2026-01-21T15:53:36.000000Z', '2026-01-21T15:53:36.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(18, 5, 'https://images.unsplash.com/photo-1510798831971-661eb04b3739?w=800', FALSE, 1, '2026-01-21T15:53:37.000000Z', '2026-01-21T15:53:37.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(19, 5, 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800', FALSE, 2, '2026-01-21T15:53:37.000000Z', '2026-01-21T15:53:37.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(20, 5, 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800', FALSE, 3, '2026-01-21T15:53:37.000000Z', '2026-01-21T15:53:37.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(21, 6, 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800', TRUE, 0, '2026-01-21T15:53:38.000000Z', '2026-01-21T15:53:38.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(22, 6, 'https://images.unsplash.com/photo-1502672023488-70e25813eb80?w=800', FALSE, 1, '2026-01-21T15:53:38.000000Z', '2026-01-21T15:53:38.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(23, 6, 'https://images.unsplash.com/photo-1560448204-603b3fc33ddc?w=800', FALSE, 2, '2026-01-21T15:53:38.000000Z', '2026-01-21T15:53:38.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(24, 6, 'https://images.unsplash.com/photo-1574362848149-11496d93a7c7?w=800', FALSE, 3, '2026-01-21T15:53:39.000000Z', '2026-01-21T15:53:39.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(25, 7, 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800', TRUE, 0, '2026-01-21T15:53:39.000000Z', '2026-01-21T15:53:39.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(26, 7, 'https://images.unsplash.com/photo-1598928506311-c55ez365176e?w=800', FALSE, 1, '2026-01-21T15:53:39.000000Z', '2026-01-21T15:53:39.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(27, 7, 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=800', FALSE, 2, '2026-01-21T15:53:40.000000Z', '2026-01-21T15:53:40.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(28, 7, 'https://images.unsplash.com/photo-1616137466211-f939a420be84?w=800', FALSE, 3, '2026-01-21T15:53:40.000000Z', '2026-01-21T15:53:40.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(29, 8, 'https://images.unsplash.com/photo-1536376072261-38c75010e6c9?w=800', TRUE, 0, '2026-01-21T15:53:40.000000Z', '2026-01-21T15:53:40.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(30, 8, 'https://images.unsplash.com/photo-1515263487990-61b07816b324?w=800', FALSE, 1, '2026-01-21T15:53:41.000000Z', '2026-01-21T15:53:41.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(31, 8, 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800', FALSE, 2, '2026-01-21T15:53:41.000000Z', '2026-01-21T15:53:41.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(32, 8, 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?w=800', FALSE, 3, '2026-01-21T15:53:41.000000Z', '2026-01-21T15:53:41.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(33, 9, 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800', TRUE, 0, '2026-01-21T15:53:42.000000Z', '2026-01-21T15:53:42.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(34, 9, 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800', FALSE, 1, '2026-01-21T15:53:42.000000Z', '2026-01-21T15:53:42.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(35, 9, 'https://images.unsplash.com/photo-1560185893-a55cbc8c57e8?w=800', FALSE, 2, '2026-01-21T15:53:42.000000Z', '2026-01-21T15:53:42.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(36, 9, 'https://images.unsplash.com/photo-1552321554-5fefe8c9ef14?w=800', FALSE, 3, '2026-01-21T15:53:43.000000Z', '2026-01-21T15:53:43.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(37, 10, 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800', TRUE, 0, '2026-01-21T15:53:43.000000Z', '2026-01-21T15:53:43.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(38, 10, 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800', FALSE, 1, '2026-01-21T15:53:43.000000Z', '2026-01-21T15:53:43.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(39, 10, 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=800', FALSE, 2, '2026-01-21T15:53:44.000000Z', '2026-01-21T15:53:44.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(40, 10, 'https://images.unsplash.com/photo-1600573472592-401b489a3cdc?w=800', FALSE, 3, '2026-01-21T15:53:44.000000Z', '2026-01-21T15:53:44.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(41, 11, 'https://images.unsplash.com/photo-1560185127-6a8b0f8f7a66?w=800', TRUE, 0, '2026-01-21T15:53:44.000000Z', '2026-01-21T15:53:44.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(42, 11, 'https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=800', FALSE, 1, '2026-01-21T15:53:45.000000Z', '2026-01-21T15:53:45.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(43, 11, 'https://images.unsplash.com/photo-1493809842364-78817add7ffb?w=800', FALSE, 2, '2026-01-21T15:53:45.000000Z', '2026-01-21T15:53:45.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(44, 11, 'https://images.unsplash.com/photo-1484154218962-a197022b5858?w=800', FALSE, 3, '2026-01-21T15:53:45.000000Z', '2026-01-21T15:53:45.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(45, 12, 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800', TRUE, 0, '2026-01-21T15:53:46.000000Z', '2026-01-21T15:53:46.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(46, 12, 'https://images.unsplash.com/photo-1630699144867-37acec97df5a?w=800', FALSE, 1, '2026-01-21T15:53:46.000000Z', '2026-01-21T15:53:46.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(47, 12, 'https://images.unsplash.com/photo-1617325247661-675ab4b64ae2?w=800', FALSE, 2, '2026-01-21T15:53:46.000000Z', '2026-01-21T15:53:46.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(48, 12, 'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=800', FALSE, 3, '2026-01-21T15:53:47.000000Z', '2026-01-21T15:53:47.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(49, 13, 'https://images.unsplash.com/photo-1499793983690-e29da59ef1c2?w=800', TRUE, 0, '2026-01-21T15:53:47.000000Z', '2026-01-21T15:53:47.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(50, 13, 'https://images.unsplash.com/photo-1510798831971-661eb04b3739?w=800', FALSE, 1, '2026-01-21T15:53:47.000000Z', '2026-01-21T15:53:47.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(51, 13, 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800', FALSE, 2, '2026-01-21T15:53:48.000000Z', '2026-01-21T15:53:48.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(52, 13, 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800', FALSE, 3, '2026-01-21T15:53:48.000000Z', '2026-01-21T15:53:48.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(53, 14, 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800', TRUE, 0, '2026-01-21T15:53:48.000000Z', '2026-01-21T15:53:48.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(54, 14, 'https://images.unsplash.com/photo-1502672023488-70e25813eb80?w=800', FALSE, 1, '2026-01-21T15:53:49.000000Z', '2026-01-21T15:53:49.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(55, 14, 'https://images.unsplash.com/photo-1560448204-603b3fc33ddc?w=800', FALSE, 2, '2026-01-21T15:53:49.000000Z', '2026-01-21T15:53:49.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(56, 14, 'https://images.unsplash.com/photo-1574362848149-11496d93a7c7?w=800', FALSE, 3, '2026-01-21T15:53:49.000000Z', '2026-01-21T15:53:49.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(57, 15, 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800', TRUE, 0, '2026-01-21T15:53:50.000000Z', '2026-01-21T15:53:50.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(58, 15, 'https://images.unsplash.com/photo-1598928506311-c55ez365176e?w=800', FALSE, 1, '2026-01-21T15:53:50.000000Z', '2026-01-21T15:53:50.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(59, 15, 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=800', FALSE, 2, '2026-01-21T15:53:51.000000Z', '2026-01-21T15:53:51.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(60, 15, 'https://images.unsplash.com/photo-1616137466211-f939a420be84?w=800', FALSE, 3, '2026-01-21T15:53:51.000000Z', '2026-01-21T15:53:51.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(61, 16, 'https://images.unsplash.com/photo-1536376072261-38c75010e6c9?w=800', TRUE, 0, '2026-01-21T15:53:51.000000Z', '2026-01-21T15:53:51.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(62, 16, 'https://images.unsplash.com/photo-1515263487990-61b07816b324?w=800', FALSE, 1, '2026-01-21T15:53:52.000000Z', '2026-01-21T15:53:52.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(63, 16, 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800', FALSE, 2, '2026-01-21T15:53:52.000000Z', '2026-01-21T15:53:52.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(64, 16, 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?w=800', FALSE, 3, '2026-01-21T15:53:52.000000Z', '2026-01-21T15:53:52.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(65, 17, 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800', TRUE, 0, '2026-01-21T15:53:53.000000Z', '2026-01-21T15:53:53.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(66, 17, 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800', FALSE, 1, '2026-01-21T15:53:53.000000Z', '2026-01-21T15:53:53.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(67, 17, 'https://images.unsplash.com/photo-1560185893-a55cbc8c57e8?w=800', FALSE, 2, '2026-01-21T15:53:53.000000Z', '2026-01-21T15:53:53.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(68, 17, 'https://images.unsplash.com/photo-1552321554-5fefe8c9ef14?w=800', FALSE, 3, '2026-01-21T15:53:54.000000Z', '2026-01-21T15:53:54.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(69, 18, 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800', TRUE, 0, '2026-01-21T15:53:54.000000Z', '2026-01-21T15:53:54.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(70, 18, 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800', FALSE, 1, '2026-01-21T15:53:54.000000Z', '2026-01-21T15:53:54.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(71, 18, 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=800', FALSE, 2, '2026-01-21T15:53:55.000000Z', '2026-01-21T15:53:55.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(72, 18, 'https://images.unsplash.com/photo-1600573472592-401b489a3cdc?w=800', FALSE, 3, '2026-01-21T15:53:55.000000Z', '2026-01-21T15:53:55.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(73, 19, 'https://images.unsplash.com/photo-1560185127-6a8b0f8f7a66?w=800', TRUE, 0, '2026-01-21T15:53:55.000000Z', '2026-01-21T15:53:55.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(74, 19, 'https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=800', FALSE, 1, '2026-01-21T15:53:56.000000Z', '2026-01-21T15:53:56.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(75, 19, 'https://images.unsplash.com/photo-1493809842364-78817add7ffb?w=800', FALSE, 2, '2026-01-21T15:53:56.000000Z', '2026-01-21T15:53:56.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(76, 19, 'https://images.unsplash.com/photo-1484154218962-a197022b5858?w=800', FALSE, 3, '2026-01-21T15:53:56.000000Z', '2026-01-21T15:53:56.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(77, 20, 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800', TRUE, 0, '2026-01-21T15:53:57.000000Z', '2026-01-21T15:53:57.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(78, 20, 'https://images.unsplash.com/photo-1630699144867-37acec97df5a?w=800', FALSE, 1, '2026-01-21T15:53:57.000000Z', '2026-01-21T15:53:57.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(79, 20, 'https://images.unsplash.com/photo-1617325247661-675ab4b64ae2?w=800', FALSE, 2, '2026-01-21T15:53:57.000000Z', '2026-01-21T15:53:57.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(80, 20, 'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=800', FALSE, 3, '2026-01-21T15:53:58.000000Z', '2026-01-21T15:53:58.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(81, 21, 'https://images.unsplash.com/photo-1499793983690-e29da59ef1c2?w=800', TRUE, 0, '2026-01-21T15:53:58.000000Z', '2026-01-21T15:53:58.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(82, 21, 'https://images.unsplash.com/photo-1510798831971-661eb04b3739?w=800', FALSE, 1, '2026-01-21T15:53:58.000000Z', '2026-01-21T15:53:58.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(83, 21, 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800', FALSE, 2, '2026-01-21T15:53:59.000000Z', '2026-01-21T15:53:59.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(84, 21, 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800', FALSE, 3, '2026-01-21T15:53:59.000000Z', '2026-01-21T15:53:59.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(85, 22, 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800', TRUE, 0, '2026-01-21T15:53:59.000000Z', '2026-01-21T15:53:59.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(86, 22, 'https://images.unsplash.com/photo-1502672023488-70e25813eb80?w=800', FALSE, 1, '2026-01-21T15:54:00.000000Z', '2026-01-21T15:54:00.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(87, 22, 'https://images.unsplash.com/photo-1560448204-603b3fc33ddc?w=800', FALSE, 2, '2026-01-21T15:54:00.000000Z', '2026-01-21T15:54:00.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(88, 22, 'https://images.unsplash.com/photo-1574362848149-11496d93a7c7?w=800', FALSE, 3, '2026-01-21T15:54:00.000000Z', '2026-01-21T15:54:00.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(89, 23, 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800', TRUE, 0, '2026-01-21T15:54:01.000000Z', '2026-01-21T15:54:01.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(90, 23, 'https://images.unsplash.com/photo-1598928506311-c55ez365176e?w=800', FALSE, 1, '2026-01-21T15:54:01.000000Z', '2026-01-21T15:54:01.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(91, 23, 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=800', FALSE, 2, '2026-01-21T15:54:01.000000Z', '2026-01-21T15:54:01.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(92, 23, 'https://images.unsplash.com/photo-1616137466211-f939a420be84?w=800', FALSE, 3, '2026-01-21T15:54:02.000000Z', '2026-01-21T15:54:02.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(93, 24, 'https://images.unsplash.com/photo-1536376072261-38c75010e6c9?w=800', TRUE, 0, '2026-01-21T15:54:02.000000Z', '2026-01-21T15:54:02.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(94, 24, 'https://images.unsplash.com/photo-1515263487990-61b07816b324?w=800', FALSE, 1, '2026-01-21T15:54:02.000000Z', '2026-01-21T15:54:02.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(95, 24, 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800', FALSE, 2, '2026-01-21T15:54:03.000000Z', '2026-01-21T15:54:03.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(96, 24, 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?w=800', FALSE, 3, '2026-01-21T15:54:03.000000Z', '2026-01-21T15:54:03.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(97, 25, 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800', TRUE, 0, '2026-01-21T15:54:03.000000Z', '2026-01-21T15:54:03.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(98, 25, 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800', FALSE, 1, '2026-01-21T15:54:04.000000Z', '2026-01-21T15:54:04.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(99, 25, 'https://images.unsplash.com/photo-1560185893-a55cbc8c57e8?w=800', FALSE, 2, '2026-01-21T15:54:04.000000Z', '2026-01-21T15:54:04.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(100, 25, 'https://images.unsplash.com/photo-1552321554-5fefe8c9ef14?w=800', FALSE, 3, '2026-01-21T15:54:04.000000Z', '2026-01-21T15:54:04.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(101, 26, 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800', TRUE, 0, '2026-01-21T15:54:05.000000Z', '2026-01-21T15:54:05.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(102, 26, 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800', FALSE, 1, '2026-01-21T15:54:05.000000Z', '2026-01-21T15:54:05.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(103, 26, 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=800', FALSE, 2, '2026-01-21T15:54:05.000000Z', '2026-01-21T15:54:05.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(104, 26, 'https://images.unsplash.com/photo-1600573472592-401b489a3cdc?w=800', FALSE, 3, '2026-01-21T15:54:06.000000Z', '2026-01-21T15:54:06.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(105, 27, 'https://images.unsplash.com/photo-1560185127-6a8b0f8f7a66?w=800', TRUE, 0, '2026-01-21T15:54:06.000000Z', '2026-01-21T15:54:06.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(106, 27, 'https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=800', FALSE, 1, '2026-01-21T15:54:06.000000Z', '2026-01-21T15:54:06.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(107, 27, 'https://images.unsplash.com/photo-1493809842364-78817add7ffb?w=800', FALSE, 2, '2026-01-21T15:54:07.000000Z', '2026-01-21T15:54:07.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(108, 27, 'https://images.unsplash.com/photo-1484154218962-a197022b5858?w=800', FALSE, 3, '2026-01-21T15:54:07.000000Z', '2026-01-21T15:54:07.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(109, 28, 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800', TRUE, 0, '2026-01-21T15:54:07.000000Z', '2026-01-21T15:54:07.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(110, 28, 'https://images.unsplash.com/photo-1630699144867-37acec97df5a?w=800', FALSE, 1, '2026-01-21T15:54:08.000000Z', '2026-01-21T15:54:08.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(111, 28, 'https://images.unsplash.com/photo-1617325247661-675ab4b64ae2?w=800', FALSE, 2, '2026-01-21T15:54:08.000000Z', '2026-01-21T15:54:08.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(112, 28, 'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=800', FALSE, 3, '2026-01-21T15:54:08.000000Z', '2026-01-21T15:54:08.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(113, 29, 'https://images.unsplash.com/photo-1499793983690-e29da59ef1c2?w=800', TRUE, 0, '2026-01-21T15:54:09.000000Z', '2026-01-21T15:54:09.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(114, 29, 'https://images.unsplash.com/photo-1510798831971-661eb04b3739?w=800', FALSE, 1, '2026-01-21T15:54:09.000000Z', '2026-01-21T15:54:09.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(115, 29, 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800', FALSE, 2, '2026-01-21T15:54:09.000000Z', '2026-01-21T15:54:09.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(116, 29, 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800', FALSE, 3, '2026-01-21T15:54:10.000000Z', '2026-01-21T15:54:10.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(117, 30, 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800', TRUE, 0, '2026-01-21T15:54:10.000000Z', '2026-01-21T15:54:10.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(118, 30, 'https://images.unsplash.com/photo-1502672023488-70e25813eb80?w=800', FALSE, 1, '2026-01-21T15:54:10.000000Z', '2026-01-21T15:54:10.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(119, 30, 'https://images.unsplash.com/photo-1560448204-603b3fc33ddc?w=800', FALSE, 2, '2026-01-21T15:54:11.000000Z', '2026-01-21T15:54:11.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(120, 30, 'https://images.unsplash.com/photo-1574362848149-11496d93a7c7?w=800', FALSE, 3, '2026-01-21T15:54:11.000000Z', '2026-01-21T15:54:11.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(121, 31, 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800', TRUE, 0, '2026-01-21T15:54:11.000000Z', '2026-01-21T15:54:11.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(122, 31, 'https://images.unsplash.com/photo-1598928506311-c55ez365176e?w=800', FALSE, 1, '2026-01-21T15:54:12.000000Z', '2026-01-21T15:54:12.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(123, 31, 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=800', FALSE, 2, '2026-01-21T15:54:12.000000Z', '2026-01-21T15:54:12.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(124, 31, 'https://images.unsplash.com/photo-1616137466211-f939a420be84?w=800', FALSE, 3, '2026-01-21T15:54:12.000000Z', '2026-01-21T15:54:12.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(125, 32, 'https://images.unsplash.com/photo-1536376072261-38c75010e6c9?w=800', TRUE, 0, '2026-01-21T15:54:13.000000Z', '2026-01-21T15:54:13.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(126, 32, 'https://images.unsplash.com/photo-1515263487990-61b07816b324?w=800', FALSE, 1, '2026-01-21T15:54:13.000000Z', '2026-01-21T15:54:13.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(127, 32, 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800', FALSE, 2, '2026-01-21T15:54:14.000000Z', '2026-01-21T15:54:14.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(128, 32, 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?w=800', FALSE, 3, '2026-01-21T15:54:14.000000Z', '2026-01-21T15:54:14.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(129, 33, 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800', TRUE, 0, '2026-01-21T15:54:14.000000Z', '2026-01-21T15:54:14.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(130, 33, 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800', FALSE, 1, '2026-01-21T15:54:15.000000Z', '2026-01-21T15:54:15.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(131, 33, 'https://images.unsplash.com/photo-1560185893-a55cbc8c57e8?w=800', FALSE, 2, '2026-01-21T15:54:15.000000Z', '2026-01-21T15:54:15.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(132, 33, 'https://images.unsplash.com/photo-1552321554-5fefe8c9ef14?w=800', FALSE, 3, '2026-01-21T15:54:15.000000Z', '2026-01-21T15:54:15.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(133, 34, 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800', TRUE, 0, '2026-01-21T15:54:16.000000Z', '2026-01-21T15:54:16.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(134, 34, 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800', FALSE, 1, '2026-01-21T15:54:16.000000Z', '2026-01-21T15:54:16.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(135, 34, 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=800', FALSE, 2, '2026-01-21T15:54:16.000000Z', '2026-01-21T15:54:16.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(136, 34, 'https://images.unsplash.com/photo-1600573472592-401b489a3cdc?w=800', FALSE, 3, '2026-01-21T15:54:17.000000Z', '2026-01-21T15:54:17.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(137, 35, 'https://images.unsplash.com/photo-1560185127-6a8b0f8f7a66?w=800', TRUE, 0, '2026-01-21T15:54:17.000000Z', '2026-01-21T15:54:17.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(138, 35, 'https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=800', FALSE, 1, '2026-01-21T15:54:17.000000Z', '2026-01-21T15:54:17.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(139, 35, 'https://images.unsplash.com/photo-1493809842364-78817add7ffb?w=800', FALSE, 2, '2026-01-21T15:54:18.000000Z', '2026-01-21T15:54:18.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(140, 35, 'https://images.unsplash.com/photo-1484154218962-a197022b5858?w=800', FALSE, 3, '2026-01-21T15:54:18.000000Z', '2026-01-21T15:54:18.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(141, 36, 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800', TRUE, 0, '2026-01-21T15:54:18.000000Z', '2026-01-21T15:54:18.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(142, 36, 'https://images.unsplash.com/photo-1630699144867-37acec97df5a?w=800', FALSE, 1, '2026-01-21T15:54:19.000000Z', '2026-01-21T15:54:19.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(143, 36, 'https://images.unsplash.com/photo-1617325247661-675ab4b64ae2?w=800', FALSE, 2, '2026-01-21T15:54:19.000000Z', '2026-01-21T15:54:19.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(144, 36, 'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=800', FALSE, 3, '2026-01-21T15:54:19.000000Z', '2026-01-21T15:54:19.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(145, 37, 'https://images.unsplash.com/photo-1499793983690-e29da59ef1c2?w=800', TRUE, 0, '2026-01-21T15:54:20.000000Z', '2026-01-21T15:54:20.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(146, 37, 'https://images.unsplash.com/photo-1510798831971-661eb04b3739?w=800', FALSE, 1, '2026-01-21T15:54:20.000000Z', '2026-01-21T15:54:20.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(147, 37, 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800', FALSE, 2, '2026-01-21T15:54:20.000000Z', '2026-01-21T15:54:20.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(148, 37, 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800', FALSE, 3, '2026-01-21T15:54:21.000000Z', '2026-01-21T15:54:21.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(149, 38, 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800', TRUE, 0, '2026-01-21T15:54:21.000000Z', '2026-01-21T15:54:21.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(150, 38, 'https://images.unsplash.com/photo-1502672023488-70e25813eb80?w=800', FALSE, 1, '2026-01-21T15:54:21.000000Z', '2026-01-21T15:54:21.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(151, 38, 'https://images.unsplash.com/photo-1560448204-603b3fc33ddc?w=800', FALSE, 2, '2026-01-21T15:54:22.000000Z', '2026-01-21T15:54:22.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(152, 38, 'https://images.unsplash.com/photo-1574362848149-11496d93a7c7?w=800', FALSE, 3, '2026-01-21T15:54:22.000000Z', '2026-01-21T15:54:22.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(153, 39, 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800', TRUE, 0, '2026-01-21T15:54:22.000000Z', '2026-01-21T15:54:22.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(154, 39, 'https://images.unsplash.com/photo-1598928506311-c55ez365176e?w=800', FALSE, 1, '2026-01-21T15:54:23.000000Z', '2026-01-21T15:54:23.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(155, 39, 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=800', FALSE, 2, '2026-01-21T15:54:23.000000Z', '2026-01-21T15:54:23.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(156, 39, 'https://images.unsplash.com/photo-1616137466211-f939a420be84?w=800', FALSE, 3, '2026-01-21T15:54:23.000000Z', '2026-01-21T15:54:23.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(157, 40, 'https://images.unsplash.com/photo-1536376072261-38c75010e6c9?w=800', TRUE, 0, '2026-01-21T15:54:24.000000Z', '2026-01-21T15:54:24.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(158, 40, 'https://images.unsplash.com/photo-1515263487990-61b07816b324?w=800', FALSE, 1, '2026-01-21T15:54:24.000000Z', '2026-01-21T15:54:24.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(159, 40, 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800', FALSE, 2, '2026-01-21T15:54:24.000000Z', '2026-01-21T15:54:24.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(160, 40, 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?w=800', FALSE, 3, '2026-01-21T15:54:25.000000Z', '2026-01-21T15:54:25.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(161, 41, 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800', TRUE, 0, '2026-01-21T15:54:25.000000Z', '2026-01-21T15:54:25.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(162, 41, 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800', FALSE, 1, '2026-01-21T15:54:25.000000Z', '2026-01-21T15:54:25.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(163, 41, 'https://images.unsplash.com/photo-1560185893-a55cbc8c57e8?w=800', FALSE, 2, '2026-01-21T15:54:26.000000Z', '2026-01-21T15:54:26.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(164, 41, 'https://images.unsplash.com/photo-1552321554-5fefe8c9ef14?w=800', FALSE, 3, '2026-01-21T15:54:26.000000Z', '2026-01-21T15:54:26.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(165, 42, 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800', TRUE, 0, '2026-01-21T15:54:26.000000Z', '2026-01-21T15:54:26.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(166, 42, 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800', FALSE, 1, '2026-01-21T15:54:27.000000Z', '2026-01-21T15:54:27.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(167, 42, 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=800', FALSE, 2, '2026-01-21T15:54:27.000000Z', '2026-01-21T15:54:27.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(168, 42, 'https://images.unsplash.com/photo-1600573472592-401b489a3cdc?w=800', FALSE, 3, '2026-01-21T15:54:27.000000Z', '2026-01-21T15:54:27.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(169, 43, 'https://images.unsplash.com/photo-1560185127-6a8b0f8f7a66?w=800', TRUE, 0, '2026-01-21T15:54:28.000000Z', '2026-01-21T15:54:28.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(170, 43, 'https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=800', FALSE, 1, '2026-01-21T15:54:28.000000Z', '2026-01-21T15:54:28.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(171, 43, 'https://images.unsplash.com/photo-1493809842364-78817add7ffb?w=800', FALSE, 2, '2026-01-21T15:54:28.000000Z', '2026-01-21T15:54:28.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(172, 43, 'https://images.unsplash.com/photo-1484154218962-a197022b5858?w=800', FALSE, 3, '2026-01-21T15:54:29.000000Z', '2026-01-21T15:54:29.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(173, 44, 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800', TRUE, 0, '2026-01-21T15:54:29.000000Z', '2026-01-21T15:54:29.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(174, 44, 'https://images.unsplash.com/photo-1630699144867-37acec97df5a?w=800', FALSE, 1, '2026-01-21T15:54:29.000000Z', '2026-01-21T15:54:29.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(175, 44, 'https://images.unsplash.com/photo-1617325247661-675ab4b64ae2?w=800', FALSE, 2, '2026-01-21T15:54:30.000000Z', '2026-01-21T15:54:30.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(176, 44, 'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=800', FALSE, 3, '2026-01-21T15:54:30.000000Z', '2026-01-21T15:54:30.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(177, 45, 'https://images.unsplash.com/photo-1499793983690-e29da59ef1c2?w=800', TRUE, 0, '2026-01-21T15:54:30.000000Z', '2026-01-21T15:54:30.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(178, 45, 'https://images.unsplash.com/photo-1510798831971-661eb04b3739?w=800', FALSE, 1, '2026-01-21T15:54:31.000000Z', '2026-01-21T15:54:31.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(179, 45, 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800', FALSE, 2, '2026-01-21T15:54:31.000000Z', '2026-01-21T15:54:31.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(180, 45, 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800', FALSE, 3, '2026-01-21T15:54:31.000000Z', '2026-01-21T15:54:31.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(181, 46, 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800', TRUE, 0, '2026-01-21T15:54:32.000000Z', '2026-01-21T15:54:32.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(182, 46, 'https://images.unsplash.com/photo-1502672023488-70e25813eb80?w=800', FALSE, 1, '2026-01-21T15:54:32.000000Z', '2026-01-21T15:54:32.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(183, 46, 'https://images.unsplash.com/photo-1560448204-603b3fc33ddc?w=800', FALSE, 2, '2026-01-21T15:54:32.000000Z', '2026-01-21T15:54:32.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(184, 46, 'https://images.unsplash.com/photo-1574362848149-11496d93a7c7?w=800', FALSE, 3, '2026-01-21T15:54:33.000000Z', '2026-01-21T15:54:33.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(185, 47, 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800', TRUE, 0, '2026-01-21T15:54:33.000000Z', '2026-01-21T15:54:33.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(186, 47, 'https://images.unsplash.com/photo-1598928506311-c55ez365176e?w=800', FALSE, 1, '2026-01-21T15:54:33.000000Z', '2026-01-21T15:54:33.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(187, 47, 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=800', FALSE, 2, '2026-01-21T15:54:34.000000Z', '2026-01-21T15:54:34.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(188, 47, 'https://images.unsplash.com/photo-1616137466211-f939a420be84?w=800', FALSE, 3, '2026-01-21T15:54:34.000000Z', '2026-01-21T15:54:34.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(189, 48, 'https://images.unsplash.com/photo-1536376072261-38c75010e6c9?w=800', TRUE, 0, '2026-01-21T15:54:34.000000Z', '2026-01-21T15:54:34.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(190, 48, 'https://images.unsplash.com/photo-1515263487990-61b07816b324?w=800', FALSE, 1, '2026-01-21T15:54:35.000000Z', '2026-01-21T15:54:35.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(191, 48, 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800', FALSE, 2, '2026-01-21T15:54:35.000000Z', '2026-01-21T15:54:35.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(192, 48, 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?w=800', FALSE, 3, '2026-01-21T15:54:36.000000Z', '2026-01-21T15:54:36.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(193, 49, 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800', TRUE, 0, '2026-01-21T15:54:36.000000Z', '2026-01-21T15:54:36.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(194, 49, 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800', FALSE, 1, '2026-01-21T15:54:36.000000Z', '2026-01-21T15:54:36.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(195, 49, 'https://images.unsplash.com/photo-1560185893-a55cbc8c57e8?w=800', FALSE, 2, '2026-01-21T15:54:37.000000Z', '2026-01-21T15:54:37.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(196, 49, 'https://images.unsplash.com/photo-1552321554-5fefe8c9ef14?w=800', FALSE, 3, '2026-01-21T15:54:37.000000Z', '2026-01-21T15:54:37.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(197, 50, 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800', TRUE, 0, '2026-01-21T15:54:37.000000Z', '2026-01-21T15:54:37.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(198, 50, 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800', FALSE, 1, '2026-01-21T15:54:38.000000Z', '2026-01-21T15:54:38.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(199, 50, 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=800', FALSE, 2, '2026-01-21T15:54:38.000000Z', '2026-01-21T15:54:38.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(200, 50, 'https://images.unsplash.com/photo-1600573472592-401b489a3cdc?w=800', FALSE, 3, '2026-01-21T15:54:38.000000Z', '2026-01-21T15:54:38.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(201, 51, 'https://images.unsplash.com/photo-1560185127-6a8b0f8f7a66?w=800', TRUE, 0, '2026-01-21T15:54:39.000000Z', '2026-01-21T15:54:39.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(202, 51, 'https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=800', FALSE, 1, '2026-01-21T15:54:39.000000Z', '2026-01-21T15:54:39.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(203, 51, 'https://images.unsplash.com/photo-1493809842364-78817add7ffb?w=800', FALSE, 2, '2026-01-21T15:54:39.000000Z', '2026-01-21T15:54:39.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(204, 51, 'https://images.unsplash.com/photo-1484154218962-a197022b5858?w=800', FALSE, 3, '2026-01-21T15:54:40.000000Z', '2026-01-21T15:54:40.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(205, 52, 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800', TRUE, 0, '2026-01-21T15:54:40.000000Z', '2026-01-21T15:54:40.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(206, 52, 'https://images.unsplash.com/photo-1630699144867-37acec97df5a?w=800', FALSE, 1, '2026-01-21T15:54:40.000000Z', '2026-01-21T15:54:40.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(207, 52, 'https://images.unsplash.com/photo-1617325247661-675ab4b64ae2?w=800', FALSE, 2, '2026-01-21T15:54:41.000000Z', '2026-01-21T15:54:41.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(208, 52, 'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=800', FALSE, 3, '2026-01-21T15:54:41.000000Z', '2026-01-21T15:54:41.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(209, 53, 'https://images.unsplash.com/photo-1499793983690-e29da59ef1c2?w=800', TRUE, 0, '2026-01-21T15:54:41.000000Z', '2026-01-21T15:54:41.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(210, 53, 'https://images.unsplash.com/photo-1510798831971-661eb04b3739?w=800', FALSE, 1, '2026-01-21T15:54:42.000000Z', '2026-01-21T15:54:42.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(211, 53, 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800', FALSE, 2, '2026-01-21T15:54:42.000000Z', '2026-01-21T15:54:42.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(212, 53, 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800', FALSE, 3, '2026-01-21T15:54:42.000000Z', '2026-01-21T15:54:42.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(213, 54, 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800', TRUE, 0, '2026-01-21T15:54:43.000000Z', '2026-01-21T15:54:43.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(214, 54, 'https://images.unsplash.com/photo-1502672023488-70e25813eb80?w=800', FALSE, 1, '2026-01-21T15:54:43.000000Z', '2026-01-21T15:54:43.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(215, 54, 'https://images.unsplash.com/photo-1560448204-603b3fc33ddc?w=800', FALSE, 2, '2026-01-21T15:54:43.000000Z', '2026-01-21T15:54:43.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(216, 54, 'https://images.unsplash.com/photo-1574362848149-11496d93a7c7?w=800', FALSE, 3, '2026-01-21T15:54:44.000000Z', '2026-01-21T15:54:44.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(217, 55, 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800', TRUE, 0, '2026-01-21T15:54:44.000000Z', '2026-01-21T15:54:44.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(218, 55, 'https://images.unsplash.com/photo-1598928506311-c55ez365176e?w=800', FALSE, 1, '2026-01-21T15:54:44.000000Z', '2026-01-21T15:54:44.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(219, 55, 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=800', FALSE, 2, '2026-01-21T15:54:45.000000Z', '2026-01-21T15:54:45.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(220, 55, 'https://images.unsplash.com/photo-1616137466211-f939a420be84?w=800', FALSE, 3, '2026-01-21T15:54:45.000000Z', '2026-01-21T15:54:45.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(221, 56, 'https://images.unsplash.com/photo-1536376072261-38c75010e6c9?w=800', TRUE, 0, '2026-01-21T15:54:45.000000Z', '2026-01-21T15:54:45.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(222, 56, 'https://images.unsplash.com/photo-1515263487990-61b07816b324?w=800', FALSE, 1, '2026-01-21T15:54:46.000000Z', '2026-01-21T15:54:46.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(223, 56, 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800', FALSE, 2, '2026-01-21T15:54:46.000000Z', '2026-01-21T15:54:46.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(224, 56, 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?w=800', FALSE, 3, '2026-01-21T15:54:46.000000Z', '2026-01-21T15:54:46.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(225, 57, 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800', TRUE, 0, '2026-01-21T15:54:47.000000Z', '2026-01-21T15:54:47.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(226, 57, 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800', FALSE, 1, '2026-01-21T15:54:47.000000Z', '2026-01-21T15:54:47.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(227, 57, 'https://images.unsplash.com/photo-1560185893-a55cbc8c57e8?w=800', FALSE, 2, '2026-01-21T15:54:47.000000Z', '2026-01-21T15:54:47.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(228, 57, 'https://images.unsplash.com/photo-1552321554-5fefe8c9ef14?w=800', FALSE, 3, '2026-01-21T15:54:48.000000Z', '2026-01-21T15:54:48.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(229, 58, 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800', TRUE, 0, '2026-01-21T15:54:48.000000Z', '2026-01-21T15:54:48.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(230, 58, 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800', FALSE, 1, '2026-01-21T15:54:48.000000Z', '2026-01-21T15:54:48.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(231, 58, 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=800', FALSE, 2, '2026-01-21T15:54:49.000000Z', '2026-01-21T15:54:49.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(232, 58, 'https://images.unsplash.com/photo-1600573472592-401b489a3cdc?w=800', FALSE, 3, '2026-01-21T15:54:49.000000Z', '2026-01-21T15:54:49.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(233, 59, 'https://images.unsplash.com/photo-1560185127-6a8b0f8f7a66?w=800', TRUE, 0, '2026-01-21T15:54:49.000000Z', '2026-01-21T15:54:49.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(234, 59, 'https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=800', FALSE, 1, '2026-01-21T15:54:50.000000Z', '2026-01-21T15:54:50.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(235, 59, 'https://images.unsplash.com/photo-1493809842364-78817add7ffb?w=800', FALSE, 2, '2026-01-21T15:54:50.000000Z', '2026-01-21T15:54:50.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(236, 59, 'https://images.unsplash.com/photo-1484154218962-a197022b5858?w=800', FALSE, 3, '2026-01-21T15:54:50.000000Z', '2026-01-21T15:54:50.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(237, 60, 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800', TRUE, 0, '2026-01-21T15:54:51.000000Z', '2026-01-21T15:54:51.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(238, 60, 'https://images.unsplash.com/photo-1630699144867-37acec97df5a?w=800', FALSE, 1, '2026-01-21T15:54:51.000000Z', '2026-01-21T15:54:51.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(239, 60, 'https://images.unsplash.com/photo-1617325247661-675ab4b64ae2?w=800', FALSE, 2, '2026-01-21T15:54:51.000000Z', '2026-01-21T15:54:51.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(240, 60, 'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=800', FALSE, 3, '2026-01-21T15:54:52.000000Z', '2026-01-21T15:54:52.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(241, 61, 'https://images.unsplash.com/photo-1499793983690-e29da59ef1c2?w=800', TRUE, 0, '2026-01-21T15:54:52.000000Z', '2026-01-21T15:54:52.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(242, 61, 'https://images.unsplash.com/photo-1510798831971-661eb04b3739?w=800', FALSE, 1, '2026-01-21T15:54:52.000000Z', '2026-01-21T15:54:52.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(243, 61, 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800', FALSE, 2, '2026-01-21T15:54:53.000000Z', '2026-01-21T15:54:53.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(244, 61, 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800', FALSE, 3, '2026-01-21T15:54:53.000000Z', '2026-01-21T15:54:53.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(245, 62, 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800', TRUE, 0, '2026-01-21T15:54:53.000000Z', '2026-01-21T15:54:53.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(246, 62, 'https://images.unsplash.com/photo-1502672023488-70e25813eb80?w=800', FALSE, 1, '2026-01-21T15:54:54.000000Z', '2026-01-21T15:54:54.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(247, 62, 'https://images.unsplash.com/photo-1560448204-603b3fc33ddc?w=800', FALSE, 2, '2026-01-21T15:54:54.000000Z', '2026-01-21T15:54:54.000000Z')
ON CONFLICT (id) DO NOTHING;

INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES
(248, 62, 'https://images.unsplash.com/photo-1574362848149-11496d93a7c7?w=800', FALSE, 3, '2026-01-21T15:54:54.000000Z', '2026-01-21T15:54:54.000000Z')
ON CONFLICT (id) DO NOTHING;

-- Reset property_images sequence
SELECT setval('property_images_id_seq', (SELECT MAX(id) FROM property_images));

-- ============================================
-- DATA IMPORT COMPLETE!
-- ============================================
