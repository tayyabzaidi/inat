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
 * System Settings
 */
require_once("__settings.php");


/*
 * Class Autoloading
 */

require __DIR__ . '/../vendor/autoload.php';



/*
 * Language 
 */
require __DIR__ . '/__lang.php';



/*
 * Required Core Classes
 */


/*
 * General Library Function 
 */
$lib = new __iibsys\__core\Utilities\Utilities();


/*
 * Set Translations
 */
$lib->_setTranslation($lang);

/*
 * Application Routing Controller
 */
$route = new __iibsys\__core\Router\Router();

/*
 * Exception/Errors Loging.
 */
$log = new __iibsys\__core\Log\Log();

/*
 * Database Class
 */
$pdo = new __iibsys\__core\Db\Db(DB_HOST, DB_NAME, DB_USER, DB_PASS);



/*
 * User Authentication
 */
$auth = new __iibsys\__core\Auth\Auth('auth', $pdo, $lib);



/*
 * System Stats
 */
$stats = new __iibsys\__core\Stats\Stats($pdo, $lib);



/*
 * Web Hooks
 */
require __DIR__ . '/__hooks.php';



