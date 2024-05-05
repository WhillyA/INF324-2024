CREATE DATABASE bdwhilly;

USE bdwhilly;

-- Tabla rol_usuarios
CREATE TABLE rol_usuarios (
  id int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(50) NOT NULL,
  PRIMARY KEY (id)
);

-- Tabla tipo_cuenta
CREATE TABLE tipo_cuenta (
  id int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(50) NOT NULL,
  PRIMARY KEY (id)
);

-- Tabla persona
CREATE TABLE persona (
  id int(11) NOT NULL AUTO_INCREMENT,
  nombres varchar(100) NOT NULL,
  ap_pat varchar(50) NOT NULL,
  ap_mat varchar(50) NOT NULL,
  fecha_nac date NOT NULL,
  ci int(11) NOT NULL,
  direccion varchar(255) NOT NULL,
  password_hash varchar(255) NOT NULL,
  id_rol_usuario int(11) DEFAULT NULL, 
  PRIMARY KEY (id),
  KEY id_rol_usuario (id_rol_usuario), 
  CONSTRAINT persona_ibfk_1 FOREIGN KEY (id_rol_usuario) REFERENCES rol_usuarios (id) 
);

-- Tabla cuentabancaria
CREATE TABLE cuentabancaria (
  id int(11) NOT NULL AUTO_INCREMENT,
  id_tipo_cuenta int(11) NOT NULL,
  saldo decimal(10,2) DEFAULT 0.00,
  fecha_creacion date NOT NULL,
  id_persona int(11) NOT NULL,
  PRIMARY KEY (id),
  KEY id_persona (id_persona),
  KEY id_tipo_cuenta (id_tipo_cuenta),
  CONSTRAINT cuentabancaria_ibfk_1 FOREIGN KEY (id_persona) REFERENCES persona (id),
  CONSTRAINT cuentabancaria_ibfk_2 FOREIGN KEY (id_tipo_cuenta) REFERENCES tipo_cuenta (id)
);

-- Tabla transaccionbancaria
CREATE TABLE transaccionbancaria (
  id int(11) NOT NULL AUTO_INCREMENT,
  tipo varchar(50) NOT NULL,
  monto decimal(10,2) NOT NULL,
  fecha timestamp NOT NULL DEFAULT current_timestamp(),
  id_cuenta int(11) NOT NULL,
  PRIMARY KEY (id),
  KEY id_cuenta (id_cuenta),
  CONSTRAINT transaccionbancaria_ibfk_1 FOREIGN KEY (id_cuenta) REFERENCES cuentabancaria (id)
);
