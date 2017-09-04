# PHP-CRUD-DEMO

- This demo is about creating a simple PHP CRUD application using OOPS concept and using PDO.
- This example uses a class named crud that is use to handle all the action such as create, update , delete etc.


 ## Installation & Setup ##

[1] Clone this repository

	> git clone https://github.com/ankitas-php/PHP-CRUD-DEMO.git

[2] Create a database named "php_crud" and run the below queries :

	> CREATE TABLE IF NOT EXISTS `tbl_users` (
	    `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
	    `first_name` varchar(255) DEFAULT NULL,
	    `last_name` varchar(255) NOT NULL,
	    `email_id` varchar(255) DEFAULT NULL,
	    `contact_no` varchar(100) DEFAULT NULL,
	    `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	    `modified` datetime NOT NULL,
	    `status` enum('0','1') NOT NULL DEFAULT '0',
	    PRIMARY KEY (`id`)
	  ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

[3] Open a browser window and navigate to : http://localhost/PHP-CRUD-DEMO/

    - This will show you the listing page . You can add new records by clicking "Add Records".
