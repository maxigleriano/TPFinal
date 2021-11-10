create database tpfinal;

use database tpfinal;

create table user_roles (
    role_id int not null,
    role_name varchar(30) not null,
    constraint PK_roles primary key (role_id)
);

insert into user_roles (role_id, role_name) values (1, "admin");

insert into user_roles (role_id, role_name) values (2, "student");

create table companies (
    company_id int not null auto_increment,
    company_name varchar(50) not null,
    company_city varchar(50),
    company_address varchar(50),
    company_email varchar(50),
    company_phone varchar(50),
    company_cuit varchar(50),
    constraint PK_companies primary key (company_id)
);

create table offers (
    offer_id int not null auto_increment,
    beginning_date date,
    ending_date date,
    job_position int not null,
    career_id int not null,
    company_id int not null,
    constraint PK_offers primary key (offer_id),
    constraint FK_offer_company foreign key (company_id) references companies (company_id) on delete cascade
);

create table users (
    user_id int not null auto_increment,
    user_role int not null,
    user_name varchar(50),
    user_last_name varchar(50),
    user_email varchar(50) not null,
    user_password varchar(255) not null,
    constraint PK_users primary key (user_id),
    constraint FK_user_role foreign key (user_role) references user_roles (role_id)
);

insert into users (user_role, user_email, user_password) VALUES (1, "admin@admin.com", "$2y$10$g.rDY2kWB7NjbI2KSw3A0uD598CylkstjVuxLUilsVa8VC9muCcPy");

create table postulations (
    postulation_id int not null auto_increment,
    user_id int not null,
    offer_id int not null,
    user_curriculum varchar(50),
    user_message varchar(500),
    constraint PK_postulations primary key (postulation_id),
    constraint FK_postulation_user foreign key (user_id) references users (user_id),
    constraint FK_postulation_offer foreign key (offer_id) references offers (offer_id) on delete cascade
);
