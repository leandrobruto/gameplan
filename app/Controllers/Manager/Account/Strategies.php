<?php

namespace App\Controllers\Manager\Account;

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
        $strategies = $this->strategyModel->getStrategiesByUser($user);
        
        $data = [
            'title' => 'Strategies',
            'user' => $user,
            'strategies' => $this->strategyModel->paginate(10),
            'sports' => $this->sportModel->findAll(),
            'pager' => $this->strategyModel->pager,
        ];
        
        return view('Manager/Account/Strategies/index', $data);
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

    public function postUpdate($id = null)
    {
        if ($this->request->getMethod() === 'post') {
            $strategy = $this->findStrategyOr404($this->request->getPost('strategy_id'));

            if ($strategy->deleted_at != null) {
                return redirect()->back()->with('info', "The user $strategy->nome is deleted. Therefore, it is not possible to edit it.");
            }

        } else {
            /* It's not POST */
            return redirect()->back();
        }

        $post = $this->request->getPost();
        unset($post['strategy_id']);

        $strategy->fill($post);
        
        if (!$strategy->hasChanged()) {
            return redirect()->back()->with('info', "There is no data to update.");
        }
        
        if ($this->strategyModel->save($strategy)) {
            return redirect()->to(site_url("manager/account/strategies"))
                            ->with('success', "Strategy updated successfully!");
        } else {
            return redirect()->back()->with('errors_model', $this->strategyModel->errors())
                                    ->with('attention', "Please check the errors below.")
                                    ->withInput();
        }
    }

    public function postDelete($id = null)
    {
        $strategy = $this->findStrategyOr404($this->request->getPost());

        if ($this->request->getMethod() === 'post') {
            $this->strategyModel->delete($strategy->id);
            return redirect()->to(site_url('manager/account/strategies'))
                            ->with('success', "Strategy successfully deleted.");
        }
    }

    /**
     * @param int $id
     * @return object Strategy
     */
    private function findStrategyOr404($id = null)
    {
        if (!$id || !$strategy = $this->strategyModel->where('id', $id)->first()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("We don't find the strategy $id");
        }
        
        return $strategy;
    }
}
