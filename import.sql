CREATE TABLE IF NOT EXISTS `ip2nationCountries` (
  `code` varchar(4) NOT NULL DEFAULT '',
  `iso_code_2` varchar(2) DEFAULT NULL,
  `iso_code_3` varchar(3) DEFAULT NULL,
  `iso_country` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `lat` float NOT NULL DEFAULT '0',
  `lon` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`code`),
  KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ip2nationCountries`
--

INSERT INTO `ip2nationCountries` (`code`, `iso_code_2`, `iso_code_3`, `iso_country`, `country`, `lat`, `lon`) VALUES
('ir', 'IR', 'IRR', 'IRAN', 'Islamic Republic of IRAN', 35.7, 51.29);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;




INSERT INTO `gateways` (`id`, `name`, `account`, `allow_deposits`, `allow_withdrawals`, `allow_upgrade`, `withdraw_fee`, `withdraw_fee_fixed`, `currency`, `option1`, `option2`, `option3`, `option4`, `option5`, `option6`, `min_deposit`, `total_withdraw`, `total_deposit`, `status`) VALUES
(666, 'sn', '', 'yes', 'yes', 'yes', '0', '0.000', 'USD', '', '', '', '', '', NULL, '0.00', '0.00', '0.00', 'Active');