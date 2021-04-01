@extends('Admin.layout.plane')
@section('body')
 <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-static-top navbar-dark bg-gradient-x-grey-blue navbar-border navbar-brand-center">
      <div class="navbar-wrapper">
        <div class="navbar-header">
          <ul class="nav navbar-nav flex-row">
            <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="fa fa-bars fa-2x"></i></a></li>
            <li class="nav-item"><a class="navbar-brand" href="{{ url('/dashboard') }}"><img class="brand-logo" alt="stack admin logo" src="{{ asset('admincss/app-assets/images/logo.png') }}">
                <h2 class="brand-text"></h2></a></li>
            <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
          </ul>
        </div>
        <div class="navbar-container content">
          <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="nav navbar-nav mr-auto float-left">
             
            </ul>
            <ul class="nav navbar-nav float-right">
              <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span class="avatar avatar-online"><img src="{{ asset('admincss/app-assets/images/portrait/small/setting.png') }}" alt="avatar"><i></i></span><span class="user-name">Settings</span></a>
                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="{{ url('/changepassword') }}"><i class="fa fa-user"></i> Change Password</a>
                  <div class="dropdown-divider"></div><a class="dropdown-item" href="{{ url('/alogout') }}"><i class="fa fa-power-off"></i> Logout</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-light navbar-without-dd-arrow navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper">
      <!-- Horizontal menu content-->
      <div class="navbar-container main-menu-content" data-menu="menu-container">
        <!-- include ../../../includes/mixins-->
        <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
          <li class="nav-item"><a class="nav-link" href="{{ url('/dashboard') }}"><i class="icon-home"></i><span>Dashboard</span></a>
          </li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/Category') }}"><i class="fa fa-cube"></i><span>Category</span></a>
          </li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/items') }}"><i class="fa fa-archive"></i><span>Products</span></a>
          </li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/offer') }}"><i class="fa fa-file-text-o"></i><span>Offers</span></a>
          </li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/orders') }}"><i class="icon-basket-loaded"></i><span>Orders</span></a>
          </li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/customers') }}"><i class="fa fa-user-o"></i><span>Customers</span></a>
          </li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/itemsales') }}"><i class="icon-book-open"></i><span>Item Sold</span></a>
          </li>
          <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="fa fa-cogs"></i><span>App Settings</span> <i class="fa fa-arrow-down" style="font-size: 10px;"></i></a>
            <ul class="dropdown-menu">
              <li data-menu=""><a class="dropdown-item" href="{{ url('/image') }}" data-toggle="dropdown"><i class="fa fa-picture-o" aria-hidden="true"></i> Advertisement</a></li>
              <li data-menu=""><a class="dropdown-item" href="{{ url('/cartAmount') }}" data-toggle="dropdown"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart Minimum Amount Setting</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- /horizontal menu content-->
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
    	@yield('bodycontent')
    </div>
    <!-- END: Content-->

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light navbar-shadow">
      <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright  &copy; {{ date('Y') }} <a class="text-bold-800 grey darken-2" href="https://1.envato.market/pixinvent_portfolio" target="_blank">FreshOnWheel 			</a></span><span class="float-md-right d-none d-lg-block">Designed & Developed By <a href="http://www.amitzinfy.com/" target="_blank">AMITZINFY PVT LTD.</a></span></p>
    </footer>
    <!-- END: Footer-->

@stop