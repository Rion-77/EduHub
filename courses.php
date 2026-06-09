<?php 
require_once 'config/database-connect.php';

/* 
1. get all categories from database
2. display categoris on the page
*/

// Gets all categories from database
$sql = "SELECT id,name,description FROM `quiz_category` WHERE parent_id = 0
";

$result = $db->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

// echo "<pre>";
// print_r($rows);
// echo "</pre>";





?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Quizzes – EduHub</title>
  <link rel="stylesheet" href="assets/css/style.css"/>
  <style>
    .courses-hero { background:linear-gradient(135deg,#f8f5ff,#fffbec); padding:48px 0 36px; border-bottom:1.5px solid var(--border); }
    .search-bar { display:flex;max-width:540px;background:var(--surface);border:1.5px solid var(--border);border-radius:var(--radius-lg);overflow:hidden;box-shadow:var(--shadow-sm); }
    .search-bar input { flex:1;padding:13px 18px;border:none;outline:none;font-family:var(--font-body);font-size:.93rem;color:var(--navy);background:transparent; }
    .search-bar button { padding:13px 22px;background:var(--primary);color:#fff;font-family:var(--font-display);font-weight:700;font-size:.88rem;transition:background var(--transition); }
    .search-bar button:hover { background:var(--primary-dark); }
    .course-meta-item { display:flex;align-items:center;gap:5px;font-size:.78rem;color:var(--slate); }
  </style>
</head>
<body>

<nav class="navbar">
  <div class="container">
    <a href="index.html" class="nav-logo">Edu<span class="logo-hub">Hub</span><span class="logo-dot"></span></a>
    <div class="nav-links">
      <a href="dashboard.html">Dashboard</a>
      <a href="courses.html" class="active">Courses</a>
      <a href="progress.html">My Progress</a>
      <a href="leaderboard.html">Leaderboard</a>
      <a href="ai-generator.html">AI Tools</a>
    </div>
    <div class="nav-actions"><a href="profile.html" class="nav-avatar">AR</a></div>
    <button class="hamburger" id="hamburger" aria-label="Menu" aria-expanded="false"><span></span><span></span><span></span></button>
  </div>
</nav>
<div class="mobile-nav" id="mobileNav"><div class="mobile-nav-inner">
  <div class="mobile-nav-user"><div class="nav-avatar">AR</div><div><div class="mobile-nav-user-name">Abdullah Rashid</div><div class="mobile-nav-user-email">abdullah@example.com</div></div></div>
  <div class="mobile-nav-section">Navigation</div>
  <a href="dashboard.html"    class="mobile-nav-link"><span class="icon">🏠</span> Dashboard</a>
  <a href="courses.html"      class="mobile-nav-link active"><span class="icon">📚</span> Courses</a>
  <a href="progress.html"     class="mobile-nav-link"><span class="icon">📈</span> My Progress</a>
  <a href="leaderboard.html"  class="mobile-nav-link"><span class="icon">🏆</span> Leaderboard</a>
  <a href="ai-generator.html" class="mobile-nav-link"><span class="icon">✨</span> AI Tools</a>
  <div class="mobile-nav-divider"></div>
  <a href="profile.html" class="mobile-nav-link"><span class="icon">👤</span> Profile</a>
  <a href="login.html"   class="mobile-nav-link"><span class="icon">🚪</span> Log Out</a>
</div></div>

<!-- Hero -->
<div class="courses-hero">
  <div class="container">
    <div class="section-label">All Quizzes</div>
    <h1 style="margin-top:11px;margin-bottom:8px">Explore All Quizzes</h1>
    <p style="max-width:500px;margin-bottom:24px">Master every topic in the IsDB curriculum with structured courses, interactive quizzes, and AI-powered support.</p>

    <!-- PHP: form submits to courses.php?q=... -->

    <!-- <form method="GET" action="courses.php">
      <div class="search-bar">
        <input type="text" name="q" placeholder="Search courses, topics, or modules…"/>
        <button type="submit">🔍 Search</button>
      </div>
    </form> -->

    <!-- PHP: filter buttons submit GET params -->

    <!-- <div class="filter-chips mt-16" data-filter-group>
      <button class="filter-chip active" data-filter="all">All Topics</button>
      <button class="filter-chip" data-filter="finance">Finance</button>
      <button class="filter-chip" data-filter="zakat">Zakat &amp; Waqf</button>
      <button class="filter-chip" data-filter="banking">Banking</button>
      <button class="filter-chip" data-filter="economics">Economics</button>
      <button class="filter-chip" data-filter="law">Law &amp; Ethics</button>
      <button class="filter-chip" data-filter="development">Development</button>
      <button class="filter-chip" data-filter="beginner">Beginner</button>
      <button class="filter-chip" data-filter="advanced">Advanced</button>
    </div> -->

  </div>
</div>

<!-- Grid -->
<section style="padding:44px 0 72px">
  <div class="container">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:10px">
      <p style="color:var(--slate)">Showing <strong style="color:var(--navy)"><?= count($rows) ?> topics</strong></p><!-- PHP: echo count($courses) -->

      <!-- <select class="form-select" style="width:auto;padding:7px 12px;font-size:.85rem" name="sort">
        <option>Sort: Most Popular</option>
        <option>Sort: Newest</option>
        <option>Sort: A–Z</option>
        <option>Sort: Completion</option>
      </select> -->

    </div>

    <!-- PHP: foreach ($courses as $course) { ?>  <div class="course-card"> … </div> -->
    <div class="grid-3">


    <!-- ----------------------------------- -->
    <!-- All Topics -->

    <?php foreach($rows as $row) : ?>
      <a href="course-detail.php?category_id=<?= $row["id"] ?>" class="course-card">
        <div class="course-card-header purple">
          <div class="course-emoji"><img style="width: 80px;" src="assets/img/web-dev-icon.png" alt="web-dev-icon"></div>
          <h3 style="margin-top:9px;font-size:.97rem"><?= $row['name'] ?></h3>
        </div>
        <div class="course-card-body">
          <p style="font-size:.83rem;margin-bottom:11px"><?= $row['description'] ?></p>
          <!-- <div style="display:flex;gap:14px;flex-wrap:wrap">
            <div class="course-meta-item">📝 8 modules</div>
            <div class="course-meta-item">❓ 80 questions</div>
            <div class="course-meta-item">⏱ 6h</div>
          </div> -->
          <!-- <div style="margin-top:12px"><div style="display:flex;justify-content:space-between;margin-bottom:4px"><span style="font-size:.76rem;color:var(--slate)">Progress</span><span style="font-family:var(--font-mono);font-size:.76rem;color:var(--primary)">62%</span></div><div class="progress-bar"><div class="progress-fill" style="width:62%"></div></div></div> -->
        </div>
        <!-- <div class="course-card-footer"><button class="btn btn-primary btn-sm">Continue →</button></div> -->
    </a>
    <?php endforeach ?>


      <!-- <div class="course-card">
        <div class="course-card-header purple">
          <div class="course-emoji">📊</div>
          <div style="display:flex;gap:7px;flex-wrap:wrap"><span class="badge badge-primary">Core</span><span class="badge badge-green">Enrolled</span></div>
          <h3 style="margin-top:9px;font-size:.97rem">DAG Fundamentals</h3>
        </div>
        <div class="course-card-body">
          <p style="font-size:.83rem;margin-bottom:11px">The foundational course covering DAGs and their applications in Islamic economics.</p>
          <div style="display:flex;gap:14px;flex-wrap:wrap">
            <div class="course-meta-item">📝 8 modules</div>
            <div class="course-meta-item">❓ 80 questions</div>
            <div class="course-meta-item">⏱ 6h</div>
          </div>
          <div style="margin-top:12px"><div style="display:flex;justify-content:space-between;margin-bottom:4px"><span style="font-size:.76rem;color:var(--slate)">Progress</span><span style="font-family:var(--font-mono);font-size:.76rem;color:var(--primary)">62%</span></div><div class="progress-bar"><div class="progress-fill" style="width:62%"></div></div></div>
        </div>
        <div class="course-card-footer"><span style="font-size:.78rem;color:var(--slate)">⭐ 4.8 · 340 students</span><a href="course-detail.html" class="btn btn-primary btn-sm">Continue →</a></div>
      </div>

      <div class="course-card">
        <div class="course-card-header yellow">
          <div class="course-emoji">🕌</div>
          <div style="display:flex;gap:7px;flex-wrap:wrap"><span class="badge badge-yellow">Finance</span><span class="badge badge-green">Enrolled</span></div>
          <h3 style="margin-top:9px;font-size:.97rem">Islamic Finance Basics</h3>
        </div>
        <div class="course-card-body">
          <p style="font-size:.83rem;margin-bottom:11px">Covers Murabaha, Musharakah, Ijarah, and principles of Islamic finance.</p>
          <div style="display:flex;gap:14px;flex-wrap:wrap">
            <div class="course-meta-item">📝 10 modules</div>
            <div class="course-meta-item">❓ 120 questions</div>
            <div class="course-meta-item">⏱ 8h</div>
          </div>
          <div style="margin-top:12px"><div style="display:flex;justify-content:space-between;margin-bottom:4px"><span style="font-size:.76rem;color:var(--slate)">Progress</span><span style="font-family:var(--font-mono);font-size:.76rem;color:var(--primary)">88%</span></div><div class="progress-bar"><div class="progress-fill" style="width:88%"></div></div></div>
        </div>
        <div class="course-card-footer"><span style="font-size:.78rem;color:var(--slate)">⭐ 4.9 · 560 students</span><a href="course-detail.html" class="btn btn-primary btn-sm">Continue →</a></div>
      </div>

      <div class="course-card">
        <div class="course-card-header green">
          <div class="course-emoji">💹</div>
          <div style="display:flex;gap:7px"><span class="badge badge-primary">Zakat &amp; Waqf</span></div>
          <h3 style="margin-top:9px;font-size:.97rem">Zakat Principles &amp; Calculation</h3>
        </div>
        <div class="course-card-body">
          <p style="font-size:.83rem;margin-bottom:11px">Deep dive into Zakat categories, nisab thresholds, and distribution rules.</p>
          <div style="display:flex;gap:14px;flex-wrap:wrap">
            <div class="course-meta-item">📝 6 modules</div>
            <div class="course-meta-item">❓ 60 questions</div>
            <div class="course-meta-item">⏱ 4h</div>
          </div>
          <div style="margin-top:12px"><div style="display:flex;justify-content:space-between;margin-bottom:4px"><span style="font-size:.76rem;color:var(--slate)">Not Started</span></div><div class="progress-bar"><div class="progress-fill" style="width:0%"></div></div></div>
        </div>
        <div class="course-card-footer"><span style="font-size:.78rem;color:var(--slate)">⭐ 4.7 · 210 students</span><a href="course-detail.html" class="btn btn-outline btn-sm">Enroll Now</a></div>
      </div>

      <div class="course-card">
        <div class="course-card-header coral">
          <div class="course-emoji">📜</div>
          <div style="display:flex;gap:7px;flex-wrap:wrap"><span class="badge badge-coral">Banking</span><span class="badge badge-green">Completed ✓</span></div>
          <h3 style="margin-top:9px;font-size:.97rem">Sukuk &amp; Islamic Capital Markets</h3>
        </div>
        <div class="course-card-body">
          <p style="font-size:.83rem;margin-bottom:11px">Understand Sukuk structures, types, and how they compare to conventional bonds.</p>
          <div style="display:flex;gap:14px;flex-wrap:wrap">
            <div class="course-meta-item">📝 5 modules</div>
            <div class="course-meta-item">❓ 50 questions</div>
            <div class="course-meta-item">⏱ 3h</div>
          </div>
          <div style="margin-top:12px"><div class="progress-bar"><div class="progress-fill green" style="width:100%"></div></div></div>
        </div>
        <div class="course-card-footer"><span style="font-size:.78rem;color:var(--slate)">⭐ 4.6 · 180 students</span><a href="course-detail.html" class="btn btn-ghost btn-sm">Review →</a></div>
      </div>

      <div class="course-card">
        <div class="course-card-header teal">
          <div class="course-emoji">⚖️</div>
          <div style="display:flex;gap:7px"><span class="badge badge-navy">Law &amp; Ethics</span></div>
          <h3 style="margin-top:9px;font-size:.97rem">Islamic Economic Ethics</h3>
        </div>
        <div class="course-card-body">
          <p style="font-size:.83rem;margin-bottom:11px">Explore the ethical foundations of Islamic economic systems and social responsibility.</p>
          <div style="display:flex;gap:14px;flex-wrap:wrap">
            <div class="course-meta-item">📝 7 modules</div>
            <div class="course-meta-item">❓ 70 questions</div>
            <div class="course-meta-item">⏱ 5h</div>
          </div>
          <div style="margin-top:12px"><div style="display:flex;justify-content:space-between;margin-bottom:4px"><span style="font-size:.76rem;color:var(--slate)">Not Started</span></div><div class="progress-bar"><div class="progress-fill" style="width:0%"></div></div></div>
        </div>
        <div class="course-card-footer"><span style="font-size:.78rem;color:var(--slate)">⭐ 4.5 · 95 students</span><a href="course-detail.html" class="btn btn-outline btn-sm">Enroll Now</a></div>
      </div>

      <div class="course-card">
        <div class="course-card-header navy">
          <div class="course-emoji">🌍</div>
          <div style="display:flex;gap:7px"><span class="badge badge-primary">Development</span><span class="badge badge-yellow">New</span></div>
          <h3 style="margin-top:9px;font-size:.97rem">Islamic Development Economics</h3>
        </div>
        <div class="course-card-body">
          <p style="font-size:.83rem;margin-bottom:11px">Development economics through an Islamic lens: microfinance, poverty alleviation, and SDGs.</p>
          <div style="display:flex;gap:14px;flex-wrap:wrap">
            <div class="course-meta-item">📝 9 modules</div>
            <div class="course-meta-item">❓ 90 questions</div>
            <div class="course-meta-item">⏱ 7h</div>
          </div>
          <div style="margin-top:12px"><div style="display:flex;justify-content:space-between;margin-bottom:4px"><span style="font-size:.76rem;color:var(--slate)">Not Started</span></div><div class="progress-bar"><div class="progress-fill" style="width:0%"></div></div></div>
        </div>
        <div class="course-card-footer"><span style="font-size:.78rem;color:var(--slate)">⭐ New · Be first!</span><a href="course-detail.html" class="btn btn-outline btn-sm">Enroll Now</a></div>
      </div> -->

    </div>

    <!-- <div class="pagination">
      <button class="page-btn">←</button>
      <button class="page-btn active">1</button>
      <button class="page-btn">2</button>
      <button class="page-btn">3</button>
      <span style="color:var(--slate);padding:0 4px">…</span>
      <button class="page-btn">8</button>
      <button class="page-btn">→</button>
    </div> -->
  </div>
</section>

<!-- Footer -->
<footer class="footer">
  <div class="container">
    <div class="grid-4" style="gap:32px">
      <div><div class="footer-logo">EduHub <span style="color:var(--yellow)">·</span></div><div class="footer-tagline">Smart learning for IsDB students</div></div>
      <div><div class="footer-heading">Platform</div><div class="footer-links"><a href="courses.html">All Courses</a><a href="leaderboard.html">Leaderboard</a><a href="ai-generator.html">AI Generator</a></div></div>
      <div><div class="footer-heading">Account</div><div class="footer-links"><a href="login.html">Login</a><a href="register.html">Register</a><a href="profile.html">Profile</a></div></div>
      <div><div class="footer-heading">Support</div><div class="footer-links"><a href="#">Help Centre</a><a href="#">Privacy Policy</a><a href="#">Contact</a></div></div>
    </div>
    <hr class="footer-divider"/>
    <div class="footer-bottom"><p>© 2025 EduHub.</p><p>Built with ❤️ for IsDB Students</p></div>
  </div>
</footer>

<script src="assets/js/main.js"></script>
</body>
</html>
