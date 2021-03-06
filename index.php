<?php

// this file used when all folder is in the public_html folder.

define('root', TRUE);
// Empty String
define('STRING_EMPTY', '');

class Key{
    public const FILES = 'files';
    public const CACHE = 'cache';
    public const MODEL = 'Model';
    public const MODELS = 'models';
    public const MODULE = 'Module';
    public const MODULES = 'modules';
    public const LIBRARY = 'Library';
    public const LIBRARIES = 'libraries';
    public const CONTROLLER = 'Controller';
    public const CONTROLLERS = 'controllers';
    public const GLOBAL_OBJECT_MAIN_SOURCE = '__dsObjectMainSource_ms';
    public const API = 'api';
    public const MVC = 'mvc';
    public const MULTI = 'both';

    // State Working
    public const DEVELOPMENT = 'dev';
    public const PUBLISHED = 'pub';
    
    // Ext Php pie
    public const EXT_pie = '.pie.php';
    public const EXT_PHP = '.php';

    public const CHAR_SLASH = '/';
    public const INDEX = 'index';
    public const D_BACK = '../';
    public const D_APP = 'app/';
    public const D_CONFIG = 'config/';
    public const D_SYSTEM = 'system/';
    public const D_STORAGE = 'storage/';
    public const D_STORAGE_FILES = 'files/';
}
class Indexes{
    public static $DIR_ROOT = STRING_EMPTY;
    public static $SERVER_PROTOCOL = STRING_EMPTY;
    public static $DIR_APP = STRING_EMPTY;
    public static $DIR_CONFIG = STRING_EMPTY;
    public static $DIR_SYSTEM = STRING_EMPTY;
    public static $DIR_MODULES = STRING_EMPTY;
    public static $DIR_CACHE = STRING_EMPTY;
    public static $DIR_API = STRING_EMPTY;
    public static $DIR_STORAGE = STRING_EMPTY;
    public static $DIR_CACHE_TIME = STRING_EMPTY;
    public static $DIR_CACHE_VIEW = STRING_EMPTY;
    public static $DIR_CACHE_OBJECT = STRING_EMPTY;
    public static $DIR_VIEWS = STRING_EMPTY;
    public static $HTTP_HOST = STRING_EMPTY;
    public static $BASE_URL = STRING_EMPTY;
    public static $BASE_ASSETS = STRING_EMPTY;
    public static $LINK_FILES = STRING_EMPTY;

    public static function init(){
        self::$DIR_ROOT = __DIR__. Key::CHAR_SLASH;
        self::$SERVER_PROTOCOL = strtolower(explode(Key::CHAR_SLASH,
            isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : $_SERVER['SERVER_PROTOCOL']
        )[0]);
        // App Directory
        self::$DIR_APP = self::$DIR_ROOT. Key::D_APP;
        // Configuration Directory
        self::$DIR_CONFIG = self::$DIR_ROOT. Key::D_CONFIG;
        // Storage Directory for Cache location
        self::$DIR_STORAGE = self::$DIR_ROOT. Key::D_STORAGE;
        // System Directory
        self::$DIR_SYSTEM = self::$DIR_CONFIG. Key::CHAR_SLASH. Key::D_SYSTEM;
        // Modules Directory
        self::$DIR_MODULES = self::$DIR_APP. Key::MODULES. Key::CHAR_SLASH;
        // Cache Directory
        self::$DIR_CACHE = self::$DIR_APP. Key::CACHE. Key::CHAR_SLASH;
        // API Directory
        self::$DIR_API = self::$DIR_APP.'api'.Key::CHAR_SLASH;
        // Cache Time Directory
        self::$DIR_CACHE_TIME = self::$DIR_STORAGE.'cache/times/temp';
        // Cache View Directory
        self::$DIR_CACHE_VIEW = self::$DIR_STORAGE.'cache/views/';
        // Cache Object Directory
        self::$DIR_CACHE_OBJECT = self::$DIR_STORAGE.'cache/object/ref';
        // View Directory
        self::$DIR_VIEWS = self::$DIR_APP.'views'.Key::CHAR_SLASH;
        // your web server host (ex:localhost/index.php)
        self::$HTTP_HOST = $_SERVER['HTTP_HOST'];
        // Base url
        self::$BASE_URL = self::$SERVER_PROTOCOL.'://'.self::$HTTP_HOST;
        // Assets folder
        self::$BASE_ASSETS = self::$BASE_URL.'/main'.Key::CHAR_SLASH.'assets/';
        // Asset files url
        self::$LINK_FILES = self::$BASE_URL. Key::D_STORAGE_FILES;
    }
}
Indexes::init();

// Get global variable
require_once Indexes::$DIR_APP.'constants/define' . Key::EXT_PHP;
// Start the session
session_start();

// Include All required files for Core.php
require_once Indexes::$DIR_ROOT.'config/system/autoload'. Key::EXT_PHP;
_autoload2f40af1f10ad60c89a4b333ee7943d49::getLoader();

// Set Core as Null Value
$core = NULL;
// Get Byte of Core Object from cache
$core_cache = file_get_contents(Indexes::$DIR_CACHE_OBJECT);
// Unserialize Core object from cache
$core = unserialize($core_cache);
// If Core is never cached then reinitialize Core Object
if(!is_object($core)){
   $core = new dsCore();
   $ref = serialize($core);
   file_put_contents(Indexes::$DIR_CACHE_OBJECT, $ref);
}
// Connect Web from Core Object to running All Process
$core->connect();