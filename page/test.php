<?php
$_SESSION['ses_user_id'] = 1;
$_SESSION['ses_user_id2'] = 2;
// สำหรับใช้ในตัวอย่างการกำหนด session user_id
//if(isset($_POST['set_user1'])){
//    $_SESSION['ses_user_id']=$_POST['userID'];
//}
//if(isset($_POST['set_user2'])){
//    $_SESSION['ses_user_id2']=$_POST['userID'];
//}
?>
<style>
    body{

        background: #ddd;

    }

    a {

        text-decoration: none !important;

    }

    label {

        color: rgba(120, 144, 156,1.0) !important;

    }

    .btn:focus, .btn:active:focus, .btn.active:focus {

        outline: none !important;
        box-shadow: 0 0px 0px rgba(120, 144, 156,1.0) inset, 0 0 0px rgba(120, 144, 156,0.8);
    }


    textarea:focus,
    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="datetime"]:focus,
    input[type="datetime-local"]:focus,
    input[type="date"]:focus,
    input[type="month"]:focus,
    input[type="time"]:focus,
    input[type="week"]:focus,
    input[type="number"]:focus,
    input[type="email"]:focus,
    input[type="url"]:focus,
    input[type="search"]:focus,
    input[type="tel"]:focus,
    input[type="color"]:focus,
    .uneditable-input:focus {
        border-color: rgba(120, 144, 156,1.0); color: rgba(120, 144, 156,1.0); opacity: 0.9;
        box-shadow: 0 0px 0px rgba(120, 144, 156,1.0) inset, 0 0 10px rgba(120, 144, 156,0.3);
        outline: 0 none; }


    .card::-webkit-scrollbar {
        width: 1px;
    }

    ::-webkit-scrollbar-thumb {
        border-radius: 9px;
        background: rgba(96, 125, 139,0.99);
    }

    .balon1, .balon2 {

        margin-top: 5px !important;
        margin-bottom: 5px !important;

    }


    .balon1 a {

        background: #42a5f5;
        color: #fff !important;
        border-radius: 20px 20px 3px 20px;
        display: block;
        max-width: 75%;
        padding: 7px 13px 7px 13px;

    }

    .balon1:before {

        content: attr(data-is);
        position: absolute;
        right: 15px;
        bottom: -0.8em;
        display: block;
        font-size: .750rem;
        color: rgba(84, 110, 122,1.0);

    }

    .balon2 a {

        background: #f1f1f1;
        color: #000 !important;
        border-radius: 20px 20px 20px 3px;
        display: block;
        max-width: 75%;
        padding: 7px 13px 7px 13px;

    }

    .balon2:before {

        content: attr(data-is);
        position: absolute;
        left: 13px;
        bottom: -0.8em;
        display: block;
        font-size: .750rem;
        color: rgba(84, 110, 122,1.0);

    }

    .bg-sohbet:before messagesDiv{

        content: "";
        /*background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDIwMCAyMDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMTAgOCkiIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+PGNpcmNsZSBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIgY3g9IjE3NiIgY3k9IjEyIiByPSI0Ii8+PHBhdGggZD0iTTIwLjUuNWwyMyAxMW0tMjkgODRsLTMuNzkgMTAuMzc3TTI3LjAzNyAxMzEuNGw1Ljg5OCAyLjIwMy0zLjQ2IDUuOTQ3IDYuMDcyIDIuMzkyLTMuOTMzIDUuNzU4bTEyOC43MzMgMzUuMzdsLjY5My05LjMxNiAxMC4yOTIuMDUyLjQxNi05LjIyMiA5LjI3NC4zMzJNLjUgNDguNXM2LjEzMSA2LjQxMyA2Ljg0NyAxNC44MDVjLjcxNSA4LjM5My0yLjUyIDE0LjgwNi0yLjUyIDE0LjgwNk0xMjQuNTU1IDkwcy03LjQ0NCAwLTEzLjY3IDYuMTkyYy02LjIyNyA2LjE5Mi00LjgzOCAxMi4wMTItNC44MzggMTIuMDEybTIuMjQgNjguNjI2cy00LjAyNi05LjAyNS0xOC4xNDUtOS4wMjUtMTguMTQ1IDUuNy0xOC4xNDUgNS43IiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIi8+PHBhdGggZD0iTTg1LjcxNiAzNi4xNDZsNS4yNDMtOS41MjFoMTEuMDkzbDUuNDE2IDkuNTIxLTUuNDEgOS4xODVIOTAuOTUzbC01LjIzNy05LjE4NXptNjMuOTA5IDE1LjQ3OWgxMC43NXYxMC43NWgtMTAuNzV6IiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIvPjxjaXJjbGUgZmlsbD0iIzAwMCIgY3g9IjcxLjUiIGN5PSI3LjUiIHI9IjEuNSIvPjxjaXJjbGUgZmlsbD0iIzAwMCIgY3g9IjE3MC41IiBjeT0iOTUuNSIgcj0iMS41Ii8+PGNpcmNsZSBmaWxsPSIjMDAwIiBjeD0iODEuNSIgY3k9IjEzNC41IiByPSIxLjUiLz48Y2lyY2xlIGZpbGw9IiMwMDAiIGN4PSIxMy41IiBjeT0iMjMuNSIgcj0iMS41Ii8+PHBhdGggZmlsbD0iIzAwMCIgZD0iTTkzIDcxaDN2M2gtM3ptMzMgODRoM3YzaC0zem0tODUgMThoM3YzaC0zeiIvPjxwYXRoIGQ9Ik0zOS4zODQgNTEuMTIybDUuNzU4LTQuNDU0IDYuNDUzIDQuMjA1LTIuMjk0IDcuMzYzaC03Ljc5bC0yLjEyNy03LjExNHpNMTMwLjE5NSA0LjAzbDEzLjgzIDUuMDYyLTEwLjA5IDcuMDQ4LTMuNzQtMTIuMTF6bS04MyA5NWwxNC44MyA1LjQyOS0xMC44MiA3LjU1Ny00LjAxLTEyLjk4N3pNNS4yMTMgMTYxLjQ5NWwxMS4zMjggMjAuODk3TDIuMjY1IDE4MGwyLjk0OC0xOC41MDV6IiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIvPjxwYXRoIGQ9Ik0xNDkuMDUgMTI3LjQ2OHMtLjUxIDIuMTgzLjk5NSAzLjM2NmMxLjU2IDEuMjI2IDguNjQyLTEuODk1IDMuOTY3LTcuNzg1LTIuMzY3LTIuNDc3LTYuNS0zLjIyNi05LjMzIDAtNS4yMDggNS45MzYgMCAxNy41MSAxMS42MSAxMy43MyAxMi40NTgtNi4yNTcgNS42MzMtMjEuNjU2LTUuMDczLTIyLjY1NC02LjYwMi0uNjA2LTE0LjA0MyAxLjc1Ni0xNi4xNTcgMTAuMjY4LTEuNzE4IDYuOTIgMS41ODQgMTcuMzg3IDEyLjQ1IDIwLjQ3NiAxMC44NjYgMy4wOSAxOS4zMzEtNC4zMSAxOS4zMzEtNC4zMSIgc3Ryb2tlPSIjMDAwIiBzdHJva2Utd2lkdGg9IjEuMjUiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIvPjwvZz48L3N2Zz4=');*/
        opacity: 0.06;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        height:100%;
        position: absolute;

    }
