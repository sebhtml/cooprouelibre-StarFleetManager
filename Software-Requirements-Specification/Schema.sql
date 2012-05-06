create table TablePrefix_User(
	id	integer auto_increment,
		primary key(id),
	username	varchar(32) not null unique,
	md5Password	char(32) not null,	
	firstName	varchar(100) not null,
	lastName	varchar(100) not null,

	isAdministrator bool not null
) ENGINE = InnoDB  CHARACTER SET utf8 COLLATE utf8_general_ci;


create table TablePrefix_Member(
	id	integer auto_increment,
		primary key(id),

	memberIdentifier varchar(64) not null unique,

	firstName	varchar(100) not null,
	lastName	varchar(100) not null,
	dateOfBirth	date not null,
	sex	char not null,
	physicalAddress	varchar(255) not null,
	phoneNumber	varchar(100) not null,
	email	varchar(255) not null unique,

	userIdentifier	integer not null,
		index userIdentifier_index (userIdentifier),
		foreign key (userIdentifier) references TablePrefix_User(id)

) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci ;



create table TablePrefix_Bike(
	id	integer auto_increment,
		primary key(id),

	bikeIdentifier varchar(70) not null unique,

	vendorName	varchar(70) not null,
	modelName	varchar(70) not null,
	serialNumber	varchar(80) not null,
	acquisitionDate	date not null,

	userIdentifier	integer not null,
		index userIdentifier_index (userIdentifier),
		foreign key (userIdentifier) references TablePrefix_User(id)

) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci ;

create table TablePrefix_Repair(
	id	integer auto_increment,
		primary key(id),

	creationDate	datetime not null,


	userIdentifier	integer not null,
		index userIdentifier_index (userIdentifier),
		foreign key (userIdentifier) references TablePrefix_User(id),

	bikeIdentifier	integer not null,
		index bikeIdentifier_index (bikeIdentifier),
		foreign key (bikeIdentifier) references TablePrefix_Bike(id),

	description	varchar(255) not null,

	completionDate	datetime not null,

	completionUserIdentifier	integer not null,
		index completionUserIdentifier_index (completionUserIdentifier)

) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci ;


create table TablePrefix_Place(

	id	integer auto_increment,
		primary key(id),

	name varchar(100) not null unique,

	userIdentifier	integer not null,
		index userIdentifier_index (userIdentifier),
		foreign key (userIdentifier) references TablePrefix_User(id)

) ENGINE = InnoDB  CHARACTER SET utf8 COLLATE utf8_general_ci;

create table TablePrefix_BikePlace(

	id	integer auto_increment,
		primary key(id),

	startingDate	datetime not null,



	placeIdentifier integer not null,
		index placeIdentifier_index (placeIdentifier),
		foreign key (placeIdentifier) references TablePrefix_Place(id),


	bikeIdentifier	integer not null,
		index bikeIdentifier_index (bikeIdentifier),
		foreign key (bikeIdentifier) references TablePrefix_Bike(id),

	userIdentifier	integer not null,
		index userIdentifier_index (userIdentifier),
		foreign key (userIdentifier) references TablePrefix_User(id)

) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci ;


create table TablePrefix_Loan(

	id	integer auto_increment,
		primary key(id),

	bikeIdentifier	integer not null,
		index bikeIdentifier_index (bikeIdentifier),
		foreign key (bikeIdentifier) references TablePrefix_Bike(id),

	userIdentifier	integer not null,
		index userIdentifier_index (userIdentifier),
		foreign key (userIdentifier) references TablePrefix_User(id),

	memberIdentifier integer not null,
		index memberIdentifier_index (memberIdentifier),
		foreign key (memberIdentifier) references TablePrefix_Member(id),

	placeIdentifier integer not null,
		index placeIdentifier_index (placeIdentifier),
		foreign key (placeIdentifier) references TablePrefix_Place(id),


	startingDate	datetime not null,
	expectedEndingDate	datetime not null,
	actualEndingDate	datetime not null,

	returnUserIdentifier	integer not null,
		index returnUserIdentifier_index (returnUserIdentifier),
		foreign key (returnUserIdentifier) references TablePrefix_User(id)


) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci ;


create table TablePrefix_Schedule(

	id	integer auto_increment,
		primary key(id),

	placeIdentifier integer not null,
		index placeIdentifier_index (placeIdentifier),
		foreign key (placeIdentifier) references TablePrefix_Place(id),

	startingDate date not null,
	endingDate date not null,

	userIdentifier	integer not null,
		index userIdentifier_index (userIdentifier),
		foreign key (userIdentifier) references TablePrefix_User(id)

) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci ;

create table TablePrefix_ScheduledDay (

	id	integer auto_increment,
		primary key(id),

	scheduleIdentifier integer not null,
		index scheduleIdentifier_index (scheduleIdentifier),
		foreign key (scheduleIdentifier) references TablePrefix_Schedule(id),

        dayOfWeek int not null,

	opened bool not null,
	openingTime time not null,
	returnTime time not null,
	eveningTime time not null,
	closingTime time not null,
	loanLength time not null

) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci ;

create table TablePrefix_MemberLock (

	id	integer auto_increment,
		primary key(id),

	memberIdentifier integer not null,
		index memberIdentifier_index (memberIdentifier),
		foreign key (memberIdentifier) references TablePrefix_Member(id),

	startingDate date not null,
	endingDate date not null,

	removed bool not null,
	explanation varchar(140) not null,

	userIdentifier	integer not null,
		index userIdentifier_index (userIdentifier),
		foreign key (userIdentifier) references TablePrefix_User(id)

) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci ;

create table TablePrefix_ClosedDay (

	id	integer auto_increment,
		primary key(id),

	placeIdentifier integer not null,
		index placeIdentifier_index (placeIdentifier),
		foreign key (placeIdentifier) references TablePrefix_Place(id),

	dayOfYear date not null,
	name varchar(100),


	userIdentifier	integer not null,
		index userIdentifier_index (userIdentifier),
		foreign key (userIdentifier) references TablePrefix_User(id)
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci ;


