-- Create the database
CREATE DATABASE IF NOT EXISTS mascotesClinic
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

-- Create user with access from any IP
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON mascotesClinic.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE mascotesClinic;

-- Drop tables if they exist to avoid errors
DROP TABLE IF EXISTS historial;
DROP TABLE IF EXISTS mascotes;
DROP TABLE IF EXISTS propietaris;

-- Owners table
CREATE TABLE IF NOT EXISTS propietaris (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(150) NOT NULL,
  email VARCHAR(100) NOT NULL,
  movil VARCHAR(15)
) ENGINE=InnoDB;

-- Pets table
CREATE TABLE IF NOT EXISTS mascotes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(150) NOT NULL,
  propietari_id INT NOT NULL
) ENGINE=InnoDB;

-- Medical history records table
CREATE TABLE IF NOT EXISTS historial (
  id INT AUTO_INCREMENT PRIMARY KEY,
  data DATE NOT NULL,
  motiu_visita VARCHAR(255) NOT NULL,
  descripcio TEXT,
  mascota_id INT NOT NULL
) ENGINE=InnoDB;

-- Foreign key constraints
ALTER TABLE mascotes
  ADD CONSTRAINT fk_mascotes_propietaris
    FOREIGN KEY (propietari_id)
    REFERENCES propietaris(id)
    ON DELETE CASCADE;

ALTER TABLE historial
  ADD CONSTRAINT fk_historial_mascotes
    FOREIGN KEY (mascota_id)
    REFERENCES mascotes(id)
    ON DELETE CASCADE;

-- Insert test data for Owners
INSERT INTO propietaris (nom, email, movil) VALUES
('Joan Garcia', 'joan.garcia@email.com', '600111222'),
('Marta Rovira', 'marta.rovira@email.com', '611222333'),
('Pere Soler', 'pere.soler@email.com', '622333444');

-- Insert test data for Pets
-- Remember: owner_id 1=Joan, 2=Marta, 3=Pere
INSERT INTO mascotes (nom, propietari_id) VALUES
('Buddy', 1), 
('Luna', 1), 
('Rex', 2),   
('Miau', 3),  
('Nala', 3);  

-- Insert test data for Medical History records
-- Remember: pet_id 1=Buddy, 2=Luna, 3=Rex, 4=Miau, 5=Nala
INSERT INTO historial (data, motiu_visita, descripcio, mascota_id) VALUES
('2024-01-10', 'Vacunació', 'Vacuna anual contra la ràbia.', 1),
('2024-02-15', 'Revisió', 'Control de pes i dieta.', 1),
('2024-03-05', 'Ferida', 'Cura d`una petita ferida a la pota dreta.', 2),
('2024-03-12', 'Desparasitació', 'Aplicació de pipeta interna i externa.', 3),
('2024-04-01', 'Urgència', 'Ingesta d`un objecte estrany. Sota observació.', 4),
('2024-04-10', 'Control', 'Revisió post-operatòria satisfactòria.', 4),
('2024-05-20', 'Vacunació', 'Vacuna trivalent felina.', 5);