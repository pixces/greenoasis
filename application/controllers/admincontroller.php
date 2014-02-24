<?php
/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 30/12/12
 * Time: 12:41 AM
 * To change this template use File | Settings | File Templates.
 */
class AdminController extends Controller
{
    private $_admin_id;
    private $_admin_hash;
    private $welcome_note;
    public $_message = "";
    public $_message_status = "";
    private $imageFilename;
    private $error;

    public function beforeAction()
    {
        if (!isset($_SESSION['isAdminLoggedIn'])) {
            $_SESSION['isAdminLoggedIn'] = false;
        }

        if ($this->_action != 'login') {
            #check if the user is logged in
            if (!$this->isLoggedIn()) {
                header("location: " . SITE_URL . "/admin/login/");
                exit;
            }

            #set the admin navigation
            $this->set("navigation", $this->getNavigation());

            #also set the admin details
            $this->set('welcome_note', $this->getWelcomeNote());
        }

        //do not render template is it is an ajax call
        if ($this->_request['is_ajax']){
            $this->doNotRenderHeader = true;
        }
    }

    public function afterAction()
    {
        /*
        //check and update common messages
        if (isset($_SESSION['error'])) {
            $this->_message_status = 'error';
            $this->_message = $_SESSION['error'];
            unset($_SESSION['error']);

            $this->set('message_status', $this->_message_status);
            $this->set('message', $this->_message);

        } else if (isset($_SESSION['message'])) {
            $this->_message_status = 'success';
            $this->_message = $_SESSION['message'];
            unset($_SESSION['message']);
        }

        $this->set('message_status', $this->_message_status);
        $this->set('message', $this->_message);

        if ($this->_flashmessage){
            $this->set('flashmessage',$this->_flashmessage);
        }
        */

    }

    public function index()
    {

    }

    /*************************************
     * Packages
     *************************************/
    public function package(){

        $images = 0;
        $packageObj = new Package();
        $packageList = $packageObj->getAll();

        foreach($packageList as &$package){
            if (count($package['Package_Rate'])){
                $package['Package']['price'] = $package['Package_Rate'][0]['Package_Rate']['price'];
            }
            $package['Package']['description'] = UTILS::smartSubStr($package['Package']['description'],250);
        }
        $this->set('packages',$packageList);
        $this->set_pageTitle('Packages');
        $this->set_pageType('package');
        $this->set('addUrl',SITE_URL.'/admin/package_add/');
    }

    public function package_add(){

        $package = new Package();

        if ( $_POST && $_POST['form_action'] == 'add' && $_POST['package'] ) {

                $error = 0;

                $data_times = $_POST['package']['time'];
                $data_rates = $_POST['package']['rate'];

                $package->setAttributes( $_POST['package'] );


                if ( $package->save() ){
                    $package_id = $package->insert_id;

                    //save package times
                    $packageTime = new Package_Time();
                    $packageRate = new Package_Rate();
                    try{
                        //save data for rates
                        $packageRate->saveAll($data_rates,$package_id);
                        //save data for times
                        try{
                            $packageTime->saveAll($data_times,$package_id);
                        } catch (Exception $e){
                            $this->setFlash($e->getMessage(),'e');
                        }
                    } catch (Exception $e){
                        $this->setFlash($e->getMessage(),'e');
                    }
                    $this->setFlash('Package '.$_POST['package']['title'].' successfully added.','s');
                } else {
                    $this->setFlash('Cannot save package '.$_POST['package']['title'],'e');
                }
                header("location:".SITE_URL."/admin/package/");
                exit;
        }

        $this->set_pageTitle('Packages: Add Package');
        $this->set('categoryOptions', $package->getCategoryOptions());
        $this->set('action', 'add');
        $this->set_pageType('package');
        $this->setTemplate('package_form');
    }

    public function package_edit(){

    }

