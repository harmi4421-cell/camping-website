CREATE DATABASE camping_db;

USE camping_db;

CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(255)
);

CREATE TABLE contact_messages(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    message TEXT
);

CREATE TABLE products(
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100),
    price INT,
    image VARCHAR(255)
);

INSERT INTO products(product_name,price,image) VALUES
('Camping Tent',2500,'tents.jpg'),
('Sleeping Bag',1500,'bags.jpg'),
('Camp Stove',3000,'stoves.jpg'),
('Backpack',2000,'backpacks.jpg'),
('Camp Chair',1800,'chair.jpg'),
('Camp Light',1200,'light.jpg');
