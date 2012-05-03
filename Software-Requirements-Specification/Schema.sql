create table TablePrefix_Member(
	id	integer auto_increment,
		primary key(id),
	memberIdentifier varchar(255) not null,
	firstName	varchar(255) not null,
	lastName	varchar(255) not null,
	dateOfBirth	date not null,
	sex	char not null,
	physicalAddress	varchar(255) not null,
	phoneNumber	varchar(255) not null,
	email	varchar(255) not null unique
);

create table TablePrefix_User(
	id	integer auto_increment,
		primary key(id),
	username	varchar(255) not null unique,
	md5Password	char(32) not null,	
	firstName	varchar(255) not null,
	lastName	varchar(255) not null
);

create table TablePrefix_Bike(
	id	integer auto_increment,
		primary key(id),
	bikeIdentifier varchar(255) not null,
	vendorName	varchar(255) not null,
	modelName	varchar(255) not null,
	serialNumber	varchar(255) not null,
	acquisitionDate	date not null
);

create table TablePrefix_Repair(
	id	integer auto_increment,
		primary key(id),
	creationTime	datetime not null,
	bikeIdentifier	integer not null,
		index bikeIdentifier_index (bikeIdentifier),
		foreign key (bikeIdentifier) references TablePrefix_Bike(id),
	description	varchar(255) not null,
	userIdentifier	integer not null,
		index userIdentifier_index (userIdentifier),
		foreign key (userIdentifier) references TablePrefix_User(id),
	repairIsCompleted	bool not null,
	completionTime	datetime not null
);

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

	startingDate	datetime not null,
	expectedEndingDate	datetime not null,
	actualEndingDate	datetime not null

);

create table TablePrefix_Place(

	id	integer auto_increment,
		primary key(id),

	name varchar(255) not null
);

create table TablePrefix_Schedule(

	id	integer auto_increment,
		primary key(id),

	placeIdentifier integer not null,
		index placeIdentifier_index (placeIdentifier),
		foreign key (placeIdentifier) references TablePrefix_Place(id),

	startingDate date not null,
	endingDate date not null

);

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
);

create table TablePrefix_Holiday (

	id	integer auto_increment,
		primary key(id),

	dayOfYear date not null,
	name varchar(100)
);


