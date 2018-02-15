<?php
// Includes
include "../inc/functions.php";

$pageTitle = "test datatable";

// Variables nécessaires
$url = $_SERVER['REQUEST_URI'];
if (substr($url, -1) == "/")
    $rootUrl = "../..";
else
    $rootUrl = "..";

include "../inc/header.php"; ?>

<script>
    $(document).ready(function(){
        $('#myTable').DataTable();
    });
</script>

<table id="myTable">
    <tr>
        <th>id</th>
        <th>nom</th>
    </tr>
    <tr>
        <td>1</td>
        <td>2</td>
        <td>3</td>
    </tr>

</table>