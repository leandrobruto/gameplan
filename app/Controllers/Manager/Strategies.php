<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Entities\Strategy;

class Strategies extends BaseController
{
    private $strategyModel;

    public function __construct()
    {
        $this->strategyModel = new \App\Models\StrategyModel();
    }

    public function getIndex()
    {
        echo 'Page Not Found';
    }

    public function postStore()
    {
        if ($this->request->getMethod() === 'post') {
            
            $strategy = new Strategy($this->request->getPost());

            if ($this->strategyModel->protect(false)->insert($strategy)) {
                return redirect()->to(site_url("manager/account/strategies"))
                                ->with('success', "Strategy successfully registered!");
            } else {
                return redirect()->back()->with('errors_model', $this->strategyModel->errors())
                                        ->with('attention', "Please check the errors below.")
                                        ->withInput();
            }
        } else {
            /* It's not POST */
            return redirect()->back();
        }
    }
}
