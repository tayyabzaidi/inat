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
            height: 140%;
            max-width: 100%;
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


                <h3>Visa List</h3>

                <table class="table table-sm table-responsive-sm table-condensed table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>I.D</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Attachment</th>
                            <?php if ($_SESSION['designation'] == 'DEPARTMENT HEAD') { ?>
                                <th>Approve</th>
                                <th>Disapprove</th>
                            <?php } ?>
                            <?php if ($_SESSION['designation'] == 'HR MANAGER') { ?>
                                <th></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $sql = 'SELECT ee.*,e.info_fullname_en as `name` FROM visa ee join employees e on e.empId=ee.employeeId';


                        $sql .= " ORDER BY ee.`date`;";


                        $recEmpData = $pdo->query(
                            $sql
                        );

                        ?>
                        <?php for ($i = 0; $i < count($recEmpData); $i++) { ?>
                            <tr>
                                <td><?php echo $recEmpData[$i]['id']; ?>
                                </td>
                                <td><?php echo $recEmpData[$i]['date']; ?>
                                </td>
                                <td><?php echo $recEmpData[$i]['name']; ?>
                                </td>
                                <td class="" style="text-align: left;">
                                    <?php
                                    $pdo->bind('visaId', $recEmpData[$i]['id']);
                                    $getStatus = $pdo->query(
                                        'SELECT s.status_name from `status` s join visa_status es on s.id=es.statusId where es.visaId=:visaId;'
                                    );
                                    $HOD = '';
                                    $HR = '';

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

                                </td>
                                <!-- <td><button data-expenseId=<?php echo $recEmpData[$i]["id"] ?> class="modal-button"
                                        href="#myModal2" style="background: none;"><i class="fa fa-folder"></i></button>
                                </td> -->
                                <td><button class="attachment-btn" data-id="<?php echo $recEmpData[$i]["id"] ?>"
                                        style="background: none;"><i class="fa fa-folder"></i></button></td>


                                <?php if ($_SESSION['designation'] == 'DEPARTMENT HEAD') { ?>
                                    <td>

                                        <form action="#" method="POST" id="myForm">
                                            <!-- other form inputs -->
                                            <label>
                                                <input type="checkbox" name="status" value="approve"
                                                    onchange="this.form.submit();" <?php
                                                    $pdo->bind('employeeId', $_SESSION['empId']);
                                                    $pdo->bind('visaId', $recEmpData[$i]['id']);
                                                    $s = $pdo->query('select "approve" as `status` from status s join visa_status ees join employees e on s.id=ees.statusId and s.designation_id=e.desigId where e.empId=:employeeId and ees.visaId=:visaId
                                                and s.status_name not like "%disapproved";');
                                                    if ($s[0]['status'] == 'approve')
                                                        echo "checked"; ?>>
                                            </label>
                                            <input type="hidden" name="visaId" value="<?php echo $recEmpData[$i]['id']; ?>">
                                            <input type="hidden" name="action" value="update">
                                            <button type="submit" style="display:none;"></button>
                                        </form>
                                    </td>
                                    <td>
                                        <?php
                                        // retrieve the status of the checkbox from the server
                                        $pdo->bind('employeeId', $_SESSION['empId']);
                                        $pdo->bind('visaId', $recEmpData[$i]['id']);
                                        $s = $pdo->query('select "disapprove" as `status` from status s join visa_status ees join employees e on s.id=ees.statusId and s.designation_id=e.desigId where e.empId=:employeeId and ees.visaId=:visaId and s.status_name like "%disapproved";');
                                        $isChecked = $s[0]['status'] == "disapprove";

                                        echo $isChecked; ?>
                                        <form action="#" method="POST" id="myForm">
                                            <!-- other form inputs -->
                                            <label>
                                                <input type="checkbox" name="status" value="disapprove"
                                                    onchange="this.form.submit();" <?php if ($isChecked) {
                                                        echo "checked";
                                                    } ?>>
                                            </label>
                                            <input type="hidden" name="visaId" value="<?php echo $recEmpData[$i]['id']; ?>">
                                            <button type="submit" style="display:none;"></button>
                                        </form>

                                        <!-- save the staus hod or am approve base on the user id -->

                                    </td>
                                <?php } ?>
                                <?php if ($_SESSION['designation'] == 'HR MANAGER') { ?>

                                    <td> <button type="button" class="btn btn-primary modal-button" href="#myModal1"
                                            data-toggle="modal" data-target="#myModal"
                                            data-id="<?php echo $recEmpData[$i]['id']; ?>">Upload
                                            Visa</button>

                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['status'];
    $visaId = $_POST['visaId'];
    $pdo->bind('employeeId', $_SESSION['empId']);
    $getDesignation = $pdo->query('SELECT d.name from employee_designations d join employees e on e.desigId=d.desigId where e.empId=:employeeId and d.name in ("DEPARTMENT HEAD","HR MANAGER","ACCOUNTANT")');

    if (!empty($getDesignation)) {
        if ($status == "approve") {
            $setStatus = 0;
            if ($getDesignation[0]['name'] == 'DEPARTMENT HEAD') {
                $getStatus = $pdo->query("select id from status where status_name like ('HOD_a%');");
                $setStatus = $getStatus[0]['id'];
            }

        }
        if ($status == "disapprove") {
            $setStatus = 0;
            if ($getDesignation[0]['name'] == 'DEPARTMENT HEAD') {
                $getStatus = $pdo->query("select id from status where status_name like ('HOD_d%');");
                if (!empty($getStatus))
                    $setStatus = $getStatus[0]['id'];
            }

        }
        if ($setStatus != 0) {
            $pdo->bind("id", $setStatus);
            $pdo->bind("visaId", $visaId);
            //issue---------------------------------------------------------------------------------------------------------------
            $result = $pdo->query("INSERT INTO visa_status  (statusId , visaId) values (:id,:visaId)");
            echo "<meta http-equiv='refresh' content='0'>";

        }
    }
}

?>










<div id="myModal1" class="modal">

    <div class="modal-dialog" role="document">
        <div class="modal-content" style="height: 30%;">
            <div class="modal-header">
                <h5 class="modal-title" id="addClaimModalLabel">Visa
                </h5>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data" style="float: none;">

                    <div class="form-group">
                        <label for="claim-pdf">PDF File (Visa)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="claim-pdf" name="claim-pdf" accept=".pdf">
                            <label class="custom-file-label" for="claim-pdf">Choose file</label>
                        </div>
                    </div>

                    <input type="hidden" name="visaId" id="visaId" value="">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closebtn">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>


    var btn = document.querySelectorAll(" button.modal-button"); // All page modals var
    modals = document.querySelectorAll('.modal'); // Get the <span> element that closes
    var spans = document.getElementById("closebtn");

    for (var i = 0; i < btn.length; i++) {
        btn[i].onclick = function (e) {

            e.preventDefault();
            modal = document.querySelector(e.target.getAttribute("href"));
            var id = $(this).data('id');
            $('#visaId').val(id);
            modal.style.display = "block";
        }
    } // When the user clicks on <span> (x), close
    // for (var i = 0; i < spans.length; i++) {
    spans.onclick = function () {
        for (var
            index in modals) {
            if (typeof modals[index].style !== 'undefined')
                modals[index].style.display = "none";
        }
        //    }
    } // When the user clicks anywhere






</script>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //    Get form data
    echo '------------';
    $date = date('Y-m-d');
    $visaId = $_POST['visaId'];
    $pdf = file_get_contents($_FILES['claim-pdf']['tmp_name']);
    $pdf_hex = bin2hex($pdf);
    $pdf_hex = '0x' . $pdf_hex;
    // echo $pdf_hex;
    // // Insert form data into database

    $sql = "UPDATE visa set visa=$pdf_hex where id= " . $visaId;

    $result = $pdo->query($sql);
}

?>







<script>

    $(document).ready(function () {
        // Attach a click event handler to the attachment buttons
        $(".attachment-btn").on("click", function () {
            // Get the expense ID from the data-id attribute of the button
            var visaId = $(this).data("id");
            var __table_url = '<?php echo __AJAX_CALL_PATH__; ?>?_path=management/expense/get_attachment/get_attachment';
            $.ajax({
                url: __table_url,
                "data": {
                    "foreignId": visaId,
                    "type": "visa"
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