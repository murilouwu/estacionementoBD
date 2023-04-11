<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <Form method="post" enctype="multipart/form-data">
        <input type="file" name="foto" id="InputImgEnv" accept="image/*">
        <input type="file" style="display: none;" name="fotoSub" accept="image/*" value="imgs/perfilNoImg.png">
        <input type="submit" value="Enviar" name="env">
    </Form>
    <?php
        function UpFile($file, $nm){
            $dir = 'FilesSave/';
            mkdir(__DIR__.'/'.$dir.'/'.$nm.'/', 0777, true);
            
            $linkF = $dir.'/'.$nm.'/'.$file['name'];
            move_uploaded_file($file['tmp_name'], $linkF);
        
            return($linkF);
        }
        if(isset($_POST['env'])){
            echo $_FILES['fotoSub']['tmp_name'];
            /*$img = empty($_FILES['foto'])? $_FILES['foto']:$_FILES['fotoSub'];
            $nm = "fileA";
            $link = UpFile($img, $nm);
            echo '
                <p>'.$nm.'</p>
                <img src="'.$link.'">
            ';*/
        }
    ?>
</body>
</html>