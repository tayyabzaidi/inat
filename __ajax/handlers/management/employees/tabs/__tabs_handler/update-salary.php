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


$qs['empId'] = (isset($_POST['__salary_tab_action_on'])) ? $lib->sanitizeTheVar($_POST['__salary_tab_action_on']) : '';
$qs['salary_basic'] = (isset($_POST['salary_basic'])) ? $lib->sanitizeTheVar($_POST['salary_basic']) : '';
$qs['salary_hra'] = (isset($_POST['salary_hra'])) ? $lib->sanitizeTheVar($_POST['salary_hra']) : '';
$qs['salary_ta'] = (isset($_POST['salary_ta'])) ? $lib->sanitizeTheVar($_POST['salary_ta']) : '';
$qs['salary_others'] = (isset($_POST['salary_others'])) ? $lib->sanitizeTheVar($_POST['salary_others']) : '';
$qs['salary_discount'] = (isset($_POST['salary_discount'])) ? $lib->sanitizeTheVar($_POST['salary_discount']) : '';


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
    $_r['content']['container'] = '_tab_salary_form_response';
    $_r['content']['content'] = $lib->_printMsg('e', "Invalid Input");
} else {

    $pdo->bindMore($qs);
    $uQuery = "UPDATE employees SET
        
                    `salary_basic`=:salary_basic ,
                    `salary_hra`=:salary_hra ,
                    `salary_ta`=:salary_ta ,
                    `salary_others`=:salary_others ,
                    `salary_discount`=:salary_discount

                WHERE `empId`=:empId ; ";

    if ($pdo->query($uQuery)) {


        $_SESSION['msg'][] = "Updated Successfully";
        $_r['content']['status'] = true;
        $_r['content']['container'] = '_tab_salary_form_response';
        $_r['content']['content'] = $lib->_printMsg('s', 'Notification');


        $_r['callback']['status'] = true;
        $_r['callback']['name'][] = 'cb_reload__table';
        
    } else {

        $_SESSION['msg'][] = $lib->_('Error in saving the data. Contact Admin.');
        $_r['content']['status'] = true;
        $_r['content']['container'] = '_tab_salary_form_response';
        $_r['content']['content'] = $lib->_printMsg('e', 'System Error');
    }
}

echo json_encode($_r);
