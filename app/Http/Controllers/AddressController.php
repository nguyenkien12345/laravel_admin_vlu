<?php

namespace App\Http\Controllers;

// Use Services
use App\Services\AddressService;
// Use others
use Illuminate\Http\Request;

class AddressController
{
    protected $addressService;

    public function __construct()
    {
        $this->addressService = new AddressService();
    }

    public function getAllProvince()
    {
        return $this->addressService->getAllProvince();
    }

    public function getDistrictByProvinceId($province_id)
    {
        return $this->addressService->getDistrictByProvinceId($province_id);
    }

    public function getWardByDistrictId($district_id)
    {
        return $this->addressService->getWardByDistrictId($district_id);
    }
}
