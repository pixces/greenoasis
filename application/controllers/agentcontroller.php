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

    public function index() {
        $this->isAgentLoggedIn();

        $agentId = $this->agent['id'];

        $hotelreservations = $this->bookings($agentId);
        $visaInfo = $this->visa($agentId);

        $this->set('hotelReservations', $hotelreservations);
        $this->set('visaInfo', $visaInfo);
    }

    /**
     * Display all agent transactions
     */
    public function transactions() {
        $this->isAgentLoggedIn();
        $agentId = $this->agent['id'];

        //get the summary
        $summary = $this->Agent->getWalletSummary($agentId);

        //get the wallet details for this agent
        $oWallet = new Agent_Wallet();
        $details = $oWallet->getByAgent($agentId);

        $this->set('summary', $summary);
        $this->set('data', $details);
    }

    /**
     * Display options to edit
     * agent details - served to the loggin Agent only
     */
    public function profile(){
        $this->isAgentLoggedIn();
        $agentId = $this->agent['id'];

        //get details of this agent
        $this->Agent->setId($agentId);
        $details = $this->Agent->getById();

        $agent = $details['Agent'];
        $post_error = false;

        if ($_POST){
            if ($_POST['formAction'] == 'profile'){
                $data = $_POST['agent'];
                foreach($data as $field=>$value){
                    $agent[$field] = Utils::sanitize($value);
                }
            } else if ($_POST['formAction'] == 'password'){
                $data = $_POST['agent'];

                if ($agent['password'] == md5($data['old_password'])){

                    if ($data['password'] == $data['confirm_password']){
                        $agent['uncryptpassword']=$data['password'];
                        $agent['password'] = md5($data['password']);
                    } else {
                        $post_error = true;
                        $this->setFlash("New and Confirm password are not identical.",'e');
                    }
                } else {
                    $post_error = true;
                    $this->setFlash("Wrong or invalid Existing Password provided.",'e');
                }
            }
            
            
            if (!$post_error){
                //save this agent details to the database
                if ($this->saveAgent($agent)) {
                    if ($_POST['formAction'] == 'profile'){
                        $this->setFlash('Profile Successfully Update.','s');
                        header("location:" . SITE_URL . "/agent/profile");
                        exit;
                    } else if ($_POST['formAction'] == 'password'){
                        $this->setFlash('Password Updated successfully. Changes will be effective with your next login','s');
                        $this->sendEmail($agent, 'agent_password_update');
                        header("location:" . SITE_URL . "/pages/logout");
                        exit;
                    }
                } else {
                    $this->setFlash("Cannot Update Agent ".$_POST['formAction'],'e');
                }
            }
        }
        $this->set('agent', $agent);
    }

    /**
     * Register a mew agent
     */
    public function register() {
        $error = 0;

        //force logout agent if already loggedin


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

                        //send email to the admin
                        $this->sendEmail($newAgent, 'registration');

                        //redirect to the agent confirmation page
                        $url = SITE_URL . "/agent/confirmation?agent=success&new=".$agentId."&email=".$newAgent['email']."&type=".confirmation;
                        header("location:" . $url);
                        exit;
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

    /**
     * Get details of the agent
     * @param $field
     * @param $value
     * @return array|bool
     */
    private function fetchAgentDetails($field, $value) {

        if (!$field && !$value) {
            return false;
        }

        if (!$this->agent) {
            $this->agent = $this->Agent->getByField($field, $value);
        }
        return $this->agent;
    }

    /**
     * Save agent details
     * @param $params
     * @return mixed
     */
    private function saveAgent($params) {
        foreach ($params as $field => $value) {
            $this->Agent->{$field} = $value;
        }

        //add the date added
        $this->Agent->date_added = date('Y-m-d h:i:s');
        return $this->Agent->save();
    }

    /**
     * Display agent confirmation
     */
    public function confirmation() {

        if (isset($_SESSION['agent']['id']) && $_SESSION['agent']['status'] == 'confirmation') {

            $agentId = $_SESSION['agent']['id'];

            //unset the agent session
            unset($_SESSION['agent']);

            $agentDet = $this->fetchAgentDetails('id', $agentId);
            $agent = $agentDet[0]['Agent'];

            $agent['id'] = 'GO' . str_pad($agent['id'], 5, '0', STR_PAD_LEFT);
            $this->set('agent', $agent);
        } else {
            header("location:" . SITE_URL . '/agent/register');
            exit;
        }
    }

    /**
     * Login as a n agent
     */
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

    /**
     * Send email to the new agent
     * @param $params
     * @param string $template
     * @param bool $isAdmin
     * @return bool
     */
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
            case 'agent_password_update':
                $subject='Greenoasis Password Reset';
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

    /**
     * Validate login details
     * @param $var
     * @return bool
     * @throws Exception
     */
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

    /**
     * Check if agent is logged in
     */
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

    /**
     * Verify if agent is loggedin
     */
    private function isAgentLoggedIn() {
        //check if the agent is logged in

        if (!isset($_SESSION['isAgentLoggedIn'])) {
            $_SESSION['redirect_url'] = SITE_URL . "/agent/";
            header("location: " . SITE_URL . "/agent/login");
            exit;
        }
        $this->agent = $_SESSION['agent'];
    }

    /*     * **********************************
     * Booking
     * *********************************** */
    public function bookings($agentId) {

        $hotelResObj = new Hotel_Reservation();
        $hotelResObj->agent_id = $agentId;

        $hotelResObj->orderBy('date_added', 'DESC');
        $hotelreservations = $hotelResObj->getByAgent($agentId);

        return $hotelreservations;
    }

    public function viewBooking() {
        $this->doNotRenderHeader = true;
        $hotel_bookingId = func_get_arg(func_num_args() - 1);

        //get the details of this booking id
        $hoteResObj = new Hotel_Reservation();
        $hoteResObj->setId($hotel_bookingId);
        $details = $hoteResObj->getById();
        $this->set('booking', $details);
    }

    /*     * **********************************
     * Visa
     * *********************************** */
    public function visa($agentId) {

        $visaObj = new Visa_Booking();
        //$visaObj->agent_id = $agentId;
        $counts = $visaObj->getCounts();
        //$visaObj->like("status", "approved");
        // $visaObj->setCurDate();
        $visaObj->orderBy('date_added', 'DESC');
        $visaInfo = $visaObj->getByAgent($agentId);

        return $visaInfo;
    }

    public function viewVisa() {
        $this->doNotRenderHeader = true;
        $application_id = func_get_arg(func_num_args() - 1);

        $visaObj = new Visa();
        $visaObj->id = $application_id;
        $details = $visaObj->getById();
        $visa = array();
        $paxes = array();

        if (!empty($details)) {
            $visa['order_id'] = $details['Visa']['id'];
            $visa['agent_id'] = $details['Visa']['agent_id'];
            $visa['package'] = $details['Visa']['type'];
            $visa['validity'] = $details['Visa']['validity'];
            $visa['applied_date'] = $details['Visa']['date_added'];
            $visa['parent_customername'] = $details['Visa_Pax'][0]['Visa_Pax']['fname'] . ' ' . $details['Visa_Pax'][0]['Visa_Pax']['mname'] . ' ' . $details['Visa_Pax'][0]['Visa_Pax']['lname'];
            $visa['parent_passport'] = $details['Visa_Pax'][0]['Visa_Pax']['passport'];
            $visa['pax_count'] = $details['Visa']['pax_count'];
            $visa['nationality'] = $details['Visa_Pax'][0]['Visa_Pax']['nationality'];
            $visa['parent_passport_status'] = $details['Visa']['status'];
            $visa['visa_file_name'] = $details['Visa']['visa_file_name'];
            $visa['status'] = $details['Visa']['status'];

            foreach ($details['Visa_Pax'] as $pax) {
                $visa['paxes'][] = array('customer_name' => $pax['Visa_Pax']['fname'] . ' ' . $pax['Visa_Pax']['mname'] . ' ' . $pax['Visa_Pax']['lname'],
                    'passport_no' => $pax['Visa_Pax']['passport'],
                    'nationality' => $pax['Visa_Pax']['nationality'],
                    'status' => ucwords($visa['status']),
                    'document' => json_decode($pax['Visa_Pax']['image']));
            }

            $this->set('visa', $visa);
        }
    }

    /**
     * Upload visa by agent
     */
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
                $download_link = "<a href=" . SITE_URL . "/admin/download_visa_document/" . json_decode($visa["visa_file_name"]) . "><i class=\"icon-file\"></i> </a>";
                echo json_encode(array('result' => 'Success', 'message' => 'Visa Uploaded And Approved Successfully.', 'applicationid' => $application_id, 'download_link' => $download_link));
            } else {
                echo json_encode(array('result' => 'Error', 'message' => 'Visa Upload Failed.'));
            }
        } else {
            echo json_encode(array('result' => 'Error', 'message' => 'Unsupported file.Please upload Pdf file only.'));
        }
        exit;
    }

    /*
     * Force download visa document
     */
    public function download_visa_document($file) {
        Utils::downloadPdf($file);
    }

}
