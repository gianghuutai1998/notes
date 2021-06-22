<?php  
    include_once('config.php');

    function createDatabase(){
        $conn = mysqli_connect(SERVER, USERNAME, PASSWORD);
        mysqli_set_charset($conn, 'utf-8');

        $sql = "CREATE DATABASE IF NOT EXISTS ".DATABASE;
        mysqli_query($conn, $sql);
        mysqli_close($conn);
    }
    
    // Thực hiện truy vấn DELETE, INSERT, UPDATE 
    function execute($sql){
        $conn = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
        mysqli_query($conn, $sql);
        mysqli_close($conn);
    }

    // Thực hiện truy vấn SELECT($isSingle = true khi truy vấn trả về 1 dòng duy nhất)
    // Dạng trả về khi $isSingle = true là Array([key] => value)
    // Dạng trả về khi $isSingle = false là Array[Array([key] => value)]
    function executeResult($sql, $isSingle = false){
        $conn = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
        $result =  mysqli_query($conn, $sql);

        if($isSingle){
            return $result->fetch_assoc();
        } else {
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $list[] = $row;
                }
                return $list;
            }
            return "No record!";
        }
        mysqli_close($conn);
    }
?>