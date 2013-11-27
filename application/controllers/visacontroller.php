<?php
/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 17/11/13
 * Time: 1:47 PM
 * To change this template use File | Settings | File Templates.
 */ 
class VisaController  extends Controller {

    public function index(){

        if ($_POST){

            //get the total passenger count applying for visa
            $pax_count = $_POST['visa']['count'];
            $paxList = $_POST['pax'];

            //generate application id
            $application_id = UTILS::generateCaptcha(5, 'int');

            //check if all the details for each passenger is added
            if (count($_POST['pax']) == $pax_count){
                //also check if there are at least one image file for each passenger
                if ( count($_FILES['image']['name']) == $pax_count ){

                    //create $_Files array such that $_FILES[0]['image'][0] is a complete one data set
                    $uploadList = UTILS::convertUploadArray($_FILES['image']);

                    //now upload this
                    foreach($uploadList as $mainId => $imgFileList){
                         foreach($imgFileList as $idx => $file){
                             $paxList[$mainId]['image'][$idx] = Utils::uploadImage($file);
                         }
                    }

                    #save the basic details to create a visa application

                    list($visa['type'],$visa['validity']) = UTILS::getVisaPackage($_POST['visa']['package']);
                    $visa['application_id'] = $application_id;
                    $visa['agent_id'] = 1;
                    $visa['arrival'] = date('Y-m-d',strtotime($_POST['visa']['arrival']));
                    $visa['phone'] = $_POST['visa']['phone'];
                    $visa['email'] = $_POST['visa']['email'];
                    $visa['pax_count'] = $pax_count;
                    $visa['date_added'] = date('Y-m-d h:i:s');

                    foreach($visa as $field => $value){
                        $this->Visa->{$field} = $value;
                    }

                    if($this->Visa->save()){
                        //save all the passenger details
                        $application_id = $application_id;
                        $paxObj = new Visa_Pax();
                        foreach($paxList as $pax){
                            foreach($pax as $field => $value){
                                if ($field == 'image') {
                                    $paxObj->{$field} = json_encode($value);
                                } else if(  $field == 'issue'  ||  $field == 'expiry'  || $field == 'dob' ){
                                    $paxObj->{$field} = date('Y-m-d', strtotime($value));
                                } else {
                                    $paxObj->{$field} = $value;
                                }
                            }
                            $paxObj->application_id = $application_id;

                            //save this info
                            $paxObj->save();
                        }

                        //redirect the user to the confirmation page
                        $_SESSION['v_appId'] = $application_id;
                        $hrefQuery = "vid=".$application_id."&dt[]=".strtotime($_POST['visa']['arrival'])."&pax=".$pax_count;
                        header("location:".SITE_URL."/visa/confirmation/?".$hrefQuery);
                        exit;
                    } else {
                        //throw error that visa details cannot be saved
                        echo "Cannot save Basic Visa Details";
                    }
                } else {
                    echo "Count of Image files group does not match actual pax count";
                }
            }  else {
                echo "Pax count in Basic details does not matches Count of Passenger Info";
            }
        }
    }

    public function confirmation(){
        //TODO: convert this to Session variable
        //also make sure to check if session_vid = $this->_request['vid'];
        $visa_id = isset($this->_request['vid']) ? $this->_request['vid'] : '';

        //unset the visa id session
        unset($_SESSION['v_appId']);

        if ($visa_id != ''){
            //get the details based on the selecte visa_id
            $this->Visa->setId($visa_id);
            $det = $this->Visa->getById();

            if ($det){
                //return the details
                //print_r($det);
                $this->set('visa',$det);
            }
        } else {
            //redirect user to the visa page
            header("location:".SITE_URL."/visa/");
            exit;
        }
    }

}
