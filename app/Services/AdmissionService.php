<?php

namespace App\Services;

// Use Repositories
use App\Repositories\AdmissionRepository;
// Use others
use Illuminate\Http\Request;

class AdmissionService
{
    protected $admissionRepository;

    public function __construct()
    {
        $this->admissionRepository = new AdmissionRepository();
    }

    public function getAll()
    {
        return $this->admissionRepository->getAll();
    }

    public function find($id)
    {
        return $this->admissionRepository->find($id);
    }

    public function add($data)
    {
        return $this->admissionRepository->create($data);
    }
}
