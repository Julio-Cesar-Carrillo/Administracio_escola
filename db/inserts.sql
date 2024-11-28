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
('45967595W', 'Arnau', 'Puig', 'Gómez', '600111222', 'arnau.puig@eso.com', 1),
('16631930D', 'Clara', 'Riera', 'Fernández', '600222333', 'clara.riera@eso.com', 2),
('22528009S', 'Pau', 'Martínez', 'López', '600333444', 'pau.martinez@eso.com', 3),
('49715351T', 'Núria', 'Garriga', 'Pérez', '600444555', 'nuria.garriga@eso.com', 4),
('07130320K', 'Joan', 'Font', 'Rubio', '600555666', 'joan.font@bachillerat.com', 5),
('28351107L', 'Marta', 'Vilà', 'Morales', '600666777', 'marta.vila@eso.com', 1),
('72602652R', 'Eugenia', 'Vilà', 'Domi', '600777888', 'eugenia.vila@eso.com', 2),
('18082424P', 'Pepa', 'Vilà', 'Machado', '600888999', 'pepa.vila@bachillerat.com', 3),
('97291966B', 'Gina', 'Vilà', 'Garrido', '601000111', 'gina.vila@bachillerat.com', 4),
('74719940R', 'Mario', 'Vilà', 'Pimienta', '601111222', 'mario.vila@bachillerat.com', 5),
('43929168L', 'Morata', 'Vilà', 'Parejo', '601222333', 'morata.vila@bachillerat.com', 1),
('63160813F', 'Joel', 'Puerto', 'Alcocer', '601333444', 'joel.puerto@bachillerat.com', 2),
('28351107L', 'Leo', 'Mateucci', 'Messi', '601444555', 'leo.mateucci@bachillerat.com', 3),
('42498732E', 'Lia', 'Cantos', 'Monroe', '601555666', 'lia.cantos@bachillerat.com', 4),
('55194476L', 'Deiby', 'Buenano', 'Pacheco', '601666777', 'deiby.buenano@bachillerat.com', 6),
('52316776X', 'Carlos', 'Buenano', 'Pacheco', '601777888', 'carlos.buenano@bachillerat.com', 6),
('93803723V', 'Luis', 'Buenano', 'Pacheco', '601888999', 'luis.buenano@bachillerat.com', 6);


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


-- Notas adicionales para cubrir más alumnos y materias

INSERT INTO tbl_notas (id_alumno, id_materia, nota) VALUES
    (1, 4, 6.0), -- Arnau a Ciències Naturals
    (1, 5, 7.0), -- Arnau a Ciències Socials
    (2, 1, 8.5), -- Clara a Matemàtiques
    (2, 2, 8.0), -- Clara a Llengua Catalana
    (2, 3, 7.5), -- Clara a Llengua Castellana
    (3, 6, 6.0), -- Pau a Matemàtiques
    (3, 7, 6.5), -- Pau a Llengua Catalana
    (3, 8, 7.0), -- Pau a Llengua Castellana
    (3, 9, 8.0), -- Pau a Educació Física
    (3, 10, 7.5), -- Pau a Tecnologia
    (4, 11, 8.5), -- Núria a Matemàtiques
    (4, 12, 8.0), -- Núria a Llengua Anglesa
    (4, 13, 7.0), -- Núria a Història i Geografia
    (4, 14, 6.5), -- Núria a Física i Química
    (4, 15, 7.5), -- Núria a Biologia i Geologia
    (5, 16, 7.5), -- Joan a Matemàtiques Acadèmiques
    (5, 17, 8.0), -- Joan a Llengua Catalana
    (5, 18, 7.0), -- Joan a Llengua Castellana
    (5, 19, 8.5), -- Joan a Filosofia
    (5, 20, 7.5), -- Joan a Economia
    (6, 21, 9.0), -- Marta a Matemàtiques I
    (6, 22, 8.5), -- Marta a Física I
    (6, 23, 9.5), -- Marta a Química I
    (6, 24, 8.5), -- Marta a Història del Món Contemporani
    (6, 25, 9.0), -- Marta a Llengua Anglesa
    (7, 26, 6.5), -- Eugenia a Matemàtiques II
    (7, 27, 7.0), -- Eugenia a Física II
    (7, 28, 7.5), -- Eugenia a Química II
    (7, 29, 8.0), -- Eugenia a Història de la Filosofia
    (7, 30, 8.5); -- Eugenia a Llengua Catalana i Literatura
