<?php
error_reporting(0);
   $transportDetails = $this->db->query("SELECT * FROM transport WHERE is_active = 1")->result();
   $itemDetails = $this->db->query("SELECT * FROM items WHERE is_active = 1")->result();
   $supplierDetailsValue = $this->db->query("SELECT * FROM supplier WHERE is_active = 1")->result();
   $measureDetails = $this->db->query("SELECT * FROM measure WHERE is_active = 1")->result();
   $itemtypeDetails = $this->db->query("SELECT * FROM item_type WHERE is_active = 1")->result();
   $brandDetails = $this->db->query("SELECT * FROM brand WHERE is_active = 1")->result();
   
   $ExistingtransportDetails = $this->db->query("SELECT * FROM purchase_transport pt INNER JOIN transport t 
                                                ON t.transport_id = pt.transport_id
                                                WHERE pt.is_active = 1")->result();
    foreach($ExistingtransportDetails as $getExistingtransportDetails){
        $trans_name = $getExistingtransportDetails->transport_name;
        $trans_date = $getExistingtransportDetails->transport_date;
        $lr_no = $getExistingtransportDetails->lr_no;
        $lr_amt_per_parcel = $getExistingtransportDetails->lrper_amount;
        $lr_qty = $getExistingtransportDetails->lr_qty;
        $pick_up_location = $getExistingtransportDetails->pick_up_location;
        $trans_gst = $getExistingtransportDetails->gst_tpt;
        $trans_igst = $getExistingtransportDetails->gst_igst;
        $trans_cgst = $getExistingtransportDetails->gst_cgst;
        $trans_sgst = $getExistingtransportDetails->gst_sgst;
        $trans_total_tax = $getExistingtransportDetails->total_tpt_tax;
        $received_by = $getExistingtransportDetails->Received_by;
        $trans_net_amount = $getExistingtransportDetails->net_amount;
    }
   
   
   $purchase_supplier_id =$_GET['purchase_supplier_id'];
   if(!empty($purchase_supplier_id)){
       
       
       $supplierDetails = $this->db->query("SELECT *,s.supplier_name,s.gst,s.state_id FROM purchase_supplier p INNER JOIN supplier s ON s.supplier_id=p.supplier_id WHERE p.is_active = 1 AND s.is_active = 1 AND purchase_supplier_id = $purchase_supplier_id  ORDER BY purchase_supplier_id DESC")->result();
          foreach($supplierDetails as $getsupplierDetails){
              $purchase_supplier_id = $getsupplierDetails->purchase_supplier_id;
              $supplier_name = $getsupplierDetails->supplier_name;
               $showroom_name = $getsupplierDetails->showroom_name;
              $challan_no = $getsupplierDetails->challan_no;
              $inward_date = $getsupplierDetails->inward_date;
            $company_name = $getsupplierDetails->company_name;
            $supplierid = $getsupplierDetails->supplier_id;
               $gst = $getsupplierDetails->gst;
               $state= $getsupplierDetails->state_id;
               $inward_no = $getsupplierDetails->inward_no;     
       $dicount=0;
       
      
    $PurchseDetails = $this->db->query("SELECT *, p.sgst,p.cgst,p.igst,i.item_type,
    CASE WHEN i.item_type = 'Fabric' THEN (SELECT f.fabric_name FROM fabric f WHERE f.fabric_id = p.item_id)
    ELSE d.item_name END as item_name,s.measure_name,b.brand_name FROM purchase_item p 
    INNER JOIN item_type i ON i.item_type_id = p.item_type_id 
   INNER JOIN items d ON d.item_id = p.item_id
   INNER JOIN measure s ON s.measure_id = p.measure_id 
   
   LEFT JOIN brand b ON b.brand_id = p.brand_id 
   
                                        
    WHERE   p.is_active = 1 AND    purchase_supplier_id= $purchase_supplier_id  ORDER BY  purchase_item_id DESC")->result();
    foreach($PurchseDetails as $PurchseDetailsvalue){
        
         
        
    }
   
    $PurchseDetailsBarcode = $this->db->query("SELECT purchase_item_id FROM purchase_item WHERE purchase_supplier_id= $purchase_supplier_id ")->result();
     foreach($PurchseDetailsBarcode as $PurchseDetailsBarcodevalue){
        $purchase_item_id=$PurchseDetailsBarcodevalue->purchase_item_id;
        //print_r($purchase_item_id);
        
         $barcodeDetailsfist=$this->db->query("SELECT barcode FROM barcodes WHERE is_active = 1 AND purchase_item_id=$purchase_item_id ORDER BY barcode ASC  LIMIT 1")->result();
   $barcodeDetaillast=$this->db->query("SELECT barcode FROM barcodes WHERE is_active = 1 AND purchase_item_id=$purchase_item_id ORDER BY barcode DESC LIMIT 1")->result();
   foreach ($barcodeDetailsfist as $barcodeDetailsfistvalue) {
    $first = $barcodeDetailsfistvalue->barcode;
   
    
   }
   
   foreach ($barcodeDetaillast as $barcodeDetaillastvalue) {
    $last = $barcodeDetaillastvalue->barcode;
    
   }
     
    }
      
   }
   if($state==21){
                $sgst=$gst/2;
                $cgst=$gst/2;
                $igst=0;
            }
            else{
                $igst=$gst;
                $sgst=0;
                $cgst=0;
            }
          }
          
   
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/client_asstes/images/favicon.png">
      <title>SuperEditors || Purchase Page</title>
      <link href="<?php echo base_url(); ?>assets/client_asstes/css/style.css" rel="stylesheet">
      <!--for bootstrap Model-->
      <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
   </head>
   <body class="header-fix fix-sidebar">
       <?php if($this->session->flashdata('purchase_message1')){ 					            
                              echo"<script>
                               
                                   $(document).ready(function () {
                                      $('#myModal').modal('show');
                                 });
                                  </script>
                               <div class='modal' id='myModal' tabindex='-1' aria-labelledby='myModallabel' aria-hidden='true'>
                              <div class='modal-dialog'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  <h5 class='modal-title' id='myModallabel'></h5>
                                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                  </button>
                                </div>
                                <div class='modal-body text'>
                               <p class='card-text'>Item Purchase Entry Successfully Saved
                                 <br>
                                 Barcode Number Generated From  $first To  $last 
                                 <br>
                                 Do you want to print Barcode</p>
                                </div>
                                <div class='modal-footer'>
                                  <a href='".base_url()."Purchase/item_barcode?purchase_supplier_id=$purchase_supplier_id'><button type='button' class='btn btn-primary' >Yes</button></a>
                                </div>
                              </div>
                              </div>
                              </div>";
                              } ?>
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
                  <h3 class="text-primary">Purchase</h3>
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
               <section id="enquiry_section" name="enquiry_section">
                  <center>
                     <p style="color:green"><?php echo $this->session->flashdata('purchase_message') ?>
                     </p>
                  </center>
                  <div id="addRole" class="collapse in">
                     <div class="card">
                        <div class="card-body">
                           <h5 class="card-title">Purchase</h5>
                           <form method="post" action="<?php echo base_url() ?>Purchase/save_purchase_supplier_data" autocomplete="off">
                              <hr>
                              <br>
                              <input class="form-control" type="hidden" name="inword_number" id="inword_number" placeholder="Inward Number" value="<?php echo $inward_no; ?>" required>
                              <h5 class="card-title"><b>Supplier</b></h5>
                              <div class="row">
                                 <div class="col-sm-4 mt-2">
                                    <label>Company Name</label>
                                    <select class="form-control" name="company_name"   id="company_name" required>
                                       <option value="">Company/Firm Name </option>
                                       <option value="supereditors" <?php if($company_name == "supereditors"){ ?>selected<?php } ?> >SuperEditors </option>
                                       <option value="mannasmenswear" <?php if($company_name == "mannasmenswear"){ ?>selected<?php } ?> >MannasMensWear </option>
                                    </select>
                                 </div>
                                 <div class="col-sm-4 mt-2">
                                    <label>Supplier Name</label>
                                    <select class="form-control" name="supplier_name"  id="supplier_name" required>
                                       <option>Supplier Name </option>
                                       <?php foreach($supplierDetailsValue as $getsupplierDetails){ ?>
                                       <option value="<?php echo $getsupplierDetails->supplier_id ?>" <?php if($getsupplierDetails->supplier_id == $supplierid){ ?>selected<?php } ?> ><?php echo $getsupplierDetails->supplier_name  ?></option>
                                       <?php } ?>
                                    </select>
                                 </div>
                                 <div class="col-sm-4 mt-2">
                                    <label>Showroom Name </label>
                                    <input class="form-control" type="text" name="showroom_name" value="<?php echo $showroom_name ?>" id="showroom_name" placeholder="Showroom Name"   >
                                 </div>
                                 <div class="col-sm-4 mt-2">
                                    <label>Challan / Bill Number</label>
                                    <input class="form-control" type="text" name="challan_number" value="<?php echo $challan_no ?>" id="challan_number" placeholder="Challan Number" required>
                                 </div>
                                 <!--<div class="col-sm-4 mt-2">
                                    <label>Bill Number</label>
                                    <input class="form-control" type="text" name="bill_number" id="inword_number" placeholder="Bill Number">
                                    </div> -->
                                 <div class="col-sm-4 mt-2">
                                    <label>Inward Date/Billing Date</label>
                                    <input class="form-control" type="date" name="inword_date" value="<?php echo $inward_date ?>" min="<?php echo date("Y-m-01") ?>"  max="<?php echo date("Y-m-t") ?>"  placeholder="Inward Date" id="inword_date"   required>
                                 </div>
                                 <div class="col-sm-4 mt-2" style="display:none">
                                    <label>Inward # </label>
                                    <input class="form-control" type="text" name="inward_num" value="<?php echo $inward_no ?>" id="inward_num" placeholder="Inward No"  readonly >
                                 </div>
                                 <div class=" mt-5 col-sm-12">
                                    <button  type="submit"  name="save" id="click_form"  class=" btn btn-primary   ">Save</button>
                                 </div>
                              </div>
                           </form>
                           <hr>
                           <h5 class="card-title"><b>Item</b></h5>
                           
                           <center>
                              <p style="color:green"><?php echo $this->session->flashdata('purchase_delete_item_messege') ?>
                              </p>
                           </center>
                           <form method="post" action="<?php echo base_url() ?>Purchase/save_purchase_item_data" autocomplete="off">
                              <div class="row">
                                 <div class="col-sm-12">
                                    <input class="form-control" type="hidden" name="purchase_supplier_id" id="purchase_supplier_id" value="<?php echo $_GET['purchase_supplier_id'] ?>">
                                 </div>
                                 <div class="col-sm-4 mt-2">
                                    <label>Item Type</label>
                                    <select class="form-control" name="item_type" id="item_type" required>
                                       <option value="">Choose Item Type</option>
                                       <?php foreach($itemtypeDetails as $getitemtypeDetails){ ?>
                                       <option value="<?php echo $getitemtypeDetails->item_type_id ?>"><?php echo $getitemtypeDetails->item_type  ?></option>
                                       <?php } ?>
                                    </select>
                                 </div>
                                 <div class="col-sm-4 mt-2 ">
                                    <div class="appending_div"></div>
                                 </div>
                                 <div class="col-sm-4 mt-2">
                                    <label>Item Name</label>
                                    <select class="form-control" name="item_name" id="item_name" required>
                                       <option value="">Choose Item Name</option>
                                       <?php foreach($itemDetails as $getitemDetails){ ?>
                                       <option value="<?php echo $getitemDetails->item_id ?>"><?php echo $getitemDetails->item_name  ?></option>
                                       <?php } ?>
                                    </select>
                                 </div>
                                 <div class="col-sm-4 mt-2">
                                    <label>Size</label>
                                    <select class="form-control" name="size" id="size" required>
                                       <option value="">Size</option>
                                       <?php foreach($measureDetails as $getmeasureDetails){ ?>
                                       <option value="<?php echo $getmeasureDetails->measure_id ?>"><?php echo $getmeasureDetails->measure_name  ?></option>
                                       <?php } ?>
                                    </select>
                                 </div>
                                 <div class="col-sm-4 mt-2"> 
                                    <label>Shade No/Color</label>
                                    <input class="form-control" type="text" name="shade_no" id="shade_no"  placeholder="Shade No/Color" >
                                 </div>
                                 <div class="col-sm-4 mt-2"> 
                                    <label>Number Of Pack</label>
                                    <input class="form-control" type="number" name="no_packs" id="no_packs"  placeholder="Number of packs" required>
                                 </div>
                                 <div class="col-sm-4 mt-2">
                                    <label>Stock Quantity</label>
                                    <input class="form-control" type="number" name="Stock_qty" id="Stock_qty" placeholder="Stock Quantity"  step=".01"  required>
                                 </div>
                                 <div class="col-sm-4 mt-2">
                                    <label>Billling Quantity</label>
                                    <input class="form-control" type="number" name="billing_qty" id="billling_qty" placeholder="Billing Qty" step=".01"  required>
                                 </div>
                                 <div class="col-sm-4 mt-2">
                                    <label>Quantity Per Pack</label>
                                    <input class="form-control" type="number" name="Qty_per_pack" id="Qty_per_pack" placeholder="Qty per pack" readonly required>
                                 </div>
                                 <div class="col-sm-4 mt-2">
                                    <label>Rate</label>
                                    <input class="form-control" type="number" name="rate" id="rate" placeholder="Rate" step=".01" required>
                                 </div>
                                 <div class="col-sm-4 mt-2">
                                    <label>MRP</label> 
                                    <input class="form-control" type="number" name="mrp" id="mrp" placeholder="MRP" step=".01"   required>
                                 </div>
                                 <div class="col-sm-4 mt-2">
                                    <label>Discount</label>
                                    <input class="form-control" type="number" name="discount" min="0" value="<?php echo $dicount ?>"  id="discount" placeholder="Discount"    required>
                                 </div>
                                 <div class="col-sm-4 mt-2">
                                    <label> Amount</label>
                                    <input class="form-control" type="number" name="amount" id="amount"   placeholder="Amount" readonly required>
                                 </div>
                                 <div class="col-sm-4 mt-2">
                                    <label>Tax Per (in %)</label>
                                    <input class="form-control" type="number" name="tax_per" value="<?php echo $gst ?>" id="tax_per"  placeholder="Tax Per " readonly  required>
                                 </div>
                                 <div class="col-sm-4 mt-2">
                                    <label>IGST</label>
                                    <input class="form-control" type="number" name="total_igst" id="total_igst" value="<?php echo  $igst ?>" placeholder="IGST"  readonly  required>
                                 </div>
                                 <div class="col-sm-4 mt-2">
                                    <label> CGST</label>
                                    <input class="form-control" type="number" name="total_cgst" value="<?php echo  $cgst ?>"  id="total_cgst" placeholder="CGST" readonly  required>
                                 </div>
                                 <div class="col-sm-4 mt-2">
                                    <label>SGST</label>
                                    <input class="form-control" type="number" name="total_sgst" value="<?php echo  $sgst ?>" id="total_sgst" placeholder="SGSt" readonly required>
                                 </div>
                                 <div class="col-sm-4 mt-2">
                                    <label>Total Tax</label>
                                    <input class="form-control" type="number" name="total_tax" id="total_tax" placeholder="Total Tax" readonly  required>
                                 </div>
                                 <div class="col-sm-4 mt-2">
                                    <label>Net Amount</label>
                                    <input class="form-control" type="number" name="netamount" id="netamount"   placeholder="Amount" readonly required>
                                 </div>
                                
                                 <div class=" mt-5 col-sm-12">
                                    <button type="submit" name="save" class="btn btn-primary" >
                                    ADD
                                    </button>
                                 </div>
                                 
                                 </div>
                           </form>
                           
                           <center>
                           <p style="color:green;"><?php echo $this->session->flashdata('contact_update_msg') ?></p>
                           </center>
                           <div class="table-responsive m-t-40">
                           <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                           <thead>
                           <tr>
                           <th>Sr NO.</th>
                           <th>Item Type</th>
                           <th>Brand Name</th>
                           <th>Item Name</th>
                           <th>Size</th>
                           <th>ShadeNo/color</th>
                           <th> Number Of Pack</th>
                           <th>Stock Quantity</th>
                           <th>Billling Quantity</th>
                           <th>Quantity Per Pack</th>
                           <th>Rate</th>
                           <th>MRP</th>
                           <th>Discountt</th>
                           <th>Amount</th>
                           <th>Tax Per</th>
                           <th> IGST</th>
                           <th>CGST</th>
                           <th>SGST</th>
                           <th>Total Tax</th>
                           <th>Net Amount</th>
                           <th>Action</th>
                           </tr>
                           </thead>
                           <tbody>
                           <?php
                              $total_amount=0;
                                  $i=1;
                                 foreach($PurchseDetails as $getPurchseDetails){ 
                                 
                                  $total_noof_packes+=$getPurchseDetails->no_of_packs; 
                              $stock_quntitiy+=$getPurchseDetails->stock_quntitiy;
                              $total_amount+=$getPurchseDetails->amount;
                              $total_igst+=$getPurchseDetails->igst; 
                              $total_cgst+=$getPurchseDetails->cgst;
                              $total_sgst+=$getPurchseDetails->sgst;
                              $total_netamount+=$getPurchseDetails->netamount;
                               $tota_billing_quntity+=$getPurchseDetails->billing_quntity;
                                $total_tax+=$getPurchseDetails->total_tax;
                                 
                                 ?>
                           <tr>
                           <td><?php echo $i++ ?></td>
                           <td><?php echo $getPurchseDetails->item_type ?></td>
                           <td><?php echo $getPurchseDetails->brand_name ?></td>
                           <td><?php echo $getPurchseDetails->item_name ?></td>
                           <td><?php echo $getPurchseDetails->measure_name ?></td>
                           <td><?php echo $getPurchseDetails->shade_no ?></td>	
                           <td><?php echo $getPurchseDetails->no_of_packs ?></td>
                           <td><?php echo $getPurchseDetails->stock_quntitiy ?></td>
                           <td><?php echo $getPurchseDetails->billing_quntity ?></td>
                           <td><?php echo $getPurchseDetails->quantitiy_per_pack ?></td>
                           <td><?php echo $getPurchseDetails->rate ?></td>
                           <td><?php echo $getPurchseDetails->mrp ?></td>
                           <td><?php echo $getPurchseDetails->discount ?></td>
                           <td><?php echo $getPurchseDetails->amount ?></td>
                           <td><?php echo $getPurchseDetails->tax_per ?></td>
                           <td><?php echo $getPurchseDetails->igst ?></td>
                           <td><?php echo $getPurchseDetails->cgst ?></td>
                           <td><?php echo $getPurchseDetails->sgst ?></td>
                           <td><?php echo $getPurchseDetails->total_tax ?></td>
                           <td><?php echo $getPurchseDetails->netamount ?></td>
                           <td>
                           <a href="<?php echo base_url(); ?>Purchase/delete_item_data?purchase_item_id=<?php echo $getPurchseDetails->purchase_item_id ?>&purchase_supplier_id=<?php echo $getPurchseDetails->purchase_supplier_id?>">
                           <button type="button" onclick="return confirm('Are you sure you want to delete this records?');"  class="btn btn-primary" >
                           Delete
                           </button>
                           </a>
                           <a href="<?php echo base_url(); ?>Purchase/edit_item_data?purchase_item_id=<?php echo $getPurchseDetails->purchase_item_id ?>&purchase_supplier_id=<?php echo $getPurchseDetails->purchase_supplier_id?>">
                           <button type="button"   class="btn btn-primary" >
                           Edit
                           </button>
                           </a>
                           <!--Contact Modal-->
                           <!--==========================================-->
                           </td>
                           
                           </tr>
                           <?php
                              }
                              ?>
                              
                           
                           </tbody>
                           <tfoot>
                            <tr>
                           <td ></td>
                           <td ><b>Total</b></td>
                           <td ></td>
                           <td ></td>
                           <td ></td>
                           <td></td>
                           <td><b><?php echo  $total_noof_packes ?></b></td>
                           <td><b><?php echo  $stock_quntitiy ?></b></td>
                           <td><b><?php echo  $tota_billing_quntity ?></b></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td><b><?php echo 'Rs. '.$total_amount ?></b></td>
                           <td></td>
                           <td><b><?php echo 'Rs. '.$total_igst ?></b></td>
                           <td><b><?php echo  'Rs. '.$total_cgst ?></b></td>
                           <td><b><?php echo 'Rs. '.$total_sgst ?></b></td>
                           <td><b><?php echo 'Rs. '.$total_tax ?></b></td>
                           <td><b><?php echo 'Rs. '. round($total_netamount) ?></b></td>
                           <td>
                           </td> 
                           </tr>
                           </tfoot>
                           </table>
                           </div>
                           
                           <div class=" mt-3 col-sm-12">
                                    <a href="<?php echo base_url() ?>Purchase">
                                        <button type="button" class="btn btn-primary" >Back</button>
                                    </a>
                                    <a href="#">
                                        <button type="button" class="btn btn-primary" >Genarate Bill</button>
                                    </a>
                                    
                                 </div>
                           
                        
                    <!-- <hr>
                     <br>
                     <h5 class="card-title"><b>Transport</b></h5>
                     <center>
                        <p style="color:green"><?php echo $this->session->flashdata('purchase_message2') ?></p>
                     </center>
                     <br>
                     <form method="post" action="<?php echo base_url() ?>Purchase/save_purchase_transport_data" autocomplete="off">
                        <div class="col-sm-12">
                           <input class="form-control" type="hidden" name="purchase_supplier_id" id="purchase_supplier_id" value="<?php echo $_GET['purchase_supplier_id'] ?>">
                        </div>
                        <div class="row">
                           <div class="col-sm-4 mt-2">
                              <label>Transport Name</label>
                              <select class="form-control" name="transport_Name" id="transport_Name" >
                                 <option value="">Choose Transport Name</option>
                                 <?php foreach($transportDetails as $gettransportDetails){ ?>
                                 <option value="<?php echo $gettransportDetails->transport_id ?>" <?php if($trans_name == $gettransportDetails->transport_name  ) { ?> selected <?php }  ?>><?php echo $gettransportDetails->transport_name  ?></option>
                                 <?php } ?>
                              </select>
                           </div>
                           <div class="col-sm-4 mt-2">
                              <label>Transport Date</label>
                              <input class="form-control" type="date" name="lr_date" id="lr_date" value="<?php echo $trans_date;?>" placeholder="L.R.Date"   >
                           </div>
                           <div class="col-sm-4 mt-2">
                              <label>L.R.Number</label>
                              <input class="form-control" type="text"  name="lr_no" id="lr_no" <?php echo $lr_no ?> placeholder="L.R.No."   >
                           </div>
                           <div class="col-sm-4 mt-2">
                              <label>L.R.Amount (Per Parcel)</label>
                              <input class="form-control" type="number"  name="lrper_amout" id="lrper_amout" <?php echo $lr_amt_per_parcel ?> placeholder="L.R.Amount (Per Parcel)"  >  
                           </div>
                           <div class="col-sm-4 mt-2">
                              <label>L.R. Qty</label>
                              <input class="form-control" type="number"  name="lrqty_amout" id="lrqty_amout" <?php echo $lr_qty ?> placeholder="L.R.Qty"  >  
                           </div>
                           <div class="col-sm-4 mt-2">
                              <label>Total L.R.Amount</label>
                              <input class="form-control" type="number"  name="lr_amout" id="lr_amout" placeholder="L.R.Amount" readonly >  
                           </div>
                           <div class="col-sm-4 mt-2">
                              <label>Pick Up Location</label>
                              <input class="form-control" type="text"  name="pick_up_location" id="pick_up_location" <?php echo $pick_up_location ?> placeholder="Pick Up Place"  >  
                           </div>
                           
                           <div class="col-sm-4 mt-2">
                              <label>GST % On Transport</label>
                              <input class="form-control" type="number" name="gst_tpt" id="gst_tpt" <?php echo $trans_gst ?>  placeholder="GST % Tpt" readonly >
                           </div>   
                           <div class="col-sm-4 mt-2">
                              <label>IGST On Transport</label>
                              <input class="form-control" type="number" name="igst_tpt" id="igst_tpt" <?php echo $trans_igst ?> placeholder="IGST Tpt"  readonly>
                           </div>
                           <div class="col-sm-4 mt-2">
                              <label>CGST On Transport</label>
                              <input class="form-control" type="number" name="cgst_tpt" id="cgst_tpt" <?php echo $trans_cgst ?> placeholder="CGST Tpt" readonly>
                           </div>
                           <div class="col-sm-4 mt-2">
                              <label>SGST On Transport</label>
                              <input class="form-control" type="number" name="sgst_tpt" id="sgst_tpt" <?php echo $trans_sgst ?> placeholder="Total SGST" readonly>
                           </div>
                           <div class="col-sm-4 mt-2">
                              <label>Total Tax On Transport</label>
                              <input class="form-control" type="number" name="total_tpt_tax" id="total_tpt_tax" <?php echo $trans_total_tax; ?> placeholder="Total Tax" readonly  >
                           </div>
                           <div class="col-sm-4 mt-2"> 
                              <label>Received By</label>
                              <input class="form-control" type="text" name="Received_by" id="Received_by" <?php echo $received_by  ?> placeholder="Recived By "  >
                           </div>
                           <div class="col-sm-4 mt-2"> 
                              <label>Net Amount</label>
                              <input class="form-control" type="number" name="net_amount" id="net_amount" <?php echo $trans_net_amount ?> placeholder="Net Amount"  readonly >
                           </div>
                        </div>
                        <div class="col-sm-12">
                           <p>&nbsp;</p>
                        </div>
                        <div class="col-sm-12">
                           <br>
                           <button type="submit" class="btn btn-primary  text-white" >Add</button>
                        </div>
                  </div>
                  </form>-->
                  </div>
                     </div>
            </div>
         </div>
      </div>
      </section>
      <!-- Start Page Content -->   
      <!-- End Container fluid  -->
      <!-- footer -->
      <?php include("includes/footer.php") ?>
      <!-- End footer -->
      </div>
      <!-- End Page wrapper  -->
      </div>
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
      <script>
         $(document).ready(function (){
         
               $('#lrqty_amout').focusout(function()
           {
             var lrqty_amout = $('#lrqty_amout').val();
             if(lrqty_amout != '')
             {
                 $('#lrqty_amout').siblings('p').css('display','none');
              var lrper_amout = $('#lrper_amout').val();
              if(lrper_amout != '')
              {
                $('#lrper_amout').siblings('p').css('display','none');
                var total_amount = lrqty_amout*lrper_amout;
                var lr_tax = $('#gst_tpt').val();
                var lr_total_tax1 = total_amount*lr_tax;
                var lr_total_tax = lr_total_tax1/100;
                //$('#total_tpt_tax').val(lr_total_tax);
                $('#lr_amout').val(total_amount);
              }
              else
              {
                  var html = $('#lrper_amout').siblings('p').length;
                    if(html == '')
                    {
                $('#lrper_amout').after('<p style="color:red;">L.R. Amount (Per Parcel) required*</p>');
                    }
                    else
                    {
                        var css = $('#lrper_amout').siblings('p').css('display');
                        if(css == 'none')
                        {
                            $('#lrper_amout').siblings('p').css('display','block');
                        }
                    }
                $('#lrper_amout').focus().select();
              }
            }
            else
            {
                var lrper_amout = $('#lrper_amout').val();
              if(lrper_amout != '')
              {
                    $('#lrper_amout').siblings('p').css('display','none');
                    var html = $('#lrqty_amout').siblings('p').length;
                    if(html == '')
                    {
                        $('#lrqty_amout').after('<p style="color:red;">L.R.Qty required*</p>');
                    }
                    else
                    {
                        var css = $('#lrqty_amout').siblings('p').css('display');
                        if(css == 'none')
                        {
                            $('#lrqty_amout').siblings('p').css('display','block');
                        }
                    }
                    
                    $('#lrqty_amout').focus().select();
              }
            }
            
          });
          
          
          
           
           $('#lrper_amout').focusout(function()
           {
            var lrper_amout = $('#lrper_amout').val();
            if(lrper_amout != '')
            {
              $('#lrper_amout').siblings('p').css('display','none');
              var lrqty_amout = $('#lrqty_amout').val();
              if(lrqty_amout != '')
              {
                var total_amount = lrqty_amout*lrper_amout;
                $('#lr_amout').val(total_amount);
              }
            }
            else
            {
             var lrqty_amout = $('#lrqty_amout').val();
             if(lrqty_amout != '')
             {
                 var html = $('#lrper_amout').siblings('p').length;
                    if(html == '')
                    {
              $('#lrper_amout').after('<p style="color:red;">L.R. Amount (Per Parcel) required*</p>');
                    }
                    else
                    {
                        var css = $('#lrper_amout').siblings('p').css('display');
                        if(css == 'none')
                        {
                            $('#lrper_amout').siblings('p').css('display','block');
                        }
                    }
              $('#lrper_amout').focus().select();
            }
          }
         });
           
           $('#item_type').change(function(){
              
            var id = $(this).val();
             
            var sup_name = $('#supplier_name').find(":selected").val();
         
            var url = "<?php echo base_url('Purchase/get_itemname'); ?>";
            var post_data = {
                'id': id,
                'sup_name': sup_name,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            };
            
            $.ajax({
             url : url,
             type : 'POST',
             data: post_data,
             success : function(result)
             {
                 
                 var obj = JSON.parse(result);
                 $('#item_name').find('option').remove();
                 $('#item_name').append($('<option/>', { 
                        value: '0',
                        text : 'Select Item Name'
                    }));
                 for(var i=0;i<obj.length;i++)
                 {
         	    $('#item_name').append($('<option/>', { 
                        value: obj[i]['item_id'],
                        text : obj[i]['item_name']
                    }));
                 }
                 if(id == '3')
                 {
                      var field ='<label>Brand Name</label><select  class="form-control" name="brand_name" id="brand_name" onchange="function1(this)" placeholder="Brand Name" ><option value="">Choose Brand Name</option><?php foreach($brandDetails as $getbrandDetails){ ?><option value="<?php echo $getbrandDetails->brand_id ?>"><?php echo $getbrandDetails->brand_name  ?></option><?php } ?></select>';
            $(".appending_div").html(field);
         
         
          
                 }
                 else{
                      var field ='<label>Brand Name</label><select class="form-control" name="brand_name" id="brand_name" onchange="myFunction() placeholder="Brand Name" ><?php foreach($brandDetails as $getbrandDetails){ ?><option value="<?php echo $getbrandDetails->brand_id ?>"><?php echo $getbrandDetails->brand_name  ?></option><?php } ?></select>';
            $(".appending_div").html('');
         
                 }
             }
         
          });
          
          });
           $('#mrp').focusout(function()
           {
                var discount = $(this).val();
                 var rate =  $('#rate').val();
                //var Stock_qty = $('#Stock_qty').val();
                var billing_qty = $('#billling_qty').val();
                 var discount = $('#discount').val();
                
               
                var total_amount = rate * billing_qty;
             //alert(total_amount);
                var discount_amount = ((discount)*(1/100)) * (total_amount);
                //alert(discount_amount);
                total_amount = total_amount - discount_amount;
                $('#amount').val(total_amount);
                 var total_tax = $('#total_tax').val();
                var amount = $('#amount').val();
                
              
                
                
                  cgst =  <?php echo $cgst ?>;
                  sgst = <?php echo $sgst ?>;
                  igst = <?php echo $igst ?>;
                
                     var aftercgst = (((cgst)*(1/100)) * (total_amount)).toFixed(2);
                     var aftersgst = (((sgst)*(1/100)) * (total_amount)).toFixed(2);
                     var afterigst = (((igst)*(1/100)) * (total_amount)).toFixed(2);
                   
                    $('#total_cgst').val(aftercgst);
                    $('#total_sgst').val(aftersgst);
                    $('#total_igst').val(afterigst);
                  
                  
                  
                var total_tax_supp = parseFloat(aftercgst )+parseFloat(aftersgst)+parseFloat(afterigst);
             
                $('#total_tax').val(total_tax_supp);
              
                  var netamount =(total_amount+ total_tax_supp);
                 
                 $('#netamount').val(Math.round(netamount));
                
                  
                //$('#total_tax').val(total_tax_amount);
               /* var lr_amout = $('#lr_amout').val();
                var amount = $('#amount').val();
                
                var total_tpt_tax = $('#total_tpt_tax').val();
                var net_total = (total_tpt_tax) + (total_tax_amount) + (lr_amout) + (amount);
                $('#net_amount').val(net_total);*/
           });
           
         
          
           $('#discount').focusout(function()
           {
                var discount = $(this).val();
                 var rate =  $('#rate').val();
                //var Stock_qty = $('#Stock_qty').val();
                var billing_qty = $('#billling_qty').val();
                
               
                var total_amount = rate * billing_qty;
             //alert(total_amount);
                var discount_amount = ((discount)*(1/100)) * (total_amount);
                //alert(discount_amount);
                total_amount = total_amount - discount_amount;
                $('#amount').val(total_amount);
                 var total_tax = $('#total_tax').val();
                var amount = $('#amount').val();
                
              
                
                
                  cgst =  <?php echo $cgst ?>;
                  sgst = <?php echo $sgst ?>;
                  igst = <?php echo $igst ?>;
                
                     var aftercgst = (((cgst)*(1/100)) * (total_amount)).toFixed(2);
                     var aftersgst = (((sgst)*(1/100)) * (total_amount)).toFixed(2);
                     var afterigst = (((igst)*(1/100)) * (total_amount)).toFixed(2);
                   
                    $('#total_cgst').val(aftercgst);
                    $('#total_sgst').val(aftersgst);
                    $('#total_igst').val(afterigst);
                  
                  
                  
                var total_tax_supp = parseFloat(aftercgst) +parseFloat(aftersgst)+parseFloat(afterigst);
              //alert(total_tax_supp);
                $('#total_tax').val(total_tax_supp);
                
                  var netamount = total_amount+ total_tax_supp;
                  $('#netamount').val(Math.round(netamount));
                  
             /*   //$('#total_tax').val(total_tax_amount);
                var lr_amout = $('#lr_amout').val();
                var amount = $('#amount').val();
                var total_tpt_tax = $('#total_tpt_tax').val();
                var net_total = (total_tpt_tax) + (total_tax_amount) + (lr_amout) + (amount);
                $('#net_amount').val(net_total);*/
           });
           
            $('#transport_Name').focusout(function()
            {
                var id = $(this).val();
               
                var url = "<?php echo base_url('Purchase/get_transport_gst'); ?>";
                var post_data = {
                'id': id,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
                };
            
                $.ajax({
                url : url,
                type : 'POST',
                data: post_data,
                success : function(result)
                {
                    //$('#gst_tpt').val(obj[0]['gst']);
                    
                   var obj = JSON.parse(result);
                   
                  
                if(obj[0]['state_id'] == '21')
                {   
                  
                     $('#gst_tpt').val(obj[0]['gst']);
                     
                    
                    var gst = obj[0]['gst'] / 2;
                        $('#cgst_tpt').val(gst);
                        $('#sgst_tpt').val(gst);
                        $('#igst_tpt').val(0);
                        
                    }
                    else
                    {
                       // $('#igst_tpt').val(obj[0]['gst']);
                        $('#gst_tpt').val(obj[0]['gst']);
                        var gst1 = obj[0]['gst'];
                        $('#cgst_tpt').val(0);
                        $('#sgst_tpt').val(0);
                         $('#igst_tpt').val(gst1);
                    }
                
                    
                }
                
         
            });
               
           });
           $('#billling_qty').focusout(function()
           {
                var billing_qty = $(this).val();
                
                //var Stock_qty = $('#Stock_qty').val();
                 var no_packs = $('#no_packs').val();
                  
                 var qty_per_pack = ((billing_qty)/(no_packs)).toFixed(2);
                
                 $('#Qty_per_pack').val(qty_per_pack);
                 
           });
            $('#rate').focusout(function()
           {
                var rate = $(this).val();
                
                var cgst =  $('#total_cgst').val();
                
                 var sgst = $('#total_sgst').val();
                 var igst = $('#total_igst').val();
               
             
                //var amount = $('#amount').val();
                 //var total_tax = $('#total_tax').val();
               
              //   var netamount = (amount) + (total_tax);
                  
                // $('#netamount').val(netamount);
                   
           });
           
           $('#lrqty_amout').focusout(function()
           {
               var lrqty_amout = $(this).val();
                var cgst_tpt = $('#cgst_tpt').val();
                var sgst_tpt = $('#sgst_tpt').val();
                var igst_tpt = $('#igst_tpt').val();
                 
                 var total_tax_trans = (cgst_tpt) + (sgst_tpt)+ (igst_tpt);
                
                 $('#total_tpt_tax').val(total_tax_trans);
                var lr_amout = $('#lr_amout').val();
                 var total_tpt_tax = $('#total_tpt_tax').val();
                var net_amount = (lr_amout) + (total_tpt_tax);
                 $('#net_amount').val(net_amount);
           });
         });
         function function1(obj){
             
          //$('#brand_name').change(function(){
             //alert("ok");
              var id1 = $(obj).val();
             
            var sup_name = $('#supplier_name').find(":selected").val();
            var url = "<?php echo base_url('Purchase/get_brandname'); ?>";
             var post_data = {
                'id1': id1,
                'sup_name': sup_name,
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            };
                $.ajax({
             url : url,
             type : 'POST',
             data: post_data,
             success : function(result)
             {
                
                 var obj = JSON.parse(result);
                 $('#item_name').find('option').remove();
                 $('#item_name').append($('<option/>', { 
                        value: '0',
                        text : 'Select Item Name'
                    }));
                 for(var i=0;i<obj.length;i++)
                 {
         	    $('#item_name').append($('<option/>', { 
                        value: obj[i]['fabric_id'],
                        text : obj[i]['fabric_name']
                    }));
                 }
                
                 
             }
         
          });
              
         // });
         }
         
      </script>
   </body>
</html>