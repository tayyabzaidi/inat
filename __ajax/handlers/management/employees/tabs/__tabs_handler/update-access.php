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


$empId = (isset($_POST['__access_tab_action_on'])) ? $lib->sanitizeTheVar($_POST['__access_tab_action_on']) : '';

$pdo->bind("empId", $empId);
$__action_on_rset = $pdo->row("SELECT * FROM employees WHERE empId=:empId");
$__emp_aut_id = (int) $__action_on_rset['authId'];

if ($__emp_aut_id) {
    $___execution_mode = 'update';
    $qs['authId'] = $__emp_aut_id;
} else {
    $___execution_mode = 'create';
    $qs['authId'] = NULL;
}


$qs['authStatus'] = (isset($_POST['authStatus'])) ? $lib->sanitizeTheVar($_POST['authStatus']) : '';
$qs['authName'] = (isset($_POST['authName'])) ? $lib->sanitizeTheVar($_POST['authName']) : '';
$qs['authEmail'] = (isset($_POST['authEmail'])) ? $lib->sanitizeTheVar($_POST['authEmail']) : '';

$p1 = (isset($_POST['p1'])) ? $lib->sanitizeTheVar($_POST['p1']) : '';
$p2 = (isset($_POST['p2'])) ? $lib->sanitizeTheVar($_POST['p2']) : '';


/*
 * Create Access
 */
if ($___execution_mode == 'create') {

    if (trim($qs['authName']) == '') {
        $_SESSION['msg'][] = "Invalid Access Code";
    } else {
        $pdo->bind("authName", $qs['authName']);
        $rSet = $pdo->query("SELECT * FROM auth WHERE authName=:authName;");
        if (count($rSet)) {
            $_SESSION['msg'][] = "Access Code already exists";
        }
    }


    if (trim($qs['authEmail']) == '') {
        $_SESSION['msg'][] = "Invalid Email";
    } else {
        $pdo->bind("authEmail", $qs['authEmail']);
        $rSet = $pdo->query("SELECT * FROM auth WHERE authEmail=:authEmail;");
        if (count($rSet)) {
            $_SESSION['msg'][] = "Email already exists";
        }
    }


    if (trim($p1) == '' || strlen($p1) < 6) {
        $_SESSION['msg'][] = "Invalid Password, Min Length For Password is six. (6).";
    } else {
        if (trim($p1) != trim($p2)) {
            $_SESSION['msg'][] = "Password mismatch.";
        }
    }



    if (isset($_SESSION['msg'])) {
        $_r['content']['status'] = true;
        $_r['content']['container'] = '_tab_access_form_response';
        $_r['content']['content'] = $lib->_printMsg('e', "Errors!");
    } else {

        $qs['authPassword'] = $lib->_gen_pwdhash(trim($p1));
        $qs['authStatus'] = ($qs['authStatus'] == 'on') ? 'active' : 'blocked';

        $pdo->bindMore($qs);
        $iQuery = "INSERT INTO auth SET `authId`=:authId ,
                        `authName`=:authName ,
                        `authEmail`=:authEmail ,
                        `authPassword`=:authPassword,
                        `authStatus`=:authStatus 
                  ";

        $pdo->query($iQuery);
        $__inrecid = $pdo->lastInsertId();

        if ($__inrecid) {

            /*
             * Update Employee Auth Link
             */
            
            $pdo->bind("authId", $__inrecid);
            $pdo->bind("empId", $empId);
            $uQuery = "UPDATE employees SET `authId`=:authId  WHERE `empId`=:empId ; ";
            $pdo->query($uQuery);
            
            /*
             * Update Employee Auth Link
             */

            $_SESSION['msg'][] = "Access updated successfully.";
            $_r['content']['status'] = true;
            $_r['content']['container'] = '_tab_access_form_response';
            $_r['content']['content'] = $lib->_printMsg('s', 'Notification');

           
        } else {

            $_SESSION['msg'][] = $lib->_('Error in saving the data. Contact Admin.');
            $_r['content']['status'] = true;
            $_r['content']['container'] = '_tab_access_form_response';
            $_r['content']['content'] = $lib->_printMsg('e', 'System Error');
        }
    }
}
/*
 * Create Access
 */



/*
 * Update Access
 */
if ($___execution_mode == 'update') {

    if (trim($qs['authName']) == '') {
        $_SESSION['msg'][] = "Invalid Access Code";
    } else {
        $pdo->bind("authName", $qs['authName']);
        $pdo->bind("not_authId", $qs['authId']);
        $rSet = $pdo->query("SELECT * FROM auth WHERE authName=:authName AND authId!=:not_authId ;");
        if (count($rSet)) {
            $_SESSION['msg'][] = "Access Code already exists";
        }
    }


    if (trim($qs['authEmail']) == '') {
        $_SESSION['msg'][] = "Invalid Email";
    } else {
        $pdo->bind("authEmail", $qs['authEmail']);
        $pdo->bind("not_authId", $qs['authId']);
        $rSet = $pdo->query("SELECT * FROM auth WHERE authEmail=:authEmail AND authId!=:not_authId;");
        if (count($rSet)) {
            $_SESSION['msg'][] = "Email already exists";
        }
    }


    if (trim($p1) == '' || strlen($p1) < 6) {
        $_SESSION['msg'][] = "Invalid Password, Min Length For Password is six. (6).";
    } else {
        if (trim($p1) != trim($p2)) {
            $_SESSION['msg'][] = "Password mismatch.";
        }
    }



    if (isset($_SESSION['msg'])) {
        $_r['content']['status'] = true;
        $_r['content']['container'] = '_tab_access_form_response';
        $_r['content']['content'] = $lib->_printMsg('e', "Errors!");
    } else {

        $qs['authPassword'] = $lib->_gen_pwdhash(trim($p1));
        $qs['authStatus'] = ($qs['authStatus'] == 'on') ? 'active' : 'blocked';

        $pdo->bindMore($qs);
        $uQuery = "UPDATE auth SET 
                        
                        `authName`=:authName ,
                        `authEmail`=:authEmail ,
                        `authPassword`=:authPassword,
                        `authStatus`=:authStatus 
                        
                   WHERE `authId`=:authId 
                  ";

      
        if ($pdo->query($uQuery)) {

            $_SESSION['msg'][] = "Access updated successfully.";
            $_r['content']['status'] = true;
            $_r['content']['container'] = '_tab_access_form_response';
            $_r['content']['content'] = $lib->_printMsg('s', 'Notification');

           
        } else {

            $_SESSION['msg'][] = $lib->_('Error in saving the data. Contact Admin.');
            $_r['content']['status'] = true;
            $_r['content']['container'] = '_tab_access_form_response';
            $_r['content']['content'] = $lib->_printMsg('e', 'System Error');
        }
    }
}
/*
 * Update Access
 */

echo json_encode($_r);
