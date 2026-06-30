<?php
require_once "models/quiz.class.php";
require_once "models/course-category.class.php";


/* ************************************* */
//Check for redirect message
if (isset($_POST['message'])) {
  $msg = "<p class='text-danger mb-1 fw-bold'>" . $_POST['message'] . "</p>";
} elseif (isset($_GET['message'])) {
  $msg = "<p class='text-success mb-1 fw-bold'>" . $_GET['message'] . "</p>";
}

/* ************************************* */
//delete a Exam
if (isset($_POST['delete-id'])) {
  $delete_id = $_POST['delete-id'];
  $delete_response = Quiz::delete($delete_id);
}


/* ************************************* */
// get all quiz data and Pagination
$display_item = 10;
$number_of_page = Quiz::numberOfPage($display_item);

// get quiz based on pagination
if (isset($_GET['page_no'])) {
  $rows = Quiz::readAll($_GET['page_no'], $display_item);
} else {
  $rows = Quiz::readAll(1, $display_item);
}

// echo "<pre>";
// print_r($rows);
// echo "</pre>";


/* ************************************* */
// Time formatter fucntion
function timeFormatter($time)
{
  $divided_time = explode(":", $time);

  $formatted_hour = $divided_time[0] == "00" ? "" : $divided_time[0] . " Hours ";
  $formatted_minute = $divided_time[1] == "00" ? "" : $divided_time[1] . " Minutes ";
  $formatted_seconds = $divided_time[2] == "00" ? "" : $divided_time[2] . " Seconds";

  return $formatted_hour . $formatted_minute . $formatted_seconds;
}


?>

<main id="main-container">
  <!-- Hero -->
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
        <div class="flex-grow-1">
          <h1 class="h3 fw-bold mb-1">
            All Exams
          </h1>
          <h2 class="fs-base lh-base fw-medium text-muted mb-0">
            List of all exam with its type, score, time limit etc.
          </h2>
        </div>
        <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item">
              <a class="link-fx" href="javascript:void(0)">Exams</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
              All Exams
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
        <h3 class="block-title">EXAM LIST</h3>
        <div class="block-options">
          <?= $msg ?? "" ?>
        </div>
      </div>
      <div class="block-content">

        <div class="table-responsive">
          <table class="table table-bordered table-striped table-vcenter">
            <thead>
              <tr>
                <th style="width: 15%;">Exam Name</th>
                <th>Category</th>
                <th style="width: 30%;">Description</th>
                <th>Time Limit</th>
                <th>Score</th>
                <th class="text-center" style="width: 100px;">Actions</th>
              </tr>
            </thead>
            <tbody class="row-data-container">
              <?php foreach ($rows as $row): ?>
                <tr class="data-row-parent">
                  <td style="display: none;" class="data-row-id">
                    <?= $row['id'] ?>
                  </td>
                  <td class="fw-semibold fs-sm data-row-name">
                    <a href="questions?quiz-id=<?= $row['id'] ?>"><?= $row['quiz_name'] ?></a>
                  </td>
                  <td class="fs-sm"><?= $row['category'] ?></td>
                  <td><?= $row['description'] ?></td>
                  <td><?= timeFormatter($row['time_limit']) ?></td>
                  <td><?= $row['score'] ?></td>
                  <td class="text-center">
                    <div class="btn-group">
                      <a href="edit-exam?id=<?= $row['id'] ?>" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                        <i class="fa fa-fw fa-pencil-alt"></i>
                      </a>
                      <button type="button" class="btn btn-sm btn-alt-secondary delete-btn" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteModal">
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

    <!-- Ajax Pagination -->
    <div class="block-content">
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-end">
          <li class="page-item">
            <a class="page-link pagination-link" href="javascript:void(0)" data-pagination="1">
              <span aria-hidden="true">
                <i class="fa fa-angle-double-left"></i>
              </span>
              <span class="visually-hidden">Previous</span>
            </a>
          </li>
          <?php for ($i = 1; $i <= $number_of_page; $i++) : ?>
            <li class="page-item <?php
                                  if (isset($_GET['page_no']) && $i == $_GET['page_no']) {
                                    echo "active";
                                  } elseif (!isset($_GET['page_no']) && $i == 1) {
                                    echo "active";
                                  } else {
                                    echo "";
                                  }
                                  ?>">
              <a class="page-link pagination-link pagination-link-numbered pagination-<?= $i ?>" href="javascript:void(0)" data-pagination="<?= $i ?>"><?= $i ?></a>
            </li>
          <?php endfor ?>
          <li class="page-item">
            <a class="page-link pagination-link" href="javascript:void(0)" aria-label="Next" data-pagination="<?= $number_of_page ?>">
              <span aria-hidden="true">
                <i class="fa fa-angle-double-right"></i>
              </span>
              <span class="visually-hidden">Next</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
  <!-- END Ajax Pagination -->

  <!-- END Full Table -->
  </div>
  <!-- END Page Content -->
</main>

<!-- Delete Modal -->
<?php include_once "views/layouts/delete-modal.php" ?>

<script>
  $(document).ready(function() {
    $('.pagination').on("click", ".pagination-link", function() {
      let paginationNo = $(this).attr('data-pagination');
      // console.log(paginationNo);
      $.ajax({
        url: "api/pagination-soritng-api.php",
        method: "POST",
        data: {
          "pagination-no": paginationNo,
          "dislay-item": <?= $display_item ?>
        },
        success: function(res) {
          let dataObj = JSON.parse(res);
          console.log(dataObj);
          paginationContent(dataObj);
        }
      });

      console.log($(this)[0].closest('.page-item'));
      
      // Add active class to pagination-link
      $('.page-item').removeClass('active');
      // $(this).closest('.page-item').addClass('active');
      $(`.page-item .pagination-link-numbered[data-pagination = "${paginationNo}"] `).closest('.page-item').addClass('active');
    })
    // End Click End

    function paginationContent(obj) {

      let tableHTML = "";
      for (const [key, row] of Object.entries(obj)) {
        tableHTML += `
        <tr class="data-row-parent">
          <td style="display: none;" class="data-row-id">
              ${row['id'] }
            </td>
            <td class="fw-semibold fs-sm data-row-name">
              <a href="questions?quiz-id=${row['id']}">${row['quiz_name'] }</a>
            </td>
            <td class="fs-sm">${row['category'] }</td>
            <td>${row['description'] }</td>
            <td> ${timeFormatter(row['time_limit'])}</td>
            <td>${row['score'] }</td>
            <td class="text-center">
              <div class="btn-group">
                <a href="edit-exam?id=${row['id']}" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                  <i class="fa fa-fw fa-pencil-alt"></i>
                </a>
                <button type="button" class="btn btn-sm btn-alt-secondary delete-btn" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteModal">
                  <i class="fa fa-fw fa-times"></i>
                </button>
                </form>
              </div>
            </td>
        </tr>    
      `
      }

      $('.row-data-container').html(tableHTML);

    }



    // Time formatter
    function timeFormatter(time) {
      const dividedTime = time.split(":");

      const formattedHour = dividedTime[0] === "00" ? "" : dividedTime[0] + " Hours ";
      const formattedMinute = dividedTime[1] === "00" ? "" : dividedTime[1] + " Minutes ";
      const formattedSeconds = dividedTime[2] === "00" ? "" : dividedTime[2] + " Seconds";

      return (formattedHour + formattedMinute + formattedSeconds).trim();
    }

  })
  // End Document Ready
</script>