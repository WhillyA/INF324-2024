INSERT INTO rol_usuarios (nombre) VALUES
('Administrador'),
('Cajero'),
('Cliente');

INSERT INTO tipo_cuenta (nombre) VALUES
('Cuenta de ahorros'),
('Cuenta corriente'),
('Cuenta de inversión');

INSERT INTO persona (nombres, ap_pat, ap_mat, fecha_nac, ci, direccion, password_hash, id_rol_usuario) VALUES
('Mario', 'Mamani', 'Garcia', '1980-06-15', 1234567, 'Calle 123 av nosenose', '123', 1),
('Nicol', 'Quispe', 'Lopez', '1987-08-20', 2345612, 'Avenida alamos', '123', 2),
('Whilly Edgar', 'Amoraga', 'Mamani', '1988-08-20', 45678912, 'calle palmeras', '123', 3);

INSERT INTO cuentabancaria (id_tipo_cuenta, saldo, fecha_creacion, id_persona) VALUES
(1, 1200.78, '2022-01-01', 1), 
(2, 500.05, '2022-01-01', 2),
(3, 50000.17, '2022-01-01', 3);

INSERT INTO transaccionbancaria (tipo, monto, fecha, id_cuenta) VALUES
('Depósito', 500.00, '2022-01-10 09:00:00', 1), 
('Depósito', 500.00, '2022-01-10 09:00:00', 2), 
('Retiro', 200.00, '2022-01-15 14:30:00', 3); 