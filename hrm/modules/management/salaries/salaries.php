<!DOCTYPE html>
<html lang="<?php echo $lang_code; ?>" dir="<?php echo $page_direction; ?>">

<head>
    <style>
        form {
            float: right;
            margin-right: 20px;
            margin-bottom: 10px;
        }

        .form-container {
            float: right;
            width: 50%;
        }

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
<div class="row" style="width: 98%;margin-left: 1%;">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">

            <div class="card-body">
                <h3>Salary Slips</h3>
                <div class="mb-2" align="<?php echo $_right; ?>">

                    <button type="button" class="btn btn-primary modal-button" href="#myModal1" data-toggle="modal"
                        data-target="#myModal">Add Salary</button>

                </div>
                <hr>

                <!-- <div class="mb-2" align="<?php echo $_right; ?>">
                    <a href="#" class="btn btn-md btn-primary"> <i class="fas fa-filter"></i> Filter </a>
                </div> -->
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
                        <label for="employeeId">Employee ID:</label>
                        <input type="text" id="employeeId" name="employeeId">
                        <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-filter"></i>
                            Employee ID</button>
                    </form>
                </div>
                <table class="table table-sm table-responsive-sm table-condensed table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Employee</th>
                            <th>Slip</th>
                            <th>Discrepancy Reason</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $dateFrom = isset($_POST['dateFrom']) ? $_POST['dateFrom'] : null;
                        $dateTo = isset($_POST['dateTo']) ? $_POST['dateTo'] : null;
                        $employeeId = isset($_POST['employeeId']) ? $_POST['employeeId'] : null;

                        // Build the SQL query based on the provided filter values
                        $sql = 'SELECT s.id as id, e.info_fullname_en AS `name`, (date) AS latest_month_salary, slip,discrepancy_reason  FROM salary s join employees e on e.empId=s.employee_id  where date=(Select Max(date) from salary where s.employee_id=employee_id) ';

                        if (!empty($dateFrom) && !empty($dateTo)) {
                            // User has provided both date filters
                            $sql .= " AND s.date BETWEEN '$dateFrom' AND '$dateTo' GROUP BY employee_id ORDER BY e.info_fullname_en;";
                        } else if (!empty($employeeId)) {
                            // User has provided the employeeId filter
                            $sql = str_replace("MAX(date)", "date", $sql);

                            $sql .= " AND employee_id = $employeeId  ORDER BY s.date;";

                        } else
                            $sql .= "GROUP BY employee_id ORDER BY e.info_fullname_en;";

                        $recEmpData = $pdo->query(
                            $sql
                        );
                        for ($i = 0; $i < count($recEmpData); $i++) { ?>
                            <tr>
                                <td><?php echo $recEmpData[$i][
                                    'latest_month_salary'
                                ]; ?>
                                </td>
                                <td><?php echo $recEmpData[$i][
                                    'name'
                                ]; ?></td>
                                <td><?php

                                // Convert the binary PDF data to a base64-encoded string
                                $pdf_base64 = base64_encode($recEmpData[$i]['slip']);

                                // Embed the base64-encoded PDF data into an HTML object tag
                                echo '<object data="data:application/pdf;base64,' . $pdf_base64 . '" type="application/pdf" width="30%" height="150px"></object>';

                                ?>
                                </td>
                                <td><?php echo $recEmpData[$i]['discrepancy_reason'] ?></td>
                                <td>


                                    <button class="attachment-btn" data-pdf="<?php echo $pdf_base64 ?>"
                                        data-slip-id="<?php echo $recEmpData[$i]['id'] ?>" style="background: none;"
                                        onclick="showPdfModal(this)">
                                        <i class="fa fa-eye <?php echo $_right; ?>"></i>
                                    </button>

                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>  function showPdfModal(button) {
        const pdfBase64 = button.dataset.pdf;
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

    var btn = document.querySelectorAll("button.modal-button");


    // All page modals
    var modals = document.querySelectorAll('.modal');

    // Get the <span> element that closes the modal
    var spans = document.getElementsByClassName("close");

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


<div id="myModal1" class="modal">

    <div class="modal-dialog" role="document">
        <div class="modal-content" style="height: 30%;">
            <div class="modal-header">
                <h5 class="modal-title" id="addClaimModalLabel">Salary Slip</h5>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data" style="float: none;">

                    <div class="form-group">
                        <label for="claim-pdf">PDF File (Salary Slip)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="claim-pdf" name="claim-pdf" accept=".pdf">
                            <label class="custom-file-label" for="claim-pdf">Choose file</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="employees">Choose an Employee:</label>
                        <select id="employees" name="employee_id">
                            <?php
                            $result = $pdo->query('SELECT e.empId, e.info_fullname_en AS name FROM employees e JOIN employee_designations ed ON ed.desigId=e.desigId WHERE ed.name="LABOUR";');

                            for ($i = 0; $i < count($result); $i++) {
                                $employee_id = $result[$i]['empId'];
                                $employee_name = $result[$i]['name'];
                                echo "<option value='$employee_id'>$employee_name</option>";
                            }
                            ?>
                        </select>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        //    Get form data
    
        $date = date('Y-m-d');
        $employee_id = $_POST['employee_id'];
        $pdf = file_get_contents($_FILES['claim-pdf']['tmp_name']);
        $pdf_hex = bin2hex($pdf);
        $pdf_hex = '0x' . $pdf_hex;
        echo $pdf_hex;
        // Insert form data into database
        $sql = "INSERT INTO salary ( employee_id, slip,discrepancy_reason)
                VALUES ('$employee_id', $pdf_hex,'123')";

        $result = $pdo->query($sql);
        echo "<meta http-equiv='refresh' content='0'>";

    }

    ?>
</div>