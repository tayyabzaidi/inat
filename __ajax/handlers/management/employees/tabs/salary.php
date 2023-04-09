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
<div class="tab-pane fade" id="salary" aria-labelledby="salary-tab" role="tabpanel" >
    <form name="_tab_salary_form" 
          id="_tab_salary_form" 
          enctype="multipart/form-data"  
          method="POST" 
          action=""
          onsubmit="_ajaxCall('_tab_salary_form', 'management/employees/tabs/__tabs_handler/update-salary'); return false;"
          >
        <input type="hidden" name="__salary_tab_action_on" id="__salary_tab_action_on" value="<?php echo $__action_on; ?>" />

        <div class="container">
            <br>
            <h4>Salary Details</h4>
            <hr>
            <div id="_tab_salary_form_response"></div>


            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="salary_basic">Basic</label>
                    <input  type="number" 
                            value="<?php echo $__action_on_rset['salary_basic']; ?>" 
                            name="salary_basic" 
                            id="salary_basic"  
                            class="form-control form-control-md"
                            required="required"
                            >
                </div>


                <div class="form-group col-md-4">
                    <label for="salary_hra">HRA </label>
                    <input  type="number" 
                            value="<?php echo $__action_on_rset['salary_hra']; ?>" 
                            name="salary_hra" 
                            id="salary_hra"  
                            class="form-control form-control-md"
                            required="required"
                            >
                </div>

                <div class="form-group col-md-4">
                    <label for="salary_ta">Traveling</label>
                    <input  type="number" 
                            value="<?php echo $__action_on_rset['salary_ta']; ?>" 
                            name="salary_ta" 
                            id="salary_ta"  
                            class="form-control form-control-md"
                            required="required"
                            >
                </div>

            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="salary_others">Others</label>
                    <input  type="number" 
                            value="<?php echo $__action_on_rset['salary_others']; ?>" 
                            name="salary_others" 
                            id="salary_others"  
                            class="form-control form-control-md"
                            required="required"
                            >
                </div>

                <div class="form-group col-md-4"></div>

                <div class="form-group col-md-4">
                    <label for="salary_discount">Salary Discount</label>
                    <input  type="number" 
                            value="<?php echo $__action_on_rset['salary_discount']; ?>" 
                            name="salary_discount" 
                            id="salary_discount"  
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
                        name="_tab_salary_form_btn"
                        id="_tab_salary_form_btn"
                        type="submit" 
                        value ="button"
                        >
                        <span class="icon text-white-100"><i class="fas fa-save"></i> Update Salary</span>
                    </button>
                </div>
            </div>
        </div>
    </form>

</div>