

<?php
     require('../../config.php');
    $employeeId = $_POST['empId'];
   
    $infoSql = $con->query("UPDATE employee
           SET employee.acc_status = 'Disabled' WHERE employee.employee_id = '$employeeId'
        ");

  
    echo 'success';
   
?>