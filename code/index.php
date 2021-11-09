<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <nav>
        <div>
            <h3>ITOP CONSULTING</h3>
            <ul class="menu-main">
                <li><a href="index.php">HOME</a></li>
                <li <?php if(!isset($_SESSION["user_id"])){?> class="disabled"<?php }?>><a href="views/user.view.php">REGISTROS</a></li>
                <li <?php if(!isset($_SESSION["user_id"])){?> class="disabled"<?php }?>><a href="#">PERFIL</a></li>
                <li><a href="#">SOBRE NOSOTROS</a></li>
            </ul>
        </div>
        <ul class="menu-member">
            <?php
                if(isset($_SESSION["user_id"]))
                {
            ?>
                <li><a href="#"><?php echo $_SESSION["username"]; ?></a></li>
                <li><a href="includes/logout.inc.php" class="header-login-a">CERRAR SESIÓN</a></li>
            <?php
                }
                else
                {
            ?>
                <li><a href="#">REGISTRATE</a></li>
                <li><a href="#" class="header-login-a">ENTRAR</a></li>
            <?php  
                }
            ?>
        </ul>
    </nav>
</header>

<section class="index-intro">
    <div class="index-intro-bg">
        <div class="wrapper">
            <div class="index-intro-c1">
                <div class="logo"></div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras mollis dui a leo sagittis tempor. Praesent ante ante, eleifend eu quam vel, rutrum egestas purus.</p>
            </div>
            <div class="index-intro-c2">
                <h2>Ejercicio<br>De Selección<br>Para Curie</h2>
                <a href="https://github.com/jjtorres93">CHECK MY GITHUB</a>
            </div>
        </div>
    </div>
</section>

<?php 
if($_SERVER['REQUEST_URI']== '/itop/code/index.php?error=usernotfound' || $_SERVER['REQUEST_URI']== '/itop/code/index.php?error=usernotfound'){
    echo '<div class="error">Usuario o contraseña incorrecta<div>';
};
?>

<section class="index-login">
    <div class="wrapper">
        <div class="index-login-signup">
            <h4>REGISTRATE!</h4>
            <p>¿No tienes una cuenta? ¡Regístrate ahora!</p>
            <form action="includes/signup.inc.php" method="post">
                <input type="text" name="username" pattern="[A-Za-z\d\.\_\-]" placeholder="Username">
                <input type="password" name="pwd" pattern="[A-Za-z\d\.\_\-]" placeholder="Password">
                <input type="password" name="fname" maxlength="32" placeholder="Name">
                <input type="text" name="lname" maxlength="64" placeholder="Last Name">
                <br>
                <button type="submit" name="submit">REGISTRATE</button>
            </form>
        </div>
        <div class="index-login-login">
            <h4>INICIA SESIÓN</h4>
            <p>¿Ya tienes una cuenta? ¡Inicia sesión ahora!</p>
            <form action="includes/login.inc.php" method="post">
                <input type="text" name="username" pattern="[A-Za-z\d\.\_\-]" placeholder="Username">
                <input type="password" name="pwd" pattern="[A-Za-z\d\.\_\-]" placeholder="Password">
                <br>
                <button type="submit" name="submit">ENTRAR</button>
            </form>
        </div>
    </div>
</section>
    
</body>
</html>