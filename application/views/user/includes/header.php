<script src="<?php echo base_url(); ?>assets/alert/cute-alert.js"></script>
<link href="<?php echo base_url(); ?>assets/alert/style.css" rel="stylesheet">
 <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">


                <!-- Logo -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->
                        <span><img src="<?php echo base_url(); ?>assets/client_asstes/images/logo.png" alt="homepage" class="logo"  /></span>
                        <!--End Logo icon -->
                        
                    </a>
                </div>
                <!-- End Logo -->


                <div class="navbar-collapse">
                    <!-- toggle and nav items -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link toggle-nav hidden-md-up text-white  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggle hidden-sm-down text-white  " href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        
                    </ul>

                    
                    <!-- User profile and search -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- Comment -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white text-white  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-bell"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated slideInRight">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div>
                                    </li>
                                    <li>
                                        <div class="header-notify">
                                            <!-- Message -->
                                            <a href="#">
                                                <i class="cc BTC m-r-10 f-s-40" title="BTC"></i>
                                                
                                                <div class="notification-contnet">
                                                    <h5>All Transaction BTC</h5> <span class="mail-desc">Just see the my new admin!</span> 
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <i class="cc LTC m-r-10 f-s-40" title="BTC"></i>
                                                <div class="notification-contnet">
                                                    <h5>This is LTC coin</h5> <span class="mail-desc">Just a reminder that you have event</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <i class="cc DASH m-r-10 f-s-40" title="BTC"></i>
                                                <div class="notification-contnet">
                                                    <h5>This is DASH coin</h5> <span class="mail-desc">You can customize this template as you want</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <i class="cc XRP m-r-10 f-s-40" title="BTC"></i>
                                                <div class="notification-contnet">
                                                    <h5>This is LTC coin</h5> <span class="mail-desc">Just see the my admin!</span>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="javascript:void(0);"> Check all notifications <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- End Comment -->
                        <!-- Profile -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->userdata['name'] ?>&nbsp;&nbsp;<i class="fa fa-user"></i></a>
                            <div class="dropdown-menu dropdown-menu-right animated slideInRight">
                                <ul class="dropdown-user">
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"> Profile</a></li>
                                    <li><a href="<?php echo base_url() ?>Login/logout"> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>