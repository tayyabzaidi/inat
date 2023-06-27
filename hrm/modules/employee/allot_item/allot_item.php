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
                <h3>Custom Items</h3>
                <div class="mb-2" align="<?php echo $_right; ?>">

                    <button type="button" class="btn btn-primary modal-button" href="#myModal1" data-toggle="modal"
                        data-target="#myModal">Request Item</button>

                </div>

                <hr>


                <table class="table table-sm table-responsive-sm table-condensed table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Custom Items</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $employee_id = $_SESSION['empId'];
                        // Build SQL query based on provided filter values
                        $sql = 'SELECT ai.*,eai.id as employee_item_id,eai.date FROM `alotted_item` ai join `employee_allocated_item` eai   on ai.id=eai.itemId   WHERE eai.employeeId=' . $employee_id;

                        $recEmpData = $pdo->query(
                            $sql
                        );
                        for ($i = 0; $i < count($recEmpData); $i++) { ?>
                            <tr>
                                <td><?php echo $recEmpData[$i][
                                    'date'
                                ]; ?>
                                </td>
                                <td><?php echo $recEmpData[$i][
                                    'item'
                                ]; ?></td>
                                <td class="" style="text-align: left;">
                                    <?php
                                    $getStatus = $pdo->query(
                                        'SELECT s.status_name from `status` s join employee_item_status eai on s.id=eai.statusId where eai.itemId = ' . $recEmpData[$i]['employee_item_id']
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
                                            $HOD = 'disapproved';
                                        } elseif (
                                            $getStatus[$j]['status_name'] ==
                                            'HR_approved'
                                        ) {
                                            $HR = 'approved';
                                        } elseif (
                                            $getStatus[$j]['status_name'] ==
                                            'HR_disapproved'
                                        ) {
                                            $HR = 'disapproved';
                                        }
                                    }
                                    ?>

                                    <div class="ant-tag " style="<?php if (
                                        $HOD == 'approved'
                                    ) {
                                        echo 'background-color: rgb(135, 208, 104)';
                                    } elseif ($HOD == 'disapprove') {
                                        echo 'background-color: red';
                                    } else {
                                        echo 'background-color: white';
                                    } ?>">
                                        General Manager</div>
                                    <div class="ant-tag " style="<?php
                                    if (
                                        $HR == 'approved'
                                    ) {
                                        echo 'background-color: rgb(135, 208, 104)';
                                    } elseif ($HR == 'disapproved') {
                                        echo 'background-color: red';
                                    } else {
                                        echo 'background-color: white';
                                    } ?>">
                                        Human Resources</div>
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
        <div class="modal-content" style="height: 30%;">
            <div class="modal-body">
                <form action="" method="POST" style="float: none;">
                    <div class="form-group">
                        <h2>Allocate Items</h2>
                        <label for="items">Select Item:</label>
                        <select id="items" name="item_ids[]" multiple>
                            <?php
                            $result = $pdo->query('SELECT id ,item as item from alotted_item');
                            foreach ($result as $row) {
                                $itemId = $row['id'];
                                $item_name = $row['item'];
                                echo "<option value='$itemId'>$item_name</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            id="closebtn">Close</button>
                        <button type="submit" class="btn btn-md btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    var btn = document.querySelectorAll(" button.modal-button"); // All page modals var
    modals = document.querySelectorAll('.modal'); // Get the <span> element that closes
    var spans = document.getElementById("closebtn");

    for (var i = 0; i < btn.length; i++) {
        btn[i].onclick = function (e) {
            e.preventDefault(); modal = document.querySelector(e.target.getAttribute("href"));
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
    window.onclick = function (event) {
        if (event.target.classList.contains('modal')) {
            for (var index in modals) {
                if
                    (typeof modals[index].style !== 'undefined')
                    modals[index].style.display = "none";
            }
        }
    } </script>

<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $itemIds = $_POST['item_ids'];
    // Insert form data into database
    for ($i = 0; $i < count($itemIds); $i++) {
        $sql = "INSERT INTO employee_allocated_item ( employeeId, itemId)
                VALUES (" . $employee_id . "," . $itemIds[$i] . ")";
        $result = $pdo->query($sql);
    }
    echo "<meta http-equiv='refresh' content='0'>";
}

?>


</html>