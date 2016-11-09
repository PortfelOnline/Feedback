=================================================

создать таблицу в базе данных feedback на localhost (али еще где)

CREATE TABLE `pf_message` (

  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  
  `name` varchar(255) DEFAULT NULL,
  
  `email` varchar(255) DEFAULT NULL,
  
  `body` text,
  
  PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
=================================================

настроить базу данных в файле

protected/config/database.php

<?php

return array(

   'connectionString' => 'mysql:host=localhost;dbname=feedback',
   
   'emulatePrepare' => true,
   
   'username' => 'root',
   
   'password' => '22',
   
   'charset' => 'utf8',
   
   'tablePrefix' => 'pf_'
   
);

=================================================
