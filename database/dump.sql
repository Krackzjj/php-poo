CREATE TABLE IF NOT EXISTS `User`
(
    id        INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username  VARCHAR(255) NOT NULL,
    password  VARCHAR(255) NOT NULL,
    email     VARCHAR(255) NOT NULL,
    firstName VARCHAR(255),
    lastName  VARCHAR(255),
    gender    CHAR(1)     
);

CREATE TABLE IF NOT EXISTS `Post`
(
    id      INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    content TEXT,
    author_id INT,
    comment_id INT
);

CREATE TABLE IF NOT EXISTS `Comment`
(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    content TEXT,
    author_id INT,
    post_id INT
);

ALTER TABLE Post
    ADD CONSTRAINT FK_author_id FOREIGN KEY (author_id) REFERENCES User(id),
        CONSTRAINT FK_comment_id FOREIGN KEY (comment_id) REFERENCES Comment(id);
ALTER TABLE Comment
    ADD CONSTRAINT FK_author_id FOREIGN KEY (author_id) REFERENCES User(id),
        CONSTRAINT FK_post_id FOREIGN KEY (post_id) REFERENCES Post(id);
