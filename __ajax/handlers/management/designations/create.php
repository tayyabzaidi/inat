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


$qs['name'] = (isset($_POST['name'])) ? $lib->sanitizeTheVar($_POST['name']) : '';

if (trim($qs['name']) == '') {
    $_SESSION['msg'][] = "Designation name can not be blank";
} else {

    $pdo->bind("name", $qs['name']);
    $rSet = $pdo->query("SELECT * FROM employee_designations WHERE name=:name ;");
    if (count($rSet)) {
        $_SESSION['msg'][] = "Designation name already exists";
    }
}

if (isset($_SESSION['msg'])) {
    $_r['content']['status'] = true;
    $_r['content']['container'] = '_create_record_modal_response_box';
    $_r['content']['content'] = $lib->_printMsg('e', "Invalid Input");
} else {

    $pdo->bind('desigId', NULL);
    $pdo->bind('name', $qs['name']);
    $pdo->bind('status', 'active');

    $iQuery = " INSERT INTO employee_designations SET
                `desigId`=:desigId ,
                `name`=:name ,
                `status`=:status ";

    $pdo->query($iQuery);

    $__inrecid = $pdo->lastInsertId();

    if ($__inrecid) {
        $_SESSION['msg'][] = "Designation Added Successfully";
        $_r['content']['status'] = true;
        $_r['content']['container'] = '_create_record_modal_response_box';
        $_r['content']['content'] = $lib->_printMsg('s', 'notification');

        /*
         * Refresh Data Callback.
         */

        $_r['callback']['status'] = true;
        $_r['callback']['name'][] = 'cb_reload__table';
        
    } else {
        $_SESSION['msg'][] = $lib->_('Error in saving the data. Contact Admin.');
        $_r['content']['status'] = true;
        $_r['content']['container'] = '_create_record_modal_response_box';
        $_r['content']['content'] = $lib->_printMsg('e', 'System Error');
    }
}

echo json_encode($_r);
