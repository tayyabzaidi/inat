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

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 p-3">
            <div class="card shadow mt-3">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item disabled">
                            <h5 class="p-0 m-0"> <i class="fa fas  fa-tasks"></i> إدارة النظام</h5>
                        </li>
                        <li class="list-group-item">
                            <a href="<?php echo __APP_URL__ . $route->q . '/leave-types'; ?>"><i
                                    class="fa fas  fa-arrow-<?php echo $_right; ?>"></i> أنواع الإجازات</a>
                        </li>
                        <li class="list-group-item">
                            <a href="<?php echo __APP_URL__ . $route->q . '/visa-types'; ?>"><i
                                    class="fa fas  fa-arrow-<?php echo $_right; ?>"></i> أنواع التأشيرات</a>
                        </li>
                        <li class="list-group-item">
                            <a href="<?php echo __APP_URL__ . $route->q . '/ticket-types'; ?>"><i
                                    class="fa fas  fa-arrow-<?php echo $_right; ?>"></i> أنواع التذاكر</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-sm-6 p-3">
            <div class="card shadow mt-3">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item disabled">
                            <h5 class="p-0 m-0"> <i class="fa fas  fa-tasks"></i> إدارة الموظفين</h5>
                        </li>
                        <li class="list-group-item">
                            <a href="<?php echo __APP_URL__ . $route->q . '/departments'; ?>"><i
                                    class="fa fas  fa-arrow-<?php echo $_right; ?>"></i> الأقسام</a>
                        </li>
                        <li class="list-group-item">
                            <a href="<?php echo __APP_URL__ . $route->q . '/designations'; ?>"><i
                                    class="fa fas  fa-arrow-<?php echo $_right; ?>"></i> التصنيفات</a>
                        </li>
                        <li class="list-group-item">
                            <a href="<?php echo __APP_URL__ . $route->q . '/employees'; ?>"><i
                                    class="fa fas  fa-arrow-<?php echo $_right; ?>"></i> الموظفين</a>
                        </li>
                        <li class="list-group-item">
                            <a href="<?php echo __APP_URL__ . $route->q . '/expenses'; ?>"><i
                                    class="fa fas  fa-arrow-<?php echo $_right; ?>"></i> المصروفات</a>
                        </li>
                        <li class="list-group-item">
                            <a href="<?php echo __APP_URL__ . $route->q . '/salary'; ?>"><i
                                    class="fa fas  fa-arrow-<?php echo $_right; ?>"></i> المرتبات</a>
                        </li>
                        <li class="list-group-item">
                            <a href="<?php echo __APP_URL__ . $route->q . '/encashment'; ?>"><i
                                    class="fa fas  fa-arrow-<?php echo $_right; ?>"></i>
                                تحويل النقود </a>
                        </li>
                        <li class="list-group-item">
                            <a href="<?php echo __APP_URL__ . $route->q . '/visa-management'; ?>"><i
                                    class="fa fas  fa-arrow-<?php echo $_right; ?>"></i>
                                التأشيرة </a>
                        </li>
                        <li class="list-group-item">
                            <a href="<?php echo __APP_URL__ . $route->q . '/items'; ?>"><i
                                    class="fa fas  fa-arrow-<?php echo $_right; ?>"></i>
                                العناصر المخصصة </a>
                        </li>
                        <li class="list-group-item">
                            <a href="<?php echo __APP_URL__ . $route->q . '/trip'; ?>"><i
                                    class="fa fas  fa-arrow-<?php echo $_right; ?>"></i>
                                رحلة عمل</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>