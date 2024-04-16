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
    private $tagModel;
    
    public function __construct()
    {
        $this->betModel = new \App\Models\BetModel();
        $this->matchModel = new \App\Models\MatchModel();
        $this->bankrollModel = new \App\Models\BankrollModel();
        $this->sportModel = new \App\Models\SportModel();
        $this->competitionModel = new \App\Models\CompetitionModel();
        $this->strategyModel = new \App\Models\StrategyModel();
        $this->tagModel = new \App\Models\TagModel();
    }

    public function getIndex()
    {
        $user = userLoggedIn();
        $bankroll = defaultBankroll();
        // dd($this->betModel->getBetsByUser($user, $bankroll)->paginate(10));
        $data = [
            'title' => 'Bets',
            'user' => $user,
            'bets' => $this->betModel->getBetsByUser($user, $bankroll)->paginate(10),
            'bankrolls' => $this->bankrollModel->getUserBankrolls($user),
            'sports' => $this->sportModel->findAll(),
            'competitions' => $this->competitionModel->getCompetitionsByUser($user)->find(),
            'strategies' => $this->strategyModel->getStrategiesByUser($user)->find(),
            'reports' => $this->betModel->getBetsReports($user, $bankroll),
            'pager' => $this->betModel->pager,
        ];

        return view('Manager/Bets/index', $data);
    }

    public function postStore()
    {
        if ($this->request->getMethod() === 'post') {
            $bet = new Bet($this->request->getPost('bet'));
            $bet->code = $this->betModel->generateBetCode();

            if ($this->betModel->insert($bet)) {

                $match = $this->request->getPost('match');
                $match['bet_id'] = $this->betModel->getInsertID();
                $this->matchModel->insert($match);

                if ($tags = $this->request->getPost('tags')) {
                    $array_tags = array();

                    foreach ($tags as $tag)
                    {
                        $data['name'] = $tag;
                        $data['bet_id'] = $this->betModel->getInsertID();
                        array_push($array_tags, $data);
                    }
                    
                    $this->tagModel->insertBatch($array_tags);
                }

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

    public function postStoreMultiple()
    {
        if ($this->request->getMethod() === 'post') {
            
            $bet =  new Bet($this->request->getPost('bet'));
            
            $bet->code = $this->betModel->generateBetCode();

            if ($this->betModel->insert($bet)) {

                $matches = $this->request->getPost('match');

                $array_matches = array();

                foreach($matches as $key => $match) {

                    if(!empty($match['event']) && !empty($match['odd'])) {

                        $match['bet_id'] = $this->betModel->getInsertID();

                        array_push($array_matches, $match);
                    }
                }

                $this->matchModel->insertBatch($array_matches);

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

    public function postDelete($id = null)
    {
        $bet = $this->findBetOr404($this->request->getPost());

        if ($this->request->getMethod() === 'post') {
            $this->betModel->delete($bet->id);
            return redirect()->to(site_url('manager/bets'))
                            ->with('success', "Bet successfully deleted.");
        }
    }

    /**
     * @param int $id
     * @return object Bet
     */
    private function findBetOr404($id = null)
    {
        if (!$id || !$bet = $this->betModel->where('id', $id)->first()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("We don't find the bet $id");
        }
        
        return $bet;
    }
}
