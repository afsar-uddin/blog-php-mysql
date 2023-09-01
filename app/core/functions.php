<?php

create_table();
function create_table() {
    $string = "mysql:hostname=localhost;";
    $con = new PDO ($string, DBUSER, DBPASS);

    $query = "create database if not exists " . DBNAME;
    $stm = $con->prepare($query);
    $stm->execute();

    // table create for immediate previous db name

    /** users table */
    $query = "use " . DBNAME;
    $stm = $con->prepare($query);
    $stm->execute();

    $query = "create table if not exists users(
        id int primary key auto_increment,
        username varchar(50) not null,
        email varchar(100) not null,
        password varchar(500) not null,
        image varchar(1024) null,
        date datetime default current_timestamp,
        role varchar(10) not null,

        key username (username),
        key email (email)
    )";
    $stm = $con->prepare($query);
    $stm->execute();

    /** category table */
    $query = "create table if not exists categories(
        id int primary key auto_increment,
        category varchar(50) not null,
        slug varchar(100) not null,
        disabled tinyint default 0,
        
        key slug (slug),
        key category (category)
    )";
    $stm = $con->prepare($query);
    $stm->execute();

    /** post table */
    $query = "create table if not exists posts(
        id int primary key auto_increment,
        user_id int,
        category_id int,
        title varchar(100) not null,
        content text null,
        image varchar(1024) null,
        date datetime default current_timestamp,
        slug varchar(100) not null,
        
        key user_id (user_id),
        key category_id (category_id),
        key title (title),
        key slug (slug),
        key date (date)
    )";
    $stm = $con->prepare($query);
    $stm->execute();

    // print_r($con);
}