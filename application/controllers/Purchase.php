<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Purchase extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();
        $this->load->model('Purchase_model');
        $this->load->library('Encryption');
    }
    public function index()
    {
        if ($this->session->userdata['role'] == 1){
            $this->load->view('user/purchase');
         }else{
              $this->load->view('basic/login');
         }
    }
    public function transportlisting()
    {
        if ($this->session->userdata['role'] == 1){
            $this->load->view('user/transportlisting');
         }else{
              $this->load->view('basic/login');
         }
    }
    public function add_purchase()
    {
        if ($this->session->userdata['role'] == 1){
            
            $this->load->view('user/add_purchase',['inward_no'=>'']);
         }else{
              $this->load->view('basic/login');
         }
       
    }
    
    public function add_transport()
    {
        if ($this->session->userdata['role'] == 1){
            
            $this->load->view('user/add_transport',['inward_no'=>'']);
         }else{
              $this->load->view('basic/login');
         }
       
    }
    
    
   
    public function save_purchase_supplier_data()
    {
        $companyname = $this->input->post('company_name');
        if($companyname == 'supereditors'){
            $max = $this->Purchase_model->get_super_maxid();
            $maxid = count($max)+1;
            $inward_no = 'SE'.date('Y').'/'.sprintf("%05d", $maxid);
        }else if ($companyname == 'mannasmenswear'){
           $max = $this->Purchase_model->get_manna_maxid();
            $maxid = count($max)+1;
            $inward_no = 'MN'.date('Y').'/'.sprintf("%05d", $maxid); 
        }
         $data1 = array( 
                "inward_no" => $inward_no,
                 "supplier_id" => $this->input->post('supplier_name'),
                  "company_name" => $this->input->post('company_name'),
               "showroom_name" => $this->input->post('showroom_name'),
                "challan_no" => $this->input->post('challan_number'),
               
              
                "is_active" => 1,
                "created_by" => $this->session->userdata['user_id'],
                "created_date" => date("Y-m-d")
                
                
                 );
                 
                 
           
             $this->load->model('Purchase_model');
             
             
             $purchase_supplier_id =  $this->input->post('purchase_supplier_id'); 
         $response1 = $this->Purchase_model->save_perchase_supplier_data1($data1);
          //$response2 = $this->Purchase_model->save_perchase_data2($data2);
        //$response = $this->Purchase_model->save_perchase_data($data);
         $item_type_id = $this->db->insert_id();
        if ($response1 == true)
            {
              //echo"ok";
               $purchase_supplier_id = $this->db->insert_id();
                 $this->session->set_flashdata('purchase_message', 'Purcahse Data Saved Successfully with Inward#: '.$inward_no);
                redirect('Purchase/add_purchase?purchase_supplier_id='. $purchase_supplier_id);
            }
            else
            {
                echo "Insert error !";
            }
}
 public function save_purchase_item_data()
    {
        
        //print_r($_POST);
         $data = array(
         "purchase_supplier_id" => $this->input->post('purchase_supplier_id') ,
          "item_type_id" =>$this->input->post('item_type'),
                "brand_id" =>$this->input->post('brand_name'),
               "item_id" => $this->input->post('item_name'),
                "measure_id" => $this->input->post('size'),
                "shade_no"=>$this->input->post('shade_no'),
                "no_of_packs" => $this->input->post('no_packs'),
                
                "stock_quntitiy" =>$this->input->post('Stock_qty'),
                "billing_quntity" =>$this->input->post('billing_qty'),
                
                "quantitiy_per_pack" => $this->input->post('Qty_per_pack'),
               
                "rate" =>$this->input->post('rate'),
                "mrp" => $this->input->post('mrp'),
                 "discount" => $this->input->post('discount'),
                "amount" =>$this->input->post('amount'),
                
                "tax_per" =>$this->input->post('tax_per'),
                 "igst" =>$this->input->post('total_igst'),
               "cgst" => $this->input->post('total_cgst'),
               "sgst" =>$this->input->post('total_sgst'),
                "total_tax" => $this->input->post('total_tax'),
                 "netamount" => $this->input->post('netamount'),
                 "is_active" => 1,
               "created_by" => $this->session->userdata['user_id'],
               "created_date" => date("Y-m-d")
                 );
                 $this->load->model('Purchase_model');
                 $response = $this->Purchase_model->save_purchase_item_data($data);
                  if ($response == true)
            {
                
                 $purchase_item_id = $this->db->insert_id();
                 //print_r($purchase_item_id);
               
               $no_of_packs = $this->input->post('no_packs');
            	//print_r($no_of_packs);
            	
            	for($i=1;$i<=$no_of_packs;$i++){
            	      $maxid = $this->db->query("SELECT * FROM barcodes");

        $getmaxid = $maxid->num_rows() + 1;
        /*$barcode = str_pad($getmaxid,10,'0',STR_PAD_LEFT);*/
        $barcode = $getmaxid;
            	    $data = array(
        "purchase_item_id" => $purchase_item_id ,
         "purchase_supplier_id" => $this->input->post('purchase_supplier_id') ,
          "barcode" =>$barcode,
          "amount_per_pack" => ((($this->input->post('mrp') * $this->input->post('billing_qty'))) / $no_of_packs),
          "purchased_amount_per_pack" => ((($this->input->post('rate') * $this->input->post('billing_qty'))) / $no_of_packs),
          "stock_quantity" => ($this->input->post('Stock_qty') / $no_of_packs),
          "rate" => ($this->input->post('rate') / $no_of_packs),
          "mrp" => ($this->input->post('mrp') / $no_of_packs),
         "is_active" => 1,
        "created_by" => $this->session->userdata['user_id'],
               "created_date" => date("Y-m-d")
                 );
                  $this->load->model('Purchase_model');
                 $response = $this->Purchase_model->save_barcode_data($data);
                 
                 
            	}
            	 if ($response == true)
            {
                //echo"ok";
               $purchase_supplier_id = $this
                    ->input
                    ->post('purchase_supplier_id');
                 $this->session->set_flashdata('purchase_message1', 'Purcahse Data Saved Successfully');
             redirect('Purchase/add_purchase?purchase_supplier_id='. $purchase_supplier_id );
            }
            else
            {
                echo "Insert error !";
            }
            
            }
            else
            {
                echo "Insert error !";
            }
           
    }

