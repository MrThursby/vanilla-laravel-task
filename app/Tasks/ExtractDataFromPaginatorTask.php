<?php

namespace App\Tasks;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use JetBrains\PhpStorm\ArrayShape;

class ExtractDataFromPaginatorTask
{
    #[ArrayShape(['data' => "array", 'meta' => "array"])]
    public function run(LengthAwarePaginator $paginator): array
    {
        $meta = $paginator->toArray();

        $data = $meta['data'];
        unset($meta['data']);

        return compact('data', 'meta');
    }
}
