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

<div class="tab-pane fade" id="iden" aria-labelledby="iden-tab" role="tabpanel" >
    <form name="_tab_iden_form" 
          id="_tab_iden_form" 
          enctype="multipart/form-data"  
          method="POST" 
          action=""
          onsubmit="_ajaxCall('_tab_iden_form', 'management/employees/tabs/__tabs_handler/update-identity'); return false;"
          >
        <input type="hidden" name="__iden_tab_action_on" id="__iden_tab_action_on" value="<?php echo $__action_on; ?>" />



        <div class="container">
            <br>
            <h4>I.D Information</h4>
            <hr>

            <div id="_tab_iden_form_response"></div>


            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="id_is_national">Is Saudi ?</label>
                    <select name="id_is_national" id="id_is_national" required="required" class="selectpicker_picker form-control" data-live-search = "true" data-style = "btn-default" style="width:100%;">
                        <option value="">--</option>
                        <option <?php echo ($__action_on_rset['id_is_national'] == 'true' ) ? ' selected="selected" ' : ''; ?> value="true">Yes</option>
                        <option <?php echo ($__action_on_rset['id_is_national'] == 'false' ) ? ' selected="selected" ' : ''; ?> value="false">No</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="id_no">I.D/Moqeem #</label>
                    <input  type="text" 
                            value="<?php echo $__action_on_rset['id_no']; ?>" 
                            name="id_no" 
                            id="id_no"  
                            class="form-control form-control-md"
                            required="required"
                            >
                </div>

                <div class="form-group col-md-3">
                    <label for="id_expiry_date_en">Expiry Date</label>
                    <input  type="date" 
                            value="<?php echo $__action_on_rset['id_expiry_date_en']; ?>" 
                            name="id_expiry_date_en" 
                            id="id_expiry_date_en"  
                            class="form-control form-control-md"
                            required="required"
                            >
                </div>
                
                 <div class="form-group col-md-3">
                    <label for="id_religion">Religion</label>
                    <select name="id_religion" id="id_religion" required="required" class="selectpicker_picker form-control" data-live-search = "true" data-style = "btn-default" style="width:100%;">
                        <option value="">--</option>
                        <option <?php echo ($__action_on_rset['id_religion'] == 'muslim' ) ? ' selected="selected" ' : ''; ?> value="muslim">Muslim</option>
                        <option <?php echo ($__action_on_rset['id_religion'] == 'non muslim' ) ? ' selected="selected" ' : ''; ?> value="non muslim">Non Muslim</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="modal-footer m-0 p-0">
            <div class="form-row m-0 pt-3 mr-2 ml-2">
                <div class="form-group col-md-12" align="<?php echo $_right; ?>">
                    <button 
                        class="btn btn-md  btn-primary btn-icon-split" 
                        name="_tab_iden_form_btn"
                        id="_tab_iden_form_btn"
                        type="submit" 
                        value ="button"
                        >
                        <span class="icon text-white-100"><i class="fas fa-save"></i> Update I.D</span>
                    </button>
                </div>
            </div>
        </div>
    </form>

</div>