public function save_purchase_transport_data(){
    //print_r($_POST);
     $data2 = array("purchase_supplier_id" => $this->input->post('purchase_supplier_id'),
         "transport_id" => $this->input->post('transport_Name'),
               "transport_date" => $this->input->post('lr_date'),
               
               "lr_no" => $this->input->post('lr_no'),
               "lrper_amout" => $this->input->post('lrper_amout'),
               "lr_qty" => $this->input->post('lrqty_amout'),
               "lr_amount" => $this->input->post('lr_amout'),
               "pick_up_location" => $this->input->post('pick_up_location'),
                "gst_tpt" => $this->input->post('gst_tpt'),
                  "igst_tpt" => $this->input->post('igst_tpt'),
               "cgst_tpt" => $this->input->post('cgst_tpt'),
               "sgst_tpt" => $this->input->post('sgst_tpt'),
                "total_tpt_tax" => $this->input->post('total_tpt_tax'),
                "Received_by" => $this->input->post('Received_by'),
               "net_amount" => $this->input->post('net_amount'),
                 "is_active" => 1,
               "created_by" => $this->session->userdata['user_id'],
               "created_date" => date("Y-m-d")
                 );
                 
             $purchase_supplier_id =  $this->input->post('purchase_supplier_id'); 
                    $this->load->model('Purchase_model');
                 $response2 = $this->Purchase_model->save_purchase_transport_data($data2);
                   if ($response2 == true)
            {
              
               $purchase_supplier_id = $this
                    ->input
                    ->post('purchase_supplier_id');
                 $this->session->set_flashdata('purchase_message2', 'Purcahse Data Saved Successfully');
               redirect('Purchase/transportlisting');
            }
            else
            {
                echo "Insert error !";
            }
            
}
    
    

public function edit_purchase(){
   // print_r($_POST);
    $editid = $this->input->post('edit_id');   
    
     $data = array("total_amt_paid" => $this->input->post('amount_edit_name'),
     "total_tds_ded" => $this->input->post('total_tds_ded'),
      "total_other_ded" => $this->input->post('total_other_ded'),
      
       "total_adv_adj" => $this->input->post('adv_adj_edit'),
      "payment_mode" => $this->input->post('payment_mode_edit'),
     
      "cheq_no" => $this->input->post('cheq_no_edit'),
      "bank_details" => $this->input->post('bank_details_edit'),
      "dated" => $this->input->post('Dated_edit'),
      "pay_paid_by" => $this->input->post('pay_paid_edit'),
      "balace" => $this->input->post('balance_edit'),
     );
    
    
      $this->load->model('Purchase_model');
      
       $response = $this->Purchase_model->edit_data($data,$editid);
        $response1 = $this->Purchase_model->edit_data1($data,$editid);
         if ($response == true)
            {
              //echo"ok1";
                 $this->session->set_flashdata('purchase_message', 'Purchase data  updated Successfully');
                 redirect('Payment_Paid_Entry');
               
            }
            else
            {
                echo "Insert error !";
            }
}

