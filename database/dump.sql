CREATE TABLE IF NOT EXISTS `User`
(
    id        INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username  VARCHAR(255) NOT NULL,
    password  VARCHAR(255) NOT NULL,
    email     VARCHAR(255) NOT NULL,
    firstName VARCHAR(255),
    lastName  VARCHAR(255),
    gender    CHAR(1),
    roles     JSON         DEFAULT '{\"ROLE\":\"USER\"}'; NOT NULL
);

CREATE TABLE IF NOT EXISTS `Post`
(
    id          INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title       VARCHAR(255) NOT NULL,
    content     TEXT,
    author_id   INT NOT NULL,
    created_at  DATE DEFAULT CURRENT_TIMESTAMP,
    img         TEXT

);

CREATE TABLE IF NOT EXISTS `Comment`
(
    id          INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    content     TEXT,
    post_id     INT,
    parent_id   INT DEFAULT 0,
    author_id   INT,
    created_at  DATE DEFAULT CURRENT_TIMESTAMP,
    child   INT  DEFAULT 0
);