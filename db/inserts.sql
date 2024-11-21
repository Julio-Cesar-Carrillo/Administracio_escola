INSERT INTO tbl_roles (nom_rol) VALUES 
('Administrador'),
('Profesor'),
('Coordinador'),
('Tutor'),
('Estudiante');

INSERT INTO tbl_profesores (nom_prof, cognom1_prof, cognom2_prof, email_prof, rol_prof, pwd_prof) VALUES 
('Juan', 'Pérez', 'López', 'juan.perez@escuela.com', 2, '$2y$10$9YAaDvpj8IDI7WRNVxVq6uYzMnCaUWDGMlU6LS.jv6dgpWcmqcswS'),
('María', 'García', NULL, 'maria.garcia@escuela.com', 2, '$2y$10$9YAaDvpj8IDI7WRNVxVq6uYzMnCaUWDGMlU6LS.jv6dgpWcmqcswS'),
('Carlos', 'Hernández', 'Martínez', 'carlos.hernandez@escuela.com', 3, '$2y$10$9YAaDvpj8IDI7WRNVxVq6uYzMnCaUWDGMlU6LS.jv6dgpWcmqcswS'),
('Lucía', 'Rodríguez', NULL, 'lucia.rodriguez@escuela.com', 4, '$2y$10$9YAaDvpj8IDI7WRNVxVq6uYzMnCaUWDGMlU6LS.jv6dgpWcmqcswS'),
('Luis', 'González', 'Sánchez', 'luis.gonzalez@escuela.com', 2, '$2y$10$9YAaDvpj8IDI7WRNVxVq6uYzMnCaUWDGMlU6LS.jv6dgpWcmqcswS');


INSERT INTO tbl_cursos (codi_curso, nom_curso, id_profe) VALUES 
('ESO1', '1r ESO', 1),
('ESO2', '2n ESO', 2),
('ESO3', '3r ESO', 3),
('ESO4', '4t ESO', 4),
('BAT1', '1r Batxillerat', 5),
('BAT2', '2n Batxillerat', 3);


INSERT INTO tbl_alumnos (dni_alu, nom_alu, cognom1_alu, cognom2_alu, telf_alu, email_alu, id_curso) VALUES 
('11111111A', 'Arnau', 'Puig', 'Gómez', '600111222', 'arnau.puig@eso.com', 1),
('22222222B', 'Clara', 'Riera', 'Fernández', '600333444', 'clara.riera@eso.com', 2),
('33333333C', 'Pau', 'Martínez', 'López', '600555666', 'pau.martinez@eso.com', 3),
('44444444D', 'Núria', 'Garriga', 'Pérez', '600777888', 'nuria.garriga@eso.com', 4),
('55555555E', 'Joan', 'Font', 'Rubio', '600999000', 'joan.font@bachillerat.com', 5),
('66666666F', 'Marta', 'Vilà', 'Garcia', '601111222', 'marta.vila@bachillerat.com', 6);

INSERT INTO tbl_materias (id_curso, nom_materia) VALUES 
-- ESO 1
(1, 'Matemàtiques'),
(1, 'Llengua Catalana i Literatura'),
(1, 'Llengua Castellana i Literatura'),
(1, 'Ciències Naturals'),
(1, 'Ciències Socials'),

-- ESO 2
(2, 'Matemàtiques'),
(2, 'Llengua Catalana i Literatura'),
(2, 'Llengua Castellana i Literatura'),
(2, 'Educació Física'),
(2, 'Tecnologia'),

-- ESO 3
(3, 'Matemàtiques'),
(3, 'Llengua Anglesa'),
(3, 'Història i Geografia'),
(3, 'Física i Química'),
(3, 'Biologia i Geologia'),

-- ESO 4
(4, 'Matemàtiques Acadèmiques'),
(4, 'Llengua Catalana i Literatura'),
(4, 'Llengua Castellana i Literatura'),
(4, 'Filosofia'),
(4, 'Economia'),

-- Batxillerat 1
(5, 'Matemàtiques I'),
(5, 'Física I'),
(5, 'Química I'),
(5, 'Història del Món Contemporani'),
(5, 'Llengua Anglesa'),

-- Batxillerat 2
(6, 'Matemàtiques II'),
(6, 'Física II'),
(6, 'Química II'),
(6, 'Història de la Filosofia'),
(6, 'Llengua Catalana i Literatura');


INSERT INTO tbl_notas (id_alumno, id_materia, nota) VALUES 
-- ESO 1
(1, 1, 7.5), -- Arnau a Matemàtiques
(1, 2, 8.0), -- Arnau a Llengua Catalana
(1, 3, 7.0), -- Arnau a Llengua Castellana
(2, 4, 8.5), -- Clara a Ciències Naturals
(2, 5, 9.0), -- Clara a Ciències Socials

-- ESO 2
(3, 6, 6.5), -- Pau a Matemàtiques
(3, 7, 7.0), -- Pau a Llengua Catalana
(4, 8, 8.5), -- Núria a Llengua Castellana
(4, 9, 9.0), -- Núria a Educació Física
(4, 10, 8.0), -- Núria a Tecnologia

-- ESO 3
(5, 11, 9.0), -- Joan a Matemàtiques
(5, 12, 8.5), -- Joan a Llengua Anglesa
(5, 13, 7.5), -- Joan a Història i Geografia
(6, 14, 8.0), -- Marta a Física i Química
(6, 15, 8.5), -- Marta a Biologia i Geologia

-- Batxillerat 1
(5, 16, 7.5), -- Joan a Matemàtiques I
(5, 17, 6.5), -- Joan a Física I
(6, 18, 8.0), -- Marta a Química I
(6, 19, 7.0), -- Marta a Història del Món Contemporani
(6, 20, 9.0), -- Marta a Llengua Anglesa

-- Batxillerat 2
(5, 21, 8.0), -- Joan a Matemàtiques II
(5, 22, 7.0), -- Joan a Física II
(6, 23, 9.0), -- Marta a Química II
(6, 24, 8.5), -- Marta a Història de la Filosofia
(6, 25, 9.5); -- Marta a Llengua Catalana i Literatura
