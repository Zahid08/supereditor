<?php

$transportDetails = $this->db->query("SELECT *,s.state FROM transport t LEFT JOIN state s ON s.id = t.state_id  WHERE is_active = 1")->result();                                   
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/client_asstes/images/favicon.png">
    <title>SuperEditors || Transport Page</title>
    <!-- Custom CSS -->
    
    <link href="<?php echo base_url(); ?>assets/client_asstes/css/style.css" rel="stylesheet">
    
    
</head>

<body class="header-fix fix-sidebar">
    <!-- Main wrapper  -->
    <div id="main-wrapper">
        <!-- header header  -->
       <?php include("includes/header.php") ?>
        <!-- End header header -->
        <!-- Left Sidebar  -->
        <?php include("includes/sidenav.php") ?>
        <!-- End Left Sidebar  -->
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Transport</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Transport</li>
                    </ol>
                </div>
            </div>
             <div class="container-fluid">
                <a href="<?php echo base_url()?>Transport/add_transport" target="_blank"><button type="button" class="btn btn-primary  text-white" >Add Transport</button></a>
                
                <center>
                    <p style="color:green"><?php echo $this->session->flashdata('tranport_message') ?></p>
                </center>
            <!-- Start Page Content -->
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
           
            <!-- Start Page Content -->
                <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Transport</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Transport Name</th>
                                                <th>Address</th>
                                                <th>GST</th>
                                                <th>State</th>
                                                <th>Credit Days</th>
                                                <th>Credit limit</th>
                                                <th>Bank Name</th>
                                                <th>Branch</th>
                                                <th>Acount No.</th>
                                                  <th>IFSC</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=1;
                                            foreach($transportDetails as $getransportDetails){ ?>
                                                <tr>
                                                     <td><?php echo $i++ ?></td>
                                                    <td><?php echo $getransportDetails->transport_name ?></td>
                                                    <td><?php echo $getransportDetails->address ?></td>
                                                    <td><?php echo $getransportDetails->gst ?></td>
                                                    <td><?php echo $getransportDetails->state ?></td>
                                                    <td><?php echo $getransportDetails->credit_day ?></td>
                                                    <td><?php echo $getransportDetails->credit_limit ?></td>
                                                    <td><?php echo $getransportDetails->bank_name ?></td>
                                                    <td><?php echo $getransportDetails->branch ?></td>
                                                     <td><?php echo $getransportDetails->account_no ?></td>
                                                    <td><?php echo $getransportDetails->ifsc ?></td>
                                                    
                                                    <td><a href="<?php echo base_url() ?>Transport/add_transport?transport_id=<?php echo $getransportDetails->transport_id ?>"><button type="button" class="btn btn-primary btn-rounded m-b-10 m-l-5">View Details</button></a>
                                                 <a href="<?php echo base_url() ?>Transport/transport_edit_data?transport_id=<?php echo $getransportDetails->transport_id ?>"><button type="button" class="btn btn-primary btn-rounded m-b-10 m-l-5">Edit</button></a>
                                                 <a href="<?php echo base_url() ?>Transport/transport_delete_data?transport_id=<?php echo $getransportDetails->transport_id ?>"><button type="button" onclick="return confirm('You are Sure want to delete this record');" class="btn btn-primary btn-rounded m-b-10 m-l-5">Delete</button></a></td>

                                                </tr>
                                            <?php
                                            }
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>    
            <!-- End Container fluid  -->
            <!-- footer -->
            <?php include("includes/footer.php") ?>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>
    <!-- End Wrapper -->
    <!-- All Jquery -->
    
    <!-- Scripts -->
        <script src="<?php echo base_url(); ?>assets/client_asstes/js/lib/jquery/jquery.min.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="<?php echo base_url(); ?>assets/client_asstes/js/lib/bootstrap/js/popper.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/client_asstes/js/lib/bootstrap/js/bootstrap.min.js"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="<?php echo base_url(); ?>assets/client_asstes/js/jquery.slimscroll.js"></script>
        <!--Menu sidebar -->
        <script src="<?php echo base_url(); ?>assets/client_asstes/js/sidebarmenu.js"></script>
        <!--stickey kit -->
        <script src="<?php echo base_url(); ?>assets/client_asstes/js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
        <!--Custom JavaScript -->
        <script src="<?php echo base_url(); ?>assets/client_asstes/js/lib/webticker/jquery.webticker.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/client_asstes/js/lib/peitychart/jquery.peity.min.js"></script>
        <!-- scripit init-->
        <script src="<?php echo base_url(); ?>assets/client_asstes/js/custom.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/client_asstes/js/dashboard-1.js"></script>
        
        <!-- Data Tables-->
        <script src="<?php echo base_url(); ?>assets/client_asstes/js/lib/datatables/datatables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/client_asstes/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/client_asstes/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/client_asstes/js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/client_asstes/js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/client_asstes/js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
        <script src="<?php echo base_url(); ?>assets/client_asstes/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/client_asstes/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/client_asstes/js/lib/datatables/datatables-init.js"></script>
       
 
   
</body>

</html>