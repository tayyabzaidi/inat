<!DOCTYPE html>
<html lang="<?php echo $lang_code; ?>" dir="<?php echo $page_direction; ?>">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Load jQuery UI library -->
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css">



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

<body>


    <div class="row" style="width: 98%;margin-left: 1%;">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">

                <div class="card-body">
                    <?php $recEmpData = $pdo->query(
                        'select el.*,e.info_fullname_en as name from employee_leaves el inner join employees e on e.empId=el.emp_id order by id desc limit 5'
                    );
                    ?>
                    <h3>Leave List</h3>

                    <table class="table table-sm table-responsive-sm table-condensed table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <!-- <th>I.D</th>-->
                                <th>Name</th>
                                <th>No of days</th>
                                <th>Leave type</th>
                                <th>Status</th>
                                <th>PDF</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php for ($i = 0; $i < count($recEmpData); $i++) { ?>
                                <tr>
                                    <!-- <td><?php echo $recEmpData[$i]['id']; ?>
                                    </td>-->
                                    <td><?php echo $recEmpData[$i]['name']; ?>
                                    </td>
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
                                            if (
                                                $getStatus[$j]['status_name'] ==
                                                'HOD_approved'
                                            ) {
                                                $HOD = 'approved';
                                            } elseif (
                                                $getStatus[$j]['status_name'] ==
                                                'HOD_disapproved'
                                            ) {
                                                $HOD = 'disapprove';
                                            } elseif (
                                                $getStatus[$j]['status_name'] ==
                                                'HR_approved'
                                            ) {
                                                $HR = 'approved';
                                            } elseif (
                                                $getStatus[$j]['status_name'] ==
                                                'HR_disapproved'
                                            ) {
                                                $HR = 'disapprove';
                                            } elseif (
                                                $getStatus[$j]['status_name'] ==
                                                'OM_approved'
                                            ) {
                                                $OM = 'approved';
                                            } elseif (
                                                $getStatus[$j]['status_name'] ==
                                                'OM_disapproved'
                                            ) {
                                                $OM = 'disapprove';
                                            }
                                        }
                                        ?>

                                        <div class="ant-tag " style="<?php if (
                                                                            $HOD == 'approved'
                                                                        ) {
                                                                            echo 'background-color: rgb(135, 208, 104); color:white';
                                                                        } elseif ($HOD == 'disapprove') {
                                                                            echo 'background-color: red; color:white';
                                                                        } else {
                                                                            echo 'background-color: white';
                                                                        } ?>">
                                            HOD</div>

                                        <div class="ant-tag " style="<?php if (
                                                                            $HR == 'approved'
                                                                        ) {
                                                                            echo 'background-color: rgb(135, 208, 104); color:white';
                                                                        } elseif ($HR == 'disapprove') {
                                                                            echo 'background-color: red; color:white';
                                                                        } else {
                                                                            echo 'background-color: white';
                                                                        } ?>">
                                            HR</div>
                                        <div class="ant-tag " style="<?php if (
                                                                            $OM == 'approved'
                                                                        ) {
                                                                            echo 'background-color: rgb(135, 208, 104); color:white';
                                                                        } elseif ($OM == 'disapprove') {
                                                                            echo 'background-color: red; color:white';
                                                                        } else {
                                                                            echo 'background-color: white';
                                                                        } ?>">
                                            OM</div>
                                    </td>

                                    <td>
                                        <button class="modal-button" id="employee-data-btn" href="#myModal2" style="background: none;" data-id="<?php echo $recEmpData[$i]['id']; ?>"><i class="fa fa-folder"></i></button>
                                    </td>
                                    <td>
                                        <button class="modal-button approve-disapprove-btn" id="<?php echo $recEmpData[$i]['id']; ?>" href="#myModal1" style="background: none;" data-id="<?php echo $recEmpData[$i]['id']; ?>">Approve/Disapprove</button>
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


    <!-- The Modal -->
    <div id="myModal1" class="modal">

        <div class="modal-dialog" role="document">
            <form name="approve-dispprove-leave" method="post" action="approve-disapprove-leave">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addClaimModalLabel">Approve/Dispprove Leave</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input style="display: none" type="text" name="leaveStatusId" id="leaveStatusId">

                        <div class=" form-group">
                            <label for="comments">Comments:</label>
                            <input type="text" class="form-control" name="comments" id="comments">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="approve" id="approve">Approve</button>
                        <button type="submit" class="btn btn-danger" id="disapprove">Disapprove</button>

                    </div>

                </div>
            </form>
        </div>

    </div>


    <script>
        // JavaScript code here
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

        $('.approve-disapprove-btn').click(function() {
            var leaveStatusId = $(this).data('id');
            $('#leaveStatusId').val(leaveStatusId);
        });
    </script>
</body>

</html>