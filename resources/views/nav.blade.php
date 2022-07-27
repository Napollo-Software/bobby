<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>@yield('title')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('/assets/img/favicon/favicon.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ url('/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ url('/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ url('/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ url('/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ url('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ url('/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css"/>




    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ url('/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ url('/assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php 
use App\Models\User;
$role = User::where('id', '=', Session::get('loginId'))->value('role');
$image = User::where('id', '=', Session::get('loginId'))->value('avatar');
$name = User::where('id', '=', Session::get('loginId'))->value('name');
$search = $searchrequest['search'] ?? "";
?>
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="{{ url('/dashboard') }}" class="app-brand-link">
              <img src="{{ url('/assets/img/intrustpit-Logo.png') }}">
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item {{ (request()->is('dashboard')) ? 'active' : '' }}">
              <a href="{{ url('/dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li> 
            <!-- Transactions -->
            <li class="menu-item {{ (request()->is('claims', 'claims/create', 'category')) ? 'open active' : '' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Bills</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item {{ (request()->is('claims')) ? 'active' : '' }}">
                  <a href="{{ url('/claims') }}" class="menu-link">
                    <div data-i18n="Without menu">@if ($role == 'Admin') All @endif @if ($role == 'User') My @endif Bills</div>
                  </a>
                </li>
                <li class="menu-item {{ (request()->is('claims/create')) ? 'active' : '' }}">                 
                  <a href="{{ url('/claims/create') }}" class="menu-link">
                    <div data-i18n="Without navbar">Add Bill</div>
                  </a>
                </li>
                @if ($role == 'Admin') 
                <li class="menu-item {{ (request()->is('category')) ? 'active' : '' }}">
                  <a href="{{ url('/category') }}" class="menu-link">
                    <div data-i18n="Container">Manage Categories</div>
                  </a>
                </li>
                @endif
              </ul>
            </li>
            @if ($role == 'Admin')
            <!-- Users -->
            <li class="menu-item {{ (request()->is('all_users', 'add_user', 'manage_roles')) ? 'open active' : '' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Layouts">Users</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item {{ (request()->is('all_users')) ? 'active' : '' }}">
                  <a href="{{ url('/all_users') }}" class="menu-link">
                    <div data-i18n="Without menu">All Users</div>
                  </a>
                </li>
                <li class="menu-item {{ (request()->is('add_user')) ? 'active' : '' }}">
                  <a href="{{ url('/add_user') }}" class="menu-link">
                    <div data-i18n="Without navbar">Add Users</div>
                  </a>
                </li><!--
                <li class="menu-item {{ (request()->is('manage_roles')) ? 'active' : '' }}">
                  <a href="/manage_roles" class="menu-link">
                    <div data-i18n="Without navbar">Manage Roles</div>
                  </a>
                </li>  --> 

              </ul>
            </li>

            <!-- Reports -->
            <li class="menu-item {{ (request()->is('bill_reports')) ? 'active' : '' }}">
              <a href="{{ url('/bill_reports') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-copy-alt"></i>
                <div data-i18n="Layouts">Reports</div>
              </a>
<!--
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="#" class="menu-link">
                    <div data-i18n="Without menu">Bills Reports</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="#" class="menu-link">
                    <div data-i18n="Without menu">Users Reports</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="#" class="menu-link">
                    <div data-i18n="Without navbar">Revenue Reports</div>
                  </a>
                </li>                              
              </ul>-->
            @endif
            <!-- Settings -->
            <li class="menu-item {{ (request()->is('profile_setting', 'notifications')) ? 'open active' : '' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Layouts">Settings</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item {{ (request()->is('profile_setting')) ? 'active' : '' }}">
                  <a href="{{ url('/profile_setting') }}" class="menu-link">
                    <div data-i18n="Without menu">Profile Settings</div>
                  </a>
                </li>
                <li class="menu-item {{ (request()->is('notifications')) ? 'active' : '' }}">
                  <a href="{{ url('/notifications') }}" class="menu-link">
                    <div data-i18n="Without navbar">Notifications</div>
                  </a>
                </li>
              </ul>
            </li>
            <!-- Recycle Bin -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-trash"></i>
                <div data-i18n="Layouts">Recycle Bin</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="#" class="menu-link">
                    <div data-i18n="Without menu">Bills</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="#" class="menu-link">
                    <div data-i18n="Without navbar">Users</div>
                  </a>
                </li>
              </ul>
            </li>            
            <!-- Logout -->
            <li class="menu-item">
              <a href="{{ url('/logout') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-log-in-circle"></i>
                <div data-i18n="Analytics">Logout</div>
              </a>
            </li>                                                               
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

      <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <form action="{{route('claim.search')}}">
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="search"
                    name="search"
                    class="form-control border-0 shadow-none"
                    placeholder="Search your bills here"
                    aria-label="Search..."
                    value="{{ $search }}"
                  />
                </div>
              </div>
            </form>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="{{ $image }}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="{{ $image }}" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{$name}}</span>
                            <small class="text-muted">{{$role}}</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ url('/profile_setting') }}">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-bell me-2"></i>
                        <span class="align-middle">Notifications</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ url('/logout') }}">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
    </nav>

          <!-- / Navbar -->   

          <!-- Content wrapper -->
        <div class="content-wrapper">

        	@yield("wrapper")
            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  <a href="#" target="_blank" class="footer-link fw-bolder">Intrustpit</a> ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  | All rights reserved 
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
<script type="text/javascript">
function showDiv(divId, element)
{
    document.getElementById(divId).style.display = element.value == 'Refused' ? 'block' : 'none';
}
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $("select").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".box").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else{
                $(".box").hide();
            }
        });
    }).change();
     
});
</script>

    <script src="{{ url('/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ url('/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ url('/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ url('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ url('/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ url('/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ url('/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ url('/assets/js/dashboards-analytics.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    @include('sweetalert::alert')
  </body>
</html>
