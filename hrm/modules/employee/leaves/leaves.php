<!DOCTYPE html>
<html lang="<?php echo $lang_code; ?>" dir="<?php echo $page_direction; ?>">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>



<head>
    <style>
        /* Add this to your CSS code */
        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
        }

        .modal-image-container {
            display: flex;
            flex-wrap: wrap;
            /* Allow images to wrap to a new line if they exceed the container width */
        }

        .modal-image {
            width: 10%;
            padding: 5px;
            margin-right: 10px;
            /* Add some spacing between the images */
        }

        .claim-view-images {
            border: 1px solid #f0f2f5;
            display: inline;
            margin-left: 10px;
            margin-bottom: 5px;
            cursor: pointer;
        }

        .modal-dialog {
            height: 150%;
            max-width: 80%;
            margin: 1.75rem auto;
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            margin-top: 10%;
            margin-bottom: 10%;
            padding: 20px;
            border: 1px solid #888;
            width: 60%;
            height: 40%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .ant-tag {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            color: rgba(0, 0, 0, .65);
            font-size: 14px;
            font-variant: tabular-nums;
            line-height: 1.5;
            list-style: none;
            -webkit-font-feature-settings: "tnum";
            font-feature-settings: "tnum";
            display: inline-block;
            height: 22px;
            margin-right: 8px;
            padding: 0 7px;
            font-size: 12px;
            line-height: 20px;
            white-space: nowrap;
            background: #fafafa;
            border: 1px solid #d9d9d9;
            border-radius: 4px;
            cursor: pointer;
            opacity: 1;
            -webkit-transition: all .3s cubic-bezier(.215, .61, .355, 1);
            -o-transition: all .3s cubic-bezier(.215, .61, .355, 1);
            transition: all .3s cubic-bezier(.215, .61, .355, 1);
        }
    </style>
</head>

<?php 

$addLeaveStatus = false;
$addLeaveMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $no_of_days = $_POST['no-of-days'];
    $leave_type = $_POST['leave-type'];
    $employeeId = $_POST['employeeId'];

    // print($_POST['no-of-days']); die();

    // echo $employeeId;
    $file = "testPhp.log";
    $message = "This is a log message";
    // Print the log message to a file
    error_log($message . "\n", 3, $file);

    // // Insert the data into the database
    // $stmt = $pdo->prepare("INSERT INTO employee_leaves (emp_id, no_of_days, leave_type) VALUES (?, ?, ?)");
    // $success = $stmt->execute([$employeeId, $no_of_days, $leave_type]);

    $success = $pdo->query("INSERT INTO employee_leaves (emp_id, no_of_days, leave_type) VALUES ('".$employeeId."', '".$no_of_days."', '".$leave_type."')");
    // $success = $stmt->execute([$employeeId, $no_of_days, $leave_type]);
    // echo $stmt; die();
    if ($success) {
        error_log("Data inserted successfully" . "\n", 3, $file);
        $addLeaveStatus = true;
        $addLeaveMsg = 'Data inserted successfully';
    } else {
        error_log("Error inserting data: " . $stmt->errorInfo()[2] . "\n", 3, $file);
        $addLeaveStatus = false;
        $addLeaveMsg = 'Erro inserting data';
    }

}

?>

<div class="row" style="width: 98%;margin-left: 1%;">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">

            <div class="card-body">
                <?php $recEmpData = $pdo->query(
                    'select el.*,e.info_fullname_en as name from employee_leaves el inner join employees e on e.empId=el.emp_id'
                ); ?>

                <div class="mb-2" align="<?php echo $_right; ?>">

                    <button type="button" class="btn btn-primary modal-button open-add-leaves-modal" href="#myModal1" data-empid="<?php echo $recEmpData?$recEmpData[0]['id']:''; ?>" data-toggle="modal" data-target="#myModal">Add Leave</button>

                </div>

                <h3>Leave List</h3>

                <?php if( $addLeaveStatus && ($addLeaveMsg!='') ) { ?>

                    <div class="alert alert-sucecss">
                    <?php echo $addLeaveMsg ?>
                    </div>

                <?php } ?>

                <table class="table table-sm table-responsive-sm table-condensed table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <!-- <th>I.D</th>
                            <th>Name</th> -->
                            <th>No of days</th>
                            <th>Leave type</th>
                            <th>Status</th>
                            <th>PDF</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php for ($i = 0; $i < count($recEmpData); $i++) { ?>
                            <tr>
                                <!-- <td><?php echo $recEmpData[$i]['id']; ?>
                                </td>
                                <td><?php echo $recEmpData[$i]['name']; ?>
                                </td> -->
                                <td><?php echo $recEmpData[$i]['no_of_days']; ?>
                                </td>
                                <td><?php echo $recEmpData[$i]['leave_type']; ?>
                                </td>
                                <td class="" style="text-align: left;">
                                    <?php
                                    // $pd->bind('expenseId',$recEmpData[$i]['id']);
                                    $getStatus = $pdo->query(
                                        'SELECT s.status_name from `status` s join employee_leave_status es on s.id=es.statusId' // where es.expenseId=1;'
                                    );
                                    $HOD = false;
                                    $AM = false;
                                    for ($j = 0; $j < count($getStatus); $j++) {
                                        if (
                                            $getStatus[$j]['status_name'] ==
                                            'HOD_approved'
                                        ) {
                                            $HOD = 'approved';
                                        } elseif (
                                            $getStatus[$j]['status_name'] ==
                                            'AM_approved'
                                        ) {
                                            $AM = 'approved';
                                        } elseif (
                                            $getStatus[$j]['status_name'] ==
                                            'AM_disapproved'
                                        ) {
                                            $AM = 'disapprove';
                                        } elseif (
                                            $getStatus[$j]['status_name'] ==
                                            'HOD_disapproved'
                                        ) {
                                            $HOD = 'disapprove';
                                        }
                                    }
                                    ?>

                                    <div class="ant-tag " style="<?php if (
                                                                        $HOD == 'approved'
                                                                    ) {
                                                                        echo 'background-color: rgb(135, 208, 104)';
                                                                    } elseif ($HOD == 'disapprove') {
                                                                        echo 'background-color: red;';
                                                                    } else {
                                                                        echo 'background-color: white';
                                                                    } ?>">
                                        HOD</div>
                                    <div class="ant-tag " style="<?php if (
                                                                        $AM == 'approved'
                                                                    ) {
                                                                        echo 'background-color: rgb(135, 208, 104)';
                                                                    } elseif ($AM == 'disapprove') {
                                                                        echo 'background-color: red;';
                                                                    } else {
                                                                        echo 'background-color: white';
                                                                    } ?>">
                                        AM</div>
                                </td>

                                <td>
                                    <button class="modal-button" id="employee-data-btn" href="#myModal2" style="background: none;" data-id="<?php echo $recEmpData[$i]['id']; ?>"><i class="fa fa-folder"></i></button>
                                </td>


                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div id="myModal1" class="modal">

    <div class="modal-dialog" role="document">
        <form name="add-leave-formx" method="post">
            <input type="hidden" name="employeeId" class="add-leave-empid">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addClaimModalLabel">Add Leave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- <form action="" method="POST" > -->
                        <div class="form-group">
                            <label for="no-of-days">Number of days:</label>
                            <input type="number" class="form-control" id="no-of-days" name="no-of-days" min="1">
                        </div>

                        <div class="form-group">
                            <label for="no-of-days">Leave Type:</label>
                            <input type="text" class="form-control" id="leave-type" name="leave-type">
                        </div>


                        <div class="form-group">
                            <label for="claim-attachments">Leave Attachment (Please add attachment)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="claim-attachments" name="claim-attachments[]" accept=".jpg, .jpeg, .png, .gif, .php, .html" multiple>
                                <label class="custom-file-label" for="claim-attachments">Choose file</label>
                            </div>
                        </div>
                    <!-- </form> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Leave</button>
                </div>

            </div>
        </form>
    </div>

