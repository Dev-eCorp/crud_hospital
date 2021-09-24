DROP SCHEMA IF EXISTS hospital;
CREATE SCHEMA hospital;

USE hospital;

CREATE TABLE usuarios(documento BIGINT NOT NULL, usuario VARCHAR(40) NOT NULL, clave VARCHAR(40) NOT NULL, PRIMARY KEY(documento));
INSERT INTO usuarios(documento, usuario, clave) VALUES (1234567890, 'administrador', 1234567890);

CREATE TABLE departamentos(id TINYINT NOT NULL AUTO_INCREMENT, nombre VARCHAR(40) NOT NULL, PRIMARY KEY(id));
INSERT INTO departamentos(id, nombre) VALUES (NULL, 'Antioquia');
INSERT INTO departamentos(id, nombre) VALUES (NULL, 'Huila');
INSERT INTO departamentos(id, nombre) VALUES (NULL, 'Amazonas');
INSERT INTO departamentos(id, nombre) VALUES (NULL, 'Cesar');
INSERT INTO departamentos(id, nombre) VALUES (NULL, 'Tolima');

CREATE TABLE municipios(id INT(11) NOT NULL AUTO_INCREMENT, departamento_id TINYINT NOT NULL, nombre VARCHAR(40) NOT NULL, PRIMARY KEY(id));
ALTER TABLE municipios ADD CONSTRAINT fk_municipios_departamentos FOREIGN KEY (departamento_id) REFERENCES departamentos(id) ON DELETE RESTRICT ON UPDATE RESTRICT;
INSERT INTO municipios(id, departamento_id, nombre) VALUES (NULL, 1, 'Medellin');
INSERT INTO municipios(id, departamento_id, nombre) VALUES (NULL, 1, 'Bello');
INSERT INTO municipios(id, departamento_id, nombre) VALUES (NULL, 2, 'Neiva');
INSERT INTO municipios(id, departamento_id, nombre) VALUES (NULL, 2, 'Baraya');
INSERT INTO municipios(id, departamento_id, nombre) VALUES (NULL, 3, 'Leticia');
INSERT INTO municipios(id, departamento_id, nombre) VALUES (NULL, 3, 'Puerto Nariño');
INSERT INTO municipios(id, departamento_id, nombre) VALUES (NULL, 4, 'Valledupar');
INSERT INTO municipios(id, departamento_id, nombre) VALUES (NULL, 4, 'Aguachica');
INSERT INTO municipios(id, departamento_id, nombre) VALUES (NULL, 5, 'Espinal');
INSERT INTO municipios(id, departamento_id, nombre) VALUES (NULL, 5, 'Ibague');

CREATE TABLE tipos_documento(id TINYINT NOT NULL AUTO_INCREMENT, nombre VARCHAR(40) NOT NULL, PRIMARY KEY(id));
INSERT INTO tipos_documento(id, nombre) VALUES (NULL, 'Cedula de ciudadania');
INSERT INTO tipos_documento(id, nombre) VALUES (NULL, 'Documento de identidad');

CREATE TABLE genero(id TINYINT NOT NULL AUTO_INCREMENT, nombre VARCHAR(40) NOT NULL, PRIMARY KEY(id));
INSERT INTO genero(id, nombre) VALUES (NULL, 'Masculino');
INSERT INTO genero(id, nombre) VALUES (NULL, 'Femenino');
INSERT INTO genero(id, nombre) VALUES (NULL, 'No binario');

CREATE TABLE paciente(id INT(11) NOT NULL AUTO_INCREMENT, tipo_documento_id TINYINT NOT NULL, numero_documento BIGINT NOT NULL, nombre1 VARCHAR(40) NOT NULL, nombre2 VARCHAR(40) NOT NULL, apellido1 VARCHAR(40) NOT NULL, apellido2 VARCHAR(40) NOT NULL, genero_id TINYINT NOT NULL, departamento_id TINYINT NOT NULL, municipio_id INT(11) NOT NULL, PRIMARY KEY(id));
ALTER TABLE paciente ADD CONSTRAINT fk_paciente_tipos_documento FOREIGN KEY (tipo_documento_id) REFERENCES tipos_documento(id) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE paciente ADD CONSTRAINT fk_paciente_genero FOREIGN KEY (genero_id) REFERENCES genero(id) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE paciente ADD CONSTRAINT fk_paciente_departamentos FOREIGN KEY (departamento_id) REFERENCES departamentos(id) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE paciente ADD CONSTRAINT fk_paciente_municipios FOREIGN KEY (municipio_id) REFERENCES municipios(id) ON DELETE RESTRICT ON UPDATE RESTRICT;
INSERT INTO paciente (id, tipo_documento_id, numero_documento, nombre1, nombre2, apellido1, apellido2, genero_id, departamento_id, municipio_id) VALUES (NULL, 1, 123, 'Eduard', 'Ferney', 'Cruz', 'Ospina', 1, 5, 10);
INSERT INTO paciente (id, tipo_documento_id, numero_documento, nombre1, nombre2, apellido1, apellido2, genero_id, departamento_id, municipio_id) VALUES (NULL, 2, 321, 'Andrea', 'Camila', 'Roa', 'Perez', 2, 5, 9);
INSERT INTO paciente (id, tipo_documento_id, numero_documento, nombre1, nombre2, apellido1, apellido2, genero_id, departamento_id, municipio_id) VALUES (NULL, 1, 456, 'Michelle', 'Andrea', 'Carrillo', 'Ochoa', 3, 1, 1);
INSERT INTO paciente (id, tipo_documento_id, numero_documento, nombre1, nombre2, apellido1, apellido2, genero_id, departamento_id, municipio_id) VALUES (NULL, 1, 654, 'Marta', 'Maria', 'Jaramillo', 'Calderon', 2, 1, 2);
INSERT INTO paciente (id, tipo_documento_id, numero_documento, nombre1, nombre2, apellido1, apellido2, genero_id, departamento_id, municipio_id) VALUES (NULL, 1, 789, 'Maria', 'Teresa', 'Holgado', 'Rodriguez', 2, 2, 3);