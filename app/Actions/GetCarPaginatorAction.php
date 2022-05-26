<?php

namespace App\Actions;

use App\Models\Car;
use App\Tasks\ExtractDataFromPaginatorTask;
use JetBrains\PhpStorm\ArrayShape;

class GetCarPaginatorAction
{
    #[ArrayShape(['data' => "array", 'meta' => "array"])]
    public function run(): array
    {
        $paginator = Car::query()->orderByDesc('created_at')->paginate(15);
        return app(ExtractDataFromPaginatorTask::class)->run($paginator);
    }
}