</div>

<!-- The Modal -->
<div id="myModal2" class="modal">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewAttachmentsModalLabel">Attachments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <?php
                // Connect to the database

                $file = "testPhp.log";
                $message = "From leaves.php, This is a log message";
                // Print the log message to a file
                error_log($message . "\n", 3, $file);


                $result = $pdo->query(
                    'SELECT el.attachment from employee_leaves el where id = 1;'
                );
                echo "<div class='modal-image-container'>";
                foreach ($result as $blob) {
                    // Convert the binary data to a base64-encoded string
                    $base64Data = base64_encode($blob['attachment']);
                    // Create an img tag with the src set to a data URI that includes the base64-encoded data
                    echo "<img class='claim-view-images' src='data:image/jpeg;base64," .
                        base64_encode($blob['attachment']) .
                        "'  height='200px' width='200px' role='presentation'>";
                }
                echo '</div>';
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

</div>



<script>
    var btn = document.querySelectorAll("button.modal-button");

    // All page modals
    var modals = document.querySelectorAll('.modal');

    // Get the <span> element that closes the modal
    var spans = document.getElementsByClassName("close");

    // When the user clicks the button, open the modal
    for (var i = 0; i < btn.length; i++) {
        btn[i].onclick = function(e) {
            e.preventDefault();
            modal = document.querySelector(e.target.getAttribute("href"));
            modal.style.display = "block";
        }
    }

    // When the user clicks on <span> (x), close the modal
    for (var i = 0; i < spans.length; i++) {
        spans[i].onclick = function() {
            for (var index in modals) {
                if (typeof modals[index].style !== 'undefined') modals[index].style.display = "none";
            }
        }
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            for (var index in modals) {
                if (typeof modals[index].style !== 'undefined') modals[index].style.display = "none";
            }
        }
    }


    // document.forms['add-leave-form'].addEventListener('submit', function(event) {
    //     event.preventDefault(); // Prevent the form from submitting normally

    //     var element = document.getElementById("employee-data-btn");
    //     var employeeId = element.getAttribute("data-id");

    //     // Get the form data using FormData
    //     var form = event.target;
    //     var formData = new FormData(form);
    //     formData.append('employeeId', employeeId);

    //     // Send the form data using AJAX
    //     var xhr = new XMLHttpRequest();
    //     xhr.open('POST', 'submitLeaves');
    //     xhr.addEventListener('load', function() {
    //         if (xhr.status === 404) {
    //             // The page does not exist
    //             console.log('Page does not exist');
    //         } else {
    //             // The page exists  
    //             console.log('Page exists');
    //         }
    //     });
    //     xhr.send(formData);
    // });

    $('.open-add-leaves-modal').click(function(){
        let empId = $(this).attr('data-empid');
        $('.add-leave-empid').val(empId);
    });

</script>





<!-- 
            <script>

    function detailedExpenseInfo(expenseId, comment) {
      // Make an AJAX request to the PHP script to get the item data
      $.ajax({
        url: "getExpenseAttachment.php",
        type: "POST",
        data: {
          expenseId: expenseId,
          comment: comment
        },
        dataType: "text",
        success: function(data) {
          // Your code to view the item goes here, using the returned data
          console.log(data+'sfdasfsastassfsauhasihfdasidi');
          console.log("Success");
        },
        error: function(xhr, status, error) {
          // Handle errors
          console.log("Error: " + error );
        }
      });
    }
  </script> -->

</html>