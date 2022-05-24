--
-- Formato para base de datos de reportes para el
-- Asistente de Rutas
--
-- OBSERVACIONES:
-- Precaución en tabla 'abusos': Reporte de 'rel_agr' (columna) 
-- por parte de la institución educativa puede conllevar a 
-- revictimización.  
-- Valores en columna 'entorno', relevantes si
-- columna 'rel_agr_vic' es evaluada en 'Otros' o 'Incierto'.
--
-- CONSTRAINT asocia columna 'id' en tabla 'usuarios'
-- (make_basic) con columna 'account_id' en
-- tabla 'abusos'.
--
-- 
-- Tabla de reportes de 'abuso' (sexual)
--
-- OBSERVATIONS
--
-- NUIP: Número Único de Identificación Personal
-- Commented out 'IE' and 'gen_vic' because this info can be found in the presu victim profile and/or user profile.
-- Commented out 'rel_agr': relevant info but not appropriate to be reported by teacher, but a psychologist at health center.
--
DROP TABLE IF EXISTS 'abusos';
CREATE TABLE 'abusos' (
       'id' INTEGER PRIMARY KEY NOT NULL,
       'creado' DATETIME DEFAULT (DATETIME('now','LocalTime')),
       'usuario_id' INTEGER NOT NULL,
       'NUIP_vic' VARCHAR(20) NOT NULL UNIQUE,
       'edad_vic' INTEGER,
       'entorno' VARCHAR(2) CHECK (entorno IN ('SI', 'NO','INCIERTO')),
       'temporalidad' VARCHAR(50) CHECK (temporalidad IN ('72-', '72+')),
       'observ' VARCHAR(250),
       CONSTRAINT 'fk_abusos_usuarios_id' 
       FOREIGN KEY ('usuario_id') 
       REFERENCES usuarios(id)
);
--
--
--
-- INCLUIR 'IE' PORQUE LA PRESU VIC PUEDE CAMBIAR DE COLEGIO, IGUAL INCLUIR 'GENERO'.
--    'IE' INTEGER NOT NULL,
--  'entorno' VARCHAR(50) CHECK (entorno IN ('FamiliaGrado_1', 'FamiliaGrado_2', 'Colegio', 'Otros', 'Incierto')),
--      Within CHECK, use rel_agr, not 'rel_agr'.
--     'rel_agr' VARCHAR(50) CHECK (rel_agr IN ('Padre_biológico', 'Madre_biológica', 'Padrastro', 'Madrastra', 'Abuelo_materno', 'Abuela_materna', 'Abuelo_paterno', 'Abuela_paterna', 'Hermano_biológico', 'Hermana_biológica', 'Hermanastro', 'Hermanastra', 'Tío_biológico', 'Tía_biológica', 'Tío_político', 'Tía_política', 'Amigo_de_la_Familia', 'Amiga_de_la_Familia', 'Vecino', 'Vecina', 'Profesor', 'Profesora', 'Compañero_colegio', 'Compañera_colegio', 'Otros', 'Incierto')),
--
--
--
--
--
--
--
--
--
--
-- Useful for 'created' column:
-- https://social.msdn.microsoft.com/Forums/sqlserver/en-US/e91a7c8e-7bf0-4506-836e-db3650cafe00/set-default-value-for-datetime-column?forum=transactsql
--
-- Useful for expire' column:
-- SQL Server: 
-- https://www.w3schools.com/sql/func_sqlserver_dateadd.asp
-- SQLite: 
-- https://stackoverflow.com/questions/1845563/sqlite-equivalent-of-sql-server-dateadd-function
--
--
-- Insertar info inicial
--
INSERT INTO 'abusos' ('usuario_id', 'NUIP_vic', 'entorno', 'temporalidad')
VALUES (2,'1233456789','SI','72-');
