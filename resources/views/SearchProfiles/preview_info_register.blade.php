<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('bootstrap-5.1.3-dist/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/SearchProfiles/preview_info_register.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"
        integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('bootstrap-5.0.2-dist/js/bootstrap.min.js')}}"></script>
    <title>ADMIN VAN LANG</title>
</head>

<body>
    {{-- HEADER --}}

    <div class="container container-preview-info mt-5">
        <div class="row">
            <div class="col-12">
                <p class="title-preview-info">{{$title}}</p>
                <p class="description-preview-info">({{$description}})</p>
            </div>
        </div>

        {{-- THÔNG TIN THÍ SINH --}}
        <x-title-preview icon='images/icon-information.png' content='1. Thông tin thí sinh'
            style="margin: 28px 0px 15px 0px" />
        <x-note-preview icon='images/ProfileCode.png' title='Mã hồ sơ:'
            content='Sẽ phát sinh sau khi hoàn tất việc nộp hồ sơ' style="margin-bottom: 15px" />

        <x-information-preview :value1='$value1=["Họ và tên", "$fullName"]' />
        <x-information-preview :value1='$value1=["Giới tính", "$gender"]' :value2='$value2=["Ngày sinh", "$dob"]' />
        <x-information-preview :value1='$value1=["Điện thoại di động", "$phone"]'
            :value2='$value2=["Email", "$email"]' />
        <x-information-preview :value1='$value1=["Điện thoại phụ huynh", "$phoneParent"]' />
        <x-information-preview :value1='$value1=["Số CMND/CCCD", "$nid"]'
            :value2='$value2=["Quốc tịch", "$nationality"]' />
        <x-information-preview :value1='$value1=["Dân tộc", "$ethinic"]' :value2='$value2=["Tôn giáo", "$religion"]' />
        <x-information-preview :value1='$value1=["Nơi sinh", "$pob"]' />
        <x-information-preview :value1='$value1=["Địa chỉ liên hệ", "$address"]' />

        @if ($description !== config('content.search_profile.description.dang_ky_thi_nang_khieu'))
        <x-information-preview :value1='$value1=["Trường THPT thuộc Tỉnh/TP", "$schoolProvince"]'
            :value2='$value2=["Tên trường", "$schoolName"]' />
        <x-information-preview :value1='$value1=["Năm tốt nghiệp THPT", "$graduationYear"]'
            :value2='$value2=["Loại hình tốt nghiệp", "$educationType"]' />
        <x-information-preview :value1='$value1=["Học lực lớp 12", "$typeOfAcademicPerformance12"]'
            :value2='$value2=["Hạnh kiểm lớp 12", "$typeOfConduct12"]' />
        <x-information-preview :value1='$value1=["Khu vực", "$admissionArea"]'
            :value2='$value2=["Đối tượng ưu tiên", "$priorityType"]' />
        @else
        <x-information-preview :value1='$value1=["Ngành đăng ký", ""]'
            :value2='$value2=["Mã DVL hoặc SBD THPT", "$sbd"]' />
        @endif

        {{-- THÔNG TIN XÉT TUYỂN --}}
        <x-title-preview icon='images/icon-information.png' content='2. Thông tin xét tuyển'
            style="margin: 28px 0px 15px 0px" />

        <x-note-preview icon='images/RecruitmentPlan.png' title='Phương án xét tuyển:' :content='$sectionPlan'
            style="margin-bottom: 15px" />

        @switch($description)

        @case(config('content.search_profile.description.dang_ky_thi_nang_khieu'))
        <div class="table-preview-info">
            <table id='tableTalentRegister'>
                <thead class="theadTalentRegister">
                    <tr>
                        @foreach (config('content.table.talent') as $item)
                        <th>{{$item}}</th>
                        @endforeach
                    </tr>
                </thead>

                <tbody class="tbodyTalentRegister">
                    <tr>
                        <td>{{$dataTalentAddmissions['profileCode']}}</td>
                        <td>{{$dataTalentAddmissions['examSubject']}}</td>
                        <td>{{$dataTalentAddmissions['examForms']}}</td>
                        <td>{{$dataTalentAddmissions['preliminaryScore']}}</td>
                        <td>{{$dataTalentAddmissions['interviewScore']}}</td>
                        <td>{{$dataTalentAddmissions['totalScore']}}</td>
                        <td>{{$dataTalentAddmissions['status']}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @break

        @case(config('content.search_profile.description.xet_tuyen_cu_nhan_qt'))
        <div class="wrapper-score">
            <div class="list-score">
                <div class="item-score-11">
                    <p class="titlte-average-score">Điểm trung bình năm học lớp 11:</p>
                    <p class="titlte-score-semester1">Học kỳ 1: <b
                            class="value-score">{{$dataInternationalProgram['grade11S1']}}</b></p>
                    <p class="titlte-score-semester2">Học kỳ 2: <b
                            class="value-score">{{$dataInternationalProgram['grade11S2']}}</b></p>
                </div>
                <div class="item-score-12">
                    <p class="titlte-average-score">Điểm trung bình năm học lớp 12:</p>
                    <p class="titlte-score-semester1">Học kỳ 1: <b
                            class="value-score">{{$dataInternationalProgram['grade12S1']}}</b></p>
                    <p class="titlte-score-semester2">Học kỳ 2: <b
                            class="value-score">{{$dataInternationalProgram['grade12S2']}}</b></p>
                </div>
                <div class="item-score-english-12">
                    <p class="titlte-average-score">Điểm trung bình tiếng Anh lớp 12:</p>
                    <p class="titlte-score-semester1">Học kỳ 1: <b
                            class="value-score">{{$dataInternationalProgram['gradeEnglish12S1']}}</b>
                    </p>
                    <p class="titlte-score-semester2">Học kỳ 2: <b
                            class="value-score">{{$dataInternationalProgram['gradeEnglish12S2']}}</b>
                    </p>
                </div>
            </div>
            <p class="certificate-english">{{$dataInternationalProgram['certificateName']}}</p>
        </div>
        <div class="table-preview-info">
            <table>
                <thead>
                    <tr>
                        @foreach (config('content.table.international_bachelor') as $item)
                        <th>{{$item}}</th>
                        @endforeach
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>{{$dataInternationalProgram['priority']}}</td>
                        <td>{{$dataInternationalProgram['universityName']}}</td>
                        <td>{{$dataInternationalProgram['registeredMajorName']}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @break

        @case(config('content.search_profile.description.xet_tuyen_ket_qua_dgnl'))
        <div class="wrapper-university-national">
            <p>Điểm thi: <b class="value-university-national">{{$dataAssessmentOfNationalAddmissions['score']}}</b></p>
            <p>Ngày thi: <b class="value-university-national">{{$dataAssessmentOfNationalAddmissions['date']}}</b></p>
            <p>SBD đánh giá năng lực của ĐHQG TP.HCM: <b
                    class="value-university-national">{{$dataAssessmentOfNationalAddmissions['sbd']}}</b></p>
        </div>
        <div class="table-preview-info">
            <table>
                <thead>
                    <tr>
                        @foreach (config('content.table.university_national') as $item)
                        <th>{{$item}}</th>
                        @endforeach
                    </tr>
                </thead>

                <tbody>
                    @if (count($dataAssessmentOfNationalAddmissions['listTableInfoMajor']) > 0)
                    @foreach ($dataAssessmentOfNationalAddmissions['listTableInfoMajor'] as $item)
                    <tr>
                        <td>{{$item['priorityOrder']}}</td>
                        <td>{{$item['majorName']}}</td>
                        <td>{{$item['majorCode']}}</td>
                        <td>{{$item['program']}}</td>
                        <td>{{$item['status']}}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        @break

        @case(config('content.search_profile.description.xet_tuyen_ket_qua_hoc_ba_thpt'))
        @if (trim(mb_strtolower($sectionPlan)) === 'phương án 1' || trim(mb_strtolower($sectionPlan)) === 'phương
        án 01')
        <div class="wrapper-score-straight">
            <div class="wrapper-score-straight-11">
                <p class="title-score-straight">Điểm trung bình lớp 11</p>
                <span class="label-subject" style="margin-right: 0px">Toán: <b
                        class="value-score">{{$dataAcademicResults['math11GPA']}}</b></span>
                <span class="label-subject">Lý: <b
                        class="value-score">{{$dataAcademicResults['physics11GPA']}}</b></span>
                <span class="label-subject">Sử: <b
                        class="value-score">{{$dataAcademicResults['history11GPA']}}</b></span>
                <span class="label-subject">Anh: <b
                        class="value-score">{{$dataAcademicResults['english11GPA']}}</b></span>
                <span class="label-subject">GDCD: <b
                        class="value-score">{{$dataAcademicResults['civic11GPA']}}</b></span>
                <span class="label-subject">Trung: <b
                        class="value-score">{{$dataAcademicResults['chinese11GPA']}}</b></span>
                <span class="label-subject" style="margin-right: 0px">Văn: <b
                        class="value-score">{{$dataAcademicResults['literature11GPA']}}</b></span>
                <span class="label-subject">Hóa: <b
                        class="value-score">{{$dataAcademicResults['chemistry11GPA']}}</b></span>
                <span class="label-subject">Địa: <b
                        class="value-score">{{$dataAcademicResults['geography11GPA']}}</b></span>
                <span class="label-subject">Sinh: <b
                        class="value-score">{{$dataAcademicResults['biology11GPA']}}</b></span>
                <span class="label-subject">Pháp: <b
                        class="value-score">{{$dataAcademicResults['french11GPA']}}</b></span>

            </div>
            <div class="wrapper-score-straight-12-semester1">
                <p class="title-score-straight">Điểm trung bình lớp 12 học kỳ 1</p>

                <span class="label-subject">Toán: <b
                        class="value-score">{{$dataAcademicResults['math12HK1']}}</b></span>
                <span class="label-subject">Lý: <b
                        class="value-score">{{$dataAcademicResults['physics12HK1']}}</b></span>
                <span class="label-subject">Sử: <b
                        class="value-score">{{$dataAcademicResults['history12HK1']}}</b></span>
                <span class="label-subject">Anh: <b
                        class="value-score">{{$dataAcademicResults['english12HK1']}}</b></span>
                <span class="label-subject">GDCD: <b
                        class="value-score">{{$dataAcademicResults['civic12HK1']}}</b></span>
                <span class="label-subject">Trung: <b
                        class="value-score">{{$dataAcademicResults['chinese12HK1']}}</b></span>
                <span class="label-subject">Văn: <b
                        class="value-score">{{$dataAcademicResults['literature12HK1']}}</b></span>
                <span class="label-subject">Hóa: <b
                        class="value-score">{{$dataAcademicResults['chemistry12HK1']}}</b></span>
                <span class="label-subject">Địa: <b
                        class="value-score">{{$dataAcademicResults['geography12HK1']}}</b></span>
                <span class="label-subject">Sinh: <b
                        class="value-score">{{$dataAcademicResults['biology12HK1']}}</b></span>
                <span class="label-subject">Pháp: <b
                        class="value-score">{{$dataAcademicResults['french12HK1']}}</b></span>
            </div>
        </div>
        @else
        <div class="wrapper-score-straight">
            <div class="wrapper-score-straight-12">
                <p class="title-score-straight">Điểm trung bình lớp 12</p>
                <span class="label-subject">Toán: <b
                        class="value-score">{{$dataAcademicResults['math12GPA']}}</b></span>
                <span class="label-subject">Lý: <b
                        class="value-score">{{$dataAcademicResults['physics12GPA']}}</b></span>
                <span class="label-subject">Sử: <b
                        class="value-score">{{$dataAcademicResults['history12GPA']}}</b></span>
                <span class="label-subject">Anh: <b
                        class="value-score">{{$dataAcademicResults['english12GPA']}}</b></span>
                <span class="label-subject">GDCD: <b
                        class="value-score">{{$dataAcademicResults['civic12GPA']}}</b></span>
                <span class="label-subject">Trung: <b
                        class="value-score">{{$dataAcademicResults['chinese12GPA']}}</b></span>
                <span class="label-subject">Văn: <b
                        class="value-score">{{$dataAcademicResults['literature12GPA']}}</b></span>
                <span class="label-subject">Hóa: <b
                        class="value-score">{{$dataAcademicResults['chemistry12GPA']}}</b></span>
                <span class="label-subject">Địa: <b
                        class="value-score">{{$dataAcademicResults['geography12GPA']}}</b></span>
                <span class="label-subject">Sinh: <b
                        class="value-score">{{$dataAcademicResults['biology12GPA']}}</b></span>
                <span class="label-subject">Pháp: <b
                        class="value-score">{{$dataAcademicResults['french12GPA']}}</b></span>
            </div>
        </div>
        @endif
        <p class="certificate-english-straight">{{$dataAcademicResults['certificateName']}}</p>
        <div class="table-preview-info">
            <table>
                <thead>
                    <tr>
                        @foreach (config('content.table.common') as $item)
                        <th>{{$item}}</th>
                        @endforeach
                    </tr>
                </thead>

                <tbody>
                    @if (count($dataAcademicResults['listTableInfoMajor']) > 0)
                    @foreach ($dataAcademicResults['listTableInfoMajor'] as $item)
                    <tr>
                        <td>{{$item['priorityOrder']}}</td>
                        <td>{{$item['majorName']}}</td>
                        <td>{{$item['majorCode']}}</td>
                        <td>{{$item['combinationMajorCode']}}</td>
                        <td>{{$item['program']}}</td>
                        <td>{{$item['status']}}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        @break

        @case(config('content.search_profile.description.xet_tuyen_thang'))
        @if (trim(mb_strtolower($sectionPlan)) === 'phương án 1' || trim(mb_strtolower($sectionPlan)) === 'phương
        án 01')
        <div class="wrapper-score-straight">
            <div class="wrapper-score-straight-11">
                <p class="title-score-straight">Điểm trung bình lớp 11</p>
                <span class="label-subject" style="margin-right: 0px">Toán: <b
                        class="value-score">{{$dataStraightAddmissions['math11GPA']}}</b></span>
                <span class="label-subject">Lý: <b
                        class="value-score">{{$dataStraightAddmissions['physics11GPA']}}</b></span>
                <span class="label-subject">Sử: <b
                        class="value-score">{{$dataStraightAddmissions['history11GPA']}}</b></span>
                <span class="label-subject">Anh: <b
                        class="value-score">{{$dataStraightAddmissions['english11GPA']}}</b></span>
                <span class="label-subject">GDCD: <b
                        class="value-score">{{$dataStraightAddmissions['civic11GPA']}}</b></span>
                <span class="label-subject">Trung: <b
                        class="value-score">{{$dataStraightAddmissions['chinese11GPA']}}</b></span>
                <span class="label-subject" style="margin-right: 0px">Văn: <b
                        class="value-score">{{$dataStraightAddmissions['literature11GPA']}}</b></span>
                <span class="label-subject">Hóa: <b
                        class="value-score">{{$dataStraightAddmissions['chemistry11GPA']}}</b></span>
                <span class="label-subject">Địa: <b
                        class="value-score">{{$dataStraightAddmissions['geography11GPA']}}</b></span>
                <span class="label-subject">Sinh: <b
                        class="value-score">{{$dataStraightAddmissions['biology11GPA']}}</b></span>
                <span class="label-subject">Pháp: <b
                        class="value-score">{{$dataStraightAddmissions['french11GPA']}}</b></span>

            </div>
            <div class="wrapper-score-straight-12-semester1">
                <p class="title-score-straight">Điểm trung bình lớp 12 học kỳ 1</p>

                <span class="label-subject">Toán: <b
                        class="value-score">{{$dataStraightAddmissions['math12HK1']}}</b></span>
                <span class="label-subject">Lý: <b
                        class="value-score">{{$dataStraightAddmissions['physics12HK1']}}</b></span>
                <span class="label-subject">Sử: <b
                        class="value-score">{{$dataStraightAddmissions['history12HK1']}}</b></span>
                <span class="label-subject">Anh: <b
                        class="value-score">{{$dataStraightAddmissions['english12HK1']}}</b></span>
                <span class="label-subject">GDCD: <b
                        class="value-score">{{$dataStraightAddmissions['civic12HK1']}}</b></span>
                <span class="label-subject">Trung: <b
                        class="value-score">{{$dataStraightAddmissions['chinese12HK1']}}</b></span>
                <span class="label-subject">Văn: <b
                        class="value-score">{{$dataStraightAddmissions['literature12HK1']}}</b></span>
                <span class="label-subject">Hóa: <b
                        class="value-score">{{$dataStraightAddmissions['chemistry12HK1']}}</b></span>
                <span class="label-subject">Địa: <b
                        class="value-score">{{$dataStraightAddmissions['geography12HK1']}}</b></span>
                <span class="label-subject">Sinh: <b
                        class="value-score">{{$dataStraightAddmissions['biology12HK1']}}</b></span>
                <span class="label-subject">Pháp: <b
                        class="value-score">{{$dataStraightAddmissions['french12HK1']}}</b></span>
            </div>
        </div>
        @else
        <div class="wrapper-score-straight">
            <div class="wrapper-score-straight-12">
                <p class="title-score-straight">Điểm trung bình lớp 12</p>
                <span class="label-subject">Toán: <b
                        class="value-score">{{$dataStraightAddmissions['math12GPA']}}</b></span>
                <span class="label-subject">Lý: <b
                        class="value-score">{{$dataStraightAddmissions['physics12GPA']}}</b></span>
                <span class="label-subject">Sử: <b
                        class="value-score">{{$dataStraightAddmissions['history12GPA']}}</b></span>
                <span class="label-subject">Anh: <b
                        class="value-score">{{$dataStraightAddmissions['english12GPA']}}</b></span>
                <span class="label-subject">GDCD: <b
                        class="value-score">{{$dataStraightAddmissions['civic12GPA']}}</b></span>
                <span class="label-subject">Trung: <b
                        class="value-score">{{$dataStraightAddmissions['chinese12GPA']}}</b></span>
                <span class="label-subject">Văn: <b
                        class="value-score">{{$dataStraightAddmissions['literature12GPA']}}</b></span>
                <span class="label-subject">Hóa: <b
                        class="value-score">{{$dataStraightAddmissions['chemistry12GPA']}}</b></span>
                <span class="label-subject">Địa: <b
                        class="value-score">{{$dataStraightAddmissions['geography12GPA']}}</b></span>
                <span class="label-subject">Sinh: <b
                        class="value-score">{{$dataStraightAddmissions['biology12GPA']}}</b></span>
                <span class="label-subject">Pháp: <b
                        class="value-score">{{$dataStraightAddmissions['french12GPA']}}</b></span>
            </div>
        </div>
        @endif
        <x-title-preview icon='images/icon-information.png' content='3. Thành tích' style="margin: 28px 0px 15px 0px" />
        <div class="wrapper-achievements">
            <p>Thành tích đạt được: <b class="value-achievement">{{$dataStraightAddmissions['achievements']}}</b></p>
            <p>Năm đạt thành tích: <b class="value-achievement">{{$dataStraightAddmissions['yearOfAchievement']}}</b>
            </p>
            <p>Kết quả thi tốt nghiệp THPT: <b
                    class="value-achievement">{{$dataStraightAddmissions['highSchoolGraduationExamResult']}}</b></p>
            <p>Kết quả thi Đánh giá năng lực ĐHQG TP.HCM: <b
                    class="value-achievement">{{$dataStraightAddmissions['resultOfHCMCNationalUniversity']}}</b>
            </p>
            <p>Điểm trung bình cộng học bạ: <b
                    class="value-achievement">{{$dataStraightAddmissions['gradePointAverageOfAcademic']}}</b></p>
        </div>
        <div class="table-preview-info">
            <table>
                <thead>
                    <tr>
                        @foreach (config('content.table.common') as $item)
                        <th>{{$item}}</th>
                        @endforeach
                    </tr>
                </thead>

                <tbody>
                    @if (count($dataStraightAddmissions['listTableInfoMajor']) > 0)
                    @foreach ($dataStraightAddmissions['listTableInfoMajor'] as $item)
                    <tr>
                        <td>{{$item['priorityOrder']}}</td>
                        <td>{{$item['majorName']}}</td>
                        <td>{{$item['majorCode']}}</td>
                        <td>{{$item['combinationMajorCode']}}</td>
                        <td>{{$item['program']}}</td>
                        <td>{{$item['status']}}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        @break

        @default

        @endswitch

        <div class="row">
            <div class="col-12 wrapper-btns">
                <button class='btn-priview-info-register' id="btnBackToSeach">Quay Lại</button>
                <button class='btn-priview-info-register' id="btnPrintFormRegister">In Phiếu</button>
            </div>
        </div>
    </div>

    {{-- FOOTER --}}
</body>

<script>
    $('#btnBackToSeach').click((e) => {
        e.preventDefault();
        location.href = "{{route('search-profiles.index')}}";
    });

    $('#btnPrintFormRegister').click((e) => {
        e.preventDefault();
        const nid = {{ $nid }};
        const url = "{{route('search-profiles.download-pdf', ['nid' => $nid])}}";
        location.href = url;
    });
</script>

</html>
