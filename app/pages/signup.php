<?php

    if(!empty($_POST)) {
        // validate
        $errors = [];

        /**uernname */
        if(empty($_POST['username'])) {
            $errors['username'] = 'Username is required';
        } else if(!preg_match("/^[a-zA-Z]+/", $_POST['username'])) {
            $errors['username'] = 'Username can only letter and nospace';
        }

        /**email */
        $query = "select id from users where email=:email limit 1";
        $email = query($query, ['email'=>$_POST['email']]);

        if(empty($_POST['email'])) {
            $errors['email'] = 'Email is required';
        } else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email is not valid';
        } else if($email) {
            $errors['email'] = 'That email is already in used.';
        }

        /**password */
        if(empty($_POST['password'])) {
            $errors['password'] = 'Password is required';
        } else if (strlen($_POST['password']) < 4) {
            $errors['password'] = 'Password must be 4 characters longer or more';
        } else if ($_POST['password'] !== $_POST['cpassword']) {
            $errors['password'] = 'Password do not matched';
        }

        /**terms and condtion */
        if(empty($_POST['remember'])) {
            $errors['remember'] = 'Please accept the terms and condtions';
        }

        if(empty($errors)) {
            // save to db 
            $data = [];
            $data['username'] = $_POST['username'];
            $data['email'] = $_POST['email'];
            $data['role'] = "user";
            $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $query = "insert into users (username,email,password,role) values (:username,:email,:password,:role)";
            query($query, $data);

            redirect('login');
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
        <form method="post">
            <?php if(!empty($errors)): ?>
                <div style="color: red">Please fixed the error bellow</div>
            <?php endif; ?>
            <input type="text" name="username" placeholder="Username" value="<?=old_value('username')?>"> <br />
            <?php if(!empty($errors['username'])): ?>
                <div style="color: red"><?=$errors['username'];?></div>
            <?php endif; ?>
            <input type="email" name="email" placeholder="Email" value="<?=old_value('email')?>"> <br />
            <?php if(!empty($errors['email'])): ?>
                <div style="color: red"><?=$errors['email'];?></div>
            <?php endif; ?>
            <input type="text" name="password" placeholder="Password" value="<?=old_value('password')?>"> <br />
            <?php if(!empty($errors['password'])): ?>
                <div style="color: red"><?=$errors['password'];?></div>
            <?php endif; ?>
            <input type="text" name="cpassword" placeholder="Confirm Password" value="<?=old_value('cpassword')?>"> <br />
            <?php if(!empty($errors['cpassword'])): ?>
                <div style="color: red"><?=$errors['cpassword'];?></div>
            <?php endif; ?>
            <input type="checkbox" name="remember" id="remember" <?=old_checked('remember'); ?> >
            <label for="remember">Accept terms and conditions.</label> <br />
            <?php if(!empty($errors['remember'])): ?>
                <div style="color: red"><?=$errors['remember'];?></div>
            <?php endif; ?>
            <input type="submit" value="Signup">

            <p>Already have an account? <a href="login">Sign Here</a></p>
        </form>
    </div>

    <script src="<?=ROOT ?>/assets/js/jquery.min.js"></script>
    <script src="<?=ROOT ?>/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>