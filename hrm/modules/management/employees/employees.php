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
define('__SECTION_JS_PATH_', '__js/employees.script.php');

/*
 * Required Data
 */


//Departments
$pdo->bind('status', 'active');
$rd_depts = $pdo->query("SELECT * FROM departments WHERE `status`=:status ");


//Types
$rd_empgro = $pdo->query("SELECT * FROM employee_groups ORDER BY groId ASC");


//Designations
$rd_desig = $pdo->query("SELECT * FROM employee_designations ORDER BY desigId ASC");


//Countries
$rd_contr = $pdo->query("SELECT * FROM countries ORDER BY country_code ASC");

/*
 * Required Data
 */
?>

<div class="container-fluid">
    <h5 class="mb-2 p-1 text-gray-800">
        <a href="<?php echo __APP_URL__ . $route->q; ?>">Management</a>
        <i class="fa fa-chevron-<?php echo $_right; ?>"></i>
        Employees
    </h5>

    <br>
    <div id="__employees_module_alert_container"></div>

    <div class="row">
        <div class="col-xl-12 col-lg-12">

            <h2>Employees</h2>
            <hr>

            <div class="mb-2" align="<?php echo $_right; ?>">
                <button onclick="__create_modal();" class="btn btn-md btn-primary"> <i class="fas fa-plus"></i> Add
                    Employee </button>
            </div>
            <div class="mb-2" align="<?php echo $_right; ?>">
                <button onclick="__save_excel_employees();" class="btn btn-md btn-primary"> <i class="fas fa-plus"></i>
                    Import
                    Employees </button>
            </div>
            <div class="card o-hidden border-0 shadow p-2">
                <table id="dtc_table"
                    class="table table-lg table-responsive-sm table-condensed table-striped table-hover "
                    style="width:100%">
                    <thead>
                        <tr>
                            <th> ID.</th>
                            <th> CODE.</th>
                            <th> Name</th>
                            <th> Father Name</th>
                            <th width="100px">Options</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
</div>


