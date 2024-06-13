<?php
require('../../config.php');
session_start();

if (!isset($_SESSION['department'])) {
    header("Location: ../index.php");
    exit;
}


$adminDept = $_SESSION['department'];
$empId = $_GET['empId'];

$employeeDetailsSql = $con->query("SELECT fname, lname, designation_name FROM employee JOIN designation ON employee.designation=designation.designation_id WHERE employee_id = '$empId' AND department = '6'");
$employeeDetails = $employeeDetailsSql->fetch_assoc();


$reportSql = $con->query("SELECT * FROM 
                            employee_leave 
                            INNER JOIN employee ON employee_leave.employee_id = employee.employee_id 
                            WHERE employee.department = '6' AND employee.employee_id = '$empId'
                            ORDER BY start_date ASC, date_earned ASC"
                        );


require_once '../../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$dompdf = new Dompdf($options);

ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Reports</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            margin-bottom: 20px;
            text-align: center;
        }
        .header div {
            margin-bottom: 10px;
        }
        .header .line {
            display: inline-block;
            border-bottom: 1px solid #000;
            width: 300px; /* Adjust width as needed */
            vertical-align: middle;
        }
        .header label {
            font-size: 12px; /* Increase the font size */
            font-weight: bold;
            vertical-align: middle;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 4px;
            border: 1px solid #000;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
            font-size: 0.7rem;
        }

        #date-detail{
            font-size: 0.6rem;
        }
    </style>
</head>
<body>
    <div class="header">
    
    
        <div><label for="name">Name:</label> <span class="line"><?=$employeeDetails['fname']?> <?=$employeeDetails['lname']?></span></div>
        <div><label for="position">Position:</label> <span class="line"><?=$employeeDetails['designation_name']?></span></div>
        
    </div>
    <table>
        <thead>
            <tr>
                <th rowspan="2" style="width: 100px;">Details of Credits</th>
                <th colspan="3">Earned</th>
                <th colspan=""></th>
                <th colspan="3">Used</th>
                <th colspan="3">Balance</th>
            </tr>
            <tr>
                <th style="width: 40px;">Service</th>
                <th style="width: 50px;">Vacation</th>
                <th style="width: 40px;">Sick</th>
                <th style="width: 40px;">Special <br> leave</th>
                <th style="width: 40px;">Service</th>
                <th style="width: 50px;">Vacation</th>
                <th style="width: 40px;">Sick</th>
                <th style="width: 40px;">Service</th>
                <th style="width: 50px;">Vacation</th>
                <th style="width: 40px;">Sick</th>
            </tr>
        </thead>
        <tbody>
        
            <?php while ($employee = $reportSql->fetch_assoc()): ?>
                <tr>
                <td>
                    <p id='date-detail'>
                        <?php
                        if ($employee['event_type'] == 'earn') {
                            echo date('n/j/Y', strtotime($employee['date_earned']));
                        } elseif ($employee['event_type'] == 'leave') {
                            echo date('n/j/Y', strtotime($employee['start_date'])) . ' - ' . date('n/j/Y', strtotime($employee['end_date']));
                        } else {
                            echo '';
                        }
                        ?>
                    </p>
                    <p id='leave-detail'><?= $employee['event_type'] == 'earn' ? 'Earn credits' : ($employee['event_type'] == 'leave' ? ($employee['reason'] ?? 'Employee files a leave') : 'Employee files a leave') ?></p>


                    
                </td>



                    <td><?= $employee['earned_service'] ?? false ? '1.5' : '' ?></td>
                    <td><?= $employee['earned_vacation'] ?? false ? '1.5' : '' ?></td>
                    <td><?= $employee['earned_sick'] ?? false ? '1.5' : '' ?></td>

                    <td><?= $employee['special_leave'] === 'true' ? '/' : '' ?></td>

                    <td><?= $employee['leave_type'] == '3' ? $employee['credit_cost'] : '' ?></td>
                    <td><?= $employee['leave_type'] == '1' ? $employee['credit_cost'] : '' ?></td>
                    <td><?= $employee['leave_type'] == '2' ? $employee['credit_cost'] : '' ?></td>
                    
                    <td>
                        <?php 
                            if ($employee['event_type'] == 'earn') {
                                echo $employee['earned_service'];
                            } elseif ($employee['event_type'] == 'leave' && $employee['leave_type'] == '3') {
                                echo $employee['credit_balance'];
                            } else {
                                echo '';
                            }
                        ?>
                    </td>

                    <td>
                        <?php 
                            if ($employee['event_type'] == 'earn') {
                                echo $employee['earned_vacation'];
                            } elseif ($employee['event_type'] == 'leave' && $employee['leave_type'] == '1') {
                                echo $employee['credit_balance'];
                            } else {
                                echo '';
                            }
                        ?>
                    </td>


                    <td>
                        <?php 
                            if ($employee['event_type'] == 'earn') {
                                echo $employee['earned_sick'];
                            } elseif ($employee['event_type'] == 'leave' && $employee['leave_type'] == '2') {
                                echo $employee['credit_balance'];
                            } else {
                                echo '';
                            }
                        ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
<?php
$html = ob_get_clean();

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait'); // Adjusting to landscape as per the example
$dompdf->render();

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="employee_reports.pdf"');

echo $dompdf->output();
exit;
?>
