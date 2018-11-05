<?php
$sql = sprintf("SELECT * FROM  fruittype ");

$con = new db();
$con = $con->selects($sql);
?>
<div class="row">
    <?php
    if (mysql_num_rows($con) == 0) {
        echo "<div class='col-sm-12'>";
        echo "<div class='text-center text-danger'> ไม่มีผลไม้ในร้าน </div>";
        echo "</div>";
    } else {
        while ($row = mysql_fetch_assoc($con)) {
            ?>
            <div class="col-4 col-md-2 no-gutters">
                <a href="main.php?page=search&fruit=<?= $row["ft_id"] ?>" data-toggle="tooltip" data-placement="top" title="<?= $row["ft_nametype"] ?>">
                    <div class="card bg-light text-dark">
                        <div class="card-body text-center">
                            <img class="rounded-circle" src="img/type/<?= $row["ft_image"] ?>" width="100%"
                                 alt="Card image">
                            <div class="text-truncate"><?= $row["ft_nametype"] ?></div>
                        </div>
                    </div>
                </a>
                <br>
            </div>
            <?php
        }
    }
    ?>
</div>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>