CREATE DATABASE my_db DEFAULT CHARACTER SET 'utf8';
 
USE my_db;
 
 
CREATE TABLE users (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
);
 
CREATE TABLE roles (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
);
 
CREATE TABLE user_role (
        user_fk INT NOT NULL,
        role_fk INT NOT NULL,
        FOREIGN KEY (user_fk) REFERENCES users (id)
                ON UPDATE CASCADE
                ON DELETE CASCADE,
        FOREIGN KEY (role_fk) REFERENCES roles (id)
                ON UPDATE CASCADE
                ON DELETE CASCADE
);
 
 
CREATE TABLE permissions (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
);
 
CREATE TABLE role_permission (
        role_fk INT NOT NULL,
        permission_fk INT NOT NULL,
        FOREIGN KEY (role_fk) REFERENCES roles (id),
        FOREIGN KEY (permission_fk) REFERENCES permissions (id)
);
 
 
/* Inserts data into tables */
INSERT INTO users SET name = '';
INSERT INTO roles SET name = '';
INSERT INTO permissions SET name = '';
INSERT INTO user_role SET user_fk = '', role_fk = '';
INSERT INTO role_permission SET role_fk = '', permission_fk = '';
 
 
/* Selects user and his roles */
SELECT users.id AS user_id, roles.id AS roles_id,
        users.name AS user_name, roles.name AS role_name
FROM users
INNER JOIN user_role ON users.id = user_role.user_fk
INNER JOIN roles ON roles.id = user_role.role_fk
WHERE users.name = 'Bob';
 
/* Selects user, his roles and permissions */
SELECT users.id AS user_id, roles.id AS roles_id, permissions.id AS permission_id,
        users.name AS user_name, roles.name AS role_name, permissions.name AS permission_name
FROM users
INNER JOIN user_role ON users.id = user_role.user_fk
INNER JOIN roles ON roles.id = user_role.role_fk
INNER JOIN role_permission ON roles.id = role_permission.role_fk
INNER JOIN permissions ON permissions.id = role_permission.permission_fk
WHERE users.name = 'Joy';
