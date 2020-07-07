<?php

namespace Elegasoft\LaravelStorageRoute\Controllers;

use elegasoft\LaravelStorageRoute\StorageRouter;

class FallbackController extends \Illuminate\Routing\Controller
{

    public function __invoke($path)
    {
        $storage_router = new StorageRouter($path);

        if ($storage_router->isStoragePathRequest() && $storage_router->resourceExists())
        {
            return response()->file($storage_router->getFilePath(),
                [
                    'content/type' => $storage_router->getContentType(),
                ]);
        }

        return abort(404);
    }

}