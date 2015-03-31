<?php
    include "connection.php";

    $adminName = $_GET["username"];
    $company_id_row = 9;
    $employeeSeparator = "&";
    $attrSeparator = "|";
    
    //Query for Company ID of administrator & store 
    $queryStr = "SELECT * FROM users WHERE username='$adminName'";
    $result = query($queryStr);
    $row = $result->fetch_row();
    $company_id = $row[$company_id_row];
    
    //Query for users with that company id that are not the administrator
    $queryStr = "SELECT * FROM users WHERE company_id='$company_id' AND NOT username='$adminName'";
    $result = query($queryStr);

    //Parse results into string for response to front end
    $retStr="";
    while($row = $result->fetch_row())
    {
        $i = 0;
        while($i < count($row))
        {
            $retStr.= $row[$i];
            $retStr.= $attrSeparator;
            $i++;
        }
        $retStr.=$employeeSeparator;
    }
    echo $retStr;
    //handle case of multiple returned admins, or no returned admins, and no returned users
?>