<?php

/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 09/12/13
 * Time: 11:52 PM
 * To change this template use File | Settings | File Templates.
 */
class AgentController extends Controller {

    protected $agent = array();

    public function index(){
        $this->isAgentLoggedIn();

        //fetch the details by this agent to display on the agents dashboard
        $agentId = $this->agent['id'];
        $hotelreservations=$this->bookings($agentId);
        $visaInfo=$this->visa($agentId);
        
        $this->set('hotelReservations', $hotelreservations);
        $this->set('visaInfo', $visaInfo);


    }

    public function transactions(){
        $this->isAgentLoggedIn();
        $agentId = $this->agent['id'];

        //get the summary
        $summary = $this->Agent->getWalletSummary($agentId);

        //get the wallet details for this agent
        $oWallet = new Agent_Wallet();
        $details = $oWallet->getByAgent($agentId);

        $this->set('summary',$summary);
        $this->set('data',$details);
    }


    public function register() {

        #check for the following fields
        #Company Name
        #Contact
        #Email
        #Phone Number
        $error = 0;

        if ($_POST && $_POST['mm_form'] == 'registerAgent') {
            $newAgent = $_POST['agent'];

            //check for valid details added
            if (!empty($newAgent['email']) && !empty($newAgent['phone'])) {

                //get the details of agent registered with same email
                $agent = $this->fetchAgentDetails('email', $newAgent['email']);
                if (!$agent) {
                    //save this agent details to the database
                    if ($this->saveAgent($newAgent)) {
                        //get the id of the new agent
                        $agentId = $this->Agent->insert_id;
                        $_SESSION['agent']['id'] = $agentId;
                        $_SESSION['agent']['status'] = 'confirmation';

                        //send emails to the user
                        if ($this->sendEmail($newAgent, 'registration')) {
                            //redirect to the confirmation page
                            $url = SITE_URL . "/agent/confirmation";
                            header("location:" . $url);
                            exit;
                        } else {
                            $this->set('error', "Cannot send Agent Email.");
                        }
                    } else {
                        $this->set('error', "Cannot save agent details.");
                    }
                } else {
                    $this->set('error', "Agent with the same Email already exists. Please Login.");
                }
            } else {
                $this->set('error', "All fields are mandatory.");
            }
        }
    }

    private function fetchAgentDetails($field, $value) {

        if (!$field && !$value) {
            return false;
        }

        if (!$this->agent) {
            $this->agent = $this->Agent->getByField($field, $value);
        }
        return $this->agent;
    }

    private function saveAgent($params) {
        foreach ($params as $field => $value) {
            $this->Agent->{$field} = $value;
        }

        //add the date added
        $this->Agent->date_added = date('Y-m-d h:i:s');
        return $this->Agent->save();
    }

    public function confirmation() {

        if (isset($_SESSION['agent']['id']) && $_SESSION['agent']['status'] == 'confirmation') {

            $agentId = $_SESSION['agent']['id'];
            $agentDet = $this->fetchAgentDetails('id', $agentId);
            $agent = $agentDet['Agent'];

            //unset the agent session
            unset($_SESSION['agent']);

            $agent['id'] = 'GO' . str_pad($agent['id'], 5, '0', STR_PAD_LEFT);
            $this->set('agent', $agent);
        } else {
            header("location:" . SITE_URL . '/agent/register');
            exit;
        }
    }

    public function login() {

        //capture username and password
        //check from db
        //  check email == 'username' && password == md5(password) && status == 'approved'
        //  if true
        //        - set session and redirect to home page with sessions set
        //        - else - throw error on the model window
        //        - error -> Invalid Login Credentials. Please try again.


        if ($_POST && $_POST['mm_action'] === 'doLogin') {

            try {
                #first validate posted data
                if ($this->validate($_POST['agent'])) {
                    #execute login process

                    $agent = $this->Agent->doLogin($_POST['agent']);

                    if (!empty($agent)) {

                        $_SESSION['isAgentLoggedIn'] = true;
                        $_SESSION['agent']['id'] = $agent[0]['Agent']['id'];
                        $_SESSION['agent']['email'] = $agent[0]['Agent']['email'];
                        $_SESSION['agent']['contact'] = $agent[0]['Agent']['contact'];

                        #check if refferer is set
                        if (isset($_SESSION['redirect_url'])):
                            $redirect_url = $_SESSION['redirect_url'];
                            unset($_SESSION['redirect_url']);
                            header("location:" . $redirect_url);
                            exit;
                        endif;
                        #redirect to index page
                        header("location:" . SITE_URL . "/pages/index");
                        exit;
                    }

                    $this->set('error', "Invalid Login Credentials. Please try again");
                }
            } catch (Exception $e) {
                echo $message = $e->getMessage();
            }
        }
    }

