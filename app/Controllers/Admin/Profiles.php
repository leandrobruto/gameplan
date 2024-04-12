<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Profiles extends BaseController
{
    private $profileModel;
    
    public function __construct()
    {
        $this->profileModel = new \App\Models\ProfileModel();
    }

    public function getIndex($id = null)
    {
        $data = [
            'title' => 'Profiles listing',
        ];

        return view('Admin/Users/index', $data);
    }

    public function getEditImage($id = null) 
    {
        $profile = $this->findProfileByUserIdOr404($id);

        if ($profile->deleted_at != null) {
            return redirect()->back()->with('info', "Cannot edit the image of a deleted user.");
        }

        $data = [
            'title'     => "Editing the user image $profile->name",
            'profile' => $profile,
        ];

        return view('Admin/Profiles/image_edit', $data);
    }

    public function postUploadImage($id = null) 
    {
        $profile = $this->findProfileByUserIdOr404($id);

        $image = $this->request->getFile('photo_user');

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

        return redirect()->to(site_url("admin/users/show/$profile->user_id"))->with('success', 'Image changed successfully!');
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
    private function findProfileByUserIdOr404($id = null)
    {
        if (!$id || !$profile = $this->profileModel->withDeleted(true)->where('user_id', $id)->first()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("We don't find the user $id");
        }
        
        return $profile;
    }
}
