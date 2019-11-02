# Guvi_Task
**HOW TO RUN THIS APPLICATION**
1. create database in mysql useing xampp 
2. run the web application on server (localhost/guvi/index.html)
3. seprated files has been mentioend under the different folders
**DATABASE**
create database **guvi**;
use guvi;
**table name**
create table user(
id int unsigned primary key auto_increment,
ts timestamp default now(),
email varchar(50) unique not null,
password varchar(100) not null,
name varchar(100),
address varchar(150),
country varchar(100),
city varchar(100),
state varchar(100),
phone varchar(15),
age tinyint
);
