<?php

namespace App\Controllers\Manager\Account;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Profile extends BaseController
{
    private $userModel;
    private $profileModel;
    private $dateRangeModel;

    public function __construct()
    {
        $this->userModel = new \App\Models\usermodel();
        $this->profileModel = new \App\Models\ProfileModel();
        $this->sportModel = new \App\Models\SportModel();
        $this->dateRangeModel = new \App\Models\DateRangeModel();
    }

    public function getIndex()
    {
        $user = userLoggedIn();
        $profile = $this->profileModel->findProfileByUserId($user->id);

        $data = [
            'title' => 'Profile',
            'user' => $user,
            'profile' => $profile,
            'sports' => $this->sportModel->findAll(),
            'date_ranges' =>$this->dateRangeModel->findAll(),
        ];

        return view('Manager/Account/Profile/index', $data);
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

        $postUser = $this->request->getPost('user');
        $postProfile = $this->request->getPost('profile');
        
        if (empty($postUser['password'])) {
            $this->userModel->disablePasswordValidation();
            unset($postUser['password']);
            unset($postUser['password_confirmation']);
        }

        $user->fill($postUser);

        $profile = $this->profileModel->findProfileByUserId($user->id);
        $profile->fill($postProfile);
        
        if (!$user->hasChanged() && !$profile->hasChanged()) {
            return redirect()->back()->with('info', "There is no data to update.");
        }
        
        $update = false;

        if ($user->hasChanged()) {
            if ($this->userModel->save($user)) {
                $update = true;
            } else {
                return redirect()->back()->with('errors_model', $this->userModel->errors())
                                    ->with('attention', "Please check the errors below.")
                                    ->withInput();
            }
        }
        
        if ($profile->hasChanged()) {
            if ($this->profileModel->save($profile)) {
                $update = true;  
            } else {
                return redirect()->back()->with('errors_model', $this->profileModel->errors())
                                    ->with('attention', "Please check the errors below.")
                                    ->withInput();
            }
        }

        if ($update) {
            return redirect()->to(site_url("manager/account/profile"))
                            ->with('success', "User updated successfully!");
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

        return redirect()->to(site_url("manager/account/profile"))->with('success', 'Image changed successfully!');
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
}