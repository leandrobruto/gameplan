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
        $this->sportModel = new \App\Models\SportModel();
        $this->competitionModel = new \App\Models\CompetitionModel();
        $this->strategyModel = new \App\Models\StrategyModel();
    }

    public function getIndex()
    {
        $user = userLoggedIn();

        $data = [
            'title' => 'Bets',
            'user' => $user,
            'bets' => $this->betModel->findBetsByUser($user)->paginate(10),
            'count' => $this->betModel->countAllBetsByUser($user),
            'bankroll' => $this->bankrollModel->first(),
            'bankrolls' => $this->bankrollModel->findAll(),
            'sports' => $this->sportModel->findAll(),
            'competitions' => $this->competitionModel->findAll(),
            'strategies' => $this->strategyModel->findAll(),
            'pager' => $this->betModel->pager,
        ];

        $reports = $this->betModel->getReportsByUser($user);

        if (isset($reports->result)) {
            $data['result'] = $reports->result;
            $data['roi'] = number_format(($reports->result / $reports->stake) * 100, 2);
        } else {
            $data['result'] = 0;
            $data['roi'] = 0;
        }

        return view('Manager/Bets/index', $data);
    }

    public function postStore()
    {dd($this->request->getPost());
        if ($this->request->getMethod() === 'post') {
            
            $bet = new Bet($this->request->getPost('bet'));
            $bet->code = $this->betModel->generateBetCode();

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
