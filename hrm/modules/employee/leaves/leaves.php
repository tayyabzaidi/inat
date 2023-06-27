<!DOCTYPE html>
<html lang="<?php echo $lang_code; ?>" dir="<?php echo $page_direction; ?>">

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Load jQuery UI library -->
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css">

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
            margin-top: 5%;
            margin-bottom: 10%;
            padding: 20px;
            border: 1px solid #888;
            width: 60%;
            height: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .leave-card .days-available {
            font-size: 12px;
            margin-top: 2%;
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

        .test {
            position: relative;
            height: auto;
            margin-right: 0;
            margin-left: 0;
            zoom: 1;
            display: flex;
            flex-direction: row;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            gap: 24px;
            width: 98%;
            margin-right: 1%;
            justify-content: flex-end;
        }
    </style>
</head>

<body>
    <?php
    $employeeId = $_SESSION['empId'];
    $recEmpData = $pdo->query(
        'select el.*,e.info_fullname_en as name from employee_leaves el inner join employees e on e.empId=el.emp_id where el.emp_id=' . $employeeId
    ); ?>
    <div class="test">
        <div style=" width:13%;   padding-left: 7px;
    padding-right: 7px;
    border: 2px solid rgba(235, 152, 23, 0.7);
    margin-left: 1%;">
            <div class="ant-card-body">
                <h4 class="heading">Sick Leaves</h4>
                <span class="icon" style="display: block; width: 100%;">
                    <span>Available Days: -</span>
                    <br>
                    <?php
                    $leaves = $pdo->query("SELECT count(id) as leaves_taken from employee_leaves WHERE emp_id=" . $employeeId . " AND leave_type = 'Sick Leave'")
                        ?>
                    <span>Utilized Days: <?php echo $leaves[0]['leaves_taken'] ?></span>
                </span>
                <div>
                </div>
            </div>
        </div>
        <?php $available_leaves = $_SESSION['available_leaves']; ?>
        <div style="width:13%; padding-left: 7px; padding-right: 7px; border: 2px solid rgba(235, 152, 23, 0.7);">
            <div class="ant-card-body">
                <h4 class="heading">Annual Leaves</h4>
                <span class="icon" style="display: block; width: 100%;">
                    <?php $annual_leaves = $pdo->query("SELECT count(id) as leaves_taken from employee_leaves WHERE emp_id=" . $employeeId . " AND leave_type = 'Annual Leave'"); ?>
                    <span>Available Days:
                        <?php $days_available = -$annual_leaves[0]['leaves_taken'] + $available_leaves;
                        echo $days_available ?></span>
                    <br>
                    <span>Utilized Days: <?php echo $annual_leaves[0]['leaves_taken'] ?></span>
                </span>
                <div>
                </div>
            </div>
        </div>
    </div>
    <hr style="width: 96%;">
    <div class="row" style="width: 98%; margin-left: 1%;">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="mb-2" align="<?php echo $_right; ?>">
                        <?php
                        $policy = $pdo->query("SELECT policy from leave_policy");
                        $pdf_policy = base64_encode($policy[0]['policy']);
                        ?>
                        <button class="btn btn-primary" data-pdf="<?php echo $pdf_policy ?>"
                            onclick="showPdfModal(this)">Leave Policy</button>
                        <button type="button" class="btn btn-primary modal-button" href="#myModal1"
                            data-empid="<?php echo $recEmpData ? $recEmpData[0]['id'] : ''; ?>" data-toggle="modal"
                            data-target="#myModal">Add Leave</button>
                    </div>
                    <h3>Leave List</h3>
                    <table class="table table-sm table-responsive-sm table-condensed table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Start Date</th>
                                <th>No. of Days</th>
                                <th>Leave Type</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($recEmpData); $i++) { ?>
                                <tr>
                                    <td><?php echo $recEmpData[$i]['start_date']; ?></td>
                                    <td><?php echo $recEmpData[$i]['no_of_days']; ?></td>
                                    <td><?php echo $recEmpData[$i]['leave_type']; ?></td>
                                    <td class="" style="text-align: left;">
                                        <?php
                                        $getStatus = $pdo->query('SELECT s.status_name from `status` s join employee_leave_status es on s.id=es.statusId where leaveId = ' . $recEmpData[$i]['id'] . ';');
                                        $HOD = false;
                                        $OM = false;
                                        $HR = false;
                                        for ($j = 0; $j < count($getStatus); $j++) {
                                            if ($getStatus[$j]['status_name'] == 'HOD_approved') {
                                                $HOD = 'approved';
                                            } elseif ($getStatus[$j]['status_name'] == 'OM_approved') {
                                                $OM = 'approved';
                                            } elseif ($getStatus[$j]['status_name'] == 'OM_disapproved') {
                                                $OM = 'disapprove';
                                            } elseif ($getStatus[$j]['status_name'] == 'HOD_disapproved') {
                                                $HOD = 'disapprove';
                                            } elseif ($getStatus[$j]['status_name'] == 'HR_approved') {
                                                $HR = 'approve';
                                            } elseif ($getStatus[$j]['status_name'] == 'HR_disapproved') {
                                                $HR = 'disapprove';
                                            }
                                        }
                                        ?>
                                        <div class="ant-tag" style="<?php if ($HOD == 'approved') {
                                            echo 'background-color: rgb(135, 208, 104)';
                                        } elseif ($HOD == 'disapprove') {
                                            echo 'background-color: red;';
                                        } else {
                                            echo 'background-color: white';
                                        } ?>">
                                            Department Manager</div>
                                        <div class="ant-tag" style="<?php if ($OM == 'approved') {
                                            echo 'background-color: rgb(135, 208, 104)';
                                        } elseif ($OM == 'disapprove') {
                                            echo 'background-color: red;';
                                        } else {
                                            echo 'background-color: white';
                                        } ?>">
                                            Operations Manager</div>
                                        <div class="ant-tag" style="<?php if ($HR == 'approved') {
                                            echo 'background-color: rgb(135, 208, 104)';
                                        } elseif ($HR == 'disapprove') {
                                            echo 'background-color: red;';
                                        } else {
                                            echo 'background-color: white';
                                        } ?>">
                                            HR Manager</div>
                                    </td> <?php
                                    $clearnace_attachment_found = false;
                                    $result = $pdo->query("SELECT true as 'ex' from attachment where foreignId=" . $recEmpData[$i]["id"]);
                                    if ($result[0]['ex'] == true)
                                        $clearnace_attachment_found = true;

                                    if ($clearnace_attachment_found) {

                                        ?>
                                        </td>

                                        <?php
                                    } else if (
                                        $HOD == 'approved'
                                    ) {

                                        ?>

                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-primary modal-button open-add-clearance-modal"
                                                    href="#myModal3"
                                                    data-leaveid="<?php echo $recEmpData ? $recEmpData[0]['id'] : ''; ?>"
                                                    data-toggle="modal" data-target="#myModal">Add Clearance Form</button>

                                            </td>

                                        <?php
                                    }
                                    ?>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal-dialog" role="document">
        <form name="add-leave-formx" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addClaimModalLabel">Add Leave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="start-date">Start Date:</label>
                        <input type="text" class="form-control" id="start-date" name="start-date">
                    </div>

                    <div class="form-group">
                        <label for="no-of-days">Number of Days:</label>
                        <input type="number" class="form-control" id="no-of-days" name="no-of-days" min="1"
                            max="<?php echo $days_available ?>">
                    </div>

                    <div class="form-group">
                        <label for="leave-type">Leave Type:</label>
                        <select class="form-control" id="leave-type" name="leave-type">
                            <?php
                            $result = $pdo->query(
                                'SELECT * FROM request_types where type="leave"'
                            );
                            foreach ($result as $row) {
                                echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                            }

                            ?>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="leave-attachments">PDF File (Please submit leave request in PDF format)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="leave-attachments" name="leave-attachments"
                                accept=".pdf">
                            <label class="custom-file-label" for="leave-attachments">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="add-leave-submit" name="add_leave_submit" type="submit" class="btn btn-primary">Add
                        Leave</button>
                </div>

            </div>
        </form>
    </div>

    </div>
    <div class="modal-dialog" role="document">
        <form name="clearance-add-leave-formx" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="clearance-label">Add Remaining Forms</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="claim-attachments">Attachments (Please add attachments like vehicle clearance
                            forms)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="claim-attachments"
                                name="claim-attachments[]" accept=".pdf" multiple>
                            <label class="custom-file-label" for="claim-attachments">Choose file</label>
                        </div>
                        <input type="text" id="leaveId" name="leaveId">
                    </div>

                </div>

                <div class="modal-footer">
                    <button id="add-clearance-leave-submit" name="add_clearance_form_submit" type="submit"
                        class="btn btn-primary">Save</button>
                </div>

            </div>
        </form>
    </div>

    </div>



    <div id="myModal3" class="modal">

        <div class="modal-dialog" role="document">
            <form name="clearance-add-leave-formx" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="clearance-label">Add Remaining Forms</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="claim-attachments">Attachments (Please add attachments like vehicle declaration
                                forms)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="claim-attachments"
                                    name="claim-attachments[]" accept=".pdf" multiple>
                                <label class="custom-file-label" for="claim-attachments">Choose file</label>
                            </div>
                            <input type="text" id="leaveId" name="leaveId">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button id="add-clearance-leave-submit" name="add_clearance_form_submit" type="submit"
                            class="btn btn-primary">Save</button>
                    </div>

                </div>
            </form>
        </div>

    </div>


    <script>

        $(document).on("click", ".open-add-clearance-modal", function () {
            var leaveId = $(this).data('leaveid');
            $('#leaveId').val(leaveId);
        });
        var btn = document.querySelectorAll("button.modal-button");

        // All page modals
        var modals = document.querySelectorAll('.modal');

        // Get the <span> element that closes the modal
        var spans = document.getElementsByClassName("close");

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

        $.widget.bridge('uitooltip', $.ui.tooltip);

        (function ($) {
            $(document).ready(function () {
                $('#no-of-days').change(function () {
                    var days = $(this).val();
                    var startDate = new Date();
                    startDate.setDate(startDate.getDate() + parseInt(days));
                    $('#start-date').val(startDate.toISOString().substr(0, 10));
                });

                $.widget.bridge('uitooltip', $.ui.tooltip);
                $('#start-date').datepicker({
                    dateFormat: 'yy-mm-dd',
                    minDate: 0
                });
            });
        })(jQuery);




    </script>
