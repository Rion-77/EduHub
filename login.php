<?php
require_once "config/database-connect.php";
require_once "models/authentication.class.php";

//Check if users logged in 
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
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
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['user_role'] = $user['role_name'];
        $_SESSION['user_picture_link'] = $user['user_picture_link'];
        $_SESSION['total_quiz_score'] = $user['total_quiz_score'];
        header("Location: profile.php");
    }
}

?>


<!-- Header -->
<?php include_once "header.php" ?>

<div class="auth-wrap">
  <div class="auth-grid anim-fade-up">
    <div class="auth-visual">
      <div class="auth-logo">Edu<span>Hub</span> ·</div>
      <div class="auth-vc">
        <h2>Learn. Quiz.<br>Grow Together.</h2>
        <p>Join thousands of students mastering their courses with AI-powered quizzes and real-time leaderboards.</p>
        <div class="auth-stats">
          <div><div class="auth-stat-num">2,400+</div><div class="auth-stat-lbl">Students</div></div>
          <div><div class="auth-stat-num">180+</div><div class="auth-stat-lbl">Quizzes</div></div>
          <div><div class="auth-stat-num">98%</div><div class="auth-stat-lbl">Satisfaction</div></div>
        </div>
      </div>
      <div style="font-size:.76rem;color:rgba(255,255,255,.35);position:relative;z-index:1">© 2025 EduHub · Learning Platform</div>
    </div>

    <!-- PHP: action="login.php" method="POST" -->
    <div class="auth-form">
      <div class="auth-tabs">
        <div class="auth-tab active">Log In</div>
        <a href="register.html" class="auth-tab">Register</a>
      </div>

      <h3 style="margin-bottom:5px">Welcome back! 👋</h3>
      <p style="margin-bottom:24px;font-size:.88rem">Log in to continue your learning journey.</p>

      <!-- PHP: if ($error) echo error -->
      <!-- <div class="alert alert-danger"><span>⚠️</span><span>Invalid email or password.</span></div> -->

      <form action="" method="POST">
      <div class="form-group">
        <label class="form-label">Email Address</label>
        <input class="form-input" type="email" name="login-email" placeholder="you@example.com" required/>
      </div>
      <div class="form-group">
        <label class="form-label">Password</label>
        <input class="form-input" type="password" name="login-password" placeholder="Enter your password" required/>
        <!-- <a href="#" class="forgot">Forgot password?</a> -->
      </div>

      <button type="submit" class="btn btn-primary w-full" style="justify-content:center;margin-bottom:4px">Log In to EduHub</button>
      </form>
      
      <p style="text-align:center;font-size:.84rem;color:var(--slate)">Don't have an account? <a href="register.html" style="color:var(--primary);font-weight:700">Sign up free →</a></p>
    </div>
  </div>
</div>

<script src="assets/js/main.js"></script>
</body>
</html>
