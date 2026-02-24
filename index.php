<?php

if(isset($_POST['Botão_index_mapa'])){
    header("Location: Mapa.php");
    exit();
}
if(isset($_POST['Botão_index_registo'])){
    header("Location: registo.php");
    exit();
}
if(isset($_POST['Botão_index_login'])){
    header("Location: Login.php");
    exit();
}
if(isset($_POST['Botão_index_contactos'])){
    header("Location: sobre.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS.css">
    <title>ZeroLixo</title>
</head>
<body>
    <table>
        <th class="Zero-lixo">
         ZeroLixo
        </th>
        <td class="div_1">
            <div>
                <form method="post" action="">
                    <button type="submit" name="Botão_index_mapa" class="Button_1">Mapa</button>
                    <button type="submit" name="Botão_index_registo" class="Button_1">Registo</button>
                    <button type="submit" name="Botão_index_login" class="Button_1">Login</button>
                    <button type="submit" name="Botão_index_contactos" class="Button_1">Contactos</button>
                </form>
            </div>
    
        </td>
    </table>
    <table>
    <video autoplay muted loop>
        <source src="Videos/Background.mp4" type="video/mp4">
    </video>
    </table>
    
   
    <h2>
    ZEROLIXO é um website que mostra os pontos de recolha e reciclagem em Lisboa, facilitando aos cidadãos saber onde depositar corretamente os resíduos. 
    O objetivo é promover a reciclagem e contribuir para uma cidade mais limpa e sustentável.</h2>

   

</body>
<footer>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <p style="text-align: center;">&copy;2026 ZeroLixo. Todos os direitos reservados.</p>
</footer>
</html>

