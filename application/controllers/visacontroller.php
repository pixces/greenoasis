<?php

/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 17/11/13
 * Time: 1:47 PM
 * To change this template use File | Settings | File Templates.
 */
class VisaController extends Controller {

    public function index(){
        //list all visas in system
        $result = $this->Visa->getAll();
        $this->set('visalist',$result);
    }

    public function view($slug){
        $slug = func_get_arg(func_num_args()-1);
        $slug = strip_tags(strtolower(trim($slug)));
        $visaList = array();
        $visaDetail = array();

        //get the list of all visas
        $visaList = $this->Visa->getAll();

        //get details for the selected slug
        foreach($visaList as $visa){
            if ($visa['Visa']['slug'] == $slug){
                $visaDetail = $visa['Visa'];
                $this->set_pagetitle( 'Visa::'.$visa['Visa']['title'] );
            }
        }
        $this->set('visaList',$visaList);
        $this->set('data',$visaDetail);
}

    public function apply() {

        if (!isset($_SESSION['isAgentLoggedIn'])) {
            $_SESSION['redirect_url'] = SITE_URL . '/visa/apply/'.$this->_request['queryString'][0].'/?visa='.$this->_request['visa']."&type=".$this->_request['type'];
            header("location: " . SITE_URL . "/agent/login");
            exit;
        }

        //create the visa object
        $model = new Visa();

        if ($_POST && isset($_SESSION['agent']['id'])) {

            $bookingModel = new Visa_Booking();
            $booking_id = UTILS::generateCaptcha(5, 'int');

            //get the total passenger count applying for visa
            $pax_count = $_POST['visa']['count'];
            $paxList = $_POST['pax'];

            //check if all the details for each passenger is added
            if (count($_POST['pax']) == $pax_count) {

                //also check if there are at least one image file for each passenger
                if (count($_FILES['image']['name']) == $pax_count) {

                    //create $_Files array such that $_FILES[0]['image'][0] is a complete one data set
                    $uploadList = UTILS::convertUploadArray($_FILES['image']);

                    //now upload this
                    foreach ($uploadList as $mainId => $imgFileList) {
                        foreach ($imgFileList as $idx => $file) {
                            if ($file['error'] == 0){
                                $paxList[$mainId]['image'][$idx] = Utils::uploadImage($file);
                            }
                        }
                    }

                    #save the basic details to create a visa application
                    $visa['id'] = $booking_id;
                    $visa['visa_id'] = $_POST['visa']['visa_id'];
                    $visa['type'] = $_POST['visa']['type'];
                    $visa['validity'] = $_POST['visa']['validity'];
                    $visa['agent_id'] = $_SESSION['agent']['id'];
                    $visa['arrival'] = date('Y-m-d', strtotime($_POST['visa']['arrival']));
                    $visa['phone'] = $_POST['visa']['phone'];
                    $visa['email'] = $_POST['visa']['email'];
                    $visa['pax_count'] = $pax_count;
                    $visa['date_added'] = date('Y-m-d h:i:s');

                    //print_r($visa);
                    //exit;

                    foreach ($visa as $field => $value) {
                        $bookingModel->{$field} = $value;
                    }
                  

                    if ($bookingModel->save(true)) {
                        //save all the passenger details
                        
                        $paxObj = new Visa_Pax();
                        foreach ($paxList as $pax) {
                            foreach ($pax as $field => $value) {
                                if ($field == 'image') {
                                    $paxObj->{$field} = json_encode($value);
                                } else if ($field == 'issue' || $field == 'expiry' || $field == 'dob') {
                                    $paxObj->{$field} = date('Y-m-d', strtotime($value));
                                } else {
                                    $paxObj->{$field} = $value;
                                }
                            }
                            $paxObj->visa_booking_id = $booking_id;
                            //save this info
                            $paxObj->save();

                            /*$walletObj = new Agent_Wallet();
                            $wallet['agent_id'] = $_SESSION['agent']['id'];
                            $wallet['value'] = 135.00;
                            $wallet['type'] = 'withdrawl';
                            $wallet['item_type'] = 'visa';
                            $wallet['date']=date('Y-m-d h:i:s');
                            foreach ($wallet as $field => $value) {
                                $walletObj->{$field} = $value;
                            }
                            $walletObj->save();*/
                            
                           //send notifiaction on successful booking to  visa@dubaigot.com & info@dubaigot.com
                           //Params to send in notification [booking-id,phone-no,eamil of the customer/agent-id,agent-contact,agent-email of the agent]
                            $receipent[]=array('email' => 'visa@dubaigot.com', 'name' => 'Visa@Dubaigot');
                            $receipent[]=array('email' => 'info@dubaigot.com', 'name' => 'Info@Dubaigot');
                            $params=array('email' => $_SESSION['agent']['email'], 
                                           'name' => $_SESSION['agent']['contact'],
                                            'booking_id'=>$booking_id,
                                            'visa_phone'=>$visa['phone'],
                                            'visa_email'=>$visa['email']);
                            $mail_content="Visa Application Notification";
                            Utils::sendEmail($receipent,$mail_content,$params,'visa_booking_notification');
                        }

                        //redirect the user to the confirmation page
                        $_SESSION['v_appId'] = $booking_id;
                        $hrefQuery = "vid=" . $booking_id . "&dt[]=" . strtotime($_POST['visa']['arrival']) . "&pax=" . $pax_count;
                        header("location:" . SITE_URL . "/visa/confirmation/?" . $hrefQuery);
                        exit;
                    } else {
                        //throw error that visa details cannot be saved
                        echo "Cannot save Basic Visa Details";
                    }
                } else {
                    echo "Count of Image files group does not match actual pax count";
                }
            } else {
                echo "Pax count in Basic details does not matches Count of Passenger Info";
            }
        }

        //set the details to the form
        $visa_id = $this->_request['visa'];

        //get the details of this visa
        //to be populated in form
        $this->Visa->setId($visa_id);
        $visaDetail = $this->Visa->getById();
        $this->set('data',$visaDetail['Visa']);
    }

    public function confirmation() {
        //TODO: convert this to Session variable
        //also make sure to check if session_vid = $this->_request['vid'];
        $visa_booking_id = isset($this->_request['vid']) ? $this->_request['vid'] : '';
        $bookingModel = new Visa_Booking();

        //unset the visa id session
        unset($_SESSION['v_appId']);

        if ($visa_booking_id != '') {
            //get the details based on the selected visa_id
            $bookingModel->setId($visa_booking_id);
            $det = $bookingModel->getById();
            if ($det) {
                //return the details
                //print_r($det);
                $this->set('visa', $det);
            }
        } else {
            //redirect user to the visa page
            //header("location:".SITE_URL."/visa/");
            //exit;
        }
    }

}
