<?php

if (!empty($_SESSION["level"]) AND $_SESSION["level"] == 1) {
    $sql = sprintf("SELECT * FROM buyers WHERE by_id=%s;", $_SESSION["user_id_system"]);
    $con = new db();
    $con = $con->selects($sql);
    $row = mysql_fetch_assoc($con);
    ?>
    <div class="card">
        <div class="card-header bg-primary text-white"><h4><i class="fa fa-address-card-o" aria-hidden="true"></i>
                แก้ไขข้อมูลผู้ซื้อสินค้า</h4></div>
        <div class="card-body">
            <form method="post" action="config/update.php">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>คำนำหน้า</label>
                            <select class="form-control" name="prefix" id="sel1" required>
                                <option value="<?= $row["by_prefix"] ?>"><?= $row["by_prefix"] ?></option>
                                <option value="นาย">นาย</option>
                                <option value="นาง">นาง</option>
                                <option value="นางสาว">นางสาว</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>ชื่อ</label>
                            <input type="text" name="name" class="form-control" value="<?= $row["by_name"] ?>" required>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>นามสกุล</label>
                            <input type="text" name="lastname" class="form-control" value="<?= $row["by_lastname"] ?>"
                                   required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>เลขบัตรประชาชน</label>
                            <input type="number" name="card_number" class="form-control"
                                   value="<?= $row["by_card_number"] ?>" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>บริษัท</label>
                            <input type="text" name="company" class="form-control" value="<?= $row["by_company"] ?>"
                                   required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>ที่อยู่เลขที่</label>
                            <input type="text" name="addass_number" class="form-control"
                                   value="<?= $row["by_addass_number"] ?>" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>หมู่</label>
                            <input type="text" name="m" class="form-control" value="<?= $row["by_m"] ?>" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>จังหวัด</label>
                            <select class="form-control" name="province" id="province" required>
                                <option value="<?= $row["pd_province"] ?>"><?= $row["pd_province"] ?></option>
                                <option id="province_list"></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>อำเภอ</label>
                            <select class="form-control" name="citty" id="amphur" required>
                                <option value="<?= $row["pd_city"] ?>"><?= $row["pd_city"] ?></option>
                                <option id="amphur_list"></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>ตำบล</label>
                            <select class="form-control" name="district" id="district" required>
                                <option value="<?= $row["pd_district"] ?>"><?= $row["pd_district"] ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>เบอร์โทรศัพท์</label>
                            <input type="tel" name="tel" class="form-control" value="<?= $row["by_tel"] ?>" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>อีเมล์</label>
                            <input type="email" name="email" class="form-control" value="<?= $row["by_email"] ?>"
                                   disabled>
                        </div>
                    </div>
                    <div class="col-sm-12 text-center">
                        <button type="submit" name="chang_data" value="1001" class="btn btn-success"><i
                                    class="fa fa-download" aria-hidden="true"></i> แก้ไขข้อมูล
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
} elseif (!empty($_SESSION["level"]) AND ($_SESSION["level"] == 2 OR $_SESSION["level"] == 3)) {
    $sql = sprintf("SELECT * FROM producers WHERE pd_id=%s;", $_SESSION["user_id_system"]);
    $con = new db();
    $con = $con->selects($sql);
    $row = mysql_fetch_assoc($con);
    ?>
    <div class="card">
        <div class="card-header bg-primary text-white"><h4><i class="fa fa-address-card-o" aria-hidden="true"></i>
                แก้ไขข้อมูลผู้ผลิต</h4></div>
        <div class="card-body">
            <form method="post" action="config/update.php">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>คำนำหน้า</label>
                            <select class="form-control" name="prefix" id="sel1" required>
                                <option value="<?= $row["pd_prefix"] ?>"><?= $row["pd_prefix"] ?></option>
                                <option value="นาย">นาย</option>
                                <option value="นาง">นาง</option>
                                <option value="นางสาว">นางสาว</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>ชื่อ</label>
                            <input type="text" name="name" class="form-control" value="<?= $row["pd_name"] ?>" required>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>นามสกุล</label>
                            <input type="text" name="lastname" class="form-control" value="<?= $row["pd_lastname"] ?>"
                                   required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>วัน-เดือน-ปีเกิด</label>
                            <input type="date" name="birthday" class="form-control" value="<?= $row["pd_birthday"] ?>"
                                   required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>เลขบัตรประชาชน</label>
                            <input type="number" name="card_number" class="form-control"
                                   value="<?= $row["pd_card_number"] ?>" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>ที่อยู่เลขที่</label>
                            <input type="text" name="house_number" class="form-control"
                                   value="<?= $row["pd_house_number"] ?>" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>หมู่</label>
                            <input type="text" name="mu" class="form-control" value="<?= $row["pd_mu"] ?>" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>จังหวัด</label>
                            <select class="form-control" name="province" id="province" required>
                                <option value="<?= $row["pd_province"] ?>"><?= $row["pd_province"] ?></option>
                                <option id="province_list"></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>อำเภอ</label>
                            <select class="form-control" name="city" id="amphur" required>
                                <option value="<?= $row["pd_city"] ?>"><?= $row["pd_city"] ?></option>
                                <option id="amphur_list"></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>ตำบล</label>
                            <select class="form-control" name="district" id="district" required>
                                <option value="<?= $row["pd_district"] ?>"><?= $row["pd_district"] ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>เบอร์โทรศัพท์</label>
                            <input type="tel" name="tel" class="form-control" value="<?= $row["pd_tel"] ?>" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>อีเมล์</label>
                            <input type="email" name="email" class="form-control" value="<?= $row["pd_email"] ?>"
                                   disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Facebook</label>
                            <input type="text" name="facebook" class="form-control" value="<?= $row["pd_facebook"] ?>"
                                   required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Line</label>
                            <input type="text" name="line" class="form-control" value="<?= $row["pd_line"] ?>" required>
                        </div>
                    </div>
                    <div class="col-sm-12 text-center">
                        <button type="submit" name="chang_data" value="1002" class="btn btn-success"><i
                                    class="fa fa-download" aria-hidden="true"></i> แก้ไขข้อมูล
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
} else {
    echo "<script>window.location.href='?page=login';</script>";
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
<script>

    $(function () {

        //เรียกใช้งาน Select2
        $(".select2-single").select2();

        //ดึงข้อมูล province จากไฟล์ get_data.php
        $.ajax({
            url: "get_data.php",
            dataType: "json", //กำหนดให้มีรูปแบบเป็น Json
            data: {show_province: 'show_province'}, //ส่งค่าตัวแปร show_province เพื่อดึงข้อมูล จังหวัด
            success: function (data) {

                //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data
                $.each(data, function (index, value) {
                    //แทรก Elements ใน id province  ด้วยคำสั่ง append
                    $("#province").append("<option value='" + value.id + "'> " + value.name + "</option>");
                });
            }
        });


        //แสดงข้อมูล อำเภอ  โดยใช้คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่ #province
        $("#province").change(function () {

            //กำหนดให้ ตัวแปร province มีค่าเท่ากับ ค่าของ #province ที่กำลังถูกเลือกในขณะนั้น
            var province_id = $(this).val();

            $.ajax({
                url: "get_data.php",
                dataType: "json",//กำหนดให้มีรูปแบบเป็น Json
                data: {province_id: province_id},//ส่งค่าตัวแปร province_id เพื่อดึงข้อมูล อำเภอ ที่มี province_id เท่ากับค่าที่ส่งไป
                success: function (data) {

                    //กำหนดให้ข้อมูลใน #amphur เป็นค่าว่าง
                    $("#amphur").text("");

                    //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data
                    $.each(data, function (index, value) {

                        //แทรก Elements ข้อมูลที่ได้  ใน id amphur  ด้วยคำสั่ง append
                        $("#amphur").append("<option value='" + value.id + "'> " + value.name + "</option>");
                    });
                }
            });

        });

        //แสดงข้อมูลตำบล โดยใช้คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่  #amphur
        $("#amphur").change(function () {

            //กำหนดให้ ตัวแปร amphur_id มีค่าเท่ากับ ค่าของ  #amphur ที่กำลังถูกเลือกในขณะนั้น
            var amphur_id = $(this).val();

            $.ajax({
                url: "get_data.php",
                dataType: "json",//กำหนดให้มีรูปแบบเป็น Json
                data: {amphur_id: amphur_id},//ส่งค่าตัวแปร amphur_id เพื่อดึงข้อมูล ตำบล ที่มี amphur_id เท่ากับค่าที่ส่งไป
                success: function (data) {

                    //กำหนดให้ข้อมูลใน #district เป็นค่าว่าง
                    $("#district").text("");

                    //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data
                    $.each(data, function (index, value) {

                        //แทรก Elements ข้อมูลที่ได้  ใน id district  ด้วยคำสั่ง append
                        $("#district").append("<option value='" + value.id + "'> " + value.name + "</option>");

                    });
                }
            });

        });

        //คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่  #district
        $("#district").change(function () {

            //นำข้อมูลรายการ จังหวัด ที่เลือก มาใส่ไว้ในตัวแปร province
            var province = $("#province option:selected").text();

            //นำข้อมูลรายการ อำเภอ ที่เลือก มาใส่ไว้ในตัวแปร amphur
            var amphur = $("#amphur option:selected").text();

            //นำข้อมูลรายการ ตำบล ที่เลือก มาใส่ไว้ในตัวแปร district
            var district = $("#district option:selected").text();

            //ใช้คำสั่ง alert แสดงข้อมูลที่ได้
            alert("คุณได้เลือก :  จังหวัด : " + province + " อำเภอ : " + amphur + "  ตำบล : " + district);

        });


    });

</script>
