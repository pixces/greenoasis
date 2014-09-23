<?php

/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 30/12/12
 * Time: 12:41 AM
 * To change this template use File | Settings | File Templates.
 */
class AdminController extends Controller {

    private $_admin_id;
    private $_admin_hash;
    private $welcome_note;
    public $_message = "";
    public $_message_status = "";
    private $imageFilename;
    private $error;

    public function beforeAction() {
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
        if ($this->_request['is_ajax']) {
            $this->doNotRenderHeader = true;
        }
    }

    public function afterAction() {
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

    public function index() {
        //$this->set('hotels',$hotelList);
        $this->set_pageTitle('Admin:Dashboard');
        $this->set_pageType('dashboard');
        $dashBoardData = self::loadDashboard();
        $this->set('dashBoardData', $dashBoardData);
    }

    /*     * ***********************************
     * Packages
     * *********************************** */
    public function package() {

        $images = 0;
        $packageObj = new Package();
        $packageList = $packageObj->getAll();
        $categoryOptions = $packageObj->getCategoryOptions();

        foreach ($packageList as &$package) {
            $package['Package']['category'] = $categoryOptions[$package['Package']['category']];
            $package['Package']['description'] = UTILS::smartSubStr($package['Package']['description'], 250);

            //set the package rates
            if (count($package['Package_Rate'])) {
                $package['Package']['price'] = $package['Package_Rate'][0]['Package_Rate']['price'];
            }

            //set the default image
            if (count($package['Package_Image'])) {
                $package['Package']['image'] = $package['Package_Image'][0]['Package_Image']['image_name'];
            } else {
                $package['Package']['image'] = 'no-image.png';
            }
        }
        $this->set('packages', $packageList);
        $this->set_pageTitle('Packages');
        $this->set_pageType('package');
        $this->set('addUrl', SITE_URL . '/admin/package_add/');
    }

    public function package_add() {

        $package = new Package();

        if ($_POST && $_POST['form_action'] == 'add' && $_POST['package']) {
            $error = 0;
            $data_times = $_POST['package']['time'];
            $data_rates = $_POST['package']['rate'];

            $package->setAttributes($_POST['package']);


            if ($package->save()) {
                $package_id = $package->insert_id;

                //save package times
                $packageTime = new Package_Time();
                $packageRate = new Package_Rate();
                try {
                    //save data for rates
                    $packageRate->saveAll($data_rates, $package_id);
                    //save data for times
                    try {
                        $packageTime->saveAll($data_times, $package_id);
                    } catch (Exception $e) {
                        $this->setFlash($e->getMessage(), 'e');
                    }
                } catch (Exception $e) {
                    $this->setFlash($e->getMessage(), 'e');
                }
                $this->setFlash('Package ' . $_POST['package']['title'] . ' successfully added.', 's');
            } else {
                $this->setFlash('Cannot save package ' . $_POST['package']['title'], 'e');
            }
            header("location:" . SITE_URL . "/admin/package/");
            exit;
        }

        $this->set_pageTitle('Packages: Add Package');
        $this->set('categoryOptions', $package->getCategoryOptions());
        $this->set('action', 'add');
        $this->set_pageType('package');
        $this->setTemplate('package_form');
    }

    public function package_edit() {

        $package = new Package();

        if ($_POST && $_POST['form_action'] == 'edit' && $_POST['package']) {
            $error = 0;
            $data_times = $_POST['package']['time'];
            $data_rates = $_POST['package']['rate'];
            $package_id = $_POST['package']['id'];

            $package->setAttributes($_POST['package']);


            if ($package->save()) {

                //save package times
                $packageTime = new Package_Time();
                $packageRate = new Package_Rate();
                try {
                    //save data for rates
                    $packageRate->saveAll($data_rates, $package_id);


                    try {
                        //save data for times
                        $packageTime->saveAll($data_times, $package_id);
                    } catch (Exception $e) {
                        $this->setFlash($e->getMessage(), 'e');
                    }
                } catch (Exception $e) {
                    $this->setFlash($e->getMessage(), 'e');
                }
                $this->setFlash('Package ' . $_POST['package']['title'] . ' successfully added.', 's');
            } else {
                $this->setFlash('Cannot save package ' . $_POST['package']['title'], 'e');
            }
            header("location:" . SITE_URL . "/admin/package/");
            exit;
        }


        $id = func_get_arg(func_num_args() - 1);

        $model = $package->getById($id);

        $this->set('model', $model);
        $this->set('categoryOptions', $package->getCategoryOptions());
        $this->set_pageTitle('Package: Edit');
        $this->set('action', 'edit');
        $this->set_pageType('package');
        $this->setTemplate('package_form');
    }

    public function package_image() {

        if ($_POST && $_POST['form_action'] == 'uploadImage') {
            if ($_POST['package_id'] && $_FILES['image']['error'] == 0) {
                $data = $_POST;

                try {
                    //check and upload image
                    if ($_FILES['image']['tmp_name']) {
                        $errorIdx = $_FILES['image']['error'];

                        if ($errorIdx > 0) {
                            $this->error = "Unable to save post. Cannot Upload Image";
                            return false;
                        }
                        //now process this image
                        $uploadFilename = Utils::uploadImage($_FILES['image'], 'package');
                        if ($uploadFilename == true) {
                            $data['image_name'] = $uploadFilename;
                        } else {
                            $this->error = "Some unknown error. Cannot retrieve uploaded file name";
                            return false;
                        }
                    }

                    $imgModel = new Package_Image();
                    $imgModel->setAttributes($data);

                    if ($imgModel->save()) {
                        $this->_flashmessage = array('status' => 'success', 'message' => 'Image uploaded successfully');
                        header("location: " . $_SERVER['HTTP_REFERER']);
                        exit;
                    } else {
                        $message = "Cannot update the database with details";
                        $this->_flashmessage = array('status' => 'error', 'message' => $message);
                        return false;
                    }
                } catch (Exception $e) {
                    $this->_flashmessage = array('status' => 'error', 'message' => 'Image cannot be upload: ' . $e->getMessage());
                }
            }
        }

        $imgCount = 0;
        $id = func_get_arg(func_num_args() - 1);

        //get the images added in for this package
        $model = new Package_Image();
        $imgDetails = $model->findByPackage($id);

        if (!$imgDetails) {
            $pkgModel = new Package();
            $result = $pkgModel->getById($id);

            if ($result) {
                $pkgDetails = $result['Package'];
            }
        } else {
            $pkgDetails = $imgDetails['Package'][$id];
            $imgList = $imgDetails['Package_image'];
            $imgCount = count($imgList);
        }

        if (!$pkgDetails) {
            header("location: " . SITE_URL . "admin/package/");
            exit;
        }

        $this->set('model', $pkgDetails);
        $this->set('imageList', $imgList);
        $this->set('imageCount', $imgCount);
        $this->set_pageTitle('Package: Manage Images');
        $this->set_pageType('package');
    }

    //this is an ajax call
    public function package_change_status() {

        if ($_POST) {

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

    //this is an ajax call
    public function package_featured() {

        if ($_POST) {

            $id = $_POST['id'];
            $currentState = $_POST['data'];

            $model = new Package();
            $model->setId($id);
            $result = $model->updateField('featured', $currentState);
            if ($result !== false) {
                echo json_encode(array('result' => 'Success', 'message' => 'Package updated; featured set to ' . $result, 'response' => $result));
            } else {
                echo json_encode(array('result' => 'Error', 'message' => "Cannot update package"));
            }
        }
        exit;
    }

    public function package_delete() {

        if ($_POST) {

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

    public function package_image_delete() {

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

    /*     * ***********************************
     * Hotels
     * *********************************** */

    public function hotel() {
        $is_amenities = false;
        $is_policies = false;
        $images = 0;
        $tariff = 0;

        $hotelObj = new Hotel();
        $hotelList = $hotelObj->getAll();

        if ($hotelList) {
            foreach ($hotelList as &$hotel) {
                //amenities
                $hotel['Hotel']['is_amenities'] = (isset($hotel['Hotel']['amenities']) && $hotel['Hotel']['amenities'] != '') ? true : false;

                //tariff
                if ($hotel['Hotel_Tariff']) {
                    $hotel['Hotel']['tariff_count'] = count($hotel['Hotel_Tariff']);
                } else {
                    $hotel['Hotel']['tariff_count'] = 0;
                }

                //policies
                if ($hotel['policy_occupancy'] || $hotel['policy_room_terms'] || $hotel['policy_cancellation']) {
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
        $this->set('hotels', $hotelList);
        $this->set_pageTitle('Hotels');
        $this->set_pageType('hotel');
        $this->set('addUrl', SITE_URL . '/admin/hotel_add/');
    }

    public function hotel_add() {
        if ($_POST && $_POST['form_action'] == 'add') {

            $data = $_POST;

            if ($this->save_hotel_details($data)) {
                #return that all data has been saved
                $_SESSION['message'] = "Hotel details for " . $data['hotel_name'] . " added successfully";
                header("location:" . SITE_URL . "/admin/hotel/");
                exit;
            } else {
                $this->set('error', "Cannot save details for hotel " . $data['hotel_name']);
            }
        }

        $this->set('amenities', UTILS::hotelAmenities());
        $this->set_pageTitle('Hotel: Add Hotels');
        $this->set('action', 'add');
        $this->set_pageType('hotel');
        $this->setTemplate('hotel_form');
    }

    public function hotel_edit() {

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
        $hotel_id = func_get_arg(func_num_args() - 1);
        $hotelObj->id = $hotel_id;
        $hotelDetails = $hotelObj->getById();

        if (!$hotelDetails) {
            $_SESSION['error'] = "Requsted hotel was not found";
            header("location: " . SITE_URL . "/admin/hotel/");
            exit;
        }

        $this->set('amenities', UTILS::hotelAmenities());
        $this->set('hotel', $hotelDetails['Hotel']);
        $this->set_pageTitle('Hotel: Edit Hotels');
        $this->set('action', 'edit');
        $this->set_pageType('hotel');
        $this->setTemplate('hotel_form');
    }

    public function hotel_image() {

        if ($_POST && $_POST['form_action'] == 'uploadImage') {
            if ($_POST['hotel_id'] && $_FILES['image']['error'] == 0) {

                $data = $_POST;
                try {
                    $result = $this->save_hotel_images($data);
                    if (!$result) {
                        $this->_flashmessage = array('status' => 'error', 'message' => 'Failed uploading image');
                    } else {
                        $this->_flashmessage = array('status' => 'success', 'message' => 'Image uploaded successfully');
                        header("location: " . $_SERVER['HTTP_REFERER']);
                        exit;
                    }
                } catch (Exception $e) {
                    $this->_flashmessage = array('status' => 'error', 'message' => 'Image cannot be upload: ' . $e->getMessage());
                }
            }
        }


        $hotel_id = func_get_arg(func_num_args() - 1);
        $imageCount = 0;

        //get the hotel details for the said id
        $hotelImageObj = new Hotel_Image();
        $details = $hotelImageObj->getByHotel($hotel_id);

        //if details not there; i.e. no images already added
        //get the hotel details from the hotel database
        if (!$details) {
            $hotelObj = new Hotel();
            $hotelObj->setId($hotel_id);
            $result = $hotelObj->getById();

            if ($result) {
                $hotelDetails = $result['Hotel'];
            }
        } else {
            $hotelDetails = $details['Hotel'][$hotel_id];
            $imageList = $details['Hotel_image'];
            $imageCount = count($imageList);
        }


        if (!$hotelDetails) {
            header("location: " . SITE_URL . "admin/hotel/");
            exit;
        }

        $this->set('hotel', $hotelDetails);
        $this->set('imageList', $imageList);
        $this->set('imageCount', $imageCount);
        $this->set_pageTitle('Hotel: Manage Images');
        $this->set_pageType('hotel');
    }

    public function hotel_tariff() {
        if ($_POST) {
            $error = false;

            //default room count
            $roomCount = 20;

            $data = $_POST;
            $basic['hotel_id'] = $data['hotel_id'];
            $basic['season_name'] = $data['season'];
            $basic['date_start'] = date('Y-m-d h:i:s', strtotime($data['date_start']));
            $basic['date_end'] = date('Y-m-d h:i:s', strtotime($data['date_end']));
            $basic['date_added'] = date('Y-m-d h:i:s');

            if ($data['tariff']) {
                $tariffList = array();
                $t = 0;
                foreach ($data['tariff'] as $tariff) {
                    if (!empty($tariff['room_type'])) {
                        //set the occupancy
                        $occupancy = array();
                        foreach ($tariff as $key => $val) {
                            if (in_array($key, array('single', 'double', 'triple', 'unit'))) {
                                if (!is_null($val) && $val != '' && $val) {
                                    $occupancy['occupancy'][] = array(
                                        'occupancy_type' => $key,
                                        'room_rate' => $val,
                                        'room_count' => (isset($tariff['room_count'])) ? $tariff['room_count'] : $roomCount,
                                    );
                                }
                            }
                        }

                        $tariffList[] = array_merge($basic, $tariff, $occupancy);
                    }
                }
            }

            $tariffObj = new Hotel_Tariff();
            $modelOccupancy = new Hotel_Occupancy();

            foreach ($tariffList as $entity) {
                $hotelOccupancies = $entity['occupancy'];
                $tariffObj->setAttributes($entity);

                if ($tariffObj->save()) {
                    //get the inserted tariffId
                    $tariffId = $tariffObj->insert_id;

                    //populate this id in the occupancy list
                    foreach ($hotelOccupancies as &$occupancy) {
                        $occupancy['hotel_tariff_id'] = $tariffId;
                    }


                    //save all the occupancies
                    if (!$modelOccupancy->saveAll($hotelOccupancies)) {
                        $error = true;
                        echo "Cannot save occupancy details for Tariff Id " . $tariffId;
                    }
                } else {
                    $error = true;
                    echo "Cannot save the Tariff details for Season " . $entity['season_name'];
                }
            }

            if (!$error) {
                header("location: " . SITE_URL . "/admin/hotel_tariff/" . $_POST['hotel_id']);
                exit;
            }
        }

        $hotelObj = new Hotel();
        $hotel_id = func_get_arg(func_num_args() - 1);

        $hotelObj->id = $hotel_id;
        $hotelDetails = $hotelObj->getById();

        #list of all pages which are already loaded
        $this->set('hotel', $hotelDetails['Hotel']);
        $this->set_pageTitle('Hotel: Seasons & Tariff');
        $this->set_pageType('hotel');
        $this->setTemplate('hotel_tariff');
    }

    public function get_season_list() {

        //ajax call so no template required
        $this->doNotRenderHeader = true;

        $hotel_id = func_get_arg(func_num_args() - 1);

        $tariffObj = new Hotel_tariff();
        $seasonList = $tariffObj->getSeasons($hotel_id);

        //print_r($seasonList);

        if ($seasonList) {
            $this->set('list', $seasonList);
        }
    }

    //this is an ajax call
    public function hotel_change_status() {

        if ($_POST) {

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

    public function hotel_delete() {

        if ($_POST) {

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

    public function hotel_image_delete() {

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

    public function tariff_delete() {
        if ($_POST) {
            if (isset($_POST['id'])) {
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

    private function save_hotel_details($data) {

        # check and save the hotel logo
        if ($_FILES['image']['tmp_name']) {
            $errorIdx = $_FILES['image']['error'];

            if ($errorIdx > 0) {
                $this->error = "Unable to save post. Cannot Upload Image";
                return false;
            }
            //now process this image
            $uploadFilename = Utils::uploadImage($_FILES['image'], 'logo');
            if ($uploadFilename == true) {
                $data['hotel_logo'] = $uploadFilename;
            } else {
                $data['hotel_logo'] = '';
            }
        }

        # Set amenities and date of submission
        if ($data['amenities']) {
            $data['amenities'] = json_encode($data['amenities']);
        }

        if ($data['form_action'] == 'add') {
            #set the date of submission
            $data['date_added'] = date('Y-m-d h:i:s');
        }

        #hotelObj
        $hotelObj = new Hotel();

        #save the data
        foreach ($data as $field => $value) {
            $hotelObj->{$field} = $value;
        }

        if ($hotelObj->save()) {
            return true;
        } else {
            return false;
        }
    }

    private function save_hotel_images($data) {

        if (!isset($data)) {
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
            $uploadFilename = Utils::uploadImage($_FILES['image'], $data['image_type']);
            if ($uploadFilename == true) {
                $data['image_name'] = $uploadFilename;
            } else {
                $this->error = "Some unknown error. Cannot retrieve uploaded file name";
                return false;
            }
        }

        $imageObj = new Hotel_Image();
        foreach ($data as $field => $value) {
            $imageObj->{$field} = $value;
        }

        if ($imageObj->save()) {
            return true;
        } else {
            $this->error = "Cannot update the database with details";
            return false;
        }
    }

    /*     * ***********************************
     * Bookings
     * *********************************** */
    public function bookings() {
        $this->set_pageTitle('Hotel: Bookings');
        $this->set_pageType('bookings');

        $hotelResObj = new Hotel_Reservation();
        $counts = $hotelResObj->getCounts();

        //  $hotelResObj->setCurDate();
        $hotelResObj->orderBy('date_added', 'DESC');

        $hotelreservations = $hotelResObj->getAll();

        $this->set('hotelReservations', $hotelreservations);
        $this->set('counts', $counts);
    }

    public function view_booking() {
        $this->doNotRenderHeader = true;
        $bookingId = func_get_arg(func_num_args() - 1);

        //get the details of this booking id
        $hoteResObj = new Hotel_Reservation();
        $hoteResObj->setId($bookingId);
        $details = $hoteResObj->getById();
        $this->set('booking', $details);
    }

    /* ***********************************
     * Visa
     * ***********************************/
    public function visa() {
        $this->set_pageTitle('Visa');
        $this->set_pageType('visa');

        $model = new Visa();
        $counts = $model->getCounts();
        $model->orderBy('date_added', 'DESC');
        $visaList = $model->getAll();

        $this->set('addUrl', SITE_URL . '/admin/visa_add/');
        $this->set('visas', $visaList);
        $this->set('counts', $counts);
    }

    public function visa_add(){
        $model = new Visa();

        if ($_POST && $_POST['form_action'] == 'add' && $_POST['visa']) {
            $error = 0;
            $model->setAttributes($_POST['visa']);

            if ($model->save()) {
                $this->setFlash('Visa ' . $_POST['visa']['title'] . ' successfully added.', 's');
            } else {
                $this->setFlash('Cannot save visa ' . $_POST['visa']['title'], 'e');
            }
            header("location:" . SITE_URL . "/admin/visa/");
            exit;
        }

        $this->set_pageTitle('Visa: Add Visa');
        $this->set('action', 'add');
        $this->set_pageType('visa');
        $this->setTemplate('visa_form');
    }

    public function visa_edit(){
        $model = new Visa();

        if ($_POST && $_POST['form_action'] == 'edit' && $_POST['visa']) {
            $error = 0;
            $model->setAttributes($_POST['visa']);

            if ($model->save()) {
                $this->setFlash('Visa ' . $_POST['visa']['title'] . ' successfully updated.', 's');
            } else {
                $this->setFlash('Cannot update visa ' . $_POST['visa']['title'], 'e');
            }
            header("location:" . SITE_URL . "/admin/visa/");
            exit;
        }

        $id = func_get_arg(func_num_args() - 1);
        $model->setId($id);

        $details = $model->getById();

        $this->set('model', $details['Visa']);
        $this->set_pageTitle('Visa: Edit Visa');
        $this->set('action', 'edit');
        $this->set_pageType('visa');
        $this->setTemplate('visa_form');
    }

    //this is an ajax call
    public function visa_change_status() {
        if ($_POST) {
            $id = $_POST['id'];
            $currentStatus = $_POST['data'];

            $model = new Visa();
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

    public function visa_bookings() {
        $this->set_pageTitle('Booking: Visa');
        $this->set_pageType('visa_bookings');

        $model = new Visa_Booking();
        $counts = $model->getCounts();
        //$visaObj->like("status", "approved");
        // $visaObj->setCurDate();
        $model->orderBy('date_added', 'DESC');
        $visaInfo = $model->getAll();

        $this->setTemplate('visa_bookings');
        $this->set('visaInfo', $visaInfo);
        $this->set('counts', $counts);
    }

    /*     * ***********************************
     * Agents: Manage Agents
     * *********************************** */

    public function agents() {
        if ($_SESSION['message'] || $_SESSION['error']) {
            foreach ($_SESSION as $key => $value) {
                if (in_array($key, array('message', 'error'))) {
                    $this->set('message', $value);
                    $this->set('status', $key);
                    //unset($_SESSION[$key]);
                }
            }
        }

        $agentObj = new Agent();
        $counts = $agentObj->getCounts();

        //get list of all agents
        //order by the latest first
        $agentObj->orderBy('date_added', 'DESC');
        $agents = $agentObj->getAll();

        /*
          if ($agents){
          $agentList = array();
          foreach ($agents as $agent) {
          array_push($agentList, array($agent['Agent'],$agent['summary']));
          }
          }

          print_r($agentList);
         */

        $this->set_pageTitle('Manage Agents');
        $this->set_pageType('agents');
        $this->set('agents', $agents);
        $this->set('counts', $counts);
    }

    /**
     * Method to approve an agent
     * Update the status to active/approved
     * Send approval email to the agent
     * Generate and update password into the database
     */
    public function agent_approve() {
        $this->doNotRenderHeader = 1;
        $agent_id = func_get_arg(func_num_args() - 1);

        if ($agent_id) {

            //new password
            $pass = Utils::generateCaptcha(8);

            $agentObj = new Agent();
            $agentObj->setId($agent_id);
            $agent = $agentObj->getById();

            $agent['Agent']['status'] = 'approved';
            $agent['Agent']['date_approved'] = date('Y-m-d h:i:s');
            $agent['Agent']['password'] = md5($pass);


            foreach ($agent['Agent'] as $key => $val) {
                $agentObj->{$key} = $val;
            }

            //update the details into the database
            if ($agentObj->save()) {

                Utils::sendAgentEmail(
                        array('email' => $agent['Agent']['email'], 'name' => $agent['Agent']['contact']), "Congratulation! Approved as GreenOasis Travel Agent", array('password' => $pass, 'name' => $agent['Agent']['contact']), 'agent_approval'
                );
            }
        }

        //redirect to the agents page
        #return that all data has been saved
        $_SESSION['message'] = "Agent " . $agent['company'] . " approved successfully";
        header("location:" . SITE_URL . "/admin/agents/");
        exit;
    }

    //this is an ajax call
    public function agent_change_status() {

        if ($_POST) {

            $agent_id = $_POST['id'];
            $currentStatus = $_POST['data'];

            $agentObj = new Agent();
            $agentObj->setId($agent_id);

            $result = $agentObj->toggleStatus($currentStatus);
            if ($result) {
                echo json_encode(array('result' => 'Success', 'message' => 'Status updated; set to ' . $result, 'response' => $result));
            } else {
                echo json_encode(array('result' => 'Error', 'message' => "Cannot update status"));
            }
        }
        exit;
    }

    /**
     * Method to remove agent
     * Called for both Reject/Delete action
     * removes agents record from the database
     */
    public function agent_delete() {
        
    }

    /**
     * Method to add funds to the agents wallet
     */
    public function agent_addFunds() {
        
    }

    /* * ***********************************
     * Pages: Static Site Content
     * *********************************** */
    public function pages() {
        if ($_SESSION['message'] || $_SESSION['error']) {
            foreach ($_SESSION as $key => $value) {
                if (in_array($key, array('message', 'error'))) {
                    $this->set('message', $value);
                    $this->set('status', $key);
                    //unset($_SESSION[$key]);
                }
            }
        }

        $pageObj = new Page();
        $counts = $pageObj->getCounts();

        $pages = $pageObj->getAll();

        if ($pages) {
            $pageList = array();
            foreach ($pages as $page) {
                array_push($pageList, $page['Page']);
            }
        }

        $this->set_pageTitle('Static Site Content');
        $this->set_pageType('pages');
        $this->set('addUrl', SITE_URL . '/admin/pages_add/');
        $this->set('pages', $pageList);
        $this->set('counts', $counts);
    }

    public function pages_add() {
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
        if ($pageList) {
            $this->set('pageList', $pageList);
        }

        $this->set_pageTitle('Static Site Content');
        $this->set('action', 'add');
        $this->set_pageType('pages');
        $this->setTemplate('page_form');
    }

    public function pages_edit() {
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
        $page_id = func_get_arg(func_num_args() - 1);

        #list of all pages which are already loaded
        $pageList = $page->getListSimple();

        #get the page detail
        $page->setId($page_id);
        $pageDetails = $page->getById();

        if (!$pageDetails) {
            $_SESSION['error'] = "Requsted page was not found";
            header("location: " . SITE_URL . "/admin/pages/");
            exit;
        }

        $parent_id = $pageDetails['Page']['parent_id'];

        $this->set_pageTitle('Static Site Content');
        $this->set('pagelist', $pageList);
        $this->set('parent_id', array($parent_id));
        $this->set('page', $pageDetails['Page']);
        $this->set('action', 'edit');
        $this->set_pageType('pages');
        $this->setTemplate('page_form');
    }

    public function pages_delete() {
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

    public function page_change_status() {
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

    public function save_page($data) {
        /* add the image */
        #check if file is uploaded
        if ($_FILES['image']['tmp_name']) {
            $errorIdx = $_FILES['image']['error'];

            if ($errorIdx > 0) {
                $this->error = "Unable to save post. Cannot Upload Image";
                return false;
            }
            //now process this image
            $uploadFilename = Utils::uploadImage($_FILES['image'], 'content');
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
        $data['url'] = "/" . $data['slug'] . "/";

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

    /* * ***********************************
     * Banners: Static Site Content
     * *********************************** */
    public function banners() {
        if ($_SESSION['message'] || $_SESSION['error']) {
            foreach ($_SESSION as $key => $value) {
                if (in_array($key, array('message', 'error'))) {
                    $this->set('message', $value);
                    $this->set('status', $key);
                    unset($_SESSION[$key]);
                }
            }
        }

        $bannerPath = Configurator::get('banner_img_dir');

        $bannerObj = new Banner();

        if (isset($_POST)){

            $this->error = false;
            $data = array();
            //upload the image
            if ($_FILES['banner']['tmp_name']) {
                $errorIdx = $_FILES['banner']['error'];

                if ($errorIdx > 0) {
                    $this->error = "Cannot Upload Banner";
                } else {
                    //check for the file extension
                    // Get the extension from the filename.
                    $imageExt = substr($_FILES['banner']['name'], strpos($_FILES['banner']['name'], '.'), strlen($_FILES['banner']['name']) - 1);
                    if (in_array(strtolower($imageExt), array('.jpg','.jpeg','.png'))){
                        //now process this image
                        $uploadFilename = Utils::uploadImage($_FILES['banner'], 'banner');
                        if ($uploadFilename == true) {
                            $data['filename'] = $uploadFilename;
                        } else {
                            $data['filename'] = '';
                        }
                    } else {
                        $this->error = "Invalid file type provided ".$_FILES['banner']['name'];
                    }
                }
            }

            //now do the data post
            if (!$this->error && !empty($data['filename'])){
                $data['status'] = 'active';
                $data['date_created'] = date('Y-m-d h:i:s');
                $data['title'] = $_POST['title'];
                $data['url'] = $_POST['url'];
                $data['type'] = $_POST['type'];

                foreach ($data as $key => $value) {
                    $bannerObj->{$key} = trim($value);
                }
                $bannerObj->save();

                //redirect to display
                header("location: " . SITE_URL . "/admin/banners");
                exit;
            }
        }

        $counts = $bannerObj->getCounts();
        $banners = $bannerObj->getAll();


        $this->set_pageTitle('Manage Banners');
        $this->set_pageType('banners');
        $this->set('banners', $banners);
        $this->set('path',$bannerPath);
        $this->set('counts', $counts);
        $this->set('errorMsg', $this->error);
    }

    public function banner_status() {
        $this->doNotRenderHeader = 1;
        if ($_POST) {
            $id = $_POST['id'];
            $action = $_POST['action'];
            $oldStatus = $_POST['data'];

            $bannerObj = new Banner();
            $bannerObj->setId($id);

            $result = $bannerObj->updateStatus($oldStatus);

            if ($result) {
                echo json_encode(array('result' => 'Success', 'message' => 'Page Status updated set to ' . $result, 'response' => $result));
                exit;
            } else {
                echo json_encode(array('result' => 'Error', 'message' => "Cannot update page status"));
                exit;
            }
        }
    }

    public function banner_delete() {
        $this->doNotRenderHeader = 1;
        if ($_POST) {

            $id = $_POST['id'];
            $title = $_POST['title'];
            $isAjax = $_POST['isAjax'];

            $model = new Banner();
            $model->setId($id);

            try {
                if ($model->delete()) {
                    echo json_encode(array('status' => 'success', 'message' => "Banner " . $title . " has been deleted"));
                } else {
                    echo json_encode(array('status' => 'error', 'message' => "Failed removing banner " . $title));
                }
            } catch (Exception $e) {
                echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
            }
        }
        exit;
    }

    /* * ***********************************
     * TODO: Settings
     * *********************************** */
    public function settings() {
        $this->set_pageTitle('Settings');
        $this->set_pageType('settings');
    }

    /* * ***********************************
     * admin specific / general methods
     * *********************************** */
    /**
     * @throws Exception
     */
    public function login() {
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

    private function isLoggedIn() {

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
     * Function to check the password
     * @PARAMS : admin user ID,password
     * @RETURN : BOOL TRUE/FALSE
     */
    public function check_passW() {
        global $db;
        $sQl = "SELECT password FROM admins WHERE id = '" . $_SESSION['adminId'] . "'";
        $result = $db->get_row($sQl);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function logout() {
        unset($_SESSION['isAdminLoggedIn']);
        unset($_SESSION['loggedAdminId']);

        #return to the index page
        header("location:" . SITE_URL . "/admin/");
        exit;
    }

    public function getNavigation() {
        $navigation = array(
            'dashboard' => array('url' => SITE_URL . '/admin/', 'name' => 'Dashboard'),
            'bookings' => array('url' => SITE_URL . '/admin/bookings/', 'name' => 'Bookings'),
            'visa_bookings' => array('url' => SITE_URL . '/admin/visa_bookings/', 'name' => 'Visa Booking '),
            'banners' => array('url' => SITE_URL . '/admin/banners/', 'name' => 'Banners'),
            'hotel' => array('url' => SITE_URL . '/admin/hotel/', 'name' => 'Hotels'),
            'visa' => array('url' => SITE_URL . '/admin/visa/', 'name' => 'Visa'),
            'package' => array('url' => SITE_URL . '/admin/package/', 'name' => 'Packages'),
            'agents' => array('url' => SITE_URL . '/admin/agents/', 'name' => 'Agents'),
            'pages' => array('url' => SITE_URL . '/admin/pages/', 'name' => 'Pages'),
        );
        return $navigation;
    }

    public function getDetails() {
        
    }

    /**
     * Set Welcome HTML text
     */
    public function setWelcomeNote() {
        if ($this->_admin_id) {
            $this->Admin->id = $this->_admin_id;
            $result = $this->Admin->getById();
            $this->welcome_note = sprintf('%s | <a href="%s">Logout</a>', $result['Admin']['first_name'], SITE_URL . "/admin/logout/");
        }
    }

    /**
     * @return mixed
     */
    public function getWelcomeNote() {
        if (!$this->welcome_note) {
            $this->setWelcomeNote();
        }
        return $this->welcome_note;
    }

    public function createSEF() {
        $this->doNotRenderHeader = 1;
        if (isset($_POST['str'])) {
            $str = $_POST['str'];
        } else {
            if (func_get_args()) {
                $str = func_get_arg(0);
            }
        }

        if ($str) {
            echo Utils::createSEF($str);
            die;
        } else {
            die;
        }
    }

    /**
     * Utility method to update all
     * room occupancies from the tariff table
     * so that the search starts functioning
     */
    public function setOccupancy() {
        //default room count
        $roomCount = 20;

        $modelTariff = new Hotel_Tariff();

        $list = $modelTariff->getAll();
        if (!$list) {
            echo "No Tariff found in the database. Hence Exiting";
            exit();
        }

        $occupancy = array();
        foreach ($list as $hotel) {
            $tariff = $hotel['Hotel_Tariff'];

            foreach ($tariff as $key => $val) {
                if (in_array($key, array('single', 'double', 'triple', 'unit'))) {
                    if (!is_null($val) && $val != '' && $val) {
                        $occupancy[] = array(
                            'hotel_tariff_id' => $tariff['id'],
                            'occupancy_type' => $key,
                            'room_rate' => $val,
                            'room_count' => (isset($tariff['room_count']) && $tariff['room_count'] != 0) ? $tariff['room_count'] : $roomCount,
                        );
                    }
                }
            }
        }

        $modelOccupancy = new Hotel_Occupancy();
        echo "Total data to save for Occupancy " . count($occupancy);
        //save all the occupancies
        if (!$modelOccupancy->saveAll($occupancy)) {
            $error = true;
            echo "Cannot save occupancy details";
        }
        exit;
    }

    private static function loadDashboard() {

        //Today Hotel bookings
        $todaysBooking = self::getDashboardData('Hotel_Reservation');
        //Today Visa Application
        $todayVisaApplications = self::getDashboardData('Visa_Booking');
        //Todays package booking
        $todayPackage = self::getDashboardData('Package');

        //7 days Hotel Booking
        $lastsevendaysBooking = self::getDashboardData('Hotel_Reservation', true);
        //Last 7 days Visa
        $lastsevendaysVisa = self::getDashboardData('Visa_Booking', true);
        // last 7 days Package
        $lastsevendaysPackage = self::getDashboardData('Package', true);

        //New Agent Application
        $newagentApplication = self::getDashboardData('Agent');

        //Low Credit Agents
        $lowCreditAgents = self::getLowCreditAgent();

        return array('todaysBooking' => $todaysBooking, 'lastsevendaysBooking' => $lastsevendaysBooking,
            'todaysVisa' => $todayVisaApplications, 'lastsevendaysVisa' => $lastsevendaysVisa, 'todayPackage' => $todayPackage,
            'lastsevendaysPackage' => $lastsevendaysPackage, 'newAgent' => $newagentApplication, 'lowCreditAgents' => $lowCreditAgents);
    }

    private static function getDashboardData($class, $interval = false) {
        $model = new $class();
        if ($class != 'Agent') {
            $condition = "DATE(date_added) ='" . date("Y-m-d") . "'";
            if ($interval) {
                $condition = 'date_added >  DATE_SUB(CURDATE(), INTERVAL 7 DAY)';
            }
            $dataList = $model->getDetailsByDate($condition);
        } else {
            $dataList = $model->getNewAgent();
        }
        return $dataList;
    }

    public function toogleBookingStatus() {
        $this->doNotRenderHeader = true;
        if (isset($_POST['action']))
            $action = $_POST['action'];
        if (isset($_POST['reservation_id']))
            $reservation_id = $_POST['reservation_id'];
        if (isset($_POST['price']))
            $price = $_POST['price'];

        $reservationObj = new Hotel_Reservation();
        $reservationObj->setId($reservation_id);
        $result = $reservationObj->toggleBookingStatus($action);
        if (is_array($result)) {
            if ($result['newStatus'] == "confirm") {
                $walletObj = new Agent_Wallet();
                $wallet['agent_id'] = $result['agent_id'];
                $wallet['value'] = (int) $price;
                $wallet['type'] = 'withdrawl';
                $wallet['item_type'] = 'hotel';
                $wallet['item_id'] = (int) $reservation_id;
                $wallet['date'] = date('Y-m-d h:i:s');
                foreach ($wallet as $field => $value) {
                    $walletObj->{$field} = $value;
                }
                $walletObj->save();
            }
            //  $this->set('message',  'Status updated; set to ' . $result['newStatus']);
            echo json_encode(array('result' => 'Success', 'message' => 'Status updated; set to ' . $result['newStatus'], 'response' => $result));
        } else {
            // $this->set('message',  'Cannot update status');
            echo json_encode(array('result' => 'Error', 'message' => "Cannot update status"));
        }

        return;
    }

    public function allocateFund() {
        $this->doNotRenderHeader = true;

        if (isset($_POST['agentid']))
            $agent_id = $_POST['agentid'];
        if (isset($_POST['fundamt']))
            $amount = $_POST['fundamt'];
        $fundAmt = sprintf("$%s", number_format($amount));
        $walletObj = new Agent_Wallet();
        $wallet['agent_id'] = $agent_id;
        $wallet['value'] = (int) $amount;
        $wallet['type'] = 'deposite';
        $wallet['date'] = date('Y-m-d h:i:s');
        foreach ($wallet as $field => $value) {
            $walletObj->{$field} = $value;
        }
        if ($walletObj->save()) {
            echo json_encode(array('result' => 'Success', 'message' => "<span style='color:green'>Funds($fundAmt) Added Successfully.</span>"));
        } else {
            echo json_encode(array('result' => 'Error', 'message' => "<span style='color:red'>Sorry,Funds($fundAmt) Can't Be Added.</span>"));
        }
    }

    public function view_visadetails() {
        $this->doNotRenderHeader = true;
        $application_id = func_get_arg(func_num_args() - 1);
        $visaObj = new Visa_Booking();
        $visaObj->id = $application_id;
        $details = $visaObj->getById();

        $visa = array();
        $paxes = array();
        if (!empty($details)) {
            $visa['order_id'] = $details['Visa_Booking']['id'];
            $visa['agent_name'] = $this->getAgentSummary($details['Visa_Booking']['agent_id']);
            $visa['agent_id'] = $details['Visa_Booking']['agent_id'];
            $visa['package'] = $details['Visa_Booking']['type'];
            $visa['validity'] = $details['Visa_Booking']['validity'];
            $visa['applied_date'] = $details['Visa_Booking']['date_added'];
            $visa['parent_customername'] = $details['Visa_Pax'][0]['Visa_Pax']['fname'] . ' ' . $details['Visa_Pax'][0]['Visa_Pax']['mname'] . ' ' . $details['Visa_Pax'][0]['Visa_Pax']['lname'];
            $visa['parent_passport'] = $details['Visa_Pax'][0]['Visa_Pax']['passport'];
            $visa['pax_count'] = $details['Visa_Booking']['pax_count'];
            $visa['nationality'] = $details['Visa_Pax'][0]['Visa_Pax']['nationality'];
            $visa['parent_passport_status'] = $details['Visa']['status'];
            $visa['visa_file_name'] = $details['Visa_Booking']['visa_file_name'];
            $visa['status'] = $details['Visa_Booking']['status'];

            foreach ($details['Visa_Pax'] as $pax) {
                $visa['paxes'][] = array('customer_name' => $pax['Visa_Pax']['fname'] . ' ' . $pax['Visa_Pax']['mname'] . ' ' . $pax['Visa_Pax']['lname'],
                    'passport_no' => $pax['Visa_Pax']['passport'],
                    'nationality' => $pax['Visa_Pax']['nationality'],
                    'status' => ucwords($visa['status']),
                    'document' => json_decode($pax['Visa_Pax']['image']));
            }
            $this->set('visa', $visa);
            $this->set('interface',$_GET['interface']);
        }
    }

    public function getAgentSummary($agent_id) {
        $summary = $this->getAgent()->getAgentSummary($agent_id);
        return $summary;
    }

    public function getAgent() {
        if (is_null($this->_agentname)) {
            $this->_agentname = new Agent();
        }
        return $this->_agentname;
    }

    private static function getLowCreditAgent() {
        $agentObj = new Agent();
        $counts = $agentObj->getCounts();

        //get list of all agents
        //order by the latest first
        $agentObj->orderBy('date_added', 'DESC');
        $agents = $agentObj->getAll();
        $lowCreditAgents = array();

        if (!empty($agents)) {

            foreach ($agents as $agent) {

                if ($agent['Summary']['balance'] < 0) {
                    $lowCreditAgents[] = array('agent_id' => $agent['Agent']['id'],
                        'agent_name' => $agent['Agent']['contact'],
                        'email' => $agent['Agent']['email'],
                        'balance' => $agent['Summary']['balance'],
                        'allowed' => $agent['Summary']['total']);
                }
            }


            return $lowCreditAgents;
        }
        return;
    }

    public function uploadVisaByAdmin() {
        if ($_FILES['visaFile']['type'] == "application/pdf") {
            $application_id = $_POST['id'];
            $agent_id = $_POST['agent_id'];
            $price = $_POST['price'];
            $paxCount = $_POST['pax'];
            $file = $_FILES['visaFile'];

            //visavalue
            $visa_value = $price * $paxCount;
            //set deduction of this price from agent

            $uploadVisaFile = Utils::uploadImage($file);
            $visa['id'] = $application_id;

            $visa['visa_file_name'] = json_encode($uploadVisaFile);
            $visa['status'] = "approved";
            $visaObj = new Visa_Booking();
            $visaObj->setId($application_id);
            $visaObj->visa_file_name = $visa['visa_file_name'];
            $visaObj->status = "approved";
            $visaObj->agent_id = $agent_id;
            $visaObj->price = $visa_value;


            if ($visaObj->save(true)) {

                $walletObj = new Agent_Wallet();
                $wallet['agent_id'] = $agent_id;
                $wallet['value'] = (int) $visa_value;
                $wallet['type'] = 'withdrawl';
                $wallet['item_type'] = 'visa';
                $wallet['item_id'] = $application_id;
                $wallet['date'] = date('Y-m-d h:i:s');
                foreach ($wallet as $field => $value) {
                    $walletObj->{$field} = $value;
                }
                $walletObj->save();

                $download_link = "<a href=" . SITE_URL . "/admin/download_visa_document/" . json_decode($visa["visa_file_name"]) . "><i style=\"cursor: pointer\" class=\"icon-download-alt\"></i>Visa</a>";
                echo json_encode(array('result' => 'Success', 'message' => 'Visa Uploaded And Approved Successfully.', 'applicationid' => $application_id, 'download_link' => $download_link));
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

    public function edit_agent() {
        $this->doNotRenderHeader = true;
        $agent_id = func_get_arg(func_num_args() - 1);
        $agentObj = new Agent();
        $agents = $agentObj->getAgentSummary($agent_id, TRUE);
        $this->set_pageTitle('Manage Agents');
        $this->set_pageType('agents');
        $this->set('agents', $agents[0]);
    }

    public function save_agentInfo() {
        $this->check_is_ajax(__FILE__);
        $data = array();
        if ($_POST && $_POST['mm_form'] == 'editAgent') {
            $newAgent = $_POST['agent'];
            if ($this->saveAgent($newAgent)) {
                $data['success'] = true;
                $data['error'] = false;
            } else {
                $data['success'] = false;
                $data['error'] = true;
            }


            // return all our data to an AJAX call
            echo json_encode($data);
        }
    }

    private function check_is_ajax($script) {
        $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
        if (!$isAjax) {
            $this->doNotRenderHeader = true;
            echo 'Access denied - not an AJAX request...' . E_USER_ERROR;
            die;
        }
        return true;
    }

    private function saveAgent($params) {
        $agentObj = new Agent();
        foreach ($params as $field => $value) {
            $agentObj->{$field} = $value;
        }
        //add the date added
        $agentObj->date_added = date('Y-m-d h:i:s');
        return $agentObj->save();
    }

    ## Agent Password Reset ###################
    public function resetAgentPassword() {
        $this->doNotRenderHeader = 1;
        $agent_id = func_get_arg(func_num_args() - 1);

        if ($agent_id) {

            //new password
            $pass = Utils::generateCaptcha(8);

            $agentObj = new Agent();
            $agentObj->setId($agent_id);
            $agent = $agentObj->getById();

            $agent['Agent']['status'] = 'approved';
            $agent['Agent']['date_approved'] = date('Y-m-d h:i:s');
            $agent['Agent']['password'] = md5($pass);
            foreach ($agent['Agent'] as $key => $val) {
                $agentObj->{$key} = $val;
            }
            if ($agentObj->save()) {
              
               $msg="<strong>".ucwords($agent['Agent']['company'])." </strong>Password is reset and mailed to <strong>".$agent['Agent']['email']."</strong>";
               echo $msg;
                Utils::sendAgentEmail(
                        array('email' => $agent['Agent']['email'], 'name' => $agent['Agent']['contact']), "Your Password for GreenOasis Travel Agent Has Been Reset.", array('password' => $pass, 'name' => $agent['Agent']['contact']), 'password_reset'
               );
            }
        }
    }



}
