<?php
    // be aware of file / directory permissions on your server
    $nombreimagen = $_GET['username'].'.'.$_GET['format'];
    move_uploaded_file($_FILES['webcam']['tmp_name'], $nombreimagen);
?>
