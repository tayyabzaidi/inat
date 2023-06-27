<?php
/*
 * Copyright © 2015 Zeeshan Abbas <zeeshan@iibsys.com> <+966 55 4137245>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
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
    <title><?php echo $lib->_('Page_Title'); ?></title>
    <?php require __DIR__ . '/../_ui/css.php'; ?>
    <style>

    </style>
</head>

<body class="text-<?php echo $_left; ?> fade-in-top" style="   
          background-color: #020041; 
          background-image: linear-gradient(180deg, #ffffff 30%, #020041 30%);
          background-size: cover !important;">
    <?php require __DIR__ . '/../_ui/loader.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div class="container">
            <div id="_php_error_response"></div>
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-10 col-md-10">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-5 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-7">
                                    <div class="p-5">
                                        <div class="text-<?php echo $_left; ?>">
                                            <h2 class="h2 mb-4">Login Now!</h2>
                                        </div>

                                        <form class="user" name="authForm" id="authForm" method="POST"
                                            onsubmit="_ajaxCall('authForm', 'auth/login'); return false;">
                                            <hr>
                                            <BR>

                                            <div id="_auth_respone_div"></div>

                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" id="user_name"
                                                    name="user_name" aria-describedby="" autocomplete="off"
                                                    placeholder="Access Code or Email">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="user_password" id="user_password"
                                                    class="form-control form-control-user" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="user_remember" id="user_remember">
                                                    <label class="custom-control-label" for="user_remember">Remember
                                                        Me</label>
                                                </div>
                                            </div>

                                            <div align="right">
                                                <button type="submit" class="btn btn-primary btn-user ">Login</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php require_once(__SYSTEM_JAVASCRIPTS__ . 'system.caller.js.php'); ?>
    <?php require __DIR__ . '/../_ui/scripts.php'; ?>
    <script>



    </script>
</body>

</html>