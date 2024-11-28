<?php

namespace App\Controllers;

use Core\Controller;
use Core\Database;

class HomeController extends Controller
{
    public function index()
    {
        $this->view('home/index');
    }
    public function shorten()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $url = $_POST['url'];
            $shortCode = $this->generateShortCode();

            $db = Database::connect();

            $stmt = $db->prepare("INSERT INTO urls (original_url, short_code) VALUES (:original_url, :short_code)");
            $stmt->bindParam(':original_url', $url);
            $stmt->bindParam(':short_code', $shortCode);
            $stmt->execute();
                    
             echo "URL encurtada: http://localhost/r?code={$shortCode}";
        }
    }

    public function redirectTo()
    {
        $shortCode = $_GET['code'] ?? null;

        if ($shortCode) {
            $model = new UserModel();
            $url = $model->getUrlByShortCode($shortCode);

            if ($url) {
                header("Location: $url");
                exit;
            }
        }

        echo "URL não encontrada!";
    }

    private function generateShortCode()
    {
        return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);
    }
}
