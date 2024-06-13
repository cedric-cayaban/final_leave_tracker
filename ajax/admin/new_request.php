<?php
require('../../config.php');

function calculateDateDifference($dateHired) {
    $currentDate = new DateTime();
    $hiredDate = new DateTime($dateHired);
    $interval = $currentDate->diff($hiredDate);
    return [
        'days' => $interval->days,
        'months' => ($interval->y * 12) + $interval->m
    ];
}

function getLastDayOfMonth($year, $month) {
    return new DateTime("last day of $year-$month");
}

$empId = $_POST['empId'];
$type = $_POST['type'];
$sdate = $_POST['sdate'];
$edate = $_POST['edate'];
$days = $_POST['days'];
$cost = $_POST['cost'];
$reason = $_POST['reason'];
$isSpecial = $_POST['special'];

$employeeCreditSql = $con->query("SELECT * FROM employee WHERE employee_id = '$empId'");

if ($employeeCreditSql) {
    $employee = $employeeCreditSql->fetch_assoc();
    $dateHired = $employee['date_hired'];
    
    if ($type == 1) {
        $employeeCredit = $employee['vacation_credits'];
    } else if ($type == 2) {
        $employeeCredit = $employee['sick_credits'];
    }

    // echo "Employee Credit: $employeeCredit\n";
    // echo "Cost: $cost\n";

    $creditsComputation = $employeeCredit - $cost;

    // echo "Credits Computation: $creditsComputation\n";

    if ($creditsComputation >= 0) {

        $dateDifference = calculateDateDifference($dateHired);
        $monthsDifference = $dateDifference['months'];

        $currentDate = new DateTime();
        $hiredDate = new DateTime($dateHired);

        for ($a = 0; $a < $monthsDifference; $a++) {
            $monthToAdd = clone $hiredDate;
            $monthToAdd->modify("+$a month");

            $lastDayOfMonth = getLastDayOfMonth($monthToAdd->format('Y'), $monthToAdd->format('m'));

            $checkCreditSql = $con->query("SELECT * FROM employee_leave WHERE employee_id = '$empId' AND date_earned = '{$lastDayOfMonth->format('Y-m-d')}'");

            if ($checkCreditSql->num_rows == 0) {
                $creditsEarned = (($a + 1) * 1.5);
                $creditEarnedSql = $con->query("INSERT INTO employee_leave (employee_id, date_earned, earned_service, earned_vacation, earned_sick, event_type)
                    VALUES ('$empId', '{$lastDayOfMonth->format('Y-m-d')}', $creditsEarned, $creditsEarned, $creditsEarned, 'earn')");
            }
        }
        $stmt = $con->prepare("INSERT INTO employee_leave (
            employee_id, leave_type, special_leave, start_date, end_date, status, leave_form, med_cert, days, credit_cost, credit_balance, event_type, reason) 
            VALUES (?, ?, ?, ?, ?, 'Pending', NULL, NULL, ?, ?, ?, 'leave', ?)");
        $stmt->bind_param('sisssidds', $empId, $type, $isSpecial, $sdate, $edate, $days, $cost, $creditsComputation, $reason);

        if ($stmt->execute()) {
          

            

            echo 'success';
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo 'insufficient';
    }
} else {
    echo "Error: Employee not found.";
}
?>
