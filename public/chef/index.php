<?php

require_once '../../includes/head.php';

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader('../../templates/');
$twig = new Environment($loader);


echo $twig->render('base.html.twig', []);
