<?php
require_once("connect.php");
date_default_timezone_set('Asia/Bangkok');
session_start();
if (!empty($_SESSION["level"])) {
    if (!empty($_POST["chang_data"]) AND $_POST["chang_data"] == 1001) {
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

        $sql = sprintf("UPDATE buyers SET
				by_prefix 	      = '%s',
				by_name 	      = '%s',
                by_lastname		  = '%s',
                by_card_number	  = '%s',
                by_company 	      = '%s',
                by_addass_number  = '%s',
                by_m			  = '%s',
                by_district		  = '%s',
                by_citty		  = '%s',
                by_province		  = '%s',
                by_tel		  = '%s'
			WHERE by_id = %s",
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
            $_SESSION["user_id_system"]
        );
        $con = new db();
        $con = $con->update($sql);
        if ($con == 1) {
            echo "<script>window.location.href='../main.php?page=setting&status=success';</script>";
        } else {
            echo "<script>window.location.href='../main.php?page=setting&status=fail';</script>";
        }
    } elseif (!empty($_POST["chang_data"]) AND $_POST["chang_data"] == 1002) {
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


        $sql = sprintf("UPDATE producers SET
				pd_prefix 	      = '%s',
				pd_name	 	      = '%s',
                pd_lastname		  = '%s',
                pd_birthday	      = '%s',
                pd_card_number 	  = '%s',
                pd_house_number   = '%s',
                pd_mu			  = '%s',
                pd_district		  = '%s',
                pd_city		      = '%s',
                pd_province		  = '%s',
                pd_tel		      = '%s',
                pd_facebook		  = '%s',
                pd_line		      = '%s'
			WHERE pd_id = %s",
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
            $_POST["facebook"],
            $_POST["line"],
            $_SESSION["user_id_system"]
        );
        $con = new db();
        $con = $con->update($sql);
        if ($con == 1) {
            echo "<script>window.location.href='../main.php?page=setting&status=success';</script>";
        } else {
            echo "<script>window.location.href='../main.php?page=setting&status=fail';</script>";
        }
    } elseif (!empty($_POST["chage_key"]) AND $_POST["chage_key"] == 1) {
        $sql = sprintf("UPDATE login SET
				ln_pass 	      = '%s'
			WHERE ln_user_id = %s AND ln_type = %s",
            $_POST["newpass"],
            $_SESSION["user_id_system"],
            $_SESSION["level"]
        );
        $con = new db();
        $con = $con->update($sql);
        if ($con == 1) {
            echo "<script>window.location.href='../main.php?page=setting&status=success';</script>";
        } else {
            echo "<script>window.location.href='../main.php?page=setting&status=fail';</script>";
        }
    } elseif (!empty($_GET["idconfraim"])) {
        $sql = sprintf("UPDATE login SET
				ln_type = 2
			WHERE ln_id = %s",
            $_GET["idconfraim"]
        );
        $con = new db();
        $con = $con->update($sql);
        if ($con == 1) {
            echo "<script>window.location.href='../main.php?page=manage&status=success';</script>";
        } else {
            echo "<script>window.location.href='../main.php?page=manage&status=fail';</script>";
        }
    } elseif (!empty($_POST["editprofile"]) AND $_POST["editprofile"] == 1) {
        if ($_FILES["fileupload"]["type"] == "image/jpeg" OR $_FILES["fileupload"]["type"] == "image/gif" OR $_FILES["fileupload"]["type"] == "image/png"
            OR $_FILES["fileupload"]["type"] == "image/jpg") {

            $file = strtolower($_FILES["fileupload"]["name"]);
            $filename = date("Ymdhisv") . $file;
            $tempfile = "../img/profix/" . $filename;

            $sql = sprintf("UPDATE producers SET
				pd_image = '%s'
			WHERE pd_id = %s",
                $filename,
                $_SESSION["user_id_system"]
            );
            $con = new db();
            $con = $con->update($sql);
            if ($con == 1) {
                copy($_FILES["fileupload"]["tmp_name"], $tempfile);
                move_uploaded_file($_FILES["fileupload"]["tmp_name"], $tempfile);
                echo "<script>window.location.href='../main.php?page=setting&status=success';</script>";
            } else {
                echo "<script>window.location.href='../main.php?page=setting&status=fail';</script>";
            }
        } else {
            echo "<script>window.location.href='../main.php?page=setting&status=typefail';</script>";
        }


    } elseif (!empty($_GET["idstatus"])) {
        if ($_GET["status"] == "on") {
            $sql = sprintf("UPDATE garden SET
				gd_status = 1
			WHERE gd_id = %s",
                $_GET["idstatus"]
            );
            $con = new db();
            $con = $con->update($sql);
            if ($con == 1) {
                echo "<script>window.location.href='../main.php?page=manage_garden&status=success';</script>";
            } else {
                echo "<script>window.location.href='../main.php??page=manage_garden&status=fail';</script>";
            }
        } elseif ($_GET["status"] == "off") {
            $sql = sprintf("UPDATE garden SET
				gd_status = 0
			WHERE gd_id = %s",
                $_GET["idstatus"]
            );
            $con = new db();
            $con = $con->update($sql);
            if ($con == 1) {
                echo "<script>window.location.href='../main.php?page=manage_garden&status=success';</script>";
            } else {
                echo "<script>window.location.href='../main.php??page=manage_garden&status=fail';</script>";
            }
        }
    } elseif (!empty($_POST["edittypefruit"])) {
        if ($_FILES["fileupload"]["type"] == "image/jpeg" OR $_FILES["fileupload"]["type"] == "image/gif" OR $_FILES["fileupload"]["type"] == "image/png"
            OR $_FILES["fileupload"]["type"] == "image/jpg") {

            $file = strtolower($_FILES["fileupload"]["name"]);
            $filename = date("Ymdhisv") . $file;
            $tempfile = "../img/type/" . $filename;

            $sql = sprintf("UPDATE fruittype SET
				ft_nametype = '%s',
				ft_image = '%s'
			WHERE ft_id = %s",
                $_POST["name"],
                $filename,
                $_POST["ft_id"]
            );
            $con = new db();
            $con = $con->update($sql);
            if ($con == 1) {
                copy($_FILES["fileupload"]["tmp_name"], $tempfile);
                move_uploaded_file($_FILES["fileupload"]["tmp_name"], $tempfile);
                echo "<script>window.location.href='../main.php?page=typefruit&status=success';</script>";
            } else {
                echo "<script>window.location.href='../main.php?page=typefruit&status=fail';</script>";
            }
        } else {
            echo "<script>window.location.href='../main.php?page=typefruit&status=typefail';</script>";
        }
    } elseif (!empty($_POST["position"])) {
        $sql = sprintf("UPDATE position SET
				pt_long = '%s',
				pt_lat = '%s'
			WHERE pt_id = %s",
            $_POST["long"],
            $_POST["lat"],
            $_POST["id"]
        );
        $con = new db();
        $con = $con->update($sql);
        if ($con == 1) {
            echo "<script>window.location.href='../main.php?page=position&status=success';</script>";
        } else {
            echo "<script>window.location.href='../main.php?page=position&status=fail';</script>";
        }
    } elseif (!empty($_POST["updategraden"])) {
        if (empty($_FILES['fileupload']['name'])) {
            $sql = sprintf("UPDATE garden SET
				gd_name = '%s',
				gd_area_number = '%s',
				gd_productivity = '%s',
				gd_detail = '%s',
				fruittype_ft_id = %s
			WHERE gd_id = %s",
                $_POST["gd_name"],
                $_POST["gd_area_number"],
                $_POST["gd_productivity"],
                $_POST["gd_detail"],
                $_POST["fruittype_ft_id"],
                $_POST["updategraden"]
            );
            $con = new db();
            $con = $con->update($sql);
            if ($con == 1) {
                echo "<script>window.location.href='../main.php?page=manage_garden&status=success';</script>";
            } else {
                echo "<script>window.location.href='../main.php?page=manage_garden&status=fail';</script>";
            }
        } else {
            if ($_FILES["fileupload"]["type"] == "image/jpeg" OR $_FILES["fileupload"]["type"] == "image/gif" OR $_FILES["fileupload"]["type"] == "image/png"
                OR $_FILES["fileupload"]["type"] == "image/jpg") {

                $file = strtolower(pathinfo($_FILES["fileupload"]["name"], PATHINFO_EXTENSION));
                $filename = date("Ymdhis") . $_POST["updategraden"] . "." . $file;
                $tempfile = "../img/garden/" . $filename;

                $sql = sprintf("UPDATE garden SET
				gd_name = '%s',
				gd_area_number = '%s',
				gd_productivity = '%s',
				gd_detail = '%s',
				gd_img = '%s',
				fruittype_ft_id = %s
			WHERE gd_id = %s",
                    $_POST["gd_name"],
                    $_POST["gd_area_number"],
                    $_POST["gd_productivity"],
                    $_POST["gd_detail"],
                    $filename,
                    $_POST["fruittype_ft_id"],
                    $_POST["updategraden"]
                );
                $con = new db();
                $con = $con->insert($sql);
                if ($con == 1) {
                    copy($_FILES["fileupload"]["tmp_name"], $tempfile);
                    move_uploaded_file($_FILES["fileupload"]["tmp_name"], $tempfile);
                    echo "<script>window.location.href='../main.php?page=manage_garden&status=success';</script>";
                } else {
                    echo "<script>window.location.href='../main.php?page=manage_garden&status=fail';</script>";
                }
            }
        }

    }

} else {
    echo "<script>window.location.href='../index.php';</script>";
}

?>