INSERT INTO `user` (`id`, `name`, `email`)
VALUES
	(1,'tartanpion','tartanpion@gmail.com'),
	(2,'toto','toto@gmail.com');

INSERT INTO `song` (`id`, `title`, `duration`)
VALUES
	(1,'1970 Somethin\'',300),
	(2,'hiiipower',400);

INSERT INTO `favorites_song` (`user_id`, `song_id`)
VALUES
	(1,1),
	(1,2),
	(2,2);