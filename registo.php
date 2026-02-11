<?php
session_start();
require "db.php";

$erro = "";
$sucesso = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username  = trim($_POST['username'] ?? '');
    $password  = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';
    $role      = $_POST['role'] ?? '';

    if ($username === "" || $password === "" || $password2 === "" || $role === "") {
        $erro = "Preencha todos os campos";
    } elseif ($password !== $password2) {
        $erro = "As passwords não coincidem";
    } else {

        // Verificar se username já existe
        $stmt = $pdo->prepare("SELECT id FROM utilizadores WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $erro = "Este username já existe";
        } else {

            $stmt = $pdo->prepare(
                "INSERT INTO utilizadores (username, password, role)
                 VALUES (:username, :password, :role)"
            );

            $hash = md5($password); 

            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hash, PDO::PARAM_STR);
            $stmt->bindParam(':role', $role, PDO::PARAM_STR);

            $stmt->execute();

            $sucesso = "Conta criada com sucesso!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Registo | Alberto Vidros</title>
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
    <p>Criar nova conta</p>

    <?php if ($erro): ?>
        <div class="alert-error"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <?php if ($sucesso): ?>
        <div class="alert-success"><?= htmlspecialchars($sucesso) ?></div>
    <?php endif; ?>

    <form method="post" autocomplete="off">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password2" placeholder="Confirmar Password" required>

        <select name="role" required>
            <option value="" disabled selected>Selecionar perfil</option>
            <option value="operador">Operador</option>
            <option value="admin">Administrador</option>
        </select>

        <button type="submit">Registar</button>
    </form>

    <p style="margin-top:15px;">
        Já tem conta?
        <a href="login.php">Entrar</a>
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
