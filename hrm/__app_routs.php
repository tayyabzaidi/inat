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


if ($auth->checkAuth()) {

    /*
     * Global Auth  Data
     */
    $_auth_id = $_SESSION['authId'];

    $_auth_info = $auth->getUser($_auth_id);

    $_auth_is_root = ($_auth_info['authIsRoot']) ? true : false;
    $_auth_group = 0;


    $_auth_emp_name = '';
    if (!$_auth_is_root) {
        $pdo->bind('authId', $_auth_id);
        $_auth_emp_rec = $pdo->row("SELECT * FROM employees WHERE authId=:authId ");
        $_auth_emp_name = $_auth_emp_rec['info_fullname_en'];
        $_auth_group = $_auth_emp_rec['groId'];
        $_SESSION['empId'] = $_auth_emp_rec['empId'];

        define("__EMP_ID", $_auth_emp_rec['empId']);
        define("__AUTH_ID", $_auth_emp_rec['authId']);
    }




    switch ($route->q) {


        case 'management':
            if ($_auth_is_root || $_auth_group < 3) {
                require_once('./modules/management/management.php');
            } else {
                die('Access denied.');
            }
            break;


        case 'employee':
            if ($_auth_is_root) {
                $route->q = 'management';
                require_once('./modules/management/management.php');
            } else {
                require_once('./modules/employee/employee.php');
            }
            break;


        default:
            require_once('./modules/dashboard/dashboard.php');
    }
} else {
    switch ($route->q) {
        default:
            require_once('./modules/login/login.php');
    }
}