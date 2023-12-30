<?php
$con = new mysqli('localhost', 'root', '', 'football_academy');
include "main.php";
session_start();
?>
<style>
    td{
        text-align: center;
    }
</style>
<html>
<div class="container" id="disNone">
    <form action="./IUD/insert.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xl-12 mt-4">
                <h1 style="text-align: center;">Players</h1>
            </div>
            <?php
            if (isset($_SESSION['msg-save'])) {
                ?>
                <div class="alert alert-success">
                    <?php
                    echo $_SESSION['msg-save'];
                    session_destroy();
                    ?>
                </div>
                <?php
            } else if (isset($_SESSION['msg-alert'])) {
                ?>
                    <div class="alert alert-danger">
                        <?php
                        echo $_SESSION['msg-alert'];
                        session_destroy();
                        ?>
                    </div>
                <?php
            }
            ?>
            <div class="col-xl-2 mt-3">
                <label for="">PlayerID</label>
                <input type="text" name="playerID" class="form-control">
            </div>
            <div class="col-xl-4 mt-3">
                <label for="">PlayerName</label>
                <input type="text" name="playerName" class="form-control">
            </div>
            <div class="col-xl-2 mt-3">
                <label for="">Gender</label>
                <select name="gender" id="" class="form-control">
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
            </div>
            <div class="col-xl-4 mt-3">
                <label for="">Date Of Birth</label>
                <input type="date" name="dob" class="form-control">
            </div>
            <div class="col-xl-4 mt-3">
                <label for="">Nationality</label>
                <select name="nationality" id="" class="form-control">
                    <option value="Khmer">Khmer</option>
                </select>
            </div>
            <div class="col-xl-4 mt-3">
                <label for="">Number</label>
                <input type="text" name="number" class="form-control">
            </div>
            <div class="col-xl-4 mt-3">
                <label for="">Position</label>
                <select name="position" id="" class="form-control">
                    <?php
                    $sqlPos = "SELECT * from tbl_postion";
                    $exePos = $con->query($sqlPos);
                    while ($dataPos = $exePos->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $dataPos['PosCode']; ?>">
                            <?php echo $dataPos['EngPosition']; ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-xl-4 mt-3">
                <label for="">Image</label>
                <input type="file" id="photo" name="uploadImg" class="form-control">
            </div>
            <div class="col-xl-12 mt-3">
                <img src="https://w7.pngwing.com/pngs/175/613/png-transparent-video-cameras-logo-graphy-camera-text-camera-lens-rectangle.png"
                    id="preViewIMG" alt="" style="width: 300px; height: 250px; object-fit:cover;">
            </div>
            <div class="col-xl-12 mt-3">
                <input type="submit" value="Save" name="btnSave" class="btn btn-success">
            </div>
        </div>
    </form>
    <div class="container-fluid mt-4">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Date Of Birth</th>
                    <th>Nationality</th>
                    <th>Number</th>
                    <th>Position</th>
                    <th>Profile</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sqlSel = "SELECT
                    P1.ID,
                    P1.Name,
                    P1.Gender,
                    P1.DOB,
                    P1.Nationality,
                    P1.Number,
                    P2.EngPosition As Position,
                    P1.Profile
                    FROM tbl_player P1
                    INNER JOIN tbl_postion P2 ON P1.Position = P2.PosCode";
                $exeSel = $con->query($sqlSel);
                while ($dataSel = $exeSel->fetch_assoc()) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $dataSel['ID']; ?>
                        </td>
                        <td>
                            <?php echo $dataSel['Name']; ?>
                        </td>
                        <td>
                            <?php echo $dataSel['Gender']; ?>
                        </td>
                        <td>
                            <?php echo $dataSel['DOB']; ?>
                        </td>
                        <td>
                            <?php echo $dataSel['Nationality']; ?>
                        </td>
                        <td>
                            <?php echo $dataSel['Number']; ?>
                        </td>
                        <td>
                            <?php echo $dataSel['Position']; ?>
                        </td>
                        <td>
                            <img src="./img/<?php echo $dataSel['Profile']; ?>" alt="" style="width: 2.5rem; height: 2.5rem; border-radius: 50%;">
                        </td>
                        <td>
                            <a href="./IUD/update.php" class="btn btn-success" id="btnUpdate">Update</a>
                            <a href="./IUD/delete.php" class="btn btn-danger" id="btnDelete">Delete</a>
                            <a href="detail.php" class="btn btn-primary" id="btnDetail">Details</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</html>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
    new DataTable('#example');
    const file = document.getElementById('photo');
    const imgPreview = document.getElementById('preViewIMG');

    file.addEventListener("change", function () {
        var srcfile = this.files[0];
        var reader = new FileReader();
        reader.addEventListener('load', function () {
            imgPreview.src = reader.result;
        })

        reader.readAsDataURL(srcfile);
    })

    const disNone = document.getElementById('disNone');
    const alerts = document.getElementsByClassName('alert');
    disNone.addEventListener('click', () => {
        for (alert of alerts) {
            alert.style.display = "none";
        }
    })
</script>