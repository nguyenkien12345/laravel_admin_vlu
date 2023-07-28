<?php

namespace App\Helpers;

use Carbon\Carbon;

class FormatResponse
{
    // Done test
    public static function formatResponse($type, $data = null, $message = null)
    {
        $formattedDateTime = Carbon::now()->format('d/m/Y H:i:s');
        if ($type === 'success'){
            $message = $message ? $message : 'success';
            return ['message' => $message, 'status' => true, 'data' => $data, 'time' => $formattedDateTime];
        }
        else {
            $message = $message ? $message : 'fail';
            return ['message' => $message, 'status' => false, 'data' => $data, 'time' => $formattedDateTime];
        }
    }
}
