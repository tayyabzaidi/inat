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

<div class="tab-pane fade show active" id="info" aria-labelledby="info-tab" role="tabpanel" >
    <form name="_tab_info_form" 
          id="_tab_info_form" 
          enctype="multipart/form-data"  
          method="POST" 
          action=""
          onsubmit="_ajaxCall('_tab_info_form', 'management/employees/tabs/__tabs_handler/update-info'); return false;"
          >
        <input type="hidden" name="__info_tab_action_on" id="__info_tab_action_on" value="<?php echo $__action_on; ?>" />



        <div class="container">
            <br>
            <h4>Employee Details</h4>
            <hr>
            <div id="_tab_info_form_response"></div>


            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="empCode">Employment Code</label>
                    <input  type="text" 
                            value="<?php echo $__action_on_rset['empCode']; ?>" 
                            name="empCode" 
                            id="empCode"  
                            class="form-control form-control-md"
                            required="required"
                            >
                </div>

                <div class="form-group col-md-6"></div>

                <div class="form-group col-md-3">
                    <label for="info_joindate">Joining Date</label>
                    <input  type="date" 
                            value="<?php echo $__action_on_rset['info_joindate']; ?>" 
                            name="info_joindate" 
                            id="info_joindate"  
                            class="form-control form-control-md"
                            required="required"
                            >
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="groId">System's Type</label>
                    <select name="groId" id="groId" required="required" class="selectpicker_picker form-control" data-live-search = "true" data-style = "btn-default" style="width:100%;">
                        <option value="">Select Type</option>
                        <?php for ($i = 0; $i < count($rd_empgro); $i++) { ?>
                            <?php $sl = ($rd_empgro[$i]['groId'] == $__action_on_rset['groId']) ? ' selected="selected" ' : ''; ?>
                            <option <?php echo $sl; ?> value="<?php echo $rd_empgro[$i]['groId']; ?>"><?php echo strtoupper($rd_empgro[$i]['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>


                <div class="form-group col-md-4">
                    <label for="desigId">Designation</label>
                    <select name="desigId" id="desigId" required="required" class="selectpicker_picker form-control" data-live-search = "true" data-style = "btn-default" style="width:100%;">
                        <option value="">Select Designation</option>
                        <?php for ($i = 0; $i < count($rd_desig); $i++) { ?>
                            <?php $sl = ($rd_desig[$i]['desigId'] == $__action_on_rset['desigId']) ? ' selected="selected" ' : ''; ?>
                            <option  <?php echo $sl; ?>  value="<?php echo $rd_desig[$i]['desigId']; ?>"><?php echo strtoupper($rd_desig[$i]['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>


                <div class="form-group col-md-4">
                    <label for="deptId">Department</label>
                    <select name="deptId" id="deptId" required="required"  class="selectpicker_picker form-control" data-live-search = "true" data-style = "btn-default" style="width:100%;">
                        <option value="">Select Department</option>
                        <?php for ($i = 0; $i < count($rd_depts); $i++) { ?>
                            <?php $sl = ($rd_depts[$i]['deptId'] == $__action_on_rset['deptId']) ? ' selected="selected" ' : ''; ?>
                            <option <?php echo $sl; ?> value="<?php echo $rd_depts[$i]['deptId']; ?>"><?php echo strtoupper($rd_depts[$i]['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="info_fullname_en">Employee's Name</label>
                    <input  type="text" 
                            value="<?php echo $__action_on_rset['info_fullname_en']; ?>" 
                            name="info_fullname_en" 
                            id="info_fullname_en"  
                            class="form-control form-control-md"
                            required="required"
                            >
                </div>
                <div class="form-group col-md-3">
                    <label for="info_fathername_en">Father's Name</label>
                    <input  type="text" 
                            value="<?php echo $__action_on_rset['info_fathername_en']; ?>" 
                            name="info_fathername_en" 
                            id="info_fathername_en"  
                            class="form-control form-control-md"
                            required="required"
                            >
                </div>


                <div class="form-group col-md-3">
                    <label for="info_fullname_ar">Employee's Name [Arabic]</label>
                    <input  type="text" 
                            dir="rtl"
                            value="<?php echo $__action_on_rset['info_fullname_ar']; ?>" 
                            name="info_fullname_ar" 
                            id="info_fullname_ar"  
                            class="form-control form-control-md"
                            >
                </div>

                <div class="form-group col-md-3">
                    <label for="info_fathername_ar">Father's Name [Arabic]</label>
                    <input  type="text" 
                            dir="rtl"
                            value="<?php echo $__action_on_rset['info_fathername_ar']; ?>" 
                            name="info_fathername_ar" 
                            id="info_fathername_ar"  
                            class="form-control form-control-md"
                            >
                </div>
            </div>


            <div class="form-row">

                <div class="form-group col-md-3">
                    <label for="info_dob">Date Of Birth</label>
                    <input  type="date" 
                            value="<?php echo $__action_on_rset['info_dob']; ?>" 
                            name="info_dob" 
                            id="info_dob"  
                            class="form-control form-control-md"
                            required="required"
                            >
                </div>



                <div class="form-group col-md-3">
                    <label for="info_gender">Gender</label>
                    <select name="info_gender" id="info_gender" required="required" class="selectpicker_picker form-control" data-live-search = "true" data-style = "btn-default" style="width:100%;">
                        <option value="">Select Gender</option>
                        <option <?php echo ($__action_on_rset['info_gender'] == 'male' ) ? ' selected="selected" ' : ''; ?> value="male">Male</option>
                        <option <?php echo ($__action_on_rset['info_gender'] == 'female' ) ? ' selected="selected" ' : ''; ?> value="female">Female</option>
                    </select>
                </div>


                <div class="form-group col-md-3">
                    <label for="info_maritalstatus">Marital Status</label>
                    <select name="info_maritalstatus" id="info_maritalstatus"  class="selectpicker_picker form-control" data-live-search = "true" data-style = "btn-default" style="width:100%;">
                        <option value="">Select Gender</option>
                        <option <?php echo ($__action_on_rset['info_maritalstatus'] == 'single' ) ? ' selected="selected" ' : ''; ?> value="single">Single</option>
                        <option <?php echo ($__action_on_rset['info_maritalstatus'] == 'married' ) ? ' selected="selected" ' : ''; ?> value="married">Married</option>
                        <option <?php echo ($__action_on_rset['info_maritalstatus'] == 'divorced' ) ? ' selected="selected" ' : ''; ?> value="divorced">Divorced</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="info_countrycode">Country</label>
                    <select name="info_countrycode" id="info_countrycode" required="required" class="selectpicker_picker form-control" data-live-search = "true" data-style = "btn-default" style="width:100%;">
                        <option value="">Select Country</option>
                        <?php for ($i = 0; $i < count($rd_contr); $i++) { ?>
                            <?php $sl = ($rd_contr[$i]['country_code'] == $__action_on_rset['info_countrycode']) ? ' selected="selected" ' : ''; ?>
                            <option <?php echo $sl; ?> value="<?php echo $rd_contr[$i]['country_code']; ?>"><?php echo strtoupper($rd_contr[$i]['country_enName']); ?></option>
                        <?php } ?>
                    </select>
                </div>




            </div>




        </div>

        <div class="modal-footer m-0 p-0">
            <div class="form-row m-0 pt-3 mr-2 ml-2">
                <div class="form-group col-md-12" align="<?php echo $_right; ?>">
                    <button 
                        class="btn btn-md  btn-primary btn-icon-split" 
                        name="_tab_info_form_btn"
                        id="_tab_info_form_btn"
                        type="submit" 
                        value ="button"
                        >
                        <span class="icon text-white-100"><i class="fas fa-save"></i> Update Employee Details</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

