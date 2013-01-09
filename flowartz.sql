-- phpMyAdmin SQL Dump
-- version 3.3.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 05, 2012 at 04:33 AM
-- Server version: 5.5.11
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `flowartz`
--

-- --------------------------------------------------------

--
-- Table structure for table `fa_galleries`
--

CREATE TABLE IF NOT EXISTS `fa_galleries` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ordered` tinyint(2) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `uid_idx` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `fa_galleries`
--

INSERT INTO `fa_galleries` (`id`, `uid`, `name`, `ordered`, `created`) VALUES
(1, 77, 'Koala.jpg', 0, '2012-09-04 12:34:48'),
(2, 77, 'Penguins.jpg', 1, '2012-09-04 12:34:48'),
(3, 77, 'Jellyfish.jpg', 2, '2012-09-04 12:34:49');

-- --------------------------------------------------------

--
-- Table structure for table `fa_profile_images`
--

CREATE TABLE IF NOT EXISTS `fa_profile_images` (
  `name` varchar(255) DEFAULT NULL,
  `description` mediumblob,
  `uid` int(10) NOT NULL,
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`pid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `fa_profile_images`
--

INSERT INTO `fa_profile_images` (`name`, `description`, `uid`, `pid`) VALUES
('1b962b766e2623572f9b6baa015e43df3c2821a3.jpg', NULL, 17, 5),
('3169d7336b438c48836a8e3ec9608ede265ec4cf.jpg', NULL, 40, 4),
('a49481ddb6b6131007e2d60816e14d14ff8b091d.png', NULL, 43, 10),
('2910230369b77b6c7059f4089815c3bbd60a53c3.jpg', NULL, 26, 6),
('6a8871954ce7caf6ff0095badb1d31c315804cda.jpg', NULL, 45, 11),
('fa1ec76e80dcfacb9e270e464bd6f81f97df1ef6.jpg', NULL, 47, 12),
('bf062bda4a5aff63da64b7e4457d3d4f430aa5e6.png', NULL, 50, 18),
('baa6ce5a7d8045509c9d7ea9d193c90778ef6fab.jpg', NULL, 52, 19),
('1047b50aa6c98fb00563f19300e92a2821a18171.jpg', NULL, 53, 20),
('b0d2c3104b44b722784ec31f099eec7ad83cde2b.jpg', NULL, 55, 22),
('91ae2e1cbb629f5df3a65ce4efb56002a81ec167.jpg', NULL, 59, 23),
('35e032959d01c86fc176b6a8366f32553398c6eb.JPG', NULL, 63, 24),
('1db381ac394d9ccb7205aa1d93e0f19be0b69461.jpg', NULL, 64, 26),
('3e9fe228231db29a862603a18079a84e8da62f22.jpg', NULL, 66, 27),
('62c66887733123ad0901a9d7066957a1d968540c.JPG', NULL, 71, 28),
('b620a313f56659e28bfe1fd080e8796e72b7b81e.jpg', NULL, 76, 29),
('a178acbad90f7c60d6a896de24386721.jpg', NULL, 77, 51);

-- --------------------------------------------------------

--
-- Table structure for table `fa_users`
--

