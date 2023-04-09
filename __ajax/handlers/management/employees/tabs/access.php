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
<div class="tab-pane fade" id="access" aria-labelledby="access-tab" role="tabpanel" >
    <?php
    /*
     * Employee Auth Object
     */

    $__emp_aut_id = (int) $__action_on_rset['authId'];

    if ($__emp_aut_id) {
        $pdo->bind("authId", $__emp_aut_id);
        $__emp_aut_data = $pdo->row("SELECT authName,authEmail,authStatus FROM auth WHERE authId=:authId ");
        $__emp_aut_data['authStatus'] = ($__emp_aut_data['authStatus'] == 'active') ? 'true' : 'false';
    } else {
        $__emp_aut_data['authName'] = '';
        $__emp_aut_data['authEmail'] = '';
        $__emp_aut_data['authStatus'] = 'false';
    }
    /*
     * Employee Auth Object
     */
    ?>


    <form name="_tab_access_form" 
          id="_tab_access_form" 
          enctype="multipart/form-data"  
          method="POST" 
          action=""
          onsubmit="_ajaxCall('_tab_access_form', 'management/employees/tabs/__tabs_handler/update-access'); return false;"
          >
        <input type="hidden" name="__access_tab_action_on" id="__access_tab_action_on" value="<?php echo $__action_on; ?>" />

        <div class="container">
            <br>
            <h4>Access Control</h4>
            <hr>

            <div id="_tab_access_form_response"></div>

            <BR>
            <div class="form-row">
                <div class="form-group col-md-12 text-right">
                    <?php
                    $pyt_chk_status = ($__emp_aut_data['authStatus'] == 'true') ? ' checked ' : '';
                    ?>
                    <label for="authStatus">System Access</label> : 
                    <input data-offstyle="danger" 
                           data-width="100" <?php echo $pyt_chk_status; ?>   
                           data-on="Allowed" 
                           data-off="Blocked"  
                           name="authStatus" 
                           id="authStatus" 
                           class="bootstrapToggleInit" 
                           type="checkbox"  
                           data-toggle="toggle"  
                           data-style="ios" >
                </div>
            </div>
            


            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="authName">Access Code</label>
                    <input  type="text" 
                            value="<?php echo $__emp_aut_data['authName']; ?>" 
                            name="authName" 
                            id="authName"  
                            class="form-control form-control-md"
                            required="required"
                            >
                </div>

                <div class="form-group col-md-8">
                    <label for="authEmail">Email</label>
                    <input  type="email" 
                            value="<?php echo $__emp_aut_data['authEmail']; ?>" 
                            name="authEmail" 
                            id="authEmail"  
                            class="form-control form-control-md"
                            required="required"
                            >
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="p1">Password</label>
                    <input  type="password" 
                            value="" 
                            name="p1" 
                            id="p1"  
                            class="form-control form-control-md"
                            required="required"
                            >
                </div>


                <div class="form-group col-md-6">
                    <label for="p2">Re-type Password</label>
                    <input  type="password" 
                            value="" 
                            name="p2" 
                            id="p2"  
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
                        name="_tab_access_form_btn"
                        id="_tab_access_form_btn"
                        type="submit" 
                        value ="button"
                        >
                        <span class="icon text-white-100"><i class="fas fa-save"></i> Update Access Details</span>
                    </button>
                </div>
            </div>
        </div>
    </form>

</div>