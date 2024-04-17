<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\User;
use App\Entities\Profile;

class Users extends BaseController
{
    private $userModel;
    private $profileModel;
    private $bankrollModel;
    private $competitionModel;
    private $strategyModel;
    
    public function __construct()
    {
        $this->userModel = new \App\Models\UserModel();
        $this->profileModel = new \App\Models\ProfileModel();
        $this->bankrollModel = new \App\Models\BankrollModel();
        $this->competitionModel = new \App\Models\CompetitionModel();
        $this->strategyModel = new \App\Models\StrategyModel();
    }

    public function getIndex()
    {
        $data = [
            'title' => 'Users listing',
            'users' => $this->userModel->getAllUsersWithProfile()->withDeleted(true)->paginate(10),
            'pager' => $this->userModel->pager,
        ];
        
        return view('Admin/Users/index', $data);
    }

    public function getCreate()
    {
        $user = new user();
        $profile = new Profile();

        $data = [
            'title'     => "Creating a new user",
            'user' => $user,
            'profile' => $profile,
        ];

        return view('Admin/Users/create', $data);
    }

    public function postStore()
    {
        if ($this->request->getMethod() === 'post') {
            
            $user = new User($this->request->getPost('user'));

            if ($this->userModel->protect(false)->insert($user)) {

                $profile = new \App\Entities\Profile($this->request->getPost('profile'));
                $profile->user_id = $this->userModel->getInsertID();
                $profile->default_date_range_id = 1;
                $profile->default_sport_id = 1;
                
                // Store User Profile
                $this->profileModel->protect(false)->insert($profile);

                $bankroll = $this->bankrollModel->getDefaultBankroll($this->userModel->getInsertID());

                // Store Default User Bankroll
                $this->bankrollModel->protect(false)->insert($bankroll);

                $competition = $this->competitionModel->getDefaultCompetitions($this->userModel->getInsertID());

                // Store Default User Competitions
                $this->competitionModel->protect(false)->insertBatch($competition);

                $strategy = $this->strategyModel->getDefaultStrategies($this->userModel->getInsertID());

                // Store Default User Strategies
                $this->strategyModel->protect(false)->insertBatch($strategy);

                return redirect()->to(site_url("admin/users/show/" . $this->userModel->getInsertID()))
                                ->with('success', "User $user->nome successfully registered!");
            } else {
                return redirect()->back()->with('errors_model', $this->userModel->errors())
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

        $users = $this->userModel->search($this->request->getGet('term'));

        $result = [];

        foreach ($users as $user) {
            $data['id'] = $user->id;
            
            if (str_contains($user->username, $this->request->getGet('term'))){
                $data['value'] = $user->username;
            } else {
                $data['value'] = $user->first_name . ' ' . $user->last_name;
            }
            
            $result[] = $data;
        }

        return $this->response->setJson($result);
    }
    
    public function getShow($id = null)
    {
        $user = $this->findUserOr404($id);
        $profile = $this->profileModel->findProfileByUserId($user->id);

        $data = [
            'title'     => "User Details",
            'user' => $user,
            'profile' => $profile,
        ];

        return view('Admin/Users/show', $data);
    }

    public function getEdit($id = null)
    {
        $user = $this->findUserOr404($id);
        $profile = $this->profileModel->findProfileByUserId($user->id);

        if ($user->deleted_at != null) {
            return redirect()->back()->with('info', "The user $user->username is deleted. Therefore, it is not possible to edit it.");
        }
        
        $data = [
            'title'     => "Editing the user $user->username",
            'user' => $user,
            'profile' =>$profile,
        ];

        return view('Admin/Users/edit', $data);
    }

    public function postUpdate($id = null)
    {
        if ($this->request->getMethod() === 'post') {
            $user = $this->findUserOr404($id);

            if ($user->deleted_at != null) {
                return redirect()->back()->with('info', "The user $user->username is deleted. Therefore, it is not possible to edit it.");
            }

        } else {
            /* It's not POST */
            return redirect()->back();
        }

        $post = $this->request->getPost();

        if (empty($post['password'])) {
            $this->userModel->disablePasswordValidation();
            unset($post['password']);
            unset($post['password_confirmation']);
        }

        $user->fill($post);
        
        if (!$user->hasChanged()) {
            return redirect()->back()->with('info', "There is no data to update.");
        }
        
        if ($this->userModel->protect(false)->save($user)) {
            return redirect()->to(site_url("admin/users/show/$user->id"))
                            ->with('success', "User $user->username updated successfully!");
        } else {
            return redirect()->back()->with('errors_model', $this->userModel->errors())
                                    ->with('attention', "Please check the errors below.")
                                    ->withInput();
        }
    }

    public function getDelete($id = null)
    {
        $user = $this->findUserOr404($id);

        if ($user->deletado_em != null) {
            return redirect()->back()->with('info', "The user $user->name is already deleted!");
        }

        if ($user->is_admin) {
            return redirect()->back()->with('info', "Cannot delete an <b>Administrator</b> User.");
        }

        $data = [
            'title'     => "Deleting user $user->name",
            'user' => $user,
        ];

        return view('Admin/Users/delete', $data);
    }

    public function postDelete($id = null)
    {
        $user = $this->findUserOr404($id);

        if ($this->request->getMethod() === 'post') {
            $this->userModel->delete($id);
            return redirect()->to(site_url('admin/users'))
                            ->with('success', "User $user->name successfully deleted.");
        }
    }

    public function getUndelete($id = null)
    {
        $user = $this->findUserOr404($id);
        
        if ($user->deleted_at == null) {
            return redirect()->back()->with('info', "Only deleted users can be recovered.");
        }

        if ($this->userModel->undelete($id)) {
            return redirect()->back()->with('success', "Deletion successfully undone!");
        } else {
            return redirect()->back()->with('errors_model', $this->userModel->errors())
                                    ->with('attention', "Please check the errors below.")
                                    ->withInput();
        }
    }

    public function getImage(string $image = null)
    {
        if ($image) {
            $pathImage = WRITEPATH . 'uploads/users/' . $image;

            $infoImage = new \finfo(FILEINFO_MIME);

            $imageType = $infoImage->file($pathImage);
            
            header("Content-Type: $imageType");
            header("Content-Length: " . filesize($pathImage));
            
            readfile($pathImage);

            exit;
        }
    }

    /**
     * @param int $id
     * @return object User
     */
    private function findUserOr404($id = null)
    {
        if (!$id || !$user = $this->userModel->withDeleted(true)->where('id', $id)->first()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("We don't find the user $id");
        }
        
        return $user;
    }
}