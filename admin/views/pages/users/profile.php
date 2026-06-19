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


if (empty($row)) {
    header("Location: users?message=User+with+id='$id'+do+not+exists");
}
?>

<main id="main-container">
    <!-- Hero -->
    <div class="bg-image" style="background-image: url('assets/media/photos/photo12@2x.jpg');">
        <div class="bg-black-50">
            <div class="content content-full text-center">
                <div class="my-3">
                    <img class="img-avatar img-avatar-thumb" src="<?= BASE_URL . $row['user_picture_link'] ?>" alt="">
                </div>
                <h1 class="h2 text-white mb-0"><?= $row['name'] ?></h1>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Stats -->
    <div class="bg-body-extra-light">
        <div class="content content-boxed">
            <div class="row items-push text-center">
                <div class="col-6 col-md-3">
                    <div class="fs-sm fw-semibold text-muted text-uppercase">Exams Taken</div>
                    <a class="link-fx fs-3" href="javascript:void(0)"><?= count($attempts) ?></a>
                </div>
                <div class="col-6 col-md-3">
                    <div class="fs-sm fw-semibold text-muted text-uppercase">Total Score</div>
                    <a class="link-fx fs-3" href="javascript:void(0)"><?= $total_user_quiz_socre . " out of " . $total_quiz_socre ?></a>
                </div>
                <div class="col-6 col-md-3">
                    <div class="fs-sm fw-semibold text-muted text-uppercase">Right Answer Percentage</div>
                    <a class="link-fx fs-3" href="javascript:void(0)"><?= ($total_user_quiz_socre / $total_quiz_socre) * 100 . "%" ?></a>
                </div>
                <div class="col-6 col-md-3">
                    <div class="fs-sm fw-semibold text-muted text-uppercase mb-2">Leaderboard Position</div>
                    <a class="link-fx fs-3" href="javascript:void(0)">5</a>
                    <!-- <span class="fs-sm text-muted">from100 students</span> -->
                </div>
            </div>
        </div>
    </div>
    <!-- END Stats -->

    <!-- Page Content -->
    <div class="content content-boxed">
        <!-- Report Button -->
        <a href="user-report?user-id=<?= $id ?>" class="btn btn-alt-info me-1 mb-3">
                  <i class="fa fa-fw fa-file-invoice me-1"></i></i> View Report
        </a>
        <div class="row">
            <div class="col-md-7 col-xl-8">
                <!-- Exam History -->
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
                <!-- /Exam History -->
            </div>
            <div class="col-md-5 col-xl-4">
                <!-- Products -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-briefcase text-muted me-1"></i> User Information
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="d-flex align-items-center push">
                            <div class="flex-shrink-0 me-3">
                                <a class="item item-rounded bg-info" href="javascript:void(0)">
                                    <i class="si si-envelope fa-2x text-white-75"></i>
                                </a>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold">Email</div>
                                <div class="fs-sm"><?= $row['email'] ?></div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center push">
                            <div class="flex-shrink-0 me-3">
                                <a class="item item-rounded bg-amethyst" href="javascript:void(0)">
                                    <i class="si si-user fa-2x text-white-75"></i>
                                </a>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold">Role</div>
                                <div class="fs-sm"><?= $row['role_name'] ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Products -->
            </div>
        </div>
    </div>
    <!-- END Page Content -->
</main>