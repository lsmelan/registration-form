# registration-form

* First step is to clone this repository.
* Then go to root directory and run composer update to obtain all dependencies.
* Copy the config.yml.dist and name it to config.yml
* Place your database settings into the yaml and save it.
* Run this SQL statement in the same schema you've set in previous step:

CREATE TABLE `registrations` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `last_name` VARCHAR(50) NOT NULL,
  `email` VARCHAR(70) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `street` VARCHAR(70) NULL,
  `postcode` VARCHAR(10) NULL,
  `city` VARCHAR(40) NULL,
  `country` VARCHAR(40) NULL,
  `nif` VARCHAR(10) NULL,
  `phone` VARCHAR(15) NULL,
  PRIMARY KEY (`id`));
  
  * Finally go to public directory and run php -S localhost:8000 (if you are using PHP 7)
  * Browse to http://localhost:8080
