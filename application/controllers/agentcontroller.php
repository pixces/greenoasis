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
        //redirect to the site index
        //if the agent session is already set
        //else redirect to the agent register form
    }


    public function register(){

        #check for the following fields
        #Company Name
        #Contact
        #Email
        #Phone Number
        $error = 0;

        if ($_POST && $_POST['mm_form'] == 'registerAgent'){
            $newAgent = $_POST['agent'];

            //check for valid details added
            if ( !empty($newAgent['email']) && !empty($newAgent['phone']) ) {

                //get the details of agent registered with same email
                $agent = $this->fetchAgentDetails('email',$newAgent['email']);
                if (!$agent){
                    //save this agent details to the database
                    if ( $this->saveAgent($newAgent)){
                        //get the id of the new agent
                        $agentId = $this->Agent->insert_id;
                        $_SESSION['agent']['id'] = $agentId;
                        $_SESSION['agent']['status'] = 'confirmation';

                        //send emails to the user
                        if ( $this->sendEmail($newAgent,'registration') ){
                            //redirect to the confirmation page
                            $url = SITE_URL."/agent/confirmation";
                            header("location:".$url);
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
                $this->set('error',"All fields are mandatory.");
            }
        }
    }

    private function fetchAgentDetails($field,$value){

        if (!$field && !$value){
            return false;
        }

        if (!$this->agent){
            $this->agent = $this->Agent->getByField($field,$value);
        }
        return $this->agent;
    }

    private function saveAgent($params){
        foreach($params as $field => $value){
            $this->Agent->{$field} = $value;
        }

        //add the date added
        $this->Agent->date_added = date('Y-m-d h:i:s');
        return $this->Agent->save();
    }

    public function confirmation(){

        if (isset($_SESSION['agent']['id']) && $_SESSION['agent']['status'] == 'confirmation'){

            $agentId = $_SESSION['agent']['id'];
            $agentDet = $this->fetchAgentDetails('id',$agentId);
            $agent = $agentDet['Agent'];

            //unset the agent session
            unset($_SESSION['agent']);

            $agent['id'] = 'GO'.str_pad($agent['id'],5,'0',STR_PAD_LEFT);
            $this->set('agent',$agent);
        } else {
            header("location:".SITE_URL.'/agent/register');
            exit;
        }

    }

    public function login(){

        //capture username and password
        //check from db
        //  check email == 'username' && password == md5(password) && status == 'approved'
        //  if true
        //        - set session and redirect to home page with sessions set
        //        - else - throw error on the model window
        //        - error -> Invalid Login Credentials. Please try again.


    }

    private function sendEmail($params,$template='registration',$isAdmin=true){

        if (!$params){
            return false;
        }

        $mail = new Mailer();

        switch($template){
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
            if ( !$mail->sendEmail() ) {
                echo $mail->ErrorInfo;
                return false;
            }
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

}
