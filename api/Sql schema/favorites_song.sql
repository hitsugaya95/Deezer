CREATE TABLE `favorites_song` (
  `user_id` bigint(11) unsigned NOT NULL,
  `song_id` bigint(11) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`song_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;