    public function package_image(){

        if ($_POST && $_POST['form_action'] == 'uploadImage'){
            if ($_POST['package_id'] && $_FILES['image']['error'] == 0){
                $data = $_POST;

                try{
                    //check and upload image
                    if ($_FILES['image']['tmp_name']) {
                        $errorIdx = $_FILES['image']['error'];

                        if ($errorIdx > 0) {
                            $this->error = "Unable to save post. Cannot Upload Image";
                            return false;
                        }
                        //now process this image
                        $uploadFilename = Utils::uploadImage($_FILES['image'],'gallery');
                        if ($uploadFilename == true) {
                            $data['image_name'] = $uploadFilename;
                        } else {
                            $this->error = "Some unknown error. Cannot retrieve uploaded file name";
                            return false;
                        }
                    }

                    $imgModel = new Package_Image();
                    $imgModel->setAttributes($data);

                    if ($imgModel->save()){
                        $this->_flashmessage = array('status'=>'success', 'message'=> 'Image uploaded successfully');
                        header("location: ".$_SERVER['HTTP_REFERER']) ;
                        exit;
                    } else {
                        $message = "Cannot update the database with details";
                        $this->_flashmessage =  array('status'=>'error', 'message'=> $message);
                        return false;
                    }
                } catch (Exception $e){
                    $this->_flashmessage =  array('status'=>'error', 'message'=> 'Image cannot be upload: '.$e->getMessage());
                }
            }
        }

        $imgCount = 0;
        $id = func_get_arg(func_num_args()-1);

        //get the images added in for this package
        $model = new Package_Image();
        $imgDetails = $model->findByPackage($id);

        if (!$imgDetails){
            $pkgModel = new Package();
            $result = $pkgModel->getById($id);

            if ($result){
                $pkgDetails = $result['Package'];
            }
        } else {
            $pkgDetails = $imgDetails['Package'][$id];
            $imgList = $imgDetails['Package_image'];
            $imgCount = count($imgList);
        }

        if (!$pkgDetails){
            header("location: ".SITE_URL."admin/package/");
            exit;
        }

        $this->set('model',$pkgDetails);
        $this->set('imageList',$imgList);
        $this->set('imageCount',$imgCount);
        $this->set_pageTitle('Package: Manage Images');
        $this->set_pageType('package');

    }

    //this is an ajax call
    public function package_change_status(){

        if ($_POST){

            $id = $_POST['id'];
            $currentStatus = $_POST['data'];

            $model = new Package();
            $model->setId($id);
            $result = $model->toggleStatus($currentStatus);
            if ($result) {
                echo json_encode(array('result' => 'Success', 'message' => 'Status updated; set to ' . $result, 'response' => $result));
            } else {
                echo json_encode(array('result' => 'Error', 'message' => "Cannot update status"));
            }
        }
        exit;
    }

    public function package_delete(){

        if ($_POST){

            $id = $_POST['id'];
            $title = $_POST['title'];

            $model = new Package();
            $model->setId($id);

            try {
                if ($model->delete()) {
                    echo json_encode(array('status' => 'success', 'message' => "Package " . $_POST['title'] . " has been removed"));
                } else {
                    echo json_encode(array('status' => 'error', 'message' => "Failed removing package " . $_POST['title']));
                }
            } catch (Exception $e) {
                echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
            }
        }
        exit;
    }

    public function package_image_delete(){

        $id = $_POST['id'];

        $model = new Package_Image();
        $model->setId($id);

        try {
            if ($model->delete()) {
                echo json_encode(array('status' => 'success', 'message' => "Image successfully removed."));
            } else {
                echo json_encode(array('status' => 'error', 'message' => "Failed removing image."));
            }
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
        }
        exit;
    }

    /*************************************
     * Hotels
     *************************************/
    public function hotel()
    {
        $is_amenities = false;
        $is_policies = false;
        $images = 0;
        $tariff = 0;

        $hotelObj = new Hotel();
        $hotelList = $hotelObj->getAll();

        if ($hotelList){
            foreach($hotelList as &$hotel){
                //amenities
                $hotel['Hotel']['is_amenities'] =  (isset($hotel['Hotel']['amenities']) &&  $hotel['Hotel']['amenities'] != '') ? true : false;

                //tariff
                if ($hotel['Hotel_Tariff']){
                    $hotel['Hotel']['tariff_count'] = count($hotel['Hotel_Tariff']);
                } else {
                    $hotel['Hotel']['tariff_count'] = 0;
                }

                //policies
                if ($hotel['policy_occupancy'] || $hotel['policy_room_terms'] || $hotel['policy_cancellation']){
                    $hotel['Hotel']['policies'] = true;
                } else {
                    $hotel['Hotel']['policies'] = false;
                }

                //images
                $imgObj = new Hotel_Image();
                $imgList = $imgObj->getByHotel($hotel['Hotel']['id']);
                $images = count($imgList['Hotel_image']);
                $hotel['Hotel']['image_count'] = $images;

            }
        }
        $this->set('hotels',$hotelList);
        $this->set_pageTitle('Hotels');
        $this->set_pageType('hotel');
        $this->set('addUrl',SITE_URL.'/admin/hotel_add/');

    }

