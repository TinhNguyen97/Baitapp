<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Quản lý món ăn</title>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" rel="stylesheet" />
  <!-- Font Awesome -->
  <link href="/bai-tap/web-sale/plugins/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <!-- Ionicons -->
  <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" />
  <!-- Tempusdominus Bootstrap 4 -->
  <link href="/bai-tap/web-sale/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
  <!-- iCheck -->
  <link href="/bai-tap/web-sale/plugins/icheck-bootstrap/icheck-bootstrap.min.css" rel="stylesheet" />
  <!-- JQVMap -->
  <link href="/bai-tap/web-sale/plugins/jqvmap/jqvmap.min.css" rel="stylesheet" />
  <!-- Theme style -->
  <link href="/bai-tap/web-sale/dist/css/adminlte.min.css" rel="stylesheet" />

  <link href="/bai-tap/web-sale/plugins/overlayScrollbars/css/OverlayScrollbars.min.css" rel="stylesheet" />
  <!-- Daterange picker -->
  <link href="/bai-tap/web-sale/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" />
  <!-- summernote -->
  <link href="/bai-tap/web-sale/plugins/summernote/summernote-bs4.min.css" rel="stylesheet" />
  <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" rel="stylesheet" />
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

  <div class="wrapper">
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex"></div>

        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>Quản lý món ăn</p>
              </a>
            </li>

            <li class="nav-item" id="user_management"></li>
          </ul>
        </nav>
      </div>
    </aside>

    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Quản lý món ăn</h1>
              <?php
              session_start();
              if (isset($_SESSION['message'])) {
                echo "<h3 style='background-color: aquamarine;color: blue'>$_SESSION[message]</h3>";
              }
              unset($_SESSION['message']);
              ?>
            </div>
          </div>
        </div>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title col-11">Món ăn</h3>

                  <button class="btn btn-primary col-1" data-target="#create-category" data-toggle="modal" type="button">
                    Tạo mới
                  </button>
                </div>
                <!-- /.card-header -->
                <div class="card-body" id="error-404">
                  <table class="table table-bordered table-hover" id="table_category">
                    <thead>
                      <tr>
                        <th style="text-align: center">#</th>
                        <th style="text-align: center">Tên món ăn</th>
                        <th style="text-align: center">Danh mục</th>
                        <th style="text-align: center">Ảnh món ăn</th>
                        <th style="text-align: center">Đơn giá</th>
                        <th style="text-align: center">Giảm giá</th>
                        <th style="text-align: center">Ngày ra mắt</th>

                        <th colspan="2" style="text-align: center">
                          Thao tác
                        </th>
                      </tr>
                    </thead>
                    <tbody id="tableCategory"></tbody>
                  </table>
                </div>
                <div class="card-header">
                  <h3 class="card-title col-9"></h3>
                  <div id="displayPage" class="col-3"></div>
                </div>
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>

    <div class="modal fade" id="delete-cart">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Xóa sản phẩm</h4>
            <button aria-label="Close" class="close" data-dismiss="modal" type="button">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Bạn có muốn xóa không?</p>
          </div>
          <div class="modal-footer justify-content-between" id="footer-delete"></div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <form method="post" id="form-edit" enctype="multipart/form-data" action="/bai-tap/web-sale/php/update.php">
      <input name="id" type="hidden" id="idEdit" />
      <div class="modal fade" id="edit-category">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Chỉnh sửa món ăn</h4>
              <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="name">Tên món ăn</label>
                <input class="form-control" id="editName" name="name" placeholder="Nhập tên sản phẩm" type="text" />
              </div>
              <div class="form-group">
                <label for="category">Danh mục</label>
                <select id="editCategory" name="category"></select>
              </div>
              <div class="form-group">
                <label for="image">Ảnh món ăn</label>
                <!-- <p id="imageCategory"></p> -->
                <img src="" id="editImage" width="140px" height="100px" />
                <input class="form-control" id="editImage" type="file" name="image" />
              </div>
              <div class="form-group">
                <label>Giá</label>
                <input id="editPrice" class="form-control" placeholder="Nhập giá" type="number" name="price" />
              </div>
            </div>
            <div class="modal-footer justify-content-between" id="edit-form"></div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </form>
    <form action="/bai-tap/web-sale/php/create.php" method="post" enctype="multipart/form-data">
      <div class="modal fade" id="create-category">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tạo mới món ăn</h4>
              <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="name">Tên món ăn</label>
                <input name="name" class="form-control" id="name" placeholder="Nhập tên món ăn" type="text" />
              </div>
              <div class="form-group">
                <label for="category">Danh mục món ăn</label>
                <select id="category" name="category"></select>
              </div>
              <div class="form-group">
                <label for="image">Ảnh món ăn</label>
                <input class="form-control" name="image" type="file" />
              </div>
              <div class="form-group">
                <label for="price">Đơn giá</label>
                <input class="form-control" id="price" type="number" placeholder="Nhập giá" name="price" min="0" />
              </div>
              <div class="form-group">
                <label for="price">Giảm giá(%)</label>
                <input class="form-control" id="price" type="number" placeholder="Nhập giá" min="0" name="discount" />
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button class="btn btn-secondary" data-dismiss="modal" type="button">
                Đóng
              </button>
              <button class="btn btn-primary" type="submit" class="close" name="save">
                Tạo mới
              </button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </form>
    <div class="modal fade" id="delete-category">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Xóa sản phẩm</h4>
            <button aria-label="Close" class="close" data-dismiss="modal" type="button">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Bạn có muốn xóa không?</p>
          </div>
          <div class="modal-footer justify-content-between" id="delete-category-button"></div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <!-- Main content -->
  </div>
  <script crossorigin="anonymous" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery -->
  <script src="/bai-tap/web-sale/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="/bai-tap/web-sale/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge("uibutton", $.ui.button);
  </script>
  <!-- Bootstrap 4 -->
  <script src="/bai-tap/web-sale/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="/bai-tap/web-sale/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="/bai-tap/web-sale/plugins/sparklines/sparkline.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="/bai-tap/web-sale/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="/bai-tap/web-sale/plugins/moment/moment.min.js"></script>
  <script src="/bai-tap/web-sale/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="/bai-tap/web-sale/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="/bai-tap/web-sale/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="/bai-tap/web-sale/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dish.js"></script>
</body>

</html>