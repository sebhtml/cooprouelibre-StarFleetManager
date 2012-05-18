alter table TablePrefix_Member add column creationTime datetime not null;

update TablePrefix_Member set creationTime = '2012-05-17 9:00:00' ;


