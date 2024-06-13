<?php
    require('../../config.php');

    $employeeId = $_POST['empId'];
    $action = $_POST['action'];

    if($action == 'view'){
        $employeeInfoSql = $con->query("SELECT * FROM 
                                    employee 
                                    JOIN designation ON employee.designation=designation.designation_id
                                    WHERE employee_id = '$employeeId'");
        if($employeeInfoSql){
            $employee = $employeeInfoSql->fetch_assoc();

            $html = '<p><strong>ID:</strong> ' . $employee['employee_id'] . '</p>';
            $html = '<p><strong>First Name:</strong> ' . $employee['fname'] . '</p>';
            $html .= '<p><strong>Middle Name:</strong> ' . $employee['mname'] . '</p>';
            $html .= '<p><strong>Last Name:</strong> ' . $employee['lname'] . '</p>';
            $html .= '<p><strong>Date hired:</strong> ' . $employee['date_hired'] . '</p>';
            $html .= '<p><strong>Vacation credits:</strong> ' . $employee['vacation_credits'] . '</p>';
            $html .= '<p><strong>Sick credits:</strong> ' . $employee['sick_credits'] . '</p>';
            $html .= '<p><strong>Contact #:</strong> ' . $employee['contact'] . '</p>';
            $html .= '<p><strong>Address:</strong> ' . $employee['address'] . '</p>';
            $html .= '<p><strong>Designation:</strong> ' . $employee['designation_name'] . '</p>';
            
            
            echo $html;
        }
    }
    else if($action == 'cancel'){
        $rejectLeaveSql = $con -> query("UPDATE employee_leave SET employee_leave.status = 'Canceled' WHERE employee_leave.leave_id = '$leaveId'");
        if($rejectLeaveSql){
            echo 'cancelled';
        }
    }
    else if($action == 'reason'){
        $employeeInfoSql = $con->query("SELECT * FROM 
                                    employee_leave 
                                    INNER JOIN employee ON employee_leave.employee_id=employee.employee_id 
                                    INNER JOIN leave_type ON employee_leave.leave_type = leave_type.type_id 
                                    WHERE leave_id = '$leaveId'");
        if($employeeInfoSql){
            $reason = $employeeInfoSql -> fetch_assoc();
            echo $reason['reject_reason'];
        }
    }
    else{
        echo 'error';
    }
    

?>