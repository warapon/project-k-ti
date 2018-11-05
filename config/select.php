<?php
require_once("connect.php");
session_start();
if (!empty($_POST["name_type"]) AND $_POST["name_type"] == "login") {
    if (empty($_POST["user"]) and empty($_POST["pass"])) {
        echo "<script>window.location.href='../main.php?page=login';</script>";

    } else {
        $email = mysql_real_escape_string($_POST["email"]);
        $pass = mysql_real_escape_string($_POST["pass"]);

        $sql = sprintf("SELECT * FROM login WHERE ln_user='%s' AND ln_pass='%s';", $email, $pass);
        $con = new db();
        $con = $con->selects($sql);
        if (mysql_num_rows($con) == 0) {
            echo "<script>window.location.href='../main.php?page=login&status=loginfail';</script>";
        } else {
            $row = mysql_fetch_assoc($con);
            $_SESSION["user_id_system"] = $row["ln_user_id"];
            $_SESSION["level"] = $row["ln_type"];
            if ($_SESSION["level"] == 1) {
                $sql = sprintf("SELECT by_prefix,by_name,by_lastname FROM buyers 
                                WHERE by_id='%s';", $_SESSION["user_id_system"]);
                $con = new db();
                $con = $con->selects($sql);
                $row = mysql_fetch_assoc($con);
                $_SESSION["prefix"] = $row["by_prefix"];
                $_SESSION["name"] = $row["by_name"];
                $_SESSION["lastname"] = $row["by_lastname"];
            } elseif ($_SESSION["level"] == 2 OR $_SESSION["level"] == 3) {
                $sql = sprintf("SELECT pd_prefix,pd_name,pd_lastname FROM producers 
                                WHERE pd_id='%s';", $_SESSION["user_id_system"]);
                $con = new db();
                $con = $con->selects($sql);
                $row = mysql_fetch_assoc($con);
                $_SESSION["prefix"] = $row["pd_prefix"];
                $_SESSION["name"] = $row["pd_name"];
                $_SESSION["lastname"] = $row["pd_lastname"];

            } elseif ($_SESSION["level"] == 4) {
                $sql = sprintf("SELECT ad_prefix,ad_name,ad_lastname FROM admin 
                                WHERE ad_id='%s';", $_SESSION["user_id_system"]);
                $con = new db();
                $con = $con->selects($sql);
                $row = mysql_fetch_assoc($con);
                $_SESSION["prefix"] = $row["ad_prefix"];
                $_SESSION["name"] = $row["ad_name"];
                $_SESSION["lastname"] = $row["ad_lastname"];
            }


            echo "<script>window.location.href='../index.php';</script>";
        }
    }
}else{
    echo "<script>window.location.href='../index.php';</script>";
}