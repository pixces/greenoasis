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
                                'pax'=>array('adult'=>1,'children'=>0),
                                'checkin'=>'',
                                'checkout'=>'',
                                'nights'=>'',
                                'rooms'=>'',
                                'roomtype'=>''
                            );

    public function index(){
        //this is the advance search form
    }

    /**
     * Check if the request is ajax
     * if so then return only the data
     * else render the complete page
     *
     * New filters requested
     * New Page requested
     */
    public function search(){

        if (!isset($this->_request['search_sid'])){
             header("location: ".SITE_URL."/hotel/");
            exit;
        }

        #searchSession
        $search_sid = $this->_request['search_sid'];

        //if filterd query is activated
        //then update the session and then redo the search
        //update the searchSession;
        $sObj = new Hotel_Session();
        $sObj->search_session = $search_sid;

        $data = $sObj->fetchBySession();

        $query = array();
        if(!empty($data['city'])){
            $query['hotel_city'] = $data['city'];
        }

        if(!empty($data['country'])){
            $query['hotel_country'] = $data['country'];
        }

        if(!empty($data['star'])){
            $query['hotel_stars'] = $data['star'];
        }

        if (!empty($data['hotelname'])){
            $query['hotel_name'] = $data['hotelname'];
        }

        if (!empty($data['area'])){
            $query['hotel_area'] = $data['area'];
        }

        $criteria = $data;


        //get list of hotels matching primary citeria
        $hotelList = $this->Hotel->doPrimarySearch($query);

        //use this hotel list to get the details of seasons and room availability;

        //get details of all these hotels for display
        $hotelDetails = $this->Hotel->fetchDetails($hotelList);
        $criteria['total'] = count($hotelDetails);

        //fetch facets for these hotels;
        $facet['area'] = $this->Hotel->fetchFacet($hotelList,'area');
        $facet['stars'] = $this->Hotel->fetchFacet($hotelList,'star');

        $this->set('hotelDetails',json_encode($hotelDetails));
        $this->set('criteria',$criteria);
        $this->set('facet',$facet);
        $this->set('paginator',$paginator);

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

        #split location into city and country;
        $location = explode(",",$params['location']);

        if ($location[1]){
            if (trim($location[1]) == 'United Arab Emirates'){
                $params['country'] = 'UAE';
            } else {
                $params['country'] = $location[1];
            }
        }
        if(in_array($location[0],$this->cityList)){
            $params['city'] = $location[0];
        } else {
            $params['country'] = $location[0];
        }


        //prepare all the query params
        foreach($params as $field=>$value){
            if (!in_array($field,array('search_type','request_type'))){
                if (in_array($field,array('checkin','checkout'))){
                    $this->queryParams[$field] = strtotime($value);
                } else {
                    $this->queryParams[$field] = $value;
                }
            }
        }

        //get the nights of stay
        $timeDiff = $this->queryParams['checkout'] - $this->queryParams['checkin'];
        $dateDiff = $timeDiff / 24 / 3600;
        $this->queryParams['nights']  = $dateDiff;

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

    protected function parseLocation($location){




    }



}
