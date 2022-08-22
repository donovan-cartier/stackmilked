<?php

// Load Stackmilk's constants
require("stackmilk-defined.php");

// Create config file if Stackmilk isn't installed or config file doesn't exists
if(SMILK_INSTALLED && file_exists(SMILK_CONFIG)):
    require(SMILK_CONFIG);
else:
    file_put_contents(SMILK_CONFIG, file_get_contents(__DIR__ . "/stackmilk-config-template.php"));
endif;