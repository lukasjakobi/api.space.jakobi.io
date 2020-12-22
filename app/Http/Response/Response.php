<?php

declare(strict_types=1);

namespace App\Http\Response;

use App\Models\Model;
use Illuminate\Http\JsonResponse;

class Response extends \Illuminate\Http\Response
{

    public function build(): JsonResponse
    {
        // models to array conversion
        if ($this->original instanceof Model) {
            $this->original = $this->original->export();
        } elseif (is_array($this->original)) {
            foreach ($this->original as $key=>$item) {
                if ($item instanceof Model) {
                    $this->original[$key] = $item->export();
                }
            }
        }

        $output = [
            "success" => $this->statusCode === 200,
            "statusCode" => $this->statusCode,
            "statusText" => $this->statusText
        ];

        if (is_array($this->original) || is_countable($this->original)) {
            $output["count"] = count($this->original);
        }

        $output['result'] = $this->original;

        return response()->json($output);
    }
}
