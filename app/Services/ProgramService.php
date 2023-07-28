<?php

namespace App\Services;

// Use Repositories
use App\Repositories\ProgramRepository;
// Use others
use Illuminate\Http\Request;

class ProgramService
{
    protected $programRepository;

    public function __construct()
    {
        $this->programRepository = new ProgramRepository();
    }

    public function add($data)
    {
        $this->programRepository->create($data);
    }
}
