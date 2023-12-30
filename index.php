<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="./css/index.css">
    <title>FA-Admin</title>
</head>
<style>
    body {
        background-image: url(./img/chrismast.png);
        background-color: cornflowerblue;
    }

    .login {
        width: 28rem;
        height: 30rem;
        background-color: white;
        border-radius: 15px;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    h1 {
        text-align: center;
        margin-top: 2rem;
    }

    .form-control {
        width: 80%;
        /* margin-top: 1rem; */
        margin-left: 10%;
    }

    .alert {
        width: 80%;
        /* margin-top: 1rem; */
        margin-left: 10%;
        height: 2.5rem;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    label {
        margin-left: 10%;
        font-size: 20px;
        margin-top: 1rem;
    }

    button {
        margin-top: 2rem;
    }
</style>
<?php
$con = new mysqli('localhost', 'root', '', 'football_academy');
// session_start();
$username = isset($_POST['username']);
$password = isset($_POST['password']);
if (isset($_POST['btnLog'])) {
    $username = ($_POST['username']);
    $password = ($_POST['password']);
    $sql = "SELECT * FROM tbl_user";
    $exe = $con->query($sql);
    while ($data = $exe->fetch_assoc()) {
        if ($username == $data['Username'] && $password == $data['Password']) {
            header('location:main.php');
        } else if ($username != $data['Username'] && $password != $data['Password']) {
            $_SESSION['msg'] = "Incorrect username or password!";
        }
    }
}
?>

<body>
    <div class="login" id="btnLogin">
        <form action="index.php" method="post">
            <h1>Login</h1>
            <?php
            session_start();
            $username = isset($_POST['username']);
            $password = isset($_POST['password']);
            if (isset($_POST['btnLog'])) {
                $username = ($_POST['username']);
                $password = ($_POST['password']);
                $sql = "SELECT * FROM tbl_user";
                $exe = $con->query($sql);
                $data = $exe->fetch_assoc();
                if ($username == $data['Username'] && $password == $data['Password']) {
                    header('location:main.php');
                } else if ($username != $data['Username'] && $password != $data['Password']) {
                    ?>
                        <div class="alert alert-danger" id="btnAlert" role="alert">
                            <?php
                            echo $_SESSION['msg'] = "Incorrect username or password!";
                            ?>
                        </div>

                    <?php
                }
                session_destroy();
            }
            ?>
            <label for="">Username</label>
            <input type="text" name="username" class="form-control">
            <label for="">Password</label>
            <input type="text" name="password" class="form-control">
            <a href="main.php?code=1"><button type="submit" value="Login" name="btnLog" class="btn btn-success form-control">Login</button></a>
            <!-- <a href="./index.php?code=" type="submit" value="Login" name="btnLog" class="btn btn-success form-control">Login</a> -->
        </form>
    </div>
</body>
<script>
    const btnLogin = document.getElementById('btnLogin');
    const btnAlert = document.getElementById('btnAlert');
    btnLogin.addEventListener('click', () => {
        btnAlert.style.display = "none";
    })
</script>

</html>