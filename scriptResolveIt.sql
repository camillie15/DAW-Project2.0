-- Creacion DB
CREATE DATABASE IF NOT EXISTS `resolveit` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `resolveit`;

-- Users
CREATE TABLE users (
    userId INT PRIMARY KEY AUTO_INCREMENT,
    firstName VARCHAR(100),
    lastName VARCHAR(100),
    userName VARCHAR(20),
    email VARCHAR(50),
    password VARCHAR(20),
    userRole INT,
    status INT
);

-- Returns
CREATE TABLE returns (
    returnId INT PRIMARY KEY AUTO_INCREMENT,
    userId INT,
    requestDate DATETIME,
    purchaseDate DATE,
    productStatus VARCHAR(50),
    productCode VARCHAR(100),
    invoiceCode VARCHAR(100),
    description VARCHAR(255),
    requestStatus INT,
    status INT,
    FOREIGN KEY (userId) REFERENCES users(userId)
);

-- WarrantyReasons
CREATE TABLE warrantyReasons (
    warrantyReasonId INT PRIMARY KEY AUTO_INCREMENT,
    description VARCHAR(100)
);

-- Guarantees
CREATE TABLE guarantees (
    guaranteeId INT PRIMARY KEY AUTO_INCREMENT,
    userId INT,
    requestDate DATETIME,
    purchaseDate DATETIME,
    warrantyReasonId INT,
    productCode VARCHAR(50),
    invoiceCode VARCHAR(50),
    description VARCHAR(250),
    requestStatus INT,
    status INT,
    FOREIGN KEY (userId) REFERENCES users(userId),
    FOREIGN KEY (warrantyReasonId) REFERENCES warrantyReasons(warrantyReasonId)
);

-- SupportRequests
CREATE TABLE supportRequests (
    requestId INT PRIMARY KEY AUTO_INCREMENT,
    userId INT,
    requestDate DATETIME,
    language VARCHAR(50),
    subject VARCHAR(150),
    description VARCHAR(250),
    priority VARCHAR(15),
    requestStatus INT,
    status INT,
    FOREIGN KEY (userId) REFERENCES users(userId)
);

-- SupportResponses
CREATE TABLE supportResponses (
    responseId INT PRIMARY KEY AUTO_INCREMENT,
    requestId INT,
    responseDate DATETIME,
    userId INT,
    response VARCHAR(250),
    FOREIGN KEY (requestId) REFERENCES supportRequests(requestId),
    FOREIGN KEY (userId) REFERENCES users(userId)
);

-- Categories
CREATE TABLE categories (
    categoryId INT PRIMARY KEY AUTO_INCREMENT,
    description VARCHAR(100)
);

-- FAQs
CREATE TABLE frequentQuestions (
    frequentQuestionId INT PRIMARY KEY AUTO_INCREMENT,
    question VARCHAR(250),
    answer VARCHAR(250),
    author VARCHAR(100),
    creationDate DATETIME,
    categoryId INT,
    priority VARCHAR(50),
    status INT,
    FOREIGN KEY (categoryId) REFERENCES categories(categoryId)
);

-- Credenciales de usuarios con rol (2) y (3)
INSERT INTO `users` (`userId`, `firstName`, `lastName`, `userName`, `email`, `password`, `userRole`, `status`) VALUES (NULL, 'Jose', 'Castro', 'Garantia', 'garantia123@gmail.com', '1234', '2', '1');
INSERT INTO `users` (`userId`, `firstName`, `lastName`, `userName`, `email`, `password`, `userRole`, `status`) VALUES (NULL, 'Willian', 'Vargas', 'Soporte', 'soporte123@gmail.com', '1234', '3', '1');

-- Razones de garantia 
INSERT INTO `warrantyReasons` (`description`) 
VALUES 
    ('Defectos de fabricación'),
    ('Problemas de funcionamiento'),
    ('Averías mecánicas, eléctricas o electrónicas'),
    ('Desgaste irregular de piezas'),
    ('Error de ensamblaje');

-- Categorias de preguntas frecuentes
INSERT INTO categories (`description`)
VALUES 
    ('devolucion'), 
    ('soporte'), 
    ('garantía'), 
    ('privacidad');
