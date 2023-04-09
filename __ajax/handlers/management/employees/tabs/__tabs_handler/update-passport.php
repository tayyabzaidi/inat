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


$qs['empId'] = (isset($_POST['__passport_tab_action_on'])) ? $lib->sanitizeTheVar($_POST['__passport_tab_action_on']) : '';
$qs['passport_number'] = (isset($_POST['passport_number'])) ? $lib->sanitizeTheVar($_POST['passport_number']) : '';
$qs['passport_issued_by'] = (isset($_POST['passport_issued_by'])) ? $lib->sanitizeTheVar($_POST['passport_issued_by']) : '';
$qs['passport_issue_date'] = (isset($_POST['passport_issue_date'])) ? $lib->sanitizeTheVar($_POST['passport_issue_date']) : '';
$qs['passport_expire_date'] = (isset($_POST['passport_expire_date'])) ? $lib->sanitizeTheVar($_POST['passport_expire_date']) : '';


if (isset($_SESSION['msg'])) {
    $_r['content']['status'] = true;
    $_r['content']['container'] = '_tab_passport_form_response';
    $_r['content']['content'] = $lib->_printMsg('e', "Invalid Input");
} else {

    $pdo->bindMore($qs);
    $uQuery = "UPDATE employees SET
        
                    `passport_number`=:passport_number ,
                    `passport_issued_by`=:passport_issued_by ,
                    `passport_issue_date`=:passport_issue_date ,
                    `passport_expire_date`=:passport_expire_date

                WHERE `empId`=:empId ; ";

    if ($pdo->query($uQuery)) {


        $_SESSION['msg'][] = "Updated Successfully";
        $_r['content']['status'] = true;
        $_r['content']['container'] = '_tab_passport_form_response';
        $_r['content']['content'] = $lib->_printMsg('s', 'Notification');


        $_r['callback']['status'] = true;
        $_r['callback']['name'][] = 'cb_reload__table';
        
    } else {

        $_SESSION['msg'][] = $lib->_('Error in saving the data. Contact Admin.');
        $_r['content']['status'] = true;
        $_r['content']['container'] = '_tab_passport_form_response';
        $_r['content']['content'] = $lib->_printMsg('e', 'System Error');
    }
}

echo json_encode($_r);
