<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Account extends BaseController
{
    private $userModel;
    private $profileModel;
    private $sportModel;
    private $strategyModel;
    private $competitonsModel;
    private $bankrollModel;
    private $currencyModel;

    public function __construct()
    {
        $this->userModel = new \App\Models\UserModel();
        $this->profileModel = new \App\Models\ProfileModel();
        $this->sportModel = new \App\Models\SportModel;
        $this->strategyModel = new \App\Models\StrategyModel();
        $this->competitionModel = new \App\Models\CompetitionModel();
        $this->currencyModel = new \App\Models\CurrencyModel();
        $this->bankrollModel = new \App\Models\BankrollModel();

    }

    public function getIndex()
    {
        echo 'Not Found';
    }

    public function getProfile()
    {
        $user = userLoggedIn();
        $profile = $this->profileModel->findProfileByUserId($user->id);
        $user->profile = $profile;

        $data = [
            'title' => 'Profile',
            'user' => $user,
            'profile' => $profile,
        ];
        
        return view('Manager/Account/index', $data);
    }

    public function postUpdate($id = null)
    {
        if ($this->request->getMethod() === 'post') {
            $user = userLoggedIn();

            if ($user->deleted_at != null) {
                return redirect()->back()->with('info', "The user $user->nome is deleted. Therefore, it is not possible to edit it.");
            }

        } else {
            /* It's not POST */
            return redirect()->back();
        }

        $post = $this->request->getPost('user');
        
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
            return redirect()->to(site_url("manager/account/profile"))
                            ->with('success', "User $user->nome updated successfully!");
        } else {
            return redirect()->back()->with('errors_model', $this->userModel->errors())
                                    ->with('attention', "Please check the errors below.")
                                    ->withInput();
        }
    }

    public function postUploadImage($id = null) 
    {
        $user = userLoggedIn();
        $profile = $this->profileModel->findProfileByUserId($user->id);

        $image = $this->request->getFile('user_avatar');

        if (!$image->isValid()) {
            $errorCode = $image->getError();

            if ($errorCode == UPLOAD_ERR_NO_FILE) {
                return redirect()->back()->with('attention', 'No files were selected.');
            }
        }

        $imageSize = $image->getSizeByUnit('mb');

        if ($imageSize > 2) {
            return redirect()->back()->with('attention', 'The selected file is too large. Maximum allowed is: 2MB.');
        }

        $imageType = $image->getMimeType();
        $imageTypeClear = explode('/', $imageType);

        $allowedTypes = [
            'jpg', 'jpeg', 'png', 'webp',
        ];
        
        if (!in_array($imageTypeClear[1], $allowedTypes)) {
            return redirect()->back()->with('attention', 'The file does not have the permitted format. Just: ' . implode(', ', $allowedTypes));
        }

        list($widht, $height) = getimagesize($image->getPathName());

        if ($widht < "400" || $height < "400") {
            return redirect()->back()->with('attention', 'The image cannot be smaller than 400 x 400 pixels.');
        }

        // --------------- Store the image. ------------- //

        /* Storing the image and retrieving its path. */
        $imagePath = $image->store('users');

        $imagePath = WRITEPATH . 'uploads/' . $imagePath;

        /* Resizing the same image */
        service('image')
                ->withFile($imagePath)
                ->fit(400, 400, 'center')
                ->save($imagePath);

        /* Recovering the old image to delete it. */
        $oldImage = $profile->image;

        /* Assigning the new image. */
        $profile->avatar = $image->getName();
        
        /* Updating the product image. */
        $this->profileModel->save($profile);

        /* Setting the old image path. */
        $imagePath = WRITEPATH . 'uploads/users/' . $oldImage;
        
        if (is_file($imagePath)) {
            unlink($imagePath);
        }

        return redirect()->to(site_url("manager/account"))->with('success', 'image changed successfully!');
    }

    public function getStrategies()
    {
        $strategies = $this->strategyModel->findAll();
        
        $data = [
            'title' => 'Strategies',
            'strategies' => $strategies,
            'sports' => $this->sportModel->findAll(),
            'pager' => $this->strategyModel->pager,
        ];
        
        return view('Manager/Strategies/index', $data);
    }

    public function getCompetitions()
    {
        $competitions = $this->competitionModel->findAll();
        $data = [
            'title' => 'Competitions',
            'competitions' => $competitions,
            'sports' => $this->sportModel->findAll(),
            'pager' => $this->competitionModel->pager,
        ];
        
        return view('Manager/Competitions/index', $data);
    }

    public function getBankrolls()
    {
        $user = userLoggedIn();
        $bankrolls = $this->bankrollModel->getUserBankrolls($user);

        $data = [
            'title' => 'Bankrolls',
            'user' => $user,
            'bankrolls' => $bankrolls,
            'currencies' => $this->currencyModel->findAll(),
            'pager' => $this->bankrollModel->pager,
        ];
        
        return view('Manager/Bankrolls/index', $data);
    }

    public function getIntegrations()
    {
        $data = [
            'title' => 'Integrations',
        ];
        
        return view('Manager/Integrations/index', $data);
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