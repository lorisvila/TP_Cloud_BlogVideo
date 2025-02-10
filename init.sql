CREATE DATABASE web;

USE web;

CREATE TABLE videos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    video_id VARCHAR(255),
    title VARCHAR(255),
    comment TEXT
);

CREATE TABLE AdminUsers (
    user TEXT,
    password TEXT
);

INSERT INTO AdminUsers VALUES ('loris', 'VILA');

-- Create the user
CREATE USER 'phpServer'@'%' IDENTIFIED BY 'paT[zEc7WmNvhPrE';

-- Grant SELECT and INSERT privileges on the database to the user
GRANT SELECT, INSERT ON web.* TO 'phpServer'@'%';

-- Flush privileges to ensure that the changes take effect
FLUSH PRIVILEGES;