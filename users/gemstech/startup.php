<?php
define("DB_TYPE", "mysql");
define("DB_HOST", "localhost");
define("DB_NAME", "goffice_gemstech");
define("DB_USER", "root");
define("DB_PASS", "");
//define("URL", "http://".$_SERVER["HTTP_HOST"]."/gofficev2/api");
//define("DIR", $_SERVER["DOCUMENT_ROOT"]."/gofficev2/api");
//define("DIR_FOLDER", $_SERVER["DOCUMENT_ROOT"]."/gofficev2/users/gemstech");
//define("URL_FOLDER", "http://".$_SERVER["HTTP_HOST"]."/gofficev2/users/gemstech");
define("GIOVAO", "08:30:00",true);
define("MUONSANG", date("H:i:s",strtotime(GIOVAO)+3600),true);
define("NGHITRUA", "12:00:00",true);
define("SOMSANG", date("H:i:s",strtotime(NGHITRUA)-3600),true);
define("GIOCHIEU", "13:30:00",true);
define("MUONCHIEU", date("H:i:s",strtotime(GIOCHIEU)+3600),true);
define("GIORA", "18:00:00",true);
define("SOMCHIEU", date("H:i:s",strtotime(GIORA)-3600),true);
define("URL", "http://" . $_SERVER["HTTP_HOST"] . "/web-g-office/gemstech");
define("ROOT_DIR", $_SERVER["DOCUMENT_ROOT"] . "/web-g-office/users/gemstech" );
define("URLFILE", "http://" . $_SERVER["HTTP_HOST"] . "/web-g-office/users/gemstech");
?>
