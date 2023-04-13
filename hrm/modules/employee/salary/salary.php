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
                            <th>Discrepancy Reason</th>
                            <th>Download</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pdo->bind('employeeId', $_SESSION['authId']);
                        $recEmpData = $pdo->query(
                            'SELECT * FROM salary  WHERE `employee_id`=:employeeId ORDER BY `date` LIMIT 5;'
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