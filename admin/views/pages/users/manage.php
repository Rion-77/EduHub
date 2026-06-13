 <main id="main-container">
        <!-- Hero -->
        <div class="bg-body-light">
          <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
              <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-1">
                  Responsive Tables
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                  Mobile friendly tables that work across all screen sizes.
                </h2>
              </div>
              <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                  <li class="breadcrumb-item">
                    <a class="link-fx" href="javascript:void(0)">Tables</a>
                  </li>
                  <li class="breadcrumb-item" aria-current="page">
                    Responsive
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
              <h3 class="block-title">Full Table</h3>
              <div class="block-options">
                <button type="button" class="btn-block-option">
                  <i class="si si-settings"></i>
                </button>
              </div>
            </div>
            <div class="block-content">
              <p class="fs-sm text-muted">
                The first way to make a table responsive is to wrap it with <code>&lt;div class=&quot;table-responsive&quot;&gt;&lt;/div&gt;</code>. This way, the table will be horizontally scrollable and all data will be accessible on smaller screens. You could also append the following modifiers to the <code>table-responsive</code> to apply the horizontal scrolling on different screen widths: <code>-sm</code>, <code>-md</code>, <code>-lg</code>, <code>-xl</code>.
              </p>
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter">
                  <thead>
                    <tr>
                      <th class="text-center" style="width: 100px;">
                        <i class="far fa-user"></i>
                      </th>
                      <th>Name</th>
                      <th style="width: 30%;">Email</th>
                      <th style="width: 15%;">Access</th>
                      <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-center">
                        <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar3.jpg" alt="">
                      </td>
                      <td class="fw-semibold fs-sm">
                        <a href="be_pages_generic_profile.html">Laura Carr</a>
                      </td>
                      <td class="fs-sm">client1<em class="text-muted">@example.com</em></td>
                      <td>
                        <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-info-light text-info">Business</span>
                      </td>
                      <td class="text-center">
                        <div class="btn-group">
                          <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                            <i class="fa fa-fw fa-pencil-alt"></i>
                          </button>
                          <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Delete">
                            <i class="fa fa-fw fa-times"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-center">
                        <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar5.jpg" alt="">
                      </td>
                      <td class="fw-semibold fs-sm">
                        <a href="be_pages_generic_profile.html">Danielle Jones</a>
                      </td>
                      <td class="fs-sm">client2<em class="text-muted">@example.com</em></td>
                      <td>
                        <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">Disabled</span>
                      </td>
                      <td class="text-center">
                        <div class="btn-group">
                          <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                            <i class="fa fa-fw fa-pencil-alt"></i>
                          </button>
                          <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Delete">
                            <i class="fa fa-fw fa-times"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-center">
                        <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar2.jpg" alt="">
                      </td>
                      <td class="fw-semibold fs-sm">
                        <a href="be_pages_generic_profile.html">Judy Ford</a>
                      </td>
                      <td class="fs-sm">client3<em class="text-muted">@example.com</em></td>
                      <td>
                        <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">Disabled</span>
                      </td>
                      <td class="text-center">
                        <div class="btn-group">
                          <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                            <i class="fa fa-fw fa-pencil-alt"></i>
                          </button>
                          <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Delete">
                            <i class="fa fa-fw fa-times"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-center">
                        <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar7.jpg" alt="">
                      </td>
                      <td class="fw-semibold fs-sm">
                        <a href="be_pages_generic_profile.html">Amber Harvey</a>
                      </td>
                      <td class="fs-sm">client4<em class="text-muted">@example.com</em></td>
                      <td>
                        <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">Disabled</span>
                      </td>
                      <td class="text-center">
                        <div class="btn-group">
                          <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                            <i class="fa fa-fw fa-pencil-alt"></i>
                          </button>
                          <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Delete">
                            <i class="fa fa-fw fa-times"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-center">
                        <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar5.jpg" alt="">
                      </td>
                      <td class="fw-semibold fs-sm">
                        <a href="be_pages_generic_profile.html">Helen Jacobs</a>
                      </td>
                      <td class="fs-sm">client5<em class="text-muted">@example.com</em></td>
                      <td>
                        <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">Disabled</span>
                      </td>
                      <td class="text-center">
                        <div class="btn-group">
                          <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                            <i class="fa fa-fw fa-pencil-alt"></i>
                          </button>
                          <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Delete">
                            <i class="fa fa-fw fa-times"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- END Full Table -->

          <!-- Partial Table -->
          <div class="block block-rounded">
            <div class="block-header block-header-default">
              <h3 class="block-title">Partial Table</h3>
              <div class="block-options">
                <button type="button" class="btn-block-option">
                  <i class="si si-settings"></i>
                </button>
              </div>
            </div>
            <div class="block-content">
              <p class="fs-sm text-muted">
                The second way is to use <a href="be_ui_grid.html#grid-rutil">responsive utility CSS classes</a> for hiding columns in various screen resolutions. This way you can hide less important columns and keep the most valuable on smaller screens. At the following example the <strong>Access</strong> column isn't visible on small and extra small screens and <strong>Email</strong> column isn't visible on extra small screens.
              </p>
              <table class="table table-bordered table-striped table-vcenter">
                <thead>
                  <tr>
                    <th class="text-center" style="width: 100px;">
                      <i class="far fa-user"></i>
                    </th>
                    <th>Name</th>
                    <th class="d-none d-md-table-cell" style="width: 30%;">Email</th>
                    <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center">
                      <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar6.jpg" alt="">
                    </td>
                    <td class="fw-semibold fs-sm">
                      <a href="be_pages_generic_profile.html">Susan Day</a>
                    </td>
                    <td class="d-none d-md-table-cell fs-sm">client1<em class="text-muted">@example.com</em></td>
                    <td class="d-none d-sm-table-cell">
                      <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning">Trial</span>
                    </td>
                    <td class="text-center">
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                          <i class="fa fa-fw fa-pencil-alt"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Delete">
                          <i class="fa fa-fw fa-times"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar6.jpg" alt="">
                    </td>
                    <td class="fw-semibold fs-sm">
                      <a href="be_pages_generic_profile.html">Lisa Jenkins</a>
                    </td>
                    <td class="d-none d-md-table-cell fs-sm">client2<em class="text-muted">@example.com</em></td>
                    <td class="d-none d-sm-table-cell">
                      <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning">Trial</span>
                    </td>
                    <td class="text-center">
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                          <i class="fa fa-fw fa-pencil-alt"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Delete">
                          <i class="fa fa-fw fa-times"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar2.jpg" alt="">
                    </td>
                    <td class="fw-semibold fs-sm">
                      <a href="be_pages_generic_profile.html">Sara Fields</a>
                    </td>
                    <td class="d-none d-md-table-cell fs-sm">client3<em class="text-muted">@example.com</em></td>
                    <td class="d-none d-sm-table-cell">
                      <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">Disabled</span>
                    </td>
                    <td class="text-center">
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                          <i class="fa fa-fw fa-pencil-alt"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Delete">
                          <i class="fa fa-fw fa-times"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar1.jpg" alt="">
                    </td>
                    <td class="fw-semibold fs-sm">
                      <a href="be_pages_generic_profile.html">Lisa Jenkins</a>
                    </td>
                    <td class="d-none d-md-table-cell fs-sm">client4<em class="text-muted">@example.com</em></td>
                    <td class="d-none d-sm-table-cell">
                      <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-info-light text-info">Business</span>
                    </td>
                    <td class="text-center">
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                          <i class="fa fa-fw fa-pencil-alt"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Delete">
                          <i class="fa fa-fw fa-times"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar8.jpg" alt="">
                    </td>
                    <td class="fw-semibold fs-sm">
                      <a href="be_pages_generic_profile.html">Helen Jacobs</a>
                    </td>
                    <td class="d-none d-md-table-cell fs-sm">client5<em class="text-muted">@example.com</em></td>
                    <td class="d-none d-sm-table-cell">
                      <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-info-light text-info">Business</span>
                    </td>
                    <td class="text-center">
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Edit">
                          <i class="fa fa-fw fa-pencil-alt"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="tooltip" title="Delete">
                          <i class="fa fa-fw fa-times"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- END Partial Table -->
        </div>
        <!-- END Page Content -->
      </main>