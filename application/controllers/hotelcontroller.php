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

    protected $roomList = array(
                        'Sgl' => array('single',1),
                        'Dbl' => array('double',2),
                        'Tpl' => array('triple',3),
                        'Qad' => array('quad',4),
                        'Unt' => array('unit',6)
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
     *
     * Search Logic
     * 1. Get list of all hotels matching the City / Country / Area
     * 2. Filter it with the hotels matching the filter criteria of Stars
     * 3. Get the IDs of all the above hotels
     * 4. Query Hotel_tariff to fetch hotels within the matched hotels which
     * have seasons with the said Checkin and Checkout dates
     * 5. Query the resultant hotels to find if there are no. of asked room available
     * for the hotels founds.
     * 6. Also match to see if the room_type is allowed.
     * 7. Get the final data and query hotels to get the details
     * 8. display the hotels on the UI
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

        $availability = $this->Hotel->doHotelSearch($data);

        //extract the hotel ids from the list of availability
        $hotelList = array_keys($availability);

        //get details of all these hotels for display
        $hotelDetails = $this->Hotel->fetchHotelDetails($hotelList);

        //get the hotel details and make update the availability status to it;
        $hotels = $hotelDetails['details'];

        //this is a strict implementation
        //override when non strict is requested
        $displayList = array();
        foreach($hotels as $hotel){
            $hotelDet = $hotel['Hotel'];

            //get the hotel image for display


            $availabilityDet = $availability[$hotelDet['id']];

            $availIds = array_keys($availabilityDet);

            //check for the tariff to be displayed
            $tariffList = array();
            if ($hotel['Tariff']){
                foreach($hotel['Tariff'] as $tariff){
                    if(in_array($tariff['id'],$availIds)){
                        $tariff['occupancy'] = $availabilityDet[$tariff['id']]['occupancy'];
                        $tariff['availability'] = $availabilityDet[$tariff['id']]['availability'];
                        $tariffList[] = $tariff;
                    }
                }
            }

            $displayList[] = array('Hotel'=>$hotelDet,'Tariff'=>$tariffList);
        }

        //fetch facets for these hotels;
        $facet['area'] = $this->Hotel->fetchFacet($hotelList,'area');
        $facet['stars'] = $this->Hotel->fetchFacet($hotelList,'star');

        $this->set('hotelDetails',json_encode($displayList));

        $data['total'] = $hotelDetails['Count'];
        $data['search_session'] = $search_sid;

        $this->set('criteria',$data);
        $this->set('facet',$facet);
        $this->set('paginator',$paginator);
    }

    public function booking(){

        if (!isset($this->_request['search_sid'])){
            header("location: ".SITE_URL."/hotel/");
            exit;
        }

        //get the selected tariff info
        $tariff_id = $this->_request['tariff'];
        $tObj = new Hotel_Tariff();
        $tObj->setId($tariff_id);
        $details = $tObj->getById();

        #get the package information
        $searchSession = $this->_request['search_sid'];
        $sObj = new Hotel_Session();
        $sObj->search_session = $searchSession;
        $packageDet = $sObj->fetchBySession();

        //accumulate all details in one variable
        $details['package'] = $packageDet;

        $this->set('details',$details);

        //print_r($details);

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

        //TODO:update search session in user_session

        #split location into city and country;
        $location = explode(",",$params['location']);

        if ($location[1]){
            if (trim($location[1]) == 'United Arab Emirates'){
                $params['country'] = 'uae';
            } else {
                $params['country'] = $location[1];
            }
        }
        if(in_array($location[0],$this->cityList)){
            $params['city'] = $location[0];
        } else {
            $params['country'] = $location[0];
        }

        //get pax size and room type
        $paxDet = $this->roomList[$params['roomtype']];

        $params['roomtype'] = $paxDet[0];
        $params['pax']['adult'] = $paxDet[1];

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
