<?php
    setcookie("user", "Polinema", time() + 3600);
    echo $_COOKIE["user"];
?>