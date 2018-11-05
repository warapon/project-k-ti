<?php
if (!empty($_SESSION["level"]) AND $_SESSION["level"] == 4) {
    ?>
    <div class="card">
        <div class="card-header bg-primary text-white"><h4>เพิ่มชนิดผลไม้</h4></div>
        <div class="card-body">
            <form method="post" action="config/insert.php" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>ชื่อ</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>รูปภาพ</label>
                            <img id="output" class="rounded" width="200px"/>
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
                        <button type="submit" name="addtypefruit" value="1" class="btn btn-success"><i
                                class="fa fa-download" aria-hidden="true"></i> ยืนยัน
                        </button>
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