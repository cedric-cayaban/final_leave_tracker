    <?php
        require('../config.php');
        session_start();
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/register.css?ver=0011">

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/979ee355d9.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <title>Document</title>
    </head>
    <body>
        
                        

        <input type="hidden" id="sick_Credits" value='<?=$employee['sick_credits']?>'>
        <input type="hidden" id="vacation_Credits" value='<?=$employee['vacation_credits']?>'>
        <input type="hidden" id="empId" value="<?=$employee['employee_id']?>">
        
        <input type="hidden" id="days">

        <div class="card">
            <div class="card-body">
                <div class="header">
                    <h1>New Leave</h1>
                </div>
        
        <div class="card-container">
                <div class="card card-outline card-primary">
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="" id="manage-user" enctype="multipart/form-data">	
                                <div class="row">
                                    <div class="col m-auto">
                                        <div class="form-group">
                                            <label for="leave_type">Staff</label>
                                            <select name="staff" id="staff" class="form-control select2bs4 select2 rounded-0" onchange="getStaff()">
                                                <?php 
                                                    while($staff = $staffSql->fetch_assoc()){ 
                                                ?>
                                                <option value="<?=$staff['employee_id'] ?>"><?=$staff['fname']?> <?=$staff['lname']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="leave_type">Leave Type</label>
                                            <select name="leave_type" id="leave_type" class="form-control select2bs4 select2 rounded-0" onchange="getStaff()">
                                                <?php 
                                                    while($leaveType = $leaveTypeSql->fetch_assoc()){ 
                                                ?>
                                                <option value="<?=$leaveType['type_id'] ?>"><?=$leaveType['leave_name']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <!-- dito ako nagstop -->
                                        <div class="form-group">
                                            <label for="option1">
                                             Special leave
                                            </label><br>
                                            <div class="radios ml-2">
                                           
                                            <input type="radio" name="special_leave" id="special_leave" value="false" checked> <span class="mr-3">No</span>
                                            <input type="radio" name="special_leave" id="special_leave" value="true"> <span>Yes</span>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="date">Start Date</label>
                                            <input type="date" name="endDate" id="start_Date" class="form-control rounded-0">
                                        </div>
                                        <div class="form-group">
                                            <label for="date">End Date</label>
                                            <input type="date" name="endDate" id="end_Date" class="form-control rounded-0" onchange="getStaff()">
                                        </div>
                                    
                                        <div class="form-group">
                                            <label for="rank">Leave length</label>
                                            <select name="leave_length" id="leave_length" class="form-control select2bs4 select2 rounded-0" onchange="getStaff()">
                                                <option value="whole">Whole day</option>
                                                <option value="half">Half day</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="cost">Available sick / vacation credits</label>
                                            <input type="number" disabled name="avail_credits" id="avail_credits" class="form-control rounded-0">
                                        </div>
                                        <div class="form-group">
                                            <label for="cost">Credits cost</label>
                                            <input type="number" disabled name="cost" id="cost" class="form-control rounded-0" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="reason">Details</label>
                                            <textarea rows="5" name="reason" id="reason" class="form-control rounded-0" style="resize:none !important"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <div class="registerBtn">
            <button id='submit'>Submit</button>
        </div>
            
        <script>
            $(document).ready(function() {
                getStaff();
               
            });
            
           
        
            function getStaff(){
                var employeeId = $('#staff').val();
                var leaveType = $('#leave_type').val();
                $.post({
                    url: '../ajax/admin/get_staff.php',
                    data: { employeeId: employeeId },
                    success: function(data) {
                            const employeeData = JSON.parse(data);
                            $('#empId').val(employeeData.employee_id);
                            var sickCredits = employeeData.sick_credits;
                            var vacCredits = employeeData.vacation_credits;
                            var startDate = new Date($('#start_Date').val());
                            var endDate = new Date($('#end_Date').val());
                            var leaveLength = $('#leave_length').val();
                            var days;
                            var creditCost;
                            
                            if(leaveType == 2){
                               
                                $('#avail_credits').val(sickCredits);

                            } else if(leaveType == 1){
                                
                                $('#avail_credits').val(vacCredits);
                            }
                            days = ((endDate - startDate) / (1000 * 3600 * 24) + 1);
                            if(days == 0 && leaveLength == 'whole'){
                                $("#cost").val(1);
                                $("#days").val(1);
                            }
                            else if(days == 0 && leaveLength == 'half'){
                                $("#cost").val(0.5);
                                $("#days").val(0.5);
                            }
                            else if(leaveLength == 'whole'){
                                creditCost = days * 1;
                                $("#cost").val(creditCost);
                                $("#days").val(creditCost);
                            }
                            else if(leaveLength == 'half'){
                                creditCost = days * 0.5;
                                $("#cost").val(creditCost);
                                $("#days").val(creditCost);
                            }
                            else if(days < 0){
                                alert(1);
                            }     
                                        
                    }
                                    
                });
            }

            // function computeCredit(){
               
            //     var leaveType = $('#leave_type').val();
            //     var startDate = new Date($('#start_Date').val());
            //     var endDate = new Date($('#end_Date').val());
            //     var leaveLength = $('#leave_length').val();
            //     var days;
            //     var creditCost;
            //     var sickCredits = $('#sick_Credits').val();
            //     var vacCredits = $('#vacation_Credits').val();
            //     alert(vacCredits);
            
            //     if(leaveType == 2){
            //         $('#medCert_upload').show();
            //         $('#avail_credits').val(sickCredits);

            //     } else if(leaveType == 1){
            //         $('#medCert_upload').hide();
            //         $('#avail_credits').val(vacCredits);
            //     }
            //     days = ((endDate - startDate) / (1000 * 3600 * 24) + 1);
            //     if(days == 0 && leaveLength == 'whole'){
            //         $("#cost").val(1);
            //         $("#days").val(1);
            //     }
            //     else if(days == 0 && leaveLength == 'half'){
            //         $("#cost").val(0.5);
            //         $("#days").val(0.5);
            //     }
            //     else if(leaveLength == 'whole'){
            //         creditCost = (days * 1);
            //         $("#cost").val(creditCost);
            //         $("#days").val(creditCost);
            //     }
            //     else if(leaveLength == 'half'){
            //         creditCost = days * 0.5;
            //         $("#cost").val(creditCost);
            //         $("#days").val(creditCost);
            //     }
            //     else if(days < 0){
            //         alert(1);
            //     }     
            // }

            $('#submit').click(function(){
                var empId = $('#empId').val();
                //alert(empId);
                var type = $('#leave_type').val();
                var compareSdate = new Date($('#start_Date').val()); 
                var sdate = $('#start_Date').val();
                var edate = $('#end_Date').val();
                var days = $('#days').val();
                var cost = $('#cost').val();
                var reason = $('#reason').val();
                var isSpecial = $('input[name=special_leave]:checked').val();
                var formData;
                var sickChecker = false;
                var currentDate = new Date();


                if (currentDate.toDateString() === compareSdate.toDateString()) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'You can\'t file a leave on the current day',
                    });
                } else if(days <= 0){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Incorrect date input',
                    });
                }

                else{
                    if(type == 1){
                        formData = new FormData();
                        formData.append('empId', empId);
                        formData.append('type', type);
                        formData.append('sdate', sdate);
                        formData.append('edate', edate);
                        formData.append('days', days);
                        formData.append('cost', cost);
                        formData.append('special', isSpecial);
                        formData.append('reason', reason);
                        // formData.append('leave_form', $('#leave_form')[0].files[0]);
                    }
                    else if(type == 2){
                        sickChecker = true;
                        formData = new FormData();
                        formData.append('empId', empId);
                        formData.append('type', type);
                        formData.append('sdate', sdate);
                        formData.append('edate', edate);
                        formData.append('days', days);
                        formData.append('cost', cost);
                        formData.append('reason', reason);
                        formData.append('special', isSpecial);
                        formData.append('leave_form', $('#leave_form')[0].files[0]);
                        // formData.append('medical_certificate', $('#medical_certificate')[0].files[0]);
                    }
                
                    if(type !== "" && sdate !== "" && edate !== "" && days !== ""){
                        $.post({
                            url: '../ajax/admin/new_request.php',
                            data: formData,
                            processData: false, 
                            contentType: false,  
                            success: function(data) {
                                data = data.trim();
                                if(data === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Application successful'
                                    }).then((result) => {
                                        
                                        if(result.isConfirmed){
                                           
                                            $.post({
                                                url: '../ajax/admin/get_staff.php?empId=' + empId,
                                                success: function(response) {
                                                    var downloadLink = document.createElement('a');
                                                    downloadLink.href = '../ajax/admin/export_details_report.php?empId=' + empId;
                                                    downloadLink.download = 'employee_reports.pdf';
                                                    document.body.appendChild(downloadLink); // Append link to body
                                                    downloadLink.click(); // Initiate download
                                                    document.body.removeChild(downloadLink); // Remove link from body after download
                                                    
                                                    console.log("empId:", empId);
                                                    // Reload the page after a short delay (adjust as needed)
                                                    setTimeout(function() {
                                                        window.location.reload();
                                                    }, 1000); // Reload after 1 second (1000 milliseconds)
                                                },
                                                error: function(xhr, status, error) {
                                                    // Handle error
                                                    console.error(error);
                                                }
                                            });


                                           
                                        }
                                    });
                                } else if(data === 'insufficient') {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Insufficient leave credits',
                                    }).then((result) => {
                                        if(result.isConfirmed){
                                            
                                            //window.location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: data,
                                    });
                                }
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: "Please fill up all required fields",
                        });
                    }
                }

                
            });
        </script>
    </body>
    </html>
