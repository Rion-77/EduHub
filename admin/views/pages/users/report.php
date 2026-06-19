<?php
require_once "models/user.class.php";
require_once "models/quiz.class.php";
require_once "models/user-attempt.class.php";
require_once "models/role.class.php";

// Gets user id
if (isset($_GET["user-id"])) {
  $id = $_GET["user-id"];
} else {
  header("Location: users");
}

/* ***************************** */
// Get user data
$row = User::readById($id);
// echo "<pre>";
// print_r($row);
// echo "</pre>";

/* ***************************** */
// Get all user attemts
$attempts = UserAttempt::readById($id);
// echo "<pre>";
// print_r($attempts);
// echo "</pre>";
$total_quiz_socre = array_column($attempts, 'quiz_score');
$total_user_quiz_socre = array_column($attempts, 'user_quiz_score');
$total_quiz_socre = array_sum($total_quiz_socre);
$total_user_quiz_socre = array_sum($total_user_quiz_socre);

/* ***************************** */
// Get all user attemts
$loop_counter = 0;

if (empty($row)) {
  header("Location: users?message=User+with+id='$id'+do+not+exists");
}
?>

<main id="main-container">
  <!-- Hero -->
  <div class="bg-body-light d-print-none">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
        <div class="flex-grow-1">
          <h1 class="h3 fw-bold mb-1">
            All Exam Report
          </h1>
          <!-- <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                  Clean and professional design.
                </h2> -->
        </div>
      </div>
    </div>
  </div>
  <!-- END Hero -->

  <!-- Page Content -->
  <div class="content content-boxed">
    <!-- Invoice -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <!-- <h3 class="block-title">#INV0625</h3> -->
        <div class="block-options">
          <!-- Print Page functionality is initialized in Helpers.onePrint() -->
          <button type="button" class="btn-block-option" onclick="One.helpers('one-print');">
            <i class="si si-printer me-1"></i> Print Exam Report
          </button>
        </div>
      </div>
      <div class="block-content">
        <div class="p-sm-4 p-xl-7">
          <!-- Invoice Info -->
          <div class="row mb-4">
            <!-- Company Info -->
            <div class="col-12 fs-sm text-center">
              <p class="h3 mb-0"><?= $row['name'] ?></p>
              <p>
                <?= $row['email'] ?><br>
                <?= $row['role_name'] ?>
              </p>
            </div>
            <!-- END Company Info -->

          </div>
          <!-- END Invoice Info -->

          <!-- Table -->
          <div class="table-responsive push">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center"></th>
                  <th>Exam Name</th>
                  <th class="text-center">Exam given at</th>
                  <th class="text-end" style="width: 120px;">Score</th>
                  <th class="text-end" style="width: 120px;">Score Percentage</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($attempts as $attempt) :
                  $attempted_quiz = Quiz::readById($attempt['quiz_id']);
                ?>
                  <tr>
                    <td class="text-center"><?= ++$loop_counter ?></td>
                    <td>
                      <p class="fw-semibold mb-1"><?= $attempted_quiz['quiz_name'] ?></p>
                      <div class="text-muted"><?= $attempted_quiz['description'] ?></div>
                    </td>
                    <td class="text-center">
                      <?php $fmtd_datetime = new DateTime($attempt['attempt_at']);
                      echo $fmtd_datetime->format('d/m/Y h:i A')  ?>
                    </td>
                    <td class="text-end"><?= $attempt['user_quiz_score'] . " out of " .  $attempt['quiz_score'] ?></td>
                    <td class="text-end"><?= ($attempt['user_quiz_score'] / $attempt['quiz_score']) * 100 . "%" ?></td>
                  </tr>
                <?php endforeach ?>
                <tr>
                  <td colspan="4" class="fw-semibold text-end">Total Score</td>
                  <td class="text-end"><?= $total_user_quiz_socre . " out of " . $total_quiz_socre ?></td>
                </tr>
                <tr>
                  <td colspan="4" class="fw-semibold text-end">Average</td>
                  <td class="text-end"><?= ($total_user_quiz_socre / $total_quiz_socre) * 100 . "%" ?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- END Table -->

        </div>
      </div>
    </div>
    <!-- END Invoice -->
  </div>
  <!-- END Page Content -->
</main>