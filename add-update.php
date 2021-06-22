<?php
    session_start();
    if (!$_SESSION['user']) {
        header('location: login.php');
        die();
    }

    require_once('db/dbfunction.php');
    
    // Redirect parameter index.php
    $id = $_POST['checkBox'];
    $countCb = count($_POST['checkBox']);
    $data = getNote($id[0]);

    // Hủy $id khi chọn button Add
    if(isset($_POST['add'])) $id = 0;   
    
    // Nếu số checkbox được chọn khác 1 khi chọn button Update -> Quay lại index.php
    if(($countCb != 1) and (isset($_POST['update']))){
        header('location: index.php');
        die();
    }

    // Khi chọn button Delete -> Xóa tương ứng với các dòng đã chọn -> Quay lại index.php
    if(isset($_POST['delete'])){
        foreach($id as $x) deleteNote($x);
        header('location: index.php');
        die();
    }

    // Dowload file đã chọn ở index.php
    if(isset($_POST['dowload'])){
        if($countCb == 1){
            $n = getNote($id[0]);
            $txt = $n['title'] ."\n". $n['content'];
            createFile($txt);
            header('location: dowload.php');
            die();
        } else {
            header('location: index.php');
            die();
        }
    }
    // Lấy key tìm kiếm
    if(isset($_POST['search'])){
        $searchKey = $_POST['search'];
        header('location: index.php?searchKey='.$_POST['searchKey']);
        die();
    }

    //Redirect parameter #
    $idUpdate = $_POST['idUpdate'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    if ($title != '') {
        if ($idUpdate > 0) {
            updateNote($idUpdate, $title, $content);
        } else {
            addNote($_SESSION['user'], $title, $content);
        }
        header('location: index.php');
        die();
    }
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add - Update</title>
    
    <link rel="stylesheet" href="note.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php"><b>NOTES PAGE</b></a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto"></ul>
            <form class="form-inline my-2 my-lg-0" method="get" action="logout.php">
                <label><?php echo "Hello, " . $_SESSION['user'] ."!   "?></label>
                <button on class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
            </form>
        </div>
    </nav>
    <div class="form-group">
        <form action="#" method="post">
            <input type="text" name="idUpdate" hidden value="<?php echo $id[0]; ?>"><br>
            <label> Title </label>
            <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Nhập tiêu đề" value="<?php echo $data['title']; ?>"><br><br>
            <label> Content </label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="12" placeholder="Nhập nội dung" name="content"><?php echo $data['content']; ?></textarea><br>
            <input id='xx' class="btn btn-primary" type="submit" value="Save">
        </form><br>
    </div>
</body>
</html>