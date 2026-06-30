<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Quizzes – EduHub</title>
  <link rel="stylesheet" href="assets/css/style.css" />

  <?php
  // Get page file name
  $page_link_start = strrpos("{$_SERVER['PHP_SELF']}", "/");
  $page_link_start++;
  $page_link_finish = strrpos("{$_SERVER['PHP_SELF']}", ".php");
  $page_file_name = substr($_SERVER['PHP_SELF'], $page_link_start, $page_link_finish - $page_link_start);

  // Checks if a particular css file exists for the page

  $cssFilePath = "assets/css/$page_file_name.css";

  // $absolutePath = $_SERVER['DOCUMENT_ROOT'] . $cssFile;

  if (file_exists($cssFilePath)) {
    // echo "heh heh boy";
    echo "<link rel='stylesheet' href='$cssFilePath' />";
  }

  ?>

  <style>
    .user-menu {
      position: relative;
    }

    .avatar-trigger {
      background: none;
      border: none;
      padding: 0;
      cursor: pointer;
      display: block;
    }

    .user-dropdown {
      position: absolute;
      top: 100%;
      right: 0;
      /* small gap-bridge so the dropdown doesn't disappear when crossing the gap to the avatar */
      margin-top: 8px;
      min-width: 160px;
      background: #fff;
      border: 1px solid #e5e5e5;
      border-radius: 10px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
      padding: 6px;
      opacity: 0;
      visibility: hidden;
      transform: translateY(-6px);
      transition: opacity 0.15s ease, transform 0.15s ease, visibility 0.15s ease;
      z-index: 1000;
    }

    /* invisible bridge so hovering the gap between avatar and dropdown doesn't close it */
    .user-dropdown::before {
      content: "";
      position: absolute;
      top: -10px;
      right: 0;
      left: 0;
      height: 10px;
    }

    .user-menu:hover .user-dropdown,
    .user-menu:focus-within .user-dropdown {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }

    .user-dropdown-item {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 8px 12px;
      border-radius: 6px;
      color: #333;
      text-decoration: none;
      font-size: 14px;
      white-space: nowrap;
    }

    .user-dropdown-item:hover {
      background: #f3f4f6;
    }

    .user-dropdown-item .icon {
      font-size: 16px;
    }
  </style>
</head>

<body>

  <!-- ═══ NAVBAR ═══ -->
  <nav class="navbar">
    <div class="container">
      <a href="index.php" class="nav-logo">Edu<span class="logo-hub">Hub</span><span class="logo-dot"></span></a>
      <div class="nav-links">
        <!-- <a href="dashboard.html">Dashboard</a> -->
        <a href="courses.php" class="active">Courses</a>
        <a href="ai-generator.php">AI Tools</a>
        <a href="leaderboard.php">Leaderboard</a>
        <?php if (isset($_SESSION['user_id'])) { ?>
        <a href="profile.php">My Profile</a>
          <?php } ?>
      </div>

      <!-- login/register button -->
      <?php if (isset($_SESSION['user_id'])) { ?>
        <div class="nav-actions">
          <div class="user-menu">
            <button type="button" class="avatar-trigger" aria-haspopup="true" aria-expanded="false">
              <img class="rounded-circle" src="<?= $_SESSION['user_picture_link'] ?>" alt="Header Avatar" style="width: 40px;border-radius:50%;border: 1px solid green">
            </button>
            <div class="user-dropdown">
              <a href="profile.php" class="user-dropdown-item">
                 Profile
              </a>
              <a href="logout.php" class="user-dropdown-item">
                Logout
              </a>
            </div>
          </div>
        </div>
      <?php } else { ?>
        <div class="nav-actions">
          <div class="nav-links"><a href="login.php">Login/Register</a></div>
        </div>
      <?php } ?>

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
      <!-- <a href="dashboard.html" class="mobile-nav-link"><span class="icon">🏠</span> Dashboard</a> -->
      <a href="courses.php" class="mobile-nav-link active"><span class="icon">📚</span> Courses</a>
      <!-- <a href="progress.html" class="mobile-nav-link"><span class="icon">📈</span> My Progress</a> -->
      <a href="leaderboard.php" class="mobile-nav-link"><span class="icon">🏆</span> Leaderboard</a>
      <a href="ai-generator.php" class="mobile-nav-link"><span class="icon">✨</span> AI Tools</a>
      <div class="mobile-nav-divider"></div>
      <!-- <a href="profile.html" class="mobile-nav-link"><span class="icon">👤</span> Profile</a> -->
      <!-- <a href="login.html" class="mobile-nav-link"><span class="icon">🚪</span> Log Out</a> -->
    </div>
  </div>