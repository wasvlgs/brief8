CREATE DATABASE brief8


CREATE TABLE users(ID_user int(11) AUTO_INCREMENT PRIMARY KEY, nom varchar(150), prenom varchar(150), email varchar(255) UNIQUE, password varchar(150), Adresse varchar(255), num varchar(150),type enum("admin","user"));


CREATE TABLE menus(ID_menu int(11) AUTO_INCREMENT PRIMARY KEY, titre varchar(155), prix decimal(10,2),imgSrc varchar(550))


CREATE TABLE reservation(ID_reservation int(11) AUTO_INCREMENT PRIMARY KEY, ID_user int(11), ID_menu int(11), Date_reservation date, Time_reservation time)


CREATE TABLE plats (ID_plat INT AUTO_INCREMENT PRIMARY KEY, ID_menu INT, Titre VARCHAR(150), Description TEXT, imgSrc VARCHAR(550), FOREIGN KEY (ID_menu) REFERENCES menus(ID_menu) ON DELETE CASCADE ON UPDATE CASCADE);


ALTER TABLE reservation ADD places_disponibles INT(11) NOT NULL AFTER Adresse;


CREATE TABLE role(ID_role int(11) AUTO_INCREMENT PRIMARY KEY, titre varchar(255))


ALTER TABLE users CHANGE type type INT(11);


ALTER TABLE users ADD CONSTRAINT role FOREIGN KEY (type) REFERENCES role(ID_role) ON DELETE CASCADE ON UPDATE CASCADE;


INSERT INTO role(titre) VALUES("admin")


INSERT INTO role(titre) VALUES("client")


INSERT INTO users(nom,prenom,email,password,Adresse,num,type) VALUES("Yazza","Wassim","wassim@gmail.com","123456","Safi, Miftah el khair","0647102474",1);
INSERT INTO users(nom,prenom,email,password,Adresse,num,type) VALUES("Merzok","Yacine","yacine@gmail.com","yacine123","Safi, souk lkhanz","0617151277",2);


INSERT INTO menus(titre,prix,imgSrc) VALUES("Extra menu",1560,"hero-bg.jpg")

INSERT INTO plats(ID_menu,Titre,Description,imgSrc) VALUES(1,"Tajine","Best tajine with lhem bl berkouk","hero-bg.jpg");
INSERT INTO plats(ID_menu,Titre,Description,imgSrc) VALUES(1,"Pastishu","Pastishu bl kefta and fromage","hero-bg.jpg");


INSERT INTO reservation(ID_user,ID_menu,Date_reservation,Time_reservation,Adresse,places_disponibles) VALUES(2,1,"2024-12-25","10:45:00","Marrakech, bab dokala",15)