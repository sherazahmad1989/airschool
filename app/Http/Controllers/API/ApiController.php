<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;


class ApiController extends Controller
{
    public $message;
    public $status;

    protected function success($data = [], $message = null, $status = null)
    {
        return response([
            'success' => true,
            'data' => $data,
            'message' => $message ?? $this->message,
        ], $status ?? $this->status);
    }

    protected function failure($message = null, $status = null,$data = [])
    {
        return response([
            'success' => false,
            'message' => $message ?? $this->message,
            'data' => $data
        ], $status ?? $this->status);
    }
}