<?php $from_prefix = '_create_'; ?>
<div class="modal fade" id="_create_record_modal" tabindex="-1" role="dialog"
    aria-labelledby="_create_record_modal_label">
    <div class="modal-dialog modal-xl" role="document">
        <form name="_create_record_modal_form" id="_create_record_modal_form" enctype="multipart/form-data"
            method="POST" action=""
            onsubmit="_ajaxCall('_create_record_modal_form', 'management/employees/create'); return false;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="_create_record_modal_label">Add New Employee</h4>
                    <button class="btn btn-sm btn-primary btn-default btn-icon-split" type="button"
                        data-dismiss="modal">
                        <span class="icon text-white-100" style="font-size:11px;"><i
                                class="fa fa-1x fa-times"></i></span>
                    </button>
                </div>

                <div class=" p-3">

                    <div id="_create_record_modal_response_box"></div>



                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="<?php echo $from_prefix; ?>empCode">Employment Code</label>
                            <input type="text" value="" name="<?php echo $from_prefix; ?>empCode"
                                id="<?php echo $from_prefix; ?>empCode" class="form-control form-control-md"
                                required="required">
                        </div>

                        <div class="form-group col-md-6"></div>

                        <div class="form-group col-md-3">
                            <label for="<?php echo $from_prefix; ?>info_joindate">Joining Date</label>
                            <input type="date" value="" name="<?php echo $from_prefix; ?>info_joindate"
                                id="<?php echo $from_prefix; ?>info_joindate" class="form-control form-control-md"
                                required="required">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="<?php echo $from_prefix; ?>groId">System's Type</label>
                            <select name="<?php echo $from_prefix; ?>groId" id="<?php echo $from_prefix; ?>groId"
                                required="required" class="selectpicker_picker form-control" data-live-search="true"
                                data-style="btn-default" style="width:100%;">
                                <option value="">Select Type</option>
                                <?php for ($i = 0; $i < count($rd_empgro); $i++) { ?>
                                    <option value="<?php echo $rd_empgro[$i]['groId']; ?>"><?php echo $rd_empgro[$i]['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>


                        <div class="form-group col-md-4">
                            <label for="<?php echo $from_prefix; ?>desigId">Designation</label>
                            <select name="<?php echo $from_prefix; ?>desigId" id="<?php echo $from_prefix; ?>desigId"
                                required="required" class="selectpicker_picker form-control" data-live-search="true"
                                data-style="btn-default" style="width:100%;">
                                <option value="">Select Designation</option>
                                <?php for ($i = 0; $i < count($rd_desig); $i++) { ?>
                                    <option value="<?php echo $rd_desig[$i]['desigId']; ?>"><?php echo $rd_desig[$i]['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>


                        <div class="form-group col-md-4">
                            <label for="<?php echo $from_prefix; ?>deptId">Department</label>
                            <select name="<?php echo $from_prefix; ?>deptId" id="<?php echo $from_prefix; ?>deptId"
                                required="required" class="selectpicker_picker form-control" data-live-search="true"
                                data-style="btn-default" style="width:100%;">
                                <option value="">Select Department</option>
                                <?php for ($i = 0; $i < count($rd_depts); $i++) { ?>
                                    <option value="<?php echo $rd_depts[$i]['deptId']; ?>"><?php echo $rd_depts[$i]['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="<?php echo $from_prefix; ?>info_fullname_en">Employee's Name</label>
                            <input type="text" value="" name="<?php echo $from_prefix; ?>info_fullname_en"
                                id="<?php echo $from_prefix; ?>info_fullname_en" class="form-control form-control-md"
                                required="required">
                        </div>



                        <div class="form-group col-md-3">
                            <label for="<?php echo $from_prefix; ?>info_fathername_en">Father's Name</label>
                            <input type="text" value="" name="<?php echo $from_prefix; ?>info_fathername_en"
                                id="<?php echo $from_prefix; ?>info_fathername_en" class="form-control form-control-md"
                                required="required">
                        </div>


                        <div class="form-group col-md-3">
                            <label for="<?php echo $from_prefix; ?>info_fullname_ar">Employee's Name [Arabic]</label>
                            <input type="text" value="" dir="rtl" name="<?php echo $from_prefix; ?>info_fullname_ar"
                                id="<?php echo $from_prefix; ?>info_fullname_ar" class="form-control form-control-md">
                        </div>


                        <div class="form-group col-md-3">
                            <label for="<?php echo $from_prefix; ?>info_fathername_ar">Father's Name [Arabic]</label>
                            <input type="text" value="" dir="rtl" name="<?php echo $from_prefix; ?>info_fathername_ar"
                                id="<?php echo $from_prefix; ?>info_fathername_ar" class="form-control form-control-md">
                        </div>
                    </div>


                    <div class="form-row">

                        <div class="form-group col-md-3">
                            <label for="<?php echo $from_prefix; ?>info_dob">Date Of Birth</label>
                            <input type="date" value="" name="<?php echo $from_prefix; ?>info_dob"
                                id="<?php echo $from_prefix; ?>info_dob" class="form-control form-control-md"
                                required="required">
                        </div>



                        <div class="form-group col-md-3">
                            <label for="<?php echo $from_prefix; ?>info_gender">Gender</label>
                            <select name="<?php echo $from_prefix; ?>info_gender"
                                id="<?php echo $from_prefix; ?>info_gender" required="required"
                                class="selectpicker_picker form-control" data-live-search="true"
                                data-style="btn-default" style="width:100%;">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>


                        <div class="form-group col-md-3">
                            <label for="<?php echo $from_prefix; ?>info_maritalstatus">Marital Status</label>
                            <select name="<?php echo $from_prefix; ?>info_maritalstatus"
                                id="<?php echo $from_prefix; ?>info_maritalstatus"
                                class="selectpicker_picker form-control" data-live-search="true"
                                data-style="btn-default" style="width:100%;">
                                <option value="">Select Gender</option>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="divorced">Divorced</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="<?php echo $from_prefix; ?>info_countrycode">Country</label>
                            <select name="<?php echo $from_prefix; ?>info_countrycode"
                                id="<?php echo $from_prefix; ?>info_countrycode" required="required"
                                class="selectpicker_picker form-control" data-live-search="true"
                                data-style="btn-default" style="width:100%;">
                                <option value="">Select Country</option>
                                <?php for ($i = 0; $i < count($rd_contr); $i++) { ?>
                                    <option value="<?php echo $rd_contr[$i]['country_code']; ?>"><?php echo strtoupper($rd_contr[$i]['country_enName']); ?></option>
                                <?php } ?>
                            </select>
                        </div>




                    </div>
                </div>

                <div class="modal-footer m-0 p-0">
                    <div class="form-row m-0 pt-3 mr-2 ml-2">
                        <div class="form-group col-md-12" align="<?php echo $_right; ?>">
                            <button class="btn btn-sm  btn-primary btn-icon-split" name="_create_record_modal_form_btn"
                                id="_create_record_modal_form_btn" type="submit" value="button">
                                <span class="icon text-white-100"><i class="fas fa-save"></i> Save</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>






<div class="modal fade" id="_edit_record_modal" tabindex="-1" role="dialog" aria-labelledby="_edit_record_modal_label">
    <div class="modal-dialog modal-xl " role="document">
        <div class="modal-content" id="_edit_record_ajax_interface">

        </div>
    </div>
</div>



<div id="myModal1" class="modal">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClaimModalLabel">Add Employees</h5>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="claim-excel">Excel File (Please upload excel file to add employees)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="claim-excel" name="claim-excel"
                                accept=".xls,.xlsx,.csv">
                            <label class="custom-file-label" for="claim-excel">Choose file</label>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Employees</button>
            </div>
            </form>
        </div>
    </div>

</div>

<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
include '/opt/lampp/htdocs/inat/vendor/phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the path to the uploaded file
    try {
        $file_name = $_FILES['claim-excel']['name'];
        $file_tmp = $_FILES['claim-excel']['tmp_name'];
        $file_type = $_FILES['claim-excel']['type'];
        $file_size = $_FILES['claim-excel']['size'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Save the uploaded file to a temporary directory
        $temp_dir = "/path/to/temp/directory/";
        $temp_file = tempnam($temp_dir, 'excel_');
        move_uploaded_file($file_tmp, $temp_file);
        //   $inputFileName = '/opt/lampp/htdocs/inat/Employee.xls'; // Replace with your file path
        $objReader = PHPExcel_IOFactory::createReaderForFile($temp_file);
        $objPHPExcel = $objReader->load($temp_file);
        $worksheet = $objPHPExcel->getActiveSheet();
        $worksheet = $objPHPExcel->getSheet('0');
        $lastRow = $worksheet->getHighestRow();
        $colomncount = $worksheet->getHighestDataColumn();
        $colomncount_number = PHPExcel_Cell::columnIndexFromString($colomncount);


        $sql = "INSERT INTO `employees`(`empCode`, `empRecStatus`, `branchId`, `authId`, `groId`, `deptId`, `desigId`, 
`info_fullname_en`, `info_fullname_ar`, `info_fathername_en`, `info_fathername_ar`, `info_countrycode`, `info_joindate`, 
`info_dob`, `info_gender`, `info_phone`, `info_extention`, `info_mobile`, `info_fax`, `info_homeaddress`, `info_maritalstatus`
, `info_homephone`, `info_avilabilitystatus`, `info_employmentstatus`, `id_no`, `id_is_national`, `id_expiry_date_en`, 
`id_expiry_date_ar`, `id_profession`, `id_religion`, `id_nationality`, `passport_number`, `passport_issue_date`, 
`passport_expire_date`, `passport_issued_by`, `salary_basic`, `salary_hra`, `salary_ta`, `salary_others`, `salary_discount`)
 VALUES (";
        $temp = $sql;
        for ($row = 2; $row <= 2; $row++) {
            for ($col = 0; $col <= 38; $col++) {
                if ($worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col) . 1)->getValue() == 'Auth') {
                    $pdo->bind("name", $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex(0) . $row)->getValue());
                    $pdo->bind("email", $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col) . $row)->getValue());
                    $rd_auth = $pdo->query("INSERT INTO auth (authName, authEmail, authPassword, authStatus, authIsRoot) VALUES (:name,:email,'123','active',0)");
                    $result = $pdo->query("SELECT authId as id from auth where authEmail='" . $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col) . $row)->getValue() . "'");
                    $sql = $sql . '\'' . $result[0]['id'] . '\'' . ',';
                } else
                    if ($worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col) . 1)->getValue() == 'Department') {

                        $pdo->bind('status', 'active');
                        $pdo->bind('deptName', $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col) . $row)->getValue());
                        $rd_depts = $pdo->query("SELECT deptId as id FROM departments WHERE `status`=:status AND `name`=:deptName");
                        $sql = $sql . '\'' . $rd_depts[0]['id'] . '\'' . ',';
                    } else
                        if ($worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col) . 1)->getValue() == 'Group') {

                            $pdo->bind('groName', $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col) . $row)->getValue());
                            $rd_group = $pdo->query("SELECT groId as id FROM employee_groups WHERE `name`=:groName");
                            $sql = $sql . '\'' . $rd_group[0]['id'] . '\'' . ',';
                        } else
                            if ($worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col) . 1)->getValue() == 'Designation') {
                                $pdo->bind('status', 'active');
                                $pdo->bind('desigName', $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col) . $row)->getValue());
                                $rd_desig = $pdo->query("SELECT desigId as id FROM employee_designations WHERE `status`=:status AND `name`=:desigName");
                                $sql = $sql . '\'' . $rd_desig[0]['id'] . '\'' . ',';
                            } else
                                if ($worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col) . $row)->getValue() != NULL)
                                    $sql = $sql . '\'' . $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col) . $row)->getValue() . '\'' . ',';
                                else
                                    $sql = $sql . 'NULL' . ',';

            }
            $sql = $sql . '\'' . $worksheet->getCell(PHPExcel_Cell::stringFromColumnIndex($col) . $row)->getValue() . '\'' . ")";
            $result = $pdo->query($sql);
            $sql = $temp;

        }
        echo $result;


    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }


}
?>