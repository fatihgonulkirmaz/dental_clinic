<?php
session_start();
if (isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] == "admin") {
        header("Location: /yenisite/admin.php");
    } elseif ($_SESSION['user_role'] == "doktor") {
        header("Location: /yenisite/doktor.php");
    }
    elseif ($_SESSION['user_role'] == "sekreter") {
        header("Location: /yenisite/sekreter.php");
    }
    else {
        header("Location: /yenisite");
    }
}
else {
    header("Location: /yenisite");
}
