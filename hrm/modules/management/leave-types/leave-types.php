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
define('__SECTION_JS_PATH_', '__js/leave-types.script.php');
?>
<div class="container-fluid">
    <h5 class="mb-2 p-1 text-gray-800">
        <a href="<?php echo __APP_URL__ . $route->q; ?>">Management</a>
        <i class="fa fa-chevron-<?php echo $_right; ?>"></i>
        Leave Types
    </h5><br>
    <div id="_create_record_modal_response_box"></div>

    <div class="row">

        <div class="col-xl-4 col-lg-4">
            <h2>Add Leave Type</h2>
            <hr>
            <div class="card o-hidden border-0 shadow">
                <div class="row p-3">
                    <div class="col-xl-12 col-lg-12">
                        <form name="_create_record_modal_form" id="_create_record_modal_form"
                            enctype="multipart/form-data" method="POST" action=""
                            onsubmit="_ajaxCall('_create_record_modal_form', 'management/leave-types/create'); return false;">

                            <div class=" p-3">

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="name">Name</label>
                                        <input type="text" value="" name="name" id="name" autocomplete="off"
                                            class="form-control form-control-md">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="days">Days</label>
                                        <input type="number" value="" name="days" id="days" autocomplete="off"
                                            class="form-control form-control-md">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="resetmode">Reset Mode</label>
                                        <select name="resetmode" id="resetmode" class="selectpicker_picker form-control"
                                            data-live-search="true" data-style="btn-default" style="width:100%;">
                                            <option data-tokens="yearly" value="yearly">Yearly</option>
                                            <option data-tokens="monthly" value="monthly">Monthly</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label for="carryover">Carryover</label>
                                        <select name="carryover" id="carryover" class="selectpicker_picker form-control"
                                            data-live-search="true" data-style="btn-default" style="width:100%;">
                                            <option value="true">Yes</option>
                                            <option value="false">No</option>
                                        </select>
                                    </div>
                                </div>

                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-12" align="right">

                                        <button class="btn btn-sm  btn-primary btn-icon-split"
                                            name="_create_record_modal_form_btn" id="_create_record_modal_form_btn"
                                            type="submit" value="button">
                                            <span class="icon text-white-100"><i class="fa fa-save"></i> Save</span>
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
            <h2>Leave Types</h2>
            <hr>
            <div class="card o-hidden border-0 shadow">
                <div class="row p-3">
                    <div class="col-xl-12 col-lg-12">
                        <table id="dtc_table"
                            class="table table-lg table-responsive-sm table-condensed table-striped table-hover "
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>Name</th>
                                    <th>Days</th>
                                    <th>Reset Mode</th>
                                    <th>Carryover</th>
                                    <th>Status</th>
                                    <th width="100px">Options</th>
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