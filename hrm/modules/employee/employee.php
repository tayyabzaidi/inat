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




?>
<!DOCTYPE html>
<html lang="<?php echo $lang_code; ?>" dir="<?php echo $page_direction; ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title><?php echo $lib->_('the_title'); ?></title>
    <?php require __DIR__ . '/../_ui/css.php'; ?>
    <style>

    </style>
</head>

<body class="text-<?php echo $_left; ?> fade-in-top" id="page-top">
    <?php require __DIR__ . '/../_ui/loader.php'; ?>
    <div id="wrapper">
        <!-- Sidebar -->
        <?php require __DIR__ . '/../_ui/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <?php require __DIR__ . '/../_ui/toolbar.php'; ?>

                <?php
                switch ($route->subpage) {
                    case 'encashment':
                        require_once('encashment/encashment.php');
                        break;

                    case 'visa':
                        require_once('visa/visa.php');
                        break;
                    case 'leaves':
                        require_once('leaves/leaves.php');
                        break;

                    case 'salary':
                        require_once('salary/salary.php');
                        break;
                    case 'expense':
                            require_once('expense/expense.php');
                            break;
                    default:
                        require_once('default.php');
                }
                ?>


            </div>
        </div>

    </div>
    <?php require __DIR__ . '/../_ui/page-top.php'; ?>
    <?php require_once(__SYSTEM_JAVASCRIPTS__ . 'system.caller.js.php'); ?>
    <?php require __DIR__ . '/../_ui/scripts.php'; ?>


</body>

</html>