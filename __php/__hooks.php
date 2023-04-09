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


/*
 * System Hooks Calls
 */

/*
 * 
 * &_h=hookname/par1/par2/par3
 * 
 * Register Hooks
 * 
 */

$hooks = [
    'testHook', 'logout'
];

function parseHook() {
    if (isset($_GET['_h'])) {
        return $hook = explode('/', filter_var(rtrim($_GET['_h'], '/'), FILTER_SANITIZE_URL));
    } else {
        return false;
    }
}

$hook = parseHook();

if ($hook && in_array($hook[0], $hooks) && function_exists($hook[0])) {
    $callMe = $hook[0];
    unset($hook[0]);
    $params = $hook ? array_values($hook) : [];
    $callMe($params);
}

function testHook($params) {
    var_dump($params);
    exit;
}

function logout($params) {
    global $auth;
    $auth->logout();
}
