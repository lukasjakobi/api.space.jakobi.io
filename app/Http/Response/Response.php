<?php

declare(strict_types=1);

namespace App\Http\Response;

use Illuminate\Http\JsonResponse;

class Response extends \Illuminate\Http\Response
{

    public function __construct($content = '', $status = 200, array $headers = [])
    {
        parent::__construct($content, $status, $headers);
    }

    public function build(): JsonResponse
    {
        $output = [
            "success" => $this->statusCode === 200,
            "statusCode" => $this->statusCode,
            "statusText" => $this->statusText,
            "result" => $this->content
        ];

        return response()->json($output);
    }

}
