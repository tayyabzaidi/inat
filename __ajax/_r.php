<?php

/*
 * Copyright(C) 2021 IIBSys.com <zeeshan@iibsys.com> <+966 55 4137245>
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
 * 
 */


$_r['status'] = false;

$_r['reload'] = false;
$_r['reload_without_delay'] = false;

$_r['redirect'] = false;
$_r['redirect_url'] = '';
$_r['redirect_delay'] = '0';


$_r['content']['status'] = false;
$_r['content']['container'] = '';
$_r['content']['content'] = '';


$_r['callback']['status'] = false;
//$_r['callback']['name'][] = '';




$_r['get'] = $_GET;
$_r['post'] = $_POST;
$_r['files'] = $_FILES;
$_r['session'] = $_SESSION;
