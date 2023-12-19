CREATE TABLE USERS (
    user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE CATEGORY (
    category_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(255) NOT NULL
);

CREATE TABLE EXPENSE (
    expense_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    item_name VARCHAR(255) NOT NULL,
    price FLOAT NOT NULL,
    details TEXT NOT NULL,
    added_date DATE NOT NULL
);

INSERT INTO USERS (USERNAME, PASSWORD)
VALUES ("admin", "admin");

INSERT INTO CATEGORY (CATEGORY_NAME)
VALUES ("Food");

INSERT INTO CATEGORY (CATEGORY_NAME)
VALUES ("Travel");