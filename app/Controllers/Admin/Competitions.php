<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Entities\Competition;

class Competitions extends BaseController
{
    private $competitionModel;

    public function __construct()
    {
        $this->competitionModel = new \App\Models\CompetitionModel();
    }

    public function getIndex()
    {
        $data = [
            'title' => 'Competitions listing',
            'competitions' => $this->competitionModel->withDeleted(true)->paginate(10),
            'pager' => $this->competitionModel->pager,
        ];

        return view('Admin/Competitions/index', $data);
    }

    public function postCreate()
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
}
