<?php
    include_once('dbquery.php');

    ### USERS #################################################
    
    // function getUsers(){
    //     $sql = "SELECT username FROM user";
    //     $result = executeResult($sql);
    //     return $result;
    // }

    // function deleteUser($username){
    //     if(userExist($username)){
    //         deleteAllNoteOfUser($username);
    //         $sql = "DELETE FROM user WHERE username = '$username'";
    //         execute($sql);
    //     }
    // }
    
    function addUser($username, $password){
        $sql = "INSERT INTO user(username, pass) value ('$username', '$password')";
        execute($sql);
    }

    function userExist($username){
        $sql = "SELECT username FROM user WHERE username = '$username'";
        $result = executeResult($sql, true);
        if(empty($result)) return false;
        return true;
    }
    
    function signUp($username, $password, $confirm){
        if($password != $confirm){
            echo "<script>alert('Password và Confirm password không khớp!')</script>";
            return false;
        }
        if(userExist($username)){
            echo "<script>alert('Username đã tồn tại!')</script>";
            return false;
        }
        addUser($username, sha1($password));
        return true;
    }

    function login($username, $password){
        if(!userExist($username)) return false;
        $sql = "SELECT pass FROM user WHERE username = '$username'";
        $result = executeResult($sql, true);
        if($result['pass'] == sha1($password)) return true;
        return false;
    }

    ### NOTES #################################################
    
    function getNotes($username){
        $sql = "SELECT * FROM note WHERE username = '$username'";
        return executeResult($sql);
    } 
    
    function getNote($id){
        $sql = "SELECT * FROM note WHERE id = '$id'";
        return executeResult($sql, true);
    }
    
    function addNote($username, $title, $content){
        $sql = "INSERT INTO note(title, content, username) 
                VALUE ('$title', '$content', '$username')";
        execute($sql);
    }
    
    function updateNote($id, $title, $content){
        $sql = "UPDATE note SET title = '$title', content = '$content' WHERE id = '$id'";
        execute($sql);
    }
    
    function deleteNote($id){
        $sql = "DELETE FROM note WHERE id = '$id'";
        execute($sql);
    }
    
    function deleteAllNoteOfUser($username){
        $sql = "DELETE FROM note WHERE username = '$username'";
        execute($sql);
    }

    function search($username, $key = ''){
        if($key != ''){
            $sql = "SELECT * FROM note WHERE (id LIKE '%$key%' OR title LIKE '%$key%' 
                OR content LIKE '%$key%') AND username = '$username'";
        } else {
            $sql = "SELECT * FROM note WHERE username = '$username'";
        }
        return executeResult($sql);
    }
    
    ### FILE ##################################################
    
    function createFile($txt){
        $f = fopen('dowload.txt', 'w');
        fwrite($f, $txt);
        fclose($f);
    }   
?>