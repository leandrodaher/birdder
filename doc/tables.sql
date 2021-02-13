/* 
 * PostgreSQL
 *
 * Obs.: SERIAL não é um tipo de dados verdadeiro, mas é simplesmente uma notação abreviada que diz ao * Postgres para criar um identificador único com incremento automático para a coluna especificada.
 *
 * https://www.postgresql.org/docs/8.1/datatype.html#DATATYPE-SERIAL
 * https://chartio.com/resources/tutorials/how-to-define-an-auto-increment-primary-key-in-postgresql/
 * 
*/

-- Obs.: o PostgreSQL converteu meu CamelCase em caixa baixa
-- dessa forma Tabela Users virou users, por exemplo.
-- Coluna UserName virou username, por exemplo.

CREATE TABLE Users (
    UserID SERIAL NOT NULL,
    UserName varchar(30) NOT NULL,
    UserPassword varchar(255) NOT NULL,
    ProfileName varchar(40) NOT NULL,
    ProfileBio varchar(140),
    PRIMARY KEY (UserID)
);

CREATE TABLE Posts (
    PostID SERIAL NOT NULL,
    Content varchar(140) NOT NULL,
    Likes int,
    UserID int NOT NULL,
    PRIMARY KEY (PostID),
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

CREATE TABLE Comments (
    CommentID SERIAL NOT NULL,
    Content varchar(140) NOT NULL,
    PostID int NOT NULL,
    PRIMARY KEY (CommentID),
    FOREIGN KEY (PostID) REFERENCES Posts(PostID)
);