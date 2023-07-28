<?php

namespace App\Http\ApiExternal;

// Use others
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiCrm
{
    public function searchProfiles($search)
    {
        try {
            $data = ['ID_Number' => $search];
            $url = config('crm.base_url_function') . config('crm.url_search_profile') . config('crm.base_url_authentication');
            $response = Http::withOptions(['verify' => false])
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post($url, $data);
            return $response->json();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
