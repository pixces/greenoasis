<?php
/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 05/10/13
 * Time: 11:33 PM
 * To change this template use File | Settings | File Templates.
 */ 
class PagesController extends Controller {

    public function beforeAction(){
    }

    public function afterAction(){
    }

    public function index()
    {
        //get all the featured package for both tours as well as combo deals
        $packageModel = new Package();
        $tours = $packageModel->fetchAll(Package::TYPE_TOURS, 5, true);
        $combo = $packageModel->fetchAll(Package::TYPE_COMBO, 5, true);
        $holiday = $packageModel->fetchAll(Package::TYPE_HOLIDAY, 5, true);

        //get the details form the social and contact group
        $quickContact = Configurator::get('contact',1);

        $social = Configurator::get('social',1);

        $this->set('package',array('tours'=>$tours,'combo'=>$combo, 'holiday'=>$holiday));
        $this->set('social',$social);
        $this->set('contact',$quickContact);
        $this->set_pageType('home');
    }

    function display(){
        $page_identifier = func_get_arg(func_num_args()-1);

        $pageDet = $this->Page->getByIdentifier($page_identifier);
        if ($pageDet){
            $this->set_pagetitle( $pageDet['Page']['title'] );
            $this->set_pageType($page_identifier);
            $this->set('page',$pageDet['Page']);
        }

        //over ride the template file
        //to make sure that the page rendered is that of contact not display
        if ($page_identifier == 'contact'){
            $this->setTemplate('contact');
        }
    }

    function contact(){
        return;
    }

    function saveContact(){
        $this->doNotRenderHeader = true;

        if (isset($_POST) && $_POST['contact'] && ( $_POST['contact']['form'] == 'quickContact' || $_POST['contact']['form'] == 'contact')){

            $details = Utils::sanitizeParams($_POST['contact']);
            foreach($details as $key => $value){
                if ($key == 'email'){
                    if (!Utils::is_valid($value)){
                        //return false saying email is invalid
                        echo json_encode(array('response'=>'ok','status'=>'failed','message'=>"Invalid email address provided"));
                        exit;
                    }
                }
            }

            //send email to the admin regarding this form
            Utils::sendEmail(
                array('email'=>'rizwan@innoveins.com','name'=>'Admin'),
                "Contact form submitted",
                $details,
                'site_contact'
            );
                echo json_encode(array('response'=>'ok','status'=>'success','message'=>"Quick Contact Submitted successfully."));
                exit;
            //return success
        } else {
                echo json_encode(array('response'=>'ok','status'=>'failed','message'=>"Invalid details provided."));
                exit;
            }
    }

    function validateCaptcha(){

    }
    
    public function logout()
    {
        unset($_SESSION['isAgentLoggedIn']);
        unset($_SESSION['agent']);

        #return to the index page
        header("location:" . SITE_URL);
        exit;
    }

}
