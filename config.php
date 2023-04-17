<?php
$db = array(
            'host'=>'localhost',
            'user'=>'root',
            'pass'=> '',
            'nm'=>'db_estacionamento'
        );

$conn = mysqli_connect($db['host'], $db['user'], $db['pass'], $db['nm']) or die ('Sem Conecção ao database');

function removeDirectory($dir) {
    if (!is_dir($dir)) {
        return false;
    }

    $files = array_diff(scandir($dir), array('.', '..'));
    foreach ($files as $file) {
        $path = $dir.'/'.$file;
        if (is_dir($path)) {
            $this->removeDirectory($path);
        } else {
            unlink($path);
        }
    }

    return rmdir($dir);
}

function mensage($txt){
    echo '<script>alert("'.$txt.'");</script>';
}

function move($page){
    echo '<script>red("'.$page.'");</script>';
}

function AtlFile($file, $nm, $user){
    $dir = 'FilesSave';
    $oldDir = $dir.'/Users/'.$user->nm_name.'-'.$user->mail_user.'Fotos';
    $newDir = $dir.'/'.$nm;
    if ($file['tmp_name'] != '') {
        if (file_exists($oldDir)) {
            // Exclui a pasta antiga se ela existir
            removeDirectory($oldDir);
        }

        // Cria o novo diretório
        if (!is_dir($newDir)) {
            mkdir($newDir, 0777, true);
        }
        $path = $file['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $linkF = $newDir.'/FotodePerfil.'.$ext;
        if (move_uploaded_file($file['tmp_name'], $linkF)){
            return $linkF;
        }
    }else{
        // Cria o novo diretório
        if (!is_dir($newDir)) {
            mkdir($newDir, 0777, true);
        }
        $ext = substr($user->img, -3);
        $Local = [
            $user->img,
            $newDir.'/FotodePerfil.'.$ext
        ];
        copy($Local[0], $Local[1]);

        // Cria o novo diretório
        if (file_exists($oldDir)) {
            // Exclui a pasta antiga se ela existir
            if (is_dir($oldDir)) {
                $files = scandir($oldDir);
                foreach ($files as $file) {
                    if ($file != "." && $file != "..") {
                        unlink($oldDir . '/' . $file);
                    }
                }
                rmdir($oldDir);
            }
        }
        
        return $Local[1];
    }
}

function CadUser($nm, $nmC, $mail, $date, $end, $pass, $tel, $img, $adm){
    $query = 'SELECT * FROM user WHERE nm_name = "'.$nm.'" OR mail_user = "'.$mail.'" OR nr_tel = "'.$tel.'"';
    $res = $GLOBALS['conn']->query($query);
    
    $rows = mysqli_num_rows($res);
    if($rows > 0){
        mensage('Nome de usuário e/ou email e/ou telefone já utilizados!');
    }else if($rows == 0){
        $nmF = "Users/".$nm."-".$mail."Fotos";
        $link = UpFile($img, $nmF);
        $query = 'INSERT INTO user (nm_nome, nm_name, mail_user, img, dt_nasc, des_endereco, sl_senha, nr_tel, sl_adm) 
                            VALUES ("'.$nmC.'","'.$nm.'", "'.$mail.'", "'.$link.'","'.$date.'", "'.$end.'","'.$pass.'", "'.$tel.'", '.$adm.')';
        $res = $GLOBALS['conn']->query($query);
        if($res){
            return Login($nm, $pass);
        }else{
            mensage('Erro ao realizar cadastro ;-;, tente novamente!');
        }
    }
}
    
    function UpUser($dados){
        $query = 'SELECT * FROM user WHERE cd_user = '.$dados[5];
        $res = $GLOBALS['conn']->query($query);

        $rows = mysqli_num_rows($res);
        if($rows > 0){
            $user =$res->fetch_object();
            $nmF = "Users/".$dados[1]."-".$user->mail_user."Fotos";
            $link = AtlFile($dados[0], $nmF, $user);
            $query = 'UPDATE user SET nm_name="'.$dados[1].'", des_endereco="'.$dados[4].'", nr_tel="'.$dados[3].'", sl_senha="'.$dados[2].'", img="'.$link.'" WHERE cd_user ='.$dados[5];
            $res = $GLOBALS['conn']->query($query);
            if($res){
                return Login($dados[1], $dados[2]);
            }else{
                mensage('Erro ao realizar atualização de perfil ;-;, tente novamente!');
            }
        }else{
            mensage('User Não Existe!');
        }
    }

function CadEsta($dados){
    $query = 'SELECT * FROM esta WHERE nm_name = "'.$dados[1].'";';
    $res = $GLOBALS['conn']->query($query);

    $rows = mysqli_num_rows($res);
    if($rows > 0){
        mensage('Nome de Estacionamento já utilizado!');
    }else if($rows == 0){
        $link = '';
        if($dados[0]['tmp_name'] == 0 || $dados[0]['tmp_name'] == 1){
            $nmF = 'Esta/'.$dados[1];
            $link = UpFile2($dados[0], $nmF, $dados[0]['tmp_name']);
        }else{
            $nmF = 'Esta/'.$dados[1];
            $link = UpFile($dados[0], $nmF);
        }
        $query = 'INSERT INTO esta (nm_name, des_endereco, img) 
            VALUES ("'.$dados[1].'","'.$dados[2].'","'.$link.'")';
        $res = $GLOBALS['conn']->query($query);
        if(!$res){
            mensage('Erro ao realizar cadastro ;-;, tente novamente!');
        }else{
            $query = 'SELECT * FROM esta WHERE nm_name = "'.$dados[1].'" AND des_endereco = "'.$dados[2].'" AND img = "'.$link.'";';
            $res = $GLOBALS['conn']->query($query);
            $rows = mysqli_num_rows($res);
            if($rows > 0){
                $return = $res->fetch_object();
                return $return;
            }
        }
    }
}
    
    function CadDate($dates, $cd){
        for ($i=3; $i<count($dates); $i++) { 
            $ps = array(
                ($dates[$i][1]+(($dates[$i][1]*$dates[0])/100)),//diario
                ($dates[$i][1]+(($dates[$i][1]*$dates[1])/100)),//convenio
                ($dates[$i][1]+(($dates[$i][1]*$dates[2])/100))//mensal
            );
            $query = 'INSERT INTO data(dt_disp, vl_dia, vl_con, vl_men, id_esta) 
            VALUES ("'.$dates[$i][0].'",'.$ps[0].','.$ps[1].','.$ps[2].','.$cd.')';
            $res = $GLOBALS['conn']->query($query);
        }
    }
        function datasEsta($cd){
            $query = 'SELECT * FROM data WHERE id_esta = '.$cd;
            $res = $GLOBALS['conn']->query($query);

            $rows = mysqli_num_rows($res);
            if($rows > 0){
                $return = array();
                $a = 0;
                while($rl =  mysqli_fetch_array($res)){
                    $return[$a] = $rl;
                    $a++;
                }
                return $return;
            };
        }
        
        function ComprarUser($dados, $dates){
            $query = 'INSERT INTO User_vag(tipo, vl_precoFinal, id_user, id_esta, id_vag) 
            VALUES ('.$dados[4].','.$dados[3].','.$dados[0].','.$dados[1].','.$dados[2].')';
            $res = $GLOBALS['conn']->query($query);
            
            $query = 'UPDATE esta_Vag SET ocup = 1 WHERE cd_vag='.$dados[2];
            $res = $GLOBALS['conn']->query($query);

            for ($i=0; $i<count($dates); $i++) { 
                $query = 'INSERT INTO marcaDay(id_user, id_data) VALUES ('.$dados[0].','.$dates[$i].')';
                $res = $GLOBALS['conn']->query($query);
            }
            mensage('Comprado :)');
        }
    
    function EstacionTable(){
        $query = 'SELECT * FROM esta';
        $res = $GLOBALS['conn']->query($query);
        $rows = mysqli_num_rows($res);
        if($rows > 0){
            $return = array();
            $a = 0;
            while($rl =  mysqli_fetch_array($res)){
                $return[$a] = $rl;
                $a++;
            }
            return $return;
        }else{
            return false;
        }
    }

    function ModifyEsta($docs){
        if($docs[1]==0){
            $esta = EstacionTable();
            $vags = array();
            for($i=0; $i<count($esta); $i++) { 
                $vags[$i] = Estavags($esta[$i]['cd_esta']);
            }
            for($i=0; $i<count($vags); $i++){
                for ($i2=0; $i2<count($vags[$i]); $i2++) { 
                    $Descon = (($vags[$i][$i2]['vl_preco']*$docs[2])/100);
                    $vags[$i][$i2]['vl_preco'] = $docs[3]==0? ($vags[$i][$i2]['vl_preco'] + $Descon):($vags[$i][$i2]['vl_preco'] - $Descon);
                    $dados = array(
                        $vags[$i][$i2]['id_esta'],
                        $vags[$i][$i2]['cd_vag'],
                        $vags[$i][$i2]['vl_preco'],
                        $vags[$i][$i2]['tipo']
                    );
                    AtVag($dados);
                }
            }
        }else if($docs[1]==1){
            $esta = EstacionTable();
            $vags = '';
            for($i=0; $i<count($esta); $i++) { 
                if($esta[$i]['cd_esta']==$docs[0]){
                    $vags = Estavags($esta[$i]['cd_esta']);
                }
            }
            for($i=0; $i<count($vags); $i++){ 
                $Descon = (($vags[$i]['vl_preco']*$docs[2])/100);
                $vags[$i]['vl_preco'] = $docs[3]==0? ($vags[$i]['vl_preco'] + $Descon):($vags[$i]['vl_preco'] - $Descon);
                $dados = array(
                    $vags[$i]['id_esta'],
                    $vags[$i]['cd_vag'],
                    $vags[$i]['vl_preco'],
                    $vags[$i]['tipo']
                );
                AtVag($dados);
            }
        }else if($docs[1]==2){
            $query = 'DELETE FROM esta WHERE cd_esta ='.$docs[0].' AND EXISTS (SELECT cd_esta FROM esta WHERE cd_esta ='.$docs[0].')';
            $res = $GLOBALS['conn']->query($query);
            $rows = mysqli_num_rows($res);
            if($rows > 0){
                mensage('Erro');
            }
        }
    }

function CadVag($dados){
    $query = 'SELECT * FROM esta_Vag WHERE ps_X = '.$dados[1].' AND ps_Y = '.$dados[2].' AND id_esta = '.$dados[0];
    $res = $GLOBALS['conn']->query($query);

    $rows = mysqli_num_rows($res);
    if($rows > 0){
        mensage('Vaga já Criada!');
    }else if($rows == 0){
        $query = 'INSERT INTO esta_Vag(ps_X, ps_Y, tipo, ocup, vl_preco, id_esta) 
            VALUES ('.$dados[1].','.$dados[2].','.$dados[4].', false,'.$dados[3].', '.$dados[0].')';
        $res = $GLOBALS['conn']->query($query);
        if(!$res){
            mensage('Erro ao realizar cadastro ;-;, tente novamente!');
        }
    }
}
    
    function Estavags($cd){
        $query = 'SELECT * FROM esta_Vag WHERE id_esta = '.$cd;
        $res = $GLOBALS['conn']->query($query);

        $rows = mysqli_num_rows($res);
        if($rows > 0){
            $return = array();
            $a = 0;
            while($rl =  mysqli_fetch_array($res)){
                $return[$a] = $rl;
                $a++;
            }
            return $return;
        }else{
            return false;
        }
    }
        
        function SearchUserVag($cd){
            $query = 'SELECT * FROM User_vag WHERE id_vag = '.$cd;
            $res = $GLOBALS['conn']->query($query);

            $rows = mysqli_num_rows($res);
            if($rows > 0){
                $r = $res->fetch_object();
                $query = 'SELECT * FROM user WHERE cd_user = '.$r->id_vag;
                $res = $GLOBALS['conn']->query($query);
                
                $r = $res->fetch_object();
                
                $user = array(
                    $r->mail_user,
                    $r->sl_senha
                );
                return Login($user[0], $user[1]);
            }else{
                return false;
            }
        }

    function QtDtasEsta($cd){
        $query = 'SELECT COUNT(*) AS qt FROM data WHERE id_esta ='.$cd;
        $res = $GLOBALS['conn']->query($query);

        return $res->fetch_object();
    }
    
    function SearcVag($cd){
        $query = 'SELECT * FROM esta_Vag WHERE cd_vag = '.$cd;
        $res = $GLOBALS['conn']->query($query);

        $rows = mysqli_num_rows($res);
        if($rows > 0){
            $return = $res->fetch_object();
            return $return;
        }else{
            return false;
        }
    }
    
    function AtVag($dados){
        $query = 'SELECT * FROM esta_Vag WHERE cd_vag = '.$dados[1].' AND id_esta= '.$dados[0];
        $res = $GLOBALS['conn']->query($query);

        $rows = mysqli_num_rows($res);
        if($rows > 0){
            $query = 'UPDATE esta_Vag SET tipo = '.$dados[3].', vl_preco = '.$dados[2].' WHERE cd_vag ='.$dados[1];
            $res = $GLOBALS['conn']->query($query);
            if(!$res){
                mensage('Erro ao realizar Atualizar, tente novamente!');
            }
        }else{
            mensage('Vaga Não Criada!');
        }
    }

function Login($nm, $pass){
    $query = 'SELECT * FROM user WHERE nm_name = "'.$nm.'" AND sl_senha = "'.$pass.'" OR mail_user = "'.$nm.'" AND sl_senha = "'.$pass.'"';
    $res = $GLOBALS['conn']->query($query);
    
    $rows = mysqli_num_rows($res);
    if($rows > 0){
        $return = $res->fetch_object();
        return $return;
    }else{
        mensage('Nome de usuário/email e/ou senha inválidos!! Tente novamente.');
    }
}

function UpFile($file, $nm){
    $dir = 'FilesSave';
    mkdir(__DIR__.'/'.$dir.'/'.$nm.'/', 0777, true);

    if($file['tmp_name'] != ''){
        $path = $file['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $linkF = $dir.'/'.$nm.'/FotodePerfil.'.$ext;
        move_uploaded_file($file['tmp_name'], $linkF);
    
        return($linkF);
    }else{
        $Local = [
            'imgs/perfilNoImg.png',
            $dir.'/'.$nm.'/FotodePerfil.png'
        ];
        copy($Local[0], $Local[1]);
        return $Local[1];
    }
}

function UpFile2($file, $nm, $fun){
    $dir = 'FilesSave';
    mkdir(__DIR__.'/'.$dir.'/'.$nm.'/', 0777, true);

    if($fun == 0){
        $Local = [
            'imgs/esta1.png',
            $dir.'/'.$nm.'/FotodePerfil.png'
        ];
        copy($Local[0], $Local[1]);
        return $Local[1];
    }else{
        $Local = [
            'imgs/esta2.png',
            $dir.'/'.$nm.'/FotodePerfil.png'
        ];
        copy($Local[0], $Local[1]);
        return $Local[1];
    }
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

function Cripto($Pala){
    return base64_encode($Pala);
}