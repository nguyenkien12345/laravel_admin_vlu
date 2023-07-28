<?php

namespace App\Http\Controllers;

// Use Request
use App\Http\Requests\FacultyRequest;
// Use Repositories
use App\Repositories\FacultyRepository;
// Use Services
use App\Services\FacultyService;
// Use others
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FacultyController
{
    protected $facultyRepository;
    protected $facultyService;

    public function __construct()
    {
        $this->facultyRepository = new FacultyRepository();
        $this->facultyService = new FacultyService();
    }

    public function add(FacultyRequest $request)
    {
        $data = $request->only(['name']);

        ['name' => $name] = $data;
        $name = mb_strtolower($name);

        $isHaveStrFaculty = false;

        Str::contains($name, 'khối ngành') ? $isHaveStrFaculty = true : $isHaveStrFaculty = false;

        if ($isHaveStrFaculty === false) $name = mb_strtolower('khối ngành' . ' ' . $name);

        // Check Faculty is exists
        $isExists = $this->facultyRepository->checkExists($name);
        if ($isExists) {
            return response()->json(['status' => false, 'message' => 'faculty is exists']);
        }

        $data = ['name' => $name];

        $this->facultyService->add($data);
        return response()->json(['status' => true, 'message' => 'add faculty success']);
    }
}
