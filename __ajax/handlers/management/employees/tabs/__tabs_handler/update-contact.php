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


$qs['empId'] = (isset($_POST['__contact_tab_action_on'])) ? $lib->sanitizeTheVar($_POST['__contact_tab_action_on']) : '';
$qs['info_phone'] = (isset($_POST['info_phone'])) ? $lib->sanitizeTheVar($_POST['info_phone']) : '';
$qs['info_extention'] = (isset($_POST['info_extention'])) ? $lib->sanitizeTheVar($_POST['info_extention']) : '';
$qs['info_fax'] = (isset($_POST['info_fax'])) ? $lib->sanitizeTheVar($_POST['info_fax']) : '';
$qs['info_mobile'] = (isset($_POST['info_mobile'])) ? $lib->sanitizeTheVar($_POST['info_mobile']) : '';
$qs['info_homephone'] = (isset($_POST['info_homephone'])) ? $lib->sanitizeTheVar($_POST['info_homephone']) : '';
$qs['info_homeaddress'] = (isset($_POST['info_homeaddress'])) ? $lib->sanitizeTheVar($_POST['info_homeaddress']) : '';


/*
if (trim($qs['empCode']) == '') {
    $_SESSION['msg'][] = "Invalid Employment code";
} else {
    $pdo->bind("empCode", $qs['empCode']);
    $pdo->bind("not_empId", $qs['empId']);
    $rSet = $pdo->query("SELECT * FROM employees WHERE empCode=:empCode AND empId!=:not_empId ;");
    if (count($rSet)) {
        $_SESSION['msg'][] = "Employemet code already exists";
    }
}
 */


if (isset($_SESSION['msg'])) {
    $_r['content']['status'] = true;
    $_r['content']['container'] = '_tab_contact_form_response';
    $_r['content']['content'] = $lib->_printMsg('e', "Invalid Input");
} else {

    $pdo->bindMore($qs);
    $uQuery = "UPDATE employees SET
        
                    `info_phone`=:info_phone ,
                    `info_extention`=:info_extention ,
                    `info_fax`=:info_fax ,
                    `info_mobile`=:info_mobile ,
                    `info_homephone`=:info_homephone,
                    `info_homeaddress`=:info_homeaddress

                WHERE `empId`=:empId ; ";

    if ($pdo->query($uQuery)) {
        
        
        
        $_SESSION['msg'][] = "Updated Successfully";
        $_r['content']['status'] = true;
        $_r['content']['container'] = '_tab_contact_form_response';
        $_r['content']['content'] = $lib->_printMsg('s', 'Notification');


        $_r['callback']['status'] = true;
        $_r['callback']['name'][] = 'cb_reload__table';
        
    } else {
        
        $_SESSION['msg'][] = $lib->_('Error in saving the data. Contact Admin.');
        $_r['content']['status'] = true;
        $_r['content']['container'] = '_tab_contact_form_response';
        $_r['content']['content'] = $lib->_printMsg('e', 'System Error');
        
    }
}

echo json_encode($_r);
