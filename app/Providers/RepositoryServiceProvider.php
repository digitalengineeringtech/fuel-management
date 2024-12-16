<?php

namespace App\Providers;

use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }

    /**
     * Register services.
    */
    public function register(): void
    {
        $this->bindRepositories('Cloud');
    }

    /**
     * Bind repositories dynamically.
     *
     * @param string $type
     */
    private function bindRepositories(string $type)
    {
        // Base directory for Contracts and Concretes
        $contractsDir = base_path("app/Repositories/{$type}/Contracts");
        $concretesDir = base_path("app/Repositories/{$type}/Concretes");

        // Get all contract interface files
        $interfaceFiles = File::allFiles($contractsDir);

        foreach ($interfaceFiles as $file) {
            // Get the full namespace of the interface
            $interfaceNamespace = $this->getNamespaceFromPath($file->getPathname(), 'Contracts', $type);

            // Determine the concrete class namespace
            $concreteNamespace = str_replace(
                ['Contracts', 'Interface'],
                ['Concretes', ''],
                $interfaceNamespace
            );

            // Bind the interface to the concrete class if the class exists
            if (class_exists($concreteNamespace)) {
                $this->app->bind($interfaceNamespace, $concreteNamespace);
            } else {
                throw new Exception("Concrete class not found for interface: $interfaceNamespace");
            }
        }
    }

    /**
     * Get the fully qualified namespace of a class from its file path.
     *
     * @param string $filePath
     * @param string $contractFolder
     * @param string $type
     * @return string
     */
    private function getNamespaceFromPath(string $filePath, string $contractFolder, string $type): string
    {
        // Normalize file path to use the correct directory separator
        $normalizedPath = str_replace(DIRECTORY_SEPARATOR, '/', $filePath);

        // Remove the `base_path` prefix to get the relative path
        $relativePath = str_replace(base_path() . '/', '', $normalizedPath);

        // Remove the 'app/' prefix specifically
        $relativePath = ltrim($relativePath, 'app/');

        // Convert the relative path into a namespace
        $namespace = str_replace(['/', '.php'], ['\\', ''], $relativePath);

        // Ensure the namespace starts with `App\`
        return 'App\\' . $namespace;

    }
}
