-- To be exec in the SQL platform: mySQL
-- Naming columns with spacings:
-- https://www.tutorialspoint.com/how-to-select-a-column-name-with-spaces-in-mysql
--
--
DROP TABLE IF EXISTS abusos;
CREATE TABLE abusos (
       id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
       Creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       Actualizado DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
       `id (usuario)` INTEGER NOT NULL,
       `NUIP (presunta víctima)` VARCHAR(20) NOT NULL,
       `Edad (presunta víctima)` INTEGER,
       `Entorno familiar` ENUM('SI', 'NO','INCIERTO'),
       Temporalidad ENUM('72-', '72+', 'INCIERTO'),
       Observaciones VARCHAR(250),
       CONSTRAINT fk_abusos_usuarios_id
       FOREIGN KEY (`id (usuario)`)
       REFERENCES usuarios(id)
) DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
-- alt: DEFAULT CHARACTER SET latin1/utf8 COLLATE latin1_spanish_ci/utf8_spanish_ci;
--
--
INSERT INTO abusos (`id (usuario)`, `NUIP (presunta víctima)`, `Edad (presunta víctima)`, `Entorno familiar`, Temporalidad)
VALUES (2,'1233456789', 12,'SI','72-');
