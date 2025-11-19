<?php
require_once '../../includes/head.php';

use App\Model\Session;

Session::stop();
header('Location: login.php');
