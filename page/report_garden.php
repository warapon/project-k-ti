<?php
if (!empty($_GET["status"]) AND $_GET["status"] == "success") {
    ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>สำเร็จ!</strong> การดำเนินการเสร็จสิ้น
    </div>
    <?php
} elseif (!empty($_GET["status"]) AND $_GET["status"] == "fail") {
    ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>ผิดพลาด!</strong> กรุณาติดต่อเจ้าหน้าที่ หรือ ผู้ที่มีส่วนเกี่ยวข้อง
    </div>
    <?php
}
if (!empty($_SESSION["user_id_system"]) AND !empty($_SESSION["level"]) AND $_SESSION["level"] == 4) {
    ?>
    <div class="card">
        <div class="card-header bg-success text-white text-center"><h4>ข้อมูลตามสวน</h4></div>
        <div class="card-body">
            <form name="form1" method="post" action="" OnSubmit="return fncSubmit();">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>อำเภอ</label>
                            <select class="form-control" name="city" id="amphur">
                                <option id="amphur_list"></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>ตำบล</label>
                            <select class="form-control" name="district" id="district">
                                <option value="">-- ทุกตำบล --</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <?php
                        $sql_fruittype = sprintf("SELECT * FROM fruittype ");

                        $con_fruittype = new db();
                        $con_fruittype = $con_fruittype->selects($sql_fruittype);
                        ?>
                        <label for="sel1">ประเภท</label>
                        <select class="form-control" name="type" id="sel1">
                            <option value=""> -- ทุกชนิด --</option>
                            <?php
                            while ($row_fruittype = mysql_fetch_assoc($con_fruittype)) {
                                ?>
                                <option value="<?= $row_fruittype["ft_id"] ?>"><?= $row_fruittype["ft_nametype"] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>พื้นที่/ไร่</label>
                            <input class="form-control" name="area" type="number">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>กำลังผลิต/ปี</label>
                            <input class="form-control" name="productivity" type="number">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-success"><i class="fa fa-search"
                                                                         aria-hidden="true"></i>
                            Go
                        </button>
                    </div>
                </div>

            </form>
            <hr>

            <?php
            if (!empty($_POST["city"])) {
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

            }
            if (!empty($_POST["district"])) {
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
            }


            $sql = sprintf("SELECT * FROM garden INNER JOIN fruittype ON garden.fruittype_ft_id = fruittype.ft_id 
                    INNER JOIN producers ON garden.producers_pd_id = producers.pd_id ");

            if (!empty($_POST["city"]) AND !empty($_POST["district"]) AND !empty($_POST["type"]) AND !empty($_POST["area"]) AND !empty($_POST["productivity"])) {
                $sql .= sprintf("WHERE producers.pd_city = '%s' AND producers.pd_district = '%s' AND garden.fruittype_ft_id = %s 
                AND garden.gd_area_number = '%s' AND garden.gd_productivity = '%s'", $city, $district, $_POST["type"], $_POST["area"], $_POST["productivity"]);

            }elseif (!empty($_POST["city"]) AND !empty($_POST["district"]) AND !empty($_POST["type"]) AND !empty($_POST["area"]) AND empty($_POST["productivity"])){
                $sql .= sprintf("WHERE producers.pd_city = '%s' AND producers.pd_district = '%s' AND garden.fruittype_ft_id = %s 
                AND garden.gd_area_number = '%s'", $city, $district, $_POST["type"], $_POST["area"]);

            }elseif (!empty($_POST["city"]) AND !empty($_POST["district"]) AND !empty($_POST["type"]) AND empty($_POST["area"]) AND !empty($_POST["productivity"])){
                $sql .= sprintf("WHERE producers.pd_city = '%s' AND producers.pd_district = '%s' AND garden.fruittype_ft_id = %s 
                AND garden.gd_productivity = '%s'", $city, $district, $_POST["type"], $_POST["productivity"]);

            }elseif (!empty($_POST["city"]) AND !empty($_POST["district"]) AND !empty($_POST["type"]) AND empty($_POST["area"]) AND empty($_POST["productivity"])){
                $sql .= sprintf("WHERE producers.pd_city = '%s' AND producers.pd_district = '%s' AND garden.fruittype_ft_id = %s", $city, $district, $_POST["type"]);

            }elseif (!empty($_POST["city"]) AND !empty($_POST["district"]) AND empty($_POST["type"]) AND !empty($_POST["area"]) AND empty($_POST["productivity"])){
                $sql .= sprintf("WHERE producers.pd_city = '%s' AND producers.pd_district = '%s' AND garden.gd_area_number = '%s'", $city, $district, $_POST["area"]);

            }elseif (!empty($_POST["city"]) AND !empty($_POST["district"]) AND empty($_POST["type"]) AND empty($_POST["area"]) AND !empty($_POST["productivity"])){
                $sql .= sprintf("WHERE producers.pd_city = '%s' AND producers.pd_district = '%s' AND garden.gd_productivity = '%s'", $city, $district, $_POST["productivity"]);

            }elseif (!empty($_POST["city"]) AND !empty($_POST["district"]) AND empty($_POST["type"]) AND empty($_POST["area"]) AND empty($_POST["productivity"])){
                $sql .= sprintf("WHERE producers.pd_city = '%s' AND producers.pd_district = '%s'", $city, $district);

            }elseif (!empty($_POST["city"]) AND empty($_POST["district"]) AND !empty($_POST["type"]) AND empty($_POST["area"]) AND empty($_POST["productivity"])){
                $sql .= sprintf("WHERE producers.pd_city = '%s' AND garden.fruittype_ft_id = %s", $city, $_POST["type"]);

            }elseif (!empty($_POST["city"]) AND empty($_POST["district"]) AND empty($_POST["type"]) AND !empty($_POST["area"]) AND empty($_POST["productivity"])){
                $sql .= sprintf("WHERE producers.pd_city = '%s' AND garden.gd_area_number = '%s'", $city, $_POST["area"]);

            }elseif (!empty($_POST["city"]) AND empty($_POST["district"]) AND empty($_POST["type"]) AND empty($_POST["area"]) AND !empty($_POST["productivity"])){
                $sql .= sprintf("WHERE producers.pd_city = '%s' AND garden.gd_productivity = '%s'", $city, $_POST["productivity"]);

            }elseif (empty($_POST["city"]) AND empty($_POST["district"]) AND !empty($_POST["type"]) AND !empty($_POST["area"]) AND !empty($_POST["productivity"])){
                $sql .= sprintf("WHERE garden.fruittype_ft_id = %s AND garden.gd_area_number = '%s' AND garden.gd_productivity = '%s'",$_POST["type"], $_POST["area"], $_POST["productivity"]);

            }elseif (empty($_POST["city"]) AND empty($_POST["district"]) AND empty($_POST["type"]) AND !empty($_POST["area"]) AND !empty($_POST["productivity"])){
                $sql .= sprintf("WHERE garden.gd_area_number = '%s' AND garden.gd_productivity = '%s'", $_POST["area"], $_POST["productivity"]);

            }elseif (empty($_POST["city"]) AND empty($_POST["district"]) AND !empty($_POST["type"]) AND !empty($_POST["area"]) AND empty($_POST["productivity"])){
                $sql .= sprintf("WHERE garden.fruittype_ft_id = %s AND garden.gd_area_number = '%s'", $_POST["type"], $_POST["area"]);

            }elseif (empty($_POST["city"]) AND empty($_POST["district"]) AND !empty($_POST["type"]) AND empty($_POST["area"]) AND !empty($_POST["productivity"])){
                $sql .= sprintf("WHERE garden.fruittype_ft_id = %s AND garden.gd_productivity = '%s'",$_POST["type"], $_POST["productivity"]);

            }elseif (!empty($_POST["city"]) AND empty($_POST["district"]) AND empty($_POST["type"]) AND empty($_POST["area"]) AND empty($_POST["productivity"])){
                $sql .= sprintf("WHERE producers.pd_city = '%s' ", $city);

            }elseif (empty($_POST["city"]) AND empty($_POST["district"]) AND !empty($_POST["type"]) AND empty($_POST["area"]) AND empty($_POST["productivity"])){
                $sql .= sprintf("WHERE garden.fruittype_ft_id = %s",$_POST["type"]);

            }elseif (empty($_POST["city"]) AND empty($_POST["district"]) AND empty($_POST["type"]) AND !empty($_POST["area"]) AND empty($_POST["productivity"])){
                $sql .= sprintf("WHERE garden.gd_area_number = '%s'", $_POST["area"]);
            }elseif (empty($_POST["city"]) AND empty($_POST["district"]) AND empty($_POST["type"]) AND empty($_POST["area"]) AND !empty($_POST["productivity"])){
                $sql .= sprintf("WHERE garden.gd_productivity = '%s'", $_POST["productivity"]);

            }


            $con = new db();
            $con = $con->selects($sql);
            ?>
            <form action="report/report_garden.php" method="post" target="_blank">
                <input type="hidden" name="sql" value="<?=$sql?>">
            <button type="submit" class="btn btn-primary float-right"><i
                        class="fa fa-print" aria-hidden="true"></i> พิมพ์</button>
            </form><br><br>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                    <tr>
                        <th>ชื่อ-นามสกุล</th>
                        <th>ชื่อสวน</th>
                        <th>ประเภท</th>
                        <th>ที่อยู่เลขที่</th>
                        <th>หมู่</th>
                        <th>ตำบล</th>
                        <th>อำเภอ</th>
                        <th>จังหวัด</th>
                        <th>พื้นที่/ไร่</th>
                        <th>กำลังผลิต/ปี</th>
                        <th>ลบ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (mysql_num_rows($con) > 0) {
                        while ($row = mysql_fetch_assoc($con)) {
                            ?>
                            <tr>
                                <th><?= $row["pd_prefix"] ?><?= $row["pd_name"] ?>  <?= $row["pd_lastname"] ?></th>
                                <th><?= $row["gd_name"] ?></th>
                                <th><?= $row["ft_nametype"] ?></th>
                                <th><?= $row["pd_house_number"] ?></th>
                                <th><?= $row["pd_mu"] ?></th>
                                <th><?= $row["pd_district"] ?></th>
                                <th><?= $row["pd_city"] ?></th>
                                <th><?= $row["pd_province"] ?></th>
                                <th><?= $row["gd_area_number"] ?></th>
                                <th><?= $row["gd_productivity"] ?></th>
                                <th>
                                    <a href="config/delete.php?idgarden=<?= $row["gd_id"] ?>">
                                        <button type="button" class="btn btn-danger btn-sm"
                                                onclick="return confirm('ท่านต้องการลบรายการนี้ใช่หรือไม่!!')"><i
                                                    class="fa fa-trash-o"
                                                    aria-hidden="true"></i>
                                        </button>
                                    </a>
                                </th>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function (row) {
                                var data = row.data();
                                return 'Details for ' + data[0] + ' ' + data[1];
                            }
                        }),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                            tableClass: 'table'
                        })
                    }
                }
            });
        });
    </script>
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
            $(document).ready(function () {

                //กำหนดให้ ตัวแปร province มีค่าเท่ากับ ค่าของ #province ที่กำลังถูกเลือกในขณะนั้น
                var province_id = 67;

                $.ajax({
                    url: "get_data.php",
                    dataType: "json",//กำหนดให้มีรูปแบบเป็น Json
                    data: {province_id: province_id},//ส่งค่าตัวแปร province_id เพื่อดึงข้อมูล อำเภอ ที่มี province_id เท่ากับค่าที่ส่งไป
                    success: function (data) {

                        //กำหนดให้ข้อมูลใน #amphur เป็นค่าว่าง
                        $("#amphur").text("");

                        $("#amphur").append("<option value=''>-- ทุกอำเภอ --</option>");
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
                        $("#district").append("<option value=''> -- ทุกตำบล --</option>");
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


                //นำข้อมูลรายการ อำเภอ ที่เลือก มาใส่ไว้ในตัวแปร amphur
                var amphur = $("#amphur option:selected").text();

                //นำข้อมูลรายการ ตำบล ที่เลือก มาใส่ไว้ในตัวแปร district
                var district = $("#district option:selected").text();


            });


        });

        function fncSubmit() {
            if (document.form1.amphur.value == "" && document.form1.district.value != "") {
                alert('กรุณาเลือกอำเภอก่อนการทำรายการค่ะ');
                return false;
            }
            document.form1.submit();
        }
    </script>

    <?php
} else {
    echo "<script>window.location.href='main.php?page=login';</script>";
}
?>