    public function hotel_add(){
        if ( $_POST && $_POST['form_action'] == 'add' ) {

            $data = $_POST;

            if ($this->save_hotel_details($data)){
                #return that all data has been saved
                $_SESSION['message'] = "Hotel details for " . $data['hotel_name'] . " added successfully";
                header("location:" . SITE_URL . "/admin/hotel/");
                exit;
            } else {
                $this->set('error', "Cannot save details for hotel " . $data['hotel_name']);
            }
        }

        $this->set('amenities',UTILS::hotelAmenities());
        $this->set_pageTitle('Hotel: Add Hotels');
        $this->set('action', 'add');
        $this->set_pageType('hotel');
        $this->setTemplate('hotel_form');
    }

    public function hotel_edit(){

        if ($_POST && $_POST['form_action'] == 'edit') {
            $data = $_POST;

            #save form data
            if ($this->save_hotel_details($data)) {

                #return that all data has been saved
                $_SESSION['message'] = "Hotel details for " . $data['hotel_name'] . " updated successfully";
                header("location:" . SITE_URL . "/admin/hotel/");
                exit;
            } else {
                $this->set('error', "Cannot save details for hotel " . $data['hotel_name']);
            }
        }

        $hotelObj = new Hotel();
        $hotel_id = func_get_arg(func_num_args()-1);
        $hotelObj->id = $hotel_id;
        $hotelDetails = $hotelObj->getById();

        if (!$hotelDetails){
            $_SESSION['error'] = "Requsted hotel was not found";
            header("location: ". SITE_URL . "/admin/hotel/");
            exit;
        }

        $this->set('amenities',UTILS::hotelAmenities());
        $this->set('hotel',$hotelDetails['Hotel']);
        $this->set_pageTitle('Hotel: Edit Hotels');
        $this->set('action', 'edit');
        $this->set_pageType('hotel');
        $this->setTemplate('hotel_form');
    }

    public function hotel_image(){

        if ($_POST && $_POST['form_action'] == 'uploadImage'){
            if ($_POST['hotel_id'] && $_FILES['image']['error'] == 0){

                $data = $_POST;
                try{
                    $result = $this->save_hotel_images($data);
                    if(!$result){
                        $this->_flashmessage =  array('status'=>'error', 'message'=> 'Failed uploading image');
                    }  else {
                        $this->_flashmessage = array('status'=>'success', 'message'=> 'Image uploaded successfully');
                        header("location: ".$_SERVER['HTTP_REFERER']) ;
                        exit;
                    }
                } catch (Exception $e){
                    $this->_flashmessage =  array('status'=>'error', 'message'=> 'Image cannot be upload: '.$e->getMessage());
                }
            }
        }


        $hotel_id = func_get_arg(func_num_args()-1);
        $imageCount = 0;

        //get the hotel details for the said id
        $hotelImageObj = new Hotel_Image();
        $details = $hotelImageObj->getByHotel($hotel_id);

        //if details not there; i.e. no images already added
        //get the hotel details from the hotel database
        if (!$details){
            $hotelObj = new Hotel();
            $hotelObj->setId($hotel_id);
            $result = $hotelObj->getById();

            if ($result){
                $hotelDetails = $result['Hotel'];
            }
        } else {
            $hotelDetails = $details['Hotel'][$hotel_id];
            $imageList = $details['Hotel_image'];
            $imageCount = count($imageList);
        }


        if (!$hotelDetails){
            header("location: ".SITE_URL."admin/hotel/");
            exit;
        }

        $this->set('hotel',$hotelDetails);
        $this->set('imageList',$imageList);
        $this->set('imageCount',$imageCount);
        $this->set_pageTitle('Hotel: Manage Images');
        $this->set_pageType('hotel');
    }

