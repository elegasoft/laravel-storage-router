<?php


namespace Elegasoft\LaravelStorageRoute\Tests\Http;


use Elegasoft\LaravelStorageRoute\StorageRouter;
use Elegasoft\LaravelStorageRoute\Tests\FeatureTestCase;
use Illuminate\Support\Facades\Storage;

class PathExtractionTest extends FeatureTestCase
{
    /** @test */
    public function it_can_extract_the_relative_file_path()
    {
        $route = 'sample/test/route.jpg';

        $storageRouter = new StorageRouter(config('storage_router.url') . '/' . $route);
        $storageRouter->getFilePath();
        $this->assertEquals($route, $storageRouter->getRelativeFilePath());
    }


    /** @test */
    public function it_can_extract_the_file_path()
    {
        Storage::fake('public');

        $route = 'sample/test/route.jpg';
        Storage::disk('public')->put($route, '');

        $storageRouter = new StorageRouter(config('storage_router.url') . '/' . $route);
        $storageRouter->getFilePath();
        $this->assertStringContainsString($route, $storageRouter->getFilePath());
    }
}