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
            height: 120%;
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
<div class="row" style="width: 98%;margin-left: 1%;">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">

            <div class="card-body">

                <div class="mb-2" align="<?php echo $_right; ?>">

                    <button type="button" class="btn btn-primary modal-button" href="#myModal1" data-toggle="modal"
                        data-target="#myModal">Add Claim</button>

                </div>

                <h3>Claim List</h3>

                <form action="#" method="POST">
                    <label for="dateFrom">Date From:</label>
                    <input type="date" id="dateFrom" name="dateFrom">
                    <label for="dateTo">Date To:</label>
                    <input type="date" id="dateTo" name="dateTo">
                    <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-filter"></i>
                        Date</button>
                </form>

                <table class="table table-sm table-responsive-sm table-condensed table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>I.D</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Total Amount</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pdo->bind('employeeId', $_SESSION['empId']);
                        $dateFrom = isset($_POST['dateFrom']) ? $_POST['dateFrom'] : null;
                        $dateTo = isset($_POST['dateTo']) ? $_POST['dateTo'] : null;

                        // Build the SQL query based on the provided filter values
                        $sql = 'SELECT ee.*,e.info_fullname_en as `name` FROM employee_expenses ee join employees e on e.empId=ee.employee_id WHERE ee.`employee_id`=:employeeId ';

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
                                <td><?php echo $recEmpData[$i]['unique_id']; ?>
                                </td>
                                <td><?php echo $recEmpData[$i]['date']; ?>
                                </td>
                                <td><?php echo $recEmpData[$i]['name']; ?>
                                </td>
                                <td class="" style="text-align: left;">
                                    <?php
                                    // $pd->bind('expenseId',$recEmpData[$i]['id']);
                                    $getStatus = $pdo->query(
                                        'SELECT s.status_name from `status` s join employee_expense_status es on s.id=es.statusId where es.expenseId=1;'
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
                                <td> <?php echo $recEmpData[$i]['total_amount']; ?>
                                </td>
                                <td><button class="modal-button" href="#myModal2" style="background: none;"><i
                                            class="fa fa-folder"></i></button></td>
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
                <h5 class="modal-title" id="addClaimModalLabel">Add Claim</h5>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="claim-comment">Comment</label>
                        <textarea class="form-control" id="claim-comment" name="claim-comment" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="claim-pdf">PDF File (Please submit expense form)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="claim-pdf" name="claim-pdf" accept=".pdf">
                            <label class="custom-file-label" for="claim-pdf">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="claim-attachments">Attachments</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="claim-attachments"
                                name="claim-attachments[]" accept=".jpg, .jpeg, .png, .gif, .php, .html" multiple>
                            <label class="custom-file-label" for="claim-attachments">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="claim-amount" style="margin-right:20px">Total Amount</label>
                        <input type="number" id="total" name="claim-amount" value="0">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Claim</button>
            </div>
            </form>
        </div>
    </div>

</div>

<!-- The Modal -->
<div id="myModal2" class="modal">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewAttachmentsModalLabel">Attachments</h5>
            </div>
            <div class="modal-body">
                <?php
                // Connect to the database
                
                $result = $pdo->query(
                    'SELECT attachment FROM attachment where expenseId=1;'
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


                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

</div>



<script>
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

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target.classList.contains('modal')) {
            for (var index in modals) {
                if (typeof modals[index].style !== 'undefined') modals[index].style.display = "none";
            }
        }
    }
</script>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //    Get form data
    $unique_id = '123456';
    $date = date('Y-m-d');
    $employee_id = $_SESSION['empId'];
    $total_amount = $_POST['claim-amount'];
    $comment = $_POST['claim-comment'];
    $pdf = file_get_contents($_FILES['claim-pdf']['tmp_name']);
    $pdf_hex = bin2hex($pdf);
    $pdf_hex = '0x' . $pdf_hex;
    // Insert form data into database
    $sql = "INSERT INTO employee_expenses (unique_id, date, employee_id, total_amount, form_data, comment)
                VALUES ('123456', '$date', '$employee_id', '$total_amount',$pdf_hex, '$comment')";

    $result = $pdo->query($sql);

    // Step 3: Verify if there is any row and extract status name
    if (!empty($result)) {
        $expenseId = $pdo->query("SELECT id from employee_expenses where unique_id = '$unique_id';");
        $attachments = $_FILES['claim-attachments'];
        echo $expenseId[0]['id'];
        echo '-';
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
            echo $pdf_hex;
            $attachment = $pdo->query("INSERT INTO attachment( attachment, expenseId) VALUES ('$pdf_hex','$expenseId[0]['id']')");
        }

    }
}
?>

<!-- 
            <script>

    function detailedExpenseInfo(expenseId, comment) {
      // Make an AJAX request to the PHP script to get the item data
      $.ajax({
        url: "getExpenseAttachment.php",
        type: "POST",
        data: {
          expenseId: expenseId,
          comment: comment
        },
        dataType: "text",
        success: function(data) {
          // Your code to view the item goes here, using the returned data
          console.log(data+'sfdasfsastassfsauhasihfdasidi');
          console.log("Success");
        },
        error: function(xhr, status, error) {
          // Handle errors
          console.log("Error: " + error );
        }
      });
    }
  </script> -->

</html>