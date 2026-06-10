<?php
require_once 'config/database-connect.php';

if(!isset($_GET['quiz-id'])){
  header("location: courses.php");
}



$quiz_id = $_GET['quiz-id'];

// Quiz Details
$details_query = "SELECT quiz_name,description,time_limit FROM quizzes WHERE id= $quiz_id
";


$details_result = $db->query($details_query);
$quiz_details = $details_result->fetch_assoc();

// echo "<pre>";
// print_r($quiz_details);
// echo "</pre>";


// Questions

$query = "SELECT questions.id, question, question_types.name as question_type FROM questions, question_types WHERE quiz_id = $quiz_id AND question_type_id = question_types.id";

$result = $db->query($query);

$questions = $result->fetch_all(MYSQLI_ASSOC);

$question_count = count($questions);

// echo "<pre>";
// print_r($questions);
// echo "</pre>";

$question_counter = 0;



?>

<!-- Header -->
<?php include_once "header.php" ?>


  <!-- ═══ STICKY TOP BAR ═══ -->
  <!-- This whole block is sticky: sits right below the navbar -->
  <div class="quiz-sticky-top">

    <!-- Row 1: back | title | timer | quit -->
    <div class="quiz-info-row">
      <?php if(isset($_GET['category_id'])) :?>
        <a href="course-detail.php?category_id=<?= $_GET['category_id'] ?>" class="quiz-back-btn" title="Back to course">←</a>
      <?php endif ?>
      <!-- PHP: echo $quiz->course_name . ' – ' . $quiz->title -->
      <div class="quiz-title"><?= $quiz_details['quiz_name'] ?></div>
      <!-- Timer — updated by JS countdown -->
      <div class="quiz-timer-pill" id="quizTimer">
        ⏱ <span id="timerDisplay">15:00</span>
      </div>
      <a href="quiz-results.html" class="quiz-quit-btn">Quit</a>
    </div>

    <!-- Row 2: progress bar -->
    <!-- PHP: $pct = ($answered / $total) * 100 -->
    <div class="quiz-progress-row">
      <div class="quiz-progress-count" id="progressCount">0 / <?= $question_count ?> answered</div>
      <div class="quiz-progress-track">
        <div class="quiz-progress-bar" id="progressBar" style="width: 0%"></div>
      </div>
      <div class="quiz-progress-label" id="progressPct">0%</div>
    </div>

  </div><!-- /.quiz-sticky-top -->


  <!-- ═══ QUIZ BODY ═══ -->
  <form action="quiz-results.php" method="POST">
     <!-- Hidden fields for quiz and cateory id  -->
    <input type="hidden" name="quiz-id" value="<?= $_GET['quiz-id'] ?>">
    <?php if(isset($_GET['category_id'])) :?>
        <input type="hidden" name="category_id" value="<?= $_GET['category_id'] ?>">
    <?php endif ?>
  <div class="quiz-body">

    <div class="quiz-card">

      <!-- Card header -->
      <div class="quiz-card-header">
        <div>
          <div class="quiz-card-header-title"><?= $quiz_details['quiz_name'] ?></div>
          <div class="quiz-card-header-meta">10 questions · Medium difficulty · <?= $quiz_details['time_limit'] ?> min</div>
        </div>
        <span class="badge badge-yellow" style="font-size:.75rem">🔥 In Progress</span>
      </div>

      <!-- ─── QUESTIONS ─── -->

      <?php foreach ($questions as $question): ?>
        <div class="question-block" id="qblock-<?= ++$question_counter ?>">
          <div class="q-label">Question <?= $question_counter ?></div>
          <div class="q-text"><?= htmlspecialchars($question['question'], ENT_QUOTES, 'UTF-8') ?></div>
          <div class="q-options" data-question="<?= $question_counter ?>">

            <?php
            $option_query = "SELECT id, option_text FROM question_options WHERE question_id = {$question['id']};";

            $option_result = $db->query($option_query);

            $options = $option_result->fetch_all(MYSQLI_ASSOC);

            // echo "<pre>";
            // print_r($options);
            // echo "</pre>";
            foreach ($options as $option) {

            ?>
              <label class="q-option">
                <input type="radio" name="<?= $question['id'] ?>" value="<?= $option['id'] ?>" />
                <span class="q-radio"></span>
                <span class="q-option-text"><?= htmlspecialchars($option['option_text'], ENT_QUOTES, 'UTF-8') ?></span>
              </label>
            <?php } ?>
          </div>
        </div>
      <?php endforeach ?>
    </div><!-- /.quiz-card -->
  </div><!-- /.quiz-body -->


  <!-- ═══ FIXED BOTTOM SUBMIT BAR ═══ -->
  <div class="quiz-bottom-bar">
    <div class="quiz-bottom-stats">
      <div class="bottom-stat">✅ Answered: <strong id="statAnswered">0</strong></div>
      <div class="bottom-stat">⬜ Unanswered: <strong id="statUnanswered">8</strong></div>
      <div class="bottom-stat">📊 <strong id="statPct">20%</strong> done</div>
    </div>
    <!-- PHP: action="submit_quiz.php" method="POST" -->
    <button type="submit" name="submit" class="quiz-submit-btn">Submit Answers →</button>
  </div>
  </form>


  <script>
    /* ─── QUIZ PAGE INTERACTIVITY ─── */
    (function() {

      /* ── 1. COUNTDOWN TIMER ── */
      var TOTAL_SECONDS = 15 * 60; /* PHP: echo $quiz->time_limit * 60 */
      var remaining = TOTAL_SECONDS;
      var timerDisplay = document.getElementById('timerDisplay');
      var timerPill = document.getElementById('quizTimer');

      function formatTime(s) {
        var m = Math.floor(s / 60);
        var sec = s % 60;
        return (m < 10 ? '0' : '') + m + ':' + (sec < 10 ? '0' : '') + sec;
      }

      var timerInterval = setInterval(function() {
        remaining--;
        if (remaining <= 0) {
          clearInterval(timerInterval);
          timerDisplay.textContent = '00:00';
          /* PHP will handle auto-submit; JS can trigger form submit here */
          return;
        }
        timerDisplay.textContent = formatTime(remaining);
        /* Turn red when under 2 minutes */
        if (remaining <= 120) {
          timerPill.classList.add('warning');
        }
      }, 1000);

      /* ── 2. OPTION SELECTION + PROGRESS TRACKING ── */
      var TOTAL_QUESTIONS = <?= $question_count ?>; /* PHP: echo $total_questions */
      var answered = new Set();

      /* Pre-fill already-answered questions (checked on load) */
      document.querySelectorAll('.q-options input[type="radio"]:checked').forEach(function(r) {
        var qNum = r.closest('.question-block').id.replace('qblock-', '');
        answered.add(qNum);
      });

      function updateProgress() {
        var count = answered.size;
        var pct = Math.round((count / TOTAL_QUESTIONS) * 100);

        document.getElementById('progressBar').style.width = pct + '%';
        document.getElementById('progressPct').textContent = pct + '%';
        document.getElementById('progressCount').textContent = count + ' / ' + TOTAL_QUESTIONS + ' answered';
        document.getElementById('statAnswered').textContent = count;
        document.getElementById('statUnanswered').textContent = TOTAL_QUESTIONS - count;
        document.getElementById('statPct').textContent = pct + '%';
      }

      /* Initial update */
      updateProgress();

      /* Listen to all option clicks */
      document.querySelectorAll('.q-options').forEach(function(group) {
        group.querySelectorAll('.q-option').forEach(function(option) {
          option.addEventListener('click', function() {
            /* Visual: remove selected from siblings */
            group.querySelectorAll('.q-option').forEach(function(o) {
              o.classList.remove('selected');
            });
            option.classList.add('selected');

            /* Check the hidden radio */
            var radio = option.querySelector('input[type="radio"]');
            if (radio) radio.checked = true;

            /* Track answered */
            var qNum = group.closest('.question-block').id.replace('qblock-', '');
            answered.add(qNum);
            updateProgress();
          });
        });
      });

      /* ── 3. AI EXPLANATION BUTTON ── */
      /* Placeholder — PHP/AJAX will handle actual AI fetch */
      document.querySelectorAll('.q-ai-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
          var block = btn.closest('.question-block');
          /* PHP will render the explanation panel; this just shows a loading state */
          btn.textContent = '⏳ Loading explanation…';
          btn.style.opacity = '0.6';
          btn.style.pointerEvents = 'none';
          /* Reset after 2s (remove when PHP AJAX is wired up) */
          setTimeout(function() {
            btn.textContent = '✨ AI Explanation';
            btn.style.opacity = '';
            btn.style.pointerEvents = '';
          }, 2000);
        });
      });

    })();
  </script>

<!-- footer -->
<?php include_once "footer.php" ?>