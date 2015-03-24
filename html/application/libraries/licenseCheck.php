<?php
//require '../config/database.php' ;

numUsersInCompany(10001);
var_dump(areSeatsAvailable(10001));

function licenseCheck ($companyId)
{


}

//Pass in a companyId and get back a bool. True if there are still open seats and false if all seats are used
function areSeatsAvailable ($companyId)
{
	$numUsers = numUsersInCompany($companyId);
	$numSeats = totalNumSeats($companyId);
	var_dump($numUsers);
	echo "<br>";echo "<br>";
	var_dump($numSeats);
	echo "<br>";echo "<br>";
	if( $numUsers < $numSeats )
	{
		return true;
	}
	else
	{
		return false;
	}
}

//Pass in a companyId and this function returns the total number of seats that a company can use
function totalNumSeats ($companyId)
{
	$DBH = databaseConnect();
	
	try{
	$STH = $DBH->prepare("Select seats_available from licenses where company_id = :companyId") ;
	$STH->execute(array('companyId' => $companyId));
	}
	catch(PDOException $e) {
	    echo $e->getMessage();
	}

	while($row = $STH->fetch()) {
	    print_r($row['seats_available']);
	    $seats_available = $row['seats_available'];
	    echo "<br>";echo "<br>";
	}

	return $seats_available;
}

//Pass in a companyId and get back the number of users assigned to a company
function numUsersInCompany($companyId)
{
	$DBH = databaseConnect();
	
	try{
	$STH = $DBH->prepare("Select count(*) as 'count' from users where company_id = :companyId") ;
	$STH->execute(array('companyId' => $companyId));
	}
	catch(PDOException $e) {
	    echo $e->getMessage();
	}

	$count = 0;

	while($row = $STH->fetch()) {
	    print_r($row['count']);
	    $count = $row['count'];
	    echo "<br>";echo "<br>";
	}

	return $count;
}

//This function connects to a database and returns a PHP PDO object
function databaseConnect()
{
	try {
	  # MySQL with PDO_MYSQL
	  //$DBH = new PDO("mysql:host=" . $db['default']['hostname'] . ";dbname=" . $db['default']['database'], $db['default']['username'], $db['default']['password']);
		$DBH = new PDO("mysql:host=localhost;dbname=QCDentalApp", "root", "rootpass");
	}
	catch(PDOException $e) {
	    echo $e->getMessage();
	}
	return $DBH;
}
?>