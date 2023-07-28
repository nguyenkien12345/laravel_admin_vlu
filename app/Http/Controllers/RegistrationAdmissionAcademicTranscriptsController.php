<?php

namespace App\Http\Controllers;

// Use others
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegistrationAdmissionAcademicTranscriptsController
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('RegistrationAdmissionAcademicTranscripts.index');
    }

    public function previewInfoRegisterAcademicTranscripts()
    {
        return view('RegistrationAdmissionAcademicTranscripts.preview_info_register_academic_transcripts');
    }
}
