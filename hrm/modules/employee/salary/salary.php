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
    </style>
</head>
<div class="row" style="width: 80%;margin-left: 10%;">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">

            <div class="card-body">
                <h3>Salary Slips</h3>
                <hr>
                <div class="mb-2" align="<?php echo $_right; ?>">
                    <a href="" class="btn btn-md btn-primary"> <i class="fas fa-filter"></i>Filter</a>
                </div>

                <table class="table table-sm table-responsive-sm table-condensed table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Slip</th>
                            <th>View</th>
                            <th>Issue with Salary</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pdo->bind('employeeId', $_SESSION['empId']);
                        $recEmpData = $pdo->query(
                            'SELECT * FROM salary  WHERE employee_id= :employeeId ORDER BY `date` LIMIT 5;'
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

                                    <button class="attachment-btn" data-id="<?php echo $pdf_base64 ?>"
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
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="height: 25%;width:40%">
            <div class="modal-header">
                <h5 class="modal-title" id="viewAttachmentsModalLabel">Discrepancy Reason</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                    <label for="comment">Discrepancy Reason:</label>
                    <textarea id="comment" name="comment" rows="4" cols="50"></textarea>
                    <br>
                    <input type="hidden" id="idField" name="idField" readonly>

                    <button type="submit">Submit</button>

                </form>
            </div>
        </div>
    </div>

</div>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the value of the comment field
    $comment = $_POST['comment'];

    // Get the value of the idField field
    $idField = $_POST['idField'];
    $pdo->bind('reason', $comment);
    $pdo->bind('id', $idField);
    $result = $pdo->query("UPDATE salary set discrepancy_reason=:reason where id=:id");
    ; // Do something with the form data
    // ...
    echo $result;
}

?>
<!-- script to view salary slip -->
<script>


    function showPdfModal(button) {
        console.log
        const pdfBase64 = button.dataset.id;
        const modal = document.createElement('div');
        modal.className = 'modal';
        const modalContent = document.createElement('div');
        modalContent.className = 'modal-content';
        const closeButton = document.createElement('span');
        closeButton.className = 'close';
        closeButton.innerHTML = '&times;';
        closeButton.onclick = function () {
            modal.style.display = 'none';
        };
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

        modalContent.appendChild(closeButton);
        modalContent.appendChild(embedElement);
        modal.appendChild(modalContent);
        document.body.appendChild(modal);
        modal.style.display = 'block';
    }


    function openModal(id) {
        // Get the modal
        var modal = document.getElementById("myModal1");

        // Get the text field in the modal
        var textField = document.getElementById("idField");

        // Set the value of the text field to the clicked ID
        textField.value = id;

        // Open the modal
        modal.style.display = "block";
    }


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