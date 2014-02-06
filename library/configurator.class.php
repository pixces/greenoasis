<?php
/**
 * Created by IntelliJ IDEA.
 * User: zainulabdeen
 * Date: 05/02/14
 * Time: 3:41 AM
 * To change this template use File | Settings | File Templates.
 */ 
class Configurator {

    private static $configuration = array();

    public static function loadConfiguration(){

        $cfg = new Setting();
        $settings = $cfg->fetchAll();

        if ($settings){
            $config = array();
            foreach($settings as $t){
                $config[$t['Setting']['group']][$t['Setting']['key']]= $t['Setting']['value'];
            }
        }

        //define all general values to constants
        if ($config['general']){
            foreach($config['general'] as $key=>$val){
                define(strtoupper(strtolower($key)),$val);
            }
        }
        self::$configuration = $config;
    }

    public static function get($key,$group=false){

        if (!isset(self::$configuration)){
            return false;
        }

        if ($group == true){
            //return the list for the group asked
            return self::$configuration[$key];
        } else if ($group == false){
            foreach(self::$configuration as $group => $list){
                if (in_array($key,array_keys($list))){
                    return $list[$key];
                }
            }
        }
    }
}
