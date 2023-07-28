<?php

namespace App\Http\Controllers;

// Use Request
use App\Http\Requests\AdmissionRequest;
// Use Repositories
use App\Repositories\AdmissionRepository;
// Use Services
use App\Services\AdmissionService;
// Use others
use DB;
use Alert;

class AdmissionController
{
    protected $admissionRepository;
    protected $admissionService;

    public function __construct()
    {
        $this->admissionRepository = new AdmissionRepository();
        $this->admissionService = new AdmissionService();
    }

    public function add()
    {
        return view('Admission.add');
    }

    public function store(AdmissionRequest $request)
    {
        try {
            DB::beginTransaction();

            $name = $request->name;

            $name = mb_strtolower($name);
            $slug = $name;

            // Check Admission is exists
            $isExists = $this->admissionRepository->checkExists($name);
            if ($isExists) {
                $isExists = config('content.admissions.name') . ' ' . config('content.common.exists');
                return back()->with('exists', $isExists);
            }

            $data = ['name' => $name, 'slug' => $slug];
            $this->admissionService->add($data);

            DB::commit();
            $success = ucfirst(config('content.crud.add')) . ' ' . config('content.admissions.name') . ' ' . config('content.status.success');
            return redirect()->route('admission.add')->with('success', $success);
        } catch (\Exception $exception) {
            DB::rollBack();
            $error = ucfirst(config('content.crud.add')) . ' ' . config('content.admissions.name') . ' ' . config('content.status.fail');
            return redirect()->route('admission.add')->with('error', $error);
        }
    }

    public function all()
    {
        $title = ucwords(config('content.crud.list') . ' ' . config('content.admissions.name'));
        $columns = config('columns.admissions');
        $data = $this->admissionService->getAll();
        return view('Admission.index', compact('title', 'columns', 'data'));
    }

    public function detail($id)
    {
        $data = $this->admissionService->find($id);
        return response()->json($data);
    }
}
