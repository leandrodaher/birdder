# Metas de implementação
- [x] Criar banco de dados e tabelas

- [ ] Criar microframework
  - [ ] Sistema de Rotas
  - [ ] Classes de base (Controller e Model)

- [ ] Implementar os Models
  - [ ] Usuários
  - [ ] Posts
  - [ ] Comentários

- [ ] Implementar Controllers
  - [ ] Usuário
  - [ ] Post
  - [ ] Comentário

- [ ] Implementar o Sistema de Autenticação
  - [ ] Cadastro
  - [ ] Login

- [ ] Implementar Views


# Requisitos

### Objetivo
Criar uma rede social muito simplificada similar ao twitter, porém em formato de blog e sem a opção de seguir usuários. A única maneira de ver os posts de outras pessoas é acessando o link com /@username delas.

### Sistema de Autenticação
- Cadastro com usuário e senha APENAS
- Não implementar recuperação de senha
- Armazenar senha como hash BCrypt e salt gerado pelo própio PHP

### Usuários
- Nome de perfil (além do @username)
- Biografia (máx.: 140 caracteres)
- Postar textos de até 140 caracteres
- Apagar postagens
- Curtir postagens
- Comentar postagens
- Links de acesso:
  - birdder.com/user/:username   Página com nome do usuário, biografia e lista de posts com número de curtidas de cada um
    - Obs.: o símbolo ":" indica que username é um valor dinâmico, exemplo: birdder.com/johndoe

### Posts
- Máximo de 144 caracteres
- Título será sempre o ID do post
- Links de acesso:
  - birdder.com/post/:postid Exibe um post específico, número de curtidas e comentários


### Comentários
- Nome de usuário (linkado ao ID com **hyperlink [tag "a" no HTML]**) e texto do comnetário com 140 caracteres no máximo
- Armazenar dados de forma desnormalizada para evitar joins e melhorar a performance**
  - **Embora um banco relacional não seja o mais adequado
- Não será possível curtir comentários ou comentar dentro de comentários
  - O usuário poderá referenciar outro usuário estaticamente digitando o @username de quem ele quer responder. Haverá um botão de reposta em cada comentário que atraves do Javascript insere o @username (da pessoa a ser citada) no campo de insersão de comentário.


# Banco de Dados (birdderdb)
### Tabelas
- Arquivo: tables.sql
```
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
```