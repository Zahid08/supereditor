<?php
error_reporting(0);
 $supplierDetailsValue = $this->db->query("SELECT * FROM supplier WHERE is_active = 1")->result();
   $company_name=$_POST['company_name'];
   $fromDate=$_POST['from_date'];
   $toDate=$_POST['to_date'];
  $party_name=$_POST['party_name'];
  
   if(isset($company_name) AND isset($fromDate) AND isset($toDate) ){
       $where = "WHERE 1=1 AND company_name='$company_name' AND s.supplier_id='$party_name' AND ";
   }else{
       $where = "WHERE 1=1 AND date(s.created_date) =  CURRENT_DATE() AND ";
   }
   
     if(!empty($fromDate) && !empty($toDate)){
       $where .= "(s.created_date >='$fromDate' AND s.created_date <='$toDate') AND";
   }else if(!empty($fromDate) && empty($toDate)){
       $where .= "(s.created_date >='$fromDate') AND";
   }else if(empty($fromDate) && !empty($toDate)){
       $where .= "(s.created_date >='$toDate') AND";
   }
   
   $perchaseDetails =  $this->db->query("SELECT s.purchase_supplier_id
   ,s.supplier_id
   ,s.inward_no
   ,s.created_date
   ,s.company_name
   ,s.challan_no
   ,sup.supplier_name
   ,s.showroom_name
   ,p.purchase_item_id
   ,s.created_by
   ,s.created_date
   ,SUM(p.no_of_packs) as no_of_packs
   ,SUM(p.stock_quntitiy) as stock_quntitiy
   ,SUM(p.billing_quntity) as billing_quntity
   ,SUM(p.quantitiy_per_pack) as quantitiy_per_pack
   ,SUM(p.rate) as rate
   ,SUM(p.mrp) as mrp
   ,SUM(p.amount) as amount
   ,SUM(p.tax_per) as tax_per
   ,SUM(p.igst) as igst
   ,SUM(p.cgst) as cgst
   ,SUM(p.sgst) as sgst
   ,SUM(p.total_tax) as total_tax
   ,SUM(p.netamount) as netamount
  	FROM `purchase_supplier`s
   LEFT JOIN purchase_item p ON s.purchase_supplier_id = p.purchase_supplier_id
  	INNER JOIN supplier sup ON sup.supplier_id = s.supplier_id
  $where   s.is_active = 1 
   GROUP BY s.inward_no,sup.supplier_name,s.company_name
   ORDER BY 1 DESC
   ")->result(); 
   
  
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
      <title>SuperEditors || Purchase Paid </title>
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
                  <h3 class="text-primary">Purchase Entry</h3>
               </div>
               <div class="col-md-7 align-self-center">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                     <li class="breadcrumb-item active">Purchase</li>
                  </ol>
               </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
              <center>
                  <p style="color:green"><?php echo $this->session->flashdata('purchase_message') ?></p>
               </center>
               <!-- Start Page Content -->
               <div class="card">
                  <div class="card-body">
                     <h4 class="">Purchase </h4>
                     <br>
                     <div class=" card-title">
                        <form  method="post" action="">
                            <div class="row">
                           <div class="col-sm-3">
                                
                              <select class="form-control " name="company_name"   id="company_name" required>
                                 <option value="">Company/Firm Name </option>
                                 <option value="supereditors" <?php if($company_name == 'supereditors'){ ?> selected <?php } ?> >SuperEditors </option>
                                 <option value="mannasmenswear" <?php if($company_name == 'mannasmenswear'){ ?> selected <?php } ?>>MannasMensWear </option>
                              </select>

                           </div>
                            <div class="col-sm-3">
                                
                              <select class="form-control" name="party_name"   id="party_name" required >
                                  <option value="">Party Name</option>
                                    <?php foreach($supplierDetailsValue as $getsupplierDetails){ ?>
                                    <option value="<?php echo $getsupplierDetails->supplier_id ?>" ><?php echo $getsupplierDetails->supplier_name  ?></option>
                                    <?php } ?>
                                 </select>
                           </div>
                           <div class="col-sm-3">
                                 
                               <input type = "text" class="form-control" name="from_date" id="from_date" placeholder="From Date" value="<?php echo $fromDate ?>" onfocus="this.type='date'">
                          
                           </div>
                            <div class="col-sm-3">
                               
                               <input type = "text" class="form-control" name="to_date" id="to_date" placeholder="To Date" value="<?php echo $toDate ?>" onfocus="this.type='date'">
                           </div>
                            <div class="col-sm-3 ">
                               <button type="submit" name="save" class="btn btn-primary">Search</button>
                           </div>
                           </div>
                        </form>
                     </div>
                     <br>
                     <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                     <div class="table-responsive m-t-40">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                           <thead>
                              <tr>
                                 <th>Sr.No</th>
                                 <th>Inword No</th>
                                 <th>Supplier Name</th>
                                 <th>Bill No/Challan No </th>
                                 <th>Created Date</th>
                                 <th>No of Pack</th>
                                 <th>Showroom Name</th>
                                 <th>Stock Qty</th>
                                 <th>Billing QTy</th>
                                 <th>Purchase Amount</th>
                                 <th>Total IGST</th>
                                 <th>Total CGST</th>
                                 <th>Total SGST</th>
                                 <th>Total Tax</th>
                                 <th>Net Amount</th>
                                 <th>Created By</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 $i=1;
                                     foreach($perchaseDetails as $getperchaseDetails){ ?>
                              <tr>
                                 <td><?php echo $i++ ?></td>
                                 <td><?php echo $getperchaseDetails->inward_no ?></td>
                                  <td><?php echo $getperchaseDetails->supplier_name ?></td>
                                 <td><?php echo $getperchaseDetails->challan_no ?></td>
                                 <td><?php echo date("d-m-Y", strtotime($getperchaseDetails->created_date));  ?></td>
                                 <td><?php echo $getperchaseDetails->no_of_packs ?></td>
                                 <td><?php echo $getperchaseDetails->showroom_name ?></td>
                                 <td><?php echo $getperchaseDetails->stock_quntitiy ?></td>
                                 <td><?php echo $getperchaseDetails->billing_quntity ?></td>
                                 <td><?php echo $getperchaseDetails->amount ?></td>
                                 <td><?php echo $getperchaseDetails->igst ?></td>
                                 <td><?php echo $getperchaseDetails->cgst ?></td>
                                 <td><?php echo $getperchaseDetails->sgst ?></td>
                                 <td><?php echo $getperchaseDetails->total_tax ?></td>
                                 <td><?php echo $getperchaseDetails->netamount ?></td>
                                 <td><?php if($getperchaseDetails->created_by == NULL){ echo 'Self'; }else{ echo 'Admin'; } ?></td>
                                 
                                 <td>
                                    <!--<a href="<?php base_url() ?>Purchase/edit_perchase_data?purchase_item_entry_id=<?php echo $getperchaseDetails->purchase_item_entry_id ?>">
                                       <button type="button" class="btn btn-primary btn-sm" >
                                         Edit
                                       </button></a>
                                       <a href="<?php base_url() ?>Purchase/delte_perchase_data?purchase_item_entry_id=<?php echo $getperchaseDetails->purchase_item_entry_id ?>">
                                       <button type="button" onclick="return confirm('Are you sure you want to delete this records?');"  class="btn btn-primary btn-sm " >
                                         Delete
                                       </button>-->
                                    <a href="<?php base_url() ?>Purchase/add_purchase?purchase_supplier_id=<?php echo $getperchaseDetails->purchase_supplier_id ?>">
                                    <button type="button" class="btn btn-primary btn-sm" >
                                    View Details
                                    </button></a>
                                    
                                    <?php if(!empty($getperchaseDetails->purchase_item_id))
                                       echo "<a href=" . base_url() . "Purchase/item_barcode?purchase_supplier_id=" . $getperchaseDetails->purchase_supplier_id . "><button type='button' class='btn btn-primary btn-sm'>View Barcodes</button></a>";?>
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
               <!-- The Modal -->
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