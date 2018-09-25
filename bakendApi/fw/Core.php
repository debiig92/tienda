<?php
class Core{
    protected $posCtrl = 0;
    protected $posAction = 1;
    /**
    * Autoload application files
    */
    public function init($route){
        session_start();

        #Autoload files
        spl_autoload_register( function ($class){
            
            if($pos = strrpos($class, '\\')){
                $class = substr($class, ++$pos);
            }

            foreach(APPDIR::getDirs() as $v){
                if(file_exists($v . $class . '.php')){
                    require_once $v . $class . '.php';
                }
            }
        } );

        $app = new App();
        $app->callController($route);
    }

    /**
    * Searching in multidimensional array
    */
    static function in_array_r($needle, $haystack) {
        $found = false;
        foreach ($haystack as $item) {
            if ($item == $needle) {
                $found = true;
                break;
            } elseif (is_array($item)) {
                $found = in_array_r($needle, $item);
                if($found) {
                    break;
                }
            }
        }
        return $found;
    }

    /**
     * Array map functionality with multidimensional arrays
     */
    function md_array_map($func, $arr) {
        $ret = array();

        foreach ($arr as $key => $val){
            $ret[$key] = (is_array($val) ? $this->md_array_map($func, $val) : $func($val));
        }
        return $ret;
    }

    /**
    * Compare strings
    */
    static function hash_equals($str1, $str2) {
        if(strlen($str1) != strlen($str2)) {
            return false;
        } else {
            $res = $str1 ^ $str2;
            $ret = 0;
            for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
            return !$ret;
        }
    }
}

/**
* PROJECT DIRECTORIES
*/
abstract class APPDIR{
    const Controllers = 'controllers/';
	const Models = 'models/';
    const Views = 'views/';
    const Partials = 'views/partials';
    const FW = 'fw/';
    const Libs = 'fw/libs/';
    const Assets = 'assets/';
    const Files = 'assets/files/';
    
    public static function getDirs(){
        $reflection = new ReflectionClass(get_called_class());
        return $reflection->getConstants();
    }
    
    public static function getDir($dirname){
        $reflection = new ReflectionClass(get_called_class());
        return $reflection->getConstants()[$dirname];
    }
}

/**
* EMAIL CONSTANT
*/
abstract class EMAIL{
    const Host = 'smtp.gmail.com';
    const SMTPAuth = true;
    const SMTPSecure = 'tls';
    const Port = 587;
   
	const Username = ''; // Email
    const Password = '';
    const From = '';
    const FromName = '';
    const AddAddress = ''; // Client email
	const AddAddressChayden = ''; // Client email
	const AddAddressDev = ''; // Developer email
	
	
}

abstract class Captcha{
    const PrivateKey = '';
    const PublicKey = '';
}

abstract class GlobalValuesPage{
	const CompanyGlobal = 'CEPHMA';
	const AddressGlobal = '';
	const PhoneGlobal = '';
	const EmailGlobal = '';
	const TitleGlobal = '';
}