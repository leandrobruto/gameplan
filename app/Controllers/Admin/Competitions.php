<?php

namespace App\Controllers\Admin;

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

        $data = [
            'title' => 'Competitions listing',
            'user' => $user,
            'competitions' => $this->competitionModel->withDeleted(true)->paginate(10),
            'sports' => $this->sportModel->findAll(),
            'pager' => $this->competitionModel->pager,
        ];

        return view('Admin/Competitions/index', $data);
    }

    public function postStore()
    {
        if ($this->request->getMethod() === 'post') {
            
            $competition = new Competition($this->request->getPost());

            if ($this->competitionModel->protect(false)->insert($competition)) {
                return redirect()->to(site_url("admin/competitions/show/" . $this->competitionModel->getInsertID()))
                                ->with('success', "Competition $competition->name successfully registered!");
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

    public function getSearch()
    {
        if (!$this->request->isAjax()) 
        {
            exit('Page not found');
        }

        $user = userLoggedIn();
        $competitions = $this->competitionModel->search($this->request->getGet('term'), $user);

        $result = [];

        foreach ($competitions as $competition) {
            $data['id'] = $competition->id;
            $data['value'] = $competition->name;

            $result[] = $data;
        }

        return $this->response->setJson($result);
    }
}
