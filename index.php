<?php
    //checking file reception
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
        $error = 1;

        //checking size
        if($_FILES['image']['size'] <= 3000000){

            //checking extension
            $informationsImage = pathinfo($_FILES['image']['name']);
            $extensionImage = $informationsImage['extension'];
            $extensionsArray = array('jpg', 'png', 'jpeg', 'gif');

            if(in_array($extensionImage, $extensionsArray)){

                $address = 'uploads/'.time().rand().rand().'.'.$extensionImage;
                move_uploaded_file($_FILES['image']['tmp_name'], $address);
                echo 'Success';
                $error = 0;
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Images Uploader</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/reset.css">
</head>
<body>
    <header>
        <h1>Upload Your Images</h1>
    </header>
    <section>
        <form method="post" action="index.php" enctype="multipart/form-data">
            <table>
                <thead>
                    <tr>
                        <th>Choose your image :</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td><button type="submit">Send</button></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <?php
            if(isset($error) && $error == 0){
                echo '<div id="presentation-picture"><img src="'.$address.'" id="upImage"/><br/ >
                
                <input type="text" value="http://127.0.0.1/imagesUploader/'.$address.'" /></div>
                ';
            } else if(isset($error) && $error == 1){
                echo'Votre image ne peut pas être envoyée. Vérifiez son extension et sa taille (maximum à 3mo).';
            }
        ?>
    </section>
</body>
</html>