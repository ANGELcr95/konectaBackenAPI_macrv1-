CREATE TABLE IF NOT EXISTS productos_cafeteria(
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    referencia VARCHAR(255) NOT NULL,
    precio  INT(30) NOT NULL,
    peso  INT(30) NOT NULL,
    categoria  VARCHAR(255) NOT NULL,
    stock  INT(30) NOT NULL,
    fecha  DATE NOT NULL
);