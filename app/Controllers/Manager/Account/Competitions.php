<?php

namespace App\Controllers\Manager\Account;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Entities\Competition;

class Competitions extends BaseController
{
    private $competitionModel;
    private $sportModel;

    public function __construct()
    {
        $this->competitionModel = new \App\Models\CompetitionModel();
        $this->sportModel = new \App\Models\SportModel();
    }

    public function getIndex()
    {
        $user = userLoggedIn();
        $competitions = $this->competitionModel->getCompetitionsByUser($user);

        $data = [
            'title' => 'Competitions',
            'user' => $user,
            'competitions' => $competitions->paginate(10),
            'sports' => $this->sportModel->findAll(),
            'pager' => $this->competitionModel->pager,
        ];
        
        return view('Manager/Account/Competitions/index', $data);
    }

    public function postStore()
    {
        if ($this->request->getMethod() === 'post') {
            
            $competition = new Competition($this->request->getPost());

            if ($this->competitionModel->protect(false)->insert($competition)) {
                return redirect()->to(site_url("manager/account/competitions"))
                                ->with('success', "Competition successfully registered!");
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

    public function postUpdate($id = null)
    {
        if ($this->request->getMethod() === 'post') {
            $competition = $this->findCompetitionOr404($this->request->getPost('competition_id'));

            if ($competition->deleted_at != null) {
                return redirect()->back()->with('info', "The Competition $competition->nome is deleted. Therefore, it is not possible to edit it.");
            }

        } else {
            /* It's not POST */
            return redirect()->back();
        }

        $post = $this->request->getPost();
        unset($post['competition_id']);

        $competition->fill($post);
        
        if (!$competition->hasChanged()) {
            return redirect()->back()->with('info', "There is no data to update.");
        }
        
        if ($this->competitionModel->save($competition)) {
            return redirect()->to(site_url("manager/account/competitions"))
                            ->with('success', "Competition updated successfully!");
        } else {
            return redirect()->back()->with('errors_model', $this->competitionModel->errors())
                                    ->with('attention', "Please check the errors below.")
                                    ->withInput();
        }
    }

    public function postDelete($id = null)
    {
        $competition = $this->findCompetitionOr404($this->request->getPost());

        if ($this->request->getMethod() === 'post') {
            $this->competitionModel->delete($competition->id);
            return redirect()->to(site_url('manager/account/competitions'))
                            ->with('success', "Competition successfully deleted.");
        }
    }

    /**
     * @param int $id
     * @return object Competition
     */
    private function findCompetitionOr404($id = null)
    {
        if (!$id || !$competition = $this->competitionModel->where('id', $id)->first()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("We don't find the competition $id");
        }
        
        return $competition;
    }
}
