<?php
include_once 'config/constant.php';
include_once 'config/config.php';
include_once 'lib/core.php';
include_once 'lib/PEAR/MDB2.php';
include_once 'lib/PEAR/Log.php';

import_path('service');
import_path('lib/core');

/** setup autoload **/
spl_autoload_register('main_auto_load');