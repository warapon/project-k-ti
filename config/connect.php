<?php
class db
{
    public function dev()
    {
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'agricultural';
        return array($dbhost,$dbuser,$dbpass,$dbname);
    }
    public function product()
    {
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = 'ee1122334455';
        $dbname = 'agricultural';
        return array($dbhost,$dbuser,$dbpass,$dbname);
    }
    public function connect()
    {
        $status = $this->dev();

        $dbhost = $status[0];
        $dbuser = $status[1];
        $dbpass = $status[2];
        $dbname = $status[3];


        $link = mysql_connect($dbhost,$dbuser,$dbpass);
        if(!$link){
            die("Can not access to Database".mysql_error());
        }
        mysql_select_db($dbname,$link);
        mysql_query("SET character_set_results=utf8");
        mysql_query("SET character_set_client=utf8");
        mysql_query("SET character_set_connection=utf8");

        return $link;
    }

    public function selects($sql)
    {
        $db = new db();
        $db = $db->connect();
        $result=mysql_query($sql,$db);
        return($result);
    }
    public function insert($sql)
    {
        $db = new db();
        $db = $db->connect();
        $result=mysql_query($sql,$db);
        if(!$result){
            $msg = "Error!! -> ".$result;
        }else{
            $msg = 1;
        }
        return($msg);
    }
    public function update($sql)
    {
        $db = new db();
        $db = $db->connect();
        $result=mysql_query($sql,$db);
        if(!$result){
            $msg = "Error!! -> ".$result;
        }else{
            $msg = 1;
        }
        return($msg);
    }
    public function delete($sql)
    {
        $db = new db();
        $db = $db->connect();
        $result=mysql_query($sql,$db);
        if(!$result){
            $msg = "Error!! -> ".$result;
        }else{
            $msg = 1;
        }
        return($msg);
    }
}