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
 * Call Url ... ::: '<?php echo __APP_ROOT__; ?>/ajax/do/' + 'folder/folder/folder/file.php'
 */


/*
 * Application Init
 */

require_once('__app_init.php');

/*
 * Application Init
 */


/*
 * Server Respose Custome Object
 */

require_once('./_r.php');

/*
 * Server Respose Custome Object
 */


/*
 * Call Template
 * 
 * __ajax/do/?_path=test/check_call
 */

if ($route->q == 'do') {
    $_path = (isset($_REQUEST['_path'])) ? $_REQUEST['_path'] : false;
    if ($_path) {
        $scriptFile = './handlers/' . $_path . ".php";
        if (file_exists($scriptFile)) {
            require ($scriptFile);
        } else {
            $_r['___server_response'][] = "Missing handler script $_path .";
            echo json_encode($_r);
        }
    } else {
        $_r['___server_response'][] = "Invalid call $_path .";
        echo json_encode($_r);
    }
}