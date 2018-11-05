<?php
if (!empty($_SESSION["level"]) AND $_SESSION["level"] == 4) {
    $sql = sprintf("SELECT * FROM `fruittype` WHERE ft_id=%s ", $_GET["idfruit"]);

    $con = new db();
    $con = $con->selects($sql);
    $row = mysql_fetch_assoc($con)
    ?>
    <div class="card">
        <div class="card-header bg-primary text-white"><h4>แก้ไขชนิดผลไม้</h4></div>
        <div class="card-body">
            <form method="post" action="config/update.php" enctype="multipart/form-data">
                <input type="hidden" name="ft_id" value="<?=$_GET["idfruit"]?>">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>ชื่อ</label>
                            <input type="text" name="name" value="<?= $row["ft_nametype"] ?>" class="form-control"
                                   required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>รูปภาพ</label>
                            <img id="output" src="img/type/<?= $row["ft_image"] ?>" class="rounded" width="200px"/>
                            <input type="file" accept="image/*" name="fileupload" onchange="loadFile(event)" required>
                            <script>
                                var loadFile = function (event) {
                                    var reader = new FileReader();
                                    reader.onload = function () {
                                        var output = document.getElementById('output');
                                        output.src = reader.result;
                                    };
                                    reader.readAsDataURL(event.target.files[0]);
                                };
                            </script>
                        </div>
                    </div>
                    <div class="col-sm-12 text-center">
                        <button type="submit" name="edittypefruit" value="1" class="btn btn-success"><i
                                    class="fa fa-download" aria-hidden="true"></i> ยืนยัน
                        </button>
                        <a href="?page=typefruit">
                            <button type="button" class="btn btn-danger"><i class="fa fa-times-circle"
                                                                            aria-hidden="true"></i> ยกเลิก
                            </button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
} else {
    echo "<script>window.location.href='index.php';</script>";
}
?>