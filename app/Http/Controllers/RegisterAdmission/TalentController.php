<?php

namespace App\Http\Controllers\RegisterAdmission;

// Use Repositories
// Use Services
// Use others

class TalentController
{
    public function __construct()
    {
    }

    public function uploadImage()
    {
        try {
            return view('RegisterAdmissions.upload_image');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
