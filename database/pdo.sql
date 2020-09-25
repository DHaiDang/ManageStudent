
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `student` (
  `id` int(10) NOT NULL,
  `fullname` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL UNIQUE,
  `password` varchar(60) NOT NULL,
  `secretpin` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `isAdmin` int(1) DEFAULT 0,
)

CREATE TABLE `homework` (
  `id`        Int Unsigned Not Null Auto_Increment,
  `name`      VarChar(255) Not Null Default 'Untitled.txt',
  `mime`      VarChar(50) Not Null Default 'text/plain',
  `size`      BigInt Unsigned Not Null Default 0,
  `data`      MediumBlob Not Null,
  `created`   DateTime Not Null,
  PRIMARY KEY (`id`)
)

ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `student`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;