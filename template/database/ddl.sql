CREATE TABLE users (
    id_user int NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    role VARCHAR(255) NOT NULL,
    role_position VARCHAR(255),
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP,

    CONSTRAINT PK_Users PRIMARY KEY (id_user)
); 

CREATE TABLE invoice (
    id_invoice int NOT NULL AUTO_INCREMENT,
    id_user int,
    name VARCHAR(255) NOT NULL,
    semester int NOT NULL,
    total int NOT NULL,
    status VARCHAR(255),
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP,

    CONSTRAINT PK_Invoice PRIMARY KEY (id_invoice),
    CONSTRAINT FK_InvoiceParent FOREIGN KEY (id_user)
    REFERENCES users(id_user)
); 

ALTER TABLE users MODIFY created_at timestamp NOT NULL DEFAULT NOW();
ALTER TABLE invoice MODIFY created_at timestamp NOT NULL DEFAULT NOW();