    public function hotel_tariff(){
        if ($_POST) {

            $data = $_POST;
            $basic['hotel_id'] = $data['hotel_id'];
            $basic['season_name'] = $data['season'];
            $basic['date_start'] = date('Y-m-d h:i:s', strtotime($data['date_start']));
            $basic['date_end'] = date('Y-m-d h:i:s', strtotime($data['date_end']));
            $basic['date_added'] = date('Y-m-d h:i:s');

            if ($data['tariff']){
                $tariffList = array();
                foreach($data['tariff'] as $tariff){
                    if (!empty($tariff['room_type'])){
                        $tariffList[] = array_merge($basic,$tariff);
                    }
                }
            }

            $tariffObj = new Hotel_Tariff();
            if ( $tariffObj->saveAll($tariffList) ){
                //redirect the page
                header("location: ".SITE_URL."/admin/hotel_tariff/".$_POST['hotel_id']);
                exit;
            } else {
                echo "Cannot save hotel tariff";
            }
        }

        $hotelObj = new Hotel();
        $hotel_id = func_get_arg(func_num_args()-1);

        $hotelObj->id = $hotel_id;
        $hotelDetails = $hotelObj->getById();

        #list of all pages which are already loaded
        $this->set('hotel',$hotelDetails['Hotel']);
        $this->set_pageTitle('Hotel: Seasons & Tariff');
        $this->set_pageType('hotel');
        $this->setTemplate('hotel_tariff');
    }

    public function get_season_list(){

        //ajax call so no template required
        $this->doNotRenderHeader = true;

        $hotel_id = func_get_arg(func_num_args()-1);

        $tariffObj = new Hotel_tariff();
        $seasonList = $tariffObj->getSeasons($hotel_id);

        //print_r($seasonList);

        if ($seasonList){
            $this->set('list',$seasonList);
        }
    }

    //this is an ajax call
    public function hotel_change_status(){

        if ($_POST){

            $hotel_id = $_POST['id'];
            $currentStatus = $_POST['data'];

            $hotelObj = new Hotel();
            $hotelObj->setId($hotel_id);
            $result = $hotelObj->toggleStatus($currentStatus);
            if ($result) {
                echo json_encode(array('result' => 'Success', 'message' => 'Status updated; set to ' . $result, 'response' => $result));
            } else {
                echo json_encode(array('result' => 'Error', 'message' => "Cannot update status"));
            }
        }
        exit;
    }

    public function hotel_delete(){

        if ($_POST){

            $id = $_POST['id'];
            $title = $_POST['title'];

            $hotelObj = new Hotel();
            $hotelObj->setId($id);

            try {
                if ($hotelObj->delete()) {
                    echo json_encode(array('status' => 'success', 'message' => "Hotel " . $_POST['title'] . " has been removed"));
                } else {
                    echo json_encode(array('status' => 'error', 'message' => "Failed removing hotel " . $_POST['title']));
                }
            } catch (Exception $e) {
                echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
            }
        }
        exit;
    }

    public function hotel_image_delete(){

        $imageId = $_POST['id'];

        $imageObj = new Hotel_Image();
        $imageObj->setId($imageId);

        try {
            if ($imageObj->delete()) {
                echo json_encode(array('status' => 'success', 'message' => "Image successfully removed."));
            } else {
                echo json_encode(array('status' => 'error', 'message' => "Failed removing image."));
            }
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
        }
        exit;
    }

    public function tariff_delete(){
        if ($_POST){
            if (isset($_POST['id'])){
                $tariff_id = $_POST['id'];

                $tariffObj = new Hotel_Tariff();
                $tariffObj->setId($tariff_id);

                try {
                    if ($tariffObj->delete()) {
                        echo json_encode(array('status' => 'success', 'message' => "Hotel tariff for hotel id " . $hotel_id . " has been removed"));
                    } else {
                        echo json_encode(array('status' => 'error', 'message' => "Failed removing hotel tariff"));
                    }
                } catch (Exception $e) {
                    echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
                }




            }
        }
    }

