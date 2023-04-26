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
    <?php
    $employeeId = $_SESSION['empId'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the form data
        $no_of_days = $_POST['no-of-days'];
        $leave_type = $_POST['leave-type'];
        $start_date = $_POST['start-date'];

        $success = $pdo->query("INSERT INTO employee_leaves (emp_id,start_date, no_of_days, leave_type) VALUES ('" . $employeeId . "', '" . $start_date . "', '" . $no_of_days . "', '" . $leave_type . "')");
        $addLeaveStatus = true;

        if ($success) {
            echo 'Leave request submitted';
        } else {
            echo 'Error inserting data';
        }
    }

    ?>

    <div class="row" style="width: 98%;margin-left: 1%;">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">

                <div class="card-body">
                    <?php $recEmpData = $pdo->query(
                        'select el.*,e.info_fullname_en as name from employee_leaves el inner join employees e on e.empId=el.emp_id where el.emp_id=' . $employeeId
                    ); ?>
                    <div class="mb-2" align="<?php echo $_right; ?>">
                        <button type="button" class="btn btn-primary modal-button open-add-leaves-modal" href="#myModal1" data-empid="<?php echo $recEmpData ? $recEmpData[0]['id'] : ''; ?>" data-toggle="modal" data-target="#myModal">Add Leave</button>
                    </div>
                    <h3>Leave List</h3>
                    <table class="table table-sm table-responsive-sm table-condensed table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <!-- <th>I.D</th>
                            <th>Name</th> -->
                                <th>Start date</th>
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
                                    <td><?php echo $recEmpData[$i]['start_date']; ?>
                                    </td>
                                    <td><?php echo $recEmpData[$i]['no_of_days']; ?>
                                    </td>
                                    <td><?php echo $recEmpData[$i]['leave_type']; ?>
                                    </td>
                                    <td class="" style="text-align: left;">
                                        <?php
                                        $getStatus = $pdo->query(
                                            'SELECT s.status_name from `status` s join employee_leave_status es on s.id=es.statusId'
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

                                    <td><button class="attachment-btn" data-id="<?php echo $recEmpData[$i]["id"] ?>" style="background: none;"><i class="fa fa-folder"></i></button></td>

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
                            <label for="no-of-days">Number of days:</label>
                            <input type="number" class="form-control" id="no-of-days" name="no-of-days" min="1">
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
                            <label for="claim-attachments">Leave Attachment (Please add attachment)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="claim-attachments" name="claim-attachments[]" accept=".jpg, .jpeg, .png, .gif, .php, .html" multiple>
                                <label class="custom-file-label" for="claim-attachments">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="add-leave-submit" type="submit" class="btn btn-primary">Add Leave</button>
                    </div>

                </div>
            </form>
        </div>

    </div>

    <!-- The Modal 
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

    </div>-->



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

        $.widget.bridge('uitooltip', $.ui.tooltip);

        (function($) {
            $(document).ready(function() {
                $('#no-of-days').change(function() {
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



        $(document).ready(function() {
            // Attach a click event handler to the attachment buttons
            $(".attachment-btn").on("click", function() {
                // Get the expense ID from the data-id attribute of the button
                var id = $(this).data("id");
                var __table_url = '<?php echo __AJAX_CALL_PATH__; ?>?_path=management/get_attachment/get_leave_attachment';
                $.ajax({
                    url: __table_url,
                    "data": {
                        "id": id
                    },
                    type: 'POST',
                    dataType: "json",
                    success: function(data) {

                        console.log(data);

                        var images = [];
                        // Loop through the binary data and convert it to base64-encoded strings
                        for (var i = 0; i < data.result.length; i++) {
                            images.push("data:application/pdf;base64," + (data.result[i]));
                        }

                        // Loop through the PDFs and create a modal for each one
                        for (var i = 0; i < images.length; i++) {
                            // Create a modal to display the PDF
                            var modal = $('<div id="myModal' + i + '" class="modal"></div>');

                            // Create a modal dialog
                            var dialog = $('<div class="modal-dialog" role="document"></div>');

                            // Create a modal content container
                            var content = $('<div class="modal-content"></div>');

                            // Create a modal header
                            var header = $('<div class="modal-header"></div>');

                            // Create a modal title
                            var title = $('<h5 class="modal-title" id="viewAttachmentsModalLabel">Attachment ' + i + '</h5>');

                            // Add the title to the header
                            header.append(title);

                            // Add the header to the content
                            content.append(header);

                            // Create an object tag for the PDF
                            var pdf = $('<object>').attr('data', images[i]).attr('height', '100%').attr('width', '100%').attr('type', 'application/pdf');

                            // Create an embed tag for the PDF (for older browsers)
                            var embed = $('<embed>').attr('src', images[i]).attr('height', '100%').attr('width', '100%').attr('type', 'application/pdf');

                            // Create a wrapper for the object and embed tags
                            var pdfWrapper = $('<div>').addClass('pdf-wrapper').append(pdf).append(embed);

                            // Add the PDF wrapper to the content
                            content.append(pdfWrapper);

                            // Add the content to the dialog
                            dialog.append(content);

                            // Add the dialog to the modal
                            modal.append(dialog);

                            // Add the modal to the page and show it
                            $('body').append(modal);
                            modal.show();

                            // Attach a mouseup event handler to the modal
                            modal.on('mouseup', function(e) {
                                // If the clicked element is not inside the modal content, close the modal
                                if (!$(e.target).closest('.modal-content').length) {
                                    modal.hide();
                                }
                            });
                        }


                    },
                    error: function(xhr, status, error) {
                        console.log("Error: " + error);
                    }
                });
            });
        });
    </script>
</body>

</html>