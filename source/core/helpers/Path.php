<?php

namespace TitaniumFoundation\Core\Helpers;

class Path
{
    public static function root(string $path = ''): string
    {
        if(php_sapi_name() !== 'cli')
            return $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . $path;

        return __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . $path;
    }

    /**
     * Scan concrete path for files and dirs.
     *
     * @param string $path
     * @return array
     */
    public static function scan(string $path): array
    {
        $directory = scandir($path);

        unset($directory[0]);
        unset($directory[1]);

        return Arr::reindex($directory);
    }

    /**
     * Get full files list of directory.
     *
     * @param string $path
     * @return array
     */
    public static function scanFiles(string $path): array
    {
        $fileScan = self::scan($path);
        $result = [];

        foreach ($fileScan as $folder) {
            $folderPath = $path . DIRECTORY_SEPARATOR . $folder;

            if (is_dir($folderPath)) {
                $result[$folderPath.'/'.$folder] =  self::scanFiles($folderPath);
            } else {
                $result[$folderPath.'/'.$folder] = $folder;
            }
        }

        return $result;
    }
}