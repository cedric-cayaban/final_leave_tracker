<?php
    require('../../config.php');
    $empId = $_POST['empId'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $birthdate = $_POST['birthdate'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $hired = $_POST['date_hired'];
   
    $designation = $_POST['designation'];
    $dateDifference = $_POST['dateDifference'];
    $vacCost = 0;
    $sickCost = 0;
    $specialCost = 0;
    $serviceCost = 0;

    $initvcredits = number_format(($dateDifference - 1) * 0.04141667 + 0.042, 2);
    $initsCredits = number_format(($dateDifference - 1) * 0.04141667 + 0.042, 2);
    //$initspCredits = number_format(($dateDifference - 1) * 0.04141667 + 0.042, 2);
    $initsvCredits = number_format(($dateDifference - 1) * 0.04141667 + 0.042, 2);
    
    
    $vacCreditsSql = $con -> query("SELECT * FROM employee_leave WHERE employee_id = '$empId' AND leave_type = 1");
    $sickCreditsSql = $con -> query("SELECT * FROM employee_leave WHERE employee_id = '$empId' AND leave_type = 2");
    $spCreditsSql = $con -> query("SELECT * FROM employee_leave WHERE employee_id = '$empId' AND leave_type = 3");

    while($vcredits = $vacCreditsSql -> fetch_assoc()){
        $vacCost += $vcredits['credit_cost'];
    }

    while($scredits = $sickCreditsSql -> fetch_assoc()){
        $sickCost += $scredits['credit_cost'];
    }

    while($spcredits = $spCreditsSql -> fetch_assoc()){
        $specialCost += $spcredits['credit_cost'];
    }

    $finalvCredits = $initvcredits - $vacCost;
    $finalsCredits = $initsCredits - $sickCost;
    //$finalspCredits = $initspCredits - $specialCost;
    $finalsvCredits = $initsvCredits;

   $regSql = $con->query("INSERT INTO employee(employee_id, acc_status, fname, mname, lname, sick_credits, vacation_credits, service_credits, birthdate, contact, date_hired, address, department, designation) 
    VALUES('$empId', 'Accepted', '$fname', '$mname', '$lname',  $finalsCredits, $finalvCredits, $finalsvCredits, '$birthdate', $contact, '$hired', '$address', 6, '$designation')");
  
    if ($regSql) {
        echo 'success';
    } else {
        echo "Error: " . $con->error;
    }
?>




