<?php
require_once "models/student.class.php";
require_once "models/role.class.php";


/* ************************************* */
//Check for redirect message
if (isset($_POST['message'])) {
  $msg = "<p class='text-danger mb-1 fw-bold'>" . $_POST['message'] . "</p>";
} elseif (isset($_GET['message'])) {
  $msg = "<p class='text-success mb-1 fw-bold'>" . $_GET['message'] . "</p>";
}

/* ************************************* */
//delete an user
if (isset($_POST['delete-id'])) {
  $delete_id = $_POST['delete-id'];
  $delete_response = Student::delete($delete_id);
}

/* ************************************* */
// get all users data
$rows = Student::readAll();
// echo "<pre>";
// print_r($rows);
// echo "</pre>";

?>

<main id="main-container">
  <!-- Hero -->
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
        <div class="flex-grow-1">
          <h1 class="h3 fw-bold mb-1">
            All Students
          </h1>
          <h2 class="fs-base lh-base fw-medium text-muted mb-0">
            See the list of all students
          </h2>
        </div>
        <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item">
              <a class="link-fx" href="javascript:void(0)">Students</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
              All Students
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!-- END Hero -->

  <!-- Page Content -->
  <div class="content">
    <!-- Full Table -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">STUDENTS LIST</h3>
        <div class="block-options">
          <?= $msg ?? "" ?>
        </div>
      </div>
      <div class="block-content">

        <div class="table-responsive">
          <table class="table table-bordered table-striped table-vcenter">
            <thead>
              <tr>
                <th class="text-center" style="width: 100px;">
                  <i class="far fa-user"></i>
                </th>
                <th>Name</th>
                <th style="width: 30%;">Email</th>
                
                <th class="text-center" style="width: 100px;">Actions</th>
              </tr>
            </thead>
            <tbody class="row-data-container">
              <?php foreach ($rows as $row): ?>
                <tr class="data-row-parent">
                  <td style="display: none;" class="data-row-id">
                    <?= $row['id'] ?>
                  </td>
                  <td class="text-center">
                    <img class="img-avatar img-avatar48" src="<?= BASE_URL . $row['user_picture_link'] ?>" alt="">
                  </td>
                  <td class="fw-semibold fs-sm data-row-name">
                    <a href="user-profile?user-id=<?= $row['id'] ?>"><?= $row['name'] ?></a>
                  </td>
                  <td class="fs-sm"><?= $row['email'] ?></td>
                  <td class="text-center">
                    <div class="btn-group">
                      <a href="edit-student?id=<?= $row['id'] ?>" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                        <i class="fa fa-fw fa-pencil-alt"></i>
                      </a>
                      <button type="button" class="btn btn-sm btn-alt-secondary delete-btn" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="fa fa-fw fa-times"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              <?php endforeach ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- END Full Table -->
  </div>
  <!-- END Page Content -->
</main>

<!-- Delete Modal -->
<?php include_once "views/layouts/delete-modal.php" ?>