CREATE TABLE IF NOT EXISTS ventas_cafeteria(
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    uds_vendidas INT(30) NOT NULL,
    precio  INT(30) NOT NULL,
    ingresos  INT(30) NOT NULL
);