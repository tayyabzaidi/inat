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


$qs['empId'] = (isset($_POST['__iden_tab_action_on'])) ? $lib->sanitizeTheVar($_POST['__iden_tab_action_on']) : '';
$qs['id_is_national'] = (isset($_POST['id_is_national'])) ? $lib->sanitizeTheVar($_POST['id_is_national']) : '';
$qs['id_no'] = (isset($_POST['id_no'])) ? $lib->sanitizeTheVar($_POST['id_no']) : '';
$qs['id_expiry_date_en'] = (isset($_POST['id_expiry_date_en'])) ? $lib->sanitizeTheVar($_POST['id_expiry_date_en']) : '';
$qs['id_religion'] = (isset($_POST['id_religion'])) ? $lib->sanitizeTheVar($_POST['id_religion']) : '';

if (trim($qs['id_no']) == '') {
    $_SESSION['msg'][] = "Invalid I.D Number";
} else {
    $pdo->bind("id_no", $qs['id_no']);
    $pdo->bind("not_empId", $qs['empId']);
    $rSet = $pdo->query("SELECT * FROM employees WHERE id_no=:id_no AND empId!=:not_empId ;");
    if (count($rSet)) {
        $_SESSION['msg'][] = "I.D/Moqeem  already exists";
    }
}


if (isset($_SESSION['msg'])) {
    $_r['content']['status'] = true;
    $_r['content']['container'] = '_tab_iden_form_response';
    $_r['content']['content'] = $lib->_printMsg('e', "Invalid Input");
} else {

    $pdo->bindMore($qs);
    $uQuery = "UPDATE employees SET
        
                    `id_is_national`=:id_is_national ,
                    `id_no`=:id_no ,
                    `id_expiry_date_en`=:id_expiry_date_en ,
                    `id_religion`=:id_religion

                WHERE `empId`=:empId ; ";

    if ($pdo->query($uQuery)) {
        
        
        
        $_SESSION['msg'][] = "Updated Successfully";
        $_r['content']['status'] = true;
        $_r['content']['container'] = '_tab_iden_form_response';
        $_r['content']['content'] = $lib->_printMsg('s', 'Notification');


        $_r['callback']['status'] = true;
        $_r['callback']['name'][] = 'cb_reload__table';
        
    } else {
        
        $_SESSION['msg'][] = $lib->_('Error in saving the data. Contact Admin.');
        $_r['content']['status'] = true;
        $_r['content']['container'] = '_tab_iden_form_response';
        $_r['content']['content'] = $lib->_printMsg('e', 'System Error');
        
    }
}

echo json_encode($_r);
