/* loja_test_1_Logico: */


CREATE DATABASE BD_loja_test_1 DEFAULT CHARACTER SET Latin1 DEFAULT COLLATE latin1_swedish_ci;
USE BD_loja_test_1;


CREATE TABLE Funcionario (
    id_funcionario INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nome_funcionario VARCHAR(100) NOT NULL,
    sobrenome_funcionario VARCHAR(100) NOT NULL,
    d_nascimento DATE NOT NULL,
    d_admissao DATE NOT NULL,    
    fk_Cargo_id_cargo INT NOT NULL
)ENGINE = InnoDB, DEFAULT CHARSET = Latin1; 

CREATE TABLE Cargo (
    id_cargo INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nome_cargo VARCHAR(50) NOT NULL
)ENGINE = InnoDB, DEFAULT CHARSET = Latin1; 
 
ALTER TABLE Funcionario ADD CONSTRAINT FK_Funcionario_2
    FOREIGN KEY (fk_Cargo_id_cargo)
    REFERENCES Cargo (id_cargo)
    ON DELETE CASCADE;





