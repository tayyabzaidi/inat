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

<ul class="navbar-nav sidebar accordion toggled " id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo __APP_URL__ . 'employee'; ?>">
        <img  src="<?php echo __STORAGE_URL__ . 'artwork/Logo-80x80.png'; ?>"  alt="" width="60px" height="60px"   />
    </a>


    <li class = " nav-item <?php echo ($route->q == 'dashboard' || $route->q == '') ? 'shadow active active_nav' : ''; ?>">
        <a class = "nav-link" href = "<?php echo __APP_URL__ . 'dashboard'; ?>">
            <span class = "material-icons imageIconDirection" style = "font-size:36px;">dashboard</span>
            <span>Dashboard</span></a>
    </li>



    <?php if (!$_auth_is_root) { ?>
        <li class = " nav-item <?php echo ($route->q == 'employee') ? 'shadow active active_nav' : ''; ?>">
            <a class = "nav-link" href = "<?php echo __APP_URL__ . 'employee'; ?>">
                <span class = "material-icons imageIconDirection" style = "font-size:36px;">person</span>
                <span>Employee</span></a>
        </li>
    <?php } ?>

    <?php if ($_auth_is_root || $_auth_group < 3) { ?>
        <li class=" nav-item <?php echo ($route->q == 'management') ? 'shadow active active_nav' : ''; ?>">
            <a class="nav-link" href="<?php echo __APP_URL__ . 'management'; ?>">
                <span class="material-icons imageIconDirection" style="font-size:36px;">manage_accounts</span>
                <span>Management</span></a>
        </li>
    <?php } ?>


</ul>

