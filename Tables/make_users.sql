-- To be exec in the SQL platform: mySQL
--
DROP TABLE IF EXISTS iiee;
CREATE TABLE iiee (
id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
nombre VARCHAR(50) NOT NULL UNIQUE,
codigo CHAR(12),
direccion VARCHAR(100),
tel VARCHAR(15)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
--
--
--
DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
       id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
       creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
       actualizado DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
       CC VARCHAR(20) NOT NULL UNIQUE,
       primer_nombre VARCHAR(25) NOT NULL,
       segundo_nombre VARCHAR(25),
       primer_apellido VARCHAR(25) NOT NULL,
       segundo_apellido VARCHAR(25) NOT NULL,
       email VARCHAR(50) NOT NULL UNIQUE,
       ie INTEGER NOT NULL,
       username VARCHAR(25) NOT NULL UNIQUE,
       password VARCHAR(250) NOT NULL,
 CONSTRAINT fk_usuarios_IIEE_id
 FOREIGN KEY (ie)
 REFERENCES iiee(id)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
--
--
DROP TABLE IF EXISTS estudiantes;
CREATE TABLE estudiantes (
id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
doc_type ENUM('CC', 'TI'),
-- NUIP: Número Único de Identificación Personal
NUIP VARCHAR(20) NOT NULL UNIQUE,
matricula VARCHAR(50) NOT NULL,
primer_nombre VARCHAR(25) NOT NULL,
segundo_nombre VARCHAR(25),
primer_apellido VARCHAR(25) NOT NULL,
segundo_apellido VARCHAR(25) NOT NULL,
fecha_nac DATE NOT NULL,
-- DATE FORMAT: YYY-MM-DD
gen ENUM('M','F'),
IE INTEGER NOT NULL
-- ADICIONAR OTROS DATOS: PADRES, DIR, TEL,
-- LUGAR DE EXP DOC IDEN, LUGAR DE NACIMIENTO, ETC.
) DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
-- alt: DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
--
--
--
INSERT INTO iiee (nombre,
                      codigo,
                      direccion,
                      tel)
VALUES ('JOVITA SANTA COLOMA','276834000666','CORREGIMIENTO DE NARIÑO','2315808'),
       ('CORAZÓN DEL VALLE','176834000351','KR 27 CL 22 EQ','2243201'),
       ('MONTELORO','276834000917','CORREGIMIENTO MONTELORO',''),
('MARÍA ANTONIA RUÍZ','176834000394','CL 29 # 30-61','2242361'),
('AGUACLARA','276834001778','AV PPAL # 26-36',''),
       ('ALTO ROCÍO','276834000941','VEREDA ALTO ROCIO',''),
       ('SAN JUAN DE BARRAGÁN','276834000704','CORREGIMIENTO BARRAGÁN','2260908'),
       ('SAN RAFAEL','276834001077','CORREGIMIENTO SAN RAFAEL',''),
('TÉCNICO INDUSTRIAL CARLOS SARMIENTO LORA','176834000289','KR 30 # 10-00','2243289'),
('JULIA RESTREPO','176834000092','CL 27 # 33-42','2243531'),
       ('OCCIDENTE','176834003989','IND VIA TRES ESQUINAS','2306584'),
       ('JULIO CESAR ZULUAGA','276834002626','CORREGIMIENTO TRES ESQUINAS','2309473'),
('ALFONSO LÓPEZ PUMAREJO','176834003946','KR 23 # 14-54','2244842'),
       ('LA MARINA','276834002243','CORREGIMIENTO LA MARINA','2260776'),
       ('JUAN MARÍA CÉSPEDES','176834002559','CL 14 KR 15 EQ','2323893'),
('LA MORALIA','276834001239','CORREGIMIENTO LA MORALIA','2265452'),
       ('GIMNASIO DEL PACÍFICO','176834000084','CLL 34 KR 36','2243239'),
       ('MODERNA DE TULUÁ','176834000106','CL 27 VI RIOFRÍO','2307122');
--
--
INSERT INTO usuarios (CC,primer_nombre, segundo_nombre,primer_apellido,segundo_apellido, email,ie,username,password)
VALUES ('1987654321', 'María', 'José','Pombo', 'Cruz', 'pombo80@outlook.com', '11', 'majoPC', '$2y$10$hZ7yz4C2quA4/mVhzZVMhu7W6q68ldFFo93EZwaZcsFIlIprJ2fmG'),('1234567891', 'Pedro','Luis', 'Zuleta', 'Gómez', 'pzuleta79@gmail.com', '4', 'pedroluz', '$2y$10$MZtzYlXIjsFElkdZU6WdNO5ZI1usPnJh/wqUD3Xb9vEi7d0KDcjJC');
--
--
INSERT INTO estudiantes (doc_type,NUIP,matricula,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,fecha_nac,gen,ie) VALUES ('TI','1234567899','9988','Carlos','Hernán','Ramírez','Pérez','2010-02-25','M','4'),('TI','1123456789','2277','Diana','Patricia','Espitia','Guzmán','2012-11-21','F','11'),('TI','1234456789','1551','Lorena','','Agudelo','Pinillos','2012-01-11','F','11');
--
-- contraseña de pedroluz: 12345678
-- contraseña de majoPC: 87654321
-- codificación de contraseña según sha-256 (64 dígitos alfanuméricos).

