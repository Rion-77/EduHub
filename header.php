<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Quizzes – EduHub</title>
  <link rel="stylesheet" href="assets/css/style.css" />

  <?php  
// Get page file name
$page_link_start = strrpos("{$_SERVER['PHP_SELF']}","/");
$page_link_start++;
$page_link_finish = strrpos("{$_SERVER['PHP_SELF']}",".php");
$page_file_name = substr($_SERVER['PHP_SELF'], $page_link_start, $page_link_finish - $page_link_start);

// Checks if a particular css file exists for the page

$cssFilePath = "assets/css/$page_file_name.css";

// $absolutePath = $_SERVER['DOCUMENT_ROOT'] . $cssFile;

if (file_exists($cssFilePath)) {
    // echo "heh heh boy";
    echo "<link rel='stylesheet' href='$cssFilePath' />";
}

  ?>
</head>

<body>

<!-- ═══ NAVBAR ═══ -->
  <nav class="navbar">
    <div class="container">
      <a href="index.php" class="nav-logo">Edu<span class="logo-hub">Hub</span><span class="logo-dot"></span></a>
      <div class="nav-links">
        <a href="dashboard.html">Dashboard</a>
        <a href="courses.php" class="active">Courses</a>
        <a href="progress.html">My Progress</a>
        <a href="leaderboard.html">Leaderboard</a>
        <a href="ai-generator.html">AI Tools</a>
      </div>
      <div class="nav-actions"><a href="profile.html" class="nav-avatar">AR</a></div>
      <button class="hamburger" id="hamburger" aria-label="Menu" aria-expanded="false"><span></span><span></span><span></span></button>
    </div>
  </nav>

  <!-- ═══ MOBILE NAV ═══ -->
  <div class="mobile-nav" id="mobileNav">
    <div class="mobile-nav-inner">
      <div class="mobile-nav-user">
        <div class="nav-avatar">AR</div>
        <div>
          <div class="mobile-nav-user-name">Abdullah Rashid</div>
          <div class="mobile-nav-user-email">abdullah@example.com</div>
        </div>
      </div>
      <div class="mobile-nav-section">Navigation</div>
      <a href="dashboard.html" class="mobile-nav-link"><span class="icon">🏠</span> Dashboard</a>
      <a href="courses.html" class="mobile-nav-link active"><span class="icon">📚</span> Courses</a>
      <a href="progress.html" class="mobile-nav-link"><span class="icon">📈</span> My Progress</a>
      <a href="leaderboard.html" class="mobile-nav-link"><span class="icon">🏆</span> Leaderboard</a>
      <a href="ai-generator.html" class="mobile-nav-link"><span class="icon">✨</span> AI Tools</a>
      <div class="mobile-nav-divider"></div>
      <a href="profile.html" class="mobile-nav-link"><span class="icon">👤</span> Profile</a>
      <a href="login.html" class="mobile-nav-link"><span class="icon">🚪</span> Log Out</a>
    </div>
</div>
