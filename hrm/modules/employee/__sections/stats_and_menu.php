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
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card shadow mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item disabled">
                                <h5 class="p-0 m-0"> <i class="fa fas  fa-tasks"></i> Applications</h5>
                            </li>

                            <li class="list-group-item">
                                <a href="<?php echo __APP_URL__ . $route->q . '/leaves'; ?>"><i
                                        class="fa fas  fa-arrow-<?php echo $_right; ?>"></i> Leaves</a>
                            </li>

                            <li class="list-group-item">
                                <a href="<?php echo __APP_URL__ . $route->q . '/visa'; ?>"><i
                                        class="fa fas  fa-arrow-<?php echo $_right; ?>"></i> Visas</a>
                            </li>

                            <li class="list-group-item">
                                <a href="<?php echo __APP_URL__ . $route->q . '/encashment'; ?>"><i
                                        class="fa fas  fa-arrow-<?php echo $_right; ?>"></i> Encashment</a>
                            </li>
                            <li class="list-group-item">
                                <a href="<?php echo __APP_URL__ . $route->q . '/salary'; ?>"><i
                                        class="fa fas  fa-arrow-<?php echo $_right; ?>"></i> Salary Slips</a>
                            </li>
                            <li class="list-group-item">
                                <a href="<?php echo __APP_URL__ . $route->q . '/expense'; ?>"><i
                                        class="fa fas  fa-arrow-<?php echo $_right; ?>"></i> Expense</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <?php $rSet = $stats->__emp_get_type_balance(__EMP_ID, 'leave'); ?>
                <?php if (count($rSet)) { ?>
                    <div class="row">
                        <div class="col-sm-12 p-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item disabled">
                                    <h5 class="p-0 m-0"> <i class="fa fas  fa-tasks"></i> Vacation Balances</h5>
                                </li>
                                <li class="list-group-item">
                                    <table class="table table-sm table-responsive-sm table-striped"
                                        style="width:100%; font-size: 0.8em;">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Entitled</th>
                                                <th>Available</th>
                                                <th>Used</th>
                                                <th>Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($i = 0; $i < count($rSet); $i++) { ?>
                                                <tr>
                                                    <td><?php echo $rSet[$i]['name']; ?> </td>
                                                    <td><?php echo $rSet[$i]['defaultValue']; ?> </td>
                                                    <td><?php echo $rSet[$i]['currentValue']; ?> </td>
                                                    <td><?php echo $rSet[$i]['usedValue']; ?> </td>
                                                    <td><?php echo ($rSet[$i]['currentValue'] - $rSet[$i]['usedValue']); ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                </li>
                            </ul>
                        </div>
                    </div>
                <?php } ?>

                <?php $rSet = $stats->__emp_get_type_balance(__EMP_ID, 'visa'); ?>
                <?php if (count($rSet)) { ?>
                    <div class="row">
                        <div class="col-sm-12 p-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item disabled">
                                    <h5 class="p-0 m-0"> <i class="fa fas  fa-tasks"></i> Allowed Visas</h5>
                                </li>

                                <li class="list-group-item">
                                    <table class="table table-sm table-responsive-sm table-striped"
                                        style="width:100%; font-size: 0.8em;">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Entitled</th>
                                                <th>Available</th>
                                                <th>Used</th>
                                                <th>Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($i = 0; $i < count($rSet); $i++) { ?>
                                                <tr>
                                                    <td><?php echo $rSet[$i]['name']; ?> </td>
                                                    <td><?php echo $rSet[$i]['defaultValue']; ?> </td>
                                                    <td><?php echo $rSet[$i]['currentValue']; ?> </td>
                                                    <td><?php echo $rSet[$i]['usedValue']; ?> </td>
                                                    <td><?php echo ($rSet[$i]['currentValue'] - $rSet[$i]['usedValue']); ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                </li>
                            </ul>
                        </div>
                    </div>
                <?php } ?>


                <?php $rSet = $stats->__emp_get_type_balance(__EMP_ID, 'ticket'); ?>
                <?php if (count($rSet)) { ?>
                    <div class="row">
                        <div class="col-sm-12 p-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item disabled">
                                    <h5 class="p-0 m-0"> <i class="fa fas  fa-tasks"></i> Tickets</h5>
                                </li>

                                <li class="list-group-item">
                                    <table class="table table-sm table-responsive-sm table-striped"
                                        style="width:100%; font-size: 0.8em;">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Entitled</th>
                                                <th>Available</th>
                                                <th>Used</th>
                                                <th>Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php for ($i = 0; $i < count($rSet); $i++) { ?>
                                                <tr>
                                                    <td><?php echo $rSet[$i]['name']; ?> </td>
                                                    <td><?php echo $rSet[$i]['defaultValue']; ?> </td>
                                                    <td><?php echo $rSet[$i]['currentValue']; ?> </td>
                                                    <td><?php echo $rSet[$i]['usedValue']; ?> </td>
                                                    <td><?php echo ($rSet[$i]['currentValue'] - $rSet[$i]['usedValue']); ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                </li>


                            </ul>
                        </div>

                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>