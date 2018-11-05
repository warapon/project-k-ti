<?php
require_once("config/connect.php");
if (empty($_POST["search"]) AND empty($_GET["fruit"]) AND empty($_POST["area"])) {
    echo "<script>window.location.href='index.php';</script>";
} else if (!empty($_POST["search"])) {
    ?>
    <div class="card">
        <div class="card-body">
            <h5><p class="text-center">ผลการค้น : <?= $_POST["search"] ?></p></h5>
            <div class="row">
                <?php
                $sql = sprintf("SELECT * FROM garden INNER JOIN fruittype ON garden.fruittype_ft_id = fruittype.ft_id 
                    INNER JOIN producers ON garden.producers_pd_id = producers.pd_id 
                    WHERE fruittype.ft_nametype LIKE '%s%s' AND garden.gd_status = 1;", $_POST["search"], "%");
                $con = new db();
                $con = $con->selects($sql);
                if (mysql_num_rows($con) == 0) {
                    echo "<div class='col-12'>";
                    echo "<div class='text-danger text-center'>ไม่พบข้อมูลที่ต้องการค้นหา</div>";
                    echo "</div>";
                } else {
                    while ($row = mysql_fetch_assoc($con)) {
                        ?>
                        <div class="col-6 col-md-3">
                            <a href="?page=detail&id=<?= $row["gd_id"] ?>">
                                <div class="card">
                                    <img class="card-img-top" src="img/garden/<?= $row["gd_img"] ?>" alt="Card image">
                                    <div class="card-body">
                                        <h6 class="card-title text-truncate"><i class="fa fa-star"
                                                                                aria-hidden="true"></i> <?= $row["gd_name"] ?>
                                        </h6>
                                        <div class="text-truncate"><i class="fa fa-map-marker"
                                                                      aria-hidden="true"></i> <?= $row["pd_province"] ?>
                                        </div>
                                        <div class="text-truncate"><i class="fa fa-map-marker"
                                                                      aria-hidden="true"></i> <?= $row["pd_city"] ?>
                                        </div>
                                        <div class="text-truncate"><i class="fa fa-map-marker"
                                                                      aria-hidden="true"></i> <?= $row["pd_district"] ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <?php
} else if (!empty($_GET["fruit"])) {
    ?>
    <div class="card">
        <div class="card-body">
            <h5><p class="text-center">ผลการค้น จากประเภท</p></h5>
            <div class="row">
                <?php
                $sql = sprintf("SELECT * FROM garden INNER JOIN fruittype ON garden.fruittype_ft_id = fruittype.ft_id 
                    INNER JOIN producers ON garden.producers_pd_id = producers.pd_id 
                    WHERE fruittype.ft_id = %s AND garden.gd_status = 1;", $_GET["fruit"]);
                $con = new db();
                $con = $con->selects($sql);
                if (mysql_num_rows($con) == 0) {
                    echo "<div class='col-12'>";
                    echo "<div class='text-danger text-center'>ไม่พบข้อมูลที่ต้องการค้นหา</div>";
                    echo "</div>";
                } else {
                    while ($row = mysql_fetch_assoc($con)) {
                        ?>
                        <div class="col-6 col-md-3">
                            <a href="?page=detail&id=<?= $row["gd_id"] ?>">
                                <div class="card">
                                    <img class="card-img-top" src="img/garden/<?= $row["gd_img"] ?>" alt="Card image">
                                    <div class="card-body">
                                        <h6 class="card-title text-truncate"><i class="fa fa-star"
                                                                                aria-hidden="true"></i> <?= $row["gd_name"] ?>
                                        </h6>
                                        <div class="text-truncate"><i class="fa fa-map-marker"
                                                                      aria-hidden="true"></i> <?= $row["pd_province"] ?>
                                        </div>
                                        <div class="text-truncate"><i class="fa fa-map-marker"
                                                                      aria-hidden="true"></i> <?= $row["pd_city"] ?>
                                        </div>
                                        <div class="text-truncate"><i class="fa fa-map-marker"
                                                                      aria-hidden="true"></i> <?= $row["pd_district"] ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <?php
} else if (!empty($_POST["area"])) {
    ?>
    <div class="card">
        <div class="card-body">
            <h5><p class="text-center">ผลการค้น จากพื้นที่</p></h5>
            <div class="row">
                <?php
                if (!empty($_POST["city"]) AND !empty($_POST["district"]) AND !empty($_POST["type"])) {
                    $sql = sprintf("SELECT AMPHUR_NAME FROM amphur WHERE AMPHUR_ID = %s", $_POST["city"]);
                    $con = new db();
                    $con = $con->selects($sql);
                    $row = mysql_fetch_assoc($con);
                    $city = $row["AMPHUR_NAME"];

                    $sql = sprintf("SELECT DISTRICT_NAME FROM district WHERE DISTRICT_CODE = '%s'", $_POST["district"]);
                    $con = new db();
                    $con = $con->selects($sql);
                    $row = mysql_fetch_assoc($con);
                    $district = $row["DISTRICT_NAME"];


                    $sql = sprintf("SELECT * FROM garden INNER JOIN fruittype ON garden.fruittype_ft_id = fruittype.ft_id 
                    INNER JOIN producers ON garden.producers_pd_id = producers.pd_id 
                    WHERE producers.pd_city = '%s' AND producers.pd_district = '%s' 
                    AND garden.fruittype_ft_id = %s ;", $city, $district, $_POST["type"]);

                } elseif (!empty($_POST["city"]) AND !empty($_POST["district"]) AND empty($_POST["type"])) {
                    $sql = sprintf("SELECT AMPHUR_NAME FROM amphur WHERE AMPHUR_ID = %s", $_POST["city"]);
                    $con = new db();
                    $con = $con->selects($sql);
                    $row = mysql_fetch_assoc($con);
                    $city = $row["AMPHUR_NAME"];

                    $sql = sprintf("SELECT DISTRICT_NAME FROM district WHERE DISTRICT_CODE = '%s'", $_POST["district"]);
                    $con = new db();
                    $con = $con->selects($sql);
                    $row = mysql_fetch_assoc($con);
                    $district = $row["DISTRICT_NAME"];


                    $sql = sprintf("SELECT * FROM garden INNER JOIN fruittype ON garden.fruittype_ft_id = fruittype.ft_id 
                    INNER JOIN producers ON garden.producers_pd_id = producers.pd_id 
                    WHERE producers.pd_city = '%s' AND producers.pd_district = '%s' ;", $city, $district);
                }elseif (!empty($_POST["city"]) AND empty($_POST["district"]) AND !empty($_POST["type"])) {
                    $sql = sprintf("SELECT AMPHUR_NAME FROM amphur WHERE AMPHUR_ID = %s", $_POST["city"]);
                    $con = new db();
                    $con = $con->selects($sql);
                    $row = mysql_fetch_assoc($con);
                    $city = $row["AMPHUR_NAME"];


                    $sql = sprintf("SELECT * FROM garden INNER JOIN fruittype ON garden.fruittype_ft_id = fruittype.ft_id 
                    INNER JOIN producers ON garden.producers_pd_id = producers.pd_id 
                    WHERE producers.pd_city = '%s' AND garden.fruittype_ft_id = %s ;", $city, $_POST["type"]);
                }elseif (!empty($_POST["city"]) AND empty($_POST["district"]) AND empty($_POST["type"])) {
                    $sql = sprintf("SELECT AMPHUR_NAME FROM amphur WHERE AMPHUR_ID = %s", $_POST["city"]);
                    $con = new db();
                    $con = $con->selects($sql);
                    $row = mysql_fetch_assoc($con);
                    $city = $row["AMPHUR_NAME"];


                    $sql = sprintf("SELECT * FROM garden INNER JOIN fruittype ON garden.fruittype_ft_id = fruittype.ft_id 
                    INNER JOIN producers ON garden.producers_pd_id = producers.pd_id 
                    WHERE producers.pd_city = '%s';", $city);
                } elseif (empty($_POST["city"]) AND empty($_POST["district"]) AND !empty($_POST["type"])) {
                    $sql = sprintf("SELECT * FROM garden INNER JOIN fruittype ON garden.fruittype_ft_id = fruittype.ft_id 
                    INNER JOIN producers ON garden.producers_pd_id = producers.pd_id 
                    WHERE garden.fruittype_ft_id = %s ;", $_POST["type"]);
                } elseif (empty($_POST["city"]) AND empty($_POST["district"]) AND empty($_POST["type"])) {
                    $sql = sprintf("SELECT * FROM garden INNER JOIN fruittype ON garden.fruittype_ft_id = fruittype.ft_id 
                    INNER JOIN producers ON garden.producers_pd_id = producers.pd_id;");
                }
                $con = new db();
                $con = $con->selects($sql);
                if (mysql_num_rows($con) == 0) {
                    echo "<div class='col-12'>";
                    echo "<div class='text-danger text-center'>ไม่พบข้อมูลที่ต้องการค้นหา</div>";
                    echo "</div>";
                } else {
                    while ($row = mysql_fetch_assoc($con)) {
                        ?>
                        <div class="col-6 col-md-3">
                            <a href="?page=detail&id=<?= $row["gd_id"] ?>">
                                <div class="card">
                                    <img class="card-img-top" src="img/garden/<?= $row["gd_img"] ?>" alt="Card image">
                                    <div class="card-body">
                                        <h6 class="card-title text-truncate"><i class="fa fa-star"
                                                                                aria-hidden="true"></i> <?= $row["gd_name"] ?>
                                        </h6>
                                        <div class="text-truncate"><i class="fa fa-map-marker"
                                                                      aria-hidden="true"></i> <?= $row["pd_province"] ?>
                                        </div>
                                        <div class="text-truncate"><i class="fa fa-map-marker"
                                                                      aria-hidden="true"></i> <?= $row["pd_city"] ?>
                                        </div>
                                        <div class="text-truncate"><i class="fa fa-map-marker"
                                                                      aria-hidden="true"></i> <?= $row["pd_district"] ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}
?>