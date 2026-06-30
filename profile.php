<!-- Header -->
<?php include_once "header.php" ?>

<?php
//Check if users logged in 
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
}


require_once "config/database-connect.php";
require_once "models/user.class.php";
require_once "models/quiz.class.php";
require_once "models/user-attempt.class.php";
require_once "models/role.class.php";

// Gets user id
if (isset($_SESSION["user_id"])) {
  $id = $_SESSION["user_id"];
}
// else {
//   header("Location: login.php");
// }

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


// if (empty($row)) {
//     header("Location: users?message=User+with+id='$id'+do+not+exists");
// }
?>


<style>
  /* ═══ TIMELINE ═══ */
  .timeline {
    list-style: none;
    margin: 0;
    padding: 0;
    position: relative;
  }

  .timeline-event {
    position: relative;
    display: flex;
    gap: 20px;
    padding-bottom: 32px;
  }

  .timeline-event:last-child {
    padding-bottom: 0;
  }

  /* the vertical connecting line */
  .timeline-event::before {
    content: "";
    position: absolute;
    top: 40px;
    left: 19px;
    width: 2px;
    height: calc(100% - 24px);
    background: #e5e7eb;
  }

  .timeline-event:last-child::before {
    display: none;
  }

  /* alt = icon on the left, content on the right */
  .timeline-alt .timeline-event {
    flex-direction: row;
  }

  /* ── Icon node ── */
  .timeline-event-icon {
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    color: #fff;
    z-index: 1;
    box-shadow: 0 0 0 4px #fff;
  }

  .timeline-event-icon.bg-default {
    background: #6366f1;
  }

  /* ── Content block ── */
  .timeline-event-block {
    flex: 1;
    background: #fff;
    border: 1px solid #eef0f3;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
    overflow: hidden;
    transition: box-shadow 0.2s ease, transform 0.2s ease;
  }

  .timeline-event-block:hover {
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    transform: translateY(-2px);
  }

  .timeline-event-block .block-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 18px;
    border-bottom: 1px solid #f1f2f4;
  }

  .timeline-event-block .block-header h3 {
    margin: 0;
    font-size: 15px;
    font-weight: 600;
    color: #1f2937;
  }

  .timeline-event-block .block-content {
    padding: 14px 18px;
  }

  .timeline-event-block .block-content p {
    margin: 0 0 6px;
    font-size: 14px;
    color: #4b5563;
  }

  .timeline-event-block .block-content p:last-child {
    margin-bottom: 0;
  }

  .timeline-event-block .block-content b {
    color: #1f2937;
    font-weight: 600;
  }

  /* ── Mobile ── */
  @media (max-width: 576px) {
    .timeline-event {
      gap: 12px;
    }

    .timeline-event-icon {
      width: 32px;
      height: 32px;
      font-size: 12px;
    }

    .timeline-event::before {
      left: 15px;
    }
  }
</style>

<!-- Hero -->
<div class="profile-hero">
  <div class="container" style="position:relative;z-index:1;text-align:center">
    <div style="display: flex;justify-content:center;"><img class="rounded-circle" src="<?= $_SESSION['user_picture_link'] ?>" alt="Header Avatar" style="width: 100px;border-radius:50%;border: 1px solid green"></div>
    <!-- PHP: echo $user->name, $user->email, $user->student_id -->
    <div class="profile-name"><?= $_SESSION['user_name'] ?></div>
    <div class="profile-email"><?= $_SESSION['email'] ?></div>
  </div>
</div>

