<template>
    <body>
      <!-- Mirrored from demo.bootstrapdash.com/skydash-free/template/pages/tables/basic-table.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 05 Nov 2023 15:19:20 GMT -->
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  </head>
        <div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo mr-5" href="../../index.html"><img src="../../images/logo.svg" class="mr-2" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="../../images/logo-mini.svg" alt="logo"/></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
          <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-search d-none d-lg-block">
              <div class="input-group">
                <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                  <span class="input-group-text" id="search">
                    <i class="icon-search"></i>
                  </span>
                </div>
                <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
              </div>
            </li>
          </ul>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="icon-bell mx-0"></i>
                <span class="count"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="ti-info-alt mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">Application Error</h6>
                    <p class="font-weight-light small-text mb-0 text-muted">
                      Just now
                    </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-warning">
                      <i class="ti-settings mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">Settings</h6>
                    <p class="font-weight-light small-text mb-0 text-muted">
                      Private message
                    </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                      <i class="ti-user mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">New user registration</h6>
                    <p class="font-weight-light small-text mb-0 text-muted">
                      2 days ago
                    </p>
                  </div>
                </a>
              </div>
            </li>
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                <img src="../../images/faces/face28.jpg" alt="profile"/>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item">
                  <i class="ti-settings text-primary"></i>
                  Settings
                </a>
                <a class="dropdown-item">
                  <i class="ti-power-off text-primary"></i>
                  Logout
                </a>
              </div>
            </li>
            <li class="nav-item nav-settings d-none d-lg-flex">
              <a class="nav-link" href="#">
                <i class="icon-ellipsis"></i>
              </a>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_settings-panel.html -->
        <div class="theme-setting-wrapper">
          <div id="settings-trigger"><i class="ti-settings"></i></div>
          <div id="theme-settings" class="settings-panel">
            <i class="settings-close ti-close"></i>
            <p class="settings-heading">SIDEBAR SKINS</p>
            <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
            <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
            <p class="settings-heading mt-2">HEADER SKINS</p>
            <div class="color-tiles mx-0 px-4">
              <div class="tiles success"></div>
              <div class="tiles warning"></div>
              <div class="tiles danger"></div>
              <div class="tiles info"></div>
              <div class="tiles dark"></div>
              <div class="tiles default"></div>
            </div>
          </div>
        </div>
        <div id="right-sidebar" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
            </li>
          </ul>
          <div class="tab-content" id="setting-content">
            <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
              <div class="add-items d-flex px-3 mb-0">
                <form class="form w-100">
                  <div class="form-group d-flex">
                    <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                    <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                  </div>
                </form>
              </div>
              <div class="list-wrapper px-3">
                <ul class="d-flex flex-column-reverse todo-list">
                  <li>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox">
                        Team review meeting at 3.00 PM
                      </label>
                    </div>
                    <i class="remove ti-close"></i>
                  </li>
                  <li>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox">
                        Prepare for presentation
                      </label>
                    </div>
                    <i class="remove ti-close"></i>
                  </li>
                  <li>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox">
                        Resolve all the low priority tickets due today
                      </label>
                    </div>
                    <i class="remove ti-close"></i>
                  </li>
                  <li class="completed">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox" checked>
                        Schedule meeting for next week
                      </label>
                    </div>
                    <i class="remove ti-close"></i>
                  </li>
                  <li class="completed">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox" checked>
                        Project review
                      </label>
                    </div>
                    <i class="remove ti-close"></i>
                  </li>
                </ul>
              </div>
              <h4 class="px-3 text-muted mt-5 font-weight-light mb-0">Events</h4>
              <div class="events pt-4 px-3">
                <div class="wrapper d-flex mb-2">
                  <i class="ti-control-record text-primary mr-2"></i>
                  <span>Feb 11 2018</span>
                </div>
                <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
                <p class="text-gray mb-0">The total number of sessions</p>
              </div>
              <div class="events pt-4 px-3">
                <div class="wrapper d-flex mb-2">
                  <i class="ti-control-record text-primary mr-2"></i>
                  <span>Feb 7 2018</span>
                </div>
                <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
                <p class="text-gray mb-0 ">Call Sarah Graves</p>
              </div>
            </div>
            <!-- To do section tab ends -->
            <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
              <div class="d-flex align-items-center justify-content-between border-bottom">
                <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
                <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
              </div>
              <ul class="chat-list">
                <li class="list active">
                  <div class="profile"><img src="../../images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                  <div class="info">
                    <p>Thomas Douglas</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">19 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="../../images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                  <div class="info">
                    <div class="wrapper d-flex">
                      <p>Catherine</p>
                    </div>
                    <p>Away</p>
                  </div>
                  <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                  <small class="text-muted my-auto">23 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="../../images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                  <div class="info">
                    <p>Daniel Russell</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">14 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="../../images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                  <div class="info">
                    <p>James Richardson</p>
                    <p>Away</p>
                  </div>
                  <small class="text-muted my-auto">2 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="../../images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                  <div class="info">
                    <p>Madeline Kennedy</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">5 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="../../images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                  <div class="info">
                    <p>Sarah Graves</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">47 min</small>
                </li>
              </ul>
            </div>
            <!-- chat tab ends -->

          </div>
        </div>
        <!-- partial -->
        <!-- partial:../../partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="../../index.html">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">UI Elements</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="../../pages/ui-features/buttons.html">Buttons</a></li>
                  <li class="nav-item"> <a class="nav-link" href="../../pages/ui-features/dropdowns.html">Dropdowns</a></li>
                  <li class="nav-item"> <a class="nav-link" href="../../pages/ui-features/typography.html">Typography</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="/order" aria-expanded="false" aria-controls="form-elements">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Online Store</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link" href="../../pages/forms/basic_elements.html">Basic Elements</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <i class="icon-bar-graph menu-icon"></i>
                <span class="menu-title">Charts</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="../../pages/charts/chartjs.html">ChartJs</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <i class="icon-grid-2 menu-icon"></i>
                <span class="menu-title">Tables</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="../../pages/tables/basic-table.html">Basic table</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <i class="icon-contract menu-icon"></i>
                <span class="menu-title">Icons</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="../../pages/icons/mdi.html">Mdi icons</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="../../pages/samples/login.html"> Login </a></li>
                  <li class="nav-item"> <a class="nav-link" href="../../pages/samples/register.html"> Register </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
                <i class="icon-ban menu-icon"></i>
                <span class="menu-title">Error pages</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="error">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="../../pages/samples/error-404.html"> 404 </a></li>
                  <li class="nav-item"> <a class="nav-link" href="../../pages/samples/error-500.html"> 500 </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../pages/documentation/documentation.html">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Documentation</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <!-------add here------>
              <section class="container-fluid p-4">
        <div class="row ">
          <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3 d-md-flex align-items-center justify-content-between">
              <div class="mb-2 mb-lg-0">
                <h1 class="mb-0 h2 fw-bold">Products </h1>
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a href="admin-dashboard.html">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                      <a href="#">Ecommerce </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Products
                    </li>
                  </ol>
                </nav>
              </div>
              <!-- button -->
              <div>
                <a href="#" class="me-5 text-body"><i class="fe fe-upload me-2"></i>Export</a>
                <a href="#" class="me-5 text-body"><i class="fe fe-download me-2"></i>Import</a>
                <a href="add-product.html" class="btn btn-primary me-2">Add Product</a>
              </div>
            </div>

          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-12">
            <!-- Card -->
            <div class="card rounded-3">
              <!-- Card Header -->
              <div class="card-header border-bottom-0 p-0">
                <ul class="nav nav-lb-tab" id="tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="all-tab" data-bs-toggle="pill" href="#all" role="tab" aria-controls="all" aria-selected="true">All</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="active-tab" data-bs-toggle="pill" href="#active" role="tab" aria-controls="active" aria-selected="false" tabindex="-1">Active</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="draft-tab" data-bs-toggle="pill" href="#draft" role="tab" aria-controls="draft" aria-selected="false" tabindex="-1">Draft</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="archived-tab" data-bs-toggle="pill" href="#archived" role="tab" aria-controls="archived" aria-selected="false" tabindex="-1">Archived</a>
                  </li>

                </ul>
              </div>
              <div class="p-4 row">
                <!-- Form -->
                <form class="d-flex align-items-center col-12 col-md-8 col-lg-3">
                  <span class="position-absolute ps-3 search-icon">
                    <i class="fe fe-search"></i>
                  </span>
                  <input type="search" class="form-control ps-6" placeholder="Filter Products">
                </form>
              </div>
              <div>
                <div class="tab-content" id="tabContent">
                  <!-- Tab -->
                  <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="table-responsive border-0">
                      <!-- Table -->
                      <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox">
                        <!-- Table Head -->
                        <thead class="table-light">
                          <tr>
                            <th>
                              <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkAll">
                                <label class="form-check-label" for="checkAll"></label>
                              </div>
                            </th>
                            <th>Products</th>
                            <th>Status</th>
                            <th>Inventory</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- Table body -->
                          <tr v-for="info in info" :key="info.id">
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" :id="'product_' + info.id">
                                    <label :for="'product_' + info.id" class="form-check-label"></label>
                                </div>
                            </td>
                            <td>
                                <a href="#" class="text-inherit">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <img :src="info.image" :title="info.name" :alt="info.name">
                                        </div>
                                        <div class="ms-3">
                                            <h5 class="mb-0 text-primary-hover">
                                                {{ info.name }}
                                            </h5>
                                        </div>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <span class="badge bg-success badge-dot me-1"></span> {{ info.Status }}
                            </td>
                            <td>
                                {{ info.Stock }}
                            </td>
                            <td>
                                {{ info.productgroup }}
                            </td>
                            <td>
                              ₱{{ info.price }}
                            </td>
                            <td>
                                <span class="dropdown dropstart">
                                    <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" :id="'productDropdown_' + info.id" data-bs-toggle="dropdown" data-bs-offset="-20,20" aria-expanded="false">
                                        <i class="fe fe-more-vertical"></i>
                                    </a>
                                    <span :aria-labelledby="'productDropdown_' + info.id" class="dropdown-menu">
                                        <span class="dropdown-header">Settings</span>
                                        <a class="dropdown-item" href="#"><i class="fe fe-edit dropdown-item-icon"></i>Edit</a>
                                        <a class="dropdown-item" href="#"><i class="fe fe-mail dropdown-item-icon"></i>Invite</a>
                                        <a class="dropdown-item" href="#"><i class="fe fe-trash dropdown-item-icon"></i>Delete</a>
                                    </span>
                                </span>
                            </td>
                        </tr>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Card Footer -->
              <div class="card-footer d-md-flex justify-content-between align-items-center">
                <div>
                  <span>Showing products 1 to 9 of 12</span>
                </div>
                <nav>
                  <ul class="pagination  mb-0 mt-2">
                    <li class="page-item disabled">
                      <a class="page-link mx-1 rounded" href="#"><i class="mdi mdi-chevron-left"></i></a>
                    </li>
                    <li class="page-item active">
                      <a class="page-link mx-1 rounded" href="#">1</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link mx-1 rounded" href="#">2</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link mx-1 rounded" href="#">3</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link mx-1 rounded" href="#"><i class="mdi mdi-chevron-right"></i></a>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </section>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
  </body>
  </template>
  
  <script>
  import axios from 'axios'
  export default {
  data() {
    return {
      info:[],
    };
  },
  created() {
    this.getInfo();
  },
  methods: {
    signIn() {
      // Handle sign-in logic here
      console.log('Signing in...');
    },
    async getInfo() {
        try {
        const inf = await axios.get('getData');
        this.info= inf.data;
        } catch (error) {
            console.log(error);
        }

    },
  },
  loadScripts() {
            const scriptUrls = [
            '../../../../frontend/public/User/vendor.bundle.base.js',
            '../../../../frontend/public/User/vendors/chart.js/Chart.min.js',
            '../../../../frontend/public/User/vendors/datatables.net-bs4/dataTables.bootstrap4.js',
            '../../../../frontend/public/User/off-canvas.js',
            '../../../../frontend/public/User/js/dataTables.select.min.js',
            '../../../../frontend/public/User/vendors/datatables.net/jquery.dataTables.js',
            '../../../../frontend/public/User//hoverable-collapse.js',
            '../../../../frontend/public/User/js/off-canvas.js',
            '../../../../frontend/public/User/js/hoverable-collapse.js',
            '../../../../frontend/public/User/js/template.js',
            '../../../../frontend/public/User/js/jquery.min.js',
            '../../../../frontend/public/User/js/bootstrap.bundle.min.js',
            '../../../../frontend/public/User/js/settings.js',
            '../../../../frontend/public/User/js/todolist.js',
            '../../../../frontend/public/User/js/simplebar.min.js',
            '../../../../frontend/public/User/js/theme.min.js',
            ];
            const head = document.getElementsByTagName('head')[0];
            scriptUrls.forEach((scriptUrl) => {
              const script = document.createElement('script');
              script.src = scriptUrl;
              script.async = true;
              head.appendChild(script);
            });
        },
  };
  </script>
  
  <style scoped>
  @import '../../../../frontend/public/User/fonts/feather/feather.css';
  @import '../../../../frontend/public/User/fonts/bootstrap-icons/font/bootstrap-icons.css';
  @import '../../../../frontend/public/User/fonts/css/theme.min.css';
  @import '../../../../frontend/public/User/fonts/css/materialdesignicons.min.css';
  @import '../../../../frontend/public/User/fonts/simplebar/dist/simplebar.min.css';
      @import '../../../src/assets/User/css/themify-icons.css';
      @import '../../../src/assets/User/css/feather.css';
      @import '../../../src/assets/User/css/vendor.bundle.base.css';
      @import '../../../src/assets/User/css/vertical-layout-light/style.css';
      @import '../../../../frontend/public/User/vendors/datatables.net-bs4/dataTables.bootstrap4.css';
      @import '../../../../frontend/public/User/vendors/ti-icons/css/themify-icons.css';
      @import '../../../../frontend/public/User/js/select.dataTables.min.css';
  </style>
  