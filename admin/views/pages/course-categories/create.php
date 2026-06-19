<?php
require_once "models/course-category.class.php";


/* ************************************* */
// gets form data and uploads data to database 
if (isset($_POST['submit-btn'])) {
    $name = $_POST['val-name'];
    $description = $_POST['val-description'];

    $course_category = new CourseCategory(null, $name, $description, null);
    $course_category->create();

    header("Location: course-categories");
}
?>

<main id="main-container">
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-1">
                        Add Course Category
                    </h1>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        Add a new Course Category
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">Course Categories</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Add Course Category
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">

        <form class="js-validation" method="POST" novalidate="novalidate">
            <div class="block block-rounded">
                <!-- <div class="block-header block-header-default">
                    <h3 class="block-title">New Category</h3>
                </div> -->
                <div class="block-content block-content-full">
                    <!-- Regular -->

                    <div class="row items-push align-items-center">
                        <div class="col-lg-8 col-xl-5">
                            <div class="">
                                <label class="form-label" for="val-name">Category Name</label>
                                <input type="text" class="form-control" id="val-name" name="val-name" placeholder="Enter New Category Name">
                            </div>
                            <div class="">
                                <label class="form-label" for="val-description">Category description</label>
                                <textarea class="form-control" id="val-description" name="val-description" placeholder="Enter New Role description"></textarea>
                            </div>
                        </div>
                        <!-- Submit -->
                        <div class="col-l2">
                            <button type="submit" class="btn btn-alt-primary" name="submit-btn">Add Category</button>
                        </div>
                        <!-- END Submit -->
                    </div>
                    <!-- END Regular -->

                    <!-- Submit -->
                    <div class="row items-push">

                    </div>
                    <!-- END Submit -->
                </div>
            </div>
        </form>
        <!-- jQuery Validation -->
    </div>
    <!-- END Page Content -->
</main>