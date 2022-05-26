<?php

namespace App\Actions;

use App\Models\User;
use App\Tasks\ExtractDataFromPaginatorTask;
use JetBrains\PhpStorm\ArrayShape;

class GetUserPaginatorAction
{
    #[ArrayShape(['data' => "array", 'meta' => "array"])]
    public function run(): array
    {
        $paginator = User::query()->orderByDesc('created_at')->paginate(15);
        return app(ExtractDataFromPaginatorTask::class)->run($paginator);
    }
}
