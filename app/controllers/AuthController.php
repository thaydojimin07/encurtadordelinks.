<?php

namespace App\Controllers;

use Core\Controller;
use Core\Database;

class AuthController extends Controller
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $name = trim($_POST['name']);
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            // Conectar ao banco de dados
            $db = Database::connect();

            // Preparar a instrução para inserção
            $stm = $db->prepare("INSERT INTO users (name, username, email, password) VALUES (:name, :username, :email, :password)");

            // Hash da senha
            $hash_password = password_hash($password, PASSWORD_DEFAULT);

            // Bind dos parâmetros
            $stm->bindParam(":name", $name);
            $stm->bindParam(":username", $username);
            $stm->bindParam(":email", $email);
            $stm->bindParam(":password", $hash_password);

            // Executa a instrução e verifica se foi bem-sucedida
            if ($stm->execute()) {
                $this->redirect('/login');
                  } else {
                echo "Erro ao registrar o usuário. Por favor, tente novamente.";
            }
        }
        $this->view('/auth/register');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = $_POST['password'];

            // Conectar ao banco de dados
            $db = Database::connect();
            $stm = $db->prepare("SELECT * FROM users WHERE username = :username");

            // Bind do parâmetro
            $stm->bindParam(":username", $username);
            $stm->execute();

            // Buscar o usuário
            $user = $stm->fetch();
            session_start();

            // Verificar se o usuário existe e a senha está correta
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['username'] = $user['username'];

                $this->redirect('/dash');
            } else {
                echo "Usuário ou senha incorretos. Por favor, tente novamente.";
            }
        }
        $this->view('auth/login');
    }
}
