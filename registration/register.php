<?php
        try
        {
                $required = array('name', 'usern', 'pw');
                $error = false;
                foreach($required as $field) {
                        if (empty($_POST[$field])) {
                                $error = true;
                        }
                }
                if ($error) {
                        echo "Name, Username, and Password are required.";
                        header("Location:register.html");
		}

		//open the sqlite database file
	    $db = new PDO('sqlite:../database/users.db');

	    // Set errormode to exceptions
	    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    //safely insert values into passengers table
		//order matters (look at your schema) -- fname, mname, lname, ssn
		$stmt = $db->prepare('INSERT INTO users (id_user, name, username, password) VALUES (:id, :name, :usern, :pw);');
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':usern', $usern);
		$stmt->bindParam(':pw', $pw);

		$query = $db->query('SELECT COUNT(id_user) FROM users');
		$idrow = $query->fetchColumn(0);
		$max = $idrow;
		$max++;
		$id=$max ;
		$name = $_POST['name'];
		$usern = $_POST['usern'];
		$pw = $_POST['pw'];
		//echo($stmt);
		//$db->exec($stmt);
		echo('Here');
	    $stmt->execute();
	    
	        //disconnect from database
	    $db = null;
	}
	catch(PDOException $e)
	{
	    die('Exception : '.$e->getMessage());
	}

	//redirect user to another page now
	header("Location: login.html");
?>