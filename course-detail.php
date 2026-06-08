<?php 
require_once 'config/database-connect.php';


/* 
1. get all categorie id from link
2. display categori data on the page
3. get all quiz of that category
*/

// Redirect to course page if no category id is found
if(!isset($_GET['category_id'])){
  header("location: courses.php");
}

// Category details
$sql = "SELECT id,name,description FROM `quiz_category` WHERE id={$_GET['category_id']}";

$result = $db->query($sql);
$details = $result->fetch_assoc();
// echo "<pre>";
// print_r($details);
// echo "</pre>";

// quizzes details

$quiz_result = $db->query("SELECT * FROM `quizzes` WHERE quiz_category_id={$_GET['category_id']}");
$quizzes = $quiz_result->fetch_all(MYSQLI_ASSOC);
echo "<pre>";
print_r($quizzes);
echo "</pre>";





?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= $details["name"] ?></title>
  <link rel="stylesheet" href="assets/css/style.css"/>
  <style>
    .course-hero { background:linear-gradient(135deg,rgba(92,51,246,.07),rgba(92,51,246,.02)); border-bottom:1.5px solid var(--border); padding:48px 0 36px; }
    .course-hero-grid { display:grid; grid-template-columns:1fr 320px; gap:44px; align-items:start; }
    .sticky-card { background:var(--surface); border:1.5px solid var(--border); border-radius:var(--radius-xl); padding:26px; box-shadow:var(--shadow-md); position:sticky; top:calc(var(--nav-h) + 20px); }
    .module-item { border:1.5px solid var(--border); border-radius:var(--radius-md); margin-bottom:9px; overflow:hidden; transition:border-color var(--transition); }
    .module-item:hover { border-color:var(--primary); }
    .module-header { display:flex; align-items:center; gap:12px; padding:14px 16px; background:var(--surface); user-select:none; cursor:pointer; }
    .module-header.open { background:var(--primary-faint); }
    .module-num { width:32px; height:32px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-family:var(--font-mono); font-weight:700; font-size:.8rem; flex-shrink:0; }
    .module-num.done    { background:var(--green);   color:#fff; }
    .module-num.active  { background:var(--primary); color:#fff; }
    .module-num.locked  { background:var(--border);  color:var(--slate); }
    .module-num.pending { background:var(--primary-faint); color:var(--primary); }
    .module-title  { font-family:var(--font-display); font-weight:700; font-size:.9rem; color:var(--navy); flex:1; }
    .module-status { font-size:.76rem; font-weight:700; white-space:nowrap; }
    .module-status.done   { color:var(--green-dark); }
    .module-status.active { color:var(--primary); }
    .module-status.locked { color:var(--slate); }
    .module-quizzes { display:none; padding:0 16px 12px 60px; flex-direction:column; gap:5px; }
    .module-quizzes.open { display:flex; }
    .quiz-item { display:flex; align-items:center; gap:9px; padding:8px 12px; border-radius:var(--radius-sm); background:var(--bg); font-size:.82rem; color:var(--navy); transition:all var(--transition); }
    .quiz-item:hover { background:var(--primary-faint); }
    .qi-score { margin-left:auto; font-family:var(--font-mono); font-size:.76rem; color:var(--primary); font-weight:700; }
    .checklist-item { display:flex; align-items:flex-start; gap:7px; font-size:.84rem; color:var(--slate); margin-bottom:5px; }
    .checklist-item::before { content:'✓'; color:var(--green-dark); font-weight:700; flex-shrink:0; }
    @media(max-width:900px) {
      .course-hero-grid { grid-template-columns:1fr; }
      .sticky-card { position:static; }
    }
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

<!-- Breadcrumb -->
<div style="background:var(--surface);border-bottom:1px solid var(--border);padding:10px 0">
  <div class="container">
    <div style="display:flex;align-items:center;gap:7px;font-size:.8rem;color:var(--slate)">
      <a href="courses.html" style="color:var(--primary);font-weight:700">Courses</a>
      <span>›</span><span><?= $details["name"] ?></span>
    </div>
  </div>
</div>

<!-- Hero -->
<div class="course-hero">
  <div class="container">
    <div class="course-hero-grid">
      <div>
        
        <h1 style="font-size:clamp(1.7rem,4vw,2.5rem)"><?= $details["name"] ?></h1>
        <p style="max-width:540px;margin-top:10px;font-size:.97rem"><?= $details["description"] ?></p>
        <div style="display:flex;gap:20px;flex-wrap:wrap;margin:18px 0">
          <span style="display:flex;align-items:center;gap:5px;font-size:.85rem;color:var(--slate)">📝 <strong style="color:var(--navy)">8 modules</strong></span>
          <span style="display:flex;align-items:center;gap:5px;font-size:.85rem;color:var(--slate)">❓ <strong style="color:var(--navy)">80 questions</strong></span>
          <span style="display:flex;align-items:center;gap:5px;font-size:.85rem;color:var(--slate)">⏱ <strong style="color:var(--navy)">6h est.</strong></span>
          <span style="display:flex;align-items:center;gap:5px;font-size:.85rem;color:var(--slate)">⭐ <strong style="color:var(--navy)">4.8</strong> (340 ratings)</span>
        </div>

        <!-- Progress Bar -->

        <!-- <div>
          <div style="display:flex;justify-content:space-between;margin-bottom:6px">
            <span style="font-family:var(--font-display);font-weight:700;font-size:.84rem">Your Progress</span>
            <span style="font-family:var(--font-mono);font-size:.84rem;color:var(--primary)">62% · 5 of 8 modules</span>
          </div>
          <div class="progress-bar" style="height:12px"><div class="progress-fill" style="width:62%"></div></div>
        </div> -->
      </div>

      <!-- Sticky card -->

      <!-- <div class="sticky-card">
        <div style="font-size:3rem;margin-bottom:12px">📊</div>
        <div style="font-family:var(--font-mono);font-size:1.9rem;font-weight:700;color:var(--primary)">62%</div>
        <div style="color:var(--slate);font-size:.8rem;margin-bottom:18px">Complete · 5 of 8 modules</div>
        <a href="quiz.html" class="btn btn-primary w-full" style="justify-content:center;margin-bottom:9px">▶ Continue Module 6</a>
        <a href="quiz.html" class="btn btn-outline w-full" style="justify-content:center;margin-bottom:18px">🔄 Retry Previous Quiz</a>
        <div style="border-top:1px solid var(--border);padding-top:14px">
          <div style="display:flex;justify-content:space-between;margin-bottom:7px"><span style="font-size:.8rem;color:var(--slate)">Avg. Score</span><span style="font-family:var(--font-mono);font-weight:700;font-size:.84rem;color:var(--navy)">78%</span></div>
          <div style="display:flex;justify-content:space-between;margin-bottom:7px"><span style="font-size:.8rem;color:var(--slate)">Best Score</span><span style="font-family:var(--font-mono);font-weight:700;font-size:.84rem;color:var(--green-dark)">100%</span></div>
          <div style="display:flex;justify-content:space-between"><span style="font-size:.8rem;color:var(--slate)">XP Earned</span><span style="font-family:var(--font-mono);font-weight:700;font-size:.84rem;color:var(--primary)">640 XP</span></div>
        </div>
        <div style="margin-top:14px;border-top:1px solid var(--border);padding-top:14px">
          <a href="ai-generator.html" class="ai-label" style="width:100%;justify-content:center"><span class="ai-dot"></span> Generate AI Quiz</a>
        </div>
      </div> -->

    </div>
  </div>
</div>

<!-- Content -->
<div style="padding:44px 0 72px">
  <div class="container">
    <div style="display:grid;grid-template-columns:1fr 300px;gap:40px;align-items:start">
      <div>
        <!-- Tabs — JS powered -->
        <div class="tabs" data-tabs>
          <span class="tab-link active" data-tab="modules">📋 Modules</span>
          <!-- <span class="tab-link" data-tab="about">ℹ️ About</span> -->
          <span class="tab-link" data-tab="stats">📊 My Stats</span>
        </div>

        <!-- Modules Tab -->
        <div class="tab-panel active" data-tab-panel="modules">
           <div class="module-quizzes open">
            <?php foreach ($quizzes as $quiz) : ?>
              <a href="quiz.php?quiz-id=<?= $quiz['id'] ?>" class="quiz-item"><span>📝</span> <?= $quiz['quiz_name'] ?><span class="qi-score"><?= $quiz['score'] ?></span></a>
            <?php endforeach ?>
            </div>
          <!-- <div data-accordion>

            <div class="module-item">
              <div class="module-header open" onclick="this.classList.toggle('open');this.nextElementSibling.classList.toggle('open')">
                <div class="module-num done">✓</div>
                <div style="flex:1"><div class="module-title">Module 1: Introduction to Graphs</div><div style="font-size:.74rem;color:var(--slate)">2 quizzes · 20 questions · Completed</div></div>
                <span class="module-status done">100% ✓</span>
              </div>
              <div class="module-quizzes open">
                <a href="quiz.html" class="quiz-item"><span>📝</span> Quiz 1.1 – What is a Graph?<span class="qi-score">10/10</span></a>
                <a href="quiz.html" class="quiz-item"><span>📝</span> Quiz 1.2 – Types of Graphs<span class="qi-score">10/10</span></a>
              </div>
            </div>

            <div class="module-item">
              <div class="module-header" onclick="this.classList.toggle('open');this.nextElementSibling.classList.toggle('open')">
                <div class="module-num done">✓</div>
                <div style="flex:1"><div class="module-title">Module 2: Directed Graphs</div><div style="font-size:.74rem;color:var(--slate)">2 quizzes · 20 questions · Completed</div></div>
                <span class="module-status done">90% ✓</span>
              </div>
              <div class="module-quizzes">
                <a href="quiz.html" class="quiz-item"><span>📝</span> Quiz 2.1 – Edges &amp; Directions<span class="qi-score">9/10</span></a>
                <a href="quiz.html" class="quiz-item"><span>📝</span> Quiz 2.2 – In/Out-degree<span class="qi-score">9/10</span></a>
              </div>
            </div>

            <div class="module-item" style="border-color:var(--primary)">
              <div class="module-header open" style="background:var(--primary-faint)" onclick="this.classList.toggle('open');this.nextElementSibling.classList.toggle('open')">
                <div class="module-num active">3</div>
                <div style="flex:1"><div class="module-title">Module 3: Acyclic Properties</div><div style="font-size:.74rem;color:var(--slate)">2 quizzes · 20 questions · In Progress</div></div>
                <span class="module-status active">50% →</span>
              </div>
              <div class="module-quizzes open">
                <a href="quiz-results.html" class="quiz-item"><span>✅</span> Quiz 3.1 – Cycles &amp; Acyclicity<span class="qi-score">8/10</span></a>
                <a href="quiz.html" class="quiz-item" style="border:1.5px dashed rgba(92,51,246,.28)"><span>▶</span> Quiz 3.2 – Detecting Cycles<span class="qi-score" style="color:var(--slate)">Not taken</span></a>
              </div>
            </div>

            <div class="module-item">
              <div class="module-header" onclick="this.classList.toggle('open');this.nextElementSibling.classList.toggle('open')">
                <div class="module-num pending">4</div>
                <div style="flex:1"><div class="module-title">Module 4: Topological Sorting</div><div style="font-size:.74rem;color:var(--slate)">2 quizzes · 20 questions · Not started</div></div>
                <span class="module-status" style="color:var(--slate)">Not started</span>
              </div>
              <div class="module-quizzes">
                <a href="quiz.html" class="quiz-item"><span>📝</span> Quiz 4.1 – Kahn's Algorithm<span class="qi-score" style="color:var(--slate)">—</span></a>
                <a href="quiz.html" class="quiz-item"><span>📝</span> Quiz 4.2 – DFS Topological Sort<span class="qi-score" style="color:var(--slate)">—</span></a>
              </div>
            </div>

            <div class="module-item" style="opacity:.6">
              <div class="module-header">
                <div class="module-num locked">🔒</div>
                <div style="flex:1"><div class="module-title">Module 5: DAGs in Dependency Resolution</div><div style="font-size:.74rem;color:var(--slate)">Complete Module 4 to unlock</div></div>
                <span class="module-status locked">Locked</span>
              </div>
            </div>
            <div class="module-item" style="opacity:.6">
              <div class="module-header">
                <div class="module-num locked">🔒</div>
                <div style="flex:1"><div class="module-title">Module 6: DAG Applications in Islamic Economics</div><div style="font-size:.74rem;color:var(--slate)">Locked</div></div>
                <span class="module-status locked">Locked</span>
              </div>
            </div>
            <div class="module-item" style="opacity:.6">
              <div class="module-header">
                <div class="module-num locked">🔒</div>
                <div style="flex:1"><div class="module-title">Module 7: Advanced DAG Algorithms</div><div style="font-size:.74rem;color:var(--slate)">Locked</div></div>
                <span class="module-status locked">Locked</span>
              </div>
            </div>
            <div class="module-item" style="opacity:.6">
              <div class="module-header">
                <div class="module-num locked">🔒</div>
                <div style="flex:1"><div class="module-title">Module 8: Final Assessment</div><div style="font-size:.74rem;color:var(--slate)">Complete all modules to unlock</div></div>
                <span class="module-status locked">🏆 Final</span>
              </div>
            </div>

          </div> -->
        </div>

        <!-- About Tab -->

        <!-- <div class="tab-panel" data-tab-panel="about">
          <div class="card" style="margin-bottom:16px">
            <h4 style="margin-bottom:10px">🎯 What You'll Learn</h4>
            <div class="checklist-item">Core concepts of Directed Acyclic Graphs</div>
            <div class="checklist-item">How to identify and detect cycles in a graph</div>
            <div class="checklist-item">Topological sorting techniques (Kahn's &amp; DFS)</div>
            <div class="checklist-item">Real-world DAG applications in Islamic economics</div>
            <div class="checklist-item">Advanced DAG algorithms and optimisations</div>
          </div>
          <div class="card">
            <h4 style="margin-bottom:8px">📋 Requirements</h4>
            <p style="font-size:.86rem">No prior graph theory knowledge needed. Basic mathematics understanding recommended.</p>
          </div>
        </div> -->

        <!-- Stats Tab -->
        <div class="tab-panel" data-tab-panel="stats">
          <div class="grid-2" style="margin-bottom:16px">
            <div class="stat-card"><div class="stat-icon purple">📝</div><div><div class="stat-value">5</div><div class="stat-label">Quizzes Taken</div></div></div>
            <div class="stat-card"><div class="stat-icon yellow">⭐</div><div><div class="stat-value">78%</div><div class="stat-label">Avg. Score</div></div></div>
            <div class="stat-card"><div class="stat-icon green">💯</div><div><div class="stat-value">100%</div><div class="stat-label">Best Score</div></div></div>
            <div class="stat-card"><div class="stat-icon coral">⚡</div><div><div class="stat-value">640</div><div class="stat-label">XP Earned</div></div></div>
          </div>
          <div class="alert alert-info">
            <span>💡</span><span>You're <strong>38%</strong> away from completing this course. Keep going!</span>
          </div>
        </div>
      </div>

      <!-- Right sidebar -->
      <!-- <div style="display:flex;flex-direction:column;gap:16px">
        <div class="card" style="padding:18px">
          <h4 style="margin-bottom:10px">🎯 What You'll Learn</h4>
          <div class="checklist-item">Core DAG concepts &amp; properties</div>
          <div class="checklist-item">Cycle detection algorithms</div>
          <div class="checklist-item">Topological sorting</div>
          <div class="checklist-item">Islamic economics applications</div>
        </div>
        <div class="ai-panel">
          <div class="ai-label" style="margin-bottom:10px"><span class="ai-dot"></span> AI Study Tips</div>
          <p style="font-size:.84rem;color:var(--navy);line-height:1.6">You're 38% away from completing. Focus on Module 3 Quiz 3.2 today — AI suggests reviewing cycle detection before attempting it.</p>
          <a href="ai-generator.html" class="btn btn-sm btn-outline" style="margin-top:12px">Generate Practice Quiz ✨</a>
        </div>
      </div> -->

    </div>
  </div>
</div>

<script src="assets/js/main.js"></script>
</body>
</html>
