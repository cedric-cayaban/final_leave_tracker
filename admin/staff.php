<?php
    require('../config.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/contents.css?ver=0001">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <script src="https://kit.fontawesome.com/9c6f27a8d7.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+I4dHt0YIvI3Mpjs4L+AdfYqlA3oWeBSwF8umNikyJZYhEN" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<style>
    



</style>
<body>
<div class="card card-outline card-primary mt-4" id="load-content">
	<div class="card-header d-flex justify-content-between">
		<h3 class="card-title">Staff list</h3>
		<div class="d-flex">
            <!-- <button class="btn btn-sm btn-primary mx-2" onclick="generatePDF()">Download PDF</button>   -->
            <a href="#" class="btn btn-flat btn-primary me-3" onclick="loadContent('new_staff.php')"><i class="fas fa-plus"></i> Add Staff</a>   
        </div>
	</div>
	<div class="card-body">
		
        <div class="container-fluid">
			<table id="tableData" class="table table-striped">
				
				<colgroup>
                    <col width="10%">
					<col width="12%">
					<col width="12%">
                    <col width="10%">
					<col width="12%">
					<col width="12%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>ID</th>
						<th>Last Name</th>
						<th>First Name</th>
						<th>Middle Name</th>
                        <th>Vacation Credits</th>
						<th>Sick Credits</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
                    <?php
                        if(isset($_SESSION['department'])){
                            $adminDept = $_SESSION['department'];
                        }
                        $counter = 0;
                        $reportSql = $con->query("SELECT * FROM 
                            employee 
                            WHERE employee.department = '$adminDept' AND employee.acc_status = 'Accepted'"
                        );
                        while($employee = $reportSql->fetch_assoc()){
                            $counter++;
                    ?>
                    <tr>
                        <td><small><?=$employee['employee_id']?></small><br></td>
                        <td><small><?=$employee['lname']?></small></td>
                        <td><small><?=$employee['fname']?></small></td>
                        <td><small><?=$employee['mname']?></small></td>
                        <td><?=$employee['vacation_credits']?></td>
                        <td><?=$employee['sick_credits']?></td>
                        <td> 
                        <button class="btn btn-flat btn-default btn-sm dropdown-toggle" onclick="toggleAction(<?=$counter?>)" aria-expanded="false">Action</button>
                            <div class="dropdown-content" id="actionMenu<?=$counter?>">
                            <a href="#" onclick="reqAction('<?=($employee['employee_id'])?>', 'view')"><i class="fa fa-eye text-primary text-dark"></i> View</a>
                                <a href="#" onclick="removeStaff('<?=$employee['employee_id']?>')"><i class="fa-solid fa-circle-xmark text-danger"></i> Remove</a>
                            </div>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tableData').DataTable({
            searching: true
        });
    });

    function toggleAction(counter) {
       
       var dropdownContent = document.getElementById("actionMenu" + counter);
       if (dropdownContent.style.display === "block") {
           dropdownContent.style.display = "none";
       } else {
           dropdownContent.style.display = "block";
       }
   }

   function reqAction(empId, action){ 
    

    $.post('../ajax/admin/view_employee.php', 
    {
        empId: empId,
        action: action
    }, 
    function(data, status){
        if(data === 'cancelled'){ 
            $('#contents').load('requests.php');
        }
        else if(data === 'error'){
            $('#employeeInfo').html('No data');
            $('#employeeModal').modal('show');
        }
        else{
            $('#employeeInfo').html(data);
            $('#employeeModal').modal('show');
        }
    });
    }

   function removeStaff(empId){
    
    $.post('../ajax/admin/remove_staff.php', 
        {
            empId: empId,
        }, 
        function(data, status){
            
               
                loadContent('staff.php');
           
        });
   }

    function generatePDF() {
        window.location.href = '../ajax/admin/export_reports.php';
    }

</script>

<div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="employeeModalLabel">Leave Information</h5>
					<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" id="employeeInfo">
				
				</div>
			</div>
		</div>
	</div>

</body>
</html>