     private function save_hotel_details($data){

        # check and save the hotel logo
        if ($_FILES['image']['tmp_name']) {
            $errorIdx = $_FILES['image']['error'];

            if ($errorIdx > 0) {
                $this->error = "Unable to save post. Cannot Upload Image";
                return false;
            }
            //now process this image
            $uploadFilename = Utils::uploadImage($_FILES['image'],'logo');
            if ($uploadFilename == true) {
                $data['hotel_logo'] = $uploadFilename;
            } else {
                $data['hotel_logo'] = '';
            }
        }

        # Set amenities and date of submission
        if ($data['amenities']){
            $data['amenities'] = json_encode($data['amenities']);
        }

        if ($data['form_action'] == 'add'){
            #set the date of submission
            $data['date_added'] = date('Y-m-d h:i:s');
        }

        #hotelObj
        $hotelObj = new Hotel();

        #save the data
        foreach($data as $field => $value){
            $hotelObj->{$field} = $value;
        }

        if ($hotelObj->save()){
            return true;
        } else {
            return false;
        }


    }

    private function save_hotel_images($data){

        if (!isset($data)){
            return false;
        }

        //check and upload image
        if ($_FILES['image']['tmp_name']) {
            $errorIdx = $_FILES['image']['error'];

            if ($errorIdx > 0) {
                $this->error = "Unable to save post. Cannot Upload Image";
                return false;
            }
            //now process this image
            $uploadFilename = Utils::uploadImage($_FILES['image'],$data['image_type']);
            if ($uploadFilename == true) {
                $data['image_name'] = $uploadFilename;
            } else {
                $this->error = "Some unknown error. Cannot retrieve uploaded file name";
                return false;
            }
        }

        $imageObj = new Hotel_Image();
        foreach($data as $field => $value){
            $imageObj->{$field} = $value;
        }

        if ($imageObj->save()){
            return true;
        } else {
            $this->error = "Cannot update the database with details";
            return false;
        }

    }

    /*************************************
     * Agents: Manage Agents
     *************************************/
    public function agents()
    {
        if($_SESSION['message'] || $_SESSION['error']){
            foreach($_SESSION as $key=>$value){
                if (in_array($key, array('message','error'))){
                    $this->set('message',$value);
                    $this->set('status',$key);
                    //unset($_SESSION[$key]);
                }
            }
        }

        $agentObj = new Agent();
        $counts = $agentObj->getCounts();


        //get list of all agents
        //order by the latest first
        $agentObj->orderBy('date_added','DESC');
        $agents = $agentObj->getAll();

        if ($agents){
            $agentList = array();
            foreach ($agents as $agent) {
                array_push($agentList, $agent['Agent']);
            }
        }

        $this->set_pageTitle('Manage Agents');
        $this->set_pageType('agents');
        $this->set('agents', $agentList);
        $this->set('counts', $counts);
    }

    /*************************************
     * Pages: Static Site Content
     *************************************/
    public function pages()
    {
        if($_SESSION['message'] || $_SESSION['error']){
            foreach($_SESSION as $key=>$value){
                if (in_array($key, array('message','error'))){
                    $this->set('message',$value);
                    $this->set('status',$key);
                    //unset($_SESSION[$key]);
                }
            }
        }

        $pageObj = new Page();
        $counts = $pageObj->getCounts();

        $pages = $pageObj->getAll();

        if ($pages){
            $pageList = array();
            foreach ($pages as $page) {
                array_push($pageList, $page['Page']);
            }
        }

        $this->set_pageTitle('Static Site Content');
        $this->set_pageType('pages');
        $this->set('addUrl',SITE_URL.'/admin/pages_add/');
        $this->set('pages', $pageList);
        $this->set('counts', $counts);
    }

