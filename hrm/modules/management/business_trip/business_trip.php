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
    </style>
</head>
<div class="row" style="width: 98%;margin-left: 1%;">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-body">
                <h3>Business Trip Details</h3>
                <hr>
                <table class="table table-sm table-responsive-sm table-condensed table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Employee</th>
                            <th>Details</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $employee_id = $_SESSION['empId'];
                        $designation = $_SESSION['designation'];
                        // Build the SQL query based on the provided filter values
                        
                        $sql = 'SELECT eat.*,e.air_tickets,e.info_fullname_en as name FROM `employee_air_tickets` eat join employees e on eat.employeeId=e.empId ';

                        $recEmpData = $pdo->query($sql);
                        for ($i = 0; $i < count($recEmpData); $i++) { ?>
                            <tr>
                                <td><?php echo $recEmpData[$i]['date']; ?></td>
                                <td><?php echo $recEmpData[$i]['name']; ?></td>
                                <td><?php echo $recEmpData[$i]['details']; ?></td>
                                <td class="" style="text-align: left;">
                                    <?php
                                    $getStatus = $pdo->query('SELECT s.status_name from `status` s join employee_trip_status eat on s.id=eat.statusId where eat.tripId = ' . $recEmpData[$i]['id']);
                                    $HOD = '';
                                    $HR = '';
                                    for ($j = 0; $j < count($getStatus); $j++) {
                                        if ($recEmpData[$i]['status_name'] == 'HOD_approved') {
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

                                    <div class="ant-tag " style="<?php if ($HOD == 'approved') {
                                        echo 'background-color: rgb(135, 208, 104)';
                                    } elseif ($HOD == 'disapproved') {
                                        echo 'background-color: red;';
                                    } else {
                                        echo 'background-color: white';
                                    } ?>">
                                        HOD</div>
                                    <div class="ant-tag " style="<?php if ($HR == 'approved') {
                                        echo 'background-color: rgb(135, 208, 104)';
                                    } elseif ($HR == 'disapproved') {
                                        echo 'background-color: red;';
                                    } else {
                                        echo 'background-color: white';
                                    } ?>">
                                        HR</div>
                                </td>
                                <td>
                                    <button class="modal-button approve-disapprove-btn"
                                        id="<?php echo $recEmpData[$i]['id']; ?>" href="#myModal1" style="background: none;"
                                        data-id="<?php echo $recEmpData[$i]['id']; ?>">Approve/Disapprove</button>
                                </td>
                                <td></td>
                                <td></td>
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
        <form name="approve-disapprove-trip" method="post" action="approve-disapprove-trip">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addClaimModalLabel">Approve/Disapprove Trip</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input style="display: none" type="text" name="tripId" id="tripId">
                    <div class=" form-group">
                        <label for="comments">Comments:</label>
                        <input type="text" class="form-control" name="comments" id="comments">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="approve" id="approve">Approve</button>
                    <button type="submit" class="btn btn-danger" id="disapprove">Disapprove</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    $('.approve-disapprove-btn').click(function () {
        var tripId = $(this).data('id');
        $('#tripId').val(tripId);
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


</div>

</html>