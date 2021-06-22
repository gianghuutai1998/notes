<?php
session_start();

    if (!isset($_SESSION['user'])) {
        header('location: login.php');
        die();
    }

    require_once('dbfunction.php');

    // Upload ghi chú bằng file txt 
    if(isset($_POST['upload'])){
        if(isset($_FILES['textfile'])){
            if($_FILES['textfile']['error'] > 0){
                echo "File Error!";
            } else {
                $dir = basename($_FILES['textfile']['name']);
                move_uploaded_file($_FILES['textfile']['tmp_name'], $dir);
                $f = fopen($dir, 'r');
                $read = file_get_contents($dir);
                fclose($f);
                unlink($dir);
                $ftitle = explode('.txt', $_FILES['textfile']['name']);
                addNote($_SESSION['user'], $ftitle[0], $read);
            }
        } else echo "Choose file upload!";
    }

    $list = getNotes($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Notes</title>
    
    <link rel="stylesheet" href="note.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#"><b>NOTES PAGE</b></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto"></ul>
                <form class="form-inline my-2 my-lg-0" method="get" action="logout.php">
                    <label><?php echo "Hello, " . $_SESSION['user'] ."!   "?></label>
                    <button on class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
                </form>
            </div>
        </nav>
    </div>
    
    <div>
        <form action="add-update.php" method="post" >
            <div class="data">
                <table class="table">
                    <thead class="thead-dark">
                        <tr id="tr">
                            <th scope="col"> # </th>
                            <th scope="col"> Tiêu đề </th>
                            <th scope="col"> Nội dung </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($list as $row)
                            echo "  <tr> 
                                        <td class='checkBox'><input name='checkBox[]' value='".$row['id']."' type='checkbox'></td> 
                                        <td class='title'>" . $row['title'] . "</td>
                                        <td class='content'>" . $row['content'] . "</td>
                                    </tr>";
                    ?>
                    </tbody>
                </table>
            </div><br>
            <div>
                <input id="xx" class='btn btn-primary' type="submit" name="add" value="Add">
                <input id="xx" class='btn btn-primary' type="submit" name="update" value="Update">
                <input id="xx" class='btn btn-primary' type="submit" name="delete" value="Delete">
                <input id="xx" class='btn btn-primary' type="submit" name="dowload" value="Dowload">
            </div>
        </form>
        <hr>
        <div>
            <form enctype="multipart/form-data" action="#" method="post">
                <input type="file" name="textfile">
                <input id="xx" class='btn btn-primary' type="submit" name="upload" value="Upload">
            </form>
        </div>
        
    </div>
</body>
</html>   
