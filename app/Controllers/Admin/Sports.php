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

    public function postUpdate($id = null)
    {
        if ($this->request->getMethod() === 'post') {
            $sport = $this->findSportOr404($this->request->getPost('sport_id'));

            if ($sport->deleted_at != null) {
                return redirect()->back()->with('info', "The user $sport->name is deleted. Therefore, it is not possible to edit it.");
            }

        } else {
            /* It's not POST */
            return redirect()->back();
        }

        $post = $this->request->getPost();
        unset($post['sport_id']);

        $sport->fill($post);
        
        if (!$sport->hasChanged()) {
            return redirect()->back()->with('info', "There is no data to update.");
        }
        
        if ($this->sportModel->protect(false)->save($sport)) {
            return redirect()->to(site_url("admin/sports"))
                            ->with('success', "Sport updated successfully!");
        } else {
            return redirect()->back()->with('errors_model', $this->sportModel->errors())
                                    ->with('attention', "Please check the errors below.")
                                    ->withInput();
        }
    }

    public function postDelete($id = null)
    {
        $sport = $this->findSportOr404($this->request->getPost());

        if ($sport->deleted_at != null) {
            return redirect()->back()->with('info', "The sport $sport->name is deleted. Therefore, it is not possible to edit it.");
        }

        if ($this->request->getMethod() === 'post') {
            $this->sportModel->delete($sport->id);
            return redirect()->to(site_url('admin/sports'))
                            ->with('success', "Sport successfully deleted.");
        }
    }

    public function getUndelete($id = null)
    {
        $sport = $this->findSportOr404($id);
        
        if ($sport->deleted_at == null) {
            return redirect()->back()->with('info', "Only deleted sports can be recovered.");
        }

        if ($this->sportModel->undoDelete($id)) {
            return redirect()->back()->with('success', "Deletion successfully undone!");
        } else {
            return redirect()->back()->with('errors_model', $this->sportModel->errors())
                                    ->with('attention', "Please check the errors below.")
                                    ->withInput();
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
