<?php

class HTML
{
    private $js = array();

    public function shortenUrls($data)
    {
        $data = preg_replace_callback('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@', array(get_class($this), '_fetchTinyUrl'), $data);
        return $data;
    }

    private function _fetchTinyUrl($url)
    {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, 'http://tinyurl.com/api-create.php?url=' . $url[0]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return '<a href="' . $data . '" target = "_blank" >' . $data . '</a>';
    }

    public function sanitize($data)
    {
        return mysql_real_escape_string($data);
    }

    public function link($text, $path, $prompt = null, $confirmMessage = "Are you sure?")
    {
        $path = str_replace(' ', '-', $path);
        if ($prompt) {
            $data = '<a href="javascript:void(0);" onclick="javascript:jumpTo(\'' . BASE_PATH . '/' . $path . '\',\'' . $confirmMessage . '\')">' . $text . '</a>';
        } else {
            $data = '<a href="' . BASE_PATH . '/' . $path . '">' . $text . '</a>';
        }
        return $data;
    }

    public function includeJs($list)
    {

        if(is_array($list)){
            $data = array();
            foreach($list as $path){
                $data[] = '<script type="text/javascript"  src="' . SITE_JS . $path . '.js"></script>';
            }
            return implode(" ",$data);
        } else {
            $data = '<script type="text/javascript"  src="' . SITE_JS . $list . '.js"></script>';
            return $data;
        }
    }

    public function includeCss($fileName)
    {
        $data = '<link rel="stylesheet" type="text/css" media="all" href="' . SITE_CSS . '/css/' . $fileName . '.css"></script>';
        return $data;
    }

    public function checkbox($name,$data,$selected=null,$inline=true){

        $cssClass = 'checkbox';
        $is_assoc = false;
        if ($inline){
            $cssClass .= " inline";
        }

        #check if the array is associative
        $is_assoc = UTILS::is_assoc($data);

        $option = array();
        $t=0;
        foreach($data as $value=>$label){

            if (!$is_assoc){
                $value = $label;
            }

            if (!is_null($selected)){
                $checked = (in_array($value,array_values($selected) )) ? 'checked' : '';
            }

            $break = ($t+1)%3 ? '' : '<br>';

            $option[] = '<label class="'.$cssClass.'"><input type="checkbox" id="'. $name.$t++ .'" value="'. $value .'" name="'. $name. '[]" '.$checked.'>&nbsp;'. $label. '</label>'.$break;
        }

        return implode(" ",$option);
    }

    /*
        * select box of country
        */
    public static function selectCountry($name = NULL, $selected = 'India')
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

    public static function selectCity($name)
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

    public static function selectDate()
    {
        $dateBox = "";
        $dateBox .= '<select name="date" id="date" size="1"><option value="">Date</option>';

        for ($x = 1; $x <= 31; $x++) {
            $dateBox .= '<option value="' . str_pad($x, 2) . '">' . str_pad($x, 2) . '</option>';
        }
        $dateBox .= '</select>';

        return $dateBox;
    }

    public static function selectMonth()
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

    public static function selectYear($future = NULL)
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
     * @param $name
     * @param array $data
     * @param null $selected
     * @return string
     *
     * TODO: Improve for Multi-select and OptGroups
     */
    public static function select($name, array $data, $selected=null)
    {
        /*
        $data = Array (
            1 => 'Desert Safari',
            2 => 'Dhow Cruise',
            3 => 'City Tours',
            4 => 'Luxury Tours',
            5 => 'Theme Parks',
            6 => 'Water Activities',
            7 => 'Sea Adventure' );
         */

        $options = array('<option value="0">--- Select ---</options>');
        foreach($data as $value => $label){

            if (!is_null($selected) && ($value == $selected)){
                $options[] = '<option value="' . $value . '" selected="selected">' . trim($label) . '</options>';
            } else {
                $options[] = '<option value="' . $value . '">' . trim($label) . '</options>';
            }

        }


        /*
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
        } */

        return sprintf('<select name="%s" id="%s">%s</select>',$name,'select_'.$name,implode("",$options));
    }

}