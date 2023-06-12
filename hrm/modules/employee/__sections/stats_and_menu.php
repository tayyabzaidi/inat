<?php
/*
 * حقوق الطبع والنشر 2015 مقدمة من زيشان عباس <zeeshan@iibsys.com> <+966 55 4137245>
 *
 * هذا البرنامج هو برنامج حر ؛ يمكنك إعادة توزيعه و/أو
 * تعديله بموجب شروط رخصة جنو العامة منشورة من قبل مؤسسة البرمجيات الحرة ؛ إما الإصدار 2
 * من الرخصة ، أو (بحسب اختيارك) أي إصدار لاحق.
 *
 * يتم توزيع هذا البرنامج على أمل أن يكون مفيدًا ،
 * لكن بدون أي ضمانات ؛ حتى دون ضمان ضمني للقابلية للبيع أو الأهلية لغرض معين.
 * راجع الرخصة العامة العامة GNU للمزيد من التفاصيل.
 *
 * يجب أن تكون قد تلقيت نسخة من الرخصة العامة العامة GNU
 * مع هذا البرنامج. إذا لم يكن الأمر كذلك ، فأكتب إلى Free Software
 * Foundation، Inc.، 59 Temple Place - Suite 330 ، بوسطن ، MA 02111-1307 ، الولايات المتحدة الأمريكية.
 */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card shadow mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item disabled">
                                <h5 class="p-0 m-0"> <i class="fa fas  fa-tasks"></i> التطبيقات</h5>
                            </li>

                            <li class="list-group-item">
                                <a href="<?php echo __APP_URL__ . $route->q . '/leaves'; ?>"><i
                                        class="fa fas  fa-arrow-<?php echo $_right; ?>"></i> الإجازات</a>
                            </li>

                            <li class="list-group-item">
                                <a href="<?php echo __APP_URL__ . $route->q . '/visa'; ?>"><i
                                        class="fa fas  fa-arrow-<?php echo $_right; ?>"></i> التأشيرات</a>
                            </li>

                            <li class="list-group-item">
                                <a href="<?php echo __APP_URL__ . $route->q . '/encashment'; ?>"><i
                                        class="fa fas  fa-arrow-<?php echo $_right; ?>"></i> السحب</a>
                            </li>
                            <li class="list-group-item">
                                <a href="<?php echo __APP_URL__ . $route->q . '/salary'; ?>"><i
                                        class="fa fas  fa-arrow-<?php echo $_right; ?>"></i> كشوف المرتبات</a>
                            </li>
                            <li class="list-group-item">
                                <a href="<?php echo __APP_URL__ . $route->q . '/expense'; ?>"><i
                                        class="fa fas  fa-arrow-<?php echo $_right; ?>"></i> المصروفات</a>
                            </li>
                            <li class="list-group-item">
                                <a href="<?php echo __APP_URL__ . $route->q . '/items'; ?>"><i
                                        class="fa fas  fa-arrow-<?php echo $_right; ?>"></i> العناصر المخصصة</a>
                            </li>
                            <li class="list-group-item">
                                <a href="<?php echo __APP_URL__ . $route->q . '/trips'; ?>"><i
                                        class="fa fas  fa-arrow-<?php echo $_right; ?>"></i>
                                    رحلة عمل</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php $rSet = $stats->__emp_get_type_balance(__EMP_ID, 'leave'); ?>
                <?php if (count($rSet)) { ?>
                    <div class="row">
                        <div class="col-sm-12 p-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item disabled">
                                    <h5 class="p-0 m-0"> <i class="fa fas  fa-tasks"></i> رصيد الإجازات</h5>
                                </li>
                                <li class="list-group-item">
                                    <table class="table table-sm table-responsive-sm table-striped"
                                        style="width:100%; font-size: 0.8em;">
                                        <thead>
                                            <tr>
                                                <th>النوع</th>
                                                <th>الحق</th>
                                                <th>متاح</th>
                                                <th>مستخدم</th>
                                                <th>الرصيد</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($i = 0; $i < count($rSet); $i++) { ?>
                                                <tr>
                                                    <td><?php echo $rSet[$i]['name']; ?> </td>
                                                    <td><?php echo $rSet[$i]['defaultValue']; ?> </td>
                                                    <td><?php echo $rSet[$i]['currentValue']; ?> </td>
                                                    <td><?php echo $rSet[$i]['usedValue']; ?> </td>
                                                    <td><?php echo ($rSet[$i]['currentValue'] - $rSet[$i]['usedValue']); ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                </li>
                            </ul>
                        </div>
                    </div>
                <?php } ?>

                <?php $rSet = $stats->__emp_get_type_balance(__EMP_ID, 'visa'); ?>
                <?php if (count($rSet)) { ?>
                    <div class="row">
                        <div class="col-sm-12 p-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item disabled">
                                    <h5 class="p-0 m-0"> <i class="fa fas  fa-tasks"></i> التأشيرات المسموح بها</h5>
                                </li>

                                <li class="list-group-item">
                                    <table class="table table-sm table-responsive-sm table-striped"
                                        style="width:100%; font-size: 0.8em;">
                                        <thead>
                                            <tr>
                                                <th>النوع</th>
                                                <th>الحق</th>
                                                <th>متاح</th>
                                                <th>مستخدم</th>
                                                <th>الرصيد</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($i = 0; $i < count($rSet); $i++) { ?>
                                                <tr>
                                                    <td><?php echo $rSet[$i]['name']; ?> </td>
                                                    <td><?php echo $rSet[$i]['defaultValue']; ?> </td>
                                                    <td><?php echo $rSet[$i]['currentValue']; ?> </td>
                                                    <td><?php echo $rSet[$i]['usedValue']; ?> </td>
                                                    <td><?php echo ($rSet[$i]['currentValue'] - $rSet[$i]['usedValue']); ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                </li>
                            </ul>
                        </div>
                    </div>
                <?php } ?>


                <?php $rSet = $stats->__emp_get_type_balance(__EMP_ID, 'ticket'); ?>
                <?php if (count($rSet)) { ?>
                    <div class="row">
                        <div class="col-sm-12 p-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item disabled">
                                    <h5 class="p-0 m-0"> <i class="fa fas  fa-tasks"></i> تذاكر</h5>
                                </li>

                                <li class="list-group-item">
                                    <table class="table table-sm table-responsive-sm table-striped"
                                        style="width:100%; font-size: 0.8em;">
                                        <thead>
                                            <tr>
                                                <th>النوع</th>
                                                <th>الحق</th>
                                                <th>متاح</th>
                                                <th>مستخدم</th>
                                                <th>الرصيد</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php for ($i = 0; $i < count($rSet); $i++) { ?>
                                                <tr>
                                                    <td><?php echo $rSet[$i]['name']; ?> </td>
                                                    <td><?php echo $rSet[$i]['defaultValue']; ?> </td>
                                                    <td><?php echo $rSet[$i]['currentValue']; ?> </td>
                                                    <td><?php echo $rSet[$i]['usedValue']; ?> </td>
                                                    <td><?php echo ($rSet[$i]['currentValue'] - $rSet[$i]['usedValue']); ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                </li>


                            </ul>
                        </div>

                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>