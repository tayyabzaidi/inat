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

$__action_on = (isset($_POST['__action_on'])) ? $lib->sanitizeTheVar($_POST['__action_on']) : '';

if ($__action_on) {
    $pdo->bind("deptId", $__action_on);
    $__action_on_rset = $pdo->query("SELECT * FROM departments WHERE deptId=:deptId");
} else {
    die("Invalid request.");
}
?>
<form name="_edit_record_modal_form" 
      id="_edit_record_modal_form" 
      enctype="multipart/form-data"  
      method="POST" 
      action=""
      onsubmit="_ajaxCall('_edit_record_modal_form', 'management/departments/update'); return false;"
      >

    <div class="modal-header">
        <h4 class="modal-title" id="_create_record_modal_label">Edit Department</h4>
        <button class="btn btn-sm btn-primary btn-default btn-icon-split" type="button" data-dismiss="modal">
            <span class="icon text-white-100"><i class="fas fa-times"></i></span>
        </button>
    </div>

    <div class=" p-3">
        <div id="_update_record_ajax_response"></div>

        <input type="hidden" name="__action_on" id="__action_on" value="<?php echo $__action_on; ?>" />

        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="name">Department Name</label>
                <input  type="text" 
                        name="e_name" 
                        id="e_name"  
                        value="<?php echo $__action_on_rset[0]['name']; ?>"
                        autocomplete="off"
                        class="form-control form-control-md"
                        >
            </div>
            <div class="form-group col-md-4">
                <label for="e_status">Status</label>
                <select name="e_status" id="e_status" class="selectpicker_picker form-control" data-live-search = "true" data-style = "btn-default" style="width:100%;">
                    <option value = "active" <?php echo ($__action_on_rset[0]['status'] == 'active') ? ' selected="selected" ' : ''; ?>>Active</option>
                    <option value = "deleted"<?php echo ($__action_on_rset[0]['status'] == 'deleted') ? ' selected="selected" ' : ''; ?>>Deleted</option>
                </select>
            </div>
        </div>



    </div>


    <div class="modal-footer m-0 p-0">
        <div class="form-row m-0 pt-3 mr-2 ml-2">
            <div class="form-group col-md-12" align="<?php echo $_right; ?>">
                <button 
                    class="btn btn-md  btn-primary btn-icon-split" 
                    name="_edit_record_modal_form_btn"
                    id="_edit_record_modal_form_btn"
                    type="submit" 
                    value ="button"
                    >
                    <span class="icon text-white-100"><i class="fas fa-save"></i> Save</span>
                </button>
            </div>
        </div>
    </div>
</form>