</body>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['add_clearance_form_submit'])) {
        $attachments = $_FILES['claim-attachments'];
        $leaveId = $_POST['leaveId'];
        // Loop through all the uploaded files
        for ($i = 0; $i < count($attachments['name']); $i++) {
            $attachment_name = $attachments['name'][$i];
            $attachment_tmp_name = $attachments['tmp_name'][$i];
            $attachment_size = $attachments['size'][$i];
            $attachment_type = $attachments['type'][$i];

            // Read the file contents into a variable
            $attachment_data = file_get_contents($attachment_tmp_name);

            $pdf_hex = bin2hex($attachment_data);
            $pdf_hex = '0x' . $pdf_hex;
            $pdo->bind("leaveId", $leaveId);
            // $pdo->bind("pdf", $pdf_hex);
            $attachment = $pdo->query("INSERT INTO attachment( attachment, foreignId,`type`) VALUES (" . $pdf_hex . ",:leaveId,'leave')");
        }
    } else if (isset($_POST['add_leave_submit'])) {
        // Get the form data
        $no_of_days = $_POST['no-of-days'];
        $leave_type = $_POST['leave-type'];
        $start_date = $_POST['start-date'];
        echo $start_date;
        $pdf = file_get_contents($_FILES['leave-attachments']['tmp_name']);
        $pdf_hex = bin2hex($pdf);
        $pdf_hex = '0x' . $pdf_hex;

        $success = $pdo->query("INSERT INTO employee_leaves (emp_id,start_date, no_of_days, leave_type, attachment,leaves_taken) VALUES ('" . $employeeId . "', '" . $start_date . "', '" . $no_of_days . "', '" . $leave_type . "', " . $pdf_hex . ")");
        $addLeaveStatus = true;

        if ($success) {
            echo 'Leave request submitted';
        } else {
            echo 'Error inserting data';
        }
    }
    echo "<meta http-equiv='refresh' content='0'>";
}

?>

</html>
<script>function showPdfModal(button) {
        const pdfBase64 = button.dataset.pdf;
        if (pdfBase64 == '')
            alert('There is no salary slip');
        else {
            const modal = document.createElement('div');
            modal.className = 'modal';
            const modalContent = document.createElement('div');
            modalContent.className = 'modal-content';

            const embedElement = document.createElement('embed');
            embedElement.type = 'application/pdf';
            embedElement.width = '100%';
            embedElement.height = '100%';
            embedElement.src = 'data:application/pdf;base64,' + pdfBase64;

            modalContent.appendChild(embedElement);
            modal.appendChild(modalContent);
            document.body.appendChild(modal);
            modal.style.display = 'block';
            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            })
        }
    }
</script>