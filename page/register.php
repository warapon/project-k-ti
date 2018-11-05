<?php
if (!empty($_GET["status"]) AND $_GET["status"] == "mail") {
    ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>ผิดพลาด!</strong> อีเมล์นี้ได้ใช้งานแล้ว กรุณาตรวจสอบอีกครั้ง
    </div>
    <?php
}
if (!empty($_GET["regist"]) AND $_GET["regist"] == 1001) {
    ?>
    <div class="card">
        <div class="card-header bg-primary text-white"><h4>ลงทะเบียนเพื่อซื้อสินค้า</h4></div>
        <div class="card-body">
            <form method="post" action="config/insert.php">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>คำนำหน้า</label>
                            <select class="form-control" name="prefix" id="sel1" required>
                                <option></option>
                                <option value="นาย">นาย</option>
                                <option value="นาง">นาง</option>
                                <option value="นางสาว">นางสาว</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>ชื่อ</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>นามสกุล</label>
                            <input type="text" name="lastname" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>เลขบัตรประชาชน</label>
                            <input type="number" name="card_number" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>บริษัท</label>
                            <input type="text" name="company" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>ที่อยู่เลขที่</label>
                            <input type="text" name="addass_number" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>หมู่</label>
                            <input type="text" name="m" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>จังหวัด</label>
                            <select class="form-control" name="province" id="province" required>
                                <option id="province_list"></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>อำเภอ</label>
                            <select class="form-control" name="citty" id="amphur" required>
                                <option id="amphur_list"></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>ตำบล</label>
                            <select class="form-control" name="district" id="district" required>
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>เบอร์โทรศัพท์</label>
                            <input type="tel" name="tel" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>อีเมล์</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-12 text-center">
                        <button type="submit" name="regiter" value="1001" class="btn btn-success"><i
                                    class="fa fa-download" aria-hidden="true"></i> ลงทะเบียน
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
} elseif (!empty($_GET["regist"]) AND $_GET["regist"] == 1002) {
    ?>
    <div class="card">
        <div class="card-header bg-primary text-white"><h4>ลงทะเบียนผู้ผลิต</h4></div>
        <div class="card-body">
            <form method="post" action="config/insert.php">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>คำนำหน้า</label>
                            <select class="form-control" name="prefix" id="sel1" required>
                                <option></option>
                                <option value="นาย">นาย</option>
                                <option value="นาง">นาง</option>
                                <option value="นางสาว">นางสาว</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>ชื่อ</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>นามสกุล</label>
                            <input type="text" name="lastname" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>วัน-เดือน-ปีเกิด</label>
                            <input type="date" name="birthday" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>เลขบัตรประชาชน</label>
                            <input type="number" name="card_number" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>ที่อยู่เลขที่</label>
                            <input type="text" name="house_number" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>หมู่</label>
                            <input type="text" name="mu" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>จังหวัด</label>
                            <select class="form-control" name="province" id="province" required>
                                <option id="province_list"></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>อำเภอ</label>
                            <select class="form-control" name="city" id="amphur" required>
                                <option id="amphur_list"></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>ตำบล</label>
                            <select class="form-control" name="district" id="district" required>
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>เบอร์โทรศัพท์</label>
                            <input type="tel" name="tel" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>อีเมล์</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Facebook</label>
                            <input type="text" name="facebook" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Line</label>
                            <input type="text" name="line" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-12 text-center">
                        <button type="submit" name="regiter" value="1002" class="btn btn-success"><i
                                    class="fa fa-download" aria-hidden="true"></i> ลงทะเบียน
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
    <script>

        $(function(){

            //เรียกใช้งาน Select2
            $(".select2-single").select2();

            //ดึงข้อมูล province จากไฟล์ get_data.php
            $.ajax({
                url:"get_data.php",
                dataType: "json", //กำหนดให้มีรูปแบบเป็น Json
                data:{show_province:'show_province'}, //ส่งค่าตัวแปร show_province เพื่อดึงข้อมูล จังหวัด
                success:function(data){

                    //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data
                    $.each(data, function( index, value ) {
                        //แทรก Elements ใน id province  ด้วยคำสั่ง append
                        $("#province").append("<option value='"+ value.id +"'> " + value.name + "</option>");
                    });
                }
            });


            //แสดงข้อมูล อำเภอ  โดยใช้คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่ #province
            $("#province").change(function(){

                //กำหนดให้ ตัวแปร province มีค่าเท่ากับ ค่าของ #province ที่กำลังถูกเลือกในขณะนั้น
                var province_id = $(this).val();

                $.ajax({
                    url:"get_data.php",
                    dataType: "json",//กำหนดให้มีรูปแบบเป็น Json
                    data:{province_id:province_id},//ส่งค่าตัวแปร province_id เพื่อดึงข้อมูล อำเภอ ที่มี province_id เท่ากับค่าที่ส่งไป
                    success:function(data){

                        //กำหนดให้ข้อมูลใน #amphur เป็นค่าว่าง
                        $("#amphur").text("");

                        //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data
                        $.each(data, function( index, value ) {

                            //แทรก Elements ข้อมูลที่ได้  ใน id amphur  ด้วยคำสั่ง append
                            $("#amphur").append("<option value='"+ value.id +"'> " + value.name + "</option>");
                        });
                    }
                });

            });

            //แสดงข้อมูลตำบล โดยใช้คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่  #amphur
            $("#amphur").change(function(){

                //กำหนดให้ ตัวแปร amphur_id มีค่าเท่ากับ ค่าของ  #amphur ที่กำลังถูกเลือกในขณะนั้น
                var amphur_id = $(this).val();

                $.ajax({
                    url:"get_data.php",
                    dataType: "json",//กำหนดให้มีรูปแบบเป็น Json
                    data:{amphur_id:amphur_id},//ส่งค่าตัวแปร amphur_id เพื่อดึงข้อมูล ตำบล ที่มี amphur_id เท่ากับค่าที่ส่งไป
                    success:function(data){

                        //กำหนดให้ข้อมูลใน #district เป็นค่าว่าง
                        $("#district").text("");

                        //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data
                        $.each(data, function( index, value ) {

                            //แทรก Elements ข้อมูลที่ได้  ใน id district  ด้วยคำสั่ง append
                            $("#district").append("<option value='" + value.id + "'> " + value.name + "</option>");

                        });
                    }
                });

            });

            //คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่  #district
            $("#district").change(function(){

                //นำข้อมูลรายการ จังหวัด ที่เลือก มาใส่ไว้ในตัวแปร province
                var province = $("#province option:selected").text();

                //นำข้อมูลรายการ อำเภอ ที่เลือก มาใส่ไว้ในตัวแปร amphur
                var amphur = $("#amphur option:selected").text();

                //นำข้อมูลรายการ ตำบล ที่เลือก มาใส่ไว้ในตัวแปร district
                var district = $("#district option:selected").text();

                //ใช้คำสั่ง alert แสดงข้อมูลที่ได้
                alert("คุณได้เลือก :  จังหวัด : " + province + " อำเภอ : "+ amphur + "  ตำบล : " + district );

            });


        });

    </script>
    <?php
} else {
    ?>
    <div class="card">
        <div class="card-header bg-primary text-white"><h4>กรุณาเลือกประเภทของสมาชิกที่ต้องการลงทะเบียน</h4></div>
        <div class="card-body">
            <p class="text-center"><a href="main.php?page=register&regist=1001">
                    <button type="button" class="btn btn-outline-success"><i class="fa fa-user-circle-o"
                                                                             aria-hidden="true"></i> ลงทะเบียนผู้ซื้อ
                    </button>
                </a></p>
            <p class="text-center"><a href="main.php?page=register&regist=1002">
                    <button type="button" class="btn btn-outline-warning"><i class="fa fa-user-circle-o"
                                                                             aria-hidden="true"></i> ลงทะเบียนผู้ผลิต
                    </button>
                </a></p>
            <br>
            <p class="text-center text-danger">*หากท่านลงทะเบียนเป็นผู้ผลิต ท่านจะได้เป็นสมาชิกผู้ซื้อโดยอัตโนมัติ</p>
        </div>
    </div>
    <?php
}
?>
