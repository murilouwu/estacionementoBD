<?php
    function Cripto($Pala, $fun){
        if($fun == 0){
            return base64_encode($Pala);
        }else{
            return base64_decode($Pala);
        };
    }

    $pass = "@senhaforte";
    echo 'pass: '.$pass.'<br>';
    $Cripty = Cripto($pass, 0);
    $DesCripty = Cripto($pass, 1);
    echo 'Senha criptografada: '.$Cripty.'<br>Senha Descriptografada: '.$DesCripty;
?>