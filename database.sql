CREATE TABLE `users` (
    `Utente` varchar(255),
    `Password` varchar(40),
    `Nome` varchar(40),
    `Cognome` varchar(40),
    `DataNascita` varchar(255)
)

CREATE TABLE `acc` (
    `Utente` varchar(255) NOT NULL,
    `Sessione` int NOT NULL,
    `timestamp` int(40),
    `accX` int,
    `accY` int,
    `accZ` int,
    `inizio` int,
    `fine` int
)