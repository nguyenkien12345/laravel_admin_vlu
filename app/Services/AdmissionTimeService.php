<?php

namespace App\Services;

// Use Repositories
use App\Repositories\AdmissionTimeRepository;
// Use others
use Illuminate\Http\Request;

class AdmissionTimeService
{
    protected $admissionTimeRepository;

    public function __construct()
    {
        $this->admissionTimeRepository = new AdmissionTimeRepository();
    }

    public function getAll()
    {
        return $this->admissionTimeRepository->getAll();
    }

    public function find($id)
    {
        return $this->admissionTimeRepository->find($id);
    }

    public function add($data)
    {
        return $this->admissionTimeRepository->create($data);
    }
}