    public function pages_add()
    {
        if ($_POST) {
            $data = $_POST;

            #save form data
            if ($this->save_page($data)) {

                #return that all data has been saved
                $_SESSION['message'] = "Page " . $data['title'] . " added successfully";
                header("location:" . SITE_URL . "/admin/pages/");
                exit;
            } else {
                $this->set('error', "Cannot add page content for " . $data['title']);
            }
        }

        $page = new Page();

        #list of all pages which are already loaded
        $pageList = $page->getListSimple();
        if ($pageList){
            $this->set('pageList', $pageList);
        }

        $this->set_pageTitle('Static Site Content');
        $this->set('action', 'add');
        $this->set_pageType('pages');
        $this->setTemplate('page_form');
    }

    public function pages_edit()
    {
        if ($_POST && $_POST['form_action'] == 'edit') {

            $data = $_POST;
            #save form data
            if ($this->save_page($data)) {

                #return that all data has been saved
                $_SESSION['message'] = "Page " . $data['title'] . " updated successfully";
                header("location:" . SITE_URL . "/admin/pages/");
                exit;
            } else {
                $this->set('error', "Cannot update page " . $data['title']);
            }
        }

        $page = new Page();

        #details of the selected recipe
        $page_id = func_get_arg(func_num_args()-1);

        #list of all pages which are already loaded
        $pageList = $page->getListSimple();

        #get the page detail
        $page->setId($page_id);
        $pageDetails = $page->getById();

        if (!$pageDetails){
            $_SESSION['error'] = "Requsted page was not found";
            header("location: ". SITE_URL . "/admin/pages/");
            exit;
        }

        $parent_id = $pageDetails['Page']['parent_id'];

        $this->set_pageTitle('Static Site Content');
        $this->set('pagelist', $pageList);
        $this->set('parent_id',array($parent_id));
        $this->set('page', $pageDetails['Page']);
        $this->set('action', 'edit');
        $this->set_pageType('pages');
        $this->setTemplate('page_form');
    }

    public function pages_delete()
    {
        $this->doNotRenderHeader = 1;

        $id = $_POST['id'];
        $name = $_POST['name'];

        $page = new Page();
        $page->setId($id);

        //TODO: remove all images and video of this recipe to conserve space

        try {
            if ($page->delete()) {
                echo json_encode(array('status' => 'success', 'message' => "Page " . $_POST['name'] . " has been removed"));
            } else {
                echo json_encode(array('status' => 'error', 'message' => "Failed removing page content " . $_POST['name']));
            }

        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
        }
        die;
    }

    public function page_change_status(){
        $this->doNotRenderHeader = 1;
        if ($_POST) {

            $id = $_POST['id'];
            $action = $_POST['action'];
            $oldStatus = $_POST['data'];

            $pageObj = new Page();
            $pageObj->setId($id);

            $result = $pageObj->updateStatus($oldStatus);

            if ($result) {
                echo json_encode(array('result' => 'Success', 'message' => 'Page Status updated set to ' . $result, 'response' => $result));
                exit;
            } else {
                echo json_encode(array('result' => 'Error', 'message' => "Cannot update page status"));
                exit;
            }
        }

    }

