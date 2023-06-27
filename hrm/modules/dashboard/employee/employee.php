<!DOCTYPE html>
<html lang="<?php echo $lang_code; ?>" dir="<?php echo $page_direction; ?>">

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
            height: 120%;
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
<div class="row" style="width: 98%;margin-left: 1%;">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">

            <div class="card-body">
                <h3>Claims List</h3>
                <table class="table table-sm table-responsive-sm table-condensed table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Number</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $employeeId = $_SESSION['empId'];
                        $pdo->bind('employeeId', $employeeId);
                        $recEmpData = $pdo->query(
                            'SELECT ee.*,e.info_fullname_ar as `name` FROM employee_expenses ee join employees e on e.empId=ee.employee_id WHERE `employee_id`=:employeeId ORDER BY `date` LIMIT 5;'
                        );
                        ?>
                        <?php for ($i = 0; $i < count($recEmpData); $i++) { ?>
                            <tr>
                                <td><?php echo $recEmpData[$i]['unique_id']; ?>
                                </td>
                                <td><?php echo $recEmpData[$i]['date']; ?>
                                </td>
                                <td class="" style="text-align: left;">
                                    <?php
                                    $pdo->bind('expenseId', $recEmpData[$i]['id']);
                                    $getStatus = $pdo->query(
                                        'SELECT s.status_name from `status` s join employee_expense_status es on s.id=es.statusId where es.expenseId=:expenseId;'
                                    );
                                    $HOD = false;
                                    $AM = false;
                                    for ($j = 0; $j < count($getStatus); $j++) {
                                        if ($getStatus[$j]['status_name'] == 'HOD_approved') {
                                            $HOD = 'Approved';
                                        } elseif ($getStatus[$j]['status_name'] == 'AM_approved') {
                                            $AM = 'Approved';
                                        } elseif ($getStatus[$j]['status_name'] == 'AM_disapproved') {
                                            $AM = 'Rejected';
                                        } elseif ($getStatus[$j]['status_name'] == 'HOD_disapproved') {
                                            $HOD = 'Rejected';
                                        }
                                    }
                                    ?><div class="ant-tag " style="<?php if ($HOD == 'Approved') {
                                        echo 'background-color: rgb(135, 208, 104)';
                                    } elseif ($HOD == 'Rejected') {
                                        echo 'background-color: red;';
                                    } else {
                                        echo 'background-color: white';
                                    } ?>">
                                        HOD</div>
                                    <div class="ant-tag " style="<?php if ($AM == 'Approved') {
                                        echo 'background-color: rgb(135, 208, 104)';
                                    } elseif ($AM == 'Rejected') {
                                        echo 'background-color: red;';
                                    } else {
                                        echo 'background-color: white';
                                    } ?>">
                                        AM</div>
                                </td>
                                <td> <?php echo $recEmpData[$i]['total_amount']; ?>
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
<script>
    var btn = document.querySelectorAll("button.modal-button");

    // All page modals
    var modals = document.querySelectorAll('.modal');

    // Get the <span> element that closes the modal
    var spans = document.getElementsByClassName("btn btn-secondary");
    // When the user clicks the button, open the modal
    for (var i = 0; i < btn.length; i++) {
        btn[i].onclick = function (e) {
            e.preventDefault();
            modal = document.querySelector(e.target.getAttribute("href"));
            modal.style.display = "block";
        }
    }

    // When the user clicks on <span> (x), close the modal
    for (var i = 0; i < spans.length; i++) {
        spans[i].onclick = function () {
            for (var index in modals) {
                if (typeof modals[index].style !== 'undefined') modals[index].style.display = "none";
            }
        }
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target.classList.contains('modal')) {
            for (var index in modals) {
                if (typeof modals[index].style !== 'undefined') modals[index].style.display = "none";
            }
        }
    }
</script>

<?php

$employeeId = $_SESSION['empId'];

?>


<div class="row" style="width: 98%;margin-left: 1%;">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">

            <div class="card-body">


                <div class="card-body">
                    <?php $recEmpData = $pdo->query(
                        'select el.*,e.info_fullname_en as name from employee_leaves el inner join employees e on e.empId=el.emp_id where e.empId = ' . $employeeId . ' order by id desc limit 5'
                    );
                    ?>
                    <h3>Leaves List</h3>
                    <hr>
                    <div class="mb-2" align="<?php echo $_right; ?>">
                        <a href="<?php echo __APP_URL__ . 'employee/leaves'; ?>" class="btn btn-md btn-primary"> <i
                                class="fa fa-1x fa-users"></i> Manage Leave Requests</a>
                    </div>
                    <table class="table table-sm table-responsive-sm table-condensed table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Number of Days</th>
                                <th>Leave Type</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody><?php for ($i = 0; $i < count($recEmpData); $i++) { ?>
                                <tr>
                                    <!-- <td><?php echo $recEmpData[$i]['id']; ?>
                                </td>-->
                                    <!--   <td><?php echo $recEmpData[$i]['name']; ?>
                                </td>-->
                                    <td><?php echo $recEmpData[$i]['no_of_days']; ?>
                                    </td>
                                    <td><?php echo $recEmpData[$i]['leave_type']; ?>
                                    </td>
                                    <td class="" style="text-align: left;">
                                        <?php
                                        $getStatus = $pdo->query(
                                            'SELECT s.status_name from `status` s join employee_leave_status es on s.id=es.statusId where es.leaveId=' . $recEmpData[$i]['id']
                                        );
                                        $HOD = false;
                                        $HR = false;
                                        $OM = false;
                                        for ($j = 0; $j < count($getStatus); $j++) {
                                            if ($getStatus[$j]['status_name'] == 'HOD_approved') {
                                                $HOD = 'Approved';
                                            } elseif ($getStatus[$j]['status_name'] == 'HOD_disapproved') {
                                                $HOD = 'Rejected';
                                            } elseif ($getStatus[$j]['status_name'] == 'HR_approved') {
                                                $HR = 'Approved';
                                            } elseif ($getStatus[$j]['status_name'] == 'HR_disapproved') {
                                                $HR = 'Rejected';
                                            } elseif ($getStatus[$j]['status_name'] == 'OM_approved') {
                                                $OM = 'Approved';
                                            } elseif ($getStatus[$j]['status_name'] == 'OM_disapproved') {
                                                $OM = 'Rejected';
                                            }
                                        }
                                        ?>

                                        <div class="ant-tag " style="<?php if ($HOD == 'Approved') {
                                            echo 'background-color: rgb(135, 208, 104); color:white';
                                        } elseif ($HOD == 'Rejected') {
                                            echo 'background-color: red; color:white';
                                        } else {
                                            echo 'background-color: white';
                                        } ?>">
                                            HOD</div>

                                        <div class="ant-tag " style="<?php if ($HR == 'Approved') {
                                            echo 'background-color: rgb(135, 208, 104); color:white';
                                        } elseif ($HR == 'Rejected') {
                                            echo 'background-color: red; color:white';
                                        } else {
                                            echo 'background-color: white';
                                        } ?>">
                                            HR</div>

                                        <div class="ant-tag " style="<?php if ($OM == 'Approved') {
                                            echo 'background-color: rgb(135, 208, 104); color:white';
                                        } elseif ($OM == 'Rejected') {
                                            echo 'background-color: red; color:white';
                                        } else {
                                            echo 'background-color: white';
                                        } ?>">
                                            OM</div>
                                    </td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


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