<?php

namespace App\Repositories;

use App\Http\Resources\DistrictResource;
use App\Http\Resources\ProvinceResource;
use App\Http\Resources\WardResource;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;

class AddressRepository
{
    protected $province;
    protected $district;
    protected $ward;

    /**
     * function construct
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * Set model
     */
    public function setModel()
    {
        $this->province = new Province();
        $this->district = new District();
        $this->ward = new Ward();
    }

    /**
     * Get all list province
     * @return collection of list province
     */
    public function getAllProvince()
    {
        $data = $this->province->all();
        return ProvinceResource::collection($data);
    }

    /**
     * Get list district with province_id
     * @param string $id
     * @return array of district
     */
    public function getDistrictByProvinceId($province_id)
    {
        $data = $this->district->where('province_id', $province_id)->get();
        return DistrictResource::collection($data);
    }

    /**
     * Get list ward with district_id
     * @param string $id
     * @return array of ward
     */
    public function getWardByDistrictId($district_id)
    {
        $data = $this->ward->where('district_id', $district_id)->get();
        return WardResource::collection($data);
    }
}
