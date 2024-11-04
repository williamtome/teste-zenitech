<?php

namespace Williamtome\App\Services;

use RuntimeException;

class File
{
    /**
     * @throws RuntimeException
     */
    public static function uploadFile($file): string
    {
        if (empty($file['name'])) {
            return $file['name'];
        }

        $usersDir = __DIR__ . '/../../public/users/';

        if (!is_dir($usersDir)) {
            if (!mkdir($usersDir, 0755, true) && !is_dir($usersDir)) {
                throw new RuntimeException(sprintf('Diretório "%s" não foi criado', $usersDir));
            }
        }

        $fileName = uniqid('user_', true);
        $uploadPath = $usersDir . $fileName;

        if (!move_uploaded_file($file['name'], $uploadPath)) {
            throw new RuntimeException('Erro ao fazer upload do arquivo');
        }

        return $fileName;
    }
}