    public function save_page($data)
    {
        /* add the image */
        #check if file is uploaded
        if ($_FILES['image']['tmp_name']) {
            $errorIdx = $_FILES['image']['error'];

            if ($errorIdx > 0) {
                $this->error = "Unable to save post. Cannot Upload Image";
                return false;
            }
            //now process this image
            $uploadFilename = Utils::uploadImage($_FILES['image'],'content');
            if ($uploadFilename == true) {
                $data['image'] = $uploadFilename;
            } else {
                $data['image'] = '';
            }
        }

        if (!$data['slug'] || empty($data['slug'])) {
            $data['slug'] = isset($data['title']) ? Utils::createSEF($data['title']) : '';
        }

        #create the url
        $data['url'] = "/".$data['slug']."/";

        #check for status
        $data['status'] = ( isset($data['status']) && !empty($data['status'])) ? $data['status'] : 'active';

        #instantiate class and save data
        $page = new Page();

        foreach ($data as $key => $value) {
            $page->{$key} = trim($value);
        }

        try {
            if ($page->save()) {
                if ($page->insert_id) {
                    return $page->insert_id;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            return false;
        }
    }

    /*************************************
     * TODO: Settings
     *************************************/

    public function settings(){
        $this->set_pageTitle('Settings');
        $this->set_pageType('settings');
    }


    /*************************************
     * admin specific / general methods
     *************************************/
    /**
     * @throws Exception
     */
    public function login()
    {
        $this->doNotRenderHeader = 1;

        if ($_POST && $_POST['mm_action'] === 'doLogin') {

            try {
                #first validate posted data
                if ($this->validate($_POST)) {
                    #execute login process

                    $admin = $this->Admin->doLogin($_POST);

                    if ($admin) {

                        $loginHash = md5($admin[0]['Admin']['id'] . "|" . $admin[0]['Admin']['first_name']);

                        $_SESSION['isAdminLoggedIn'] = true;
                        $_SESSION['admin'] = $admin[0]['Admin']['id'] . '.' . $loginHash;


                        #redirect to index page
                        header("location:" . SITE_URL . "/admin/");
                        exit;

                    } else {
                        throw new Exception('Invalid login details. Please try again');
                    }
                }
            } catch (Exception $e) {
                echo $message = $e->getMessage();
            }
        }
    }

    private function isLoggedIn()
    {

        if (isset($_SESSION['isAdminLoggedIn']) && ($_SESSION['isAdminLoggedIn'] == true)) {

            #get the admin details
            list($id, $hash) = explode('.', $_SESSION['admin']);

            if ((!$this->_admin_hash) || is_null($this->_admin_hash)) {
                #get the details of this admin
                #create hashes and store
                $this->_admin_id = $id;
                $this->_admin_hash = $hash;
            }

            //match hashes and return true
            if (($hash == $this->_admin_hash) && ($id == $this->_admin_id)) {
                return true;
            }

        }
        return false;
    }

    /**
     * @param $var
     * @return bool
     * @throws Exception
     */
    private function validate($var)
    {
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
     * Function to check the password
     * @PARAMS : admin user ID,password
     * @RETURN : BOOL TRUE/FALSE
     */
    public function check_passW()
    {
        global $db;
        $sQl = "SELECT password FROM admins WHERE id = '" . $_SESSION['adminId'] . "'";
        $result = $db->get_row($sQl);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function logout()
    {
        unset($_SESSION['isAdminLoggedIn']);
        unset($_SESSION['loggedAdminId']);

        #return to the index page
        header("location:" . SITE_URL . "/admin/");
        exit;
    }

    public function getNavigation()
    {
        $navigation = array(
            'dashboard' => array('url' => SITE_URL . '/admin/', 'name' => 'Dashboard'),
            'hotel' => array('url' => SITE_URL . '/admin/hotel/', 'name' => 'Hotels'),
            'bookings' => array('url' => SITE_URL . '/admin/bookings/', 'name' => 'Bookings'),
            'visa' => array('url' => SITE_URL . '/admin/visa/', 'name' => 'Visa'),
            'package' => array('url' => SITE_URL . '/admin/package/', 'name' => 'Packages'),
            'agents' => array('url' => SITE_URL . '/admin/agents/', 'name' => 'Agents'),
            'pages' => array('url' => SITE_URL . '/admin/pages/', 'name' => 'Pages'),
            //'settings' => array('url' => SITE_URL . '/admin/settings/', 'name' => 'Settings'),
        );
        return $navigation;
    }

    public function getDetails()
    {

    }

    /**
     * Set Welcome HTML text
     */
    public function setWelcomeNote()
    {
        if ($this->_admin_id) {
            $this->Admin->id = $this->_admin_id;
            $result = $this->Admin->getById();
            $this->welcome_note = sprintf('%s | <a href="%s">Logout</a>', $result['Admin']['first_name'], SITE_URL . "/admin/logout/");
        }
    }

    /**
     * @return mixed
     */
    public function getWelcomeNote()
    {
        if (!$this->welcome_note) {
            $this->setWelcomeNote();
        }
        return $this->welcome_note;
    }

    public function createSEF()
    {
        $this->doNotRenderHeader = 1;
        if (isset($_POST['str'])){
            $str = $_POST['str'];
        } else {
            if (func_get_args()){
                $str = func_get_arg(0);
            }
        }

        if ($str) {
            echo Utils::createSEF( $str );
            die;
        } else {
            die;
        }
    }

}
