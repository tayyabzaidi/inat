<!DOCTYPE html>
<html lang="<?php echo $lang_code; ?>" dir="<?php echo $page_direction; ?>">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Load jQuery UI library -->
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css">

<head>
    <style>
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
            height: 100%;
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
        <div
            style="width: 13%; padding-left: 7px; padding-right: 7px; border: 2px solid rgba(235, 152, 23, 0.7); margin-left: 1%;">
            <div class="ant-card-body">
                <?php $available_tickets = $_SESSION['total_tickets'];

                $tickets = $pdo->query("SELECT count(eai.id) as count from employee_air_tickets eai join employee_trip_status ets on ets.tripId=eai.id where employeeId=" . $employeeId . " and 2=(select count(s.id) from employee_trip_status join status s on employee_trip_status.statusId=s.id where employee_trip_status.tripId=eai.id and s.status_name in ('HOD_approved','HR_approved'))");

                ?>
                <h4 class="heading">Flight Tickets</h4>
                <span class="icon" style="display: block; width: 100%;">
                    <span>Available Tickets: <?php echo $available_tickets - $tickets[0]['count'] ?></span><br>
                    <span>Used Tickets: <?php echo $tickets[0]['used_tickets'] ?></span>
                </span>
                <div></div>
            </div>
        </div>
    </div>

    <div class="row" style="width: 98%;margin-left: 1%;">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3>Business Trips</h3>
                    <div class="mb-2" align="<?php echo $_right; ?>">
                        <button type="button" class="btn btn-primary modal-button" href="#myModal1" data-toggle="modal"
                            data-target="#myModal" <?php if ($available_tickets - $tickets[0]['count'] < 1) {
                                echo 'disabled';
                            } ?>>
                            Request Flight Ticket
                        </button>
                    </div>
                    <hr>
                    <table class="table table-sm table-responsive-sm table-condensed table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Details</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Build the SQL query based on the provided filter values
                            $sql = 'SELECT id, date, details from employee_air_tickets where employeeId=' . $employeeId;

                            $recEmpData = $pdo->query($sql);
                            for ($i = 0; $i < count($recEmpData); $i++) { ?>
                                <tr>
                                    <td><?php echo $recEmpData[$i]['date']; ?></td>
                                    <td><?php echo $recEmpData[$i]['details']; ?></td>
                                    <td class="" style="text-align: left;">
                                        <?php
                                        $getStatus = $pdo->query('SELECT s.status_name from `status` s join employee_trip_status eat on s.id=eat.statusId and eat.tripId = ' . $recEmpData[$i]['id']);
                                        $HOD = '';
                                        $HR = '';
                                        for ($j = 0; $j < count($getStatus); $j++) {
                                            if ($getStatus[$j]['status_name'] == 'HOD_approved') {
                                                $HOD = 'approved';
                                            } elseif ($getStatus[$j]['status_name'] == 'HOD_disapproved') {
                                                $HOD = 'disapproved';
                                            } elseif ($getStatus[$j]['status_name'] == 'HR_approved') {
                                                $HR = 'approved';
                                            } elseif ($getStatus[$j]['status_name'] == 'HR_disapproved') {
                                                $HR = 'disapproved';
                                            }
                                        }
                                        ?>
                                        <div class="ant-tag" style="<?php if ($HOD == 'approved') {
                                            echo 'background-color: rgb(135, 208, 104)';
                                        } elseif ($HOD == 'disapproved') {
                                            echo 'background-color: red;';
                                        } else {
                                            echo 'background-color: white';
                                        } ?>">
                                            HOD</div>
                                        <div class="ant-tag" style="<?php if ($HR == 'approved') {
                                            echo 'background-color: rgb(135, 208, 104)';
                                        } elseif ($HR == 'disapproved') {
                                            echo 'background-color: red;';
                                        } else {
                                            echo 'background-color: white';
                                        } ?>">
                                            HR</div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="myModal1" class="modal">
        <div class="modal-dialog" role="document">
            <form name="" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addClaimModalLabel">Flight Ticket Request</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="details">Details:</label>
                            <input type="text" class="form-control" name="details" id="details">
                            <label for="date">Select a Date:</label>
                            <input type="date" id="date" name="date">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script>
        $('.approve-disapprove-btn').click(function () {
            var itemStatusId = $(this).data('id');
            $('#itemStatusId').val(itemStatusId);
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

    </script>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $details = $_POST['details'];
        $date = $_POST['date'];

        // Insert form data into database
        $sql = "INSERT INTO `employee_air_tickets`(`date`, `details`, `employeeId`) VALUES  (" . $date . ",'" . $details . "'," . $employeeId . ")";
        $result = $pdo->query($sql);
        echo "<meta http-equiv='refresh' content='0'>";
    } ?>

</html>