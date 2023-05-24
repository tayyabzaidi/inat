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

        #comment {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 10px;
            resize: none;
        }

        /* Button styles */
        button[type="submit"] {
            background-color: #020041;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
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

        .modal-dialog {
            height: 180%;
            max-width: 100%;
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

        form {
            float: right;
            margin-right: 20px;
            margin-bottom: 10px;
        }

        .form-container {
            float: right;
            width: 50%;
        }
    </style>
</head>
<div class="row" style="width: 80%;margin-left: 10%;">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">

            <div class="card-body">
                <h3>Salary Slips</h3>
                <hr>
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
                            <th>ID</th>
                            <th>Date</th>
                            <th>Slip</th>
                            <th>View</th>
                            <th>Any Issue?</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $dateFrom = isset($_POST['dateFrom']) ? $_POST['dateFrom'] : null;
                        $dateTo = isset($_POST['dateTo']) ? $_POST['dateTo'] : null;
                        $sql = "SELECT * FROM salary  WHERE employee_id= :employeeId";
                        if (!empty($dateFrom) && !empty($dateTo)) {
                            $sql .= " AND `date` BETWEEN '$dateFrom' AND '$dateTo'";
                        }
                        $sql .= " ORDER BY `date` LIMIT 5";
                        $pdo->bind('employeeId', $_SESSION['empId']);
                        $recEmpData = $pdo->query(
                            $sql
                        );
                        for ($i = 0; $i < count($recEmpData); $i++) { ?>
                            <tr>
                                <td><?php echo $recEmpData[$i]['id'] ?></td>
                                <td><?php echo $recEmpData[$i][
                                    'date'
                                ]; ?>
                                </td>
                                <td><?php
                                header("Content-Type: application/pdf");

                                // Convert the binary PDF data to a base64-encoded string
                                $pdf_base64 = base64_encode($recEmpData[$i]['slip']);

                                // Embed the base64-encoded PDF data into an HTML object tag
                                echo '<object data="data:application/pdf;base64,' . $pdf_base64 . '" type="application/pdf" width="40%" height="200px"></object>';

                                ?>
                                </td>
                                <td>

                                    <button class="attachment-btn" data-pdf="<?php echo $pdf_base64 ?>"
                                        data-slip-id="<?php echo $recEmpData[$i]['id'] ?>" style="background: none;"
                                        onclick="showPdfModal(this)">
                                        <i class="fa fa-eye <?php echo $_right; ?>"></i>
                                    </button>
                                </td>
                                <td onclick="openModal('<?php echo $recEmpData[$i]['id']; ?>')">

                                    <!-- <?php echo $recEmpData[$i]['discrepancy_reason'] ?> -->
                                    <button class="comment-button" style="background: none;">
                                        <i class="fa fa-comment"></i> </button>
                                </td>


                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>





<!-- // modal for adding comment -->
<div id="myModal1" class="modal">
    <div class="modal-content" style=" width: 40%;
            height: 40%;">
        <form id="commentForm" method="post">
            <label for="comment">Discrepancy Reason:</label>
            <textarea id="comment" name="comment" rows="4" cols="50"></textarea>
            <br>
            <input type="hidden" id="idField" name="idField">
            <button type="submit" style="float: right;">Save</button>
        </form>
    </div>
</div>

<!-- script to view salary slip -->
<script>


    function showPdfModal(button) {
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
            const slipIdInput = document.createElement('input');
            slipIdInput.type = 'hidden';
            slipIdInput.name = 'slip_id';
            slipIdInput.id = 'slip_id';
            slipIdInput.value = button.dataset.slipId;
            modalContent.appendChild(slipIdInput);

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


    var modal = document.getElementById("myModal1");
    var form = document.getElementById("commentForm");

    // Open the modal and populate the hidden ID field with the record ID
    function openModal(id) {
        document.getElementById("idField").value = id;
        modal.style.display = "block";
    }

    // Close the modal and reset the form
    function closeModal() {
        modal.style.display = "none";
        form.reset();
    }

    // Add an event listener to the form submit button
    form.addEventListener("submit", function (e) {
        // Prevent the form from submitting normally
        e.preventDefault();

        // Get the form data
        var formData = new FormData(form);

        // Send an AJAX request to the PHP script to save the comment data
        var xhr = new XMLHttpRequest();
        xhr.open("POST", '<?php echo __AJAX_CALL_PATH__; ?>?_path=management/salary/save_comment/save_comment', true);
        xhr.onload = function (data) {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // If the save was successful, close the modal and reload the page
                // alert('saved successfully');
                closeModal();
                setTimeout(function () {
                    alert('Comment saved successfully');
                }, 100);
                //   location.reload();
            }
        };
        xhr.send(formData);
    });


    // var btn = document.querySelectorAll("button.modal-button");
    // var btn = document.querySelectorAll("button.comment-button");
    // All page modals
    var modals = document.querySelectorAll('.modal');

    // Get the <span> element that closes the modal
    var spans = document.getElementsByClassName("close");




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



</html>