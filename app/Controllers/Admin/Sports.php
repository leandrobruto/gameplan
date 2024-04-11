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

    public function postStore()
    {
        if ($this->request->getMethod() === 'post') {
            
            $sport = new Sport($this->request->getPost());

            if ($this->sportModel->protect(false)->insert($sport)) {
                return redirect()->to(site_url("admin/sports"))
                                ->with('success', "Sport successfully registered!");
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

    public function getSearch()
    {
        if (!$this->request->isAjax()) 
        {
            exit('Page not found');
        }

        $sports = $this->sportModel->search($this->request->getGet('term'));

        $result = [];

        foreach ($sports as $sport) {
            $data['id'] = $sport->id;
            $data['value'] = $sport->name;

            $result[] = $data;
        }

        return $this->response->setJson($result);
    }

    public function postDelete($id = null)
    {
        $sport = $this->findSportOr404($id);

        if ($this->request->getMethod() === 'post') {
            $this->sportModel->delete($id);
            return redirect()->to(site_url('admin/sports'))
                            ->with('success', "Sport successfully deleted.");
        }
    }

     /**
     * @param int $id
     * @return object Sport
     */
    private function findSportOr404($id = null)
    {
        if (!$id || !$sport = $this->sportModel->withDeleted(true)->where('id', $id)->first()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("We don't find the sport $id");
        }
        
        return $sport;
    }
}
