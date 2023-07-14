<?php
/*
 * حقوق النشر © 2015 زيشان عباس <zeeshan@iibsys.com> <+966 55 4137245>
 *
 * هذا البرنامج هو برنامج حر ؛ يمكنك إعادة توزيعه و/أو
 * تعديله وفقًا لشروط الرخصة العامة المتداولة لـ GNU
 * كما نُشرتها مؤسسة البرمجيات الحرة ؛ الإصدار 2
 * من الرخصة ، أو (باختيارك) أي إصدار لاحق.
 *
 * يتم توزيع هذا البرنامج على أمل أن يكون مفيدًا ؛
 * ولكن دون أي ضمان ؛ دون حتى ضمان ضمني للقابلية للبيع أو الصلاحية لغرض معين. انظر
 * الرخصة العامة للبرمجيات العامة للمزيد من التفاصيل.
 *
 * يجب تلقي نسخة من الرخصة العامة للبرمجيات العامة
 * مع هذا البرنامج ؛ إذا لم يتم ذلك ، فاكتب إلى مؤسسة البرمجيات الحرة ، إنك. ، 59 معبد مكان - مجموعة 330 ، بوسطن ، ماساتشوستس 02111-1307 ، الولايات المتحدة الأمريكية.
 */
?>
<!DOCTYPE html>
<html lang="<?php echo $lang_code; ?>" dir="<?php echo $page_direction; ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title><?php echo $lib->_('عنوان_الصفحة'); ?></title>
    <?php require __DIR__ . '/../_ui/css.php'; ?>
    <style>

    </style>
</head>

<body class="text-<?php echo $_left; ?> fade-in-top" style="   
          background-color: #020041; 
          background-image: linear-gradient(180deg, #ffffff 30%, #020041 30%);
          background-size: cover !important;">
    <?php require __DIR__ . '/../_ui/loader.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div class="container">
            <div id="_php_error_response"></div>
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-10 col-md-10">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-5 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-7">
                                    <div class="p-5">
                                        <div class="text-<?php echo $_left; ?>">
                                            <h2 class="h2 mb-4">تسجيل الدخول الآن!</h2>
                                        </div>

                                        <form class="user" name="authForm" id="authForm" method="POST"
                                            onsubmit="_ajaxCall('authForm', 'auth/login'); return false;">
                                            <hr>
                                            <BR>

                                            <div id="_auth_respone_div"></div>

                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" id="user_name"
                                                    name="user_name" aria-describedby="" autocomplete="off"
                                                    placeholder="رمز الوصول أو البريد الإلكتروني">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="user_password" id="user_password"
                                                    class="form-control form-control-user" placeholder="كلمة المرور">
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="user_remember" id="user_remember">
                                                    <label class="custom-control-label"
                                                        for="user_remember">تذكرني</label>
                                                </div>
                                            </div>

                                            <div align="right">
                                                <button type="submit" class="btn btn-primary btn-user ">تسجيل
                                                    الدخول</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php require_once(__SYSTEM_JAVASCRIPTS__ . 'system.caller.js.php'); ?>
    <?php require __DIR__ . '/../_ui/scripts.php'; ?>
    <script>



    </script>
</body>

</html>