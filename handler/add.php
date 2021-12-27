<?php

require "../dbBroker.php";
require "../model/prijava.php";

if(isset($_POST['naziv']) && isset($_POST['datum']) 
&& isset($_POST['mesto']) && isset($_POST['organizator'])){
    $prijava = new Prijava(null,$_POST['naziv'],$_POST['datum'],$_POST['mesto'],$_POST['organizator'] );
    $status = Prijava::add($prijava, $conn);

    if($status){
        echo 'Success';
    }else{
        echo $status;
        echo 'Failed';
    }
}


?>


