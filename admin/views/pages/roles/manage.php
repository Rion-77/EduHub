<?php
require_once "models/role.class.php";

/* ************************************* */
//delete a role
if (isset($_POST['delete-id'])) {
  $delete_id = $_POST['delete-id'];
  $delete_response = Role::delete($delete_id);

  // Checking if delete is successful and showing delete message
  if ($delete_response === true) {
    $msg = "<p class='text-danger'>Role has been deleted</p>";
  }
}

/* ************************************* */
// gets all roles
$rows = Role::readAll();
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
            All Users
          </h1>
          <h2 class="fs-base lh-base fw-medium text-muted mb-0">
            See the list of all users
          </h2>
        </div>
        <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item">
              <a class="link-fx" href="javascript:void(0)">Users</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
              Users
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
        <h3 class="block-title">USER LIST</h3>
        <?= $msg ?? "" ?>
        <div class="block-options">
          <button type="button" class="btn-block-option">
            <i class="si si-settings"></i>
          </button>
        </div>
      </div>
      <div class="block-content">

        <div class="table-responsive">
          <table class="table table-bordered table-striped table-vcenter">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th class="text-center" style="width: 100px;">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($rows as $row): ?>
                <tr>
                  <td class="fw-semibold fs-sm">
                    <?= $row['id'] ?>
                  </td>
                  <td class="fw-semibold fs-sm">
                    <?= $row['name'] ?>
                  </td>
                  <td class="text-center">
                    <div class="btn-group">
                      <a href="edit-role?id=<?= $row['id'] ?>" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                        <i class="fa fa-fw fa-pencil-alt"></i>
                      </a>
                      <form method="post">
                        <input type="hidden" name="delete-id" value="<?= $row["id"] ?>">
                        <button type="submit" class="btn btn-sm btn-alt-secondary" title="Delete">
                          <i class="fa fa-fw fa-times"></i>
                        </button>
                      </form>

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