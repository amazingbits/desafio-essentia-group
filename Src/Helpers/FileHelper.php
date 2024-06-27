<?php

namespace Src\Helpers;

class FileHelper
{
    private static string $dir = __DIR__ . "/../../uploads/";
    private static array $allowedExtensions = ["jpg", "jpeg", "png"];

    private static function makeDir(): void
    {
        if (!file_exists(self::$dir)) {
            @mkdir(self::$dir);
        }
    }

    public static function getFileExtension(array $file): string
    {
        $fileName = $file["name"];
        $fileNameExp = explode('.', $fileName);
        return mb_strtolower(end($fileNameExp));
    }

    public static function createFile(string $fileName, array $file): bool
    {
        self::makeDir();

        $fileExtension = self::getFileExtension($file);

        if (!in_array($fileExtension, self::$allowedExtensions)) {
            return false;
        }

        if ((int)$file["size"] > ((int)env("MAX_FILE_SIZE_IN_MB") * 1000000)) {
            return false;
        }

        if (!move_uploaded_file($file["tmp_name"], self::$dir . $fileName . "." . $fileExtension)) {
            return false;
        }

        return true;
    }

    public static function deleteFile(string $fileName): bool
    {
        try {
            @unlink(self::$dir . $fileName);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}