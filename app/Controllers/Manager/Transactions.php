<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Entities\Transaction;

class Transactions extends BaseController
{
    private $transactionModel;

    public function __construct()
    {
        $this->transactionModel = new \App\Models\TransactionModel();
    }

    public function getIndex()
    {
        $bankroll = defaultBankroll();

        $data = [
            'title' => 'Transactions',
            'transactions' => $this->transactionModel->getTransactions($bankroll)->paginate(10),
            'bankroll' => defaultBankroll(),
            'reports' =>$this->transactionModel->getTransactionsReports($bankroll),
            'pager' => $this->transactionModel->pager,
        ];
        
        return view('Manager/Transactions/index', $data);
    }

    public function postStore()
    {
        if ($this->request->getMethod() === 'post') {
            
            $transaction = new Transaction($this->request->getPost());

            if ($this->transactionModel->insert($transaction)) {
                return redirect()->to(site_url("manager/transactions"))
                                ->with('success', "Transaction successfully registered!");
            } else {
                return redirect()->back()->with('errors_model', $this->transactionModel->errors())
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
            $transaction = $this->findTransactionOr404($this->request->getPost('transaction_id'));

            if ($transaction->deleted_at != null) {
                return redirect()->back()->with('info', "The transaction $transaction->nome is deleted. Therefore, it is not possible to edit it.");
            }

        } else {
            /* It's not POST */
            return redirect()->back();
        }

        $post = $this->request->getPost();
        unset($post['transaction_id']);

        $transaction->fill($post);
        
        if (!$transaction->hasChanged()) {
            return redirect()->back()->with('info', "There is no data to update.");
        }
        
        if ($this->transactionModel->save($transaction)) {
            return redirect()->to(site_url("manager/transactions"))
                            ->with('success', "Transaction updated successfully!");
        } else {
            return redirect()->back()->with('errors_model', $this->transactionModel->errors())
                                    ->with('attention', "Please check the errors below.")
                                    ->withInput();
        }
    }

    public function postDelete($id = null)
    {
        $transaction = $this->findTransactionOr404($this->request->getPost('transaction_id'));

        if ($this->request->getMethod() === 'post') {
            $this->transactionModel->delete($transaction->id);
            return redirect()->to(site_url('manager/transactions'))
                            ->with('success', "Transaction successfully deleted.");
        }
    }

    /**
     * @param int $id
     * @return object transaction
     */
    private function findTransactionOr404($id = null)
    {
        if (!$id || !$transaction = $this->transactionModel->where('id', $id)->first()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("We don't find the transaction $id");
        }
        
        return $transaction;
    }
}
