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
 * PHP Sessions
 */
session_start();

/*
 * Resolves The Session Loss Problem
 */

session_regenerate_id();

/*
 * Resolves The Session Loss Problem
 */

/*
 * PHP Sessions
 */




/*
 * Database Configurations
 */

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'zeeshan_inat_hrm');

/*
 * Database Configurations
 */


/*
 * Mail Server Configurations
 */

define('__EML_SERVER_SMTPDebug__', 0);
define('__EML_SERVER_Host__', 'localhost');
define('__EML_SERVER_SMTPAuth__', false);
define('__EML_SERVER_SMTPSecure__', 'ssl');
define('__EML_SERVER_Port__', 465);

/*
 * Mail Server Configurations
 */





/*
 * Url Configurations
 */

define('__PROTOCOL__', 'https://');
define('__DOMAIN__', 'iibsys.com');
define('__FOLDER__', '/inat/');
define('__SYSTEM_ROOT__', __PROTOCOL__ . __DOMAIN__ . __FOLDER__);

/*
 * Url Configurations
 */

/*
 * Storage Url 
 */
define('__STORAGE_URL__', __SYSTEM_ROOT__ . '__storage/');
/*
 * Storage Url 
 */

/*
 * Ajax Request Handler
 */
define('__AJAX_HANDLER__', __SYSTEM_ROOT__ . '__ajax/');
define('__AJAX_CALL_PATH__', __AJAX_HANDLER__ . 'do/');
/*
 * Ajax Request Handler
 */



/*
 * System Paths
 */
define('__SYSTEM_DIR__', $_SERVER['DOCUMENT_ROOT'] . '' . __FOLDER__);

define('__SYSTEM_PHP__', __SYSTEM_DIR__ . '__php/');
define('__SYSTEM_STORAGE__', __SYSTEM_DIR__ . '__storage/');
define('__SYSTEM_JAVASCRIPTS__', __SYSTEM_DIR__ . '__javascripts/');
/*
 * System Paths
 */


/*
 * Utilities Constants
 */
define('ID_NUMBER_LENGTH', 6);
define('SALT_LENGTH', 9);
/*
 * Utilities Constants
 */


/*
 * Cookies Timeout
 */

define('COOKIES_TIMEOUT', 10);

/*
 * User Groups
 */
