<?php
require_once("mu-files/config.php");

echo "<pre>";
print_r($_POST);
echo "</pre>";
$quiz_id = $_POST["quiz-id"];
$query = "SELECT question, option_1, option_2, option_3, option_4, answer FROM questions WHERE quiz_id = $quiz_id";

$query_result = $db->query($query);
$questions = $query_result->fetch_all(MYSQLI_ASSOC);
echo "<pre>";
print_r($questions);
echo "</pre>";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Quiz Results – EduHub</title>
  <link rel="stylesheet" href="assets/css/style.css" />
  <style>
    body {
      background: linear-gradient(135deg, #f8f5ff 0%, #fff9ec 100%);
    }

    .results-hero {
      text-align: center;
      padding: 60px 24px 40px;
    }

    .confetti-banner {
      font-size: 2.5rem;
      margin-bottom: 20px;
      animation: bounce 1s ease-in-out;
    }

    @keyframes bounce {

      0%,
      100% {
        transform: translateY(0);
      }

      40% {
        transform: translateY(-16px);
      }

      60% {
        transform: translateY(-8px);
      }
    }

    .results-body {
      max-width: 780px;
      margin: 0 auto;
      padding: 0 24px 80px;
    }

    .score-breakdown {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 14px;
      margin: 32px 0;
    }

    .breakdown-item {
      background: var(--surface);
      border: 1.5px solid var(--border);
      border-radius: var(--radius-md);
      padding: 16px;
      text-align: center;
    }

    .breakdown-val {
      font-family: var(--font-mono);
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--navy);
    }

    .breakdown-label {
      font-size: 0.78rem;
      color: var(--slate);
      margin-top: 4px;
    }

    .review-question {
      background: var(--surface);
      border: 1.5px solid var(--border);
      border-radius: var(--radius-lg);
      padding: 24px;
      margin-bottom: 16px;
    }

    .review-question .q-status {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-family: var(--font-display);
      font-weight: 700;
      font-size: 0.8rem;
      padding: 4px 12px;
      border-radius: 100px;
      margin-bottom: 12px;
    }

    .q-status.correct {
      background: rgba(61, 220, 132, 0.12);
      color: var(--green-dark);
    }

    .q-status.wrong {
      background: rgba(255, 107, 107, 0.1);
      color: #c0392b;
    }

    .q-status.skipped {
      background: rgba(107, 114, 128, 0.1);
      color: var(--slate);
    }

    .review-question .q-text {
      font-family: var(--font-display);
      font-weight: 700;
      font-size: 0.95rem;
      color: var(--navy);
      margin-bottom: 14px;
      line-height: 1.4;
    }

    .review-options {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .review-option {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 16px;
      border-radius: var(--radius-md);
      border: 1.5px solid var(--border);
      font-size: 0.88rem;
    }

    .review-option.correct {
      border-color: var(--green);
      background: rgba(61, 220, 132, 0.06);
    }

    .review-option.wrong {
      border-color: var(--coral);
      background: rgba(255, 107, 107, 0.06);
    }

    .review-option .ro-letter {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: var(--font-display);
      font-weight: 800;
      font-size: 0.78rem;
      background: var(--border);
      color: var(--slate);
    }

    .review-option.correct .ro-letter {
      background: var(--green);
      color: #fff;
    }

    .review-option.wrong .ro-letter {
      background: var(--coral);
      color: #fff;
    }

    .ai-explanation {
      margin-top: 14px;
      background: linear-gradient(135deg, rgba(92, 51, 246, 0.05), rgba(92, 51, 246, 0.02));
      border: 1.5px solid rgba(92, 51, 246, 0.15);
      border-radius: var(--radius-md);
      padding: 14px 18px;
    }

    .ai-explanation .ai-label {
      margin-bottom: 8px;
    }

    .ai-explanation p {
      font-size: 0.88rem;
      color: var(--navy);
      line-height: 1.6;
    }

    .xp-toast {
      background: linear-gradient(135deg, var(--primary), var(--primary-light));
      color: #fff;
      border-radius: var(--radius-lg);
      padding: 20px 28px;
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 28px;
    }

    .xp-toast .xp-icon {
      font-size: 2rem;
    }

    .xp-toast h4 {
      color: #fff;
      font-size: 1rem;
    }

    .xp-toast p {
      color: rgba(255, 255, 255, 0.8);
      font-size: 0.85rem;
      margin-top: 2px;
    }

    @media(max-width:600px) {
      .score-breakdown {
        grid-template-columns: repeat(2, 1fr);
      }
    }
  </style>
</head>

<body>

  <nav class="navbar">
    <div class="container">
      <a href="index.html" class="nav-logo">Edu<span style="color:var(--navy)">Hub</span><span class="logo-dot"></span></a>
      <div class="nav-links">
        <a href="dashboard.html">Dashboard</a>
        <a href="courses.html">Courses</a>
        <a href="progress.html">My Progress</a>
        <a href="leaderboard.html">Leaderboard</a>
      </div>
      <div class="nav-actions">
        <a href="profile.html" class="nav-avatar">AR</a>
      </div>
    </div>
  </nav>

  <!-- Results Hero -->
  <div class="results-hero anim-fade-up">
    <div class="confetti-banner">🎉</div>
    <div class="section-label">Quiz Complete</div>
    <h1 style="margin-top:12px">Great effort, Abdullah!</h1>
    <p style="max-width:420px;margin:10px auto 28px">You completed <strong>DAG Fundamentals – Module 3</strong>. Here's how you did.</p>
    <div class="score-circle high" style="margin:0 auto">
      <div class="score-pct">80%</div>
      <div class="score-text">8 / 10 correct</div>
    </div>
  </div>

  <div class="results-body">

    <!-- XP Earned -->
    <div class="xp-toast anim-fade-up delay-1">
      <div class="xp-icon">⭐</div>
      <div>
        <h4>+120 XP Earned!</h4>
        <p>You've moved up to rank #11 on the leaderboard. 1 more win to reach #10!</p>
      </div>
      <a href="leaderboard.html" class="btn btn-yellow btn-sm" style="margin-left:auto;flex-shrink:0">View Rank →</a>
    </div>

    <!-- Score Breakdown -->
    <div class="score-breakdown anim-fade-up delay-1">
      <div class="breakdown-item">
        <div class="breakdown-val text-green">8</div>
        <div class="breakdown-label">✅ Correct</div>
      </div>
      <div class="breakdown-item">
        <div class="breakdown-val text-coral">2</div>
        <div class="breakdown-label">❌ Wrong</div>
      </div>
      <div class="breakdown-item">
        <div class="breakdown-val" style="color:var(--slate)">0</div>
        <div class="breakdown-label">⏭ Skipped</div>
      </div>
      <div class="breakdown-item">
        <div class="breakdown-val" style="color:var(--yellow-dark)">7:26</div>
        <div class="breakdown-label">⏱ Time Taken</div>
      </div>
    </div>

    <!-- Actions -->
    <div style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:36px" class="anim-fade-up delay-2">
      <a href="quiz.html" class="btn btn-primary">🔄 Retry Quiz</a>
      <a href="ai-generator.html" class="btn btn-outline">✨ Generate Similar Quiz</a>
      <a href="course-detail.html" class="btn btn-ghost">← Back to Course</a>
    </div>

    <!-- Question Review -->
    <div class="anim-fade-up delay-2">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px">
        <h2 style="font-size:1.3rem">Question Review</h2>
        <div class="tabs" style="margin-bottom:0;border:none">
          <a class="tab-link active">All</a>
          <a class="tab-link">Wrong Only</a>
        </div>
      </div>

      <?php
      $loop_count = 0;
      $right_answer_count = 0;

      foreach ($questions as $question) {
        $loop_count++;
      ?>
        <!-- Q1 Correct -->
        <div class="review-question">
          <div class="q-status correct">✅ Correct</div>
          <div class="q-text"><?= $question["question"] ?></div>
          <div class="review-options">

           <!-- Option 1 -->
            <div class="review-option">
              <div class="ro-letter"><?= $loop_count . "."?></div>
              <span><?= $question["option_1"] ?></span>
              <?php
              if ($question["answer"] == $_POST["quiz-$loop_count"]) {   
              echo "<span style='margin-left:auto;font-size:0.8rem;color:var(--green-dark);font-weight:700'>✓ Your answer</span>";
              }
              ?>
            </div>

           <!-- Option 2 -->
            <div class="review-option">
              <div class="ro-letter"><?= $loop_count . "."?></div>
              <span><?= $question["option_2"] ?></span>
              <?php
              if ($question["answer"] == $_POST["quiz-$loop_count"]) {   
              echo "<span style='margin-left:auto;font-size:0.8rem;color:var(--green-dark);font-weight:700'>✓ Your answer</span>";
              }
              ?>
            </div>

           <!-- Option 3 -->
            <div class="review-option">
              <div class="ro-letter"><?= $loop_count . "."?></div>
              <span><?= $question["option_3"] ?></span>
              <?php
              if ($question["answer"] == $_POST["quiz-$loop_count"]) {   
              echo "<span style='margin-left:auto;font-size:0.8rem;color:var(--green-dark);font-weight:700'>✓ Your answer</span>";
              }
              ?>
            </div>

           <!-- Option 4 -->
            <div class="review-option">
              <div class="ro-letter"><?= $loop_count . "."?></div>
              <span><?= $question["option_4"] ?></span>
              <?php
              if ($question["answer"] == $_POST["quiz-$loop_count"]) {   
              echo "<span style='margin-left:auto;font-size:0.8rem;color:var(--green-dark);font-weight:700'>✓ Your answer</span>";
              }
              ?>
            </div>
          </div>
        </div>
      <?php } ?>




      <!-- Q2 Wrong -->
      <div class="review-question">
        <div class="q-status wrong">❌ Incorrect</div>
        <div class="q-text">Q2. Which sorting algorithm is most directly associated with processing a DAG in dependency order?</div>
        <div class="review-options">
          <div class="review-option wrong">
            <div class="ro-letter">A</div>
            <span>Bubble Sort</span>
            <span style="margin-left:auto;font-size:0.8rem;color:var(--coral);font-weight:700">✗ Your answer</span>
          </div>
          <div class="review-option correct">
            <div class="ro-letter">C</div>
            <span>Topological Sort</span>
            <span style="margin-left:auto;font-size:0.8rem;color:var(--green-dark);font-weight:700">✓ Correct answer</span>
          </div>
        </div>
        <div class="ai-explanation">
          <div class="ai-label"><span class="ai-dot"></span> AI Explanation</div>
          <p><strong>Topological Sort</strong> is the algorithm designed specifically for DAGs. It produces a linear ordering of nodes such that for every directed edge from node <em>u</em> to node <em>v</em>, <em>u</em> comes before <em>v</em>. This is essential in dependency resolution — for example, in task scheduling or build systems where some tasks must complete before others begin. Bubble Sort, by contrast, is a general-purpose comparison sort with no awareness of graph structure.</p>
          <a href="ai-generator.html" class="btn btn-sm btn-outline" style="margin-top:12px">Generate more questions like this ✨</a>
        </div>
      </div>

      <!-- Q3 Correct -->
      <div class="review-question">
        <div class="q-status correct">✅ Correct</div>
        <div class="q-text">Q3. In a DAG, a node with no incoming edges is called a ___.</div>
        <div class="review-options">
          <div class="review-option correct">
            <div class="ro-letter">D</div>
            <span>Source node</span>
            <span style="margin-left:auto;font-size:0.8rem;color:var(--green-dark);font-weight:700">✓ Your answer</span>
          </div>
        </div>
      </div>

      <!-- Q4 Wrong -->
      <div class="review-question">
        <div class="q-status wrong">❌ Incorrect</div>
        <div class="q-text">Q4. In a Directed Acyclic Graph, which property is always true?</div>
        <div class="review-options">
          <div class="review-option wrong">
            <div class="ro-letter">D</div>
            <span>The graph must always be fully connected</span>
            <span style="margin-left:auto;font-size:0.8rem;color:var(--coral);font-weight:700">✗ Your answer</span>
          </div>
          <div class="review-option correct">
            <div class="ro-letter">B</div>
            <span>There are no cycles — you cannot revisit a node</span>
            <span style="margin-left:auto;font-size:0.8rem;color:var(--green-dark);font-weight:700">✓ Correct answer</span>
          </div>
        </div>
        <div class="ai-explanation">
          <div class="ai-label"><span class="ai-dot"></span> AI Explanation</div>
          <p>A DAG does <strong>not</strong> need to be fully connected. It is perfectly valid for a DAG to have disconnected components. The only mandatory property is that it is <em>directed</em> (edges have a direction) and <em>acyclic</em> (following edges never leads back to a previously visited node). Connectivity is a separate graph property entirely.</p>
          <a href="ai-generator.html" class="btn btn-sm btn-outline" style="margin-top:12px">Generate more questions like this ✨</a>
        </div>
      </div>

    </div>

    <!-- Bottom CTA -->
    <div class="card" style="text-align:center;margin-top:32px;background:linear-gradient(135deg,rgba(92,51,246,0.04),rgba(255,217,74,0.06))">
      <div style="font-size:2rem;margin-bottom:10px">🚀</div>
      <h3>Ready for the next module?</h3>
      <p style="margin-top:6px;margin-bottom:20px">Continue your DAG Fundamentals journey with Module 4: Graph Traversal Algorithms.</p>
      <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
        <a href="quiz.html" class="btn btn-primary">Start Module 4 →</a>
        <a href="dashboard.html" class="btn btn-outline">Back to Dashboard</a>
      </div>
    </div>

  </div>

</body>

</html>