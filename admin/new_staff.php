<?php
    require('../config.php');
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/register.css?ver=0009">

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/979ee355d9.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Document</title>
</head>
<body>
    
<div class="container col-7 mt-5">
    <div class="header">
        <h1>New Staff</h1>
    </div>
    <div class="card card-outline card-primary">
        <div class="card-body">
            <div class="container-fluid">
                <form action="" id="manage-user">	
                    <div class="row">
                        <div class="col-6">
                            
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" name="firstname" id="firstname" class="form-control rounded-0">
                            </div>
                            <div class="form-group">
                                <label for="middlename">Middle Name</label>
                                <input type="text" name="middlename" id="middlename" class="form-control rounded-0">
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="lastname" id="lastname" class="form-control rounded-0">
                            </div>
                            <div class="form-group">
                                <label for="birthdate">Birthdate</label>
                                <input type="date" name="birthdate" id="birthdate" class="form-control rounded-0">
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact #</label>
                                <input type="number" name="contact" id="contact" class="form-control rounded-0">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="firstname">Staff ID</label>
                                <input type="text" name="firstname" id="empId" class="form-control rounded-0">
                            </div>
                            <div class="form-group">
                                <label for="birthdate">Date hired</label>
                                <input type="date" name="hired" id="hired" class="form-control rounded-0">
                            </div>
                            <div class="form-group">
                                <label for="designation">Designation </label>
                                <select name="designation" id="designation" class="form-control select2bs4 select2 rounded-0" data-placeholder="Please Select Designation here" reqiured>
                                    <option ></option>
                                    <?php while($designation = $designationSql -> fetch_assoc()){ ?>
                                        <option value="<?=$designation['designation_id']?>"><?=$designation['designation_name']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea rows="5" name="address" id="address" class="form-control rounded-0" style="resize:none !important" ></textarea>
                            </div>
                           
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="registerBtn mt-5">
        <button id='register'>Add</button>
    </div>
</div>

<script>
            
    $('#register').click(function(){
            var empId = $('#empId').val();
            var fname = $('#firstname').val();
            var mname = $('#middlename').val();
            var lname = $('#lastname').val();
            var birthdate = $('#birthdate').val();
            var address = $('#address').val();
            var contact = $('#contact').val();
            var employee_type = $('#employee_type').val();
            var date_hired = $('#hired').val();
            var rank = $('#rank').val();
            var department = $('#department').val();
            var designation = $('#designation').val();
            var username = $('#username').val();
            var password = $('#password').val();
            var working_status  = $('#status').val();
            //alert(employee_type);

            var currentDate = new Date();
            var dateHired = new Date($('#hired').val());
            var dateDifference = Math.floor((currentDate - dateHired) / (1000 * 60 * 60 * 24));
            // alert(dateDifference);
            if(empId !== '' && fname !== '' && lname !== '' && birthdate !== '' && address !== '' && contact !== '' && username !== '' && password !== '' && employee_type !== '' && department !== '' && date_hired !== '' && working_status !== ''){
                $.post('../ajax/admin/register_staff.php',
                {
                    empId: empId,
                    fname: fname, 
                    contact: contact,
                    mname: mname, 
                    lname: lname, 
                    birthdate: birthdate, 
                    address: address, 
                    date_hired: date_hired,
                    designation: designation,
                    dateDifference: dateDifference
                }, 
                function(data, status){
                    data = data.trim();
                    if(data === 'success'){

                        Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Registration successful'
                            }).then((result) =>{
                                if(result.isConfirmed){
                                    loadContent('staff.php');
                                }
                            });
                    }
                    else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data,
                        });
                    }
                });
            }
            else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please fill up all required fields',
                });
            }
            
        });
</script>

    
</body>
</html>