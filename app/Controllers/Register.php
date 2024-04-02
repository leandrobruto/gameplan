<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Profile;

class Register extends BaseController
{
    private $userModel;
    private $profileModel;

    public function __construct() {
        $this->userModel = new \App\Models\UserModel();
        $this->profileModel = new \App\Models\ProfileModel();
    }

    public function getIndex($id = null) 
    {
        $data = [
            'title' => 'Sign up',
        ];

        return view('Register/signup', $data);
    }

    public function postSignUp()
    {
        if ($this->request->getMethod() == 'post') {

            $user = new \App\Entities\User($this->request->getPost());

            $this->userModel->disablePhoneValidation();
            
            $user->startActivation();
            
            if ($this->userModel->insert($user)) {

                $profile = new \App\Entities\Profile();
                $profile->user_id = $this->userModel->getInsertID();
                
                $this->profileModel->protect(false)->insert($profile);

                $this->sendEmailToActivateAccount($user);
                
                return redirect()->to(site_url('register/activationSent'));

            } else {
                return redirect()->back()->with('errors_model', $this->userModel->errors())
                                        ->with('attention', "Please check the errors below.")
                                        ->withInput();
            }


        } else {
            return redirect()->back();
        }
    }

    public function getActivationSent() 
    {
        $data = [
            'title' => 'Account activation email sent to your inbox.',
        ];

        return view('Register/activation_sent', $data);
    }

    public function getActivate(string $token) 
    {
        if ($token == null) {
            return redirect()->to(site_url('login'));
        }

        $this->userModel->activateAccountByToken($token);

        return redirect()->to(site_url('login'))->with('success', 'Account activated successfully.');
    }

    private function sendEmailToActivateAccount(object $user) {

        $email = \Config\Services::email();

        $email->setFrom('no-reply@gameplan.com.br', 'GamePlan');
        $email->setTo($user->email);

        $email->setSubject('Account activation.');
        
        $message = view('Register/activation_email', ['user' => $user]);

        $email->setMessage($message);

        $email->send();
    }
}
