CREATE TABLE IF NOT EXISTS `User`
(
    id        INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username  VARCHAR(255) NOT NULL,
    password  VARCHAR(255) NOT NULL,
    email     VARCHAR(255) NOT NULL,
    firstName VARCHAR(255),
    lastName  VARCHAR(255),
    gender    CHAR(1),
    roles     JSON         NOT NULL
);

CREATE TABLE IF NOT EXISTS `Post`
(
    id          INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title       VARCHAR(255) NOT NULL,
    content     TEXT,
    author_id   INT NOT NULL,
    created_at  VARCHAR(255) NOT NULL,
    img         TEXT,

);

CREATE TABLE IF NOT EXISTS `Comment`
(
    id          INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    content     TEXT,
    author_id   INT,
    post_id     INT NOT NULL,
    created_at  VARCHAR(255) NOT NULL,
    parent_com  INT
);



ALTER TABLE Post
    ADD CONSTRAINT FK_author_id FOREIGN KEY (author_id) REFERENCES User(id),
ALTER TABLE Comment
    ADD CONSTRAINT FK_author_id FOREIGN KEY (author_id) REFERENCES User(id),
        CONSTRAINT FK_post_id FOREIGN KEY (post_id) REFERENCES Post(id);
        CONSTRAINT com FOREIGN KEY () REFERENCES Comment(parent_com)