CREATE TABLE IF NOT EXISTS `fa_users` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `activated` varchar(255) DEFAULT 'NOT_ACTIVATED',
  `last_visit_date` int(10) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `blurb` mediumblob,
  `sec_q` varchar(255) DEFAULT NULL,
  `sec_a` varchar(255) DEFAULT NULL,
  `views` bigint(10) NOT NULL DEFAULT '0',
  `join_date` int(10) NOT NULL,
  `ip` varchar(255) DEFAULT NULL COMMENT 'This is a temporary column, will be a table',
  `token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

--
-- Dumping data for table `fa_users`
--

INSERT INTO `fa_users` (`uid`, `name`, `password`, `email`, `website`, `activated`, `last_visit_date`, `title`, `location`, `blurb`, `sec_q`, `sec_a`, `views`, `join_date`, `ip`, `token`) VALUES
(48, 'russarm', '003eed77186f34216895c77d6944e6cc0c110cd8', 'russarm@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'lover', 'micaela', 0, 1327104408, '174.0.56.74', '491842f90eedce86127c1f19d4629c0f195c227e'),
(47, 'CitrusZ', '08fcd3a3621927d0aef5f9c19645435e3719780c', 'courageous1@live.ca', 'https://www.facebook.com/CitrusZ', NULL, NULL, 'hula hooper/ amateur disk jockey', 'Vancouver BC  BABY!!', 0x707265747479206e657720746f2074686520666c6f7720746f79207363656e652c2062757420776974682061206365727461696e20666c61726520616c77617973207365656d7320746f206c65617665207468652061756469656e6365206361707469766174656420616e6420696e747269677565642e2076657279206d756368207374696c6c20696e20746865207072616374696365207374616765732c206275742077697468207765656b6c792073657373696f6e7320726f7574696e6520697320696d70726f76696e672067726561746c79212064726f70206d652061206d6573736167652c20696d20616c7761797320646f776e2077697468206e6574776f726b696e6720616e64206c6561726e696e67206e657720747269636b7321207468616e6b7321, 'what is your choice of flow toy?', 'hulahoop', 0, 1327101413, '24.84.229.185', '7486ca27074e2008ea814ed924a6bedc4008e4fe'),
(46, 'geoffguidetti', '1c12d2e14ec961e5f1fb0f597289245ebdeffb6f', 'geoffguidetti@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'My name on MBP', 'Lye', 0, 1327097224, '64.71.5.124', '682dbbb317985deff8b21a7aae297ae24fd8c07c'),
(17, 'Luciana Gomez', 'b444ac06613fc8d63795be9ad0beaf55011936ac', 'user2@example.com', 'http://www.flowartz.com', NULL, 1323725433, 'Contact Juggler', 'Edmonton, Canada', 0x49206c696b65206361747320616e64206a7567676c696e67, NULL, NULL, 0, 1322806162, NULL, '99c567add5238c5e85d1295b5f2ba322e3426c50'),
(26, 'Ryan Priebe', '7288edd0fc3ffcbe93a0cf06e3568e28521687bc', 'ryan2@sidestory.ca', 'http://www.sidestory.ca', NULL, 1327863680, 'Developer', 'Canada', 0x49206c696b6520666972652e204974277320686f742e, NULL, NULL, 0, 1322807061, '96.52.132.249', '82605b961d13aafc45686f157f2eea93e67f6109'),
(42, 'josh', '166adf7cb43fc4d37ee98226d117b953bcf79516', 'josh@sidestory.ca', NULL, NULL, 1323743016, NULL, NULL, '', NULL, NULL, 0, 1323726133, '198.53.23.204', '888bca0931c8f90fcae2d8fa4ac92a3f631c2267'),
(45, 'Brandon', '4ee0fb1a2ff04595aee6638608534d0562dcccb9', 'Brandon@FlowArtz.com', 'www.FlowArtz.com', NULL, 1327175688, 'Founder', 'Edmonton ', 0x4272616e646f6e20686173207370656e7420372079727320696e207468652070726f7020616e6420636972637573206172747320636f6d6d756e6974792e20486176696e6720747261696e656420776974682061206e756d626572206f662074726f7570657320616e642068656c70207465616368206174206e756d65726f7573206576656e74732061726f756e6420416c626572746120616e642042432c2068652068617320646576656c6f706564206120676f6f6420756e6465727374616e64696e67206f662074686520636f6d6d756e6974792c205768696c65206265696e6720686967686c7920736b696c6c65642061742061206e756d626572206f6620646966666572656e742070726f7020617274732068652073696c6c2066696e64732068696d73656c66206d6f72652070617373696f6e6174652061626f75742068656c70696e672074686520636f6d6d756e69747920617320612077686f6c652e20546865206d616a6f72697479206f66206869732074696d65206e6f77206973207370656e74206372656174696e67206e65772077617973206f662068656c70696e67206172746973747320746f206561726e2061206c6976696e672066726f6d2074686569722070617373696f6e732e2054686973207761732074686520726561736f6e20666f722068696d206372656174696e6720466c6f77204172747a2e, 'Name of dog', 'Epic', 0, 1327093105, '68.148.106.194', '048884a2d687f1c31ad2a208525e84dde6dbc295'),
(40, 'Dante Epicart ', '2d123993ed93c6f0555d52d5d132ef948ba635e1', 'joshkyrzyk@gmail.com', 'http://www.flowartz.com', NULL, 1345153057, 'Artistic Coordinator', 'Edmonton, AB', 0x49277665207370656e74203720796561727320696e207468652070726f7020616e6420636972637573206172747320696e647573747279207768696c652063757272656e746c7920747261696e696e6720696e206f76657220323020646966666572656e742070726f70206261736564206172747320616e6420686176652061206772656174206465616c206f6620657870657269656e6365207468726f75676820706572666f726d696e6720776974682061206e756d626572206f6620646966666572656e742074726f757065732e, NULL, NULL, 0, 1323706472, '198.53.23.204', '0c68cb1dba8de5b4c6c06f5fef09b738baa11c8c'),
(49, 'jessepaulharkness', '5cefd34875479454d67e172dd86e3e69eb430d3c', 'jessepaulharkness@gmail.com', '', NULL, NULL, 'flow artist/teacher', 'Earth', 0x69206d6f7374207573652062656e7420706c616e657320696e20736f7274206f66206120342064696d656e73696f6e616c207370686572652e2069206d6f73746c792075736520706f6920737461666620616e6420617374726f6a61636b73206275742069206861766520736f6d65207369636b206d6f76657320776974682068756c612e2069206c696b6520746f20757365207374616c766573207769746820706f69206174207468652073616d652074696d652c206920656e6a6f79207573696e672034206669726520706f6920636f6d666f727461626c7920616e64207370696e6e696e6720617320636c6f736520746f206f746865722070656f706c6520617320706f737369626c6520203a2020290a0a692068617665206265656e20617669646c7920696e746572616374696e67207769746820666c6f7720746f797320666f72203820616e6420612068616c662079656172732c20616e6420617669646c79207465616368696e6720666f7220330a0a536f6d652070656f706c652063616c6c206d65206120686970707920627574206920736179207765726520616c6c206f6e652072616365206f6620696e646976696475616c732e20697420757375616c6c7920646f65736e742068656c702074686f210a0a6d6f7265206875677320666f7220616c6c2e, 'nice name', 'Zen', 0, 1327114149, '75.157.97.104', '5477c28bbe20950800c3713feb2ec3a5942180cd'),
(50, 'Bryton (Lyght)', '2d06f08687dd403ec7d12e664cfcfe9c96d27a43', 'brightlight91@me.com', '', NULL, NULL, 'Hoop Performance Artist', 'Edmonton, AB, Canada', 0x5374617274696e6720696e20417567757374206f6620323031312c204920746f6f6b206d79206669727374206c6f6f6b2061742070726f7020617274732e2053696e6365207468656e20492068617665206d65742074686520636f6d6d756e6974792061726f756e64206d6520616e642068617665206c6561726e656420736f206d7563682e204120686f6f706572206174206865617274206275742077696c6c696e6720746f206c6561726e206e65772070726f707320736f6f6e20492061737069726520746f206265636f6d6520746865206265737420492063616e2062652061742070726f70206d616e6970756c6174696f6e21, 'Home town?', 'Drayton Valley', 0, 1327114429, '198.53.193.227', 'daea364082afebb2fa506e5418367c06a7a97c0b'),
(51, 'fourdirectionslaughradio', 'bf5954e19fc4796c3141d8d13235014e918a7d3b', 'fourdirectionslaughradio@gmail.com', NULL, NULL, 1327169575, NULL, NULL, NULL, 'what is your fave tree', 'spruce', 0, 1327163796, '68.150.178.2', 'fe9e30834b7dc3704814592dd2d2c7fd2df30717'),
(52, 'Phoenix', '37a689c9c0b8cb4fb6a95f437f3924e7e4d61d4c', 'keziah.arsenault@gmail.com', 'www.firestormtroupe.com', NULL, NULL, 'Director, FireStorm Performance Troupe', 'Calgary, Alberta', '', 'What is my stage name?', 'Phoenix', 0, 1327170637, '68.144.49.10', '90499ecba9bbb021d7959887c0aff70627f28131'),
(53, 'Veeka', 'e9d92f65d21f91f7ccecb8beb91cf470c5f08e21', 'victoria.trofimova@gmail.com', 'www.sunshinefireentertainment.com', NULL, 1327178879, '', 'Amherst, MA, United States', '', 'what is your first prop', 'poi', 0, 1327177068, '71.234.178.15', '760d2e3fe457c21f10bd2d2fda0cc72fd6d5a930'),
(54, 'paul.mann', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'paul.mann', NULL, 'cb397f224d72d922738900b296c184a02ff52703', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1327189906, '50.72.163.198', '3d70e591af63f7438725a38a5ad7e35b70770444'),
(55, 'Amur Phyre', 'ea1fc92d417beb43c7302b277a2de8070f9442f0', 'paul.mann347@gmail.com', '', NULL, NULL, '', 'Winnipeg Manitoba', '', 'i am ?', 'da-mann', 0, 1327189952, '50.72.163.198', '66faf6f32f700e9a584462986a2ff8c30ee64905'),
(56, 'live.the.dao"gmail.com', '9c553c110981054406f6fe1efe0ec63511af096f', 'live.the.dao"gmail.com', NULL, '2ed46fbe46c0cbec7fadd7be303bb9e380c1f14f', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1327194983, '96.51.52.220', 'cce56de257b482a1d648655db0d638b062ba9f9d'),
(57, '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', NULL, '1db41036056b8ac334e5fcfa1f5d43d72e121447', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1327195015, '96.51.52.220', '10a34637ad661d98ba3344717656fcc76209c2f8'),
(58, 'scott.brian.mitchell', '7621584ad29b81f7e6174c0ac9b5a1eed87922c2', 'scott.brian.mitchell@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'Where did I get my first staff', 'Exeter High Street  ', 0, 1327197484, '86.167.195.224', '2137f6f6e25e32efc89152154c7c4c5b8bf02f93'),
(59, 'Sarah Knight', '68a21aada6fd1f72387c37516fcbd1e78449bebe', 'sarah_knight87@hotmail.com', '', NULL, 1327379328, 'Hoop Dancer & Juggler', 'DeWinton, Alberta', '', 'Who introduced me to hooping?', 'Carla Snow', 0, 1327205832, '74.198.151.113', '1c5aae4fa6442e13ce5e453a133cf0a50e7035e9'),
(60, 'Angelhelm', '9eb7af0205a0e924595e886ffb443561f076e279', 'Angelhelm@gmail.com', 'Test', NULL, NULL, 'Test', 'Test', 0x54657374, 'Where do i live!', 'Vancouver', 0, 1327289745, '209.121.191.14', '521d6ac04c5211a59ee78e353d822326e2f9c2ec'),
(61, 'paroxon', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'paroxon@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'Laptop #1 Brand?', 'Asus', 0, 1327289870, '68.148.106.1', 'a0acd2a2a3b143059cab78c61f2b85b2b28b80f6'),
(62, 'Josh', 'dc197e95fff99e7d9ef73416f0ead0ae3c186aaa', 'josh@joshuabuxton.ca', 'www.joshuabuxton.ca', NULL, NULL, '', '', '', 'No thanks', '9q8fh0394fh8iuvblkj5bi8h98', 0, 1327294358, '24.224.197.118', '09a2459d3a012f99efc3f029c04d61163e40391c'),
(63, 'Atomic', '9b75c852c892142d5138f9a615edaa48dbbfe410', 'atomicfireshow@gmail.com', 'http://atomicfireshow.wordpress.com', NULL, NULL, 'Fire & Glow Performer', 'Winnipeg, Manitoba, Canada', '', 'what was the first troupe you joined?', 'Gravity Still Works', 0, 1327382620, '207.161.131.115', 'fa3782120fe6f63191dbf058e301b752c7dc3345'),
(64, 'Rikky Mushrooms', '43c733c68767f364a2bf54a7deef97e521d23d66', 'rikky@spinningcircles.ca', 'toontownhoops.com and spinningcircles.ca', NULL, NULL, 'Professional Fire and Glow Dancer', 'Saskatoon, SK, Canada', '', 'If a purple monkey bit you', 'would you cry?', 0, 1327460333, '174.2.69.33', '1dec49f0bab3821fa28ecc4d02d4fca400520919'),
(65, 'Cary Lam', '7e46853aa21445e8c900791501d8b8091e1a0f05', 'carylam@yahoo.com', 'www.calgarycircusstudio.com', NULL, 1327528422, 'Director, Calgary Circus Studio', 'Calgary', '', 'What is my favorite color?', 'black', 0, 1327527948, '121.219.30.249', '7b8933a1d47557ac0c69a2f7472230c45c620198'),
(66, 'Thom Thumb', '4769c0d690736eef59539d95d43a377c5b7024a7', 'thomthumbflow@gmail.com', 'www.flow365.wordpress.com', NULL, NULL, 'Ninja Clown', 'Austin Texas', 0x4920616d2061206265696e67207468617420697320666f637573696e6720616c6c206974277320656e65726779206f6e20636f2d6372656174696e67206c6f76652c20626c69737320616e642074686520666c6f7720737461746520696e206576657279206d6f6d656e742e0a0a, 'What is my first prop love?', 'hat', 0, 1327546819, '12.207.42.201', 'a0772ea2914ee3d481f8b7aa6b8be1b1b776f0f5'),
(67, 'joshkyrzyk', 'f12c881e5e282cd6c9618f2449a6eb9bc72b5a9b', 'joshkyrzyk@gmail.com123', NULL, '4a19a3b64cf8cf454ca101b0dc20d7be7c3dafe5', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1330919308, '198.53.23.204', '596a53bde22ef2e1e8cb33334b39ddb2564e06a9'),
(68, 'joshkyrzyk', 'f12c881e5e282cd6c9618f2449a6eb9bc72b5a9b', 'joshkyrzyk@gmail.com', NULL, 'd021ea9ed133def3a3db7104092d5808d3689af9', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1330919415, '198.53.23.204', 'b1f2efa9587f633ae91bb6698494d85e610a6921'),
(69, 'info', 'f12c881e5e282cd6c9618f2449a6eb9bc72b5a9b', 'info@joshuark.com', NULL, NULL, 1330919639, NULL, NULL, NULL, 'My big cat''s name', 'Cooper', 0, 1330919472, '198.53.23.204', '568af5b56f34edbb6eced246205ee798d607772d'),
(70, 'vayu', '2259248511dbfaf3ed6bd824f62a3c257f9b1f3a', 'vayu@sklinks.com', NULL, NULL, NULL, NULL, NULL, NULL, 'cat', 'sklinks', 0, 1337227456, '50.131.189.181', 'ecb62b6c955596722bc90e39a5199b1c938f3545'),
(71, 'David Nelson', 'd5c4619cb8d03961bd7f0c20e809b08bfbccade6', 'henjin@live.com', '', NULL, NULL, '', 'Edmonton AB', '', 'what is your favorite sport', 'Basketball', 0, 1340436404, '174.3.43.113', 'd56e0fe49aa9bdd7f41354a8f4a6f9f66b429fa0'),
(72, 'ryleys', '3ab1354bfb15db69d1a186f09ae9f136c80d3208', 'ryleys@unrealmedia.ca', NULL, NULL, NULL, NULL, NULL, NULL, 'What colour was my first car? ', 'Brown', 0, 1345153084, '174.0.206.155', '5e8c1fcdf99463c95d702f9a2581ecb5391870ab'),
(73, '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', NULL, 'ca14c2e0a9e00cf20c206fd14900f9ba0b223ad8', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1345444526, '180.234.200.253', '10a34637ad661d98ba3344717656fcc76209c2f8'),
(74, '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', NULL, 'bb859bf613f2ba8b8681da6963c3811090c48a24', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1345444919, '180.234.200.253', '10a34637ad661d98ba3344717656fcc76209c2f8'),
(75, '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', NULL, 'fd55b27b615a1a8804dd62326f09e2dd73abaa1e', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1345444937, '180.234.200.253', '10a34637ad661d98ba3344717656fcc76209c2f8'),
(76, 'Anwar', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'anwar.bca04@gmail.com', '', NULL, NULL, 'Dev', 'ON', 0x686f6c6c61, 'who am i', 'anwar', 0, 1345445460, '180.234.200.253', '5a246695a20959cc033e5d1f601a390c402fa92e'),
(77, 'mail.phapsu.com', 'e45c8aff12e86cd9feb143b2dcbf4f8696539f78', 'mail.phapsu.com@gmail.com', NULL, NULL, 1346234447, NULL, NULL, NULL, 'What''s my mother''s name?', 'Tai', 0, 1346208804, '113.162.116.192', '0da3871020faf5d492e22637fe52c7f76b33caaf'),
(78, 'quachqhuy', 'ec285935b46229d40b95438707a7efb2282f2f02', 'quachqhuy@onlyoneweb.com', NULL, NULL, 1346210479, NULL, NULL, NULL, 'where do i live', 'toronto', 0, 1346208919, '99.228.244.199', '225fc5098dc5ea8da74cd47f60d354bc601873e2');

-- --------------------------------------------------------

--
-- Table structure for table `fa_users_experience`
--

CREATE TABLE IF NOT EXISTS `fa_users_experience` (
  `eid` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `job_event_title` varchar(255) NOT NULL,
  `job_description` mediumblob NOT NULL,
  `job_date` int(10) NOT NULL,
  `job_location` varchar(255) NOT NULL,
  `job_link` varchar(255) NOT NULL,
  `job_link_title` varchar(255) NOT NULL,
  PRIMARY KEY (`eid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `fa_users_experience`