public function delete_item_data(){
   
     $purchase_supplier_id = $this->input->get('purchase_supplier_id');
       $purchase_item_id = $this->input->get('purchase_item_id');
       //print_r($purchase_item_id);
      $data = [
            'is_active' => '0'
        ];
     $this->load->model('Purchase_model');
         $response = $this->Purchase_model->delete_item_data($data,$purchase_item_id);
         if($response == true){ 
            
            $this->session->set_flashdata('purchase_delete_item_messege', 'Purchase Data Deleted Successfully');
          
           redirect('Purchase/add_purchase?purchase_supplier_id='. $purchase_supplier_id );
         
               
       }
}

public function edit_item_data(){
    if ($this->session->userdata['role'] == 1){
            $this->load->view('user/edit_item_purchase');
         }else{
              $this->load->view('basic/login');
         }
}
public function edit_purchase_item_data(){
   //print_r($_POST);
    $data = array(
               "measure_id" => $this->input->post('size'),
                "shade_no"=>$this->input->post('shade_no'),
                "no_of_packs" => $this->input->post('no_packs'),
                
                "stock_quntitiy" =>$this->input->post('Stock_qty'),
                "billing_quntity" =>$this->input->post('billing_qty'),
                
                "quantitiy_per_pack" => $this->input->post('Qty_per_pack'),
               
                "rate" =>$this->input->post('rate'),
                "mrp" => $this->input->post('mrp'),
                 "discount" => $this->input->post('discount'),
                "amount" =>$this->input->post('amount'),
                
                "tax_per" =>$this->input->post('tax_per'),
                 "igst" =>$this->input->post('total_igst'),
               "cgst" => $this->input->post('total_cgst'),
               "sgst" =>$this->input->post('total_sgst'),
                "total_tax" => $this->input->post('total_tax'),
                 "netamount" => $this->input->post('netamount'),
                  "updated_by" =>  $this->session->userdata['user_id'],
                 "updated_date" => date("Y-m-d")
                 );
                 
  
     $purchase_item_id = $this->input->post('purchase_item_id');
      $this->load->model('Purchase_model');
     $response = $this->Purchase_model->edit_item_purchase_data($data,$purchase_item_id);
     
      if ($response == true)
            {               
               $purchase_supplier_id = $this->input->post('purchase_supplier_id');
                 $this->session->set_flashdata('purchase_message', 'Purcahse Data Eddited Successfully');
                  redirect('Purchase/add_purchase?purchase_supplier_id=' . $purchase_supplier_id);
               
            }
            else
            {
                echo "Insert error !";
            }
     
}
public function item_barcode()
{
    if ($this->session->userdata['role'] == 1){
            
            $this->load->view('user/barcodes');
         }else{
              $this->load->view('basic/login');
         }
}
    public  function delte_perchase_data(){
    
    $perchaseid=$this->input->get('purchase_item_entry_id');   
    //print_r($perchaseid);
     
          $data = [
            'is_active' => '0'
        ];
     $this->load->model('Purchase_model');
     
     $response = $this->Purchase_model->delete_purchase_data($data,$perchaseid);
     
          
       if($response == true){
          
        $this->session->set_flashdata('purchase_message', 'Purchase data Deleted Successfully');
         redirect('Purchase');
               
       }
      
    }
    public function get_edit_gst()
    {
      $supplier_id = $this->security->xss_clean(htmlspecialchars(strip_tags($this->input->post('supplier_id'))));  
      
       $gst = $this->Purchase_model->get_edit_gst($supplier_id);
        $result = $gst;
        echo json_encode($result);
    }
    public function get_itemname()
    {
        $id = $this->security->xss_clean(htmlspecialchars(strip_tags($this->input->post('id'))));
        $item_name = $this->Purchase_model->get_itemname($id);
        $result = $item_name;
        echo json_encode($result);
    }
    public function get_brandname(){
         $id1 = $this->security->xss_clean(htmlspecialchars(strip_tags($this->input->post('id1'))));
        $brand_name = $this->Purchase_model->get_brandname($id1);
        $result = $brand_name;
        echo json_encode($result);
    }
    public function get_gst()
    {
        $id = $this->security->xss_clean(htmlspecialchars(strip_tags($this->input->post('id'))));
        $sup_name = $this->security->xss_clean(htmlspecialchars(strip_tags($this->input->post('sup_name'))));
        $gst = $this->Purchase_model->get_gst($sup_name);
        $gst_val = $this->Purchase_model->get_gstval($id);
        $result[] = $gst[0]['state_id'];
        $result[] = $gst_val[0];
        echo json_encode($result);
    }
    public function get_transport_gst()
    {
        $id = $this->security->xss_clean(htmlspecialchars(strip_tags($this->input->post('id'))));
        $transport_data = $this->Purchase_model->get_transport_data($id);
        echo json_encode($transport_data);
    }
}
?>