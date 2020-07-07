<?php


namespace Elegasoft\LaravelStorageRoute\Tests\Http;


use Elegasoft\LaravelStorageRoute\Tests\FeatureTestCase;
use Illuminate\Support\Facades\Storage;

class StorageRouterControllerTest extends FeatureTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake(config('storage_router.disk'));
    }

    /** @test */
    public function it_can_route_to_a_file()
    {
        $file = 'fake/test.txt';
        Storage::disk(config('storage_router.disk'))->put($file, 'abcdef');

        $request = config('storage_router.url') . '/' . $file;

        $this->get($request)
             ->assertSuccessful();
    }

    /** @test */
    public function it_returns_a_404_when_no_file_is_stored()
    {
        $file = 'fake/test.txt';

        $request = config('storage_router.url') . '/' . $file;

        $this->get($request)
             ->assertStatus(404);
    }
}