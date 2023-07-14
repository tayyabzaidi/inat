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
define('__SECTION_JS_PATH_', '__js/departments.script.php');
?>
<div class="container-fluid">
    <h5 class="mb-2 p-1 text-gray-800">
        <a href="<?php echo __APP_URL__ . $route->q; ?>">الإدارة</a>
        <i class="fa fa-chevron-<?php echo $_right; ?>"></i>
        الأقسام
    </h5>

    <br>
    <div id="_create_record_modal_response_box"></div>

    <div class="row">

        <div class="col-xl-4 col-lg-4">
            <h2>إضافة قسم</h2>
            <hr>
            <div class="card o-hidden border-0 shadow">
                <div class="row p-3">
                    <div class="col-xl-12 col-lg-12">
                        <form name="_create_record_modal_form" id="_create_record_modal_form"
                            enctype="multipart/form-data" method="POST" action=""
                            onsubmit="_ajaxCall('_create_record_modal_form', 'management/departments/create'); return false;">

                            <div class=" p-3">



                                <div class="form-row">
                                    <div class="form-group col-md-9">
                                        <label for="name">اسم القسم</label>
                                        <input type="text" value="" name="name" id="name" autocomplete="off"
                                            class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="_create_record_modal_form_btn">&nbsp;</label>
                                        <BR>
                                        <button class="btn btn-sm  btn-primary btn-icon-split"
                                            name="_create_record_modal_form_btn" id="_create_record_modal_form_btn"
                                            type="submit" value="button">
                                            <span class="icon text-white-100"><i class="fa fa-save"></i> حفظ</span>
                                        </button>
                                    </div>
                                </div>

                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>

        <div class="col-xl-8 col-lg-8">
            <h2>الأقسام</h2>
            <hr>
            <div class="card o-hidden border-0 shadow">
                <div class="row p-3">
                    <div class="col-xl-12 col-lg-12">
                        <table id="dtc_table"
                            class="table table-lg table-responsive-sm table-condensed table-striped table-hover "
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>المعرف</th>
                                    <th>الاسم</th>
                                    <th>الحالة</th>
                                    <th width="100px">خيارات</th>
                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="_edit_record_modal" tabindex="-1" role="dialog" aria-labelledby="_edit_record_modal_label">
    <div class="modal-dialog modal-xl " role="document">
        <div class="modal-content " id="_edit_record_ajax_interface"></div>
    </div>
</div>