<?php

/******************************************
Asisten Pemrogaman 13
 ******************************************/

include("model/Template.class.php");
include("model/DB.class.php");
include("model/Pasien.class.php");
include("model/TabelPasien.class.php");
include("view/TampilPasien.php");

$tp = new TampilPasien();
$presenter = new ProsesPasien();

if(isset($_GET['id'])){
    if($presenter->delete($_GET['id']) > 0){
        echo "<script>
            alert('success!');
            document.location.href='index.php';
        </script>";
    }else{
        echo "<script>
            alert('failed!');
            document.location.href='index.php';
        </script>";
    }
}
else{
    $tp->tampil();
}