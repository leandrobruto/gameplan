<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Entities\Bet;

class Bets extends BaseController
{
    private $betModel;
    private $eventModel;
    private $sportModel;
    private $competitionModel;
    private $strategyModel;
    private $bankrollModel;
    private $tagModel;
    
    public function __construct()
    {
        $this->betModel = new \App\Models\BetModel();
        $this->eventModel = new \App\Models\EventModel();
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

    public function getTags()
    {
        if (!$this->request->isAjax()) 
        {
            exit('Page not found');
        }

        $tags = $this->tagModel->search($this->request->getGet('q'));

        $result = [];

        foreach ($tags as $tag) {
            // $data['id'] = $tag->id;
            $data['value'] = $tag->name;
            
            $result[] = $data;
        }

        return $this->response->setJson($result);
    }

    public function postStore()
    {
        if ($this->request->getMethod() === 'post') {
            $bet = new Bet($this->request->getPost('bet'));
            $bet->code = $this->betModel->generateBetCode();

            if ($this->betModel->insert($bet)) {

                $event = $this->request->getPost('event');
                $event['bet_id'] = $this->betModel->getInsertID();
                $this->eventModel->insert($event);

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

                $events = $this->request->getPost('event');

                $array_events = array();

                foreach($events as $key => $event) {

                    if(!empty($event['event']) && !empty($event['odd'])) {

                        $event['bet_id'] = $this->betModel->getInsertID();

                        array_push($array_events, $event);
                    }
                }

                $this->eventModel->insertBatch($array_events);

                return redirect()->to(site_url("manager/bets"))
                                ->with('success', "Bet created successfully!");
            } else {
                return redirect()->back()->with('errors_model', $this->betModel->errors())
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
        // dd($this->request->getPost());
        if ($this->request->getMethod() === 'post') {
            $bet = $this->findBetOr404($this->request->getPost('bet_id'));

            if ($bet->deleted_at != null) {
                return redirect()->back()->with('info', "The bankroll $bet->event is deleted. Therefore, it is not possible to edit it.");
            }

        } else {
            /* It's not POST */
            return redirect()->back();
        }

        $postBet = $this->request->getPost('bet');
        $postEvent = $this->request->getPost('event');

        $bet->fill($postBet);

        $event = $this->eventModel->where('bet_id', $bet->id)->first();

        $event->fill($postEvent);

        if (!$bet->hasChanged() && !$event->hasChanged()) {
            return redirect()->back()->with('info', "There is no data to update.");
        }
        
        $update = false;

        if ($bet->hasChanged()) {
            $this->betModel->save($bet);
            $update = true;
        }

        if ($event->hasChanged()) {
            $this->eventModel->save($event);
            $update = true;
        }

        if ($update) {
            return redirect()->to(site_url("manager/bets"))
                            ->with('success', "Bet updated successfully!");
        } else {
            return redirect()->back()->with('errors_model', $this->betModel->errors())
                                    ->with('attention', "Please check the errors below.")
                                    ->withInput();
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
