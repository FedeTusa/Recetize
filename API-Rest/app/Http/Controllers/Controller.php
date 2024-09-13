<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use illuminate\http\response;

class Controller extends BaseController
{
  public function respondSuccess($data, string $message = 'Success Operation', int $code = 200)
  {
    return response()->json([
      'status' => 'success',
      'message' => $message,
      'data' => $data ?? [],
    ], $code);
  }

  public function respondError($errors, string $message = 'Error Operation', int $code = 400)
  {
    return response()->json([
      'status' => 'error',
      'message' => $message,
      'data' => $errors,
    ], $code);
  }
}
