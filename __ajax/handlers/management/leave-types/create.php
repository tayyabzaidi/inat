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
$qs['days'] = (isset($_POST['days'])) ? $lib->sanitizeTheVar($_POST['days']) : 0;
$qs['resetmode'] = (isset($_POST['resetmode'])) ? $lib->sanitizeTheVar($_POST['resetmode']) : '';
$qs['carryover'] = (isset($_POST['carryover'])) ? $lib->sanitizeTheVar($_POST['carryover']) : '';


if (trim($qs['name']) == '') {
    $_SESSION['msg'][] = "Type name can not be blank";
} else {
    $pdo->bind("name", $qs['name']);
    $rSet = $pdo->query("SELECT * FROM request_types WHERE name=:name ;");
    if (count($rSet)) {
        $_SESSION['msg'][] = "Type name already exists.";
    }
}

if (!$qs['days'] || $qs['days'] <= 0) {
    $_SESSION['msg'][] = "Invalid Days. No of days associated with leave are mandatory";
}

if (isset($_SESSION['msg'])) {
    $_r['content']['status'] = true;
    $_r['content']['container'] = '_create_record_modal_response_box';
    $_r['content']['content'] = $lib->_printMsg('e', "Invalid Input");
} else {


    $qs['id'] = NULL;
    $qs['type'] = 'leave';
    $qs['status'] = 'active';

    $pdo->bindMore($qs);


    $iQuery = " INSERT INTO request_types SET
                `id`=:id ,
                `type`=:type ,
                `name`=:name ,
                `days`=:days ,
                `resetmode`=:resetmode ,
                `carryover`=:carryover ,
                `status`=:status ";

    
    $pdo->query($iQuery);
    $__inrecid = $pdo->lastInsertId();

    if ($__inrecid) {
        $_SESSION['msg'][] = "Leave Type Added Successfully";
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
