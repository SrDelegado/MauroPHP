CREATE DATABASE IF NOT EXISTS huerta_db CHARACTER SET utf8mb4;
USE huerta_db;

CREATE TABLE IF NOT EXISTS cultivos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(60) NOT NULL,
    tipo ENUM('Hortaliza','Fruto','Aromática','Legumbre','Tubérculo') NOT NULL,
    dias_cosecha SMALLINT UNSIGNED NOT NULL
);

INSERT INTO cultivos (nombre, tipo, dias_cosecha) VALUES
('Tomate Cherry', 'Fruto', 85),
('Zanahoria Morada', 'Tubérculo', 75),
('Albahaca Genovesa', 'Aromática', 50),
('Guisante Dulce', 'Legumbre', 65),
('Lechuga Romana', 'Hortaliza', 60);
