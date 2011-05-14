<?php

header('Content-type: text/html;  charset:utf-8', true);

function pr($value) {
	echo '<pre>';
	print_r($value); 
	echo '</pre>';
}

try
{
	//open the database
	$db = new PDO('sqlite2:db/comments.sqlite');

	//create the database
	//$db->exec("CREATE TABLE skitter_comments (id INTEGER PRIMARY KEY, name VARCHAR, email VARCHAR, comment TEXT, created DATETIME)");    
	
	$db->exec("SET names utf-8");
	$db->exec("INSERT INTO skitter_comments (name, email, comment, created) VALUES ('João Buracao', 'joao@gmail.com.br', 'olá para todos', '".time()."');");

	$result = $db->query('SELECT * FROM skitter_comments ORDER BY id desc');
	$teste = $result->fetchAll();
	pr($teste);
	
	foreach($result as $row)
	{
		//pr($row);
	}

	/*
	//insert some data...
	$db->exec("INSERT INTO Dogs (Breed, Name, Age) VALUES ('Labrador', 'Tank', 2);".
			   "INSERT INTO Dogs (Breed, Name, Age) VALUES ('Husky', 'Glacier', 7); " .
			   "INSERT INTO Dogs (Breed, Name, Age) VALUES ('Golden-Doodle', 'Ellie', 4);");

	//now output the data to a simple html table...
	print "<table border=1>";
	print "<tr><td>Id</td><td>Breed</td><td>Name</td><td>Age</td></tr>";
	$result = $db->query('SELECT * FROM Dogs');
	foreach($result as $row)
	{
	  print "<tr><td>".$row['Id']."</td>";
	  print "<td>".$row['Breed']."</td>";
	  print "<td>".$row['Name']."</td>";
	  print "<td>".$row['Age']."</td></tr>";
	}
	print "</table>";
	*/

	// close the database connection
	$db = NULL;
}
catch(PDOException $e)
{
	print 'Exception : '.$e->getMessage();
}

