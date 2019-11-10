delimiter $
create procedure test @tname as nvarchar(255),@mail as nvarchar (30) as begin declare @sqlst as nvarchar(max);
set @sqlst =N'select * from ' + @tname+N' where '+@mail;
exec(@sqlst);
end $
delimiter ;
exec test 'login','priyanshunandan17@gmail.com'; 

/* Transact-Sql to create the table tblEmployees */
delimiter $$
create procedure test (in mail varchar(30)) begin set @t1=concat("select * from login where Email='",mail,"'");
prepare st from @t1;
execute st;
deallocate prepare st;
end $$
delimiter ;

delimiter $$
create procedure squery_wnb(in name varchar(200),in paper varchar(10),in journal varchar(10),in year_ varchar(10)) begin set @t1=concat("select * from publication where Name='",name,"'"," and (Type='",paper,"'"," or Type='",journal,"'",") and YearofPub='",year_,"'");
prepare st from @t1;
execute st;
deallocate prepare st;
end $$
delimiter ; 

delimiter $$
create procedure test1 (in mail varchar(30)) begin set @t1="select * from login where (1=1)";
if(mail!="") then set @t1=concat(@t1," and Email='",mail,"'");
end if;
prepare st from @t1;
execute st;
deallocate prepare st;
end $$
delimiter ;

delimiter $$
create procedure search_wb(in name varchar(200),in paper varchar(10),in journal varchar(10),in year_ varchar(10)) begin set @t1="select * from publication where (1=1)";
if(name!="") then set @t1=concat(@t1," and Name='",name,"'");
end if;
if(paper!="" and journal="") then set @t1=concat(@t1," and Type='",paper,"'");
end if;
if(paper="" and journal!="") then set @t1=concat(@t1," and Type='",journal,"'");
end if;
if(year_!="") then set @t1=concat(@t1," and YearofPub='",year_,"'");
end if;
prepare st from @t1;
execute st;
deallocate prepare st;
end $$
delimiter ;

delimiter $$
create procedure search_b(in name varchar(200),in year_ varchar(10),in budget double,in up double,in lo double) begin set @t1="select * from project where (1=1)";
if(name!="") then set @t1=concat(@t1," and Name='",name,"'");
end if;
if(budget!=-1) then set @t1=concat(@t1," and Budget='",budget,"'");
elseif(lo>=0) then set @t1=concat(@t1," and Budget>=",lo," and Budget<=",up);
end if;
if(year_!="") then set @t1=concat(@t1," and YearofPro='",year_,"'");
end if;
prepare st from @t1;
execute st;
deallocate prepare st;
end $$
delimiter ;