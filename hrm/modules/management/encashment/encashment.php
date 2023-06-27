<!DOCTYPE html>
<html lang="<?php echo $lang_code; ?>">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<head>
    <style>
        /* Add this to your CSS code */
        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
        }
    .modal-image-container {
        display: flex;
        flex-wrap: wrap;
        /* Allow images to wrap to a new line if they exceed the container width */
    }

    .modal-image {
        width: 10%;
        padding: 5px;
        margin-right: 10px;
        /* Add some spacing between the images */
    }

    .claim-view-images {
        border: 1px solid #f0f2f5;
        display: inline;
        margin-left: 10px;
        margin-bottom: 5px;
        cursor: pointer;
    }

    .modal-dialog {
        height: 150%;
        max-width: 80%;
        margin: 1.75rem auto;
    }

    .modal-content {
        background-color: #fefefe;
        margin: auto;
        margin-top: 10%;
        margin-bottom: 10%;
        padding: 20px;
        border: 1px solid #888;
        width: 60%;
        height: 40%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    form {
        float: right;
        margin-right: 20px;
        margin-bottom: 10px;
    }

    .form-container {
        float: right;
        width: 50%;
    }

    .ant-tag {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        color: rgba(0, 0, 0, .65);
        font-size: 14px;
        font-variant: tabular-nums;
        line-height: 1.5;
        list-style: none;
        -webkit-font-feature-settings: "tnum";
        font-feature-settings: "tnum";
        display: inline-block;
        height: 22px;
        margin-right: 8px;
        padding: 0 7px;
        font-size: 12px;
        line-height: 20px;
        white-space: nowrap;
        background: #fafafa;
        border: 1px solid #d9d9d9;
        border-radius: 4px;
        cursor: pointer;
        opacity: 1;
        -webkit-transition: all .3s cubic-bezier(.215, .61, .355, 1);
        -o-transition: all .3s cubic-bezier(.215, .61, .355, 1);
        transition: all .3s cubic-bezier(.215, .61, .355, 1);
    }
</style>
</head>
<div class="row" style="width: 98%;margin-left: 1%;">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
        <div class="card-body">
            <h3>قائمة الصرف</h3>

            <div class="form-container">
                  <form action="#" method="POST">
    <label for="dateFrom">تاريخ من:</label>
    <input type="date" id="dateFrom" name="dateFrom">
    <label for="dateTo">تاريخ إلى:</label>
    <input type="date" id="dateTo" name="dateTo">
    <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-filter"></i>
        تاريخ</button>
</form>

<form action="#" method="POST">
    <label for="employeeId">الموظف:</label>
    <input type="text" id="employee" name="employee">
    <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-filter"></i>
        موظف</button>
</form>
</div>
<table class="table table-sm table-responsive-sm table-condensed table-striped" style="width:100%">
    <thead>
        <tr>
            <th>الرقم</th>
            <th>التاريخ</th>
            <th>الاسم</th>
            <th>المرفق</th>
            <th>الموافقة</th>
            <th>الرفض</th>
        </tr>
    </thead>
    <tbody>
        <?php


                        $dateFrom = isset($_POST['dateFrom']) ? $_POST['dateFrom'] : null;
                        $dateTo = isset($_POST['dateTo']) ? $_POST['dateTo'] : null;
                        $employee = isset($_POST['employee']) ? $_POST['employee'] : null;

                        $sql = 'SELECT ee.*,e.info_fullname_en as `name` FROM employee_encashments ee join employees e on e.empId=ee.employee_id';

                        if (!empty($dateFrom) && !empty($dateTo)) {
                            // المستخدم قدم كلاً من مرشحات التاريخ
                            $sql .= " WHERE ee.date BETWEEN '$dateFrom' AND '$dateTo' ORDER BY ee.`date`;";
                        } else if (!empty($employee)) {
                            $sql .= " AND e.info_fullname_en like '%" . $employee . "%'  ORDER BY ee.date;";
                        } else
                            $sql .= " ORDER BY ee.`date`;";


                        $recEmpData = $pdo->query(
                            $sql
                        );

                        ?>
                        <?php for ($i = 0; $i < count($recEmpData); $i++) { ?>
                            <tr>
                                <td><?php echo $recEmpData[$i]['unique_id']; ?>
                                </td>
                                <td><?php echo $recEmpData[$i]['date']; ?>
                                </td>
                                <td><?php echo $recEmpData[$i]['name']; ?>
                                </td>
                
                                <td><button class="attachment-btn" data-id="<?php echo $recEmpData[$i]["id"] ?>"
                                        style="background: none;"><i class="fa fa-folder"></i></button></td>
                
                                </td>
                
                                <td>
                                    <form action="#" method="POST" id="myForm">
                                        <!-- other form inputs -->
                                        <label>
                                            <input type="checkbox" name="status" value="approve" onchange="this.form.submit();" <?php
                                            $pdo->bind('employeeId', $_SESSION['empId']);
                                            $pdo->bind('encashmentId', $recEmpData[$i]['id']);
                                            $s = $pdo->query('select "approve" as `status` from status s join employee_encashment_status ees join employees e on s.id=ees.statusId and s.designation_id=e.desigId where e.empId=:employeeId and ees.encashmentId=:encashmentId
                                and s.status_name not like "%disapproved";');
                                            if ($s[0]['status'] == 'approve')
                                                echo "checked"; ?>>
                                        </label>
                                        <input type="hidden" name="encashmentId" value="<?php echo $recEmpData[$i]['id']; ?>">
                                        <input type="hidden" name="action" value="update">
                                        <button type="submit" style="display:none;"></button>
                                    </form>
                                </td>
                                <td>
                                    <?php
                                    // استعادة حالة مربع الاختيار من الخادم
                                    $pdo->bind('employeeId', $_SESSION['empId']);
                                    $pdo->bind('encashmentId', $recEmpData[$i]['id']);
                                    $s = $pdo->query('select "disapprove" as `status` from status s join employee_encashment_status ees join employees e on s.id=ees.statusId and s.designation_id=e.desigId where e.empId=:employeeId and ees.encashmentId=:encashmentId and s.status_name like "%disapproved";');
                                    $isChecked = $s[0]['status'] == "disapprove";
                                    ?>
                                    <form action="#" method="POST" id="myForm">
                                        <!-- other form inputs -->
                                        <label>
                                            <input type="checkbox" name="status" value="disapprove" onchange="this.form.submit();" <?php if ($isChecked) {
                                                echo "checked";
                                            } ?>>
         </label>
                                        <input type="hidden" name="encashmentId" value="<?php echo $recEmpData[$i]['id']; ?>">
                                        <button type="submit" style="display:none;"></button>
                                    </form>
                
                                    <!-- save the staus hod or am approve base on the user id -->
                                    <?php
                        } ?>
                            </td>
                        </tr>
                
                    </tbody>
                
                </table>
                </div>
                </div>
                </div>
                </div>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $status = $_POST['status'];
                    $encashmentId = $_POST['encashmentId'];
                    $pdo->bind('employeeId', $_SESSION['empId']);
                    $getDesignation = $pdo->query('SELECT d.name from employee_designations d join employees e on e.desigId=d.desigId where e.empId=:employeeId and d.name in ("DEPARTMENT HEAD","HR MANAGER")');

                    if (!empty($getDesignation)) {
                        if ($status == "approve") {
                            $setStatus = 0;
                            if ($getDesignation[0]['name'] == 'DEPARTMENT HEAD') {
                                $getStatus = $pdo->query("select id from status where status_name like ('HOD_a%');");
                                $setStatus = $getStatus[0]['id'];
                            }

                            if ($getDesignation[0]['name'] == 'HR MANAGER') {
                                $getStatus = $pdo->query("select id from status where status_name like ('HR_a%');");
                                if (!empty($getStatus)) {
                                    $setStatus = $getStatus[0]['id'];
                                }
                            }
                        }
                        if ($status == "disapprove") {
                            $setStatus = 0;
                            if ($getDesignation[0]['name'] == 'DEPARTMENT HEAD') {
                                $getStatus = $pdo->query("select id from status where status_name like ('HOD_d%');");
                                if (!empty($getStatus))
                                    $setStatus = $getStatus[0]['id'];
                            }

                            if ($getDesignation[0]['name'] == 'HR MANAGER') {
                                $getStatus = $pdo->query("select id from status where status_name like ('HR_d%');");
                                if (!empty($getStatus))
                                    $setStatus = $getStatus[0]['id'];
                            }
                        }
                        if ($setStatus != 0) {
                            $pdo->bind("id", $setStatus);
                            $pdo->bind("encashmentId", $encashmentId);
                            //issue---------------------------------------------------------------------------------------------------------------
                            $result = $pdo->query("INSERT INTO employee_encashment_status  (statusId , encashmentId) values (:id,:encashmentId)");
                            echo "<meta http-equiv='refresh' content='0'>";

                        }
                    }
                }

                ?>
                <script>
                    document.getElementById('myForm').addEventListener('submit', function (event) {
                        event.preventDefault();
                        var checkbox = document.getElementsByName('status')[0];
                        checkbox.checked = !checkbox.checked;
                        checkbox.dispatchEvent(new Event('change'));
                        event.target.submit();
                    });
                    $(document).ready(function () {
                        // ربط حدث النقر بأزرار المرفقات
                        $(".attachment-btn").on("click", function () {
                            // الحصول على معرف المصروف من السمة data-id للزر
                            var encashmentId = $(this).data("id");
                            var __table_url = '<?php echo __AJAX_CALL_PATH__; ?>?_path=management/expense/get_attachment/get_attachment';
                            $.ajax({
                                url: __table_url,
                                "data": {
                                    "foreignId": encashmentId,
                                    "type": "encashment"
                                },
                                type: 'POST',
                                dataType: "json",
                                success: function (data) {
                                    var images = [];
                                    if (data.result === null) {
                                        // عرض رسالة تنبيه إذا لم تكن هناك مرفقات
                                        alert("لا توجد مرفقات.");
                                        return;
                                    }
                                    // حلقة عبر البيانات الثنائية وتحويلها إلى سلاسل مشفرة بترميز base64
                                    for (var i = 0; i < data.result.length; i++) {
                                        images.push("data:image/jpeg;base64," + (data.result[i]));
                                        console.log(images[i]);
                                    }
                                    // إنشاء نموذج لعرض الصور
                                    var modal = $('<div id="myModal2" class="modal"></div>');

                                    // إنشاء مربع حوار النموذج
                                    var dialog = $('<div class="modal-dialog" role="document"></div>');

                                    // إنشاء حاوية لمحتوى النموذج
                                    var content = $('<div class="modal-content"></div>');

                                    // إنشاء رأس للنموذج
                                    var header = $('<div class="modal-header"></div>');

                                    // إنشاء عنوان للنموذج
                                    var title = $('<h5 class="modal-title" id="viewAttachmentsLabel">المرفقات</h5>');

                                    // إنشاء زر إغلاق
                                    var closeButton = $('<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>');

                                    // إنشاء رمز X للزر
                                    var closeSymbol = $('<span aria-hidden="true">&times;</span>');

                                    // إضافة رمز الإغلاق إلى زر الإغلاق
                                    closeButton.append(closeSymbol);

                                    // إضافة عنوان النموذج وزر الإغلاق إلى رأس النموذج
                                    header.append(title);
                                    header.append(closeButton);

                                    // إنشاء هيكل لعرض الصور
                                    var body = $('<div class="modal-body"></div>');

                                    // إنشاء صف لعرض الصور
                                    var row = $('<div class="row"></div>');

                                    // إنشاء عمود لعرض الصور
                                    var column = $('<div class="col-md-12"></div>');

                                    // إضافة صور البيانات المشفرة إلى العمود
                                    for (var j = 0; j < images.length; j++) {
                                        var image = $('<img src="' + images[j] + '" alt="Attachment Image" class="img-thumbnail" style="margin: 5px; width: auto; max-height: 200px;">');
                                        column.append(image);
                                    }

                                    // إضافة العمود إلى الصف
                                    row.append(column);

                                    // إضافة الصف إلى الهيكل
                                    body.append(row);

                                    // إضافة رأس النموذج وهيكل العرض إلى محتوى النموذج
                                    content.append(header);
                                    content.append(body);

                                    // إضافة محتوى النموذج إلى حاوية النموذج
                                    dialog.append(content);

                                    // إضافة حاوية النموذج إلى النموذج نفسه
                                    modal.append(dialog);

                                    // إظهار النموذج
                                    $("body").append(modal);
                                    $("#myModal2").modal('show');
                                }
                            });
                        });
                    });
                </script>
</html>