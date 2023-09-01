<?php

    if(!empty($_POST)) {

        // validate 
        $errors = []; 
        $query = "select * from users where email = :email limit 1";
        $row = query($query, ['email' => $_POST['email']]);

        if($row) {
            $data = [];
            if(password_verify($_POST['password'], $row[0]['password'])) {
                // access 
                authenticate($row[0]);
                redirect('admin');
            } else {
                $errors['email'] = 'Wrong email or password';
            }
            
        } else {
            $errors['email'] = 'Wrong email or password';
        }
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | <?=APP_NAME?></title>
    <link rel="stylesheet" href="<?=ROOT ?>/assets/css/bootstrap.min.css">
</head>
<body>
    <div class="nwt-login">
        <?php if(!empty($errors['email'])): ?>
            <div style="color: red"><?=$errors['email']?></div>
        <?php endif; ?>
        <form action="#" method="POST">
            <input type="email" name="email" placeholder="Email" value="<?=old_value('email')?>"> <br />
            <input type="text" name="password" placeholder="Password" value="<?=old_value('password')?>"> <br />
            <input type="checkbox" id="remember">
            <label for="remember">Remember Me</label> <br />
            <input type="submit" value="Login">

            <p>Don't have an account? <a href="signup">Login Here</a></p>
        </form>
    </div>
    <script src="<?=ROOT ?>/assets/js/jquery.min.js"></script>
    <script src="<?=ROOT ?>/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>