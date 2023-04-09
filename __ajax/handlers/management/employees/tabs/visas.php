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


/*
 * User Leaves Management 
 */
#$__action_on  // eb.empId
$__action_for = 'visa'; //rt.type='leave'

$pdo->bind("empId", $__action_on);
$pdo->bind("type", $__action_for);
$pdo->bind("rt_type", $__action_for);
$emp_type_data = $pdo->query("SELECT eb.*,rt.*

                               FROM employee_balances AS eb

                               LEFT JOIN request_types AS  rt ON (rt.id =eb.typId AND rt.type=:type)

                               WHERE eb.empId =:empId AND rt.type=:rt_type ORDER BY rt.id ASC ");

/*
 * User Leaves Management 
 */
?>
<div class="tab-pane fade" id="visas" aria-labelledby="visas-tab" role="tabpanel" >
    <div class="container">
        <br>
        <h4>Visas Configurations</h4>
        <hr>
        <div id="_tab_visa_form_response"></div>


        <table class="_generic_data_table table table-sm table-responsive-sm table-condensed table-striped table-hover " style="width:100%">
            <thead>
                <tr>
                    <th>I.D</th>
                    <th>Type<BR>Status</th>
                    <th>Name</th>
                    <th>Total<BR>Allowed</th>
                    <th>Current<BR>Balance</th>
                    <th>Is<BR>Entitled</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($emp_type_data); $i++) { ?>
                    <?php
                    $idStr = $emp_type_data[$i]['empId'] . $emp_type_data[$i]['typId'];
                    ?>
                    <tr>
                        <td><?php echo $emp_type_data[$i]['typId']; ?> </td>
                        <td><?php echo $emp_type_data[$i]['status']; ?> </td>
                        <td><?php echo $emp_type_data[$i]['name']; ?> </td>
                        <td>
                            <input  type="number" 
                                    value="<?php echo $emp_type_data[$i]['defaultValue']; ?>" 
                                    name="defaultValue_<?php echo $idStr; ?>" 
                                    id="defaultValue_<?php echo $idStr; ?>" 
                                    class="form-control form-control-md"
                                    style="width:100px;"
                                    min="0"
                                    onchange="__update_type_feild('<?php echo $emp_type_data[$i]['empId']; ?>', <?php echo $emp_type_data[$i]['typId']; ?>, 'visa', 'default', this.value)"
                                    >

                        </td>
                        <td>
                            <input  type="number" 
                                    value="<?php echo $emp_type_data[$i]['currentValue']; ?>" 
                                    name="currentValue_<?php echo $idStr; ?>" 
                                    id="currentValue_<?php echo $idStr; ?>" 
                                    class="form-control form-control-md"
                                    style="width:100px;"
                                    min="0"
                                    onchange="__update_type_feild('<?php echo $emp_type_data[$i]['empId']; ?>', <?php echo $emp_type_data[$i]['typId']; ?>, 'visa', 'current', this.value)"
                                    >

                        </td>
                        <td>
                            <?php
                            $typStatusCheck = ($emp_type_data[$i]['typStatus'] == 'active') ? ' checked ' : '';
                            ?>
                            <input data-offstyle="danger" 
                                   data-width="100" <?php echo $typStatusCheck; ?>   
                                   data-on="Yes" 
                                   data-off="No"  
                                   name="typStatus_<?php echo $idStr; ?>" 
                                   id="typStatus_<?php echo $idStr; ?>" 
                                   class="bootstrapToggleInit" 
                                   type="checkbox"  
                                   data-toggle="toggle"  
                                   data-style="ios" 
                                   onchange="__update_type_feild('<?php echo $emp_type_data[$i]['empId']; ?>', <?php echo $emp_type_data[$i]['typId']; ?>, 'visa', 'entitment', this.checked)"
                                   >

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>


    </div>

    <div class="modal-footer m-0 p-0">
    </div>

</div>



