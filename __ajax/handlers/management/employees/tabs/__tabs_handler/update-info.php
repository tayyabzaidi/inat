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


$qs['empId'] = (isset($_POST['__info_tab_action_on'])) ? $lib->sanitizeTheVar($_POST['__info_tab_action_on']) : '';
$qs['empCode'] = (isset($_POST['empCode'])) ? $lib->sanitizeTheVar($_POST['empCode']) : '';
$qs['info_joindate'] = (isset($_POST['info_joindate'])) ? $lib->sanitizeTheVar($_POST['info_joindate']) : '';


$qs['groId'] = (isset($_POST['groId'])) ? $lib->sanitizeTheVar($_POST['groId']) : '';
$qs['desigId'] = (isset($_POST['desigId'])) ? $lib->sanitizeTheVar($_POST['desigId']) : '';
$qs['deptId'] = (isset($_POST['deptId'])) ? $lib->sanitizeTheVar($_POST['deptId']) : '';

$qs['info_fullname_en'] = (isset($_POST['info_fullname_en'])) ? $lib->sanitizeTheVar($_POST['info_fullname_en']) : '';
$qs['info_fullname_ar'] = (isset($_POST['info_fullname_ar'])) ? $lib->sanitizeTheVar($_POST['info_fullname_ar']) : '';
$qs['info_fathername_en'] = (isset($_POST['info_fathername_en'])) ? $lib->sanitizeTheVar($_POST['info_fathername_en']) : '';
$qs['info_fathername_ar'] = (isset($_POST['info_fathername_ar'])) ? $lib->sanitizeTheVar($_POST['info_fathername_ar']) : '';


$qs['info_dob'] = (isset($_POST['info_dob'])) ? $lib->sanitizeTheVar($_POST['info_dob']) : '';
$qs['info_gender'] = (isset($_POST['info_gender'])) ? $lib->sanitizeTheVar($_POST['info_gender']) : '';
$qs['info_maritalstatus'] = (isset($_POST['info_maritalstatus'])) ? $lib->sanitizeTheVar($_POST['info_maritalstatus']) : '';
$qs['info_countrycode'] = (isset($_POST['info_countrycode'])) ? $lib->sanitizeTheVar($_POST['info_countrycode']) : '';




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


if (isset($_SESSION['msg'])) {
    $_r['content']['status'] = true;
    $_r['content']['container'] = '_tab_info_form_response';
    $_r['content']['content'] = $lib->_printMsg('e', "Invalid Input");
} else {

    $pdo->bindMore($qs);
    $uQuery = "UPDATE employees SET
        
                    `empCode`=:empCode ,
                    `info_joindate`=:info_joindate ,
                    
                    `groId`=:groId ,
                    `desigId`=:desigId ,
                    `deptId`=:deptId,
                    
                    `info_fullname_en`=:info_fullname_en,
                    `info_fullname_ar`=:info_fullname_ar,
                    `info_fathername_en`=:info_fathername_en,
                    `info_fathername_ar`=:info_fathername_ar,
                    
                    `info_dob`=:info_dob,
                    `info_gender`=:info_gender,
                    `info_maritalstatus`=:info_maritalstatus,
                    `info_countrycode`=:info_countrycode

                WHERE `empId`=:empId  ";

    if ($pdo->query($uQuery)) {
        
        $_SESSION['msg'][] = "Updated Successfully";
        $_r['content']['status'] = true;
        $_r['content']['container'] = '_tab_info_form_response';
        $_r['content']['content'] = $lib->_printMsg('s', 'Notification');


        $_r['callback']['status'] = true;
        $_r['callback']['name'][] = 'cb_reload__table';
        
    } else {
        
        $_SESSION['msg'][] = $lib->_('Error in saving the data. Contact Admin.');
        $_r['content']['status'] = true;
        $_r['content']['container'] = '_tab_info_form_response';
        $_r['content']['content'] = $lib->_printMsg('e', 'System Error');
        
    }
}

echo json_encode($_r);
