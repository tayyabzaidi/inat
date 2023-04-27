<?php
/*
 * Copyright (C) 2015 Zeeshan Abbas <zeeshan@iibsys.com> <+966 55 4137245>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */
define('__SECTION_JS_PATH_', '__js/admin.script.php');
?>

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
</style>

<div class="container-fluid">
    <div id="_php_error_response"></div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    </div>

    <div class="row">
        <div class="col-xl-2 col-md-2 mb-4">
            <div class="card border-left-warning shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Employees</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo $stats->__get_active_employees(); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="<?php echo __APP_URL__ . 'management/employees'; ?>" style="font-size: 13px; text-decoration: underline;"><i class="fa fa-edit"></i> Manage
                        Employees</a>
                </div>

            </div>
        </div>


        <div class="col-xl-2 col-md-2 mb-4">
            <div class="card border-left-success shadow h-100 ">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Departments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo $stats->__get_active_departments(); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="<?php echo __APP_URL__ . 'management/departments'; ?>" style="font-size: 13px; text-decoration: underline;"><i class="fa  fa-edit"></i> Manage
                        Departments</a>
                </div>
            </div>
        </div>


        <div class="col-xl-2 col-md-2 mb-4">
            <div class="card border-left-info shadow h-100 ">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Manage Types</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <ul style="font-size:13px; list-style: none; margin: 2px; padding: 0px; padding-top:5px;">
                                    <li><a href="<?php echo __APP_URL__ . 'management/leave-types'; ?>" style="font-size: 13px;"><i class="fa  fa-arrow-<?php echo $_right; ?>"></i>
                                            Leaves</a></li>
                                    <li><a href="<?php echo __APP_URL__ . 'management/visa-types'; ?>" style="font-size: 13px; line-height: 2;"><i class="fa  fa-arrow-<?php echo $_right; ?>"></i> Visas</a></li>
                                    <li><a href="<?php echo __APP_URL__ . 'management/ticket-types'; ?>" style="font-size: 13px;"><i class="fa  fa-arrow-<?php echo $_right; ?>"></i>
                                            Tickets</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">

                <div class="card-body">

                    <h3>Recently Added Employees</h3>
                    <hr>

                    <div class="mb-2" align="<?php echo $_right; ?>">
                        <a href="<?php echo __APP_URL__ . 'management/employees'; ?>" class="btn btn-md btn-primary"> <i class="fa fa-1x fa-users"></i> Manage Employees </a>
                    </div>
                    <table class="table table-sm table-responsive-sm table-condensed table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>I.D</th>
                                <th>Code</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $recEmpData = $pdo->query("SELECT * FROM employees WHERE `empRecStatus`='active' ORDER BY empId DESC LIMIT 5;"); ?>
                            <?php for ($i = 0; $i < count($recEmpData); $i++) { ?>
                                <tr>
                                    <td><?php echo $recEmpData[$i]['empId']; ?> </td>
                                    <td><?php echo $recEmpData[$i]['empCode']; ?> </td>
                                    <td><?php echo $recEmpData[$i]['info_fullname_en']; ?> </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" style="width: 98%;margin-left: 1%;">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">

            <div class="card-body">
                <h3>Claim List</h3>
                <hr>
                <div class="mb-2" align="<?php echo $_right; ?>">
                    <a href="<?php echo __APP_URL__ . 'management/expenses'; ?>" class="btn btn-md btn-primary"> <i class="fa fa-1x fa-users"></i> Manage Expense Claims </a>
                </div>


                <table class="table table-sm table-responsive-sm table-condensed table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>I.D</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Total Amount</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pdo->bind('employeeId', 1);
                        $recEmpData = $pdo->query(
                            'SELECT ee.*,e.info_fullname_en as `name` FROM employee_expenses ee join employees e on e.empId=ee.employee_id WHERE `employee_id`=:employeeId ORDER BY `date` LIMIT 5;'
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
                                <td><?php echo $recEmpData[$i]['total_amount']; ?>
                                </td>
                            <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="row" style="width: 98%;margin-left: 1%;">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">

            <div class="card-body">


                <div class="card-body">
                    <?php $recEmpData = $pdo->query(
                        'select el.*,e.info_fullname_en as name from employee_leaves el inner join employees e on e.empId=el.emp_id order by id desc limit 5'
                    );
                    ?>
                    <h3>Leave List</h3>
                    <hr>
                    <div class="mb-2" align="<?php echo $_right; ?>">
                        <a href="<?php echo __APP_URL__ . 'management/leave-management'; ?>" class="btn btn-md btn-primary"> <i class="fa fa-1x fa-users"></i> Manage Leave Requests</a>
                    </div>


                    <table class="table table-sm table-responsive-sm table-condensed table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <!-- <th>I.D</th>-->
                                <th>Name</th>
                                <th>No of days</th>
                                <th>Leave type</th>
                                <th>Status</th>
                                <th>PDF</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php for ($i = 0; $i < count($recEmpData); $i++) { ?>
                                <tr>
                                    <!-- <td><?php echo $recEmpData[$i]['id']; ?>
                                    </td>-->
                                    <td><?php echo $recEmpData[$i]['name']; ?>
                                    </td>
                                    <td><?php echo $recEmpData[$i]['no_of_days']; ?>
                                    </td>
                                    <td><?php echo $recEmpData[$i]['leave_type']; ?>
                                    </td>
                                    <td class="" style="text-align: left;">
                                        <?php
                                        $getStatus = $pdo->query(
                                            'SELECT s.status_name from `status` s join employee_leave_status es on s.id=es.statusId where es.leaveId=' . $recEmpData[$i]['id']
                                        );
                                        $HOD = false;
                                        $HR = false;
                                        $OM = false;
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
                                                $HOD = 'disapprove';
                                            } elseif (
                                                $getStatus[$j]['status_name'] ==
                                                'HR_approved'
                                            ) {
                                                $HR = 'approved';
                                            } elseif (
                                                $getStatus[$j]['status_name'] ==
                                                'HR_disapproved'
                                            ) {
                                                $HR = 'disapprove';
                                            } elseif (
                                                $getStatus[$j]['status_name'] ==
                                                'OM_approved'
                                            ) {
                                                $OM = 'approved';
                                            } elseif (
                                                $getStatus[$j]['status_name'] ==
                                                'OM_disapproved'
                                            ) {
                                                $OM = 'disapprove';
                                            }
                                        }
                                        ?>

                                        <div class="ant-tag " style="<?php if (
                                                                            $HOD == 'approved'
                                                                        ) {
                                                                            echo 'background-color: rgb(135, 208, 104); color:white';
                                                                        } elseif ($HOD == 'disapprove') {
                                                                            echo 'background-color: red; color:white';
                                                                        } else {
                                                                            echo 'background-color: white';
                                                                        } ?>">
                                            HOD</div>

                                        <div class="ant-tag " style="<?php if (
                                                                            $HR == 'approved'
                                                                        ) {
                                                                            echo 'background-color: rgb(135, 208, 104); color:white';
                                                                        } elseif ($HR == 'disapprove') {
                                                                            echo 'background-color: red; color:white';
                                                                        } else {
                                                                            echo 'background-color: white';
                                                                        } ?>">
                                            HR</div>
                                        <div class="ant-tag " style="<?php if (
                                                                            $OM == 'approved'
                                                                        ) {
                                                                            echo 'background-color: rgb(135, 208, 104); color:white';
                                                                        } elseif ($OM == 'disapprove') {
                                                                            echo 'background-color: red; color:white';
                                                                        } else {
                                                                            echo 'background-color: white';
                                                                        } ?>">
                                            OM</div>
                                    </td>

                                    <td>
                                        <button class="modal-button" id="employee-data-btn" href="#myModal2" style="background: none;" data-id="<?php echo $recEmpData[$i]['id']; ?>"><i class="fa fa-folder"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>