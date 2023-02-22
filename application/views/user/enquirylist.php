<?php
error_reporting(1);
$createdby = $this->session->userdata['user_id'];

if($this->session->userdata['role'] == 2){

$enquiryDetails = $this->db->query("SELECT 
FROM agent_enquiry ae
INNER JOIN enquiry e ON e.enquiry_id = e.enquiry_id
LEFT JOIN (SELECT * FROM address ) a ON a.enquiry_id = e.enquiry_id
LEFT JOIN (SELECT name as c_name,designation as c_designation,mobile_no as c_mobile_no,landline as c_landline,email as c_email,dob as c_dob,marriage_anniversary_date as c_mod,enquiry_id as c_enquiry_id FROM contact_person) c ON c.c_enquiry_id = e.enquiry_id
LEFT JOIN (SELECT name as o_name,mobile_no as o_mobile_no,landline as o_landline,email as o_email,dob as o_dob,marriage_anniversary_date as o_mod,enquiry_id as o_enquiry_id FROM owner_details) o ON o.o_enquiry_id = e.enquiry_id
WHERE ae.user_id = $createdby
	AND e.isactive = 1
	AND ae.end_date IS NULL
ORDER BY e.enquiry_id DESC LIMIT 100")->result();
}
else{
  

$enquiryDetails = $this->db->query("SELECT *
	,(
		SELECT name
		FROM user u
		WHERE u.user_id = e.created_by
		) AS AgentName
FROM agent_enquiry ae
INNER JOIN enquiry e ON e.enquiry_id = e.enquiry_id
LEFT JOIN (SELECT * FROM address ) a ON a.enquiry_id = e.enquiry_id
LEFT JOIN (SELECT name as c_name,designation as c_designation,mobile_no as c_mobile_no,landline as c_landline,email as c_email,dob as c_dob,marriage_anniversary_date as c_mod,enquiry_id as c_enquiry_id FROM contact_person) c ON c.c_enquiry_id = e.enquiry_id
LEFT JOIN (SELECT name as o_name,mobile_no as o_mobile_no,landline as o_landline,email as o_email,dob as o_dob,marriage_anniversary_date as o_mod,enquiry_id as o_enquiry_id FROM owner_details) o ON o.o_enquiry_id = e.enquiry_id
WHERE e.isactive = 1

ORDER BY ae.enquiry_id DESC LIMIT 100")->result();
}

if(isset($_POST['search'])){
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $agent_name = $_POST['agent_name'];
    $party_name = $_POST['party_name'];
    
    if($this->session->userdata['role'] == 2){
    $enquiryDetails = $this->db->query("SELECT * FROM enquiry WHERE isactive = 1 AND  created_by = $createdby AND (created_datetime BETWEEN '$from_date' AND '$to_date')  ORDER BY enquiry_id DESC")->result();
    }
    else{
    $enquiryDetails = $this->db->query("SELECT *,(SELECT name FROM user u where u.user_id = e.created_by) as AgentName  FROM enquiry e WHERE isactive = 1 AND (created_datetime BETWEEN '$from_date' AND '$to_date')  ORDER BY enquiry_id DESC")->result();
    }
    
    
    if(!empty($agent_name)){
        if($this->session->userdata['role'] == 2){
        $enquiryDetails = $this->db->query("SELECT * FROM enquiry e
        LEFT JOIN user u ON u.user_id = e.created_by
        WHERE e.isactive = 1 AND u.name LIKE '%$agent_name%' AND  e.created_by = $createdby AND (e.created_datetime BETWEEN '$from_date' AND '$to_date')  ORDER BY enquiry_id DESC")->result();
        }
        else{
        $enquiryDetails = $this->db->query("SELECT e.enquiry_id,e.name,e.type,e.month,e.is_existing_customer,u.name as AgentName,e.is_customer,e.is_customer  FROM enquiry e
        LEFT JOIN user u ON u.user_id = e.created_by
        WHERE e.isactive = 1  AND u.name LIKE '%$agent_name%' AND (e.created_datetime BETWEEN '$from_date' AND '$to_date')  ORDER BY enquiry_id DESC")->result();
        }
    }
    
    
    if(!empty($party_name)){
        if($this->session->userdata['role'] == 2){
        $enquiryDetails = $this->db->query("SELECT * FROM enquiry e
        LEFT JOIN user u ON u.user_id = e.created_by
        WHERE e.isactive = 1 AND e.name LIKE '%$party_name%' AND  e.created_by = $createdby AND (e.created_datetime BETWEEN '$from_date' AND '$to_date')  ORDER BY enquiry_id DESC")->result();
        }
        else{
        $enquiryDetails = $this->db->query("SELECT e.enquiry_id,e.name,e.type,e.month,e.is_existing_customer,u.name as AgentName,e.is_customer,e.is_customer  FROM enquiry e
        LEFT JOIN user u ON u.user_id = e.created_by
        WHERE e.isactive = 1  AND e.name LIKE '%$party_name%' AND (e.created_datetime BETWEEN '$from_date' AND '$to_date')  ORDER BY enquiry_id DESC")->result();
        }
    }
}





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
    <title>SuperEditors || Enquiry List</title>
    <!-- Custom CSS -->
    
    <link href="<?php echo base_url(); ?>assets/client_asstes/css/style.css" rel="stylesheet">
    
    <!--For JQuery Date Function-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   
      <script>
      $( function() {
        $( "#from_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#to_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
         
      } );
      </script>
 

    <!--For JQuery Date Function-->  
    
     
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
                    <h3 class="text-primary">Enquiry List</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Enquiry List</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
            <!-- Start Page Content -->
                <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Enquiry List</h4>
                                <form method="post" action="<?php echo base_url()."Enquiry/enquirylist" ?>" autocomplete="off">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label>From Date</label>
                                            <input class="form-control" type="text" name="from_date" id="from_date" required  value="<?php if(empty($from_date)){ echo date('2021-01-01') ; }else{ echo $from_date; } ?>" placeholder="From Date" required>
                                        </div>
                                        <div class="col-sm-2">
                                            <label>To Date</label>
                                            <input class="form-control" type="text" name="to_date" id="to_date" required value="<?php echo $to_date ?>" placeholder="To Date" required>
                                        </div>
                                        <?php if($this->session->userdata['role'] == 1){ ?>
                                        <div class="col-sm-3">
                                            <label>Agent Name</label>
                                            <input class="form-control" type="text" name="agent_name" id="agent_name" list="agent_names" value="<?php echo $agent_name ?>" placeholder="Agent Name" >
                                            <datalist id="agent_names">
                                            <?php
                                            $AgentNameSearch = $this->db->query("SELECT name FROM user WHERE isactive = 1")->result();
                                            foreach($AgentNameSearch as $getAgentNameSearch){ ?>
                                             <option value="<?php echo $getAgentNameSearch->name ?>">
                                            <?php  } ?> 
                                            </datalist>
                                        </div>
                                        <?php } ?>
                                        <div class="col-sm-3">
                                            <label>Party Name</label>
                                            <input class="form-control" type="text" name="party_name" id="party_name" list="party_names" value="<?php echo $party_name ?>" placeholder="Party Name" >
                                            <datalist id="party_names">
                                            <?php
                                            $PartyNameSearch = $this->db->query("SELECT name FROM enquiry WHERE isactive = 1")->result();
                                            foreach($PartyNameSearch as $getPartyNameSearch){ ?>
                                             <option value="<?php echo $getPartyNameSearch->name ?>">
                                            <?php  } ?> 
                                            </datalist>
                                        </div>
                                        <div class="col-sm-2">
                                            <br><br>
                                            <button type="submit" name="search" id="search" class="btn btn-primary btn-rounded m-b-10 m-l-5">Search</button>
                                        </div>         
                                    </div>
                                </form>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>S. No</th>
                                                <th>Party Name</th>
                                                <th>Party Type</th>
                                                <th>Month</th>
                                                <th>Is Existing Customer</th>
                                                <th>Is New Customer</th>
                                                <?php if($_SESSION['role'] == 1){ ?>
                                                <th>Created By</th>
                                                <th>Created Date</th>
                                                <?php } ?>
                                                
                                                <th>Address</th>
                                                <th>Country</th>
                                                <th>State</th>
                                                <th>City</th>
                                                <th>Street</th>
                                                <th>Pincode</th>
                                                <th>Contact Name</th>
                                                <th>Designation</th>
                                                <th>Mobile No</th>
                                                <th>Landline No</th>
                                                <th>Email</th>
                                                <th>DOB</th>
                                                <th>Anniversary</th>
                                                <th>Owner Name</th>
                                                <th>Mobile No</th>
                                                <th>Landline No</th>
                                                <th>Email</th>
                                                <th>DOB</th>
                                                <th>Anniversary</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Actions</th>		 		

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $c = 0;
                                            foreach($enquiryDetails as $getenquiryDetails){ 
                                            $c++;
                                            $enquiry_id = $getenquiryDetails->enquiry_id;
                                            if(!empty($enquiry_id)){
                                                $HeadingDetails= $this->db->query("SELECT * FROM quotation_heading WHERE isactive = 1 AND enquiry_id = $enquiry_id ORDER BY 1 DESC LIMIT 1 ")->result();
                                                   foreach($HeadingDetails as $getHeadingDetails){
                                                       $latestheadingid = $getHeadingDetails->heading_id;
                                                   }
                                            }
                                               
                                            ?>
                                                <tr>
                                                    <td><?php echo $c ?></td>
                                                    <td><a href="<?php echo base_url() ?>Enquiry?enquiry_id=<?php echo $getenquiryDetails->enquiry_id ?>" target="_blank"><?php echo $getenquiryDetails->name ?></a></td>
                                                    <td><?php echo $getenquiryDetails->type ?></td>
                                                    <td><?php echo $getenquiryDetails->month ?></td>
                                                    <td><?php echo $getenquiryDetails->is_existing_customer ?></td>
                                                    <td><?php if( $getenquiryDetails->is_customer == 1) { echo 'Yes'; }else{  echo 'No'; } ?></td>
                                                    <?php if($_SESSION['role'] == 1){ ?>
                                                    <td><?php echo $getenquiryDetails->AgentName ?></td>
                                                    <td><?php echo date("d-m-Y H:i",strtotime($getenquiryDetails->created_datetime)) ?></td>
                                                    <?php } ?>
                                                    <td><?php echo $getenquiryDetails->address_type." ".$getenquiryDetails->address_line_1." ".$getenquiryDetails->address_line_2 ?></td>
                                                    <td><?php echo $getenquiryDetails->country ?></td>
                                                    <td><?php echo $getenquiryDetails->state ?></td>
                                                    <td><?php echo $getenquiryDetails->city ?></td>
                                                    <td><?php echo $getenquiryDetails->street ?></td>
                                                    <td><?php echo $getenquiryDetails->pincode ?></td>
                                                    <td><?php echo $getenquiryDetails->c_name ?></td>
                                                    <td><?php echo $getenquiryDetails->c_designation ?></td>
                                                    <td><?php echo $getenquiryDetails->c_mobile_no ?></td>
                                                    <td><?php echo $getenquiryDetails->c_landline ?></td>
                                                    <td><?php echo $getenquiryDetails->c_email ?></td>
                                                    <td><?php echo $getenquiryDetails->c_dob ?></td>
                                                    <td><?php echo $getenquiryDetails->c_mod ?></td>
                                                    <td><?php echo $getenquiryDetails->o_name ?></td>
                                                    <td><?php echo $getenquiryDetails->o_mobile_no ?></td>
                                                    <td><?php echo $getenquiryDetails->o_landline ?></td>
                                                    <td><?php echo $getenquiryDetails->o_email ?></td>
                                                    <td><?php echo $getenquiryDetails->o_dob ?></td>
                                                    <td><?php echo $getenquiryDetails->o_mod ?></td>
                                                    <td><?php echo $getenquiryDetails->start_date ?></td>
                                                    <td><?php echo $getenquiryDetails->end_date ?></td>
                                                    <td>
                                                     <a href="<?php echo base_url() ?>Enquiry?enquiry_id=<?php echo $getenquiryDetails->enquiry_id ?>" target="_blank"><button type="button" class="btn btn-primary btn-rounded m-b-10 m-l-5">View Details</button></a>
                                                        <a href="<?php echo base_url() ?>Enquiry/quotation?enquiry_id=<?php echo $getenquiryDetails->enquiry_id ?>&header_id=<?php echo $latestheadingid ?>" target="_blank"><button type="button" class="btn btn-primary btn-rounded m-b-10 m-l-5">Quotation</button></a>
                                                        <a href="<?php echo base_url() ?>Enquiry?enquiry_id=<?php echo $getenquiryDetails->enquiry_id ?>&#appointment_section" target="_blank"><button type="button" class="btn btn-primary btn-rounded m-b-10 m-l-5">Appointment</button></a>
                                                        <a href="<?php echo base_url() ?>Po?enquiry_id=<?php echo $getenquiryDetails->enquiry_id ?>" target="_blank"><button type="button" class="btn btn-primary btn-rounded m-b-10 m-l-5">PO</button></a>
                                                      
                                                    </td>
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
<!--        <script src="<?php echo base_url(); ?>assets/client_asstes/js/lib/jquery/jquery.min.js"></script>
-->        <!-- Bootstrap tether Core JavaScript -->
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