<?php

namespace App\Helpers;

use App\Constants\Common as ConstantsCommon;

class Common
{
    // Done test
    public static function getAllAcademicPerformance()
    {
        $academicPerformance = ConstantsCommon::Academic_Performance;

        $keys = array_keys($academicPerformance);
        $values = array_values($academicPerformance);

        $newKeys = Common::changeAcademicConductFromEnglishToVietNam($values, ConstantsCommon::Type_Academic_Conduct['ACADEMIC']);

        $data = [];

        for ($i = 0; $i < count($newKeys); $i++) {
            $data[] = [
                'code' => $values[$i],
                'name' => $newKeys[$i],
            ];
        }

        return $data;
    }

    // Done test
    public static function getAllConductPerformance()
    {
        $conductPerformance = ConstantsCommon::Conduct_Performance;

        $keys = array_keys($conductPerformance);
        $values = array_values($conductPerformance);

        $newKeys = Common::changeAcademicConductFromEnglishToVietNam($values, ConstantsCommon::Type_Academic_Conduct['CONDUCT']);

        $data = [];

        for ($i = 0; $i < count($newKeys); $i++) {
            $data[] = [
                'code' => $values[$i],
                'name' => $newKeys[$i],
            ];
        }

        return $data;
    }

    // Done test
    public static function changeAcademicConductFromEnglishToVietNam($keys, $type)
    {
        $newKeys = [];
        foreach ($keys as $key) {
            if ($key === ConstantsCommon::Academic_Performance['EXCELLENT'] && $type === ConstantsCommon::Type_Academic_Conduct['ACADEMIC']) {
                $newKeys[] = 'Giỏi';
            }
            if ($key === ConstantsCommon::Academic_Performance['EXCELLENT'] && $type === ConstantsCommon::Type_Academic_Conduct['CONDUCT']) {
                $newKeys[] = 'Tốt';
            }
            if ($key === ConstantsCommon::Academic_Performance['GOOD']) {
                $newKeys[] = 'Khá';
            }
            if ($key === ConstantsCommon::Academic_Performance['AVERAGE']) {
                $newKeys[] = 'Trung bình';
            }
            if ($key === ConstantsCommon::Academic_Performance['WEAK']) {
                $newKeys[] = 'Yếu';
            }
        }
        return $newKeys;
    }

    // Done test
    public static function getAllEthnicity()
    {
        $pathEthnicity = ETHNICITY;
        $ethnicities = json_decode(file_get_contents($pathEthnicity));
        return $ethnicities;
    }

    // Done test
    public static function getAllReligion()
    {
        $pathReligion = RELIGION;
        $religions = json_decode(file_get_contents($pathReligion));
        return $religions;
    }

    // Done test
    public static function getAllNationality()
    {
        $pathNationalities = NATIONALITY;
        $nationalities = json_decode(file_get_contents($pathNationalities));
        return $nationalities;
    }

    // Done test 
    public static function randomOTP(){
        $otp = mt_rand(100000, 999999);
        return $otp;
    }
}
