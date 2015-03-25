<?php
//require 'licenseCheck.php';

//getTotalUsers(10001);
//updateNumSeats(2, 10001);

#updates the number of seats available for a given company
function updateNumSeats($newSeats, $companyID) 
{
	$users = getTotalUsers($companyID);
	if ($users >= $newSeats) {
		echo 'Cannot change number of seats to fewer than the number of users';
	}
	else {
		$conn = databaseConnect();
		$stmt = $conn->prepare('UPDATE licenses SET seats_available = :seats_available WHERE company_id = :company_id');
  		$stmt->execute(array(
    		':company_id'   => $companyID,
    		':seats_available' => $newSeats
  		));

  		echo $stmt->rowCount() . ' row modified'; //should be 1
	}
}

function updateLicenseDuration($)

#gets the total number of users for a given company
function getTotalUsers($companyID)
{
	$conn = databaseConnect();
	$stmt = $conn->prepare('SELECT count(id) FROM users WHERE company_id = :company_id');
	$stmt->execute(array(':company_id' => $companyID));

	$users = $stmt->fetch();
	return $users['count(id)'];
}


//THIS FUNCTION IS NOT REQUIRED IF licenseCheck.php is available
function databaseConnect()
{
	$username = 'root'; //$db['default']['username']
	$password = 'rootpass'; //$db['default']['password']
	try {
		$conn = new PDO('mysql:host=localhost;dbname=QCDentalApp', $username, $password);
	}
	catch (PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	return $conn;
}

?>