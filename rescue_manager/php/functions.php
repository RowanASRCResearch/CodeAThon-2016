<?php	//FILE:  functions.php

		//This file contains all of the user defined functions that are used

/********************************************************************************

OLIS.  This is a abstract submission and management program.

Copyright (C) 2007 John Robinson



This program is free software; you can redistribute it and/or

modify it under the terms of the GNU General Public License

as published by the Free Software Foundation; either version 2

of the License, or (at your option) any later version.



This program is distributed in the hope that it will be useful,

but WITHOUT ANY WARRANTY; without even the implied warranty of

MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the

GNU General Public License for more details.



You should have received a copy of the GNU General Public License

along with this program; if not, write to the Free Software

Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.



If you wish to contact me here is my email address:  robinsonj99@comcast.net

*********************************************************************************/


/**************************   DATABASE RELATED FUNCTIONS    *******************************/

	function db_connect_sel(){

		//This function connects to the mysql server and selects the database

		//The connection variable is returned.

		DEFINE ('DB_USER', 'eliakah');
		DEFINE ('DB_PASSWORD', 'Yx3InyJsFcf62WXJ');
		DEFINE ('DB_HOST', 'localhost');
		DEFINE ('DB_NAME', 'rescue_manager');

		//connect to the database

		$dbcnx = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		// Check connection
		if (!$dbcnx){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}else{
			return $dbcnx;
		}



	} //end db_connect_sel()



?>
