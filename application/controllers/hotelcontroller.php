<?php
/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 06/10/13
 * Time: 12:05 AM
 * To change this template use File | Settings | File Templates.
 */ 
class HotelController extends Controller{

    protected $cityList = array(
                            "Bahrain",
                            "Manama",
                            "Muscat",
                            "Salalah",
                            "Doha",
                            "Abu Dhabi",
                            "Ajman",
                            "Alain",
                            "Dubai",
                            "Fujairah",
                            "Hatta",
                            "Khorfakkan",
                            "Ras Al Khaimah",
                            "Sharjah",
                            "Umm Al Quwain"
                        );

    protected $countryList = array(
                        'Bahrain'=>'Bahrain',
                        'Oman'=>'Oman',
                        'Qatar'=>'Qatar',
                        'United Arab Emirates'=>'UAE'
                    );

    protected $queryParams = array(
                                'city'=>'',
                                'country'=>'',
                                'area'=>'',
                                'pax'=>'a1c0',
                                'checkin'=>'',
                                'checkout'=>'',
                                'nights'=>'',
                                'rooms'=>'',
                                'roomtype'=>''
                            );

    public function index(){
        //this is the advance search form
    }

    public function search(){

        if (!isset($this->_request['search_sid'])){
             header("location: ".SITE_URL."/hotel/");
            exit;
        }

        $search_sid = $this->_request['search_sid'];

        //get the search session details
        $city = $this->_request['city'];
        $country = $this->_request['country'];
        $checkin = $this->_request['checkin'];
        $checkout = $this->_request['checkout'];









    }


    public function booking(){

        //on selecting a booking for a hotel
        //the user will be redirected here to
        //fill in information for the booking

        //validate if the Agent is Logged in before doing the
        //the actual booking

    }

    public function buildQuery(){

        $this->doNotRenderHeader = true;
        if ($_POST) {
            $params = $_POST;
        } else {
            echo json_encode(array('response'=>'ok','status'=>'error','message'=>'Only post request will be entertained'));
            exit;
        }

        #create a user_sessionId
        if (!isset($_SESSION['user']['_session'])){
            $_SESSION['user']['_session'] = uniqid();
        }

        $data['user_session'] = $_SESSION['user']['_session'];
        $data['search_session'] = time().mt_rand();
        $data['type'] = $params['search_type'];

        //prepare all the query params
        foreach($params as $field=>$value){
            if (!in_array($field,array('search_type','request_type'))){
                if (in_array($field,array('checkin','checkout'))){
                    $this->queryParams[$field] = date('dmY',strtotime($value));
                } else {
                    $this->queryParams[$field] = $value;
                }
            }
        }

        $data['params'] = json_encode($this->queryParams);

        $searchObj = new Hotel_Session();
        foreach($data as $field=>$value){
            $searchObj->$field = $value;
        }

        if ($searchObj->save()){
            $this->queryParams['sortName'] = 'hotel';
            $this->queryParams['sortOrder'] = 'DESC';

            //redirect to the new search page
            $redirect = SITE_URL.'/hotel/search/?';
            $redirect .= "search_sid=".$data['search_session']."&";
            $redirect .= http_build_query($this->queryParams);

            echo json_encode(array('response'=>'ok','status'=>'success','url'=>$redirect));
            exit;
        }
    }



}
