<?php
/*
   PHP Database Backup Script For Drupal 7
   Copyright (c) 2017
   
   By Batsakidis Athanasios
   
   Tested on: Drupal 7.X and CPanel/XAMMP
*/

$password = "123"; //Change to whatever you want your password to be

if(isset($_POST['submit'])){
        if($_POST['password'] == $password){
        		
			$INC_DIR = dirname(__FILE__). "/sites/default/";

			include($INC_DIR. "settings.php"); 

			$DBUSER=$databases['default']['default']['username'];
			$DBPASSWD=$databases['default']['default']['password'];
			$DATABASE=$databases['default']['default']['database'];

			$filename = "backup-" . date("d-m-Y") . ".sql.gz";
			$mime = "application/x-gzip";

			header( "Content-Type: " . $mime );
			header( 'Content-Disposition: attachment; filename="' . $filename . '"' );

			$cmd = "mysqldump -u $DBUSER --password=$DBPASSWD $DATABASE | gzip --best";   

			passthru( $cmd );

			exit(0);	
        } 
		else 
		{
            echo "Sorry the password is incorrect";
        }
}
else 
{
	//IF THE FORM WAS NOT SUBMITTED - SHOW FORM
        ?><form method="post">
                 Password: <input type="password" name="password" />
                <input type='submit' name='submit' />
        </form><?php
}
?>
