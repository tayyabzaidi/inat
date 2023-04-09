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
<div class="tab-pane fade" id="passport" aria-labelledby="passport-tab" role="tabpanel" >
    <form name="_tab_passport_form" 
          id="_tab_passport_form" 
          enctype="multipart/form-data"  
          method="POST" 
          action=""
          onsubmit="_ajaxCall('_tab_passport_form', 'management/employees/tabs/__tabs_handler/update-passport'); return false;"
          >
        <input type="hidden" name="__passport_tab_action_on" id="__passport_tab_action_on" value="<?php echo $__action_on; ?>" />



        <div class="container">
            <br>
            <h4>Passport Information</h4>
            <hr>
            <div id="_tab_passport_form_response"></div>


            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="passport_number">Passport #</label>
                    <input  type="text" 
                            value="<?php echo $__action_on_rset['passport_number']; ?>" 
                            name="passport_number" 
                            id="passport_number"  
                            class="form-control form-control-md"
                            required="required"
                            >
                </div>
                
                <div class="form-group col-md-6">
                    <label for="passport_issued_by">Issuing Country</label>
                    <select name="passport_issued_by" id="passport_issued_by" required="required" class="selectpicker_picker form-control" data-live-search = "true" data-style = "btn-default" style="width:100%;">
                        <option value="">Select Country</option>
                        <?php for ($i = 0; $i < count($rd_contr); $i++) { ?>
                            <?php $sl = ($rd_contr[$i]['country_code'] == $__action_on_rset['passport_issued_by']) ? ' selected="selected" ' : ''; ?>
                            <option <?php echo $sl; ?> value="<?php echo $rd_contr[$i]['country_code']; ?>"><?php echo strtoupper($rd_contr[$i]['country_enName']); ?></option>
                        <?php } ?>
                    </select>
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="passport_issue_date">Issue Date</label>
                    <input  type="date" 
                            value="<?php echo $__action_on_rset['passport_issue_date']; ?>" 
                            name="passport_issue_date" 
                            id="passport_issue_date"  
                            class="form-control form-control-md"
                            required="required"
                            >
                </div>

                <div class="form-group col-md-6">
                    <label for="passport_expire_date">Issue Date</label>
                    <input  type="date" 
                            value="<?php echo $__action_on_rset['passport_expire_date']; ?>" 
                            name="passport_expire_date" 
                            id="passport_expire_date"  
                            class="form-control form-control-md"
                            required="required"
                            >
                </div>
            </div>


        </div>

        <div class="modal-footer m-0 p-0">
            <div class="form-row m-0 pt-3 mr-2 ml-2">
                <div class="form-group col-md-12" align="<?php echo $_right; ?>">
                    <button 
                        class="btn btn-md  btn-primary btn-icon-split" 
                        name="_tab_passport_form_btn"
                        id="_tab_passport_form_btn"
                        type="submit" 
                        value ="button"
                        >
                        <span class="icon text-white-100"><i class="fas fa-save"></i> Update Passport Info</span>
                    </button>
                </div>
            </div>
        </div>
    </form>

</div>