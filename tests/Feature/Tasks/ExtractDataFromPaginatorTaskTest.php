<?php

namespace Tests\Feature\Tasks;

use App\Models\Car;
use App\Tasks\ExtractDataFromPaginatorTask;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;
use ReflectionException;
use Tests\TestCase;

class ExtractDataFromPaginatorTaskTest extends TestCase
{
    /** @var class-string */
    private string $model = Car::class;

    /**
     * @return void
     * @throws ReflectionException
     */
    public function test_run()
    {
        $this->assertIsExtendsModel($this->model);
        $this->assertIsUsesHasFactory($this->model);

        $count = 20;
        $per_page = 15;

        $this->model::factory()->count($count)->create();
        $paginator = $this->model::paginate($per_page);

        ['data' => $data, 'meta' => $meta] = app(ExtractDataFromPaginatorTask::class)->run($paginator);

        $this->assertEquals($count, $meta['total']);
        $this->assertCount($per_page, $data);
    }

    private function assertIsExtendsModel(string|object $className): void
    {
        $this->assertTrue(
            is_subclass_of($className, Model::class),
            'Value not extends Model'
        );
    }

    /**
     * @throws ReflectionException
     */
    private function assertIsUsesHasFactory(string|object $className): void
    {
        $this->assertTrue(in_array(
            HasFactory::class,
            array_keys((new ReflectionClass($className))->getTraits())
        ), 'Value not use HasFactory');
    }
}
