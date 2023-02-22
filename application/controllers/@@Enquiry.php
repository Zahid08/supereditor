<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Enquiry extends CI_Controller
{

    public function index()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
            $this
                ->load
                ->view('user/enquiry');
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }
   
    public function enquirylist()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
            $this
                ->load
                ->view('user/enquirylist');
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }
    public function appointmentlist()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
            $this
                ->load
                ->view('user/appointment');
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }
    public function save_enquiry_data()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
            $data = array(
                "name" => $this
                    ->input
                    ->post('party_name') ,
                "type" => $this
                    ->input
                    ->post('party_type') ,
                "month" => $this
                    ->input
                    ->post('enquiry_opening_month') ,
                "is_existing_customer" => $this
                    ->input
                    ->post('is_existing_customer') ,
                "created_datetime" => date('Y-m-d H:i:s') ,
                "created_by" => $this
                    ->session
                    ->userdata['user_id']
            );

            $this
                ->load
                ->model('Enquiry_model');

            $response = $this
                ->Enquiry_model
                ->save_enquiry_data($data);

            if ($response == true)
            {

                $enquiryid = $this
                    ->db
                    ->insert_id();

                $this
                    ->session
                    ->set_flashdata('enquiry_message', 'Enquiry Data Saved Successfully');
                redirect('enquiry?enquiry_id=' . $enquiryid . '&#enquiry_section');
            }
            else
            {
                echo "Insert error !";
            }
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }
    

    public function save_address_data()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {

            $data = array(
                "enquiry_id" => $this
                    ->input
                    ->post('enquiry_id') ,
                "address_type" => $this
                    ->input
                    ->post('address_type') ,
                "address_line_1" => $this
                    ->input
                    ->post('address_line_1') ,
                "address_line_2" => $this
                    ->input
                    ->post('address_line_2') ,
                "country" => $this
                    ->input
                    ->post('country') ,
                "state" => $this
                    ->input
                    ->post('state') ,
                "city" => $this
                    ->input
                    ->post('city') ,
                "street" => $this
                    ->input
                    ->post('street') ,
                "pincode" => $this
                    ->input
                    ->post('pincode') ,
                "created_datetime" => date('Y-m-d H:i:s') ,
                "created_by" => $this
                    ->session
                    ->userdata['user_id']
            );

            $this
                ->load
                ->model('Enquiry_model');

            $response = $this
                ->Enquiry_model
                ->save_address_data($data);

            if ($response == true)
            {
                $enquiryid = $this
                    ->input
                    ->post('enquiry_id');

                $this
                    ->session
                    ->set_flashdata('address_message', 'Address Data Saved Successfully');
                redirect('enquiry?enquiry_id=' . $enquiryid . '&#address_section');
            }
            else
            {
                echo "Insert error !";
            }
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }
    public function save_contact_data()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
            $data = array(
                "enquiry_id" => $this
                    ->input
                    ->post('enquiry_id') ,
                "name" => $this
                    ->input
                    ->post('name') ,
                "designation" => $this
                    ->input
                    ->post('designation') ,
                "mobile_no" => $this
                    ->input
                    ->post('mobile_no') ,
                "landline" => $this
                    ->input
                    ->post('landline') ,
                "email" => $this
                    ->input
                    ->post('email') ,
                "dob" => $this
                    ->input
                    ->post('dob') ,
                "marriage_anniversary_date" => $this
                    ->input
                    ->post('marriage_anniversary_date') ,
                "created_datetime" => date('Y-m-d H:i:s') ,
                "created_by" => $this
                    ->session
                    ->userdata['user_id']
            );

            $this
                ->load
                ->model('Enquiry_model');

            $response = $this
                ->Enquiry_model
                ->save_contact_data($data);

            if ($response == true)
            {
                $enquiryid = $this
                    ->input
                    ->post('enquiry_id');

                $this
                    ->session
                    ->set_flashdata('contact_message', 'Contact Data Saved Successfully');
                redirect('enquiry?enquiry_id=' . $enquiryid . '&#contact_section');
            }
            else
            {
                echo "Insert error !";
            }
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }
    public function save_owner_data()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
            $data = array(
                "enquiry_id" => $this
                    ->input
                    ->post('enquiry_id') ,
                "name" => $this
                    ->input
                    ->post('name') ,
                "mobile_no" => $this
                    ->input
                    ->post('mobile_no') ,
                "landline" => $this
                    ->input
                    ->post('landline') ,
                "email" => $this
                    ->input
                    ->post('email') ,
                "dob" => $this
                    ->input
                    ->post('dob') ,
                "marriage_anniversary_date" => $this
                    ->input
                    ->post('marriage_anniversary_date') ,
                "created_datetime" => date('Y-m-d H:i:s') ,
                "created_by" => $this
                    ->session
                    ->userdata['user_id']
            );

            $this
                ->load
                ->model('Enquiry_model');

            $response = $this
                ->Enquiry_model
                ->save_owner_data($data);

            if ($response == true)
            {
                $enquiryid = $this
                    ->input
                    ->post('enquiry_id');

                $this
                    ->session
                    ->set_flashdata('owner_message', 'Owner Data Saved Successfully');
                redirect('enquiry?enquiry_id=' . $enquiryid . '&#owner_section');
            }
            else
            {
                echo "Insert error !";
            }
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }
    public function save_item_data()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
            $data = array(
                "enquiry_id" => $this
                    ->input
                    ->post('enquiry_id') ,
                "name" => $this
                    ->input
                    ->post('name') ,
                "approximate_value" => $this
                    ->input
                    ->post('approximate_value') ,
                "approximate_quantity" => $this
                    ->input
                    ->post('approximate_quantity') ,
                "created_datetime" => date('Y-m-d H:i:s') ,
                "created_by" => $this
                    ->session
                    ->userdata['user_id']
            );

            $this
                ->load
                ->model('Enquiry_model');

            $response = $this
                ->Enquiry_model
                ->save_item_data($data);

            if ($response == true)
            {
                $enquiryid = $this
                    ->input
                    ->post('enquiry_id');

                $this
                    ->session
                    ->set_flashdata('item_message', 'Item Data Saved Successfully');
                redirect('enquiry?enquiry_id=' . $enquiryid . '&#item_section');
            }
            else
            {
                echo "Insert error !";
            }
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }
    public function save_remark_data()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
            $data = array(
                "enquiry_id" => $this
                    ->input
                    ->post('enquiry_id') ,
                "remark" => $this
                    ->input
                    ->post('remark') ,
                "created_datetime" => date('Y-m-d H:i:s') ,
                "created_by" => $this
                    ->session
                    ->userdata['user_id']
            );

            $this
                ->load
                ->model('Enquiry_model');

            $response = $this
                ->Enquiry_model
                ->save_remark_data($data);

            if ($response == true)
            {
                $enquiryid = $this
                    ->input
                    ->post('enquiry_id');

                $this
                    ->session
                    ->set_flashdata('remark_message', 'Remark Data Saved Successfully');
                redirect('enquiry?enquiry_id=' . $enquiryid . '&#remarks_section');
            }
            else
            {
                echo "Insert error !";
            }
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }
    public function save_appointment_data()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
            $data = array(
                "enquiry_id" => $this
                    ->input
                    ->post('enquiry_id') ,
                "date" => $this
                    ->input
                    ->post('date') ,
                "time" => $this
                    ->input
                    ->post('time') ,
                "mail_to" => $this
                    ->input
                    ->post('mail_to') ,
                "sms_to" => $this
                    ->input
                    ->post('sms_to') ,
                "created_datetime" => date('Y-m-d H:i:s') ,
                "created_by" => $this
                    ->session
                    ->userdata['user_id']
            );

            $this
                ->load
                ->model('Enquiry_model');

            $response = $this
                ->Enquiry_model
                ->save_appointment_data($data);

            if ($response == true)
            {

                $aptid = $this
                    ->db
                    ->insert_id();
                $date = date_format(date_create($this
                    ->input
                    ->post('date')) , "d-m-Y");
                $time = date_format(date_create($this
                    ->input
                    ->post('time')) , "h:i a");
                    
                

                //send mail --start
                //Load email library
                        $this->load->library('email');
                
                //SMTP & mail configuration
                        $config = array(
                            'protocol'  => 'smtp',
                            'smtp_host' => 'smtp.mailgun.org',
                            'smtp_port' => 587,
                            'smtp_user' => 'postmaster@supereditors.in',
                            'smtp_pass' => 'db96c0db1b5d97134e8ef7bf629987ae-156db0f1-549f6847',
                            'mailtype'  => 'html',
                            'charset'   => 'iso-8859-1'
                        );
                        $this->email->initialize($config);
                        $this->email->set_mailtype("html");
                        $this->email->set_newline("\r\n");
                

                $this
                    ->email
                    ->set_mailtype('html');

                $message = "<html>
			                    <p>Your Appointment has been Scheduled on $date $time </p>
			                    <p>Please <a href='" . base_url() . "Enquiry/confirm_appointment?aptid=$aptid'>Click Here</a> to Confirm.</p>
			                    <br>
			                    
			                    <p>Thanks and Regards,</p>
			                    <p>SUPEREDITORS</p>
			                    <p>" . base_url() . "</p>
			                </html>";

                $this
                    ->email
                    ->from('admin@supereditors.in', 'SUPEREDITORS');
                $this
                    ->email
                    ->to($this
                    ->input
                    ->post('mail_to'));
                $this
                    ->email
                    ->cc('info@supereditors.in');
                $this
                    ->email
                    ->bcc('iambommanakavya@gmail.com');

                $this
                    ->email
                    ->subject('Appointment Scheduled');
                $this
                    ->email
                    ->message($message);

                //Send email
                        if($this->email->send())
                        /*echo 'sent';
                        else
                        echo 'fail';
                        echo $this->email->print_debugger();*/
                       // exit;

                //send mail --end
                
                

                //send sms -- start
                $this->ci = & get_instance();
                $this->username = "supereditors";
                $this->password = "Super!@12";
                $this->senderID = "CVDEMO";

                $to = '8096773208';
                $smsmessage = 'Your Appointment has been Scheduled. Please check your Mail and Confirm';
                $schedule = null;

                $url = "https://www.smsalert.co.in/api/push.json?user=$this->username&pwd=$this->password&sender=$this->senderID&mobileno=$to&text=$smsmessage";
                if ($schedule != null)
                {
                    $url .= "&schedule=$schedule";
                }

                $curl = curl_init();
                $message = urlencode($message);
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                ));

                $result = curl_exec($curl);
                $err = curl_error($curl);
                $data = json_decode($result, true);
                curl_close($curl);

                if ($err)
                {
                    return "cURL Error #:" . $err;
                }
                else
                {
                    if ($data['status'] == 'success')
                    {

                        return $data['description']['desc'];
                    }
                }

                //send sms --end
                

                $enquiryid = $this
                    ->input
                    ->post('enquiry_id');

                $this
                    ->session
                    ->set_flashdata('appointment_message', 'Appointment Data Saved Successfully');
                redirect('enquiry?enquiry_id=' . $enquiryid . '&#appointment_section');
            }
            else
            {
                echo "Insert error !";
            }
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }
    public function confirm_appointment()
    {
        $data = array(
            'isaccepted' => 1
        );
        $appointmentID = $this
            ->input
            ->get('aptid');

        $this
            ->load
            ->model('Enquiry_model');

        $response = $this
            ->Enquiry_model
            ->confirm_appointment($appointmentID, $data);

        if ($response == true)
        {

            echo "You have Confirmed the Appointment. Our Team will contact you soon.";
        }
        else
        {
            echo "Update error !";
        }
    }

    public function save_quotation_data()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {

            $enquiryid = $this
                ->input
                ->post('enquiry_id');

            //upload to a Folder
            $config['upload_path'] = 'assets/client_asstes/quotations';
            $config['allowed_types'] = 'jpg|png|pdf|jpeg';

            $this
                ->load
                ->library('upload', $config);

            if (!$this
                ->upload
                ->do_upload('attachment'))
            {
                $error = array(
                    'error' => $this
                        ->upload
                        ->display_errors()
                );
                print_r($error);
            }
            else
            {
                $data = array(
                    'upload_data' => $this
                        ->upload
                        ->data()
                );
                $fileName = $data[upload_data][file_name];
                
            }
            //upload to a Folder
            //send mail --start
            //Load email library
                        $this->load->library('email');
                
                //SMTP & mail configuration
                        $config = array(
                            'protocol'  => 'smtp',
                            'smtp_host' => 'smtp.mailgun.org',
                            'smtp_port' => 587,
                            'smtp_user' => 'postmaster@supereditors.in',
                            'smtp_pass' => 'db96c0db1b5d97134e8ef7bf629987ae-156db0f1-549f6847',
                            'mailtype'  => 'html',
                            'charset'   => 'iso-8859-1',
                            'wordWrap' => true
                        );
                        
                        $this->email->initialize($config);
                        $this->email->set_mailtype("html");
                        $this->email->set_newline("\r\n");
            // Recipient
            $to = $this
                ->input
                ->post('mail_to') . ',iambommanakavya@gmail.com';

            

           

            // Attachment file
            $file = "assets/client_asstes/quotations/" . $fileName;
         
            // Email body content
            $htmlContent = $this
                ->input
                ->post('quotation_msg');;
            $htmlContent .= "<p>Please <a href='".base_url().$file."'>Click Here</a> to see Quotaion</p>";
            
                $this->email->from('admin@supereditors.in', 'SUPEREDITORS');
                $this->email->to($to);
                $this->email->cc('info@supereditors.in');
                $this->email->bcc('iambommanakavya@gmail.com');

                $this->email->subject('Quotation');
                $this->email->message($htmlContent);
                 $this->email->attach('https://soft.supereditors.in/assets/client_asstes/quotations/'.$fileName);
            if ($this->email->send())
            {
            

                $data = array(
                    "enquiry_id" => $this
                        ->input
                        ->post('enquiry_id') ,
                    "quotation_msg" => $this
                        ->input
                        ->post('quotation_msg') ,
                    "attachment" => $fileName,
                    "mail_to" => $this
                        ->input
                        ->post('mail_to') ,
                    "created_datetime" => date('Y-m-d H:i:s') ,
                    "created_by" => $this
                        ->session
                        ->userdata['user_id']
                );

                $this
                    ->load
                    ->model('Enquiry_model');

                $response = $this
                    ->Enquiry_model
                    ->save_quotation_data($data);

                if ($response == true)
                {
                    //send mail --end
                    $this
                        ->session
                        ->set_flashdata('quotation_message', 'Quotation Data Saved Successfully');
                    redirect('enquiry?enquiry_id=' . $enquiryid . '&#quotation_section');

                }
                else
                {
                    echo "Insert error !";
                }

            }

        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }

    public function send_wishes()
    {
        //send mail --start
        $wishData = $this
            ->db
            ->query("SELECT * FROM MDV_Wish_Data WHERE (MONTH(dob) = MONTH(CURRENT_DATE()) AND DAY(dob) = DAY(CURRENT_DATE())) OR (MONTH(marriage_anniversary_date) = MONTH(CURRENT_DATE()) AND DAY(marriage_anniversary_date) = DAY(CURRENT_DATE()))")
            ->result();
        if (count($wishData) > 0)
        {

            foreach ($wishData as $getwishData)
            {
                 //Load email library
                        $this->load->library('email');
                
                //SMTP & mail configuration
                        $config = array(
                            'protocol'  => 'smtp',
                            'smtp_host' => 'smtp.mailgun.org',
                            'smtp_port' => 587,
                            'smtp_user' => 'postmaster@supereditors.in',
                            'smtp_pass' => 'db96c0db1b5d97134e8ef7bf629987ae-156db0f1-549f6847',
                            'mailtype'  => 'html',
                            'charset'   => 'iso-8859-1'
                        );
                        $this->email->initialize($config);
                        $this->email->set_mailtype("html");
                        $this->email->set_newline("\r\n");
                $this
                    ->email
                    ->set_mailtype('html');
                if ($getwishData->wish == 'Happy Birthday')
                {
                    $message = "<html>
			                    <p>Dear $getwishData->name,</p>
			                    <p>God is mighty always been connecter of good and beautiful souls! Congratulations to you on your wedding day.</p>
			                    <br>
			                    
			                    <p>Warm Regards ,</p>
			                    <p>SUPEREDITORS</p>
			                    <p>" . base_url() . "</p>
			                </html>";
                }
                else if ($getwishData->wish == 'Happy Marriage Anniversary')
                {
                    $message = "<html>
			                    <p>Dear $getwishData->name,</p>
			                    <p>Super Editors Wishes you a very Happy B'day!!! 
                                If wisdom and experience were wealth, you were one of the richest people we ever met. People like you inspire us long after they leave. Wish you a very happy birthday.</p>
			                    <br>
			                    
			                    <p>Warm Regards ,</p>
			                    <p>SUPEREDITORS</p>
			                    <p>" . base_url() . "</p>
			                </html>";
                }
                else if ($getwishData->wish == 'Happy Birthday and Happy Marriage Anniversary')
                {
                    $message = "<html>
			                    <p>Dear $getwishData->name,</p>
			                    <p>Super Editors Wishes you a very Happy B'day and Happy Marriage Anniversary!!! 
                                If wisdom and experience were wealth, you were one of the richest people we ever met. People like you inspire us long after they leave. Wish you a very happy birthday.</p>
			                    <br>
			                    
			                    <p>Warm Regards ,</p>
			                    <p>SUPEREDITORS</p>
			                    <p>" . base_url() . "</p>
			                </html>";
                }

                $this
                    ->email
                    ->from('admin@supereditors.in', 'SUPEREDITORS');
                $this
                    ->email
                    ->to($getwishData->email);
                $this
                    ->email
                    ->cc('info@supereditors.in');
                $this
                    ->email
                    ->bcc('iambommanakavya@gmail.com');

                $this
                    ->email
                    ->subject('Wishes from SUPEREDITORS');
                $this
                    ->email
                    ->message($message);

                $this
                    ->email
                    ->send();
                //send mail --end
                

                //send sms -- start
                $this->ci = & get_instance();
                $this->username = "supereditors";
                $this->password = "Super!@12";
                $this->senderID = "CVDEMO";

                $to = $getwishData->mobile_no;
                $smsmessage = 'Dear ' . $getwishData->name . ' SUPEREDITORS Wishing you ' . $getwishData->wish;
                $schedule = null;

                $url = "https://www.smsalert.co.in/api/push.json?user=$this->username&pwd=$this->password&sender=$this->senderID&mobileno=$to&text=$smsmessage";
                if ($schedule != null)
                {
                    $url .= "&schedule=$schedule";
                }

                $curl = curl_init();
                $message = urlencode($message);
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                ));

                $result = curl_exec($curl);
                $err = curl_error($curl);
                $data = json_decode($result, true);
                curl_close($curl);

                if ($err)
                {
                    return "cURL Error #:" . $err;
                }
                else
                {
                    if ($data['status'] == 'success')
                    {

                        return $data['description']['desc'];
                    }
                }

                //send sms --end
                
            }
            echo "Wishes Sent";
        }
        else
        {
            echo "No Wishes";
        }

    }
    
    public function quotation()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
            $this
                ->load
                ->view('user/quotation');
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }
    
    public function save_quotation_heading_data()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
            
         
            
            $data = array(
                "unique_id" => 'SE'.rand(1000,9999).rand(10,99), 
                "to_email" => $this
                    ->input
                    ->post('to_email'), 
                "company" => $this
                    ->input
                    ->post('company'), 
                "heading_text" => $this
                    ->input
                    ->post('heading'), 
                    "address_type" => $this
                    ->input
                    ->post('address_type'), 
                "enquiry_id" => $this->input->post('enquiry_id'),
                
                
                
                "created_datetime" => date('Y-m-d H:i:s') ,
                "created_by" => $this
                    ->session
                    ->userdata['user_id']
            );

            $this
                ->load
                ->model('Enquiry_model');

            $response = $this
                ->Enquiry_model
                ->save_quotation_heading_data($data);

            if ($response == true)
            {

                $enquiryid = $this->input->post('enquiry_id');
                $header_id = $this->db->insert_id();
                $this
                    ->session
                    ->set_flashdata('quotation_heading_message', 'Heading Data Saved Successfully');
                redirect(base_url().'Enquiry/quotation?enquiry_id=' . $enquiryid.'&header_id='.$header_id.'&#quotationheadingform');
            }
            else
            {
                echo "Insert error !";
            }
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }

     public function save_quotation_heading_details_data()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
            $data = array(
                
                "enquiry_id" => $this->input->post('enquiry_id'),
                "heading_id" => $this->input->post('heading_id'),
                
                "moq" => $this->input->post('moq'),
                "gst" => $this->input->post('gst'),
                "delivery_period" => $this->input->post('delivery_period'),
                "delivery_charges" => $this->input->post('delivery_charges'),
                "payment_terms" => $this->input->post('payment_terms'),
                "sampling" => $this->input->post('sampling'),
                "extra_text" => $this->input->post('extra_text'),
                "remark" => $this->input->post('remark'),
                
                "created_datetime" => date('Y-m-d H:i:s') ,
                "created_by" => $this
                    ->session
                    ->userdata['user_id']
            );
            
            $enquiryid = $this->input->post('enquiry_id');
            $headingid = $this->input->post('heading_id');

            $this
                ->load
                ->model('Enquiry_model');

            $response = $this
                ->Enquiry_model
                ->save_quotation_heading_details_data($data,$enquiryid,$headingid);

            if ($response == true)
            {

                $enquiryid = $this->input->post('enquiry_id');
                $headingid = $this->input->post('heading_id');

                $this
                    ->session
                    ->set_flashdata('quotation_heading_details_message', 'Data Saved Successfully');
                redirect(base_url().'Enquiry/quotation?enquiry_id=' . $enquiryid.'&header_id='.$headingid.'&#enquiry_details_section');
            }
            else
            {
                echo "Insert error !";
            }
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }

    public function save_quotation_item_data()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
            $data = array(
                "item_name" => $this->input->post('name'), 
                "quantity" => $this->input->post('quantity'), 
                "unit" => $this->input->post('unit'), 
                "rate" => $this->input->post('rate'), 
                "description" => $this->input->post('description'), 
                "enquiry_id" => $this->input->post('enquiry_id'),
                "heading_id" => $this->input->post('heading_id'),
                "created_datetime" => date('Y-m-d H:i:s') ,
                "created_by" => $this
                    ->session
                    ->userdata['user_id']
            );

            $this
                ->load
                ->model('Enquiry_model');

            $response = $this
                ->Enquiry_model
                ->save_quotation_item_data($data);

            if ($response == true)
            {
                $heading_id = $this->input->post('heading_id');
                $enquiryid = $this->input->post('enquiry_id');

                $this
                    ->session
                    ->set_flashdata('quotation_item_message', 'Item Data Saved Successfully');
                redirect(base_url().'Enquiry/quotation?enquiry_id=' . $enquiryid.'&header_id='.$heading_id.'&#quotation_item_details');
            }
            else
            {
                echo "Insert error !";
            }
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }
    
    
    public function delete_quotation_item_data()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
            $quotation_item_id = $_GET['quotation_item_id'];
            $enquiryid = $_GET['enquiry_id'];
            $heading_id = $_GET['heading_id'];

            $this
                ->load
                ->model('Enquiry_model');

            $response = $this
                ->Enquiry_model
                ->delete_quotation_item_data($quotation_item_id,$enquiryid);

            if ($response == true)
            {

                $this
                    ->session
                    ->set_flashdata('quotation_del_item_message', 'Deleted Successfully');
                redirect(base_url().'Enquiry/quotation?enquiry_id=' . $enquiryid.'&header_id='.$heading_id.'&#quotation_item_details');
            }
            else
            {
                echo "Delete error !";
            }
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }
  
  
  public function delete_quotation_address_data()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
            $quotation_address_id = $_GET['quotation_address_id'];
            $enquiryid = $_GET['enquiry_id'];

            $this
                ->load
                ->model('Enquiry_model');

            $response = $this
                ->Enquiry_model
                ->delete_quotation_address_data($quotation_address_id,$enquiryid);

            if ($response == true)
            {

                $this
                    ->session
                    ->set_flashdata('quotation_del_address_message', 'Deleted Successfully');
                redirect(base_url().'Enquiry/?enquiry_id=' . $enquiryid.'&#address_section');
            }
            else
            {
                echo "Delete error !";
            }
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }
  public function delete_quotation_contact_data()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
            $quotation_contact_id = $_GET['quotation_contact_id'];
            $enquiryid = $_GET['enquiry_id'];

            $this
                ->load
                ->model('Enquiry_model');

            $response = $this
                ->Enquiry_model
                ->delete_quotation_contact_data($quotation_contact_id,$enquiryid);

            if ($response == true)
            {

                $this
                    ->session
                    ->set_flashdata('quotation_del_contact_message', 'Deleted Successfully');
                redirect(base_url().'Enquiry/?enquiry_id=' . $enquiryid.'&#contact_section');
            }
            else
            {
                echo "Delete error !";
            }
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }
  
  public function delete_quotation_owner_data()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
            $quotation_contact_id = $_GET['quotation_owner_id'];
            $enquiryid = $_GET['enquiry_id'];

            $this
                ->load
                ->model('Enquiry_model');

            $response = $this
                ->Enquiry_model
                ->delete_quotation_owner_data($quotation_owner_id,$enquiryid);

            if ($response == true)
            {

                $this
                    ->session
                    ->set_flashdata('quotation_del_owner_message', 'Deleted Successfully');
                redirect(base_url().'Enquiry/?enquiry_id=' . $enquiryid.'&#owner_section');
            }
            else
            {
                echo "Delete error !";
            }
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }
    public function delete_quotation_appointment_data()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
            $quotation_appointment_id = $_GET['quotation_appointment_id'];
            $enquiryid = $_GET['enquiry_id'];

            $this
                ->load
                ->model('Enquiry_model');

            $response = $this
                ->Enquiry_model
                ->delete_quotation_appointment_data($quotation_appointment_id,$enquiryid);

            if ($response == true)
            {

                $this
                    ->session
                    ->set_flashdata('quotation_del_appointment_message', 'Deleted Successfully');
                redirect(base_url().'Enquiry/?enquiry_id=' . $enquiryid.'&#appointment_section');
            }
            else
            {
                echo "Delete error !";
            }
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }
  public function delete_quotation_itemdetails_data()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
            $quotation_contact_id = $_GET['quotation_itemdetails_id'];
            $enquiryid = $_GET['enquiry_id'];

            $this
                ->load
                ->model('Enquiry_model');

            $response = $this
                ->Enquiry_model
                ->delete_quotation_itemdetails_data($quotation_itemdetails_id,$enquiryid);

            if ($response == true)
            {

                $this
                    ->session
                    ->set_flashdata('quotation_del_itemdetails_message', 'Deleted Successfully');
                redirect(base_url().'Enquiry/?enquiry_id=' . $enquiryid.'&#item_section');
            }
            else
            {
                echo "Delete error !";
            }
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }
    
   public function edit_address_data()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
            $data = array(
                "address_type" => $this->input->post('address_type') ,
                "address_line_1" => $this->input->post('address_line_1') ,
                "address_line_2" => $this->input->post('address_line_2') ,
                "country" => $this->input->post('country') ,
                "state" => $this->input->post('state') ,
                "city" => $this->input->post('city') ,
                "street" => $this->input->post('street') ,
                "pincode" => $this->input->post('pincode') ,
                "updated_datetime" => date('Y-m-d H:i:s') ,
                "updated_by" => $this->session->userdata['user_id']
            );
            
            $addressid = $this->input->post('address_id');
            

            $this
                ->load
                ->model('Enquiry_model');

            $response = $this
                ->Enquiry_model
                ->edit_address_data($data,$addressid);

            if ($response == true)
            {

                $enquiryid = $this->input->post('enquiry_id');

                $this
                    ->session
                    ->set_flashdata('address_update_msg', 'Updated successfully');
                redirect('enquiry?enquiry_id=' . $enquiryid . '&#address_section');
            }
            else
            {
                echo "Insert error !";
            }
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }
    
    public function edit_contact_data()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
            $data = array(
                "enquiry_id" => $this->input->post('enquiry_id') ,
                "name" => $this->input->post('name') ,
                "designation" => $this->input->post('designation') ,
                "mobile_no" => $this->input->post('mobile_no') ,
                "email" => $this->input->post('email') ,
                "dob" => $this->input->post('dob') ,
                "marriage_anniversary_date" => $this->input->post('marriage_anniversary_date') ,
                "updated_datetime" => date('Y-m-d H:i:s') ,
                "updated_by" => $this->session->userdata['user_id']
            );
            
            $contactid = $this->input->post('contact_id');
            

            $this
                ->load
                ->model('Enquiry_model');

            $response = $this
                ->Enquiry_model
                ->edit_contact_data($data,$contactid);

            if ($response == true)
            {

                $enquiryid = $this->input->post('enquiry_id');

                $this
                    ->session
                    ->set_flashdata('contact_update_msg', 'Updated successfully');
                redirect('enquiry?enquiry_id=' . $enquiryid . '&#contact_section');
            }
            else
            {
                echo "Insert error !";
            }
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }
    public function edit_owner_data()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
            $data = array(
                "enquiry_id" => $this->input->post('enquiry_id') ,
                "name" => $this->input->post('name') ,
                "mobile_no" => $this->input->post('mobile_no') ,
                "email" => $this->input->post('email') ,
                "dob" => $this->input->post('dob') ,
                "marriage_anniversary_date" => $this->input->post('marriage_anniversary_date') ,
                "updated_datetime" => date('Y-m-d H:i:s') ,
                "updated_by" => $this->session->userdata['user_id']
            );
            
            $ownerid = $this->input->post('owner_id');
            

            $this
                ->load
                ->model('Enquiry_model');

            $response = $this
                ->Enquiry_model
                ->edit_owner_data($data,$ownerid);

            if ($response == true)
            {

                $enquiryid = $this->input->post('enquiry_id');

                $this
                    ->session
                    ->set_flashdata('owner_update_msg', 'Updated successfully');
                redirect('enquiry?enquiry_id=' . $enquiryid . '&#owner_section');
            }
            else
            {
                echo "Insert error !";
            }
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }
    public function edit_item_data()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
            $data = array(
                "enquiry_id" => $this->input->post('enquiry_id') ,
                "name" => $this->input->post('name') ,
                "approximate_value" => $this->input->post('approximate_value') ,
                "approximate_quantity" => $this->input->post('approximate_quantity') ,
                "updated_datetime" => date('Y-m-d H:i:s') ,
                "updated_by" => $this->session->userdata['user_id']
            );
            
            $itemid = $this->input->post('item_id');
            

            $this
                ->load
                ->model('Enquiry_model');

            $response = $this
                ->Enquiry_model
                ->edit_item_data($data,$itemid);

            if ($response == true)
            {

                $enquiryid = $this->input->post('enquiry_id');

                $this
                    ->session
                    ->set_flashdata('item_update_msg', 'Updated successfully');
                redirect('enquiry?enquiry_id=' . $enquiryid . '&#item_section');
            }
            else
            {
                echo "Insert error !";
            }
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }
    public function edit_appointment_data()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
             $data = array(
                "enquiry_id" => $this->input->post('enquiry_id') ,
                "date" => $this->input->post('date') ,
                "time" => $this->input->post('time') ,
                "mail_to" => $this->input->post('mail_to') ,
                "sms_to" => $this->input->post('sms_to') ,
                "updated_datetime" => date('Y-m-d H:i:s') ,
                "updated_by" => $this->session->userdata['user_id']
            );
            
            $appointmentid = $this->input->post('appointment_id');
            

            $this
                ->load
                ->model('Enquiry_model');

            $response = $this
                ->Enquiry_model
                ->edit_appointment_data($data,$appointmentid);

            if ($response == true)
            {

                $enquiryid = $this->input->post('enquiry_id');

                $this
                    ->session
                    ->set_flashdata('appointment_update_msg', 'Updated successfully');
                redirect('enquiry?enquiry_id=' . $enquiryid . '&#appointment_section');
            }
            else
            {
                echo "Insert error !";
            }
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }

    public function edit_item_data_quotation()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
            $data = array(
                "item_name" => $this->input->post('name'), 
                "quantity" => $this->input->post('quantity'), 
                "unit" => $this->input->post('unit'), 
                "rate" => $this->input->post('rate'), 
                "description" => $this->input->post('description'), 
                "enquiry_id" => $this->input->post('enquiry_id'),
                "heading_id" => $this->input->post('heading_id'),
                "updated_datetime" => date('Y-m-d H:i:s') ,
                "updated_by" => $this
                    ->session
                    ->userdata['user_id']
            );
            $itemid = $this->input->post('item_id');
            

            $this
                ->load
                ->model('Enquiry_model');

            $response = $this
                ->Enquiry_model
                ->edit_item_data_quotation($data,$itemid);

            if ($response == true)
            {
                $heading_id = $this->input->post('heading_id');
                $enquiryid = $this->input->post('enquiry_id');

                $this
                    ->session
                    ->set_flashdata('quotation_item_message', 'Item Data Saved Successfully');
                redirect(base_url().'Enquiry/quotation?enquiry_id=' . $enquiryid.'&header_id='.$heading_id.'&#quotation_item_details');
            }
            else
            {
                echo "Insert error !";
            }
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }
    public function edit_quotation_heading()
    {
        if ($this
            ->session
            ->userdata['role'] == (1 || 2))
        {
            
         
            
            $data = array(
                "unique_id" => 'SE'.rand(1000,9999).rand(10,99), 
                "to_email" => $this
                    ->input
                    ->post('to_email'), 
                "company" => $this
                    ->input
                    ->post('company'), 
                "heading_text" => $this
                    ->input
                    ->post('heading'), 
                    "address_type" => $this
                    ->input
                    ->post('address_type'), 
                "enquiry_id" => $this->input->post('enquiry_id'),
                
                
                
                "updated_datetime" => date('Y-m-d H:i:s') ,
                "updated_by" => $this
                    ->session
                    ->userdata['user_id']
            );

            $this
                ->load
                ->model('Enquiry_model');
            $headingid = $this->input->post('heading_id');

            $response = $this
                ->Enquiry_model
                ->edit_quotation_heading($data,$headingid);

            if ($response == true)
            {

                $enquiryid = $this->input->post('enquiry_id');
                $this
                    ->session
                    ->set_flashdata('quotation_heading_message', 'Heading Data Saved Successfully');
                redirect(base_url().'Enquiry/quotation?enquiry_id=' . $enquiryid.'&header_id='.$headingid.'&#quotationheadingform');
            }
            else
            {
                echo "Insert error !";
            }
        }
        else
        {
            $this
                ->load
                ->view('basic/login');
        }
    }
}

?>
