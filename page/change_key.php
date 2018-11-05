<?php
if (!empty($_SESSION["level"])) {
    ?>
    <div class="card">
        <div class="card-header bg-primary text-white"><h4><i class="fa fa-key" aria-hidden="true"></i>
                เปลี่ยนรหัสผ่านใหม่</h4></div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <form name="form1" method="POST" action="config/update.php" OnSubmit="return fncSubmit();">
                        <div>
                            <div class="form-group">
                                <label>รหัสผ่านใหม่</label>
                                <input type="password" name="newpass" id="txtPassword" placeholder="Password"
                                       class="form-control" required><br>
                                <label>รหัสผ่านใหม่อีกครั้ง</label>
                                <input type="password" name="config" id="txtConPassword" placeholder="Password"
                                       class="form-control" required><br>
                                <label class="col-form-label text-danger" id="Show2" for="inputDefault"></label>
                            </div>
                            <center>
                                <button type="submit" name="chage_key" value="1" class="btn btn-danger btn-sm"><i class="fa fa-check-square-o"
                                                                                       aria-hidden="true"></i>
                                    ส่งข้อมูล
                                </button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script language="javascript">
        function fncSubmit()
        {
            if(document.form1.txtPassword.value != document.form1.txtConPassword.value)
            {
                //                            alert('รหัสผ่านใหม่ขท่านไม่ตรงกัน กรุณาตรวจสอบใหม่อีกครั้ง');
                document.getElementById('Show2').innerHTML = 'รหัสผ่านใหม่ของท่านไม่ตรงกัน กรุณาตรวจสอบใหม่อีกครั้ง';
                document.form1.txtConPassword.focus();
                return false;
            }
            document.form1.submit();
        }
    </script>
    <?php
}else{
    echo "<script>window.location.href='?page=login';</script>";
}
?>