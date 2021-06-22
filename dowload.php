<?php
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename('dowload.txt'));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize('dowload.txt'));
    readfile('dowload.txt');
    exit;
?>
