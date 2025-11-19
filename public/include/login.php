<?php

require_once '../../includes/head.php';

use App\Controllers\LoginController;
use App\Model\Session;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('../../templates/');
$twig = new Environment($loader);


$controller = new LoginController($_POST ?? []);
$data = $controller->connexion();



echo $twig->render('login.html.twig', [
    'formData' => $data['formData'],
    'formErrors' => $data['formErrors']
]);
