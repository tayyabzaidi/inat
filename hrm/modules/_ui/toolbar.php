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
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-0 navbar-search">
        <div class="d-sm-inline-block form-inline mr-auto ml-md-0 my-0 my-md-0 mw-0">
            <h3 class="color-brown m-0">InaT</h3>
            <h6 class="color-brown m-0" style="color:#eb981f;">HRM System</h6>
        </div>
    </div>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item green dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-2x fa-user"></i>
                <span class="mr-2 d-none d-lg-inline text-gray-600 ">&nbsp; <?php echo $_auth_info['authEmail']; ?><?php if (!$_auth_is_root) { ?><BR>&nbsp;&nbsp;<?php echo $_auth_emp_name; ?><?php } ?></span>
            </a>
            <div class = "dropdown-menu dropdown-menu-<?php echo $_right; ?> shadow animated--grow-in" aria-labelledby = "userDropdown">
                <!--<a class = "dropdown-item" href = "#">
                    <i class = "fas fa-cogs fa-sm fa-fw mr-2 text-gray-400 imageIconDirection"></i>
                    Settings
                </a>
                <div class = "dropdown-divider"></div>-->
                <a class="dropdown-item" href="<?php echo __APP_URL__ . '&_h=logout'; ?>" >
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400 imageIconDirection"></i>
                    Sign Out!
                </a>
            </div>
        </li>
    </ul>
</nav>

