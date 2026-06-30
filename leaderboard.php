<?php
require_once("config/database-connect.php");

// Get users sorted by their quiz store 
$sql = "SELECT * FROM users u ORDER BY total_quiz_score DESC";
$result = $db->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

// echo "<pre>";
// print_r($rows);
// echo "</pre>";

// ran-counter
$rank_counter = 0;

?>

<!-- Header -->
<?php include_once "header.php" ?>

<!-- Hero / Podium -->
<div class="lb-hero">
  <div class="section-label" style="background:rgba(255,255,255,.12);color:#fff;position:relative">🏆 Leaderboard</div>
  <h1 style="margin-top:11px">Who's on Top?</h1>
  <p>Rankings update after every quiz. Keep quizzing to climb!</p>
  <div class="top3-podium anim-fade-up">
    <div class="podium-card second">
      <div class="podium-crown">🥈</div>
      <div class="podium-avatar" style="overflow:hidden;background:linear-gradient(135deg,var(--green-dark),#0ea5e9)"><img src="<?= $rows["1"]["user_picture_link"] ?>" alt=""></div>
      <div class="podium-name"><?= $rows["1"]["name"] ?></div>
      <div class="podium-score"><?= $rows["1"]["total_quiz_score"] ?> Points</div>
      <div class="podium-rank">#2</div>
    </div>
    <div class="podium-card first">
      <div class="podium-crown">👑</div>
      <div class="podium-avatar" style="overflow:hidden;background:linear-gradient(135deg,var(--primary),var(--coral));width:66px;height:66px;font-size:1.15rem;border-color:rgba(255,217,74,.6)"><img src="<?= $rows["0"]["user_picture_link"] ?>" alt=""></div>
      <div class="podium-name"><?= $rows["0"]["name"] ?></div>
      <div class="podium-score"><?= $rows["0"]["total_quiz_score"] ?> Points</div>
      <div class="podium-rank">#1</div>
    </div>
    <div class="podium-card third">
      <div class="podium-crown">🥉</div>
      <div class="podium-avatar" style="overflow:hidden;background:linear-gradient(135deg,#CD7F32,#e6a44d)"><img src="<?= $rows["2"]["user_picture_link"] ?>" alt=""></div>
      <div class="podium-name"><?= $rows["2"]["name"] ?></div>
      <div class="podium-score"><?= $rows["2"]["total_quiz_score"] ?> Points</div>
      <div class="podium-rank">#3</div>
    </div>
  </div>
</div>

<!-- Body -->
<div class="lb-body">

  <!-- Scope filters — PHP GET param: ?scope=global&course=all&period=alltime -->

  <!-- <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:18px" data-filter-group>
    <button class="filter-chip active">🌍 Global</button>
    <button class="filter-chip">📊 DAG Fundamentals</button>
    <button class="filter-chip">🕌 Islamic Finance</button>
    <button class="filter-chip">💹 Zakat Studies</button>
  </div>
  <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:20px" data-filter-group>
    <button class="filter-chip">📅 This Week</button>
    <button class="filter-chip">📅 This Month</button>
    <button class="filter-chip active">🏅 All Time</button>
  </div> -->

  <!-- Your rank banner -->

  <!-- <div class="alert alert-info" style="margin-bottom:18px">
    <span>🎯</span>
    <span>You are ranked <strong>#12</strong> globally with <strong>1,840 XP</strong>. Need <strong>120 more XP</strong> to reach #11!</span>
  </div> -->

  <!-- Table -->
  <div class="lb-table-head">
    <div class="lb-th">Rank</div>
    <div></div>
    <div class="lb-th">Student</div>
    <div class="lb-th right">Points</div>
    <div class="lb-th right hide-sm">Quizzes</div>
    <!-- <div class="lb-th right">Change</div> -->
  </div>

  <!-- PHP: foreach ($leaderboard as $entry) -->
  <div style="border:1.5px solid var(--border);border-top:none;border-radius:0 0 var(--radius-lg) var(--radius-lg);overflow:hidden;background:var(--surface)">

    <!-- gold/silver/bronze -->

    <?php foreach ($rows as $row) :
      // Get user attempts sorted by their quiz store 
      $sql_2 = "SELECT COUNT(id) total_quiz FROM user_quiz_attempts WHERE user_id = {$row['id']} GROUP BY quiz_id";
      $result_2 = $db->query($sql_2);
      $row_2 = $result_2->fetch_all(MYSQLI_ASSOC);
      // echo "<pre>";
    ?>
      <div class="lb-row-grid">
        <div class="lb-rank gold">#<?= ++$rank_counter ?></div>
        <div class="lb-avatar" style="overflow:hidden;background:linear-gradient(135deg,var(--primary),var(--coral));width:36px;height:36px;font-size:.78rem"><img src="<?= $row["user_picture_link"] ?>" alt=""></div>
        <div>
          <div class="lb-name"><?= $row["name"] ?></div>
        </div>
        <div class="lb-xp"><?= $row['total_quiz_score'] ?></div>

        <div class="lb-quizzes"><?= count($row_2) ?></div>
        <!-- <div class="lb-change same">— 0</div> -->
      </div>
    <?php endforeach ?>

    <!-- Gap row -->

    <!-- <div style="padding:10px 18px;background:var(--bg);border-bottom:1px solid var(--border);border-top:1px solid var(--border)">
      <p style="font-size:.78rem;color:var(--slate);text-align:center">Ranks #7 through #11 — you're 120 XP from #11!</p>
    </div> -->

    <!-- Your row -->

    <!-- <div class="lb-row-grid you">
      <div class="lb-rank" style="color:var(--primary)">#12</div>
      <div class="lb-avatar" style="background:linear-gradient(135deg,var(--yellow-dark),var(--coral));width:36px;height:36px;font-size:.78rem;border:2px solid var(--primary)">AR</div>
      <div>
        <div class="lb-name" style="color:var(--primary)">Abdullah Rashid <span class="badge badge-primary" style="font-size:.65rem;padding:2px 7px;vertical-align:middle;margin-left:4px">You</span></div>
        <div class="lb-sub">DAG Fundamentals</div>
      </div>
      <div class="lb-xp">1,840</div>
      <div class="lb-quizzes">42</div>
      <div class="lb-change up">↑ 4</div>
    </div> -->

  </div>

  <!-- Pagination -->

  <!-- <div class="pagination">
    <button class="page-btn">←</button>
    <button class="page-btn active">1</button>
    <button class="page-btn">2</button>
    <button class="page-btn">3</button>
    <button class="page-btn">→</button>
  </div> -->

</div>
<!-- footer -->
<?php include_once "footer.php" ?>