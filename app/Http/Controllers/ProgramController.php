<?php

namespace App\Http\Controllers;

// Use Request
use App\Http\Requests\ProgramRequest;
// Use Repositories
use App\Repositories\ProgramRepository;
// Use Services
use App\Services\ProgramService;
// Use others
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProgramController
{
    protected $programRepository;
    protected $programService;

    public function __construct()
    {
        $this->programRepository = new ProgramRepository();
        $this->programService = new ProgramService();
    }

    public function add(ProgramRequest $request)
    {
        $data = $request->only(['name']);

        ['name' => $name] = $data;
        $name = mb_strtolower($name);

        $isHaveStrProgram = false;

        Str::contains($name, 'chương trình') ? $isHaveStrProgram = true : $isHaveStrProgram = false;

        if ($isHaveStrProgram === false) $name = mb_strtolower('chương trình' . ' ' . $name);

        // Check Program is exists
        $isExists = $this->programRepository->checkExists($name);
        if ($isExists) {
            return response()->json(['status' => false, 'message' => 'program is exists']);
        }

        $data = ['name' => $name];

        $this->programService->add($data);
        return response()->json(['status' => true, 'message' => 'add program success']);
    }
}
