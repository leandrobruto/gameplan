<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Entities\Strategy;

class Strategies extends BaseController
{
    private $strategyModel;
    private $sportModel;

    public function __construct()
    {
        $this->strategyModel = new \App\Models\StrategyModel();
        $this->sportModel = new \App\Models\SportModel();
    }

    public function getIndex()
    {
        $user = userLoggedIn();
        $strategies = $this->strategyModel->getStrategiesByUSer($user);

        $data = [
            'title' => 'Strategies listing',
            'user' => $user,
            'strategies' => $strategies->withDeleted(true)->paginate(10),
            'sports' => $this->sportModel->findAll(),
            'pager' => $this->strategyModel->pager,
        ];

        return view('Admin/Strategies/index', $data);
    }

    public function postStore()
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

    public function getSearch()
    {
        if (!$this->request->isAjax()) 
        {
            exit('Page not found');
        }

        $user = userLoggedIn();
        $strategies = $this->strategyModel->search($this->request->getGet('term'), $user);

        $result = [];

        foreach ($strategies as $strategy) {
            $data['id'] = $strategy->id;
            $data['value'] = $strategy->name;

            $result[] = $data;
        }

        return $this->response->setJson($result);
    }
}