<!-- Content -->
<div class="profile-content">

  <!-- Stats -->
  <div class="pstats anim-fade-up">
    <div class="pstat">
      <div class="val"><?= count($attempts) ?></div>
      <div class="lbl">📝 Quizzes Taken</div>
    </div>
    <div class="pstat">
      <div class="val"><?php
                        if ($total_user_quiz_socre == 0) {
                          echo "0%";
                        } else {
                          echo ($total_user_quiz_socre / $total_quiz_socre) * 100 . "%";
                        }
                        ?></div>
      <div class="lbl">⭐ Avg Score</div>
    </div>
    <div class="pstat">
      <div class="val">66</div>
      <div class="lbl">⚡ Total Points</div>
    </div>
    <div class="pstat">
      <div class="val">4</div>
      <div class="lbl">🎓 Completed</div>
    </div>
  </div>

  <div class="grid-1 anim-fade-up delay-1" style="align-items:start;margin-bottom:20px">

    <!-- Achievements -->
    <div class="card">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px">
        <h3>🏅 Quiz History</h3>
        <!-- <span class="badge badge-primary">6 / 12 earned</span> -->
      </div>
      <div style="display:flex;flex-direction:column;gap:9px">

        <ul class="timeline timeline-alt py-0">
          <?php foreach ($attempts as $attempt) :
            $attempted_quiz = Quiz::readById($attempt['quiz_id']);
            // echo "<pre>";
            // print_r($attempted_quiz);
            // echo "</pre>";
          ?>
            <li class="timeline-event">
              <div class="timeline-event-icon bg-default">
                <i class="fas fa-file-alt"></i>
              </div>
              <div class="timeline-event-block block">
                <div class="block-header">
                  <h3 class="fs-6 mb-0"><?= $attempted_quiz['quiz_name'] ?></h3>
                  <div class="block-options">

                  </div>
                </div>
                <div class="block-content pt-0">
                  <p class="mb-2">
                    <b>Score:</b> <?= $attempt['user_quiz_score'] . " out of " . $attempt['quiz_score'] ?>
                  </p>
                  <p>
                    <b>Exam taken at:</b> <?php $fmtd_datetime = new DateTime($attempt['attempt_at']);
                                          echo $fmtd_datetime->format('d/m/Y h:i A') ?>
                  </p>
                </div>
              </div>
            </li>
          <?php endforeach ?>
        </ul>
      </div>
    </div>

    <div style="display:flex;flex-direction:column;gap:18px">

      <!-- Edit Profile — PHP: action="update_profile.php" method="POST" -->
      <!-- <div class="card">
        
        <div class="tabs" data-tabs style="margin-bottom:20px">
          <span class="tab-link active" data-tab="edit">✏️ Edit Profile</span>
          <span class="tab-link" data-tab="notifs">🔔 Notifications</span>
          <span class="tab-link" data-tab="security">🔒 Security</span>
        </div>

        <div class="tab-panel active" data-tab-panel="edit">
          <div class="form-group"><label class="form-label">Display Name</label><input class="form-input" type="text" name="name" value="Abdullah Rashid" /></div>
          <div class="form-group"><label class="form-label">Email</label><input class="form-input" type="email" name="email" value="abdullah.rashid@example.com" /></div>
          <div class="form-group"><label class="form-label">Student ID</label><input class="form-input" type="text" name="student_id" value="IsDB-2024-0042" /></div>
          <div class="form-group"><label class="form-label">Bio <span style="color:var(--slate);font-weight:400">(optional)</span></label><textarea class="form-textarea" name="bio" style="min-height:76px">IsDB student focused on Islamic Finance and DAG methods.</textarea></div>
          <button class="btn btn-primary">Save Changes</button>
        </div>

        <div class="tab-panel" data-tab-panel="notifs">
          <div class="settings-row">
            <div>
              <div class="settings-label">Leaderboard Updates</div>
              <div class="settings-desc">Get notified when your rank changes</div>
            </div>
            <div class="toggle on"></div>
          </div>
          <div class="settings-row">
            <div>
              <div class="settings-label">Streak Reminders</div>
              <div class="settings-desc">Daily reminder to keep your streak alive</div>
            </div>
            <div class="toggle on"></div>
          </div>
          <div class="settings-row">
            <div>
              <div class="settings-label">New Course Alerts</div>
              <div class="settings-desc">When new courses are added to EduHub</div>
            </div>
            <div class="toggle"></div>
          </div>
          <div class="settings-row">
            <div>
              <div class="settings-label">AI Quiz Ready</div>
              <div class="settings-desc">When your AI-generated quiz is ready</div>
            </div>
            <div class="toggle on"></div>
          </div>
        </div>

        <div class="tab-panel" data-tab-panel="security">
          <div class="form-group"><label class="form-label">Current Password</label><input class="form-input" type="password" placeholder="Enter current password" /></div>
          <div class="form-group"><label class="form-label">New Password</label><input class="form-input" type="password" placeholder="Enter new password" /></div>
          <div class="form-group"><label class="form-label">Confirm New Password</label><input class="form-input" type="password" placeholder="Re-enter new password" /></div>
          <button class="btn btn-primary">Update Password</button>
          <hr style="border:none;border-top:1px solid var(--border);margin:20px 0" />
          <div style="display:flex;gap:9px;flex-wrap:wrap">
            <a href="login.html" class="btn btn-ghost btn-sm" style="color:var(--coral)">🚪 Log Out</a>
            <button class="btn btn-sm" style="background:var(--coral-faint);color:var(--coral);border:1.5px solid rgba(255,107,107,.3)">Delete Account</button>
          </div>
        </div>
      </div> -->

    </div>
  </div>

</div>

<!-- footer -->
<?php include_once "footer.php" ?>