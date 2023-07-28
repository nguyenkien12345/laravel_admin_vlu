<?php

namespace App\Services;

// Use Repositories
use App\Repositories\FacultyRepository;
// Use others
use Illuminate\Http\Request;

class FacultyService
{
    protected $facultyRepository;

    public function __construct()
    {
        $this->facultyRepository = new FacultyRepository();
    }

    public function add($data)
    {
        $this->facultyRepository->create($data);
    }
}
