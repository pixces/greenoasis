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
        //get the details form the social and contact group
        $quickContact = Configurator::get('contact',1);

        $social = Configurator::get('social',1);

        $this->set('social',$social);
        $this->set('contact',$quickContact);
    }

    function display(){
        $page_identifier = func_get_arg(func_num_args()-1);

        $pageDet = $this->Page->getByIdentifier($page_identifier);
        if ($pageDet){
            $this->set_pagetitle( $pageDet['Page']['title'] );
            $this->set('page',$pageDet['Page']);
        }
        $this->set_pageType('page');

        //over ride the template file
        //to make sure that the page rendered is that of contact not display
        if ($page_identifier == 'contact'){
            $this->setTemplate('contact');
        }
    }

    function contact(){
        return;
    }

}
