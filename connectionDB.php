<?php
$con = mysqli_connect("localhost", "root" , "" , "jpy");

if (mysqli_connect_errno()) {
    echo "خطاء في الإتصال بقاعدة البيانات " . mysqli_connect_errno();
}
?>