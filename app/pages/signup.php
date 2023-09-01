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
        <form action="" method="post">
            <input type="text" placeholder="Username"> <br />
            <input type="email" placeholder="Email"> <br />
            <input type="text" placeholder="Password"> <br />
            <input type="text" placeholder="Confirm Password"> <br />
            <input type="checkbox" id="remember">
            <label for="remember">Accept terms and conditions.</label> <br />
            <input type="submit" value="Signup">

            <p>Already have an account? <a href="login">Sign Here</a></p>
        </form>
    </div>

    <script src="<?=ROOT ?>/assets/js/jquery.min.js"></script>
    <script src="<?=ROOT ?>/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>