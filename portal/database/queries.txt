create database database_project_cs355;
create table professor (User_ID varchar(20),Name varchar(50),Email varchar(50),Department varchar(50),primary key(User_ID));
create table publication (Paper_ID varchar(50),Name varchar(50),Type varchar(20),YearofPub varchar(20),primary key(Paper_ID));
create table project (Paper_ID varchar(50),Name varchar(50),Budget double,YearofPro varchar(20),primary key(Paper_ID));
create table publisher(User_ID varchar(20),Paper_ID varchar(50),Acknowledgement int ,primary key(User_ID,Paper_ID),constraint fk_1 foreign key (User_ID) references professor(User_ID),constraint fk_2 foreign key (Paper_ID) references Publication(Paper_ID) );
create table project_own(User_ID varchar(20),Paper_ID varchar(50),Acknowledgement int ,primary key(User_ID,Paper_ID),constraint fk_3 foreign key (User_ID) references professor(User_ID),constraint fk_4 foreign key (Paper_ID) references Project(Paper_ID) );

create table count_of_pub(ct int(10));
create table count_of_proj(ct int(10));
delimiter $$
create procedure prof_dummy(in val int) begin declare i int default 1;
while i<=val do insert into professor values (i,concat('Abc',i,'bsd'),concat('Abc',i,'@iitp.ac.in'),'CSE');
set i=i+1;
end while;
end$$
delimiter ;

call procAccDummyData(8);


delimiter $$
create procedure pub_dummy(in val int) begin declare i int default 1;
while i<=val do insert into publication values (i,concat('Pub',i,'p'),1,concat('201',i));
set i=i+1;
end while;
end$$
delimiter ;

call pub_dummy(8);


delimiter $$
create procedure proj_dummy(in val int) begin declare i int default 1;
while i<=val do insert into project values (100+i,concat('Proj',i,'p'),245,concat('201',i));
set i=i+1;
end while;
end$$
delimiter ;

call proj_dummy(8);

DELIMITER $$
CREATE TRIGGER before_workcenters_insert BEFORE INSERT ON WorkCenters FOR EACH ROW BEGIN DECLARE rowcount INT;
SELECT COUNT(*) INTO rowcount FROM WorkCenterStats;
IF rowcount > 0 THEN UPDATE WorkCenterStats SET totalCapacity = totalCapacity + new.capacity; ELSE INSERT INTO WorkCenterStats(totalCapacity) VALUES(new.capacity); END IF; 
END $$
DELIMITER ;
