<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Entities\Competition;

class Competitions extends BaseController
{
    private $competitionModel;

    public function __construct()
    {
        $this->competitionModel = new \App\Models\CompetitionModel();
    }

    public function getIndex()
    {
        echo 'Page Not Found';
    }

    public function postStore()
    {
        if ($this->request->getMethod() === 'post') {
            
            $competition = new Competition($this->request->getPost());

            if ($this->competitionModel->protect(false)->insert($competition)) {
                return redirect()->to(site_url("manager/account/competitions"))
                                ->with('success', "Competition successfully registered!");
            } else {
                return redirect()->back()->with('errors_model', $this->competitionModel->errors())
                                        ->with('attention', "Please check the errors below.")
                                        ->withInput();
            }
        } else {
            /* It's not POST */
            return redirect()->back();
        }
    }
}
