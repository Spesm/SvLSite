<?php

$createSvlSiteDB = "CREATE DATABASE svlsite";

$createUserTable = "CREATE TABLE users (
    nr INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id CHAR(6) UNIQUE NOT NULL,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    reg TINYINT(1) UNSIGNED DEFAULT 0 NOT NULL,
    pass VARCHAR(255),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";