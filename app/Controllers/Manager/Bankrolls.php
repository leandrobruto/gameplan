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

    public function postUpdate($id = null)
    {
        if ($this->request->getMethod() === 'post') {
            $bankroll = $this->findBankrollOr404($id);

            if ($bankroll->deleted_at != null) {
                return redirect()->back()->with('info', "The bankroll $bankroll->nome is deleted. Therefore, it is not possible to edit it.");
            }

        } else {
            /* It's not POST */
            return redirect()->back();
        }

        $post = $this->request->getPost();

        $bankroll->fill($post);
        
        if (!$bankroll->hasChanged()) {
            return redirect()->back()->with('info', "There is no data to update.");
        }
        
        if ($this->bankrollModel->protect(false)->save($bankroll)) {
            return redirect()->to(site_url("manager/dashboard"))
                            ->with('success', "Bankroll updated successfully!");
        } else {
            return redirect()->back()->with('errors_model', $this->bankrollModel->errors())
                                    ->with('attention', "Please check the errors below.")
                                    ->withInput();
        }
    }

    /**
     * @param int $id
     * @return object Bankroll
     */
    private function findBankrollOr404($id = null)
    {
        if (!$id || !$bankroll = $this->bankrollModel->withDeleted(true)->where('id', $id)->first()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("We don't find the bakkroll $id");
        }
        
        return $bankroll;
    }
}
