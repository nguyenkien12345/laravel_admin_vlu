<?php

namespace App\Helpers;

class Address
{
    // Done test
    public static function getAllProvinceSchool()
    {
        $pathSchoolProvinces = SCHOOL_PROVINCE;
        $schoolProvinces = json_decode(file_get_contents($pathSchoolProvinces));
        return $schoolProvinces;
    }

    // Done test
    public static function getAllDistrictSchool()
    {
        $pathSchoolDistricts = SCHOOL_DISTRICT;
        $schoolDistricts = json_decode(file_get_contents($pathSchoolDistricts));
        return $schoolDistricts;
    }

    // Done test
    public static function getDetailDistrictSchool($school_province_code)
    {
        $pathSchoolDistricts = SCHOOL_DISTRICT;
        $schoolDistricts = json_decode(file_get_contents($pathSchoolDistricts));
        $schoolDistricts = collect($schoolDistricts);
        $filterSchoolDistricts = $schoolDistricts->filter(function ($item, $key) use ($school_province_code) {
            return (string)$item->school_province_code === (string)$school_province_code;
        });
        return $filterSchoolDistricts;
    }
}
