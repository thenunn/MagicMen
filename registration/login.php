<?php
	$goto = "Location: login.html";
        try
        {
                $required = array('usern', 'password');
                $error = false;
                foreach($required as $field) {
                        if (empty($_POST[$field])) {
                                $error = true;
                        }
                }
                if ($error) {
                        echo "Username, and Password are required.";
                        header("Location:login.html");
		}

		//open the sqlite database file
	    $db = new PDO('sqlite:../database/users.db');

	    // Set errormode to exceptions
	    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    //safely insert values into passengers table
		//order matters (look at your schema) -- fname, mname, lname, ssn
		$username = $_POST['usern'];
		$query = $db->query("SELECT password FROM users WHERE username='$username'");
		$pw = $query->fetchColumn(0);
		$incpw = $_POST['password'];
		echo("On file: $pw");
		echo("From user: $incpw");


		if($pw == $incpw) {
			$goto = "Location: ../indexLoggedIn.html";
		}

	    //disconnect from database
	    $db = null;
	}
	catch(PDOException $e)
	{
	    die('Exception : '.$e->getMessage());
	}

	//redirect user to another page now
	header($goto);
?>