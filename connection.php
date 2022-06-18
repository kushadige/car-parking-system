<?php
// Connecting to the database
$servername = "localhost";
$username = "root";
$password = "";
$database = "dbOtopark";

// Die if connection was not successful
if(!($con = mysqli_connect($servername, $username, $password, $database))){

    
    $conn = mysqli_connect($servername, $username, $password);
    if(!$conn){
        die("baglanti kurulamadi");
    }

    // Create a database
    $sql = "DROP DATABASE IF EXISTS {$database};";
    mysqli_query($conn, $sql);
    $sql = "CREATE DATABASE {$database};";
    mysqli_query($conn, $sql);


    // SQL SORGULARI TABLO OLUŞTURMA VE KAYIT EKLEME

    $con = mysqli_connect($servername, $username, $password, $database);
    if(!$con){
        die("baglanti kurulamadi");
    }

    $sql = "CREATE TABLE users(
        fname VARCHAR(20), 
        lname VARCHAR(20),
        email VARCHAR(30) PRIMARY KEY,
        plaka VARCHAR(20),
        sifre VARCHAR(20));";
    mysqli_query($con, $sql);

    $sql = "INSERT INTO users(fname, lname, email, plaka, sifre) VALUES
    ('Oguzhan','Kuslar','ok@gmail.com','46HY084','12331233'),
    ('Talip','Iskender','ts@outlook.com','34FZR153','sifresifre'),
    ('Ferit','Asil','fs@gmail.com','12TY987','1235'),
    ('Sevinc','Timur','st@gmail.com','5CMT016','1233'),
    ('Ziynet','Ilyas','zi@gmail.com','8EGJ271','1233'),
    ('Caner','Yeter','cy@gmail.com','8KA849','1233'),
    ('Yildirim','Aysima','ya@gmail.com','8CRM824','1233'),
    ('Ahmet','Ensar','ae@gmail.com','6JCX520','1233');";
    mysqli_query($con, $sql);

    $sql = "CREATE TABLE io_info(
        plaka VARCHAR(20),
        giris_gun VARCHAR(30),
        giris_saat VARCHAR(30), 
        cikis_gun VARCHAR(30),
        cikis_saat VARCHAR(30),
        section VARCHAR(3),
        ucret FLOAT);";
    mysqli_query($con, $sql);

    $sql = "CREATE TABLE otopark(
        section VARCHAR(3) PRIMARY KEY,
        plaka VARCHAR(20) DEFAULT NULL);";
    mysqli_query($con, $sql);

    $sql = "INSERT INTO otopark(section) VALUES('A1'),('A2'),('A3'),('A4'),('A5'),('A6'),('A7'),('A8'),('A9'),('A10'),('A11'),('A12'),
    ('B1'),('B2'),('B3'),('B4'),('B5'),('B6'),('B7'),('B8'),('B9'),('B10'),('B11'),('B12'),
    ('B13'),('B14'),('B15'),('B16'),('B17'),('B18'),('B19'),('B20'),('B21'),('B22'),('B23'),('B24'),
    ('C1'),('C2'),('C3'),('C4'),('C5'),('C6'),('C7'),('C8'),('C9'),('C10'),('C11'),('C12');";
    mysqli_query($con, $sql);
    
}