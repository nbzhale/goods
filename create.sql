CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `type_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `pic` varchar(50) NOT NULL,
  `note` varchar(30) DEFAULT NULL,
  `add_time` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf-8