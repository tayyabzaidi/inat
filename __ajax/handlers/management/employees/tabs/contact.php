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

<div class="tab-pane fade" id="contact" aria-labelledby="contact-tab" role="tabpanel" >
    <form name="_tab_contact_form" 
          id="_tab_contact_form" 
          enctype="multipart/form-data"  
          method="POST" 
          action=""
          onsubmit="_ajaxCall('_tab_contact_form', 'management/employees/tabs/__tabs_handler/update-contact'); return false;"
          >
        <input type="hidden" name="__contact_tab_action_on" id="__contact_tab_action_on" value="<?php echo $__action_on; ?>" />



        <div class="container">
            <br>
            <h4>Contact Information</h4>
            <hr>

            <div id="_tab_contact_form_response"></div>


            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="info_phone">Phone #</label>
                    <input  type="text" 
                            value="<?php echo $__action_on_rset['info_phone']; ?>" 
                            name="info_phone" 
                            id="info_phone"  
                            class="form-control form-control-md"
                            >
                </div>
                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-2">
                    <label for="info_extention">Ext #</label>
                    <input  type="text" 
                            value="<?php echo $__action_on_rset['info_extention']; ?>" 
                            name="info_extention" 
                            id="info_extention"  
                            class="form-control form-control-md"
                            >

                </div>

                <div class="form-group col-md-1"></div>
                <div class="form-group col-md-4">
                    <label for="info_fax">Fax #</label>
                    <input  type="text" 
                            value="<?php echo $__action_on_rset['info_fax']; ?>" 
                            name="info_fax" 
                            id="info_fax"  
                            class="form-control form-control-md"
                            >

                </div>
            </div>



            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="info_mobile">Mobile #</label>
                    <input  type="text" 
                            value="<?php echo $__action_on_rset['info_mobile']; ?>" 
                            name="info_mobile" 
                            id="info_mobile"  
                            class="form-control form-control-md"
                            >
                </div>

                <div class="form-group col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="info_homephone">Home Phone #</label>
                    <input  type="text" 
                            value="<?php echo $__action_on_rset['info_homephone']; ?>" 
                            name="info_homephone" 
                            id="info_homephone"  
                            class="form-control form-control-md"
                            >
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="info_homeaddress">Address</label>
                    <textarea name="info_homeaddress" id="info_homeaddress"  class="form-control form-control-md"><?php echo $__action_on_rset['info_homeaddress']; ?></textarea>
                </div>
            </div>


        </div>

        <div class="modal-footer m-0 p-0">
            <div class="form-row m-0 pt-3 mr-2 ml-2">
                <div class="form-group col-md-12" align="<?php echo $_right; ?>">
                    <button 
                        class="btn btn-md  btn-primary btn-icon-split" 
                        name="_tab_contact_form_btn"
                        id="_tab_contact_form_btn"
                        type="submit" 
                        value ="button"
                        >
                        <span class="icon text-white-100"><i class="fas fa-save"></i> Update Contact Details</span>
                    </button>
                </div>
            </div>
        </div>
    </form>

</div>
