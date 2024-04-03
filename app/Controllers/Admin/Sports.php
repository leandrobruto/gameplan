<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Entities\Sport;

class Sports extends BaseController
{
    private $sportModel;

    public function __construct()
    {
        $this->sportModel = new \App\Models\SportModel();
    }

    public function getIndex()
    {
        $data = [
            'title' => 'Sports listing',
            'sports' => $this->sportModel->withDeleted(true)->paginate(10),
            'pager' => $this->sportModel->pager,
        ];

        return view('Admin/Sports/index', $data);
    }

    public function postCreate()
    {
        if ($this->request->getMethod() === 'post') {
            
            $sport = new Sport($this->request->getPost());

            if ($this->sportModel->protect(false)->insert($sport)) {
                return redirect()->to(site_url("admin/sports/show/" . $this->sportModel->getInsertID()))
                                ->with('success', "Sport $sport->name successfully registered!");
            } else {
                return redirect()->back()->with('errors_model', $this->sportModel->errors())
                                        ->with('attention', "Please check the errors below.")
                                        ->withInput();
            }
        } else {
            /* It's not POST */
            return redirect()->back();
        }
    }
}
