

<?php
     require('../../config.php');
    $employeeId = $_POST['employeeId'];
    $sickChecker = false;
    $infoSql = $con->query("SELECT *
        FROM employee 
            LEFT JOIN leave_type ON employee.employee_type = leave_type.type_id 
            LEFT JOIN employee_type ON employee.employee_type = employee_type.type_id 
            LEFT JOIN academic_rank ON employee.academic_rank = academic_rank.rank_id
            LEFT JOIN designation ON employee.designation = designation.designation_id
            LEFT JOIN department ON employee.department = department.dept_id
            WHERE employee.employee_id = '$employeeId'
        ");
    if ($infoSql) {
        $employeeData = $infoSql->fetch_assoc();
        echo json_encode($employeeData); // Encode data as JSON
      } else {
        echo json_encode(array("error" => "Failed to retrieve employee data")); // Handle errors
      }
?>