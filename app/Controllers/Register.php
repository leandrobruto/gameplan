<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Profile;

class Register extends BaseController
{
    private $userModel;
    private $profileModel;
    private $bankrollModel;
    private $competitionModel;
    private $strategyModel;

    public function __construct() {
        $this->userModel = new \App\Models\UserModel();
        $this->profileModel = new \App\Models\ProfileModel();
        $this->bankrollModel = new \App\Models\BankrollModel();
        $this->competitionModel = new \App\Models\CompetitionModel();
        $this->strategyModel = new \App\Models\StrategyModel();
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
                $profile->first_name = $this->request->getPost('first_name');
                $profile->last_name = $this->request->getPost('last_name');
                $profile->default_date_range_id = 1;
                $profile->default_sport_id = 1;
                
                // Store User Profile
                $this->profileModel->protect(false)->insert($profile);

                $bankroll = $this->bankrollModel->getDefaultBankroll($this->userModel->getInsertID());

                // Store Default User Bankroll
                $this->bankrollModel->protect(false)->insert($bankroll);

                $competition = $this->competitionModel->getDefaultCompetitions($this->userModel->getInsertID());

                // Store Default User Competitions
                $this->competitionModel->protect(false)->insertBatch($competition);

                $strategy = $this->strategyModel->getDefaultStrategies($this->userModel->getInsertID());

                // Store Default User Strategies
                $this->strategyModel->protect(false)->insertBatch($strategy);

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
