<?php

namespace App\Http\Controllers;

// Use Request
use App\Http\Requests\SearchProfileRequest;
// Use Services
use App\Services\AdmissionService;
use App\Services\AdmissionTimeService;
// Use API External
use App\Http\ApiExternal\ApiCrm;
use Carbon\Carbon;
// Use others
use Illuminate\Http\Request;
use PDF;

class SearchProfilesController
{

    public $admissionService;
    public $admissionTimeService;

    public $apiCrm;

    public function __construct()
    {
        $this->admissionService = new AdmissionService();
        $this->admissionTimeService = new AdmissionTimeService();
        $this->apiCrm = new ApiCrm();
    }

    public function searchProfiles()
    {
        try {
            $admissionsType = $this->admissionService->getAll();
            $admissionsTime = $this->admissionTimeService->getAll();
            $data = [
                'admissionsType' => $admissionsType,
                'admissionsTime' => $admissionsTime
            ];
            return view('SearchProfiles.search_profiles', $data);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function submitSearch(SearchProfileRequest $request)
    {
        $data = $request->only(['admission_time', 'admission_type', 'phone_nid']);
        try {
            $result = $this->apiCrm->searchProfiles($data['phone_nid']);
            if ($result['code'] === 'success') {
                session([
                    'searchProfileInfo' => $result['details'],
                    'admissionType' => $data['admission_type'],
                    'admissionTime' => $data['admission_time'],
                ]);
                // Khi kiểm tra admission_type (Phương thức xét tuyển) và admission_time (thời gian xét tuyển) từ người dùng truyền lên
                // thì chỉ áp dụng cho Xét tuyển thẳng, Xét tuyển kết quả đánh giá năng lực, Xét tuyển kết quả học bạ THPT.
                // Còn đối với Xét tuyển cử nhân QT và đăng ký thi năng khiếu thì chỉ cần kiểm tra cmnd hoặc số điện thoại tồn tại là được
                $detailResult = $result['details']['userMessage'];
                $jsonDetailResult = json_decode($detailResult[0], true);
                $arrayResultAdmissionsMethodName = collect($jsonDetailResult['registration_method'])->map(function ($item, $key) {
                    return [
                        'admission_type' => trim(mb_strtolower($item['Admission_Method']['name'], 'UTF-8')),
                        'admission_time' => trim(mb_strtolower($item['Round']['name'], 'UTF-8')),
                    ];
                });
                $checkAdmissionMethodNameAndAdmissionRound = $arrayResultAdmissionsMethodName->filter(function ($item, $key) use ($data) {
                    return $item['admission_type'] === trim(mb_strtolower($data['admission_type'], 'UTF-8')) && $item['admission_time'] === trim(mb_strtolower($data['admission_time']));
                });
                $filterAdmissionTypeAndAdmissionTimeExcept = ['xét tuyển kết hợp thi tuyển các môn năng khiếu', 'chương trình quốc tế'];
                if (
                    ($checkAdmissionMethodNameAndAdmissionRound && $checkAdmissionMethodNameAndAdmissionRound->count() > 0)
                    || collect($filterAdmissionTypeAndAdmissionTimeExcept)->contains((trim(mb_strtolower($data['admission_type'], 'UTF-8'))))
                ) {
                    $result['status'] = true;
                } else {
                    $result['status'] = false;
                }
            } else {
                $result['status'] = false;
            }
            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function previewInfoRegister(Request $request)
    {
        try {
            $searchProfileInfo = session('searchProfileInfo');
            $admissionType = session('admissionType');
            $admissionTime = session('admissionTime');

            $title = config('content.search_profile.title');

            $description = null;
            switch ($admissionType) {
                case 'Xét tuyển kết quả thi Đánh giá năng lực của ĐH Quốc gia':
                    $description = config('content.search_profile.description.xet_tuyen_ket_qua_dgnl');
                    break;
                case 'Xét tuyển thẳng':
                    $description = config('content.search_profile.description.xet_tuyen_thang');
                    break;
                case 'Xét tuyển kết quả Học bạ THPT':
                    $description = config('content.search_profile.description.xet_tuyen_ket_qua_hoc_ba_thpt');
                    break;
                case 'Xét tuyển kết hợp thi tuyển các môn năng khiếu':
                    $description = config('content.search_profile.description.dang_ky_thi_nang_khieu');
                    break;
                case 'Chương trình Quốc tế':
                    $description = config('content.search_profile.description.xet_tuyen_cu_nhan_qt');
                    break;
            }

            $searchProfileInfo = json_decode($searchProfileInfo['userMessage'][0], true);

            $infoStudent = $searchProfileInfo['leads'][0];
            $infoMajor = $searchProfileInfo['registration_major'];
            $infoTalentAssessments = $searchProfileInfo['Talent_Assessments'][0];
            $infoRegistrationMethod = $searchProfileInfo['registration_method'];

            $fullName = $infoStudent['Last_Name'] . ' ' . $infoStudent['First_Name'];
            $gender = $infoStudent['Gender'];
            $nationality = $infoStudent['Nationality']; // Quốc tịch
            $religion = $infoStudent['Religion'];       // Tôn giáo
            $ethinic = $infoStudent['Ethinic_Group'];   // Dân tộc
            $pob = $infoStudent['Place_of_Birth'];      // Nơi sinh
            $dob = Carbon::createFromFormat('Y-m-d', $infoStudent['Date_of_Birth'])->format('d/m/Y');
            $nid = $infoStudent['ID_Number'];
            $registrationMajorName = $infoMajor[0]['Major_Name'];
            $identificationNumber =  $infoMajor[0]['id'];
            $email = $infoStudent['Email'];
            $phone = $infoStudent['Mobile'];
            $phoneParent = $infoStudent['Parent_s_Mobile'];
            $address = $infoStudent['Address_Name'];
            $schoolProvince = $searchProfileInfo['province_school'][0]['City_Province_Name']['name'];
            $schoolName = $infoStudent['School_Name']['name'];
            $graduationYear = $infoStudent['Graduation_Year'];
            $educationType = $infoStudent['Education_Type'];
            $typeOfAcademicPerformance12 = $infoStudent['th_Grade_Academic_Performance'];
            $typeOfConduct12 = $infoStudent['th_Grade_Conduct'];
            $admissionArea = $infoStudent['Admission_Area'];
            $priorityType = $infoStudent['Priority_Type'];
            $sbd = $infoTalentAssessments['SBD'];

            $data = [
                'title' => $title,
                'description' => $description,
                'fullName' => $fullName,
                'gender' => $gender,
                'nationality' => $nationality,
                'religion' => $religion,
                'ethinic' => $ethinic,
                'pob' => $pob,
                'dob' => $dob,
                'nid' => $nid,
                'registrationMajorName' => $registrationMajorName,
                'identificationNumber' => $identificationNumber,
                'email' => $email,
                'phone' => $phone,
                'phoneParent' => $phoneParent,
                'address' => $address,
                'schoolProvince' => $schoolProvince,
                'schoolName' => $schoolName,
                'graduationYear' => $graduationYear,
                'educationType' => $educationType,
                'typeOfAcademicPerformance12' => $typeOfAcademicPerformance12,
                'typeOfConduct12' => $typeOfConduct12,
                'admissionArea' => $admissionArea,
                'priorityType' => $priorityType,
                'sbd' => $sbd,
                'sectionPlan' => $admissionType
            ];

            $arrayUseTableMajor = ['xét tuyển kết quả thi đánh giá năng lực của đh quốc gia', 'xét tuyển thẳng', 'xét tuyển kết quả học bạ thpt'];

            $dataAcademicResults = null;
            $listTableInfoMajor = null;

            if (in_array(trim(mb_strtolower($admissionType)), $arrayUseTableMajor)) {
                $dataAcademicResults = collect($infoRegistrationMethod)->filter(function ($item, $key) use ($admissionType) {
                    return trim(mb_strtolower($item['Admission_Method']['name'])) === trim(mb_strtolower($admissionType));
                });
                $dataAcademicResults = $dataAcademicResults->first();

                $listTableInfoMajor = collect($infoMajor)->sortBy('Priority_Order')->map(function ($item, $key) use ($admissionType) {
                    if (trim(mb_strtolower($item['Method_Name'])) ===  (trim(mb_strtolower($admissionType)))) {
                        return [
                            'priorityOrder' => $item['Priority_Order'],
                            'majorName' => $item['Major']['name'],
                            'majorCode' => $item['Major_Code'],
                            'combinationMajorCode' => $item['Combination_Major_Code'],
                            'program' => $item['Program']['name'],
                            'status' => $item['Registration_Result'],
                        ];
                    }
                });
                $listTableInfoMajor = $listTableInfoMajor->filter(function ($item, $key) {
                    return $item !== null;
                });
            }

            switch (trim(mb_strtolower($admissionType))) {
                case trim(mb_strtolower('Xét tuyển kết quả thi Đánh giá năng lực của ĐH Quốc gia')):
                    $listTableInfoMajor = $listTableInfoMajor->map(function ($item, $index) {
                        return collect($item)->except(['combinationMajorCode'])->toArray(); // Loại bỏ thuộc tính 'combinationMajorCode'
                    });
                    $dataAssessmentOfNationalAddmissions = [
                        'score' =>   $dataAcademicResults['Test_Score'],
                        'date' =>   Carbon::createFromFormat('Y-m-d', $dataAcademicResults['Test_Date'])->format('d/m/Y'),
                        'sbd' =>   $dataAcademicResults['Test_Registered_Code'],
                        'listTableInfoMajor' => $listTableInfoMajor
                    ];

                    $data['dataAssessmentOfNationalAddmissions'] = $dataAssessmentOfNationalAddmissions;
                    break;
                case trim(mb_strtolower('Xét tuyển thẳng')):
                    $dataStraightAddmissions = [
                        // Điểm trung bình năm học lớp 12
                        'literature12GPA' => $dataAcademicResults['Literature_12_GPA'],                                  // Văn
                        'math12GPA' => $dataAcademicResults['Math_12_GPA'],                                              // Toán
                        'physics12GPA' => $dataAcademicResults['Physics_12_GPA'],                                        // Lý
                        'chemistry12GPA' => $dataAcademicResults['Chemistry_12_GPA'],                                    // Hóa
                        'history12GPA' => $dataAcademicResults['History_12_GPA'],                                        // Sử
                        'geography12GPA' => $dataAcademicResults['Geography_12_GPA'],                                    // Địa
                        'biology12GPA' => $dataAcademicResults['Biology_12_GPA'],                                        // Sinh
                        'english12GPA' => $dataAcademicResults['English_12_GPA'],                                        // Anh
                        'civic12GPA' => $dataAcademicResults['Civic_12_GPA'],                                            // GDCCD
                        'chinese12GPA' => $dataAcademicResults['Chinese_12_GPA'],                                        // Tiếng Trung
                        'french12GPA' => $dataAcademicResults['French_12_GPA'],                                          // Tiếng Pháp
                        'achievements' => $dataAcademicResults['Grade_Academic_Achievement_10'],                         // Thành tích đạt được
                        'yearOfAchievement' => $dataAcademicResults['Academic_Achievement_Year'],                        // Năm đạt thành tích
                        'highSchoolGraduationExamResult' => $dataAcademicResults['High_School_Test_Result_Subject_2'],   // Kết quả thi tốt nghiệp THPT
                        'resultOfHCMCNationalUniversity' => $dataAcademicResults['Competence_Assessment_Test_Result'],   // Kết quả thi Đánh giá năng lực ĐHQG TP. HCM
                        'gradePointAverageOfAcademic' => $dataAcademicResults['High_School_Test_Result_Subject_1'],      // Điểm TBC học bạ
                        'listTableInfoMajor' => $listTableInfoMajor,
                    ];

                    $data['dataStraightAddmissions'] = $dataStraightAddmissions;
                    $data['sectionPlan'] = $dataAcademicResults['Admission_Plan'];
                    break;
                case trim(mb_strtolower('Xét tuyển kết quả Học bạ THPT')):
                    $dataAcademicResults = [
                        'admissionPlan' => $dataAcademicResults['Admission_Plan'],
                        // Điểm trung bình năm học lớp 11
                        'literature11GPA' => $dataAcademicResults['Literature_11_GPA'],         // Văn
                        'math11GPA' => $dataAcademicResults['Math_11_GPA'],                     // Toán
                        'physics11GPA' => $dataAcademicResults['Physics_11_GPA'],               // Lý
                        'chemistry11GPA' => $dataAcademicResults['Chemistry_11_GPA'],           // Hóa
                        'history11GPA' => $dataAcademicResults['History_11_GPA'],               // Sử
                        'geography11GPA' => $dataAcademicResults['Geography_11_GPA'],           // Địa
                        'biology11GPA' => $dataAcademicResults['Biology_11_GPA'],               // Sinh
                        'english11GPA' => $dataAcademicResults['English_11_GPA'],               // Anh
                        'civic11GPA' => $dataAcademicResults['Civic_11_GPA'],                   // GDCCD
                        'chinese11GPA' => $dataAcademicResults['Chinese_11_GPA'],               // Tiếng Trung
                        'french11GPA' => $dataAcademicResults['French_11_GPA'],                 // Tiếng Pháp
                        // Điểm trung bình năm học lớp 12
                        'literature12GPA' => $dataAcademicResults['Literature_12_GPA'],         // Văn
                        'math12GPA' => $dataAcademicResults['Math_12_GPA'],                     // Toán
                        'physics12GPA' => $dataAcademicResults['Physics_12_GPA'],               // Lý
                        'chemistry12GPA' => $dataAcademicResults['Chemistry_12_GPA'],           // Hóa
                        'history12GPA' => $dataAcademicResults['History_12_GPA'],               // Sử
                        'geography12GPA' => $dataAcademicResults['Geography_12_GPA'],           // Địa
                        'biology12GPA' => $dataAcademicResults['Biology_12_GPA'],               // Sinh
                        'english12GPA' => $dataAcademicResults['English_12_GPA'],               // Anh
                        'civic12GPA' => $dataAcademicResults['Civic_12_GPA'],                   // GDCCD
                        'chinese12GPA' => $dataAcademicResults['Chinese_12_GPA'],               // Tiếng Trung
                        'french12GPA' => $dataAcademicResults['French_12_GPA'],                 // Tiếng Pháp
                        // Điểm học kỳ 1 lớp 12
                        // Điểm trung bình năm học lớp 12
                        'literature12HK1' => $dataAcademicResults['Literature_12'],         // Văn
                        'math12HK1' => $dataAcademicResults['Math_12'],                     // Toán
                        'physics12HK1' => $dataAcademicResults['Physics_12'],               // Lý
                        'chemistry12HK1' => $dataAcademicResults['Chemistry_12'],           // Hóa
                        'history12HK1' => $dataAcademicResults['History_12'],               // Sử
                        'geography12HK1' => $dataAcademicResults['Geography_12'],           // Địa
                        'biology12HK1' => $dataAcademicResults['Biology_12'],               // Sinh
                        'english12HK1' => $dataAcademicResults['English_12'],               // Anh
                        'civic12HK1' => $dataAcademicResults['Civic_12'],                   // GDCCD
                        'chinese12HK1' => $dataAcademicResults['Chinese_12'],               // Tiếng Trung
                        'french12HK1' => $dataAcademicResults['French_12'],                 // Tiếng Pháp
                        'certificateName' => $dataAcademicResults['Certificate_Name'],      // Chứng chỉ tiếng anh
                        'listTableInfoMajor' => $listTableInfoMajor,
                    ];

                    $data['dataAcademicResults'] = $dataAcademicResults;
                    $data['sectionPlan'] = $dataAcademicResults['admissionPlan'];
                    break;
                case trim(mb_strtolower('Xét tuyển kết hợp thi tuyển các môn năng khiếu')):
                    $dataTalentAddmissions = [
                        'profileCode' => 123456789,                                             // Mã hồ sơ
                        'examSubject' => $infoTalentAssessments['Talent_Assessment_Type'],      // Môn thi
                        'examForms' => $infoTalentAssessments['Test_Plan'],                     // Hình thức thi
                        'preliminaryScore' => $infoTalentAssessments['Initial_Score_30'],       // Điểm sơ khảo
                        'interviewScore' => $infoTalentAssessments['Interview_Score_70'],       // Điểm phỏng vấn
                        'totalScore' => $infoTalentAssessments['Initial_Score_30'] + $infoTalentAssessments['Interview_Score_70'],         // Điểm tổng
                        'status' => $infoTalentAssessments['Equivalent_Status']                 // Trạng thái
                    ];

                    $data['dataTalentAddmissions'] = $dataTalentAddmissions;
                    break;
                case trim(mb_strtolower('Chương trình Quốc tế')):
                    $dataInternationalProgram = [
                        'grade11S1' => $infoStudent['Grade_11_GPA_Semester_1'],                   // Điểm học kỳ 1 năm lớp 11
                        'grade11S2' => $infoStudent['Grade_11_GPA_S2'],                           // Điểm học kỳ 2 năm lớp 11
                        'grade12S1' => $infoStudent['Grade_12_GPA_S1'],                           // Điểm học kỳ 1 năm lớp 12
                        'grade12S2' => $infoStudent['Grade_12_GPA_S2'],                           // Điểm học kỳ 2 năm lớp 12
                        'gradeEnglish12S1' => $infoStudent['Grade_12_GPA_Eng_S1'],                // Điểm trung bình Tiếng Anh lớp 12 Học kỳ 1
                        'gradeEnglish12S2' => $infoStudent['Grade_12_GPA_English_Semester_2'],    // Điểm trung bình Tiếng Anh lớp 12 Học kỳ 2
                        'certificateName' => $infoStudent['Certificate_Name'],                    // Chứng chỉ tiếng anh
                        'priority' => 1,
                        'universityName' => $infoStudent['University_Name'],                      // Trường
                        'registeredMajorName' => $infoStudent['Registered_Major']['name'],       // Ngành
                    ];

                    $data['dataInternationalProgram'] = $dataInternationalProgram;
                    break;
            }
            session(['data' => $data]);
            return view('SearchProfiles.preview_info_register', $data);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function downloadPDF(Request $request)
    {
        try {
            $data = session('data');
            $pdf = PDF::loadView('SearchProfiles.preview_info_register', $data);
            return $pdf->stream('demo.pdf');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
