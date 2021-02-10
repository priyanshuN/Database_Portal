create database database_project_cs355;
create table professor (User_ID varchar(20),Name varchar(50),Email varchar(50),Department varchar(50),primary key(User_ID));
create table publication (Paper_ID varchar(50),Name varchar(50),Type varchar(20),YearofPub varchar(20), research_area varchar(50),primary key(Paper_ID));
create table project (Paper_ID varchar(50),Name varchar(50),Budget double,YearofPro varchar(20),research_area varchar(50),primary key(Paper_ID));
create table publisher(User_ID varchar(20),Paper_ID varchar(50),Acknowledgement int ,hash varchar(50),primary key(User_ID,Paper_ID),constraint fk_1 foreign key (User_ID) references professor(User_ID),constraint fk_2 foreign key (Paper_ID) references Publication(Paper_ID) );
create table project_own(User_ID varchar(20),Paper_ID varchar(50),Acknowledgement int ,hash varchar(50),primary key(User_ID,Paper_ID),constraint fk_3 foreign key (User_ID) references professor(User_ID),constraint fk_4 foreign key (Paper_ID) references Project(Paper_ID) );
create table count_of_pub(ct int(10));
create table count_of_proj(ct int(10));



CREATE TABLE `login` (
  `Sno` int(21) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `login`
  ADD PRIMARY KEY (`Sno`),
  ADD UNIQUE KEY `Email` (`Email`);

ALTER TABLE `login`
  MODIFY `Sno` int(21) NOT NULL AUTO_INCREMENT;
COMMIT;



delimiter $$
create procedure prof_dummy(in val int) begin declare i int default 1;
declare tempi int default 1;
declare sas varchar(50);
while i<=val do
set tempi=floor(rand()*6)+1;
if tempi =1 then
set sas=concat('A',rand()*100000,i,'@iitp.ac.in');
insert into professor values(i,concat('A',round(rand()*100000),i,'bsd'),sas,'CS');
insert into login(Email,Password) values (sas,'pass');
end if;

if tempi =2 then
set sas=concat('B',rand()*100000,i,'@iitp.ac.in');
insert into professor values(i,concat('df',round(rand()*100000),i,'bsd'),sas,'CE');
insert into login(Email,Password) values (sas,'pass');
end if;

if tempi =3 then
set sas = concat('C',rand()*100000,i,'@iitp.ac.in');
insert into professor values (i,concat('B',round(rand()*100000),i,'bsd'),sas,'ME');
insert into login(Email,Password) values (sas,'pass');
end if;

if tempi =4 then
set sas = concat('D',rand()*100000,i,'@iitp.ac.in');
insert into professor values (i,concat('W',round(rand()*100000),i,'bsd'),sas,'EE');
insert into login(Email,Password) values (sas,'pass');
end if;

if tempi =5 then
set sas = concat('E',rand()*100000,i,'@iitp.ac.in');
insert into professor values (i,concat('Q',round(rand()*100000),i,'bsd'),sas,'MC');
insert into login(Email,Password) values (sas,'pass');
end if;

if tempi =6 then
set sas = concat('F',rand()*100000,i,'@iitp.ac.in');
insert into professor values (i,concat('Q',round(rand()*100000),i,'bsd'),sas,'CH');
insert into login(Email,Password) values (sas,'pass');
end if;

set i=i+1;
end while;
end$$
delimiter ;

call prof_dummy(303);
drop procedure prof_dummy;


delimiter $$
create procedure pub_dummy(in val int) begin declare i int default 1;
declare tempo int default 1;
declare j int default 1;
declare tempiii int default 1;

while i<=1500 do 

set tempo=floor(rand()*4);
if tempo=0
then
insert into publication values (i,concat('Pub',i,'p'),'Paper',floor(4*rand())+2016,'ML');
end if;

if tempo=1
then
insert into publication values (i,concat('Journ',i,'p'),'Journal',floor(4*rand())+2016,'robotics');
end if;



if tempo=2
then
insert into publication values (i,concat('Journ',i,'p'),'Journal',floor(4*rand())+2016,'DBMS');
end if;


if tempo=3
then
insert into publication values (i,concat('Pub',i,'p'),'Paper',floor(4*rand())+2016,'Blockchain');
end if;

set i=i+1;
end while;
set i=1;
while i<=val do 

set tempo=floor(rand()*4);
if tempo=0
then
set tempiii=floor(290*rand())+1;
insert into publisher values(tempiii,i,0,floor(1000*rand()));
end if;

if tempo=1
then
set tempiii=floor(150*rand())+1;
insert into publisher values(tempiii,i,0,floor(1000*rand()));
set tempiii=floor(110*rand())+160;
insert into publisher values(tempiii,i,0,floor(1000*rand()));
end if;


if tempo=2
then
set tempiii=floor(100*rand())+1;
insert into publisher values(tempiii,i,0,floor(1000*rand()));
set tempiii=floor(100*rand())+103;
insert into publisher values(tempiii,i,0,floor(1000*rand()));
set tempiii=floor(90*rand())+206;
insert into publisher values(tempiii,i,0,floor(1000*rand()));
end if;

if tempo=3
then
set tempiii=floor(75*rand())+1;
insert into publisher values(tempiii,i,0,floor(1000*rand()));
set tempiii=floor(75*rand())+80;
insert into publisher values(tempiii,i,0,floor(1000*rand()));
set tempiii=floor(40*rand())+160;
insert into publisher values(tempiii,i,0,floor(1000*rand()));
set tempiii=floor(70*rand())+210;
insert into publisher values(tempiii,i,0,floor(1000*rand()));
end if;
set i=i+1;
end while;

end$$
delimiter ;

drop procedure pub_dummy;



call pub_dummy(1500);



delimiter $$
create procedure proj_dummy(in val int) begin declare i int default 1;
declare tempo int default 1;
declare j int default 1;
declare tempiii int default 1;

while i<=1500 do 

set tempo=floor(rand()*4);
if tempo=0
then
insert into project values (i,concat('Proj',i,'p'),floor(100000*rand()),floor(4*rand())+2016,'ML');
end if;

if tempo=1
then
insert into project values (i,concat('Proj',i,'p'),floor(100000*rand()),floor(4*rand())+2016,'robotics');
end if;



if tempo=2
then
insert into project values (i,concat('Proj',i,'p'),floor(100000*rand()),floor(4*rand())+2016,'DBMS');
end if;


if tempo=3
then
insert into project values (i,concat('Proj',i,'p'),floor(100000*rand()),floor(4*rand())+2016,'Blockchain');
end if;

set i=i+1;
end while;
set i=1;
while i<=val do 

set tempo=floor(rand()*4);
if tempo=0
then
set tempiii=floor(290*rand())+1;
insert into project_own values(tempiii,i,0,floor(100*rand()));
end if;

if tempo=1
then
set tempiii=floor(150*rand())+1;
insert into project_own values(tempiii,i,0,floor(1000*rand()));
set tempiii=floor(110*rand())+160;
insert into project_own values(tempiii,i,0,floor(1000*rand()));
end if;


if tempo=2
then
set tempiii=floor(100*rand())+1;
insert into project_own values(tempiii,i,0,floor(1000*rand()));
set tempiii=floor(100*rand())+103;
insert into project_own values(tempiii,i,0,floor(1000*rand()));
set tempiii=floor(90*rand())+206;
insert into project_own values(tempiii,i,0,floor(1000*rand()));
end if;

if tempo=3
then
set tempiii=floor(75*rand())+1;
insert into project_own values(tempiii,i,0,floor(1000*rand()));
set tempiii=floor(75*rand())+80;
insert into project_own values(tempiii,i,0,floor(1000*rand()));
set tempiii=floor(40*rand())+160;
insert into project_own values(tempiii,i,0,floor(1000*rand()));
set tempiii=floor(70*rand())+210;
insert into project_own values(tempiii,i,0,floor(1000*rand()));
end if;
set i=i+1;
end while;

end$$
delimiter ;


call proj_dummy(1500);

drop procedure proj_dummy;


delete from project_own;
delete from publisher;
delete from professor;
 delete from project;
delete from publication;
delete from login;

set profiling=1;
show profiles;


select budget from project where budget >100 and budget <10003;0.0016,0.0005
insert into publication values('10000','ih','paper',2018,'ML');
delete from publication where Paper_Id='10000';
select name from project where name = 'Proj991p';0.0007,0.0004
select name from professor where name = 'A211234bsd';
select Paper_id from publisher where User_Id=167;
select * from professor where Email regexp 'A[0-9].[0-9]@iitp.ac.in';


