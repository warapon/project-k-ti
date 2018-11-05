<div class="card">
    <div class="card-header bg-warning text-white"><h5><i class="fa fa-user-circle-o" aria-hidden="true"></i>
            แก้ไขรูปโปรไฟล์</h5></div>
    <div class="card-body">
        <form method="post" action="config/update.php" enctype="multipart/form-data">
            <div class="form-group">
                <img id="output" class="rounded-circle" width="200px"/>
                <input type="file" accept="image/*" name="fileupload" onchange="loadFile(event)" required>
            </div>
            <div class="form-group text-center">
                <button type="submit" name="editprofile" value="1" class="btn btn-success"><i class="fa fa-check-circle-o" aria-hidden="true"></i>
                    ยืนยัน
                </button>
                <a href="?page=setting"> <button type="button" class="btn btn-danger"><i class="fa fa-times-circle-o" aria-hidden="true"></i>
                    ยกเลิก
                </button></a>
            </div>
        </form>
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