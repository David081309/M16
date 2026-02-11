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
?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Login | ZeroLixo</title>
<link rel="stylesheet" href="../css/estilo.css">
<style>
.mouse-ball {
    position: fixed;
    top: 0;
    left: 0;
    width: 220px;
    height: 220px;
    background: rgba(154,77,255,0.5);
    border-radius: 50%;
    pointer-events: none;
    transform: translate(-50%, -50%);
    transition: transform 0.05s ease-out;
    z-index: 1;
}
</style>
</head>

<body class="login-body">

<div class="mouse-ball"></div>

<div class="purple-bg">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
</div>

<div class="login-glass ultra">
    <h1>Alberto <span>Vidros</span></h1>
    <p>Gestão de vidro reciclado</p>

    <?php if ($erro): ?>
        <div class="alert-error"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="post" autocomplete="off">
        <input type="text" name="username" placeholder="Username" required autofocus>
        <input type="password" name="password" placeholder="Password" required>

        <select name="role" required>
            <option value="" disabled selected>Selecionar perfil</option>
            <option value="operador">Operador</option>
            <option value="admin">Administrador</option>
        </select>

        <button type="submit">Entrar</button>
    </form>

    <p style="margin-top:15px;">
        Não tem conta?
        <a href="register.php">Criar conta</a>
    </p>

    <div class="glow-line"></div>
</div>

<script>
const mouseBall = document.querySelector('.mouse-ball');
document.addEventListener('mousemove', e => {
    mouseBall.style.transform =
        `translate(${e.clientX}px, ${e.clientY}px) translate(-50%, -50%)`;
});
</script>

</body>
</html>
