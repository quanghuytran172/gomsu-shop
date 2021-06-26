<?php

require('./core/App.php');
define("ROOT", dirname(__FILE__));
session_start();


$router = new App();