</style>
<input type="text" class="form-control" name="userID1" id="userID1" value="<?=(isset($_SESSION['ses_user_id']))?$_SESSION['ses_user_id']:''?>" placeholder="UserID 1">
<input type="text" class="form-control" name="userID2" id="userID2" value="<?=(isset($_SESSION['ses_user_id2']))?$_SESSION['ses_user_id2']:''?>" placeholder="UserID 2">
<div class="jumbotron m-0 p-0 bg-transparent">
    <div class="row m-0 p-0 position-relative">
        <div class="col-12 p-0 m-0 position-absolute" style="right: 0px;">
            <div class="card border-0 rounded" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.10), 0 6px 10px 0 rgba(0, 0, 0, 0.01); overflow: hidden; height: 100vh;">

                <div class="card-header p-1 bg-light border border-top-0 border-left-0 border-right-0" style="color: rgba(96, 125, 139,1.0);">

                    <img class="rounded float-left" style="width: 50px; height: 50px;" src="https://i.pinimg.com/736x/5c/24/69/5c24695df36eee73abfbdd8274085ecd--cute-anime-guys-anime-boys.jpg" />

                    <h6 class="float-left" style="margin: 0px; margin-left: 10px;"> Yusuf Bulgurcu <i class="fa fa-check text-primary" title="Onaylanmış Hesap!" aria-hidden="true"></i> </br><small> İstanbul, TR </small></h6>

                    <div class="dropdown show">

                        <a id="dropdownMenuLink" data-toggle="dropdown" class="btn btn-sm float-right text-secondary" role="button"><h5><i class="fa fa-ellipsis-h" title="Ayarlar!" aria-hidden="true"></i>&nbsp;</h5></a>

                        <div class="dropdown-menu dropdown-menu-right border p-0" aria-labelledby="dropdownMenuLink">

                            <a class="dropdown-item p-2 text-secondary" href="#"> <i class="fa fa-user m-1" aria-hidden="true"></i> Profile </a>
                            <hr class="my-1"></hr>
                            <a class="dropdown-item p-2 text-secondary" href="#"> <i class="fa fa-trash m-1" aria-hidden="true"></i> Delete </a>

                        </div>
                    </div>

                </div>

                <div class="card bg-sohbet border-0 m-0 p-0" style="height: 100vh;">
                    <div id="messagesDiv" class="card border-0 m-0 p-0 position-relative bg-transparent" style="overflow-y: auto; height: 100vh;">

