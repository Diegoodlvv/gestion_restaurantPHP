<?php

require_once '../../includes/head.php';

use App\Manager\UtilisateurManager;
use App\Model\Session;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('../../templates/');
$twig = new Environment($loader);

UtilisateurManager::isUserConnected();

echo $twig->render('base.html.twig', [
    'user' => Session::getSession('user'),
]);
