CREATE TABLE IF NOT EXISTS `puntos` (
  `punto_id` int(11) NOT NULL AUTO_INCREMENT,
  `punto_nombre` varchar(255) CHARACTER SET utf8 NOT NULL,
  `punto_descripcion` varchar(255) CHARACTER SET utf8 NOT NULL,
  `punto_latitud` float(10,6) NOT NULL,
  `punto_longitud` float(10,6) NOT NULL,
  PRIMARY KEY (`punto_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
