delimiter $$
create procedure pub_dummy(in val int) begin declare i int default 1;
declare tempo int default 1;
declare j int default 1;
declare tempi int default 1;
declare tempiii int default 1;

while i<=val do 
set i=i+1;
set tempo=floor(rand()*2);
if tempo=0
then
insert into publication values (i,concat('Pub',i,'p'),'Paper',floor(4*rand())+2016);
set tempiii=floor(7*rand())+1;
while tempiii>=1 do
set tempiii=tempiii-1;
set tempi= floor((299-tempi)*rand()+1)+tempi;
insert into publication_own(tempi,i,0,Hash('MD5',rand(0,1000)));
if tempi>=295 then 
break;
end if;
end while;
end if;
if tempo=1
then
insert into publication values (i,concat('Journ',i,'p'),'Journal',floor(4*rand())+2016);
end if;
if tempo=2
then
insert into publication values (i,concat('Journ',i,'p'),'Journal',floor(4*rand())+2016);
end if;
end while;

end$$
delimiter ;

call pub_dummy(8);






call proj_dummy(8);

DELIMITER $$
CREATE TRIGGER before_workcenters_insert BEFORE INSERT ON WorkCenters FOR EACH ROW BEGIN DECLARE rowcount INT;
SELECT COUNT(*) INTO rowcount FROM WorkCenterStats;
IF rowcount > 0 THEN UPDATE WorkCenterStats SET totalCapacity = totalCapacity + new.capacity; ELSE INSERT INTO WorkCenterStats(totalCapacity) VALUES(new.capacity); END IF; 
END $$
DELIMITER ;
