<?php

define('DBHOST', 'localhost');
define('DBUSER', 'ntodeti1');
define('DBPASS', 'ntodeti1');
define('DBNAME', 'ntodeti1');


// ROOT PATHS


$SITE_PATH = dirname(basename(__DIR__));

$API_PATH = $SITE_PATH . '/api';

$APP_PATH = $SITE_PATH . '/app';

$ADMIN_PATH = $APP_PATH . '/admin';
$ADMIN_IMG_PATH = $ADMIN_PATH . '/images';

$BASE_PATH  = __DIR__;

$CLASS_PATH = $BASE_PATH . '/classes';

$INCLUDE_PATH = $SITE_PATH . '/include';

$USER_PATH = $APP_PATH . '/user';

$CSS_PATH = $SITE_PATH . '/assets/css';

$JS_PATH = $SITE_PATH . '/assets/js';

$IMG_PATH = $SITE_PATH . '/assets/img';

$FONT_PATH = $SITE_PATH . '/assets/fonts';
