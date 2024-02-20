<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['email']) && !empty($_SESSION['email'])){
    header("Location: /php/liste_eleves_LGXSchool/view/home.php");
}

require_once(__DIR__."/../controller/teacher.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../config/style.css">
    <title>Connexion à LGX School</title>
</head>
<body>
    <?php
    $teacherCtrl = new TeacherCtrl();

    if(isset($_POST['isSendLogin'])){
        $teacherCtrl->teacherLogin();
    } 
    ?>
   

    <div id="login-container">
            <div id="login-page" >
            <h2 style="margin:5px">Connexion à LGX School</h2>
                <form action="#" method="post">
                    <label for="email">Email</label>
                    <input type="text" name="email" required>
                    <br>
                    <label for="password">Password:</label>
                    <input type="password" name="password" required>
                    <br>
                    <input type="submit" value="Se connecter" name="isSendLogin">
                </form>
            </div>
    </div>
</body>
</html>