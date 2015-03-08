INSERT INTO companies VALUES 
(10001, 'Capture Dental Arts', '1234 S 2400 E', 'Suite F', 'Pleasant Grove', 'UT', '84112', 'USA', '801-555-4564', 'Jessica Birrell'),
(10002, 'Sparkling White Dental Implants', '9876 West Dover', null, 'New York City', 'NY', '44573', 'USA', '212-555-1234', 'Danny Birrell'),
(10003, 'Smith and Wesson Dental', '3006 Remington Ave', 'Suite 22', 'Albuquerque', 'NM', '87101', 'USA', '505-555-4564', 'Doc Holliday');

INSERT INTO licenses VALUES
(1, 'L57QQSSMJZ6BHJ9HTYZI', 25, '2015-01-16 14:05:23', 365, 10001),
(2, 'AL9HSUKN468UOL6OVBTK', 25, '2015-01-16 14:05:23', 365, 10002);

INSERT INTO labs VALUES
(10001, 'Capture Dental Arts', '1234 S 2400 E', 'Suite F', 'Pleasant Grove', 'UT', '84112', 'USA', '801-555-4564', 'Jessica Birrell', 10001),
(10002, 'Sparkling White Dental Implants', '9876 West Dover', null, 'New York City', 'NY', '44573', 'USA', '212-555-1234', 'Danny Birrell', 10002),
(10003, 'Small Dental Arts', '1234 S 2400 E', null, 'Saint George', 'UT', '84115', 'USA', '801-555-7784', 'Kirk Love', 10001);

INSERT INTO users VALUES
(10001, 'jbirrell', 'jessica.password', null, 'Jessica', 'Birrell', 'jbirrell@example.com', '801-555-4457', 'uploads/users/10001/10001', 10001),
(10002, 'dbirrell', 'danny.password', 'Mr.', 'Danny', 'Birrell', 'dbirrell@example.com', '212-555-4447', 'uploads/users/10002/10002', 10002),
(10003, 'klove', 'kirk.password', null, 'Kirk', 'Love', 'klove@example.com', '505-555-4879', 'uploads/users/10003/10003', 10003),
(10004, 'bkid', 'billy.password', null, 'Billy', 'Kid', 'bkid@example.com', '801-555-7748', 'uploads/users/10001/10004', 10001),
(10005, 'hsolo', 'hope.password', null, 'Hope', 'Solo', 'hsolo@example.com', '801-555-1245', 'uploads/users/10001/10005', 10001);

INSERT INTO user_roles VALUES
(1, 'SuperAdmin'),
(2, 'QCAdmin'),
(3, 'Technician');

INSERT INTO user_role_map VALUES 
(10001, 1),
(10001, 2),
(10001, 3),
(10002, 1),
(10002, 2),
(10003, 1),
(10004, 1),
(10005, 2);

INSERT INTO user_lab_map VALUES
(10001,10001),
(10002,10002),
(10001, 10003),
(10004, 10001),
(10005, 10003);

INSERT INTO cases VALUES
(1, 'CDA-456-ASDF971', null, 10001),
(2, 'CDA-456-ASDF877', null, 10001),
(3, 'CDA-456-987ASDE', null, 10001),
(4, 'CDA-456-87FDS96', null, 10001),
(5, 'CDA-456-124REWE', null, 10001),
(6, 'CDA-456-842SF74', null, 10001),
(7, 'XDD-889F-A897S6', null, 10002),
(8, 'XDD-889F-ASDF78', null, 10002),
(9, 'XDD-889F-AS57D9', null, 10002),
(10, 'XDD-889F-HJK458', null, 10002),
(11, 'XDD-889F-HU87SS', null, 10002),
(12, 'CDA-995-8ER796G', null, 10003),
(13, 'CDA-995-AKDU876', null, 10003),
(14, 'CDA-995-298VME9', null, 10003),
(15, 'CDA-456-2LJKV89', null, 10001);

INSERT INTO departments VALUES
(1, 'Drivers', '#00CC00', null, 10001),
(2, 'Model', '#00CC00', null, 10001),
(3, 'Wax', '#00CC00', null, 10001),
(4, 'Press', '#00CC00', null, 10001),
(5, 'Digital Design', '#00CC00', null, 10001),
(6, 'Porcelain', '#00CC00', null, 10001),
(7, 'Metal', '#00CC00', null, 10001),
(8, 'Removable', '#00CC00', null, 10001),
(9, 'Client', '#00CC00', null, 10001),
(10, 'Implant', '#00CC00', null, 10001),
(11, 'QC', '#00CC00', null, 10001),
(12, 'Admin', '#00CC00', null, 10001),
(13, 'Drivers', '#00CC00', null, 10002),
(14, 'Model', '#00CC00', null, 10002),
(15, 'Wax', '#00CC00', null, 10002),
(16, 'Press', '#00CC00', null, 10002),
(17, 'Digital Design', '#00CC00', null, 10002),
(18, 'Porcelain', '#00CC00', null, 10002),
(19, 'Metal', '#00CC00', null, 10002),
(20, 'Removable', '#00CC00', null, 10002),
(21, 'Client', '#00CC00', null, 10002),
(22, 'Implant', '#00CC00', null, 10002),
(23, 'QC', '#00CC00', null, 10002),
(24, 'Admin', '#00CC00', null, 10002),
(25, 'Drivers', '#00CC00', null, 10003),
(26, 'Model', '#00CC00', null, 10003),
(27, 'Wax', '#00CC00', null, 10003),
(28, 'Press', '#00CC00', null, 10003),
(29, 'Digital Design', '#00CC00', null, 10003),
(30, 'Porcelain', '#00CC00', null, 10003),
(31, 'Metal', '#00CC00', null, 10003),
(28, 'Removable', '#00CC00', null, 10003),
(29, 'Client', '#00CC00', null, 10003),
(30, 'Implant', '#00CC00', null, 10003),
(31, 'QC', '#00CC00', null, 10003),
(32, 'Admin', '#00CC00', null, 10003);

INSERT INTO teeth VALUES
(1, 1, null, 5),
(2, 4, null, 5),
(3, 24, null, 5),
(4, 9, null, 7),
(5, 2, null, 1),
(6, 1, null, 2),
(7, 7, null, 3),
(8, 7, null, 4),
(9, 26, null, 5),
(10, 28, null, 6),
(11, 23, null, 7),
(12, 14, null, 7),
(13, 19, null, 8),
(14, 1, null, 9),
(15, 10, null, 10),
(16, 11, null, 11),
(17, 16, null, 12),
(18, 10, null, 13),
(19, 9, null, 14),
(20, 8, null, 15),
(21, 1, null, 7);

INSERT INTO rating_meta VALUES
(1, 'On Time', 0, 1),
(2, 'Friendly', 0, 1),
(3, 'Professional Appearance', 0, 1),
(4, 'Organized', 0, 1),
(5, 'Maintains Company Vehicle', 0, 1),
(6, 'Manages Time Wisely', 0, 1),
(7, 'Accurate Pours', 0, 2),
(8, 'Pins Placed Correctly', 0, 2),
(9, 'Models Properly Trimmed', 0, 2),
(10, 'Overall Appearance', 0, 2),
(11, 'Production Speed', 0, 2),
(12, 'Clean Work Area', 0, 2),
(13, 'Punctual', 0, 2),
(14, 'Manages Time Wisely', 0, 2),
(15, 'Organized', 0, 2),
(16, 'Works Well with Others', 0, 2);

INSERT INTO ratings VALUES
();