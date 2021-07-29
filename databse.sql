CREATE TABLE `wa_tbr_user` (
  `id_user` 	varchar(11)		NOT NULL,
  `username` 	varchar(128) 	NOT NULL,
  `password` 	mediumtext 		NOT NULL,
  `last_login` 	varchar(40) 	DEFAULT NULL,
  `role` 		varchar(1) 		NOT NULL,
  `full_name` 	varchar(128) 	NOT NULL,
  `gender` 		varchar(1) 		NOT NULL,
  `telp` 		varchar(35) 	NOT NULL,
  `address` 	mediumtext 		NOT NULL,
  `created_dt` 	datetime 		NOT NULL,
  `created_by` 	varchar(128) 	NOT NULL,
  `updated_dt` 	datetime 		DEFAULT null,
  `updated_by` 	varchar(128) 	DEFAULT null,
  `flag_del` 	varchar(1) 		DEFAULT 0,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `id_user_unique` (`id_user`)
);


CREATE TABLE `wa_tbr_item` (
  `id_item` 	varchar(11)		NOT NULL,
  `name` 		varchar(128) 	NOT NULL,
  `qty` 		int(11) 		NOT NULL,
  `price` 		decimal(10,0) 	DEFAULT null,
  `created_dt` 	datetime 		NOT NULL,
  `created_by` 	varchar(128) 	NOT NULL,
  `updated_dt` 	datetime 		DEFAULT null,
  `updated_by` 	varchar(128) 	DEFAULT null,
  `flag_del` 	varchar(1) 		DEFAULT 0,
  PRIMARY KEY (`id_item`),
  UNIQUE KEY `id_item_unique` (`id_item`)
);
