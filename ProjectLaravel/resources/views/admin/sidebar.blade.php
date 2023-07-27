<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/products" class="brand-link">
        <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3') }}" style="opacity: 0.8" />
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image" />
            </div>
            <div class="info">
                <a href="#" class="d-block">Admin</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="/products" class="nav-link" id="nav-link-products">
                        <i class="fa-solid fa-house"></i>
                        <p>Sản phẩm</p>
                    </a>
                </li>
                <li class="nav-item" id="list-link">
                    <a class="nav-link" id="nav-link-order">
                        <i class="fa-brands fa-jedi-order"></i>
                        <p>Đơn hàng</p>
                        <i class="fas fa-angle-left right"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/orders" class="nav-link" id="link-order">
                                <i class="fa-solid fa-list-ul"></i>
                                <p>Danh sách đơn hàng</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('orders.history') }}" class="nav-link" id="link-history">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                <p>Đơn hàng đã gửi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders.ordercancel') }}" class="nav-link" id="link-cancel">
                                <i class="fa-solid fa-ban"></i>
                                <p>Đơn hàng đã hủy</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/users" class="nav-link" id="nav-link-users">
                        <i class="fa-solid fa-user"></i>
                        <p>Tài khoản người dùng</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<style>
    .css-active {
        background-color: rgba(255, 255, 255, .9);
        color: black !important
    }
</style>

<script>
    var router = location.href.split('/');
    var link = location.href;
    if (router.includes('products')) {
        $('#nav-link-products').addClass('active');
    }
    if (router.includes('orders')) {
        $('#list-link').addClass('active menu-is-opening menu-open')
        $('#nav-link-order').addClass('active');
        $('#link-order').addClass('css-active');
    }
    if (router.includes('history') || router.includes('historydetail') || link.includes('searchhistory')) {
        $('#link-history').addClass('css-active');
        $('#link-order').removeClass('css-active');
        $('link-cancel').removeClass('css-active')
    }
    if (router.includes('ordercancel') || link.includes('searchordercancel')) {
        $('#link-cancel').addClass('css-active');
        $('#link-order').removeClass('css-active');
        $('#link-history').removeClass('css-active');
    }
    if (router.includes('users')) {
        $('#nav-link-users').addClass('active');
    }
</script>
