<?php
require_once("connect.php");
session_start();
if (!empty($_GET["idstatus"])) {
    $sql = sprintf("DELETE FROM garden WHERE gd_id = %s", $_GET["idstatus"]);
    $con = new db();
    $con = $con->delete($sql);
    if ($con == 1) {
        echo "<script>window.location.href='../main.php?page=manage_garden&status=success';</script>";
    } else {
        echo "<script>window.location.href='../main.php?page=manage_garden&status=fail';</script>";
    }
} elseif (!empty($_GET["idtype"])) {
    $sql = sprintf("DELETE FROM fruittype WHERE ft_id = %s", $_GET["idtype"]);
    $con = new db();
    $con = $con->delete($sql);
    if ($con == 1) {
        echo "<script>window.location.href='../main.php?page=typefruit&status=success';</script>";
    } else {
        echo "<script>window.location.href='../main.php?page=typefruit&status=fail';</script>";
    }
} elseif (!empty($_GET["idorchard"])) {
    $sql = sprintf("DELETE FROM imggarden WHERE img_gd_id = %s", $_GET["idorchard"]);
    $con = new db();
    $con = $con->delete($sql);
    if ($con == 1) {
        echo "<script>window.location.href='../main.php?page=manage_images&id=" . $_GET["id"] . "&status=success';</script>";
    } else {
        echo "<script>window.location.href='../main.php?page=manage_images&id=" . $_GET["id"] . "&status=fail';</script>";
    }
} elseif (!empty($_GET["idproducer"])) {
    $sql = sprintf("DELETE FROM producers WHERE pd_id = %s", $_GET["idproducer"]);
    $con = new db();
    $con = $con->delete($sql);
    if ($con == 1) {
        $sql = sprintf("DELETE FROM login WHERE ln_user_id = %s AND (ln_type = 2 OR ln_type = 3)", $_GET["idproducer"]);
        $con = new db();
        $con = $con->delete($sql);
        if ($con == 1) {
            echo "<script>window.location.href='../main.php?page=report_producers&status=success';</script>";
        } else {
            echo "<script>window.location.href='../main.php?page=report_producers&status=fail';</script>";
        }
    } else {
        echo "<script>window.location.href='../main.php?page=report_producers&status=fail';</script>";
    }
} elseif (!empty($_GET["idbuyer"])) {
    $sql = sprintf("DELETE FROM buyers WHERE by_id = %s", $_GET["idbuyer"]);
    $con = new db();
    $con = $con->delete($sql);
    if ($con == 1) {
        $sql = sprintf("DELETE FROM login WHERE ln_user_id = %s AND ln_type = 1", $_GET["idproducer"]);
        $con = new db();
        $con = $con->delete($sql);
        if ($con == 1) {
            echo "<script>window.location.href='../main.php?page=report_buyers&status=success';</script>";
        } else {
            echo "<script>window.location.href='../main.php?page=report_buyers&status=fail';</script>";
        }
    } else {
        echo "<script>window.location.href='../main.php?page=report_buyers&status=fail';</script>";
    }
} elseif (!empty($_GET["idgarden"])) {
    $sql = sprintf("DELETE FROM garden WHERE gd_id = %s", $_GET["idgarden"]);
    $con = new db();
    $con = $con->delete($sql);
    if ($con == 1) {
        echo "<script>window.location.href='../main.php?page=report_garden&status=success';</script>";
    } else {
        echo "<script>window.location.href='../main.php?page=report_garden&status=fail';</script>";
    }
} else {
    echo "<script>window.location.href='../index.php';</script>";
}
