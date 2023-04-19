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
            height: 90%;
            max-width: 80%;
            margin: 1.75rem auto;
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            margin-top: 6%;
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



        .form-container {
            display: inline-block;
            vertical-align: top;
            margin-right: 10px;
            float: right;
            margin-bottom: 10px;
        }
    </style>
</head>

<div class="row" style="width: 98%;margin-left: 1%;">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">

            <div class="card-body">


                <h3>Claim List</h3>

                <div class="form-container">


                    <form action="#" method="POST" style="margin-bottom: 10px">
                        <label for="employee">Employee :</label>
                        <input type="text" id="employee" name="employee">
                        <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-filter"></i>
                            Employee</button>
                    </form>
                    <form action="#" method="POST">
                        <label for="dateFrom">Date From:</label>
                        <input type="date" id="dateFrom" name="dateFrom">
                        <label for="dateTo">Date To:</label>
                        <input type="date" id="dateTo" name="dateTo">
                        <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-filter"></i>
                            Date</button>
                    </form>
                </div>
                <table class="table table-sm table-responsive-sm table-condensed table-striped" style="width:100%"
                    id="tab">
                    <thead>
                        <tr>
                            <th>I.D</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Form</th>
                            <th>Total Amount</th>
                            <th>Attachmnet</th>
                            <th>Approve</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php



                        $dateFrom = isset($_POST['dateFrom']) ? $_POST['dateFrom'] : null;
                        $dateTo = isset($_POST['dateTo']) ? $_POST['dateTo'] : null;
                        $employee = isset($_POST['employee']) ? $_POST['employee'] : null;

                        // Build the SQL query based on the provided filter values
                        $sql = 'SELECT ee.*,e.info_fullname_en as `name` FROM employee_expenses ee join employees e on e.empId=ee.employee_id ';

                        if (!empty($dateFrom) && !empty($dateTo)) {
                            // User has provided both date filters
                            $sql .= " WHERE ee.date BETWEEN '$dateFrom' AND '$dateTo' ORDER BY ee.date LIMIT 5;";
                        }
                        if (!empty($employee)) {

                            $sql .= " WHERE e.info_fullname_en like  '$employee'  ORDER BY ee.date LIMIT 5;";

                        }
                        if (empty($employee) && empty($dateFrom) && empty($dateTo))
                            $sql .= " ORDER BY ee.date LIMIT 5;";

                        $recEmpData = $pdo->query(
                            $sql
                        );
                        ?>
                        <?php for ($i = 0; $i < count($recEmpData); $i++) { ?>
                            <!-- <tr onClick="alert($(this).find('td:first').text())">
                                 $('input[name="shipmentID"]').val($(this).text()); -->
                            <!-- <tr onClick="document.getElementById('userId').value=$(this).find('td:first').text()"> -->
                            <tr>


                                <td><?php echo $recEmpData[$i]['unique_id']; ?>
                                </td>
                                <td><?php echo $recEmpData[$i]['date']; ?>
                                </td>
                                <td><?php echo $recEmpData[$i]['name']; ?>
                                </td>
                                <td>

                                    <iframe
                                        src="data:application/pdf;base64,<?php echo base64_encode($recEmpData[$i]['form_data']); ?>"
                                        width="80%" height="250"></iframe>

                                </td>
                                <td> <?php echo $recEmpData[$i]['total_amount']; ?>
                                </td>
                                <td>
                                    <button id="myButton" data-expenseId="<?php echo $recEmpData[$i]['unique_id']; ?>"
                                        class="modal-button" href="#myModal2" style="background: none;">
                                        <i class="fa fa-folder"></i>
                                    </button>

                                    <form id="myForm" method="post" action="">
                                        <input type="hidden" id="expenseId" name="expenseId" value="">
                                    </form>


                                    <!-- <button data-expenseId="<?php echo $recEmpData[$i]['unique_id']; ?>"
                                        class="modal-button" href="#myModal2" style="background: none;"><i
                                            class="fa fa-folder"></i></button> -->
                                </td>



                                </td>
                                <td>
                                    <?php $status = "";
                                    if (isset($_POST['status'])) {
                                        $status = $_POST['status'];
                                    } ?>
                                    <label>
                                        <input type="checkbox" name="status" value="approve" <?php if ($status == "approve")
                                            echo "checked"; ?>>
                                    </label>
                                    <!-- save the staus hod or am approve base on the user id -->
                                    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                        $status = $_POST['status'];
                                        if ($status == "approve") {
                                            $sql = "UPDATE employee_expense SET status =  WHERE id = :id";
                                        }
                                    } ?>
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
            <script>
                // $(document).ready(function () {

                //     //use this if you have jquery version 1.7+
                //     $('table#tab tr').click(function () {
                //         //  alert($(this).find('td:first').text());
                //         alert(1);
                //   });

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

                modals[0].addEventListener('shown.bs.modal', function () {
                    // Get the expense ID value from your JavaScript code
                    const expenseIdInput = document.getElementById('expenseId');
                    const expenseId = expenseIdInput.value;

                    // Fetch the image data from your PHP script
                    fetch('fetch_images.php?expenseId=' + expenseId)
                        .then(response => response.blob())
                        .then(blob => {
                            console.log(blob);
                            console.log('----------------------------------')
                            // Create a URL for the image data
                            const url = URL.createObjectURL(blob);

                            // Set the src attribute of the <img> tag
                            const modalImage = document.getElementById('modal-image');
                            modalImage.src = url;
                        });
                });
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
            <div class="modal-body">
                <!-- <?php
                // Connect to the database
                $expenseId = $_POST['expenseId'];

                echo $expenseId;
                echo '----php-----------';
                //$sql = "SELECT attachment FROM attachment WHERE expenseId=$expenseId";
                $result = $pdo->query(
                    'SELECT attachment FROM attachment where expenseId=2 ;'
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
                echo "</div>";


                ?> -->
                <img id="modal-image" src="" alt="Image" height='200px' width='200px' role='presentation'>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

</div>






</html>