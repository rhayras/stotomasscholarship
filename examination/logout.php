<?php
session_start();

$_SESSION['studentId'] = "";
header("Location:../examination/");