--

INSERT INTO `fa_users_experience` (`eid`, `uid`, `job_title`, `job_event_title`, `job_description`, `job_date`, `job_location`, `job_link`, `job_link_title`) VALUES
(1, 10, 'Ryan Priebe', '', 0x466c6f776172747a20446576656c6f706572, 1322711599, 'Edmonton, Canada', 'Hello, my name is Ryan. I am really passionate about web servers, PHP, Heineken and mountain biking.', ''),
(2, 10, 'Ryan Priebe', '', 0x64, 1322711614, 'Edmonton, Canada', 'Hello, my name is Ryan. I am really passionate about web servers, PHP, Heineken and mountain biking.', ''),
(6, 40, 'Performance at Flow Artz Fundraiser', '', 0x466c6f77204172747a206973206120636f6c6c61626f726174697665206f7267616e697a6174696f6e2074686174207365656b7320746f206e6574776f726b20616c6c20666f726d73206f66206172742c206d6f76656d656e7420616e6420666c6f7720746f206f6e65206c6f636174696f6e2c20696e766974696e6720746561636865727320616e642073747564656e747320676c6f62616c6c7920746f2068656c70206564756361746520616e6420696e73706972652074686520776f726c642e, 1323730298, 'Edmonton, AB', 'http://www.youtube.com/watch?v=1DXkb9PQ_zY', 'View Performance'),
(4, 12, 'Wrestledabearonce', '', 0x4c696b652076696f6c656e63652c20796f752068617665206d652c20666f72657665722c20616e642061667465722e20464f5245564552, 1323321337, 'indawoods', 'http://www.google.ca', 'The video'),
(7, 43, 'fight babies with sharks', '', '', 1323730882, '', '', ''),
(8, 45, 'EEC Fire Performance', '', 0x46656174757265206669726520706572666f726d616e63652077697468204669726553746f726d20506572666f726d616e63652054726f757065, 1327102102, 'Edmonton Events Center', '', ''),
(9, 50, 'Worked with FireStorm Performance Troupe', '', '', 1327121944, 'Edmonton, AB', '', 'FireStorm Performance Troupe'),
(10, 52, 'Edmonton Taboo Naughty But Nice Sex Show', '', '', 1327171448, 'Edmonton, AB', '', ''),
(11, 53, 'Founder of Western Mass Flow Jam', '', 0x5765737465726e204d61737320466c6f77204a616d2069732061207765656b6c7920676174686572696e672064656469636174656420746f20666c6f77206172747320616e64206f626a656374206d616e6970756c6174696f6e2e204f757220676f616c20697320746f2070726f6d6f746520736b696c6c2d736861726520616d6f6e677374207370696e6e65727320696e20746865206172656120616e64206275696c642061207374726f6e67207370696e6e696e6720636f6d6d756e6974792e2054686973207765656b6c79206576656e742068617070656e73206174207468652053484f57204369726375732073747564696f20696e204561737468616d70746f6e204d4120616e64206974e280997320746865207065726665637420706c61636520746f206c6561726e20616e6420707261637469636520706f692c20686f6f70696e672c2073746166662c20636f6e74616374206a7567676c696e6720616e64206f7468657220666c6f77206172747320696e206120737570706f727469766520656e7669726f6e6d656e742e20, 1327179970, 'Easthampton, MA, United States', 'https://westernmassflowjam.wordpress.com/', 'the blog allows people to sign up for updates with their email address'),
(12, 62, 'It', '', '', 1327294789, 'Kitchen floor', '', ''),
(13, 66, 'I was a clown in the feature film Water For Elephants', '', '', 1327554042, 'Hollywood, CA', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `fa_users_links`
--

CREATE TABLE IF NOT EXISTS `fa_users_links` (
  `lid` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`lid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `fa_users_links`
--

INSERT INTO `fa_users_links` (`lid`, `uid`, `name`, `link`) VALUES
(1, 26, 'Google', 'google.ca'),
(2, 26, 'Green Day (band)', 'greenday.com'),
(3, 26, 'Apple', 'apple.com'),
(14, 45, 'Facebook Page', 'https://www.facebook.com/pages/Flow-Artz/124302124322167'),
(5, 12, 'Red Balloon', 'http://www.youtube.com/watch?v=834lnECcFw0'),
(6, 12, 'SideStory', 'http://sidestory.ca'),
(7, 17, 'My Blog', 'sidestory.ca/'),
(8, 17, 'Facebook Page', 'http://www.facebook.com/profile.php?id=639027167&amp;sk=info'),
(9, 12, 'apple', 'www.apple.com'),
(10, 12, 'twitter', 'https://www.twitter.com'),
(11, 40, 'flow.artz', 'http://www.facebook.com/pages/Flow-Artz/124302124322167'),
(12, 40, 'flowartz', 'https://twitter.com/flowartz1'),
(13, 40, 'Flow Artz Channel', 'www.youtube.com/FlowArtzD'),
(15, 47, 'FACEBOOK CONTACT INFO!', 'https://www.facebook.com/CitrusZ'),
(16, 52, 'Facebook', 'http://www.facebook.com/profile.php?id=747530646'),
(17, 52, 'FireStorm''s website', 'www.FireStormTroupe.com'),
(18, 63, 'Winnipeg Prop-Shops', 'http://propshops.wordpress.com'),
(19, 77, 'My Blog', 'phapsu.com');

-- --------------------------------------------------------

--
-- Table structure for table `fa_users_settings`
--

CREATE TABLE IF NOT EXISTS `fa_users_settings` (
  `setting_name` varchar(255) NOT NULL,
  `setting_value` varchar(255) NOT NULL,
  `uid` int(10) NOT NULL,
  `setting_id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`setting_id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `fa_users_settings`
--

INSERT INTO `fa_users_settings` (`setting_name`, `setting_value`, `uid`, `setting_id`) VALUES
('', '', 17, 1),
('', '', 18, 2),
('', '', 19, 3),
('', '', 20, 4),
('', '', 22, 5),
('', '', 23, 6),
('', '', 24, 7),
('', '', 25, 8),
('', '', 26, 9),
('', '', 27, 10),
('', '', 28, 11),
('', '', 29, 12),
('', '', 30, 13),
('', '', 31, 14),
('', '', 32, 15),
('', '', 33, 16),
('', '', 34, 17),
('', '', 35, 18),
('', '', 36, 19),
('', '', 37, 20),
('', '', 38, 21),
('', '', 39, 22),
('', '', 40, 23),
('', '', 41, 24),
('', '', 42, 25),
('', '', 43, 26),
('', '', 44, 27),
('', '', 45, 28),
('', '', 46, 29),
('', '', 47, 30),
('', '', 48, 31),
('', '', 49, 32),
('', '', 50, 33),
('', '', 51, 34),
('', '', 52, 35),
('', '', 53, 36),
('', '', 54, 37),
('', '', 55, 38),
('', '', 56, 39),
('', '', 57, 40),
('', '', 58, 41),
('', '', 59, 42),
('', '', 60, 43),
('', '', 61, 44),
('', '', 62, 45),
('', '', 63, 46),
('', '', 64, 47),
('', '', 65, 48),
('', '', 66, 49),
('', '', 67, 50),
('', '', 68, 51),
('', '', 69, 52),
('', '', 70, 53),
('', '', 71, 54),
('', '', 72, 55),
('', '', 73, 56),
('', '', 74, 57),
('', '', 75, 58),
('', '', 76, 59),
('', '', 77, 60),
('', '', 78, 61);

-- --------------------------------------------------------

--
-- Table structure for table `fa_users_skills`
--

CREATE TABLE IF NOT EXISTS `fa_users_skills` (
  `sid` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`sid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `fa_users_skills`
--

INSERT INTO `fa_users_skills` (`sid`, `uid`, `name`) VALUES
(5, 40, 'Buugeng'),
(2, 17, 'Dancing'),
(3, 17, 'Singing'),
(6, 40, 'Meteor'),
(7, 40, 'Poi'),
(8, 40, 'Wand Flags'),
(9, 40, 'Hoop'),
(11, 40, 'Juggling'),
(13, 45, 'poi'),
(14, 45, 'Staff'),
(15, 45, 'Double Staff'),
(16, 45, 'Contact Staff'),
(17, 45, 'Contact Juggling'),
(18, 45, 'Flow Wand'),
(19, 45, 'Meteor'),
(20, 45, 'Sai'),
(21, 47, 'HULA HOOPING!!'),
(22, 47, 'DJING!!'),
(23, 50, 'Hoop performance (Fire&Glow;)'),
(25, 52, 'Poi'),
(26, 52, 'Fans'),
(27, 52, 'Whip'),
(28, 52, 'Fire Eating'),
(29, 52, 'Jumping stilts'),
(30, 52, 'Leather working'),
(31, 52, 'Costuming'),
(32, 55, 'Poi'),
(33, 55, 'Buugeng'),
(34, 62, 'Sticking my tongue out and touching my nose'),
(35, 62, 'Web stuff'),
(39, 59, 'Fire Performances'),
(38, 59, 'Hoop Dance'),
(40, 59, 'Staff'),
(41, 59, 'Fire Sword'),
(43, 59, 'Contact Juggling'),
(47, 59, 'Devil Sticks'),
(45, 59, 'Diablo'),
(46, 59, 'Fire Fans'),
(48, 63, 'Fire Poi'),
(49, 63, 'Glow Poi'),
(50, 63, 'Fire Staff'),
(51, 63, 'Glow Staff'),
(52, 63, 'Glow Double Staff'),
(53, 63, 'Fire Eating'),
(54, 63, 'Fire Breathing'),
(55, 63, 'Fire Fans'),
(56, 66, 'Juggling'),
(57, 66, 'Clowning'),
(58, 66, 'buugeng'),
(59, 66, 'partner poi'),
(60, 66, 'hoop'),
(61, 66, 'acro-balance'),
(62, 66, 'chess master'),
(63, 66, 'contact juggling');

-- --------------------------------------------------------

--
-- Table structure for table `fa_users_stats`
--

CREATE TABLE IF NOT EXISTS `fa_users_stats` (
  `statid` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `views` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`statid`),
  KEY `uid` (`uid`,`views`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `fa_users_stats`
--

INSERT INTO `fa_users_stats` (`statid`, `uid`, `views`) VALUES
(1, 17, 82),
(2, 26, 34),
(3, 27, 2),
(4, 28, 0),
(5, 29, 0),
(6, 30, 0),
(7, 31, 0),
(8, 32, 0),
(9, 33, 0),
(10, 34, 0),
(11, 35, 3),
(12, 36, 4),
(13, 37, 2),
(14, 38, 0),
(15, 39, 0),
(16, 40, 38),
(17, 41, 0),
(18, 42, 5),
(19, 43, 0),
(20, 44, 0),
(21, 45, 21),
(22, 46, 2),
(23, 47, 11),
(24, 48, 1),
(25, 49, 3),
(26, 50, 5),
(27, 51, 0),
(28, 52, 4),
(29, 53, 4),
(30, 54, 0),
(31, 55, 3),
(32, 56, 0),
(33, 57, 0),
(34, 58, 1),
(35, 59, 4),
(36, 60, 3),
(37, 61, 1),
(38, 62, 4),
(39, 63, 1),
(40, 64, 5),
(41, 65, 2),
(42, 66, 5),
(43, 67, 0),
(44, 68, 0),
(45, 69, 1),
(46, 70, 1),
(47, 71, 0),
(48, 72, 0),
(49, 73, 0),
(50, 74, 0),
(51, 75, 0),
(52, 76, 0),
(53, 77, 1),
(54, 78, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fa_users_videos`
--

CREATE TABLE IF NOT EXISTS `fa_users_videos` (
  `vid` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`vid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `fa_users_videos`
--

INSERT INTO `fa_users_videos` (`vid`, `uid`, `name`, `link`) VALUES
(15, 50, 'Fun practice!', 'http://youtu.be/QbT38vmlhcs'),
(5, 12, 'Really Black Balloon', 'http://www.youtube.com/watch?v=834lnECcFw0'),
(6, 12, 'Sympathy', 'http://www.youtube.com/watch?v=3oF0iY0z_Bs&ob=av2e'),
(7, 12, 'Google', 'http://www.google.ca'),
(12, 40, 'Performance Demo Reel', 'http://www.youtube.com/watch?v=1DXkb9PQ_zY'),
(13, 52, 'FireStorm promo video', 'http://www.youtube.com/watch?v=xX7iUgi2GWo'),
(14, 52, 'FireStorm''s interview with Alberta Primetime - Dec 9, 2011', 'http://www.albertaprimetime.com/Archived.aspx?pd=3139');
