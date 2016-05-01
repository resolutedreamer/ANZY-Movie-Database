
--create a table with 5 attributes(ID, title, year,rating,company) 
CREATE TABLE Movie(
	id int NOT NULL UNIQUE, 
	title varchar(100) NOT NULL, 
	year int NOT NULL, 
	rating varchar(10) NOT NULL, 
	company varchar(50), 
	PRIMARY KEY (id), CHECK (year > 0 AND year <= 2016 AND (LENGTH(title) > 0))) #check if year is reasonable and if a title exists
ENGINE=InnoDB;


CREATE TABLE Actor(
	id int NOT NULL UNIQUE,
	last varchar(20) NOT NULL, 
	first varchar(20) NOT NULL, 
	sex varchar(6), 
	dob date NOT NULL, 
	dod date, PRIMARY KEY (id),
	CHECK(dob<dod) #check if dod is bigger than dob
	)
 ENGINE=InnoDB;

CREATE TABLE Director(
	id int NOT NULL UNIQUE,
	last varchar(20) NOT NULL, 
	first varchar(20) NOT NULL, 
	dob date, 
	dod date, 
	PRIMARY KEY (id), 
	CHECK(dod IS NULL OR dob<dod)) 
ENGINE=InnoDB;


--mid in MovieGenre must refer to 
--id in Movie (referential intergrity)
CREATE TABLE MovieGenre(
	mid int NOT NULL UNIQUE, 
	genre varchar(20) NOT NULL, 
	FOREIGN KEY (mid) REFERENCES Movie (id)) 
ENGINE=InnoDB;


CREATE TABLE MovieDirector(
	mid int NOT NULL UNIQUE, 
	did int NOT NULL UNIQUE, 
	PRIMARY KEY (mid, did), 
	FOREIGN KEY (mid) REFERENCES Movie (id), 
	FOREIGN KEY (did) REFERENCES Director (id)
	) 
ENGINE=InnoDB;

--mid in MovieActor must refer to id in Movie 
--aid in MovieActor must refer to id in Actor 
CREATE TABLE MovieActor(
	mid int NOT NULL UNIQUE, 
	aid int NOT NULL UNIQUE, 
	role varchar(50), 
	FOREIGN KEY (mid) REFERENCES Movie (id), 
	FOREIGN KEY (aid) REFERENCES Actor (id)) 
ENGINE=InnoDB;


CREATE TABLE Review(
	name varchar(20) NOT NULL, 
	time timestamp, 
	mid int NOT NULL UNIQUE, 
	rating int, 
	comment varchar(500), 
	FOREIGN KEY (mid) REFERENCES Movie (id)) 
ENGINE=InnoDB;

CREATE TABLE Sales(
	mid int NOT NULL UNIQUE, 
	ticketsSold int, 
	totalIncome int,
	FOREIGN KEY (mid) REFERENCES Movie (id))
ENGINE=InnoDB;

--MovieRating(mid, imdb, rot)
CREATE TABLE MovieRating(
	mid int NOT NULL UNIQUE,
	imdb int, 
	rot int,
	FOREIGN KEY (mid) REFERENCES Movie (id))
ENGINE=InnoDB;

CREATE TABLE MaxPersonID(
	id int NOT NULL UNIQUE) 
ENGINE=InnoDB;

CREATE TABLE MaxMovieID(
	id int NOT NULL UNIQUE) 
ENGINE=InnoDB;

