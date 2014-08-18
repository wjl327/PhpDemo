<?php

    define('SYSERROR', -1);
    define('DBERROR', -2);
    define('LOCAL_TIMEZONE','Asia/Shanghai');
    date_default_timezone_set(LOCAL_TIMEZONE);
    
    define('HOME_DIR', dirname(__DIR__));
    define('LOG_DIR', HOME_DIR . DIRECTORY_SEPARATOR . "logs");
    define('LIB_DIR', HOME_DIR . DIRECTORY_SEPARATOR . "lib");
    define('AUTO_LOAD_KEY', 'classes');
    
    set_include_path(HOME_DIR . PATH_SEPARATOR . LIB_DIR . DIRECTORY_SEPARATOR . "core" . 
    							PATH_SEPARATOR. LIB_DIR. DIRECTORY_SEPARATOR. 'PEAR'. 
    							PATH_SEPARATOR . get_include_path());