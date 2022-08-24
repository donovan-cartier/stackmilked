<?php

// Load Stackmilk's constants
require("stackmilk-defined.php");

// Create config file if file doesn't exists, else require it
if(file_exists(SMILK_CONFIG)):
    require(SMILK_CONFIG);
else:
    file_put_contents(SMILK_CONFIG, file_get_contents(__DIR__ . "/stackmilk-config-template.php"));
endif;

// If Stackmilk isn't installed, require the installation form
if(!SMILK_INSTALLED)
    require( __DIR__ . '/../stackmilk-front/required/stackmilk-header.php');
    require( __DIR__ . '/../stackmilk-install/smilk-install.php');
    require( __DIR__ . '/../stackmilk-front/required/stackmilk-footer.php');