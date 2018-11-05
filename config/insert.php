<?php
require_once("connect.php");
require_once("sendmail.php");
session_start();
/*TODO ลงทะเบียนผู้ซื้อ*/
if (!empty($_POST["regiter"]) AND $_POST["regiter"] == "1001") {
    $sql = sprintf("SELECT PROVINCE_NAME FROM province WHERE PROVINCE_ID = %s", $_POST["province"]);
    $con = new db();
    $con = $con->selects($sql);
    $row = mysql_fetch_assoc($con);
    $province = $row["PROVINCE_NAME"];

    $sql = sprintf("SELECT AMPHUR_NAME FROM amphur WHERE AMPHUR_ID = %s", $_POST["citty"]);
    $con = new db();
    $con = $con->selects($sql);
    $row = mysql_fetch_assoc($con);
    $city = $row["AMPHUR_NAME"];

    $sql = sprintf("SELECT DISTRICT_NAME FROM district WHERE DISTRICT_CODE = '%s'", $_POST["district"]);
    $con = new db();
    $con = $con->selects($sql);
    $row = mysql_fetch_assoc($con);
    $district = $row["DISTRICT_NAME"];

    $sql_1 = sprintf("SELECT ln_user FROM login WHERE ln_user = '%s'", $_POST["email"]);
    $con = new db();
    $con = $con->selects($sql_1);
    if (mysql_num_rows($con) == 0) {

        $sql_2 = sprintf("SELECT MAX(by_id) AS max_id FROM buyers");
        $con = new db();
        $con = $con->selects($sql_2);
        $row = mysql_fetch_assoc($con);
        $max_id = $row["max_id"] + 1;
        $sql_3 = sprintf("INSERT INTO buyers (
                      by_id,
                      by_prefix,
                      by_name,
                      by_lastname,
                      by_card_number,
                      by_company,
                      by_addass_number,
                      by_m,
                      by_district,
                      by_citty,
                      by_province,
                      by_tel,
                      by_email
            ) VALUES(%s,'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
            $max_id,
            $_POST["prefix"],
            $_POST["name"],
            $_POST["lastname"],
            $_POST["card_number"],
            $_POST["company"],
            $_POST["addass_number"],
            $_POST["m"],
            $district,
            $city,
            $province,
            $_POST["tel"],
            $_POST["email"]

        );
        $con = new db();
        $con = $con->insert($sql_3);
        if ($con == 1) {
            $gen = 10; //กำหนดจำนวนหลักในการสุ่ม
            $char_pass = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ"; //รูปแบบข้อความที่จะให้ทำการสุ่ม อาจจะเปลี่ยนเป็น A-Z, a-z, 0-9
            $password = ""; //กำหนดค่าเริ่มต้นให้กับตัวแปล password ที่ใช้ในการเก็บข้อมูล

            while (strlen($password) < $gen) {
                $password .= $char_pass[rand() % strlen($char_pass)]; //ทำการสุ่มพร้อมกับเก็บค่าลง password ใช้ (.) มาช่วยในการรวมข้อความที่ถูกสุ่ม
            }
            $sql = sprintf("INSERT INTO login (ln_user,ln_pass,ln_user_id,ln_type) 
                  VALUES ('%s','%s',%s,%s)", $_POST["email"], $password, $max_id, 1);
            $con = new db();
            $con = $con->insert($sql);

            $mail = new mail();
            $mail = $mail->send($_POST["email"], $password);
            if ($mail == 1) {
                echo "<script>window.location.href='../main.php?page=login&status=success';</script>";
            } else {
                echo "<script>window.location.href='../main.php?page=login&status=fail';</script>";
            }
        } else {
            echo "<script>window.location.href='../main.php?page=login&status=fail';</script>";
        }
    } else {
        echo "<script>window.location.href='../main.php?page=register&regist=1001&status=mail';</script>";
    }


} /*TODO ลงทะเบียนผู้ผลิต*/
elseif (!empty($_POST["regiter"]) AND $_POST["regiter"] == "1002") {
    $sql = sprintf("SELECT PROVINCE_NAME FROM province WHERE PROVINCE_ID = %s", $_POST["province"]);
    $con = new db();
    $con = $con->selects($sql);
    $row = mysql_fetch_assoc($con);
    $province = $row["PROVINCE_NAME"];

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

    $sql = sprintf("SELECT ln_user FROM login WHERE ln_user = '%s'", $_POST["email"]);
    $con = new db();
    $con = $con->selects($sql);
    if (mysql_num_rows($con) == 0) {

        $sql = sprintf("SELECT MAX(pd_id) AS max_id FROM producers");
        $con = new db();
        $con = $con->selects($sql);
        $row = mysql_fetch_assoc($con);
        $max_id = $row["max_id"] + 1;
        $sql = sprintf("INSERT INTO producers (
                      pd_id,
                      pd_prefix,
                      pd_name,
                      pd_lastname,
                      pd_birthday,
                      pd_card_number,
                      pd_house_number,
                      pd_mu,
                      pd_district,
                      pd_city,
                      pd_province,
                      pd_tel,
                      pd_email,
                      pd_facebook,
                      pd_line
            ) VALUES(%s,'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
            $max_id,
            $_POST["prefix"],
            $_POST["name"],
            $_POST["lastname"],
            $_POST["birthday"],
            $_POST["card_number"],
            $_POST["house_number"],
            $_POST["mu"],
            $district,
            $city,
            $province,
            $_POST["tel"],
            $_POST["email"],
            $_POST["facebook"],
            $_POST["line"]

        );
        $con = new db();
        $con = $con->insert($sql);
        if ($con == 1) {
            $gen = 10; //กำหนดจำนวนหลักในการสุ่ม
            $char_pass = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ"; //รูปแบบข้อความที่จะให้ทำการสุ่ม อาจจะเปลี่ยนเป็น A-Z, a-z, 0-9
            $password = ""; //กำหนดค่าเริ่มต้นให้กับตัวแปล password ที่ใช้ในการเก็บข้อมูล

            while (strlen($password) < $gen) {
                $password .= $char_pass[rand() % strlen($char_pass)]; //ทำการสุ่มพร้อมกับเก็บค่าลง password ใช้ (.) มาช่วยในการรวมข้อความที่ถูกสุ่ม
            }
            $sql = sprintf("INSERT INTO login (ln_user,ln_pass,ln_user_id,ln_type) 
                  VALUES ('%s','%s',$max_id,3)", $_POST["email"], $password);
            $con = new db();
            $con = $con->insert($sql);

            $mail = new mail();
            $mail = $mail->send($_POST["email"], $password);
            if ($mail == 1) {
                echo "<script>window.location.href='../main.php?page=login&status=success';</script>";
            } else {
                echo "<script>window.location.href='../main.php?page=login&status=fail';</script>";
            }
        } else {
            echo "<script>window.location.href='../main.php?page=login&status=fail';</script>";
        }
    } else {
        echo "<script>window.location.href='../main.php?page=register&regist=1001&status=mail';</script>";
    }

} elseif (!empty($_POST["addgraden"]) AND $_POST["addgraden"] == 1) {
    if ($_FILES["fileupload"]["type"] == "image/jpeg" OR $_FILES["fileupload"]["type"] == "image/gif" OR $_FILES["fileupload"]["type"] == "image/png"
        OR $_FILES["fileupload"]["type"] == "image/jpg") {

        $file = strtolower($_FILES["fileupload"]["name"]);
        $filename = date("Ymdhisv") . $file;
        $tempfile = "../img/garden/" . $filename;

        $sql = sprintf("INSERT INTO garden (
                      gd_name,
                      gd_area_number,
                      gd_productivity,
                      gd_detail,
                      gd_status,
                      gd_img,
                      fruittype_ft_id,
                      producers_pd_id
            ) VALUES('%s','%s','%s','%s',%s,'%s',%s,%s)",
            $_POST["gd_name"],
            $_POST["gd_area_number"],
            $_POST["gd_productivity"],
            $_POST["gd_detail"],
            1,
            $filename,
            $_POST["fruittype_ft_id"],
            $_SESSION["user_id_system"]
        );
        $con = new db();
        $con = $con->insert($sql);
        if ($con == 1) {
            copy($_FILES["fileupload"]["tmp_name"], $tempfile);
            move_uploaded_file($_FILES["fileupload"]["tmp_name"], $tempfile);
            echo "<script>window.location.href='../main.php?page=manage_garden&status=success';</script>";
        } else {
//            echo "#1";
            echo "<script>window.location.href='../main.php?page=manage_garden&status=fail';</script>";
        }
    } else {
//        echo "#2";
        echo "<script>window.location.href='../main.php?page=manage_garden&status=typefail';</script>";
    }


} elseif (!empty($_POST["addtypefruit"]) AND $_POST["addtypefruit"] == 1) {
    if ($_FILES["fileupload"]["type"] == "image/jpeg" OR $_FILES["fileupload"]["type"] == "image/gif" OR $_FILES["fileupload"]["type"] == "image/png"
        OR $_FILES["fileupload"]["type"] == "image/jpg") {

        $file = strtolower($_FILES["fileupload"]["name"]);
        $filename = date("Ymdhisv") . $file;
        $tempfile = "../img/type/" . $filename;

        $sql = sprintf("INSERT INTO fruittype (
                      ft_nametype,
                      ft_image
            ) VALUES('%s','%s')",
            $_POST["name"],
            $filename
        );
        $con = new db();
        $con = $con->insert($sql);
        if ($con == 1) {
            copy($_FILES["fileupload"]["tmp_name"], $tempfile);
            move_uploaded_file($_FILES["fileupload"]["tmp_name"], $tempfile);
            echo "<script>window.location.href='../main.php?page=typefruit&status=success';</script>";
        } else {
//            echo "#1";
            echo "<script>window.location.href='../main.php?page=typefruit&status=fail';</script>";
        }
    } else {
//        echo "#2";
        echo "<script>window.location.href='../main.php?page=typefruit&status=typefail';</script>";
    }
} elseif (!empty($_POST["manage_images"]) AND $_POST["manage_images"] == 1) {
    $total = count($_FILES['upload']['name']);
    for ($i = 0; $i < $total; $i++) {
        if ($_FILES["upload"]["type"][$i] == "image/jpeg" OR $_FILES["upload"]["type"][$i] == "image/gif" OR $_FILES["upload"]["type"][$i] == "image/png"
            OR $_FILES["upload"]["type"][$i] == "image/jpg") {

            $file = strtolower(pathinfo($_FILES["upload"]["name"][$i],PATHINFO_EXTENSION));
            $filename = date("Ymdhis") .$_POST["garden_id"].$i.".".$file;
            $tempfile = "../img/orchard/" . $filename;

            $sql = sprintf("INSERT INTO imggarden (
                      img_gd_name,
                      garden_gd_id
            ) VALUES('%s','%s')",
                $filename,
                $_POST["garden_id"]
            );
            $con = new db();
            $con = $con->insert($sql);
            if ($con == 1) {
                copy($_FILES["upload"]["tmp_name"][$i], $tempfile);
                move_uploaded_file($_FILES["upload"]["tmp_name"][$i], $tempfile);
            }
        }
    }
    echo "<script>window.location.href='../main.php?page=manage_garden&status=success';</script>";

} elseif (!empty($_POST["position"]) AND $_POST["position"] == 1) {
    $sql = sprintf("INSERT INTO position (
                      pt_long,
                      pt_lat,
                      pt_pd_id
            ) VALUES('%s','%s',%s)",
        $_POST["long"],
        $_POST["lat"],
        $_POST["id"]
    );
    $con = new db();
    $con = $con->insert($sql);
    if ($con == 1) {
        echo "<script>window.location.href='../main.php?page=position&status=success';</script>";
    } else {
        echo "<script>window.location.href='../main.php?page=position&status=fail';</script>";
    }
} else {
    echo "<script>window.location.href='../index.php';</script>";
}