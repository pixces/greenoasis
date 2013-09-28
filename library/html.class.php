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
                $checked = (in_array($value,array_values( $selected) )) ? 'checked' : '';
            }

            $break = ($t+1)%3 ? '' : '<br>';

            $option[] = '<label class="'.$cssClass.'"><input type="checkbox" id="'. $name.$t++ .'" value="'. $value .'" name="'. $name. '[]" '.$checked.'>&nbsp;'. $label. '</label>'.$break;
        }

        return implode(" ",$option);
    }

}