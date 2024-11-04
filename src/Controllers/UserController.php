<?php

namespace Williamtome\App\Controllers;

use PDO;
use Williamtome\App\Database\Connection;
use Williamtome\App\Http\Request;
use Williamtome\App\Services\File;

class UserController extends BaseController
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Connection::connect();
    }

    public function index()
    {
        $users = $this->db
            ->query("SELECT * FROM users LIMIT 10;")
            ->fetchAll(PDO::FETCH_ASSOC);

        echo $this->render('users/index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $errors = $_SESSION['errors'] ?? [];

        echo $this->render('users/create', [
            'errors' => $errors,
        ]);
    }

    public function store()
    {
        $name = filter_input(INPUT_POST, 'name');
        Request::validateName($name);

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        Request::validateEmail($email);

        $birthDate = $_POST['birth_date'] ?? '';
        Request::validateDate($birthDate);

        Request::validateFile($_FILES['image']);

        if (!empty($_SESSION['errors'])) {
            return $this->create();
        }

        try {
            $imagePath = File::uploadFile($_FILES['image']);

            $stmt = $this->db->prepare("
                INSERT INTO users (name, email, birth_date, image_path) 
                VALUES (:name, :email, :birth_date, :image_path)
            ");

            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':birth_date' => $birthDate,
                ':image_path' => $imagePath
            ]);

            header('Location: /');
            exit;

        } catch (\RuntimeException $e) {
            $_SESSION['errors'] = ['general' => $e->getMessage()];
            return $this->create();
        }
    }
}
