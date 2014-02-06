<?php
/*
 * Common utility methods
 */
class Utils
{
    /**
     * Function to convert a title into SEF title.
     * Remove all the special character inputs into en dashes (-)
     */
    public static function createSEF($data)
    {
        $title = strtolower(addslashes(trim($data)));

        $search = array('`', '!', '@', '#', '%', '^', '&', '*', '(', ')', '+', '|', ':', ';', '[', ']', '{', '}', '.', '/', ' ', '_', '-');
        $repl = '-';
        $sef_title = str_replace($search, $repl, $title);

        #replace al multiple occurance of spl chars to single
        $sef = preg_replace('/--+/', '-', $sef_title);

        #remove any trailing space or '-'
        return trim(trim($sef), "-");

    }

    public static function hotelAmenities(){
        return array(
            'laundry'=>'Laundry',
            'wifi'=>'Free Wi-Fi',
            'pool'=>'Swimming Pool',
            'restaurant'=>'Restaurant/bar/Buffet',
            'gym'=>'Gym/Fitness',
            'Parking'=>'Parking',
            'spa'=>'Spa/Wellness',
            'banquet'=>'Banqueting',
            'ballroom'=>'Ballroom',
            'conference'=>'Conference room',
            'room_service'=>'24 hour room service',
            'security'=>'24 hour security',
            'safe_deposite'=>'Safety deposit box',
            'business'=>'Business services',
            'transport'=>'Airport Shuttle (surcharge)',
            'av_equipments'=>'Audio visual equipment'
        );
    }

    public static function hotelCountries(){
        return array();
    }

    public static function hotelCities(){
        return array();
    }

    public static function filter($string, $size = null)
    {
        #remove all formating from the string
        $string = strip_tags($string);
        $string = stripslashes($string);

        if (!is_null($size)) {
            if (strlen($string) > $size) {
                $substring = substr($string, 0, $size);

                #get position of the last "SPACE" character after substring
                $pos = strrpos($substring, ' ');
                if ($pos !== false) {
                    $substring = substr($string, 0, $pos);
                }
                return $substring;
            }
        }
        return $string;
    }

    /**
     * Function to remove all unwanted chars
     * from the given string
     */
    public static function sanitize($string)
    {
        $search = array(
            '@<script[^>]*?>.*?</script>@si', // Strip out javascript
            '@<[\/\!]*?[^<>]*?>@si', // Strip out HTML tags
            '@<style[^>]*?>.*?</style>@siU', // Strip style tags properly
            '@<![\s\S]*?--[ \t\n\r]*>@' // Strip multi-line comments
        );

        $str = strip_tags($string);
        $str = preg_replace($search, '', $str);

        return $str;
    }

    public static function createUUID($seed = 'u')
    {
        $dateComp = date('z');
        $randomNum = mt_rand();
        return $seed . '-' . $dateComp . '-' . $randomNum;
    }

    public static function smartSubStr($text,$length){
        if (!$text){
            return false;
        }

        $string = stripslashes(strip_tags(nl2br($text)));
        if (strlen($string) <= $length){
            return $string;
        }

        $string = substr($string,0,$length);
        $pos = strrpos($string, ' ');
        $string = substr($string, 0, $pos);

        return $string.'[..]';
    }

    public static function generateCaptcha($count, $type = NULL)
    {
        if (is_null($type)) {
            $listVal = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrsduvwxyz123456789";
        } else {
            $listVal = '1234056789';
        }

        $num = "";
        for ($i = 0; $i < $count; $i++) {
            $num .= $listVal[rand(0, strlen($listVal))];
        }
        return $num;
    }

