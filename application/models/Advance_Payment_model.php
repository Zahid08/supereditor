<?php
class Advance_Payment_model extends CI_Model 
{
	
	 function save_payment_data($data)
	{
	   $this->db->insert('advance_payment_entry',$data);
	   return true;
	}
	function get_voucher_maxid()
   {
       	$this->db->select('*');
        $this->db->from('advance_payment_entry');
        $query = $this->db->get();
        
        if( $query->num_rows() > 0 )
        {
            return $query->num_rows();
        }
        else
        {
            return false;
        }
   }
}

?>