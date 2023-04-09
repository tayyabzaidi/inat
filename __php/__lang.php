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


$_GET['lang'] = 'en';

if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    $_SESSION['lang'] = $lang;
    setcookie('lang', $lang, time() + (3600 * 24 * 30));
} elseif (isset($_SESSION['lang'])) {
    $lang = $_SESSION['lang'];
    setcookie('lang', $lang, time() + (3600 * 24 * 30));
} elseif (isset($_COOKIE['lang'])) {
    $lang = $_COOKIE['lang'];
    $_SESSION['lang'] = $lang;
} else {
    $lang = 'ar';
    $_SESSION['lang'] = $lang;
}

switch ($lang) {
    case 'en':
        $lang_align = 'left';
        $_left = 'left';
        $_right = 'right';
        $lang_code = 'en';
        $lang_file = 'lang.en.php';
        $lang_postfix = '_en';
        $page_direction = 'ltr';
        setlocale(LC_ALL, 'en_US.UTF-8');
        break;

    case 'ar':
        $lang_align = 'right';
        $_left = 'right';
        $_right = 'left';
        $lang_code = 'ar';
        $lang_postfix = '_ar';
        $lang_file = 'lang.ar.php';
        $page_direction = 'rtl';
        setlocale(LC_ALL, 'ar_YE.UTF-8');
        break;

    default:
        $lang_align = 'left';
        $_left = 'left';
        $_right = 'right';
        $lang_code = 'en';
        $lang_file = 'lang.en.php';
        $lang_postfix = '_en';
        $page_direction = 'ltr';
        setlocale(LC_ALL, 'en_US.UTF-8');
}

$langfiletoload = __SYSTEM_PHP__ . 'lang/' . $lang_file;

require_once($langfiletoload);
