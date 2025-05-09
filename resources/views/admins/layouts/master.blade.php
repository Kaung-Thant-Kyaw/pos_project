<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>POS Admin Dashboard</title>

        <!-- Custom fonts for this template-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
            integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="{{ asset('admins/css/sb-admin-2.css') }}" rel="stylesheet">

    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">Code Lab Studio</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('adminHome') }}"><i
                            class="fas fa-fw fa-table"></i><span>Dashboard </span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categories.list') }}"><i
                            class="fa-solid fa-circle-plus"></i></i><span>Category
                        </span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.create') }}"><i
                            class="fa-solid fa-plus"></i></i><span>Add Product </span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.list') }}"><i
                            class="fa-solid fa-layer-group"></i><span>Product List
                        </span></a>
                </li>

                @if (auth()->user()->role == 'superadmin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('payment.index') }}"><i
                                class="fa-solid fa-credit-card"></i></i><span>Payment
                                Method
                            </span></a>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.sale.information') }}">
                        <i class="fa-solid fa-list"></i><span>Sale Information
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact.list') }}">
                        <i class="fa-solid fa-message"></i><span>Contact Messages
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.order.list') }}"><i
                            class="fa-solid fa-cart-shopping"></i><span>Order Board
                        </span></a>
                </li>
                @if (auth()->user()->role == 'superadmin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('addAdmin.create') }}"><i class="fa-solid fa-gear"></i><span>
                                Add new admin account
                            </span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.list') }}"><i class="fa-solid fa-users"></i><span>
                                Admin List
                            </span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.list') }}"><i class="fa-solid fa-users"></i><span>
                                User List
                            </span></a>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.changePassword.page') }}">
                        <i class="fa-solid fa-lock"></i>
                        <span>Change Password</span>
                    </a>
                </li>

                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <span class="nav-link">
                            <button type="submit" class="btn bg-dark text-white">
                                <i class="fa-solid fa-right-from-bracket"></i></i>
                                <span>Logout</span>
                            </button>
                        </span>
                    </form>

                </li>
            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light topbar static-top mb-4 bg-white shadow">
                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span
                                        class="d-none d-lg-inline small mr-2 text-gray-600">{{ auth()->user()->name }}</span>
                                    <img class="img-profile rounded-circle"
                                        src="{{ asset(Auth::user()->profile == null ? 'admins/img/undraw_profile.svg' : 'profiles/' . Auth::user()->profile) }}">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right animated--grow-in shadow"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('adminProfile.show') }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    @if (auth()->user()->role == 'superadmin')
                                        <a class="dropdown-item" href="{{ route('addAdmin.create') }}">
                                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Add New Admin Account
                                        </a>
                                        <a class="dropdown-item" href="{{ route('admin.list') }}">
                                            <i class="fas fa-users fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Admin List
                                        </a>
                                        <a class="dropdown-item" href="{{ route('user.list') }}">
                                            <i class="fas fa-users fa-sm fa-fw mr-2 text-gray-400"></i>
                                            User List
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('profile.changePassword.page') }}">
                                        <i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Change Password
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <span class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-link text-dark p-0"><i
                                                    class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Logout
                                            </button>
                                        </form>
                                    </span>
                                </div>
                            </li>

                        </ul>
                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    @include('sweetalert::alert')
                    @yield('content')

                </div>

                <!-- Bootstrap core JavaScript-->
                {{-- <script src="{{ asset('admins/vendor/jquery/jquery.min.js') }}"></script> --}}
                <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
                    crossorigin="anonymous"></script>
                <script src="{{ asset('admins/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

                <!-- Core plugin JavaScript-->
                <script src="{{ asset('admins/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

                <!-- Custom scripts for all pages-->
                <script src="{{ asset('admins/js/sb-admin-2.min.js') }}"></script>

                <!-- Page level plugins -->
                {{-- <script src="{{ asset('admins/vendor/chart.js/Chart.min.js') }}"></script> --}}

                <!-- Page level custom scripts -->
                {{-- <script src="{{ asset('admins/js/demo/chart-area-demo.js') }}"></script>
                <script src="{{ asset('admins/js/demo/chart-pie-demo.js') }}"></script> --}}

                @yield('script')
                {{-- Image Preview --}}
                <script>
                    function loadFile(event) {
                        var reader = new FileReader();

                        reader.onload = function() {
                            var output = document.getElementById('output');
                            output.src = reader.result;
                        }
                        reader.readAsDataURL(event.target.files[0]);
                    }
                </script>

    </body>

</html>
