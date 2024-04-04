<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Entities\Bet;

class Bets extends BaseController
{
    private $betModel;
    private $matchModel;
    private $sportModel;
    private $competitionModel;
    private $strategyModel;
    private $bankrollModel;
    
    public function __construct()
    {
        $this->betModel = new \App\Models\BetModel();
        $this->matchModel = new \App\Models\MatchModel();
        $this->bankrollModel = new \App\Models\BankrollModel();
        $this->userModel = new \App\Models\SportModel();
        $this->competitionModel = new \App\Models\CompetitionModel();
        $this->strategyModel = new \App\Models\StrategyModel();
    }

    public function getIndex()
    {
        $data = [
            'title' => 'Bets',
            'user' => service('auth')->getUserLoggedIn(),
            'count' => $this->betModel->countAllResults(),
            'bankrolls' => $this->bankrollModel->findAll(),
            'sports' => $this->userModel->findAll(),
            'competitions' => $this->competitionModel->findAll(),
            'strategies' => $this->strategyModel->findAll(),
        ];
        
        $bet = $this->betModel->first();
        $data['result'] = $bet->result;
        $data['roi'] = ($bet->result / $bet->stake) * 100;

        return view('Manager/Bets/index', $data);
    }

    public function postStore()
    {
        if ($this->request->getMethod() === 'post') {
            
            $bet = new Bet($this->request->getPost('bet'));

            if ($this->betModel->insert($bet)) {

                $match = new Bet($this->request->getPost('match'));
                $match->bet_id = $this->betModel->getInsertID();
                $this->matchModel->insert($match);

                return redirect()->to(site_url("manager/bets"))
                                ->with('success', "Bet created successfully!");
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
