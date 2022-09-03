<?php

define("DB_TYPE", "mysql");
define("DB_HOST", "localhost:3306");
define("DB_NAME", "goffice_gemstech");
define("DB_USER", "root");
define("DB_PASS", "");
//define("URL", "http://".$_SERVER["HTTP_HOST"]."/gofficev2/api");
//define("DIR", $_SERVER["DOCUMENT_ROOT"]."/gofficev2/api");
//define("DIR_FOLDER", $_SERVER["DOCUMENT_ROOT"]."/gofficev2/users/gemstech");
//define("URL_FOLDER", "http://".$_SERVER["HTTP_HOST"]."/gofficev2/users/gemstech");
define("GIOVAO", "08:30:00");
define("MUONSANG", date("H:i:s",strtotime(GIOVAO)+3600));
define("NGHITRUA", "12:00:00");
define("SOMSANG", date("H:i:s",strtotime(NGHITRUA)-3600));
define("GIOCHIEU", "13:30:00");
define("MUONCHIEU", date("H:i:s",strtotime(GIOCHIEU)+3600));
define("GIORA", "18:00:00");
define("SOMCHIEU", date("H:i:s",strtotime(GIORA)-3600));
define("URL", "https://" . $_SERVER["HTTP_HOST"] . "/web-g-office");
define("ROOT_DIR", $_SERVER["DOCUMENT_ROOT"] . "/web-g-office/users/gemstech" );
define("URLFILE", "https://" . $_SERVER["HTTP_HOST"] . "/web-g-office/users/gemstech");
?>
