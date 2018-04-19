CREATE TABLE Account (
	account_id int(10) NOT NULL,
	type int(10), 
	username varchar(255), 
	password varchar(255), 
	email varchar(255), 
	PRIMARY KEY (account_id)
);

CREATE TABLE Media (
	media_id int(10) NOT NULL, 
	name varchar(255),
	username varchar(255),
	type varchar(255),
	path varchar(255),
	last_access_time timestamp,
	title varchar(255),
	description varchar(255),
	category varchar(255),
	views int(10),
	PRIMARY KEY (media_id)
);

CREATE TABLE Comment (
	comment_id int(10) NOT NULL,  
	media_fk int(10), 
	username varchar(255), 
	content varchar(255), 
	PRIMARY KEY (comment_id), 
	FOREIGN KEY media_fk REFERENCES Media(media_id)
);

CREATE TABLE Contact (
	id int(10) NOT NULL,  
	user_fk int(10),
	contact_fk int(10), 
	PRIMARY KEY (id), 
	FOREIGN KEY (user_fk) REFERENCES Account(account_id), 
	FOREIGN KEY (contact_fk) REFERENCES Account(account_id)
);

CREATE TABLE Favorite (
	favorite_id int(10) NOT NULL, 
	user_fk int(10),
	media_fk int(10),
	PRIMARY KEY (favorite_id)
	FOREIGN KEY (user_fk) REFERENCES Account(account_id), 
	FOREIGN KEY (media_fk) REFERENCES Media(media_id)
);

CREATE TABLE Message (
	message_id int(10) NOT NULL, 
	to_fk int(10),
	sender varchar(255),
	content varchar(255),
	PRIMARY KEY (message_id),
	FOREIGN KEY (to_fk) REFERENCES Account(account_id), 
);

CREATE TABLE Playlist (
	id int(10) NOT NULL, 
	playlist_name varchar(255),
	user_fk int(10),
	media_fk int(10),
	next_media_fk int(10),
	PRIMARY KEY (id)
	FOREIGN KEY (user_fk) REFERENCES Account(account_id), 
	FOREIGN KEY (media_fk) REFERENCES Media(media_id)
	FOREIGN KEY (next_media_fk) REFERENCES Media(media_id)
);

CREATE TABLE Tags (
	tag_id int(10) NOT NULL, 
	media_fk int(10),
	tag varchar(255),
	PRIMARY KEY (tag_id),
	FOREIGN KEY (media_fk) REFERENCES Media(media_id) 
);

