<?php

namespace App\Controllers\Admin;

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
        $data = [
            'title' => 'Strategies listing',
            'strategies' => $this->strategyModel->withDeleted(true)->paginate(10),
            'pager' => $this->strategyModel->pager,
        ];

        return view('Admin/Strategies/index', $data);
    }

    public function postCreate()
    {
        if ($this->request->getMethod() === 'post') {
            
            $strategy = new Strategy($this->request->getPost());

            if ($this->strategyModel->protect(false)->insert($strategy)) {
                return redirect()->to(site_url("admin/strategies/show/" . $this->strategyModel->getInsertID()))
                                ->with('success', "Strategy $strategy->name successfully registered!");
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
