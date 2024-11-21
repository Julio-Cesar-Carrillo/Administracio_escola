DROP DATABASE IF EXISTS db_escuela;

create database db_escuela;

use db_escuela;

CREATE TABLE tbl_roles(
    id_rol INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom_rol VARCHAR(30) NOT NULL
);

CREATE TABLE tbl_profesores(
    id_prof INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom_prof VARCHAR(30) NOT NULL,
    cognom1_prof VARCHAR(30) NOT NULL,
    cognom2_prof VARCHAR(30) NULL,
    email_prof VARCHAR(100) NOT NULL,
    rol_prof INT NOT NULL,
    pwd_prof VARCHAR(100) NOT NULL
);

ALTER TABLE
    tbl_cursos
ADD
    CONSTRAINT fk_profesor_curso FOREIGN KEY (id_profe) REFERENCES tbl_profesores(id_prof);


CREATE TABLE tbl_cursos (
    id_curso INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    codi_curso VARCHAR(5) NOT NULL,
    nom_curso VARCHAR(25) NULL,
    id_profe INT NOT NULL
);

CREATE TABLE tbl_alumnos(
    id_alumno INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    dni_alu VARCHAR(9) NULL,
    nom_alu VARCHAR(20) NOT NULL,
    cognom1_alu VARCHAR(20) NOT NULL,
    cognom2_alu VARCHAR(20) NULL,
    telf_alu VARCHAR(9) NOT NULL,
    email_alu VARCHAR(50) NOT NULL,
    id_curso INT NOT NULL
);

CREATE TABLE tbl_materias (
    id_materia INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_curso INT NOT NULL,
    nom_materia VARCHAR(25) NOT NULL
);

CREATE TABLE tbl_notas (
    id_nota INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_alumno INT NOT NULL,
    id_materia INT NOT NULL,
    nota decimal(5, 2) NOT NULL
);

ALTER TABLE
    tbl_profesores
ADD
    CONSTRAINT fk_profesor_roles FOREIGN KEY (id_prof) REFERENCES tbl_roles(id_rol);



ALTER TABLE
    tbl_alumnos
ADD
    CONSTRAINT fk_alumno_curso FOREIGN KEY (id_curso) REFERENCES tbl_cursos(id_curso);

ALTER TABLE
    tbl_materias
ADD
    CONSTRAINT fk_materia_curso FOREIGN KEY (id_curso) REFERENCES tbl_cursos(id_curso);

ALTER TABLE
    tbl_notas
ADD
    CONSTRAINT fk_alumno_nota FOREIGN KEY (id_alumno) REFERENCES tbl_alumnos(id_alumno);

ALTER TABLE
    tbl_notas
ADD
    CONSTRAINT fk_materia_nota FOREIGN KEY (id_materia) REFERENCES tbl_materias(id_materia);