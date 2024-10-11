<?php

namespace App\Domain;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DTO
{
    protected array $excludeMapper = [];
    protected array $requestMapper = [];

    public function __construct($payload = null)
    {
        if ($payload === null) {
            return;
        }

        $data = ! $payload instanceof Request ? (is_array($payload) ? $payload : $payload->toArray()) : $payload->all();

        $attributes = array_keys(get_object_vars($this));
        foreach ($data as $key => $value) {
            $attributeName = Str::camel($this->requestMapper[$key] ?? $key);
            if (! in_array($attributeName, $attributes)) {
                continue;
            }

            $this->{$attributeName} = $value;
        }
    }

    public function toArray(): array
    {
        $tmp = [];
        $excludeList = [
            'excludeMapper',
            'requestMapper',
        ];

        foreach (get_object_vars($this) as $key => $value) {
            if ($value === null || in_array($key, $excludeList) || in_array($key, $this->excludeMapper)) {
                continue;
            }
            $tmp[Str::snake($key)] = $value;
        }

        return $tmp;
    }
}
