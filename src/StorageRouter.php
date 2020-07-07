<?php


namespace Elegasoft\LaravelStorageRoute;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use function config;
use function substr;

class StorageRouter
{
    /**
     * @var string
     */
    protected $requestPath;

    /**
     * @var string
     */
    protected $storageRoute;

    /**
     * @var string
     */
    protected $filePath;

    /**
     * @var false|string
     */
    protected $relativeFilePath;
    protected $storageFolder;

    /**
     * StorageRoute constructor.
     *
     * @param string $requestPath
     */
    public function __construct(string $requestPath)
    {
        $this->requestPath = $requestPath;
        $this->storageRoute = config('storage_router.url') . '/';
        $this->setFilePaths();
        $this->gate = app(Gate::class);
    }

    /**
     * Determines whether the request is intended
     * for the URL of the public storage path
     *
     * @return bool
     */
    public function isStoragePathRequest()
    {
        return strpos($this->requestPath, $this->storageRoute) === 0;
    }

    /**
     * Determines whether the request passes all
     * authorizations for the requested file.
     *
     * @return bool
     */
    public function isAuthorized()
    {
        return Gate::allows('viewStorageItems', $this->relativeFilePath);
    }

    /**
     * Determines whether the requested resource exists
     *
     * @return bool
     */
    public function resourceExists()
    {
        return Storage::disk(config('storage_router.disk'))->exists($this->relativeFilePath);
    }

    /**
     * Removes the storage route prefix from the URL
     * leaving behind the requested file path
     *
     * @return void
     */
    private function setFilePaths()
    {
        $this->relativeFilePath = substr($this->requestPath, strlen($this->storageRoute));
        $this->filePath = Storage::disk(config('storage_router.disk'))->path($this->relativeFilePath);
    }

    /**
     * Returns the content type of the requested file
     *
     * @return string|null
     */
    public function getContentType()
    {
        return (new UploadedFile($this->filePath, $this->relativeFilePath))->getMimeType();
    }

    /**
     * Returns the fully qualified file path
     *
     * @return string
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * Returns the relative file path
     *
     * @return false|string
     */
    public function getRelativeFilePath()
    {
        return $this->relativeFilePath;
    }
}