<?php

// function to count the number of rows in a tables
 function tableRowCount($table_name)
    {
        global $db;
        $sql = "SELECT COUNT(*) count FROM $table_name";
        $result = $db->query($sql);
        return $result->fetch_assoc()['count'];
    }
 
  echo tableRowCount('users');  
?>

<main id="main-container">
    <!-- Hero -->
    <div class="content">
        <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
            <div class="flex-grow-1 mb-1 mb-md-0">
                <h1 class="h3 fw-bold mb-2">
                    Dashboard
                </h1>
                <h2 class="h6 fw-medium fw-medium text-muted mb-0">
                    Welcome <a class="fw-semibold" href="be_pages_generic_profile.html">Rion</a>, everything looks great.
                </h2>
            </div>
            <div class="mt-3 mt-md-0 ms-md-3 space-x-1">
                <a class="btn btn-sm btn-alt-secondary space-x-1" href="be_pages_generic_profile_edit.html">
                    <i class="fa fa-cogs opacity-50"></i>
                    <span>Settings</span>
                </a>
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-sm btn-alt-secondary space-x-1" id="dropdown-analytics-overview" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-calendar-alt opacity-50"></i>
                        <span>All time</span>
                        <i class="fa fa-fw fa-angle-down"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end fs-sm" aria-labelledby="dropdown-analytics-overview">
                        <a class="dropdown-item fw-medium" href="javascript:void(0)">Last 30 days</a>
                        <a class="dropdown-item fw-medium" href="javascript:void(0)">Last month</a>
                        <a class="dropdown-item fw-medium" href="javascript:void(0)">Last 3 months</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item fw-medium" href="javascript:void(0)">This year</a>
                        <a class="dropdown-item fw-medium" href="javascript:void(0)">Last Year</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            <span>All time</span>
                            <i class="fa fa-check"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- Overview -->
        <div class="row items-push">
            <div class="col-sm-6 col-xxl-3">
                <!-- Users -->
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold"><?php echo tableRowCount('users'); ?></dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Users</dd>
                        </dl>
                        <div class="item item-rounded-lg bg-body-light">
                            <i class="far fa-user-circle fs-3 text-primary"></i>
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="users">
                            <span>View all users</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
                <!-- END Users -->
            </div>
            <div class="col-sm-6 col-xxl-3">
                <!-- Topics -->
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold"><?php echo tableRowCount('quiz_category'); ?></dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Topics</dd>
                        </dl>
                        <div class="item item-rounded-lg bg-body-light">
                            <i class="fa fa-chart-bar fs-3 text-primary"></i>
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="course-categories">
                            <span>View All Topics</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
                <!-- END Topics -->
            </div>
            <div class="col-sm-6 col-xxl-3">
                <!-- Exams -->
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold"><?php echo tableRowCount('quizzes'); ?></dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Total Exams Available</dd>
                        </dl>
                        <div class="item item-rounded-lg bg-body-light">
                            <i class="far fa-gem fs-3 text-primary"></i>
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="exams">
                            <span>View all exams</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
                <!-- END Exams -->
            </div>
            <div class="col-sm-6 col-xxl-3">
                <!-- Exam Takens -->
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold"><?php echo tableRowCount('user_quiz_attempts'); ?></dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Exam Takens</dd>
                        </dl>
                        <div class="item item-rounded-lg bg-body-light">
                            <i class="far fa-paper-plane fs-3 text-primary"></i>
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            <span>View all messages</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
                <!-- END Messages -->
            </div>
            
        </div>
        <!-- END Overview -->

    </div>
    <!-- END Page Content -->
</main>