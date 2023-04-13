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
    </style>
</head>
<div class="row" style="width: 98%;margin-left: 1%;">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">

            <div class="card-body">
                <h3>Salary Slips</h3>
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
                            <th>Download</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $dateFrom = isset($_POST['dateFrom']) ? $_POST['dateFrom'] : null;
                        $dateTo = isset($_POST['dateTo']) ? $_POST['dateTo'] : null;
                        $employeeId = isset($_POST['employeeId']) ? $_POST['employeeId'] : null;

                        // Build the SQL query based on the provided filter values
                        $sql = 'SELECT s.id as id, e.info_fullname_en AS `name`, MAX(date) AS latest_month_salary, slip,discrepancy_reason  FROM salary s join employees e on e.empId=s.employee_id  ';

                        if (!empty($dateFrom) && !empty($dateTo)) {
                            // User has provided both date filters
                            $sql .= " WHERE s.date BETWEEN '$dateFrom' AND '$dateTo' GROUP BY employee_id ORDER BY e.info_fullname_en;";
                        } else if (!empty($employeeId)) {
                            // User has provided the employeeId filter
                            $sql = str_replace("MAX(date)", "date", $sql);

                            $sql .= " WHERE employee_id = $employeeId  ORDER BY s.date;";

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
                                header("Content-Type: application/pdf");

                                // Convert the binary PDF data to a base64-encoded string
                                $pdf_base64 = base64_encode($recEmpData[$i]['slip']);

                                // Embed the base64-encoded PDF data into an HTML object tag
                                echo '<object data="data:application/pdf;base64,' . $pdf_base64 . '" type="application/pdf" width="30%" height="150px"></object>';

                                ?>
                                </td>
                                <td><?php echo $recEmpData[$i]['discrepancy_reason'] ?></td>
                                <td>
                                    <a
                                        href="<?php echo __APP_URL__ . $route->q . '/slip_download?id=' . $recEmpData[$i]['id'] . ''; ?>">
                                        <i class="fa fa-download <?php echo $_right; ?>"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>