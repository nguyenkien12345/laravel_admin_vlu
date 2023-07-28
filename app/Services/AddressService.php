<?php

namespace App\Services;

// Use Repositories
use App\Repositories\AddressRepository;
// Use others
use Illuminate\Http\Request;

class AddressService
{
    protected $addressRepository;

    public function __construct()
    {
        $this->addressRepository = new AddressRepository();
    }

    public function getAllProvince()
    {
        return $this->addressRepository->getAllProvince();
    }

    public function getDistrictByProvinceId($province_id)
    {
        return $this->addressRepository->getDistrictByProvinceId($province_id);
    }

    public function getWardByDistrictId($district_id)
    {
        return $this->addressRepository->getWardByDistrictId($district_id);
    }
}
