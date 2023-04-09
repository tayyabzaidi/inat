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


$qs['id'] = (isset($_POST['__action_on'])) ? $lib->sanitizeTheVar($_POST['__action_on']) : '';
$qs['name'] = (isset($_POST['e_name'])) ? $lib->sanitizeTheVar($_POST['e_name']) : '';
$qs['days'] = (isset($_POST['e_days'])) ? $lib->sanitizeTheVar($_POST['e_days']) : '';
$qs['resetmode'] = (isset($_POST['e_resetmode'])) ? $lib->sanitizeTheVar($_POST['e_resetmode']) : '';
$qs['carryover'] = (isset($_POST['e_carryover'])) ? $lib->sanitizeTheVar($_POST['e_carryover']) : '';
$qs['status'] = (isset($_POST['e_status'])) ? $lib->sanitizeTheVar($_POST['e_status']) : '';




if (trim($qs['name']) == '') {
    $_SESSION['msg'][] = "Type name can not be blank";
} else {

    $pdo->bind("name", $qs['name']);
    $pdo->bind("not_id", $qs['id']);
    $rSet = $pdo->query("SELECT * FROM request_types WHERE name=:name AND id!=:not_id ;");
    if (count($rSet)) {
        $_SESSION['msg'][] = "Type name already exists";
    }
}

if (isset($_SESSION['msg'])) {
    $_r['content']['status'] = true;
    $_r['content']['container'] = '_update_record_ajax_response';
    $_r['content']['content'] = $lib->_printMsg('e', "Invalid Input");
} else {

    $pdo->bindMore($qs);
    $uQuery = "UPDATE request_types SET 
                `name`=:name ,
                `days`=:days ,  
                `resetmode`=:resetmode ,  
                `carryover`=:carryover ,  
                `status`=:status 
                WHERE `id`=:id ; ";

    if ($pdo->query($uQuery)) {
        $_SESSION['msg'][] = "Type Updated Successfully";
        $_r['content']['status'] = true;
        $_r['content']['container'] = '_update_record_ajax_response';
        $_r['content']['content'] = $lib->_printMsg('s', 'notification');

        /*
         * Refresh Data Callback.
         */

        $_r['callback']['status'] = true;
        $_r['callback']['name'][] = 'cb_reload__table';
        $_r['callback']['name'][] = 'cb_close_the_editor';
        
    } else {
        $_SESSION['msg'][] = $lib->_('Error in saving the data. Contact Admin.');
        $_r['content']['status'] = true;
        $_r['content']['container'] = '_update_record_ajax_response';
        $_r['content']['content'] = $lib->_printMsg('e', 'System Error');
    }
}

echo json_encode($_r);