<!--                        <div class="balon1 p-2 m-0 position-relative" data-is="You - 3:20 pm">-->
<!---->
<!--                            <a class="float-right"> Hey there! What's up? </a>-->
<!---->
<!--                        </div>-->
<!---->
<!--                        <div class="balon2 p-2 m-0 position-relative" data-is="Yusuf - 3:22 pm">-->
<!---->
<!--                            <a class="float-left"> Checking out iOS7 you know.. </a>-->
<!---->
<!--                        </div>-->
<!--                        <div id="messagesDiv">-->
<!--                        </div>-->




                    </div>
                </div>

                <div class="w-100 card-footer p-0 bg-light border border-bottom-0 border-left-0 border-right-0">


                        <div class="row m-0 p-0">
                            <div class="col-9 m-0 p-1">

                                <input name="h_maxID" type="hidden" id="h_maxID" value="0">
                                <input type="text" class="mw-100 border rounded form-control" name="msg" id="msg" placeholder="Type a message...">

                            </div>
                            <div class="col-3 m-0 p-1">
                                <button class="btn btn-outline-secondary rounded border w-100"title="Gönder!" style="padding-right: 16px;"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>

                            </div>
                        </div>


                </div>

            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    var load_chat; // กำหนดตัวแปร สำหรับเป็นฟังก์ชั่นเรียกข้อมูลมาแสดง
    var first_load=1; // กำหนดตัวแปรสำหรับโหลดข้อมูลครั้งแรกให้เท่ากับ 1
    load_chat = function(userID){
        var maxID = $("#h_maxID").val(); // chat_id ล่าสุดที่แสดง
        $.post("ajax_chat.php",{
            viewData:first_load,
            userID:userID,
            maxID:maxID
        },function(data){
            if(first_load==1){ // ถ้าเป็นการโหลดครั้งแรก ให้ดึงข้อมูลทั้งหมดที่เคยบันทึกมาแสดง
                for(var k=0;k<data.length;k++){ // วนลูปแสดงข้อความ chat ที่เคยบันทึกไว้ทั้งหมด
                    if(parseInt(data[0].max_id)>parseInt(maxID)){ // เทียบว่าข้อมูล chat_id .ใหม่กว่าที่แสดงหรือไม่
                        $("#h_maxID").val(data[k].max_id); // เก็บ chat_id เป็น ค่าล่าสุด
                        // แสดงข้อความการ chat มีการประยุกต์ใช้ ตำแหน่งข้อความ เพื่อจัด css class ของข้อความที่แสดง
                        $("#messagesDiv").append("<div class=\"balon"+data[k].data_number+" p-2 m-0 position-relative\" data-is=\""+data[k].data_date+"\">" +
                            "<a class=\"float-"+data[k].data_align+"\">"+data[k].data_msg+"</a>" +
                            "</div>");
                        // $("#messagesDiv").append("<a class=\"float-"+data[k].data_align+"\">"+data[k].data_msg+"</a>");
                        // $("#messagesDiv").append("</div>");

                        $("#messagesDiv")[0].scrollTop = $("#messagesDiv")[0].scrollHeight; // เลือน scroll ไปข้อความล่าสุด
                        console.log(data[k].data_msg);
                    }
                };
            }else{ // ถ้าเป็นข้อมูลที่เพิ่งส่งไปล่าสุด
                if(parseInt(data[0].max_id)>parseInt(maxID)){ // เทียบว่าข้อมูล chat_id .ใหม่กว่าที่แสดงหรือไม่
                    $("#h_maxID").val(data[0].max_id); // เก็บ chat_id เป็น ค่าล่าสุด
                    // แสดงข้อความการ chat มีการประยุกต์ใช้ ตำแหน่งข้อความ เพื่อจัด css class ของข้อความที่แสดง
                    $("#messagesDiv").append("<div class=\"balon"+data[0].data_number+" p-2 m-0 position-relative\" data-is=\""+data[0].data_date+"\">" +
                        "<a class=\"float-"+data[0].data_align+"\">"+data[0].data_msg+"</a>" +
                        "</div>");

                    $("#messagesDiv")[0].scrollTop = $("#messagesDiv")[0].scrollHeight;   // เลือน scroll ไปข้อความล่าสุด
                    console.log(data[0].data_msg);
                }
            }
            first_load++;// บวกค่า first_load
        });
    }
    // กำหนดให้ทำงานทกๆ 2.5 วินาทีเพิ่มแสดงข้อมูลคู่สนทนา
    setInterval(function(){
        var userID = $("#userID2").val(); // id user ของผู้รับ
        load_chat(userID); // เรียกใช้งานฟังก์ช่นแสดงข้อความล่าสุด
    },2500);
    $(function(){


        /// เมื่อพิมพ์ข้อความ แล้วกดส่ง
        $("#msg").keypress(function (e) { // เมื่อกดที่ ช่องข้อความ
            if (e.keyCode == 13) { // ถ้ากดปุ่ม enter
                var user1 = $("#userID1").val(); // เก็บ id user  ผู้ใช้ที่ส่ง
                var user2 = $("#userID2").val(); // เก็บ id user  ผู้ใช้ที่รับ
                var msg = $("#msg").val();  // เก็บค่าข้อความ
                $.post("ajax_chat.php",{
                    user1:user1,
                    user2:user2,
                    msg:msg
                },function(data){
                    load_chat(user2);// เรียกใช้งานฟังก์ช่นแสดงข้อความล่าสุด
                    $("#msg").val(""); // ล้างค่าช่องข้อความ ให้พร้อมป้อนข้อความใหม่
                });

            }
        });

    });

</script>
