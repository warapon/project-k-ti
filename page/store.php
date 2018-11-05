<?php
if (!empty($_GET["id"])) {
    $sql = sprintf("SELECT * FROM producers WHERE pd_id=%s;", $_GET["id"]);
    $con = new db();
    $con = $con->selects($sql);
    $row = mysql_fetch_assoc($con);

    $sql_pt = sprintf("SELECT * FROM position WHERE pt_pd_id=%s;", $_GET["id"]);
    $con_pt = new db();
    $con_pt = $con_pt->selects($sql_pt);
    $row_pt = mysql_fetch_assoc($con_pt);
} elseif (!empty($_SESSION["level"]) AND $_SESSION["level"] == 2) {
    $sql = sprintf("SELECT * FROM producers WHERE pd_id=%s;", $_SESSION["user_id_system"]);
    $con = new db();
    $con = $con->selects($sql);
    $row = mysql_fetch_assoc($con);

    $sql_pt = sprintf("SELECT * FROM position WHERE pt_pd_id=%s;", $_SESSION["user_id_system"]);
    $con_pt = new db();
    $con_pt = $con_pt->selects($sql_pt);
    $row_pt = mysql_fetch_assoc($con_pt);
}

?>


<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4 text-center">
                <?php
                if (!empty($row["pd_image"])) {
                    ?>
                    <img src="img/profix/<?= $row["pd_image"] ?>" width="200px" class="rounded-circle"/>
                    <?php
                } else {
                    ?>
                    <img src="//placehold.it/200" width="200px" class="rounded-circle"/>
                    <?php
                }
                ?>
            </div>

            <div class="col-sm-8">
                <h5><p class="text-center">คุณ <?= $row["pd_name"] ?>  <?= $row["pd_lastname"] ?></p></h5>
                <h6><p><i class="fa fa-phone-square" aria-hidden="true"></i> เบอร์โทร: <a
                                href="tel:<?= $row["pd_tel"] ?>"> <?= $row["pd_tel"] ?></a></p></h6>
                <h6><p><i class="fa fa-envelope-o" aria-hidden="true"></i> อีเมล์: <?= $row["pd_email"] ?></p></h6>
                <h6><p><i class="fa fa-facebook-square" aria-hidden="true"></i> Factbook: <?= $row["pd_facebook"] ?></p>
                </h6>
                <h6><p>Line: <a href="http://line.me/R/ti/p/~<?= $row["pd_line"] ?>"><?= $row["pd_line"] ?></a></p></h6>
                <?php
                if (mysql_num_rows($con_pt) > 0) {
                    ?>
                    <p>
                        <a href="https://www.google.com/maps/search/?api=1&query=<?= $row_pt["pt_lat"] ?>,<?= $row_pt["pt_long"] ?>">
                            <button type="button" class="btn btn-success"><i class="fa fa-location-arrow"
                                                                             aria-hidden="true"></i> นำทาง
                            </button>
                        </a>
                    </p>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
$sql = sprintf("SELECT * FROM garden INNER JOIN fruittype ON garden.fruittype_ft_id = fruittype.ft_id 
                    INNER JOIN producers ON garden.producers_pd_id = producers.pd_id 
                    WHERE garden.producers_pd_id = %s;", $row["pd_id"]);

$con = new db();
$con = $con->selects($sql);
?>
<br>
<div class="card">
    <div class="card-header bg-primary text-white"><i class="fa fa-address-card-o" aria-hidden="true"></i> สวน/ไร่</div>
    <div class="card-body">
        <div class="row">
            <?php
            if (mysql_num_rows($con) == 0) {
                echo "<div class='col-sm-12'>";
                echo "<div class='text-center text-danger'> ไม่มีผลไม้ในร้าน </div>";
                echo "</div>";
            } else {
                while ($row = mysql_fetch_assoc($con)) {
                    ?>
                    <div class="col-sm-3">
                        <center>
                            <a href="?page=detail&id=<?= $row["gd_id"] ?>">
                                <div class="card" style="width:200px">
                                    <?php
                                    if (empty($row["gd_img"])) {
                                        ?>
                                        <img class="card-img-top" src="//placehold.it/200"
                                             alt="Card image">
                                        <?php
                                    } else {
                                        ?>
                                        <img class="card-img-top" src="img/garden/<?= $row["gd_img"] ?>"
                                             alt="Card image">
                                        <?php
                                    }
                                    ?>
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><?= $row["ft_nametype"] ?></h5>
                                        <p class="card-text"><?= $row["gd_name"] ?></p>
                                    </div>
                                </div>
                            </a>
                        </center>
                        <br>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>