    private function sendEmail($params, $template = 'registration', $isAdmin = true) {

        if (!$params) {
            return false;
        }

        $mail = new Mailer();

        switch ($template) {
            //send mail for registration
            case 'registration':
                $subject = 'Welcome to GreenOasis';
                $mail->addAddress($params['email'], $params['contact']);
                $mail->setData('agent', $params);
                break;
        }

        $mail->setTemplate($template);
        $mail->setSubject($subject);

        try {
            if (!$mail->sendEmail()) {
                echo $mail->ErrorInfo;
                return false;
            }
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    private function validate($var) {

        if (is_array($var)) {

            if (empty($var['username'])) {
                throw new Exception('Username field is empty');
            } else if (empty($var['password'])) {
                throw new Exception('Password field is empty');
            } else {
                return true;
            }
        } else {
            throw new Exception('Please enter login details');
        }
    }

    public function checkAgentSession() {
        $this->doNotRenderHeader = true;

        if (!isset($_SESSION['isAgentLoggedIn'])) {
            $_SESSION['redirect_url'] = $_POST['reloadUrl'];
            echo json_encode(array('response' => 'ok', 'status' => 'failed', 'message' => "Your session has been expired.Please login."));
            exit;
        }
        echo json_encode(array('response' => 'ok', 'status' => 'success', 'message' => ""));
        exit;
    }

    private function isAgentLoggedIn(){
        //check if the agent is logged in

        if (!isset($_SESSION['isAgentLoggedIn'])) {
            $_SESSION['redirect_url'] = SITE_URL . "/agent/";
            header("location: " . SITE_URL . "/agent/login");
            exit;
        }
        $this->agent = $_SESSION['agent'];
    }

     /*     * ***********************************
     * Booking
     * *********************************** */
    public function bookings($agentId) {
       
        $hotelResObj = new Hotel_Reservation();
        $hotelResObj->agent_id=$agentId;
      //  $counts = $hotelResObj->getCounts();

        //  $hotelResObj->setCurDate();
        $hotelResObj->orderBy('date_added', 'DESC');

        $hotelreservations = $hotelResObj->getAll();

       return  $hotelreservations;
    }
    
    /*     * ***********************************
     * Visa
     * *********************************** */

    public function visa($agentId) {
        
        $visaObj = new Visa();
        $visaObj->agent_id=$agentId;
        //$visaObj->like("status", "pending");
        // $visaObj->setCurDate();
        $visaObj->orderBy('date_added', 'DESC');
        $visaInfo = $visaObj->getAll();

      return $visaInfo;
    }

    public function uploadVisaByAgent() {
        if ($_FILES['visaFile']['type'] == "application/pdf") {
            $application_id = $_POST['id'];
            $agent_id = $_POST['agent_id'];
            $file = $_FILES['visaFile'];
            $uploadVisaFile = Utils::uploadImage($file);
            $visa['id'] = $application_id;

            $visa['visa_file_name'] = json_encode($uploadVisaFile);
            $visa['status'] = "approved";
            $visaObj = new Visa();
            $visaObj->setId($application_id);
            $visaObj->visa_file_name = $visa['visa_file_name'];
            $visaObj->status = "approved";
            $visaObj->agent_id = $agent_id;

            if ($visaObj->save(true)) {
                $download_link="<a href=". SITE_URL . "/admin/download_visa_document/". json_decode($visa["visa_file_name"]). "><i class=\"icon-file\"></i> </a>";
                echo json_encode(array('result' => 'Success', 'message' => 'Visa Uploaded And Approved Successfully.', 'applicationid' => $application_id,'download_link'=>$download_link));
            } else {
                echo json_encode(array('result' => 'Error', 'message' => 'Visa Upload Failed.'));
            }
        } else {
            echo json_encode(array('result' => 'Error', 'message' => 'Unsupported file.Please upload Pdf file only.'));
        }
        exit;
    }
    
     public function download_visa_document($file) {
             Utils::downloadPdf($file);
    }

}
