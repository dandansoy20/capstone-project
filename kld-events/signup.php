<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('admin/control/db.php');
if (array_key_exists('ajax', $_GET)) {
    echo "The page you're trying to access is inaccessible.";
} else {
    if($_GET['ajax'] =="account_activation"){
        $_SESSION['activation_key'] = $_GET['activation_key'];
        if($_SESSION['activation_key'] == "") die("The page you're trying to access is inaccessible.");
        $_SESSION['kld_email'] = "";
        $try = mysqli_query($conn,"Select * from std_acc where std_activation_key = '".$_SESSION['activation_key']."'");
        while ($row = $try->fetch_array()){
            echo "success";
            $_SESSION['kld_id'] = $row['std_kld_id'];
            $_SESSION['kld_email'] = $row['std_kld_email'];
            $_SESSION['kld_fname'] = $row['std_fname'];
            $_SESSION['kld_lname'] = $row['std_lname'];
        }
        if($_SESSION['kld_email'] == "") die("The page you're trying to access is inaccessible.");
?>
<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 9 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
    <base href="">
    <meta charset="utf-8" />
    <title>Metronic | Login Page 5</title>
    <meta name="description" content="Login page example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->


    <!--begin::Page Custom Styles(used by this page)-->
    <link href="org-admin/assets/css/pages/login/classic/login-5.css" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->

    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="org-admin/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="org-admin/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="org-admin/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->

    <!--begin::Layout Themes(used by all pages)-->

    <link href="org-admin/assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="org-admin/assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
    <link href="org-admin/assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
    <link href="org-admin/assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->

    <link rel="shortcut icon" href="org-admin/assets/media/logos/kldlogo.png" />

</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-5 login-signin-on d-flex flex-row-fluid" id="kt_login">
            <div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid"
                style="background-image: url(org-admin/assets/media/bg/bg-2.jpg);">
                <div class="login-form text-center text-white p-7 position-relative overflow-hidden">
                    <!--begin::Login Header-->
                    <div class="d-flex flex-center mb-15">
                        <a href="#">
                            <img src="org-admin/assets/media/logos/kldlogo.png" class="max-h-75px" alt="" />
                        </a>
                    </div>
                    <!--begin::Login Sign up form-->
                    <div class="login-signin">
                        <div class="mb-20">
                            <h3 class="opacity-40 font-weight-normal">Sign Up</h3>
                            <p class="opacity-40">Enter your details to create your account</p>
                        </div>
                        <form class="form text-center" id="kt_login_signup_form">
                            <div class="form-group ">
                                <input
                                    class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
                                    type="text" placeholder="KLD ID" disabled value="<?php echo $_SESSION['kld_id'] ?>" />
                            </div>
                            <div class="form-group">
                                <input
                                    class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
                                    type="text" placeholder="KLD Email" disabled value="<?php echo $_SESSION['kld_email'] ?>" autocomplete="off" />
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">

                                        <input
                                            class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
                                            type="" placeholder="First Name" id="kld_signup_fname" value="<?php echo $_SESSION['kld_fname'] ?>" />
                                    </div>
                                    <div class="col-6">

                                        <input
                                            class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
                                            type="" placeholder="Last Name" id="kld_signup_lname" value="<?php echo $_SESSION['kld_lname'] ?>" />
                                    </div>
                                </div>
                            </div>



                            <div class="form-group">
                                <input
                                    class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
                                    type="" placeholder="Username" id="kld_username" />
                            </div>

                            <div class="form-group">
                                <input
                                    class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
                                    type="password" placeholder="Password" id="kld_password" />
                            </div>
                            <div class="form-group">
                                <input
                                    class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
                                    type="password" placeholder="Confirm Password" id="kld_password2" />
                            </div>
                            <div class="form-group text-left px-8">
                                <div class="checkbox-inline">
                                    <label class="checkbox checkbox-outline checkbox-white opacity-60 text-white m-0">
                                        <input type="checkbox" name="agree" />
                                        <span></span>
                                        I Agree the <a href="#" class="text-white font-weight-bold ml-1">terms and
                                            conditions</a>.
                                    </label>
                                </div>
                                <div class="form-text text-muted text-center"></div>
                            </div>
                            <div class="form-group">
                                <button id="kld_submit"
                                    class="btn btn-pill btn-primary opacity-90 px-15 py-3 m-2">Sign Up</button>
                                <button href="index.php" class="btn btn-pill btn-outline-white opacity-70 px-15 py-3 m-2">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <!--end::Login Sign up form-->
                </div>
            </div>
        </div>
        <!--end::Login-->
    </div>
    <!--end::Main-->


    <script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1400
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };
    </script>
    <!--end::Global Config-->

    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="org-admin/assets/plugins/global/plugins.bundle.js"></script>
    <script src="org-admin/assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
    <script src="org-admin/assets/js/scripts.bundle.js"></script>
    <script src="js/signup.js"></script>
    <!--end::Global Theme Bundle-->


    <!--begin::Page Scripts(used by this page)-->
    <script src="org-admin/assets/js/pages/custom/login/login-general.js"></script>
    <!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>
<?php
    }
    else {
        die("The page you're trying to access is inaccessible.");
    }
}
?>