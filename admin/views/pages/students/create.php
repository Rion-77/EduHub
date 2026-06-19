<?php
require_once "models/student.class.php";
require_once "models/role.class.php";
/* ************************************* */
// Gets all user roles 
$roles = Role::readAll();


/* ************************************* */
// gets form data and uploads data to database 

// all allowed image type
$imageMimeTypes = [
    'jpg'  => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'png'  => 'image/png',
    'gif'  => 'image/gif',
    'webp' => 'image/webp',
    'avif' => 'image/avif',
    'svg'  => 'image/svg+xml',
    'heic' => 'image/heic',
    'heif' => 'image/heif',
];

if (isset($_POST['submit-btn'])) {
    $name = $_POST['val-username'];
    $email = $_POST['val-email'];
    $role_id = $_POST['val-role'];
    $pass = $_POST['val-password'];
    $confirm_pass = $_POST['val-confirm-password'];
    $profile_picture = $_FILES['profile-picture'];
    
    echo "<pre>";
    // print_r($_POST);
    print_r($profile_picture);
    echo "</pre>";
    
    //Check if the file type is allowed
    $uploaded_image_path = "";


    // checks if a image has been uploaded
    if (!empty($profile_picture['tmp_name'])) {
        $file_type = mime_content_type($profile_picture['tmp_name']);

        if (in_array($file_type, $imageMimeTypes)) {
            $uploaded_image_path = "../assets/img/" . $profile_picture["name"];
            move_uploaded_file($profile_picture['tmp_name'], $uploaded_image_path);
            $uploaded_image_path = "assets/img/" . $profile_picture["name"];
        };
    }
    


    //checks if both passwords matches
    if ($pass = $confirm_pass) {
         $user = new Student(null, $name, $email, $role_id, $pass, $uploaded_image_path);
         $user->create();
         echo "<script>window.location.href='users'; </script>";
        //  header("Location: users");
    }

}
?>

<main id="main-container">
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-1">
                        Add User
                    </h1>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        Add a new user and assign his/her role.
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">Forms</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Validation
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
                    <h3 class="block-title">New User Form</h3>
                </div>
                <div class="block-content block-content-full">
                    <!-- Regular -->

                    <div class="row items-push">
                        <div class="col-lg-8 col-xl-5">
                            <div class="mb-4">
                                <label class="form-label" for="val-username">Full name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="val-username" name="val-username" placeholder="Enter a username..">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="val-email">Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="val-email" name="val-email" placeholder="Your valid email..">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="val-role">Role<span class="text-danger">*</span></label>
                                <select class="form-select" id="val-role" name="val-role">
                                    <option value="">Please select</option>
                                    <?php foreach ($roles as $role) : ?>
                                        <option value="<?= $role['id'] ?>"><?= ucfirst($role['name']) ?></option>
                                    <?php endforeach ?>

                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="val-password">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="val-password" name="val-password" placeholder="Choose a safe one..">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="val-confirm-password">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="val-confirm-password" name="val-confirm-password" placeholder="..and confirm it!">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="profile-picture">Profile Picture</label>
                                <input class="form-control" type="file" name="profile-picture" id="profile-picture">
                            </div>
                        </div>
                    </div>
                    <!-- END Regular -->

                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-7">
                            <button type="submit" class="btn btn-alt-primary" name="submit-btn">Add user</button>
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