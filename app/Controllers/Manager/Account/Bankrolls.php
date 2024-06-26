<?php

namespace App\Controllers\Manager\Account;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Entities\Bankroll;

class Bankrolls extends BaseController
{
    private $bankrollModel;
    private $currencyModel;

    public function __construct()
    {
        $this->bankrollModel = new \App\Models\BankrollModel();
        $this->currencyModel = new \App\Models\CurrencyModel();
    }

    public function getIndex()
    {
        $user = userLoggedIn();
        $bankrolls = $this->bankrollModel->getUserBankrolls($user);

        $data = [
            'title' => 'Bankrolls',
            'user' => $user,
            'bankrolls' => $bankrolls,
            'currencies' => $this->currencyModel->findAll(),
            'pager' => $this->bankrollModel->pager,
        ];
        
        return view('Manager/Account/Bankrolls/index', $data);
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

    public function postUpdate($id = null)
    {
        if ($this->request->getMethod() === 'post') {
            $bankroll = $this->findBankrollOr404($this->request->getPost('bankroll_id'));

            if ($bankroll->deleted_at != null) {
                return redirect()->back()->with('info', "The bankroll $bankroll->nome is deleted. Therefore, it is not possible to edit it.");
            }

        } else {
            /* It's not POST */
            return redirect()->back();
        }

        $post = $this->request->getPost();
        unset($post['bankroll_id']);

        $bankroll->fill($post);

        if (!$bankroll->hasChanged()) {
            return redirect()->back()->with('info', "There is no data to update.");
        }
        
        if ($this->bankrollModel->save($bankroll)) {
            return redirect()->to(site_url("manager/account/bankrolls"))
                            ->with('success', "Bankroll updated successfully!");
        } else {
            return redirect()->back()->with('errors_model', $this->bankrollModel->errors())
                                    ->with('attention', "Please check the errors below.")
                                    ->withInput();
        }
    }

    public function postDefault($id = null)
    {
        if ($this->request->getMethod() === 'post') 
        {
            $bankroll = $this->findBankrollOr404($id);

            if ($bankroll->deleted_at != null) 
            {
                return redirect()->back()->with('info', "The bankroll $bankroll->nome is deleted. Therefore, it is not possible to edit it.");
            }
            
            if ($bankroll->is_default == 1) 
            {
                return redirect()->back()->with('success', "Default Bankroll was set successfully!");
            }

        } 
        else 
        {
            /* It's not POST */
            return redirect()->back();
        }

        $post = $this->request->getPost();

        $bankroll->fill($post);

        if (!$bankroll->hasChanged()) 
        {
            return redirect()->back()->with('info', "There is no data to update.");
        }
        
        $user = userLoggedIn();
        if ($this->bankrollModel->set('is_default', 0)->where('is_default', 1)->where('user_id', $user->id)->update())
        {
            if ($this->bankrollModel->save($bankroll)) 
            {
                return redirect()->back()->with('success', "Default Bankroll was set successfully!");
            }
        }
    }

    public function postReset($id = null)
    {
        if ($this->request->getMethod() === 'post') {
            $bankroll = $this->findBankrollOr404($this->request->getPost('bankroll_id'));

            if ($bankroll->deleted_at != null) {
                return redirect()->back()->with('info', "The bankroll $bankroll->nome is deleted. Therefore, it is not possible to reset it.");
            }

        } else {
            /* It's not POST */
            return redirect()->back();
        }

        $data = [
            'currency_id' => 1,
            'initial_balance' => 0.00,
            'comission' => 0,
        ];
        

        $bankroll->fill($data);

        if (!$bankroll->hasChanged()) {
            return redirect()->back()->with('info', "There is no data to update.");
        }
        
        if ($this->bankrollModel->save($bankroll)) {
            return redirect()->to(site_url("manager/account/bankrolls"))
                            ->with('success', "Bankroll updated successfully!");
        } else {
            return redirect()->back()->with('errors_model', $this->bankrollModel->errors())
                                    ->with('attention', "Please check the errors below.")
                                    ->withInput();
        }
    }

    public function postDelete($id = null)
    {
        $bankroll = $this->findBankrollOr404($this->request->getPost());

        if ($this->request->getMethod() === 'post') {
            $this->bankrollModel->delete($bankroll->id);
            return redirect()->to(site_url('manager/account/bankrolls'))
                            ->with('success', "Bankroll successfully deleted.");
        }
    }

    /**
     * @param int $id
     * @return object Bankroll
     */
    private function findBankrollOr404($id = null)
    {
        if (!$id || !$bankroll = $this->bankrollModel->where('id', $id)->first()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("We don't find the bankroll $id");
        }
        
        return $bankroll;
    }
}
