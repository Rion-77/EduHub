<?php
require_once "models/student.class.php";
require_once "models/role.class.php";

// Gets user id
if (isset($_GET["id"])) {
    $id = $_GET["id"];
} else {
    header("Location: users");
}

$row = Student::readById($id);
// echo "<pre>";
// print_r($row);
// echo "</pre>";

if (empty($row)) {
    header("Location: users?message=User+with+id='$id'+do+not+exists");
}

/* ************************************* */
// Gets all user roles 
$roles = Role::readAll();


/* ************************************* */
// gets form data and updates data 



if (isset($_POST['submit-btn'])) {
    $name = $_POST['val-username'];
    $email = $_POST['val-email'];
    $role_id = $_POST['val-role'];

    $user = new Student($id, $name, $email, $role_id, null, null);

    $response = $user->update();
    

  // Checking if update is successful and showing update message
  if($response === true) {
    header("Location: users?message=User+'$name'+Has+been+Edited");
  } else {
    $msg = "<p class='text-danger'>Something went wrong.User can't be updated</p>";
  }

    echo "<pre>";
    // print_r($_POST);
    // print_r($profile_picture);
    echo "</pre>";
}
?>

<main id="main-container">
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-1">
                        Edit User
                    </h1>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        Update a existing user.
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">Users</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Edit User
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">

        <form class="js-validation" method="POST" novalidate="novalidate" enctype="multipart/form-data">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Edit user</h3>
                    <?= $msg ?? "" ?>
                </div>
                <div class="block-content block-content-full">
                    <!-- Regular -->

                    <div class="row items-push">
                        <div class="col-lg-8 col-xl-5">
                            <div class="mb-4">
                                <label class="form-label" for="val-username">Full name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="val-username" name="val-username" value="<?= $row['name'] ?>">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="val-email">Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="val-email" name="val-email" value="<?= $row['email'] ?>">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="val-role">Role<span class="text-danger">*</span></label>
                                <select class="form-select" id="val-role" name="val-role">
                                    <option value="">Please select</option>
                                    <?php foreach ($roles as $role) {
                                    $selected = $row["role"] == $role['id'] ? "selected": "";    
                                        ?>
                                        <option value="<?= $role['id'] ?>" <?= $selected ?>><?= ucfirst($role['name']) ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- END Regular -->

                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-7">
                            <button type="submit" class="btn btn-alt-primary" name="submit-btn">Update</button>
                        </div>
                    </div>
                    <!-- END Submit -->
                </div>
            </div>
        </form>
        <!-- jQuery Validation -->
    </div>
    <!-- END Page Content -->
</main>