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
<div class="user-profile">
    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow">
                <div class="well well-sm">
                    <div class="user-profile-card">
                        <div class="user-profile-header">
                        </div>
                        <div class="user-profile-avatar text-center">
                            <img alt="" src="http://lorempixel.com/200/200/people/20/">
                        </div>

                        <div class="row pt-0 p-5 pt-0">
                            <div class="text-center">

                                <h4><?php echo $_auth_emp_rec['info_fullname_ar']; ?></h4>

                                <br />
                            </div>
                            <div class="panel-footer"></div>
                            <div class="container">
                                <p>
                                    <small>رمز التوظيف</small>
                                    <?php echo $_auth_emp_rec['empCode']; ?>
                                </p>
                                <p>
                                    <small>البريد الإلكتروني</small>
                                    <?php echo $_auth_info['authEmail']; ?>
                                </p>
                                <p>
                                    <small>الهاتف</small>
                                    <?php echo $_auth_emp_rec['info_phone']; ?>
                                </p>


                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .user-profile .user-profile-card {
        position: relative;
        padding-top: 0;
        overflow: hidden;
    }

    .user-profile-card .user-profile-header {
        background: url("https://lorempixel.com/850/280/abstract/20/");
        background-size: cover;
        height: 135px;
    }

    .user-profile-card .user-profile-avatar {
        position: relative;
        top: -100px;
        margin-bottom: -100px;
        padding: 0 15px;
    }

    .user-profile-card .user-profile-avatar img {
        width: 200px;
        height: 200px;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
        border: 2px solid rgba(255, 255, 255, 0.5);
    }

    .user-profile small {
        display: block;
        line-height: 1.428571429;
        color: #999;
    }
</style>