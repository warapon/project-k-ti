<?php
if (!empty($_GET["id"])) {
    $sql = sprintf("SELECT * FROM garden INNER JOIN fruittype ON garden.fruittype_ft_id = fruittype.ft_id 
                    INNER JOIN producers ON garden.producers_pd_id = producers.pd_id 
                    WHERE garden.gd_id = %s AND garden.gd_status = 1;", $_GET["id"]);

    $con = new db();
    $con = $con->selects($sql);
    $row = mysql_fetch_assoc($con);
    ?>
    <br>
    <div class="card">
        <div class="card-body">
            <h5><p class="text-center">ชื่อไร่/สวน: <?= $row["gd_name"] ?></p></h5>
            <div class="row">
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header bg-primary text-white text-center">
                                    <h5><?= $row["ft_nametype"] ?></h5></div>
                                <div class="card-body">
                                    <div id="demo" class="carousel slide" data-ride="carousel">
                                        <?php
                                        $sql_img = sprintf("SELECT * FROM imggarden WHERE garden_gd_id = %s;", $_GET["id"]);

                                        $con_img = new db();
                                        $con_img = $con_img->selects($sql_img);
                                        $num = mysql_num_rows($con_img);
                                        $i = 0;
                                        while ($row_img = mysql_fetch_assoc($con_img)) {
                                            $img_slide[$i] = $row_img["img_gd_name"];
                                            $i++;
                                        }
                                        ?>
                                        <!-- Indicators -->
                                        <ul class="carousel-indicators">
                                            <?php
                                            for ($y = 0; $y < $num; $y++) {
                                                if ($y == 0) {
                                                    echo "<li data-target='#demo' data-slide-to='" . $y . "' class='active'></li>";
                                                } else {
                                                    echo "<li data-target='#demo' data-slide-to='" . $y . "' ></li>";
                                                }
                                            }
                                            ?>
                                        </ul>

                                        <!-- The slideshow -->
                                        <div class="carousel-inner text-center">
                                            <?php
                                            for ($x = 0; $x < $num; $x++) {
                                                if ($x == 0) {
                                                    echo "<div class='carousel-item active'>";
                                                } else {
                                                    echo "<div class='carousel-item'>";
                                                }
                                                echo "<img src='img/orchard/" . $img_slide[$x] . "' class='img-thumbnail'>";
                                                echo "</div>";
                                            }
                                            ?>
                                        </div>

                                        <!-- Left and right controls -->
                                        <?php
                                        if ($num > 1) {
                                            ?>
                                            <a class="carousel-control-prev text-dark" href="#demo" data-slide="prev">
                                                <i class="fa fa-angle-left fa-4x" aria-hidden="true"></i>
                                            </a>
                                            <a class="carousel-control-next text-dark" href="#demo" data-slide="next">
                                                <i class="fa fa-angle-right fa-4x" aria-hidden="true"></i>
                                            </a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header bg-success text-white">รายละเอียด</div>
                                <div class="card-body">
                                    <p><?= $row["gd_detail"] ?></p>
                                    <p><strong>จำนวนพื้นที่: </strong><?= $row["gd_area_number"] ?> ไร่</p>
                                    <p><strong>กำลังผลิตต่อปี: </strong><?= $row["gd_productivity"] ?> ตัน</p>
                                </div>
                            </div>
                            <br>
                        </div>
                        <div class="col-sm-12 text-center">
                            <?php
                            if (!empty($_SESSION["level"])) {
                                ?>
                                <a href="?page=store&id=<?= $row["pd_id"] ?>" target="_blank">
                                    <button type="button" class="btn btn-warning"><i class="fa fa-external-link"
                                                                                     aria-hidden="true"></i>
                                        ติต่อ/สั่งซื้อ
                                    </button>
                                </a>
                                <?php
                            } else {
                                ?>
                                <button type="button" class="btn btn-warning"
                                        onclick="alert('กรุณาเข้าสู่ระบบ หรือ สมัครสมาชิกก่อน')"><i
                                            class="fa fa-external-link"
                                            aria-hidden="true"></i>
                                    ติต่อ/สั่งซื้อ
                                </button>
                                <?php
                            }
                            ?>
                        </div>
                        <br><br>
                    </div>
                </div>
                <?php
                $sql = sprintf("SELECT * FROM garden INNER JOIN fruittype ON garden.fruittype_ft_id = fruittype.ft_id 
                    INNER JOIN producers ON garden.producers_pd_id = producers.pd_id 
                    WHERE garden.producers_pd_id = %s LIMIT 0,6;", $row["pd_id"]);

                $con = new db();
                $con = $con->selects($sql);
                if (mysql_num_rows($con) == 0) {
                    echo "<center> ไม่มีผลไม้ในร้าน </center>";
                } else {
                    ?>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-header bg-secondary text-white text-center"><h5>ผลไม้ในร้าน/สวน</h5></div>
                            <div class="card-body">
                                <?php
                                while ($row = mysql_fetch_assoc($con)) {
                                    ?>
                                    <div class="card bg-light text-dark">
                                        <a href="?page=detail&id=<?= $row["gd_id"] ?>">
                                            <div class="card-body">
                                                <table>
                                                    <tr>
                                                        <td width="30%"><img src="img/garden/<?= $row["gd_img"] ?>"
                                                                             class="rounded" width="80%"></td>
                                                        <td><?= $row["ft_nametype"] ?></td>
                                                    </tr>

                                                </table>
                                            </div>
                                        </a>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php
} else {
    echo "<script>window.location.href='index.php';</script>";
}
?>
