<?php
session_start();
require "db.php";

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $role     = $_POST['role'] ?? '';

    if ($username === "" || $password === "" || $role === "") {
        $erro = "Preencha todos os campos";
    } else {
        $stmt = $pdo->prepare(
            "SELECT * FROM utilizadores WHERE username = ? AND password = ? AND role = ?"
        );
        $stmt->execute([$username, md5($password), $role]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['user'] = $user;
            header("Location: ../index.php");
            exit;
        } else {
            $erro = "Credenciais ou perfil inválidos";
        }
    }
}

