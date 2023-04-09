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

$__action_on = (isset($_POST['__action_on'])) ? $lib->sanitizeTheVar($_POST['__action_on']) : '';

if ($__action_on) {
    /*
     * Record Set
     */

    $pdo->bind("empId", $__action_on);
    $__action_on_rset = $pdo->row("SELECT * FROM employees WHERE empId=:empId");

    /*
     * Record Set
     */


    /*
     * Required Data
     */


    //Departments
    $pdo->bind('status', 'active');
    $rd_depts = $pdo->query("SELECT * FROM departments WHERE `status`=:status ");


    //Types
    $rd_empgro = $pdo->query("SELECT * FROM employee_groups ORDER BY groId ASC");


    //Designations
    $rd_desig = $pdo->query("SELECT * FROM employee_designations ORDER BY desigId ASC");


    //Countries
    $rd_contr = $pdo->query("SELECT * FROM countries ORDER BY country_code ASC");

    /*
     * Required Data
     */




    /*
     * Type Default Inits (LEAVES)
     */

    $_user_missing_types = [];
    $__action_for = 'leave';
    $pdo->bind('empId', $__action_on);
    $pdo->bind('type', $__action_for);

    $_user_missing_types = $pdo->query("SELECT rt.*,COUNT(eb.typId) AS rExists
                                        FROM request_types AS rt
                                        LEFT JOIN employee_balances AS eb ON (eb.typId=rt.id AND eb.empId=:empId)
                                        WHERE rt.type=:type
                                        GROUP BY rt.id
                                        HAVING rExists=0 ");


    for ($i = 0; $i < count($_user_missing_types); $i++) {
        $iQs['empId'] = $__action_on;
        $iQs['typId'] = $_user_missing_types[$i]['id'];
        $iQs['defaultValue'] = $_user_missing_types[$i]['days'];
        $iQs['currentValue'] = '0';
        $iQs['usedValue'] = '0';
        $iQs['typStatus'] = 'inactive';

        $iQry = "INSERT INTO employee_balances SET
                 empId=:empId ,
                 typId=:typId ,
                 defaultValue=:defaultValue ,
                 currentValue=:currentValue ,
                 usedValue=:usedValue ,
                 typStatus=:typStatus ";

        $pdo->bindMore($iQs);
        if (!$pdo->query($iQry)) {
            $_SESSION['msg'][] = "Error in updating defaults Leaves. Contact Admin";
            echo $lib->_printMsg('e', 'Error!');
        }
    }
    /*
     * Type Default Inits (LEAVES)
     */




    /*
     * Type Default Inits (VISAS)
     */

    $_user_missing_types = [];
    $__action_for = 'visa';
    $pdo->bind('empId', $__action_on);
    $pdo->bind('type', $__action_for);

    $_user_missing_types = $pdo->query("SELECT rt.*,COUNT(eb.typId) AS rExists
                                        FROM request_types AS rt
                                        LEFT JOIN employee_balances AS eb ON (eb.typId=rt.id AND eb.empId=:empId)
                                        WHERE rt.type=:type
                                        GROUP BY rt.id
                                        HAVING rExists=0 ");


    for ($i = 0; $i < count($_user_missing_types); $i++) {
        $iQs['empId'] = $__action_on;
        $iQs['typId'] = $_user_missing_types[$i]['id'];
        $iQs['defaultValue'] = $_user_missing_types[$i]['days'];
        $iQs['currentValue'] = '0';
        $iQs['usedValue'] = '0';
        $iQs['typStatus'] = 'inactive';

        $iQry = "INSERT INTO employee_balances SET
                 empId=:empId ,
                 typId=:typId ,
                 defaultValue=:defaultValue ,
                 currentValue=:currentValue ,
                 usedValue=:usedValue ,
                 typStatus=:typStatus ";

        $pdo->bindMore($iQs);
        if (!$pdo->query($iQry)) {
            $_SESSION['msg'][] = "Error in updating defaults Leaves. Contact Admin";
            echo $lib->_printMsg('e', 'Error!');
        }
    }
    /*
     * Type Default Inits (VISAS)
     */








    /*
     * Type Default Inits (TICKETS)
     */

    $_user_missing_types = [];
    $__action_for = 'ticket';
    $pdo->bind('empId', $__action_on);
    $pdo->bind('type', $__action_for);

    $_user_missing_types = $pdo->query("SELECT rt.*,COUNT(eb.typId) AS rExists
                                        FROM request_types AS rt
                                        LEFT JOIN employee_balances AS eb ON (eb.typId=rt.id AND eb.empId=:empId)
                                        WHERE rt.type=:type
                                        GROUP BY rt.id
                                        HAVING rExists=0 ");


    for ($i = 0; $i < count($_user_missing_types); $i++) {
        $iQs['empId'] = $__action_on;
        $iQs['typId'] = $_user_missing_types[$i]['id'];
        $iQs['defaultValue'] = $_user_missing_types[$i]['days'];
        $iQs['currentValue'] = '0';
        $iQs['usedValue'] = '0';
        $iQs['typStatus'] = 'inactive';

        $iQry = "INSERT INTO employee_balances SET
                 empId=:empId ,
                 typId=:typId ,
                 defaultValue=:defaultValue ,
                 currentValue=:currentValue ,
                 usedValue=:usedValue ,
                 typStatus=:typStatus ";

        $pdo->bindMore($iQs);
        if (!$pdo->query($iQry)) {
            $_SESSION['msg'][] = "Error in updating defaults Leaves. Contact Admin";
            echo $lib->_printMsg('e', 'Error!');
        }
    }
    /*
     * Type Default Inits (TICKETS)
     */
} else {
    die("Invalid request.");
}
?>

<div class="modal-header">
    <h4 class="modal-title" id="_create_record_modal_label">Employee Management</h4>
    <button class="btn btn-sm btn-primary btn-default btn-icon-split" type="button" data-dismiss="modal">
        <span class="icon text-white-100"><i class="fas fa-times"></i></span>
    </button>
</div>


<nav class="navbar sticky-top navbar-light bg-light m-0 p-0" >
    <ul class="nav nav-tabs pt-1 pl-1 pr-1" id="inputTabs" role="tablist" style="width:100%;"> 
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">Details</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
        </li>

        <li class="nav-item" role="presentation">
            <a class="nav-link" id="iden-tab" data-toggle="tab" href="#iden" role="tab" aria-controls="iden" aria-selected="false">I.D</a>
        </li>

        <li class="nav-item" role="presentation">
            <a class="nav-link" id="salary-tab" data-toggle="tab" href="#salary" role="tab" aria-controls="salary" aria-selected="false">Salary</a>
        </li>

        <li class="nav-item" role="presentation">
            <a class="nav-link" id="passport-tab" data-toggle="tab" href="#passport" role="tab" aria-controls="passport" aria-selected="false">Passport</a>
        </li>


        <li class="nav-item" role="presentation">
            <a class="nav-link" id="access-tab" data-toggle="tab" href="#access" role="tab" aria-controls="access" aria-selected="false">Access Control</a>
        </li>

        <li class="nav-item" role="presentation">
            <a class="nav-link" id="leaves-tab" data-toggle="tab" href="#leaves" role="tab" aria-controls="leaves" aria-selected="false">Leaves</a>
        </li>


        <li class="nav-item" role="presentation">
            <a class="nav-link" id="visas-tab" data-toggle="tab" href="#visas" role="tab" aria-controls="visas" aria-selected="false">Visas</a>
        </li>

        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tickets-tab" data-toggle="tab" href="#tickets" role="tab" aria-controls="tickets" aria-selected="false">Tickets</a>
        </li>
    </ul>
</nav>



<div class="tab-content mt-2" id="inputTabsContent">
    <?php require('tabs/info.php'); ?>
    <?php require('tabs/contact.php'); ?>
    <?php require('tabs/iden.php'); ?>
    <?php require('tabs/salary.php'); ?>
    <?php require('tabs/passport.php'); ?>
    <?php require('tabs/access.php'); ?>
    <?php require('tabs/leaves.php'); ?>
    <?php require('tabs/visas.php'); ?>
    <?php require('tabs/tickets.php'); ?>
</div>



