CREATE TABLE table_user(
   user_id INT,
   user_name VARCHAR(50),
   user_firstname VARCHAR(50),
   user_mail VARCHAR(255),
   user_password VARCHAR(255),
   user_phone VARCHAR(50),
   user_adress VARCHAR(50),
   user_birthdate DATE,
   user_profilepicture VARCHAR(255),
   user_date DATETIME,
   user_category_id INT NOT NULL,
   PRIMARY KEY(user_id),
   FOREIGN KEY(user_category_id) REFERENCES table_user_category(user_category_id)
);
