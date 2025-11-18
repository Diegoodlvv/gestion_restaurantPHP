<?php

namespace App\Controllers;

use App\Model\Form;
use App\Model\Error;
use App\Manager\UtilisateurManager;
use App\Model\Session;

class LoginController
{
    protected Form $form;
    protected Error $errors;

    public function __construct(array $postData)
    {
        $this->errors = new Error();
        $this->form = new Form($postData, $this->errors);
    }

    public function handle(): array
    {
        $userConnecte = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            if (!$this->form->isEmpty('email')) {

                $this->form->isEmailValid('email');

                $this->form->isEmpty('password');
            }


            $data = $this->form->getData();

            if ($this->errors->isFormValid()) {
                $manager = new UtilisateurManager();

                if (!$manager->authentification($data['email'], $data['password'])) {
                    $this->errors->addError('email', 'Identifiant ou mot de passe incorrect');
                } else {
                    $userConnecte = $userBDD ?? null;
                }

                if (!empty($userConnecte)) {
                    Session::newSessionUser('user', $userConnecte);
                    UtilisateurManager::redirectionRole($userConnecte);
                }
            }
        }


        return [
            'formData' => $data,
            'formErrors' => $this->form->getErrors(),
        ];
    }
}
