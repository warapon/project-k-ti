<?php
if (!empty($_GET["status"]) AND $_GET["status"] == "success") {
    ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>สำเร็จ!</strong> การดำเนินการเสร็จสิ้น กรุณาตรวจสอบ PASSWORD ใน Email ของท่าน
    </div>
    <?php
} elseif (!empty($_GET["status"]) AND $_GET["status"] == "fail") {
    ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>ผิดพลาด!</strong> กรุณาติดต่อเจ้าหน้าที่ หรือ ผู้ที่มีส่วนเกี่ยวข้อง
    </div>
    <?php
}elseif (!empty($_GET["status"]) AND $_GET["status"] == "loginfail") {
    ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>ผิดพลาด!</strong> อีเมล์ หรือ รหัสผ่าน ไม่ถูกต้องกรุณาตรวจสอบอีกครัง
    </div>
    <?php
}
?>
<div class="card">
    <div class="card-header bg-primary text-white"><h4>กรุณาล็อกอิน</h4></div>
    <div class="card-body">
        <form method="post" action="config/select.php">
            <div class="form-group">
                <label for="email">อีเมล์:</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="pwd">รหัสผ่าน:</label>
                <input type="password" class="form-control" name="pass" id="pwd" required>
            </div>
            <div class="form-group form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" checked> Remember me
                </label>
            </div>
            <div class="text-center">
                <button type="submit" name="name_type" value="login" class="btn btn-success"><i class="fa fa-sign-in" aria-hidden="true"></i>
                    เข้าสู่ระบบ
                </button>
            </div>
        </form>
    </div>
</div>