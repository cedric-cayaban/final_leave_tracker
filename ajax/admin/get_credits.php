<?php
    require('../../config.php');

   
    function calculateDateDifference($dateHired) {
        $currentDate = new DateTime();
        $hiredDate = new DateTime($dateHired);
        $interval = $currentDate->diff($hiredDate);
        return $interval->days;
    }
    
    $employeesSql = $con -> query("SELECT * FROM employee where department = 6 AND acc_status = 'Accepted'");

    while($emp = $employeesSql -> fetch_assoc()){
        $empId = $emp['employee_id'];
        $dateHired = $emp['date_hired'];

        $vacCost = 0;
        $sickCost = 0;

        $dateDifference = calculateDateDifference($dateHired);

      

        $initvcredits = number_format(($dateDifference - 1) * 0.04141667 + 0.042, 2);
        $initsCredits = number_format(($dateDifference - 1) * 0.04141667 + 0.042, 2);

        $vacCreditsSql = $con -> query("SELECT * FROM employee_leave WHERE employee_id = '$empId' AND leave_type = 1");
        $sickCreditsSql = $con -> query("SELECT * FROM employee_leave WHERE employee_id = '$empId' AND leave_type = 2");

        while($vcredits = $vacCreditsSql -> fetch_assoc()){
            $vacCost += $vcredits['credit_cost'];
        }

        while($scredits = $sickCreditsSql -> fetch_assoc()){
            $sickCost += $scredits['credit_cost'];
        }

        $finalvCredits = $initvcredits - $vacCost;
        $finalsCredits = $initsCredits - $sickCost;
        
        $setCreditsSql = $con -> query("UPDATE employee set sick_credits = $finalsCredits, vacation_credits = $finalvCredits WHERE employee_id = '$empId'");
    }
    

    

    if($setCreditsSql){
        echo 'success';
    }
   
?>
