<!DOCTYPE html>
<html lang="<?php echo $lang_code; ?>">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

        form {
            float: right;
            margin-right: 20px;
            margin-bottom: 10px;
        }

        .form-container {
            float: right;
            width: 50%;
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


                <h3>Encashment List</h3>

                <div class="form-container">
                    <form action="#" method="POST">
                        <label for="dateFrom">Date From:</label>
                        <input type="date" id="dateFrom" name="dateFrom">
                        <label for="dateTo">Date To:</label>
                        <input type="date" id="dateTo" name="dateTo">
                        <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-filter"></i>
                            Date</button>
                    </form>

                    <form action="#" method="POST">
                        <label for="employeeId">Employee:</label>
                        <input type="text" id="employee" name="employee">
                        <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-filter"></i>
                            Employee</button>
                    </form>
                </div>
                <table class="table table-sm table-responsive-sm table-condensed table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>I.D</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Attachment</th>
                            <th>Approve</th>
                            <th>Disapprove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php


                        $dateFrom = isset($_POST['dateFrom']) ? $_POST['dateFrom'] : null;
                        $dateTo = isset($_POST['dateTo']) ? $_POST['dateTo'] : null;
                        $employee = isset($_POST['employee']) ? $_POST['employee'] : null;

                        $sql = 'SELECT ee.*,e.info_fullname_en as `name` FROM employee_encashments ee join employees e on e.empId=ee.employee_id';

                        if (!empty($dateFrom) && !empty($dateTo)) {
                            // User has provided both date filters
                            $sql .= " WHERE ee.date BETWEEN '$dateFrom' AND '$dateTo' ORDER BY ee.`date`;";
                        } else if (!empty($employee)) {
                            $sql .= " AND e.info_fullname_en like '%" . $employee . "%'  ORDER BY ee.date;";
                        } else
                            $sql .= " ORDER BY ee.`date`;";


                        $recEmpData = $pdo->query(
                            $sql
                        );

                        ?>
                        <?php for ($i = 0; $i < count($recEmpData); $i++) { ?>
                            <tr>
                                <td><?php echo $recEmpData[$i]['unique_id']; ?>
                                </td>
                                <td><?php echo $recEmpData[$i]['date']; ?>
                                </td>
                                <td><?php echo $recEmpData[$i]['name']; ?>
                                </td>

                                <td><button class="attachment-btn" data-id="<?php echo $recEmpData[$i]["id"] ?>"
                                        style="background: none;"><i class="fa fa-folder"></i></button></td>

                                </td>

                                <td>
                                    <form action="#" method="POST" id="myForm">
                                        <!-- other form inputs -->
                                        <label>
                                            <input type="checkbox" name="status" value="approve"
                                                onchange="this.form.submit();" <?php
                                                $pdo->bind('employeeId', $_SESSION['empId']);
                                                $pdo->bind('encashmentId', $recEmpData[$i]['id']);
                                                $s = $pdo->query('select "approve" as `status` from status s join employee_encashment_status ees join employees e on s.id=ees.statusId and s.designation_id=e.desigId where e.empId=:employeeId and ees.encashmentId=:encashmentId
                                                and s.status_name not like "%disapproved";');
                                                if ($s[0]['status'] == 'approve')
                                                    echo "checked"; ?>>
                                        </label>
                                        <input type="hidden" name="encashmentId"
                                            value="<?php echo $recEmpData[$i]['id']; ?>">
                                        <input type="hidden" name="action" value="update">
                                        <button type="submit" style="display:none;"></button>
                                    </form>
                                </td>
                                <td>
                                    <?php
                                    // retrieve the status of the checkbox from the server
                                    $pdo->bind('employeeId', $_SESSION['empId']);
                                    $pdo->bind('encashmentId', $recEmpData[$i]['id']);
                                    $s = $pdo->query('select "disapprove" as `status` from status s join employee_encashment_status ees join employees e on s.id=ees.statusId and s.designation_id=e.desigId where e.empId=:employeeId and ees.encashmentId=:encashmentId and s.status_name like "%disapproved";');
                                    $isChecked = $s[0]['status'] == "disapprove";
                                    ?>
                                    <form action="#" method="POST" id="myForm">
                                        <!-- other form inputs -->
                                        <label>
                                            <input type="checkbox" name="status" value="disapprove"
                                                onchange="this.form.submit();" <?php if ($isChecked) {
                                                    echo "checked";
                                                } ?>>
                                        </label>
                                        <input type="hidden" name="encashmentId"
                                            value="<?php echo $recEmpData[$i]['id']; ?>">
                                        <button type="submit" style="display:none;"></button>
                                    </form>

                                    <!-- save the staus hod or am approve base on the user id -->
                                    <?php
                        } ?>
                            </td>
                        </tr>

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['status'];
    $encashmentId = $_POST['encashmentId'];
    $pdo->bind('employeeId', $_SESSION['empId']);
    $getDesignation = $pdo->query('SELECT d.name from employee_designations d join employees e on e.desigId=d.desigId where e.empId=:employeeId and d.name in ("DEPARTMENT HEAD","HR MANAGER")');

    if (!empty($getDesignation)) {
        if ($status == "approve") {
            $setStatus = 0;
            if ($getDesignation[0]['name'] == 'DEPARTMENT HEAD') {
                $getStatus = $pdo->query("select id from status where status_name like ('HOD_a%');");
                $setStatus = $getStatus[0]['id'];
            }

            if ($getDesignation[0]['name'] == 'HR MANAGER') {
                $getStatus = $pdo->query("select id from status where status_name like ('HR_a%');");
                if (!empty($getStatus)) {
                    $setStatus = $getStatus[0]['id'];
                }
            }
        }
        if ($status == "disapprove") {
            $setStatus = 0;
            if ($getDesignation[0]['name'] == 'DEPARTMENT HEAD') {
                $getStatus = $pdo->query("select id from status where status_name like ('HOD_d%');");
                if (!empty($getStatus))
                    $setStatus = $getStatus[0]['id'];
            }

            if ($getDesignation[0]['name'] == 'HR MANAGER') {
                $getStatus = $pdo->query("select id from status where status_name like ('HR_d%');");
                if (!empty($getStatus))
                    $setStatus = $getStatus[0]['id'];
            }
        }
        if ($setStatus != 0) {
            $pdo->bind("id", $setStatus);
            $pdo->bind("encashmentId", $encashmentId);
            //issue---------------------------------------------------------------------------------------------------------------
            $result = $pdo->query("INSERT INTO employee_encashment_status  (statusId , encashmentId) values (:id,:encashmentId)");
            echo "<meta http-equiv='refresh' content='0'>";

        }
    }
}

?>
<script>
    document.getElementById('myForm').addEventListener('submit', function (event) {
        event.preventDefault();
        var checkbox = document.getElementsByName('status')[0];
        checkbox.checked = !checkbox.checked;
        checkbox.dispatchEvent(new Event('change'));
        event.target.submit();
    });
    $(document).ready(function () {
        // Attach a click event handler to the attachment buttons
        $(".attachment-btn").on("click", function () {
            // Get the expense ID from the data-id attribute of the button
            var encashmentId = $(this).data("id");
            var __table_url = '<?php echo __AJAX_CALL_PATH__; ?>?_path=management/expense/get_attachment/get_attachment';
            $.ajax({
                url: __table_url,
                "data": {
                    "foreignId": encashmentId,
                    "type": "encashment"
                },
                type: 'POST',
                dataType: "json",
                success: function (data) {
                    var images = [];
                    if (data.result === null) {
                        // Display an alert message if there are no attachments
                        alert("There are no attachments.");
                        return;
                    }
                    // Loop through the binary data and convert it to base64-encoded strings
                    for (var i = 0; i < data.result.length; i++) {
                        images.push("data:image/jpeg;base64," + (data.result[i]));
                        console.log(images[i]);
                    }
                    // Create a modal to display the images
                    var modal = $('<div id="myModal2" class="modal"></div>');

                    // Create a modal dialog
                    var dialog = $('<div class="modal-dialog" role="document"></div>');

                    // Create a modal content container
                    var content = $('<div class="modal-content"></div>');

                    // Create a modal header
                    var header = $('<div class="modal-header"></div>');

                    // Create a modal title
                    var title = $('<h5 class="modal-title" id="viewAttachmentsModalLabel">Attachments</h5>');

                    // Add the title to the header
                    header.append(title);

                    // Add the header to the content
                    content.append(header);
                    var body = $('<div class="modal-body"></div>');

                    // Create a container for the images
                    var imageContainer = $('<div class="modal-image-container"></div>');

                    // Loop through the images and create image tags
                    for (var i = 0; i < images.length; i++) {
                        var img = $('<img>').attr('src', images[i]).attr('height', 200).attr('width', 200).css('margin-right', '15px');
                        imageContainer.append(img);
                    }

                    // Add the image container to the body
                    body.append(imageContainer);

                    // Add the body to the content
                    content.append(body);

                    // Add the content to the dialog
                    dialog.append(content);

                    // Add the dialog to the modal
                    modal.append(dialog);

                    // Add the modal to the page and show it
                    $('body').append(modal);
                    modal.show();

                    // Attach a mouseup event handler to the modal
                    modal.on('mouseup', function (e) {
                        // If the clicked element is not inside the modal content, close the modal
                        if (!$(e.target).closest('.modal-content').length) {
                            modal.hide();
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.log("Error: " + error);
                }
            });
        });
    });

</script>

</html>