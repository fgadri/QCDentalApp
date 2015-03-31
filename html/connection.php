<?php
    $serverName = "localhost";
    $userName = "qcadmin";
    $password = "J2PKY!HrkYt*AB8dhz@rYw\$X";
    $dbName = "QCDentalApp";
    
    //Create Connection
    $conn = new mysqli($serverName,$userName,$password,$dbName);
    //Check Connection
    if($conn->connect_error)
        die("Connection failed: " . $conn->connect_error);
        
    function query($str)
    {
        global $conn;
        
        $result = $conn->query($str);
        if($result == false)
        {
            echo "\n\nERROR\n\n";
            echo $conn->error."\n";
            echo $conn->errno;
        }
        return $result;
    }
?>