<?php

namespace Williamtome\App\Http;

use DateTime;

class Request
{
    public static function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function validateName(string $name): void
    {
        if (empty(filter_var($name, FILTER_FLAG_EMPTY_STRING_NULL))) {
            $_SESSION['errors']['name'] = 'O nome é obrigatório';
        }
    }

    public static function validateEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errors']['email'] = 'Email inválido';
        }
    }

    public static function validateDate(string $date): void
    {
        if (empty($date)) {
            $_SESSION['errors']['birth_date'] = 'Data de nascimento inválida';
        }

        $dateTime = DateTime::createFromFormat('Y-m-d', $date);

        if (!$dateTime || $dateTime->format('Y-m-d') !== $date) {
            $_SESSION['errors']['birth_date'] = 'Data de nascimento com formato inválido.';
        }
    }

    public static function validateFile(array $file): void
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['errors']['image'] = 'Foto está corrompida! Por favor escolha outra imagem.';
        }

        $maxSize = 5 * 1024 * 1024;
        if ($file['size'] > $maxSize) {
            $_SESSION['errors']['image'] = 'A foto escolhida está com o tamanho maior do que 5MB.';
        }

        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowedTypes)) {
            $_SESSION['errors']['image'] = 'O formato da foto é inválido.';
        }

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, $allowedExtensions)) {
            $_SESSION['errors']['image'] = 'A extensão da foto é inválida.';
        }
    }

}
