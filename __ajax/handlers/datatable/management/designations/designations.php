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



$col[0] = 'employee_designations.desigId';
$col[1] = 'employee_designations.name';
$col[2] = 'employee_designations.status';









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
    $searchFilter = " AND  employee_designations.name LIKE '%$search_value%'  ";
}


$_r['search_value'] = $searchFilter;






/*
 * Filterd Records
 */
$recordsFiltered = $pdo->row("SELECT COUNT(employee_designations.desigId) AS recordsFiltered FROM employee_designations WHERE 1=1 $searchFilter ")['recordsFiltered'];

/*
 * Total Records
 */
$recordsTotal = $pdo->row("SELECT COUNT(employee_designations.desigId) AS recordsTotal  FROM employee_designations WHERE 1=1 ")['recordsTotal'];

/*
 * Data Table Records
 */
$dtQuery = "SELECT employee_designations.* FROM employee_designations WHERE 1=1 $searchFilter $order  $limit  ";
$dtResult = $pdo->query($dtQuery);




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
