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
    $sql = sprintf("SELECT * FROM producers WHERE pd_id = %s", $_GET["garden"]);
    $con = new db();
    $con = $con->selects($sql);
    if (mysql_num_rows($con) > 0) {
        $row_producers = mysql_fetch_assoc($con);
    }

    $sql = sprintf("SELECT * FROM garden INNER JOIN fruittype ON garden.fruittype_ft_id = fruittype.ft_id 
                    INNER JOIN producers ON garden.producers_pd_id = producers.pd_id WHERE producers.pd_id = %s", $_GET["garden"]);
    $con = new db();
    $con = $con->selects($sql);
    ?>
    <div class="card">
        <div class="card-header bg-success text-white text-center"><h4>
                ข้อมูลของ <?= $row_producers["pd_prefix"] ?><?= $row_producers["pd_name"] ?>  <?= $row_producers["pd_lastname"] ?></h4></div>
        <div class="card-body">
            <form action="report/report_research.php" method="post" target="_blank">
                <input type="hidden" name="garden" value="<?= $_GET["garden"] ?>">
                <input type="hidden" name="pd_prefix" value="<?= $row_producers["pd_prefix"] ?>">
                <input type="hidden" name="pd_name" value="<?= $row_producers["pd_name"] ?>">
                <input type="hidden" name="pd_lastname" value="<?= $row_producers["pd_lastname"] ?>">
                <button type="submit" class="btn btn-primary float-right"><i
                            class="fa fa-print" aria-hidden="true"></i> พิมพ์
                </button>
            </form>
            <br><br>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                    <tr>
                        <th>ชื่อสวน</th>
                        <th>ประเภท</th>
                        <th>พื้นที่/ไร่</th>
                        <th>กำลังผลิต/ปี</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (mysql_num_rows($con) > 0) {
                        while ($row = mysql_fetch_assoc($con)) {
                            ?>
                            <tr>
                                <th><?= $row["gd_name"] ?></th>
                                <th><?= $row["ft_nametype"] ?></th>
                                <th><?= $row["gd_area_number"] ?></th>
                                <th><?= $row["gd_productivity"] ?></th>
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