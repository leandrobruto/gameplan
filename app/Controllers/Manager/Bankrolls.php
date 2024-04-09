<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Entities\Bankroll;

class Bankrolls extends BaseController
{
    private $bankrollModel;

    public function __construct()
    {
        $this->bankrollModel = new \App\Models\BankrollModel();
    }

    public function getIndex()
    {
        $data = [
            'title' => 'Bankrolls',
        ];
        
        return view('Manager/Dashboard/index', $data);
    }

    public function postStore()
    {
        if ($this->request->getMethod() === 'post') {
            
            $bankroll = new Bankroll($this->request->getPost());

            if ($this->bankrollModel->protect(false)->insert($bankroll)) {
                return redirect()->to(site_url("manager/account/bankrolls"))
                                ->with('success', "Bankroll successfully registered!");
            } else {
                return redirect()->back()->with('errors_model', $this->bankrollModel->errors())
                                        ->with('attention', "Please check the errors below.")
                                        ->withInput();
            }
        } else {
            /* It's not POST */
            return redirect()->back();
        }
    }
}
