<!DOCTYPE html>
<html lang="<?php echo $lang_code; ?>" dir="<?php echo $page_direction; ?>">
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
            height: 120%;
            max-width: 80%;
            margin: 1.75rem auto;
        }

        .modal-dialog2 {
            height: 180%;
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

        .modal-content2 {
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

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .form-container {
            float: right;
            margin-bottom: 10px;

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

                <div class="mb-2" align="<?php echo $_right; ?>">

                    <button type="button" class="btn btn-primary modal-button" href="#myModal1" data-toggle="modal"
                        data-target="#myModal">Add Visa</button>

                </div>

                <h3>Visa List</h3>
                <div class="form-container">
                    <form action="#" method="POST">
                        <label for="dateFrom">Date From:</label>
                        <input type="date" id="dateFrom" name="dateFrom">
                        <label for="dateTo">Date To:</label>
                        <input type="date" id="dateTo" name="dateTo">
                        <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-filter"></i>
                            Date</button>
                    </form>
                </div>
                <table class="table table-sm table-responsive-sm table-condensed table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>I.D</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Comment</th>
                            <th>Visa</th>
                            <th>Attachment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php


                        $pdo->bind('employeeId', $_SESSION['empId']);
                        $dateFrom = isset($_POST['dateFrom']) ? $_POST['dateFrom'] : null;
                        $dateTo = isset($_POST['dateTo']) ? $_POST['dateTo'] : null;

                        // Build the SQL query based on the provided filter values
                        $sql = 'SELECT ee.*,e.info_fullname_en as `name` FROM visa ee join employees e on e.empId=ee.employeeId WHERE ee.`employeeId`=:employeeId ';

                        if (!empty($dateFrom) && !empty($dateTo)) {
                            // User has provided both date filters
                            $sql .= "AND ee.date BETWEEN '$dateFrom' AND '$dateTo' ORDER BY ee.`date`;";
                        } else
                            $sql .= "ORDER BY ee.`date`;";

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
                                <td><?php echo $recEmpData[$i]['comment']; ?></td>
                                <td>
                                    <?php $pdf_base64 = base64_encode($recEmpData[$i]['visa']);
                                    ?>
                                    <button data-pdf="<?php echo $pdf_base64 ?>"
                                        data-visa_id="<?php echo $recEmpData[$i]['id'] ?>" style="background: none;"
                                        onclick="showPdfModal(this)">
                                        <i class="fa fa-folder <?php echo $_right; ?>"></i>
                                    </button>
                                </td>
                                <td><button class="attachment-btn" data-id="<?php echo $recEmpData[$i]["id"] ?>"
                                        style="background: none;"><i class="fa fa-folder"></i></button></td>

                                </td>
                                </td>


                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div id="myModal1" class="modal">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClaimModalLabel">Add Visa</h5>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="claim-comment">Comment</label>
                        <textarea class="form-control" id="claim-comment" name="claim-comment" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="claim-attachments">Attachments</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="claim-attachments"
                                name="claim-attachments[]" accept=".jpg, .jpeg, .png, .gif, .php, .html" multiple>
                            <label class="custom-file-label" for="claim-attachments">Choose file</label>
                        </div>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Visa</button>
            </div>
            </form>
        </div>
    </div>

</div>



<script>
    function showPdfModal(button) {
        if (button.dataset.pdf == '')
            alert('There is no visa');
        else {
            const pdfBase64 = button.dataset.pdf;
            const modal = document.createElement('div');
            modal.className = 'modal';
            const modalContent = document.createElement('div');
            modalContent.className = 'modal-content2';

            const embedElement = document.createElement('embed');
            embedElement.type = 'application/pdf';
            embedElement.width = '100%';
            embedElement.height = '95%';
            embedElement.src = 'data:application/pdf;base64,' + pdfBase64;
            const visaIdInput = document.createElement('input');
            visaIdInput.type = 'hidden';
            visaIdInput.name = 'visa_id';
            visaIdInput.id = 'visa_id';
            visaIdInput.value = button.dataset.visa_id;
            modalContent.appendChild(visaIdInput);

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
                        var img = $('<img>').attr('src', images[i]).attr('height', 200).attr('width', 200);
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

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $date = date('Y-m-d');
    $employeeId = $_SESSION['empId'];
    $comment = $_POST['claim-comment'];
    // Insert form data into database
    $sql = "INSERT INTO visa ( date, employeeId, comment)
                VALUES ( '$date', '$employeeId','$comment')";

    $result = $pdo->query($sql);

    // Step 3: Verify if there is any row and extract status name
    if (!empty($result)) {
        $visaId = $pdo->query("SELECT MAX(id) as id from visa");
        $attachments = $_FILES['claim-attachments'];
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
            $pdo->bind('visaId', $visaId[0]['id']);
            $attachment = $pdo->query("INSERT INTO attachment( attachment, foreignId,`type`) VALUES (" . $pdf_hex . ",:visaId,'visa')");

        }

    }
    echo "<meta http-equiv='refresh' content='0'>";

}
?>


</html>