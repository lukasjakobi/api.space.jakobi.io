<?php

declare(strict_types=1);

namespace App\Http\Response;

use App\Models\Model;
use Illuminate\Http\JsonResponse;

class Response extends \Illuminate\Http\Response
{

    /**
     * @var mixed
     */
    private $result;

    /**
     * @var int
     */
    private int $total = 0;

    /**
     * @var string|null
     */
    private ?string $errorMessage = null;

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @return string|null
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    /**
     * @param mixed $result
     * @return Response
     */
    public function setResult($result): Response
    {
        $this->result = $result;

        return $this;
    }

    /**
     * @param int $total
     * @return Response
     */
    public function setTotal(int $total): Response
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @param string|null $errorMessage
     * @return Response
     */
    public function setErrorMessage(?string $errorMessage): Response
    {
        $this->errorMessage = $errorMessage;

        return $this;
    }

    public function build(): JsonResponse
    {
        // models to array conversion
        if ($this->result instanceof Model) {
            $this->result = $this->result->export();
        } elseif (is_array($this->result)) {
            foreach ($this->result as $key=>$item) {
                if ($item instanceof Model) {
                    $this->result[$key] = $item->export();
                }
            }
        }

        $output = [
            "success" => $this->statusCode === 200,
            "method" => \request()->route()[1]['as'],
            "statusCode" => $this->statusCode,
            "statusText" => $this->statusText
        ];

        if ($this->errorMessage !== null) {
            $output["errorMessage"] = $this->errorMessage;
        }

        if (!is_object($this->result) && (is_array($this->result) || is_countable($this->result))) {
            $output["count"] = count($this->result);
        }

        if ($this->total > 0) {
            $output["total"] = $this->total;
        }

        if ($this->result !== null) {
            $output["result"] = $this->result;
        }

        return response()->json($output);
    }
}
