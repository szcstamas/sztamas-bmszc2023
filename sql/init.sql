-- creating user with same databe
CREATE USER 'sztamas'@'localhost' IDENTIFIED VIA mysql_native_password USING '***';GRANT USAGE ON *.* TO 'sztamas'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;CREATE DATABASE IF NOT EXISTS `sztamas`;GRANT ALL PRIVILEGES ON `sztamas`.* TO 'sztamas'@'localhost';
