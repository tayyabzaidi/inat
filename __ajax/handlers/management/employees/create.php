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


$qs['empCode'] = (isset($_POST['_create_empCode'])) ? $lib->sanitizeTheVar($_POST['_create_empCode']) : '';
$qs['info_joindate'] = (isset($_POST['_create_info_joindate'])) ? $lib->sanitizeTheVar($_POST['_create_info_joindate']) : '';

$qs['deptId'] = (isset($_POST['_create_deptId'])) ? $lib->sanitizeTheVar($_POST['_create_deptId']) : '';
$qs['groId'] = (isset($_POST['_create_groId'])) ? $lib->sanitizeTheVar($_POST['_create_groId']) : '';
$qs['desigId'] = (isset($_POST['_create_desigId'])) ? $lib->sanitizeTheVar($_POST['_create_desigId']) : '';

$qs['info_fullname_en'] = (isset($_POST['_create_info_fullname_en'])) ? $lib->sanitizeTheVar($_POST['_create_info_fullname_en']) : '';
$qs['info_fathername_en'] = (isset($_POST['_create_info_fathername_en'])) ? $lib->sanitizeTheVar($_POST['_create_info_fathername_en']) : '';
$qs['info_fullname_ar'] = (isset($_POST['_create_info_fullname_ar'])) ? $lib->sanitizeTheVar($_POST['_create_info_fullname_ar']) : '';
$qs['info_fathername_ar'] = (isset($_POST['_create_info_fathername_ar'])) ? $lib->sanitizeTheVar($_POST['_create_info_fathername_ar']) : '';


$qs['info_dob'] = (isset($_POST['_create_info_dob'])) ? $lib->sanitizeTheVar($_POST['_create_info_dob']) : '';
$qs['info_gender'] = (isset($_POST['_create_info_gender'])) ? $lib->sanitizeTheVar($_POST['_create_info_gender']) : '';
$qs['info_maritalstatus'] = (isset($_POST['_create_info_maritalstatus'])) ? $lib->sanitizeTheVar($_POST['_create_info_maritalstatus']) : '';
$qs['info_countrycode'] = (isset($_POST['_create_info_countrycode'])) ? $lib->sanitizeTheVar($_POST['_create_info_countrycode']) : '';


if (trim($qs['empCode']) == '') {
    $_SESSION['msg'][] = "Invalid Employment code";
} else {
    $pdo->bind("empCode", $qs['empCode']);
    $rSet = $pdo->query("SELECT * FROM employees WHERE empCode=:empCode ;");
    if (count($rSet)) {
        $_SESSION['msg'][] = "Employemet code already exists";
    }
}



if (isset($_SESSION['msg'])) {
    $_r['content']['status'] = true;
    $_r['content']['container'] = '_create_record_modal_response_box';
    $_r['content']['content'] = $lib->_printMsg('e', "Invalid Input");
    
} else {

    $qs['empId'] = NULL;
    $qs['empRecStatus'] = 'active';
    $pdo->bindMore($qs);

    $iQuery = " INSERT INTO employees SET
        
                `empId`=:empId ,
                `empCode`=:empCode ,
                `empRecStatus`=:empRecStatus ,
                
                `info_joindate`=:info_joindate ,
                
                
                `deptId`=:deptId,
                `groId`=:groId,
                `desigId`=:desigId,
                
                `info_fathername_en`=:info_fathername_en,
                `info_fullname_en`=:info_fullname_en,
                `info_fathername_ar`=:info_fathername_ar,
                `info_fullname_ar`=:info_fullname_ar,
                

                `info_dob`=:info_dob,
                `info_gender`=:info_gender,
                `info_maritalstatus`=:info_maritalstatus,
                `info_countrycode`=:info_countrycode
                
                ";

    $pdo->query($iQuery);
    
    $__inrecid = $pdo->lastInsertId();

    if ($__inrecid) {
        
        $_SESSION['msg'][] = "Employee Added Successfully";
        $_r['content']['status'] = true;
        $_r['content']['container'] = '_create_record_modal_response_box';
        $_r['content']['content'] = $lib->_printMsg('s', 'Notification');

        /*
         * Refresh Data Callback.
         */

        $_r['callback']['status'] = true;
        $_r['empId'] = $__inrecid;
        $_r['callback']['name'][] = 'cb_create_completed';
        
        
    } else {
        
        $_SESSION['msg'][] = $lib->_('Error in saving the data. Contact Admin.');
        $_r['content']['status'] = true;
        $_r['content']['container'] = '_create_record_modal_response_box';
        $_r['content']['content'] = $lib->_printMsg('e', 'System Error');
    }
}

echo json_encode($_r);