    public static function is_valid($email)
    {
        if (!$email) {
            return false;
        }

        if (eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {
            return true;
        } else {
            return false;
        }
    }

    public static function loadConfig()
    {
        global $db;
        //$ini = file_get_contents("settings.ini");
        $config = parse_ini_file("settings.ini", true);
        return $config;
    }

    /*
    * select box of country
    */
    public static function getCountrySelect($name = NULL, $selected = 'India')
    {
        $countryList = array('Afghanistan', 'Arabia', 'Saudi', 'Argentina', 'Australia', 'Bahrain', 'Bangladesh', 'Bhutan', 'Brazil', 'Cambodia', 'Canada', 'China', 'Colombia', 'Costa Rica', 'Cuba', 'Czech Republic', 'Denmark', 'Egypt', 'Europe', 'European Union', 'Fiji', 'Finland', 'France', 'Germany', 'Ghana', 'Haiti', 'Holland', 'Hong Kong, (China)', 'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran, Islamic Republic of', 'Iraq', 'Israel', 'Italy', 'Japan', 'Korea, Dem. Peoples Rep.', 'Korea, (South) Republic of', 'Kuwait',
            'Malaysia', 'Maldives', 'Mexico', 'Middle East', 'Morocco', 'Myanmar (ex-Burma)', 'Nepal', 'New Zealand', 'Oman', 'Pakistan', 'Philippines', 'Qatar', 'Russia (Russian Fed.)', 'Saudi Arabia', 'Seychelles', 'Singapore', 'South Africa', 'South America', 'Sri Lanka (ex-Ceilan)', 'Sudan', 'Switzerland', 'Syrian Arab Republic', 'Taiwan', 'Thailand', 'Turkey', 'United Arab Emirates', 'United Kingdom', 'United States');

        if (is_null($name)) {
            $name = "country";
        }

        $sBox = '<select name="' . $name . '" id="countryCombo" style="width:200px;">';
        $sBox .= '<option value="">--- Select Country ---</option>';
        foreach ($countryList as $country) {
            if ($selected != NULL) {
                if ($country == $selected) {
                    $sel = 'selected="selected"';
                } else {
                    $sel = '';
                }
            }
            $sBox .= '<option value="' . $country . '" ' . $sel . '>' . $country . '</option>';
        }
        $sBox .= "</select>";

        return $sBox;
    }


    public static function getCitySelect($name)
    {

        global $db;
        $citySql = "select `city_name` from rnp_cities order by `city_name` ASC";
        $result = $db->get_results($citySql);

        if ($result) {

            $cityBox = "";
            $cityBox .= '<select name="' . $name . '" id="bill_city" size="1" style="width:200px;"><option value="">Select a City</option>';

            foreach ($result as $city) {
                $cityBox .= '<option value="' . $city->city_name . '">' . $city->city_name . '</option>';
            }
        }
        return $cityBox;
    }


    public static function getDateSelect()
    {
        $dateBox = "";
        $dateBox .= '<select name="date" id="date" size="1"><option value="">Date</option>';

        for ($x = 1; $x <= 31; $x++) {
            $dateBox .= '<option value="' . str_pad($x, 2) . '">' . str_pad($x, 2) . '</option>';
        }
        $dateBox .= '</select>';

        return $dateBox;
    }

    public static function getMonthSelect()
    {

        $monthArray = array('Jan', 'feb', 'march', 'april', 'may', 'june', 'july', 'aug', 'sept', 'oct', 'nov', 'dec');

        $dateBox = "";
        $dateBox .= '<select name="month" id="month" size="1"><option value="">Month</option>';

        for ($x = 0; $x < count($monthArray); $x++) {
            $dateBox .= '<option value="' . str_pad(($x + 1), 2) . '">' . ucwords($monthArray[$x]) . '</option>';
        }
        $dateBox .= '</select>';

        return $dateBox;
    }

    public static function getYearSelect($future = NULL)
    {

        $dateBox = "";
        $dateBox .= '<select name="year" id="year" size="1"><option value="">Year</option>';

        if ($future != NULL) {
            $start = date('Y');

        } else {
            $start = 1940;
        }
        $end = $start + 60;

        for ($x = $start; $x <= $end; $x++) {
            $dateBox .= '<option value="' . str_pad($x, 4) . '">' . str_pad($x, 4) . '</option>';
        }
        $dateBox .= '</select>';

        return $dateBox;
    }

    /**
     * @param array $data
     * @param array $selected List of Id's of all categories
     * @return bool/HTML markup
     */
    public static function createSelectOptions($data, $selected)
    {
        if (!$data || !is_array($data)) {
            return false;
        }

        $options = array();
        foreach ($data as $unit => $label) {

            if (is_array($label)) {
                $options[] = '<optgroup label="' . $unit . '">' . $unit . '</optgroup>';

                foreach ($label as $key => $value) {
                    if (in_array($key, $selected)) {
                        $options[] = '<option value="' . $key . '" selected="selected">' . trim($value) . '</options>';
                    } else {
                        $options[] = '<option value="' . $key . '">' . trim($value) . '</options>';
                    }
                }
            } else {
                if (in_array($unit, $selected)) {
                    $options[] = '<option value="' . $unit . '" selected="selected">' . trim($label) . '</options>';
                } else {
                    $options[] = '<option value="' . $unit . '">' . trim($label) . '</options>';
                }
            }
        }
        echo implode("", $options);
    }

    /**
     * Function to upload a image
     * and resize them for use.
     * To be used by all other methods except products.
     * @static
     * @param $file
     * @return bool|string
     */
    public static function uploadImage($file, $type = null)
    {
        #image types
        #thumbnail
        #small
        #medium
        #large
        #x-large
        $resize = array();

        if (!is_null($type)){
            switch($type){
                case 'logo':
                    $resize[] = array(
                        'prefix' => PREFIX_LOGO,
                        'width' => IMG_WIDTH_THUMB,
                        'resize' => true,
                        'cropping' => false,
                        'ratio_y' => true,
                    );
                    break;
                case 'content':
                case 'gallery':
                    $resize['thumb'] = array(
                        'prefix' => PREFIX_THUMB,
                        'width' => IMG_WIDTH_THUMB,
                        'height'=> IMG_HEIGHT_THUMB,
                        'resize' => true,
                        'cropping' => true,
                    );
                    $resize['small'] = array(
                        'prefix' => PREFIX_SMALL,
                        'width' => IMG_WIDTH_SMALL,
                        'height'=> IMG_HEIGHT_SMALL,
                        'resize' => true,
                        'cropping' => true,
                    );
            }
        }

        $dest = UPLOAD_DST_DIR; // The place the files will be uploaded to (currently a 'files' directory). Should have write permission

        #create new names of the uploaded image file
        $imageName = $file['name']; // Get the name of the file (including file extension).
        $imgFname = substr($imageName, 0, strpos($imageName, '.'));
        $imageExt = substr($imageName, strpos($imageName, '.'), strlen($imageName) - 1); // Get the extension from the filename.

        $baseImgName = str_replace(" ","_",trim($imgFname,"-"));
        if (file_exists($dest . $baseImgName . $imageExt)) {
            $baseImgName = str_replace(" ","_",trim($imgFname,"-")) . rand(0, 999);
        }

        /*
        if ($resize){
            //create image names
            $resize['thumbnail']['name'] =  IMG_THUMB.$baseImgName;
            $resize['medium']['name'] =  IMG_MEDIUM.$baseImgName;
        }*/

        #now upload the image and resize
        $handle = new Upload($file);

        if ($handle->uploaded) {

            //upload the main file to the server first
            $handle->file_new_name_body = $baseImgName;
            $handle->Process($dest);

            #main file created
            if (!$handle->processed) {
                echo $handle->log;
                echo '  Error creating main file: ' . $handle->error . '';
                throw new Exception( '  Error creating main file: ' . $handle->error );
            }

            // yes, the file is on the server
            // below are some example settings which can be used if the uploaded file is an image.
            if ($resize){
                foreach($resize as $type => $value){

                    //file name for the resize
                    $handle->file_new_name_body = $value['prefix'].$baseImgName;

                    //make the basic settings
                    if ($value['resize']){
                        $handle->image_resize = true;
                    }

                    if ($value['cropping']) {
                        $handle->image_x = $value['width'];
                        $handle->image_y = $value['height'];
                        $handle->image_ratio_crop = true;
                    } else if ($value['ratio_y'] == true){
                        $handle->image_x = $value['width'];
                        $handle->image_ratio_y = true;
                    } else if ($value['ratio_x'] == true){
                        $handle->image_y = $value['height'];
                        $handle->image_ratio_x = true;
                    }

                    //create image now
                    $handle->Process($dest);

                    if ( !$handle->processed ){

                        echo $handle->log;
                        echo "Error creating ".$type." for image file ".$baseImgName .'<br />';
                        echo $handle->error;
                        throw new Exception( "Error creating ".$type." for image file ".$baseImgName . var_export($handle->error, true));
                    }
                }
            }

            // we delete the temporary files
            $handle->Clean();
            return $baseImgName . strtolower($imageExt);
        } else {
            throw new Exception( "Cannot upload image" . var_export($_FILES, true));
        }
    }

    public static function is_assoc($array) {
        return (bool)count(array_filter(array_keys($array), 'is_string'));
    }

    public static function getMealPlan($plan){

        $type = strtolower($plan);

        $plan = array(
            'ro' => 'Room Only',
            'bb' => 'Bed & Breakfast',
            'HB' => 'Half Board',
            'FB' => 'Full Board' );

        return $plan[$type];
    }

    public static function getVisaPackage($type){

        $package = array(
            'tourist30' => array('Tourist Visa', 30),
            'service14' => array('Service Visa', 14),
            'visit30'=> array('Visit Visa', 30),
        );

        return $package[$type];

    }

    public static function convertUploadArray(&$file_post){

        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i=0; $i<$file_count; $i++) {
            foreach ($file_keys as $key) {
                foreach($file_post[$key][$i] as $idx => $val){
                    $file_ary[$i][$idx][$key] = $file_post[$key][$i][$idx];
                }
            }
        }
        return $file_ary;
    }

    public static function sanitizeParams(&$array){
        foreach($array as $key => $val){
            self::sanitize($val);
        }
    }

    /** Check for Magic Quotes and remove them **/
    public static function stripSlashesDeep($value)
    {
        $value = is_array($value) ? array_map(array('self',__METHOD__), $value) : stripslashes($value);
        return $value;
    }


    /* end class */
}
