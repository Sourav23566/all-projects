<?php
$env=parse_ini_file(".env");
define("HOST",$env['HOST']);
define("USER",$env['USER']);
define("PASS",$env['PASS']);
define("DB",$env['DB']);
?>