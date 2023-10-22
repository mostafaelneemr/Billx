<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function response($status, $code = '200', $message = 'Done', $data = []): array
    {
        return [
            'status' => $status,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];
    }
}
