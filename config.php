<?php 
session_start();
/*$db = array(
            'host'=>'localhost',
            'user'=>'root',
            'pass'=> '',
            'nm'=>'db_estacionamento'
        );

$conn = mysqli_connect($db['host'], $db['user'], $db['pass'], $db['nm']) or die ('Sem Conecção ao database');*/

function mensage($txt){
    echo '<script>alert("'.$txt.'");</script>';
}

function CadUser($nm, $nmC, $mail, $date, $end, $pass, $tel, $img){
    $query = 'SELECT * FROM user WHERE nm_name = "'.$nm.'" OR mail_user = "'.$mail.'" OR nr_tel = "'.$tel.'"';
    $res = $GLOBALS['conn']->query($query);
    
    $rows = mysqli_num_rows($res);
    if($rows > 0){
        mensage('Nome de usuário e/ou email e/ou telefone já utilizados!');
    }else if($rows == 0){
        $link = UpFile($img, $nm);
        $query = 'INSERT INTO user (nm_nome, nm_name, mail_user, img, dt_nasc, des_endereco, nr_cartão, sl_senha, nr_tel, sl_adm) 
                            VALUES ("'.$nmC.'","'.$nm.'", "'.$mail.'", "'.$link.'","'.$date.'", "'.$end.'", "'.$cad.'","'.$pass.'", "'.$tel.'", false)';
        $res = $GLOBALS['conn']->query($query);
        if($res){
            mensage('Cadastro realizado com sucesso! :), seja bem vindo '.$nm);
            return Login($nm, $pass);
        }else{
            mensage('Erro ao realizar cadastro ;-;, tente novamente!');
        }
    }
}
function addAdm($cd, $adm){
    $sql = 'UPDATE user SET adm = '.$adm.' WHERE cd = '.$cd;
    $res = $GLOBALS['con']->query($sql);
    if(!$res){
        mensage("Erro a ADMificar user");
    }
}

function deleteUser($cd){
    $sql = 'DELETE FROM user WHERE cd = '.$cd;
    $res = $GLOBALS['con']->query($sql);
    if(!$res){
        mensage('Erro ao Excluir');
    }
}

function Login($nm, $pass){
    $query = 'SELECT * FROM user WHERE nm_name = "'.$nm.'" AND sl_senha = "'.$pass.'" OR mail_user = "'.$nm.'" AND sl_senha = "'.$pass.'"';
    $res = $GLOBALS['conn']->query($query);
    
    $rows = mysqli_num_rows($res);
    if($rows > 0){
        return $res->fetch_object();
        header('Location: index.php');
    }else{
        mensage('Nome de usuário/email e/ou senha inválidos!! Tente novamente.');
    }
}

function UpFile($file, $nm){
    $dir = 'FilesSave/';
    mkdir(__DIR__.'/'.$dir.'/'.$nm.'/', 0777, true);
    
    $linkF = $dir.'/'.$nm.'/'.$file['name'];
    move_uploaded_file($file['tmp_name'], $linkF);

    return($linkF);
}

function HeaderEcho($Title, $css, $logo){
    $res = '
        <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <script src="https://kit.fontawesome.com/39cab4bf95.js" crossorigin="anonymous"></script>
                <script src="java.js"></script>
                <script src="https://code.jquery.com/jquery-3.2.1.slim.js" integrity="sha256-tA8y0XqiwnpwmOIl3SGAcFl2RvxHjA8qp0+1uCGmRmg=" crossorigin="anonymous"></script>
                <link rel="stylesheet" type="text/css" href="'.$css.'">
                <link rel="shortcut icon" href="'.$logo.'">
                <title>'.$Title.'</title>
            </head>
            <body>
    ';
    echo($res);
}
function footEcho(){
    $res = '
            </body>
        </html>
    ';
    echo($res);
}