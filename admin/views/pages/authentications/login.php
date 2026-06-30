<?php
require_once "models/authentication.class.php";

// Check if users logged in 
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard");
}


if (isset($_POST['login-email']) && isset($_POST['login-password'])) {
    $email = $_POST['login-email'];
    $password = $_POST['login-password'];

    $user = Authentication::login($email, $password);

    if (isset($user['email_error'])) {
        $email_error = "<p class='text-danger pt-1'>{$user['email_error']}</p>";
    } elseif (isset($user['password_error'])) {
        $password_error = "<p class='text-danger pt-1'>{$user['password_error']}</p>";
    } else {
        // echo "<pre>";
        // print_r($user);
        // echo "</pre>";
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['user_role'] = $user['role_name'];
        $_SESSION['user_picture_link'] = $user['user_picture_link'];
        $_SESSION['total_quiz_score'] = $user['total_quiz_score'];
        header("Location: dashboard");
    }
}

?>
<style>
    #page-container {
        padding-left: 0 !important;
    }
</style>
<!-- Main Container -->
<main id="main-container" class="pt-0">
    <!-- Page Content -->
    <div class="hero-static d-flex align-items-center">
        <div class="content px-0">
            <div class="row justify-content-center push">
                <div class="col-md-8 col-lg-6 col-xl-4 px-0">
                    <!-- Sign In Block -->
                    <div class="block block-rounded mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Sign In</h3>
                            <div class="block-options">
                                <a class="btn-block-option fs-sm" href="op_auth_reminder.html">Forgot Password?</a>
                                <a class="btn-block-option js-bs-tooltip-enabled" href="op_auth_signup.html" data-bs-toggle="tooltip" data-bs-placement="left" aria-label="New Account" data-bs-original-title="New Account">
                                    <i class="fa fa-user-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
                                <h1 class="h2 mb-1">Eduhub</h1>
                                <p class="fw-medium text-muted">
                                    Welcome, please login.
                                </p>

                                <!-- Sign In Form -->
                                <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js) -->
                                <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                <form class="js-validation-signin" action="" method="POST" novalidate="novalidate">
                                    <div class="py-3">
                                        <div class="mb-4">
                                            <input type="text" class="form-control form-control-alt form-control-lg" id="login-email" name="login-email" placeholder="Email" value="<?= $_POST['login-email'] ?? "" ?>">
                                            <?= $email_error ?? "" ?>
                                        </div>
                                        <div class="mb-4">
                                            <input type="password" class="form-control form-control-alt form-control-lg" id="login-password" name="login-password" placeholder="Password" value="<?= $_POST['login-password'] ?? "" ?>">
                                            <?= $password_error ?? "" ?>
                                        </div>
                                        <div class="mb-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="login-remember" name="login-remember">
                                                <label class="form-check-label" for="login-remember">Remember Me</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-6 col-xl-5">
                                            <button type="submit" class="btn w-100 btn-alt-primary">
                                                <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i> Sign In
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <!-- END Sign In Form -->
                            </div>
                        </div>
                    </div>
                    <!-- END Sign In Block -->
                </div>
            </div>
            <div class="fs-sm text-muted text-center">
                <strong>Eduhub</strong> © <span data-toggle="year-copy" class="js-year-copy-enabled">2026</span>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->