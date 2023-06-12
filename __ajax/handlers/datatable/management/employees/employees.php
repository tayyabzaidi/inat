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



$col[0] = 'employees.empid';
$col[1] = 'employees.empCode';
$col[2] = 'employees.info_fullname_en';
$col[3] = 'employees.info_fathername_en';
$col[4] = 'usedLeaves';
$col[5] = 'leavesRemaining';
$col[6] = 'usedTickets';
$col[7] = 'ticketsRemaining';










/*
 * Output For Datatable
 */
$start = (isset($_POST['start'])) ? $lib->sanitizeTheVar($_POST['start']) : -1;
$length = (isset($_POST['length'])) ? $lib->sanitizeTheVar($_POST['length']) : -1;
$draw = (isset($_POST['draw'])) ? $lib->sanitizeTheVar($_POST['draw']) : 0;
$order_list = (isset($_POST['order'])) ? $_POST['order'] : [];
$search_post = (isset($_POST['search'])) ? $_POST['search'] : [];
$search_value = (isset($search_post['value'])) ? $search_post['value'] : '';



/*
 * Data Filter..
 */


$limit = '';
if ($length > 0) {
    $limit = "LIMIT " . intval($start) . ", " . intval($length);
}


$order = '';
if (count($order_list)) {
    $order = 'ORDER BY ' . $col[$order_list[0]['column']] . '  ' . strtoupper($order_list[0]['dir']);
}


$searchFilter = '';
$search_value = trim($search_value);
if ($search_value) {
    $searchFilter = " AND  employees.info_fullname_en LIKE '%$search_value%'  ";
}

$_r['search_value'] = $searchFilter;


/*
 * Filterd Records
 */
$recordsFiltered = $pdo->row("SELECT COUNT(employees.empid) AS recordsFiltered FROM employees WHERE 1=1 $searchFilter ")['recordsFiltered'];

/*
 * Total Records
 */
$recordsTotal = $pdo->row("SELECT COUNT(employees.empid) AS recordsTotal  FROM employees WHERE 1=1 ")['recordsTotal'];

/*
 * Data Table Records
 */
$dtQuery = "SELECT employees.* FROM employees WHERE 1=1 $searchFilter $order  $limit  ";
$dtResult = $pdo->query($dtQuery);

for ($i = 0; $i < count($dtResult); $i++) {
    $available_leaves = $_SESSION['available_leaves'];
    $usedLeaves = $pdo->query("SELECT count(id) as leaves_taken from employee_leaves WHERE emp_id=" . $dtResult[$i]['empId'] . " AND leave_type = 'Annual Leave'");
    $leavesRemaining = -$usedLeaves[0]['leaves_taken'] + $available_leaves;
    $dtResult[$i]['usedLeaves'] = $usedLeaves[0]['leaves_taken'];
    $dtResult[$i]['leavesRemaining'] = $leavesRemaining;

    $available_tickets = $_SESSION['total_tickets'];
    $usedTickets = $pdo->query("SELECT count(eai.id) as count from employee_air_tickets eai join employee_trip_status ets on ets.tripId=eai.id where employeeId=" . $dtResult[$i]['empId'] . " and 2=(select count(s.id) from employee_trip_status join status s on employee_trip_status.statusId=s.id where employee_trip_status.tripId=eai.id and s.status_name in ('HOD_approved','HR_approved'))");
    $ticketsRemaining = $available_tickets - $usedTickets[0]['count'];
    $dtResult[$i]['usedTickets'] = $usedTickets[0]['count'];
    $dtResult[$i]['ticketsRemaining'] = $ticketsRemaining;
}


$data = $dtResult;
$request['draw'] = 1;
$datatable = array(
    "draw" => $draw,
    "recordsTotal" => intval($recordsTotal),
    "recordsFiltered" => intval($recordsFiltered),
    "data" => $data
);


$_r['datatable'] = $datatable;

echo json_encode($_r);