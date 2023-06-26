<?php
$connections = mysqli_connect("localhost", "root", "", "rethink");

if (mysqli_connect_errno()) {
  echo "failed to connect to MYSQL: " . mysqli_connect_error();
}