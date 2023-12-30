<?php $con = new mysqli('localhost', 'root', '', 'football_academy');

?>
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

<body>
    <div class="container-fluid bg-info">
        <button class="btn btn-primary" id="btnNav" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i
                class="fa-solid fa-bars"></i></button>
        <marquee class="FA" direction="left" loop="">
            <div class="fa1">Football Academy Office</div>
        </marquee>
    </div>


    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
        id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header">
            <div class="logo">
                <img src="./img/fa-logo.jpg" alt="">
            </div>
            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Football Academy</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <a href="">
                <div class="player">
                    <h1><i class="fa-solid fa-gauge"></i> Dashboard</h1>
                </div>
            </a>
            <a href="">
                <div class="player">
                    <h1><i class="fa-solid fa-user-tie"></i> Manager</h1>
                </div>
            </a>
            <a href="./player.php">
                <div class="player">
                    <h1><i class="fa-solid fa-user"></i> Player</h1>
                </div>
            </a>
            <div class="player" style="margin-top: 15rem;">
                <?php
                $sqlMan = "SELECT
                    M.ID,
                    M.Name,
                    M.Profile,
                    U.Username,
                    U.Password
                    FROM tbl_manager M
                    INNER JOIN tbl_user U ON M.ID = U.ID";
                $exeMan = $con->query($sqlMan);
                $dataMan = $exeMan->fetch_assoc();
                ?>

                <div class="pro" style="margin: .5rem 1rem;">
                    <img src="./img/<?php echo $dataMan['Profile']; ?>" alt="">
                </div>
                <label for="" style="margin: 1rem 1rem; font-size: 22px; font-weight: bold; color: white;">
                    <?php echo $dataMan['Name']; ?>
                </label>
                <?php
                ?>
            </div>
            <a href="./index.php">
                <div class="player">
                    <h1>
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </h1>
                </div>
            </a>

        </div>
    </div>


</body>

</html>