<?php
require_once("mu-files/config.php");

$quiz_id = 3;
$query = "SELECT question, option_1, option_2, option_3, option_4, answer FROM questions WHERE quiz_id = $quiz_id";

$query_result = $db->query($query);
$questions = $query_result->fetch_all(MYSQLI_ASSOC);
// echo "<pre>";
// print_r($questions);
// echo "</pre>";
if (isset($_POST['submit_btn'])) {
  // echo "Submitted";
  // echo "<pre>";
  // print_r($_POST);
  // echo "</pre>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <title>EduHub · Live Quiz Attempt | DAG Challenge</title>
  <!-- Google Fonts + Font Awesome (no JS) -->
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&family=Quicksand:wght@400;500;600;700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: linear-gradient(145deg, #fef9e8 0%, #fff5e7 100%);
      font-family: 'Inter', 'Quicksand', sans-serif;
      color: #1e2a3e;
      line-height: 1.5;
    }

    /* color palette (fun & education) */
    :root {
      --primary: #6366F1;
      --primary-dark: #4f46e5;
      --secondary: #F59E0B;
      --accent: #10B981;
      --ai-violet: #8B5CF6;
      --text-dark: #1E293B;
      --text-muted: #64748B;
      --border-light: #ffe4bc;
      --shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.06), 0 2px 6px rgba(0, 0, 0, 0.02);
      --shadow-hover: 0 25px 40px -14px rgba(99, 102, 241, 0.18);
    }

    .container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 24px;
    }

    /* header & navigation */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      padding: 20px 0;
      border-bottom: 3px solid #fde68a;
    }

    .logo h1 {
      font-family: 'Quicksand', sans-serif;
      font-weight: 800;
      font-size: 1.9rem;
      background: linear-gradient(135deg, #6366F1, #f97316);
      background-clip: text;
      -webkit-background-clip: text;
      color: transparent;
      letter-spacing: -0.5px;
    }

    .logo span {
      font-size: 0.9rem;
      font-weight: 500;
      color: var(--secondary);
    }

    .nav-links {
      display: flex;
      gap: 28px;
      flex-wrap: wrap;
      list-style: none;
    }

    .nav-links a {
      text-decoration: none;
      font-weight: 600;
      color: #2d3a48;
      transition: 0.2s;
      font-size: 1rem;
    }

    .nav-links a:hover,
    .nav-links a.active {
      color: var(--primary);
      border-bottom: 2px solid var(--secondary);
      padding-bottom: 4px;
    }

    /* button styles */
    .btn-primary {
      background: var(--primary);
      border: none;
      padding: 12px 28px;
      border-radius: 40px;
      font-weight: 600;
      font-family: inherit;
      color: white;
      cursor: pointer;
      transition: 0.2s;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-size: 0.95rem;
    }

    .btn-primary:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
    }

    .btn-secondary {
      background: white;
      border: 2px solid var(--primary);
      color: var(--primary);
      padding: 10px 24px;
      border-radius: 40px;
      font-weight: 600;
      transition: 0.2s;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .btn-secondary:hover {
      background: #eef2ff;
      transform: scale(0.98);
    }

    .btn-outline-ai {
      background: transparent;
      border: 1.5px solid var(--ai-violet);
      color: var(--ai-violet);
      padding: 8px 18px;
      border-radius: 40px;
      font-weight: 500;
      cursor: pointer;
      transition: 0.2s;
    }

    .btn-outline-ai:hover {
      background: #f3e8ff;
    }

    .badge {
      background: #fef3c7;
      padding: 4px 14px;
      border-radius: 30px;
      font-size: 0.75rem;
      font-weight: 700;
      color: #b45309;
      display: inline-block;
    }

    /* main quiz layout */
    .quiz-attempt-wrapper {
      display: grid;
      grid-template-columns: 1fr 320px;
      gap: 32px;
      margin: 40px 0 60px;
    }

    @media (max-width: 900px) {
      .quiz-attempt-wrapper {
        grid-template-columns: 1fr;
        gap: 24px;
      }
    }

    /* question card */
    .question-card {
      background: white;
      border-radius: 40px;
      padding: 32px;
      box-shadow: var(--shadow);
      border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .progress-info {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 24px;
      flex-wrap: wrap;
      gap: 12px;
    }

    .question-text {
      font-size: 1.8rem;
      font-weight: 700;
      margin: 20px 0 28px;
      line-height: 1.3;
      font-family: 'Quicksand', sans-serif;
    }

    .options-list {
      display: flex;
      flex-direction: column;
      gap: 16px;
      margin: 24px 0 32px;
    }

    .option {
      background: #fefcf5;
      border: 1.5px solid #f5e2c1;
      border-radius: 60px;
      padding: 14px 20px;
      display: flex;
      align-items: center;
      gap: 14px;
      cursor: pointer;
      transition: all 0.2s;
    }

    .option-right {
      background: #34e873;
    }
    .option-red {
      background: #e63737;
    }

    .option:hover {
      background: #fff4e4;
      border-color: var(--secondary);
    }

    .option-radio {
      width: 22px;
      height: 22px;
      border-radius: 50%;
      border: 2px solid #cbd5e1;
      background: white;
      display: inline-block;
    }

    .option-text {
      font-weight: 500;
    }

    /* side info card */
    .info-sidebar {
      background: white;
      border-radius: 40px;
      padding: 28px;
      box-shadow: var(--shadow);
      height: fit-content;
    }

    .quiz-meta {
      border-bottom: 2px dashed #fde68a;
      padding-bottom: 20px;
      margin-bottom: 20px;
    }

    .counter {
      font-size: 2rem;
      font-weight: 800;
      color: var(--primary);
    }

    .ai-section {
      background: #faf5ff;
      border-radius: 28px;
      padding: 18px;
      margin-top: 24px;
    }

    .similar-list {
      margin-top: 12px;
      padding-left: 18px;
      color: var(--text-muted);
      font-size: 0.85rem;
    }

    footer {
      background: #1e293b;
      color: #e2e8f0;
      border-radius: 40px 40px 0 0;
      padding: 40px 0 24px;
      margin-top: 60px;
    }

    footer a {
      color: #fcd34d;
      text-decoration: none;
    }

    @media (max-width: 680px) {
      .navbar {
        flex-direction: column;
        gap: 16px;
      }

      .question-text {
        font-size: 1.4rem;
      }

      .btn-primary,
      .btn-secondary {
        padding: 8px 18px;
      }
    }
  </style>
</head>

<body>

  <div class="container">
    <!-- Navigation -->
    <nav class="navbar">
      <div class="logo">
        <h1>eduhub<span>⚡AI</span></h1>
        <div style="font-size:0.75rem;">Learn · Quiz · AI</div>
      </div>
      <ul class="nav-links">
        <li><a href="#">🏠 Home</a></li>
        <li><a href="#">📚 Quiz Library</a></li>
        <li><a href="#" class="active">📝 Live Quiz</a></li>
        <li><a href="#">🏆 Leaderboard</a></li>
        <li><a href="#">🤖 AI Studio</a></li>
      </ul>
    </nav>

    <!-- main quiz area -->
    <div class="quiz-attempt-wrapper">
      <!-- <div class="question-card">
        <div class="progress-info">
          <span class="badge"><i class="fas fa-layer-group"></i> DAG Fundamentals · Quiz #1</span>
          <span><i class="fas fa-clock"></i> Time per question: 45 sec</span>
        </div>
      </div> -->
      <!-- left: question & answers -->

      <form action="quiz-results.php" method="POST">
        <input type="number" name="quiz-id" value="<?= $quiz_id ?>" hidden> 
        <?php
        $loop_count = 0;
        $right_answer_count = 0;

        foreach ($questions as $question) {
          $loop_count++;

        ?>
          <!-- Question Card -->
          <div class="question-card">

            <!-- Question Text -->
            <div class="question-text">
              <label for="">
                <i class="fas fa-question-circle" style="color: var(--secondary);"></i>
                <?= $question["question"] ?></label>
            </div>

            <!-- options -->
            <div class="options-list">
              <!-- Option 1 -->
              <label for="quiz-<?= $loop_count ?>-option-1">
                <div class="option">
                  <span class="option-radio">
                  </span>
                  <span class="option-text"><?= $question["option_1"] ?></span>
                </div>
              </label>
              <input type="radio" name="quiz-<?= $loop_count ?>" id="quiz-<?= $loop_count ?>-option-1"
                value="<?= $question["option_1"] ?>">

              <!-- Option 2 -->
              <label for="quiz-<?= $loop_count ?>-option-2">
                <div class="option">
                  <span class="option-radio">
                  </span>
                  <span class="option-text"><?= $question["option_2"] ?></span>
                </div>
              </label>
              <input type="radio" name="quiz-<?= $loop_count ?>" id="quiz-<?= $loop_count ?>-option-2"
                value="<?= $question["option_2"] ?>">

              <!-- Option 3 -->
              <label for="quiz-<?= $loop_count ?>-option-3">
                <div class="option">
                  <span class="option-radio">
                  </span>
                  <span class="option-text"><?= $question["option_3"] ?></span>
                </div>
              </label>
              <input type="radio" name="quiz-<?= $loop_count ?>" id="quiz-<?= $loop_count ?>-option-3"
                value="<?= $question["option_3"] ?>">

              <!-- Option 4 -->
              <label for="quiz-<?= $loop_count ?>-option-4">
                <div class="option">
                  <span class="option-radio">
                  </span>
                  <span class="option-text"><?= $question["option_4"] ?></span>
                </div>
              </label>
              <input type="radio" name="quiz-<?= $loop_count ?>" id="quiz-<?= $loop_count ?>-option-4"
                value="<?= $question["option_4"] ?>">


            </div>

            <div class="answer-display">
              <?php
              if (isset($_POST['submit_btn'])) {
                echo "You have answered" . $_POST["quiz-$loop_count"] . "<br>";
                echo "Right answer is: " . $question["answer"] . "<br>";

                if ($question["answer"] == $_POST["quiz-$loop_count"]) {
                  echo "it is here<br>";
                  var_dump($_POST["quiz-$loop_count"]);
                  echo "<br>";
                  var_dump($question["answer"]);
                  $right_answer_count++;
                }
              }
              ?>
            </div>

            <!-- action buttons (mock interactions) -->
            <div style="display: flex; flex-wrap: wrap; gap: 16px; margin-top: 12px;">

              <button class="btn-secondary"><i class="fas fa-robot"></i> AI explanation</button>
              <button class="btn-outline-ai"><i class="fas fa-code-branch"></i> Generate similar</button>
            </div>

          </div>
        <?php } ?>
        <button type="submit" class="btn-primary" name="submit_btn"><i class="fas fa-check-circle"></i> Submit
          answer</button>
        <div class="quiz-report">
          You have got <?= $right_answer_count ?> out of <?= count($questions) ?> correct;
        </div>
      </form>

    </div>

  </div>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 24px;">
        <div>
          <h3 style="color:#fcd34d;">eduhub</h3>
          <p>AI‑first learning platform for ISDB & DAG.<br>Quizzes · Leaderboard · AI generation</p>
        </div>
        <div>
          <h4>Explore</h4>
          <p><a href="#">Quiz Library</a><br><a href="#">Live Quiz</a><br><a href="#">AI Studio</a><br><a
              href="#">Tracking</a></p>
        </div>
        <div>
          <h4>AI Features</h4>
          <p>⚡ Generate quiz from topic<br>🔍 AI explanation<br>📚 Similar question generator<br>➕ Auto
            database insert</p>
        </div>
      </div>
      <hr style="margin: 32px 0 16px; border-color:#475569;">
      <div class="text-small" style="text-align: center;">© 2025 EduHub — live quiz attempt demo | All
        interactive
        buttons illustrate future AI behavior (no JS required).</div>
    </div>
  </footer>
</body>

</html>