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


$qs['empId'] = (isset($_POST['empId'])) ? $lib->sanitizeTheVar($_POST['empId']) : '';
$qs['typId'] = (isset($_POST['typId'])) ? $lib->sanitizeTheVar($_POST['typId']) : '';
$callKey = (isset($_POST['callKey'])) ? $lib->sanitizeTheVar($_POST['callKey']) : '';
$fldId = (isset($_POST['fldId'])) ? $lib->sanitizeTheVar($_POST['fldId']) : '';
$fldValue = (isset($_POST['fldValue'])) ? $lib->sanitizeTheVar($_POST['fldValue']) : '';



$_tab_respose_box = '_tab_' . $callKey . '_form_response';

switch ($fldId) {

    case 'default':

        $qs['defaultValue'] = $fldValue;
        if (!is_numeric($qs['defaultValue']) || $qs['defaultValue'] < 0) {
            $_SESSION['msg'][] = "Invalid Default Value";
        }


        if (isset($_SESSION['msg'])) {
            $_r['content']['status'] = true;
            $_r['content']['container'] = $_tab_respose_box;
            $_r['content']['content'] = $lib->_printMsg('e', "Invalid Input");
        } else {
            $pdo->bindMore($qs);
            $uQuery = "UPDATE employee_balances SET `defaultValue`=:defaultValue WHERE `empId`=:empId AND `typId`=:typId ; ";

            if ($pdo->query($uQuery)) {

                $_SESSION['msg'][] = "Total Allowed Updated Successfully";
                $_r['content']['status'] = true;
                $_r['content']['container'] = $_tab_respose_box;
                $_r['content']['content'] = $lib->_printMsg('s', 'Notification');
            } else {

                $_SESSION['msg'][] = $lib->_('Error in saving the data. Contact Admin.');
                $_r['content']['status'] = true;
                $_r['content']['container'] = $_tab_respose_box;
                $_r['content']['content'] = $lib->_printMsg('e', 'System Error');
            }
        }

        break;

    case 'current':
        $qs['currentValue'] = $fldValue;
        if (!is_numeric($qs['currentValue']) || $qs['currentValue'] < 0) {
            $_SESSION['msg'][] = "Invalid Current Value";
        }


        if (isset($_SESSION['msg'])) {
            $_r['content']['status'] = true;
            $_r['content']['container'] = $_tab_respose_box;
            $_r['content']['content'] = $lib->_printMsg('e', "Invalid Input");
        } else {
            $pdo->bindMore($qs);
            $uQuery = "UPDATE employee_balances SET `currentValue`=:currentValue WHERE `empId`=:empId AND `typId`=:typId ; ";

            if ($pdo->query($uQuery)) {

                $_SESSION['msg'][] = "Current Balance Successfully";
                $_r['content']['status'] = true;
                $_r['content']['container'] = $_tab_respose_box;
                $_r['content']['content'] = $lib->_printMsg('s', 'Notification');
            } else {
                $_SESSION['msg'][] = $lib->_('Error in saving the data. Contact Admin.');
                $_r['content']['status'] = true;
                $_r['content']['container'] = $_tab_respose_box;
                $_r['content']['content'] = $lib->_printMsg('e', 'System Error');
            }
        }
        break;


    case 'entitment':

        $qs['typStatus'] = ($fldValue == 'true') ? 'active' : 'inactive';
        $pdo->bindMore($qs);
        $uQuery = "UPDATE employee_balances SET `typStatus`=:typStatus WHERE `empId`=:empId AND `typId`=:typId ; ";

        if ($pdo->query($uQuery)) {
            $_SESSION['msg'][] = "Entitlement Updated Successfully";
            $_r['content']['status'] = true;
            $_r['content']['container'] = $_tab_respose_box;
            $_r['content']['content'] = $lib->_printMsg('s', 'Notification');
        } else {
            $_SESSION['msg'][] = $lib->_('Error in saving the data. Contact Admin.');
            $_r['content']['status'] = true;
            $_r['content']['container'] = $_tab_respose_box;
            $_r['content']['content'] = $lib->_printMsg('e', 'System Error');
        }

        break;
}



echo json_encode($_r);
