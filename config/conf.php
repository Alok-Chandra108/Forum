<?php
try {

    define("HOST","localhost");
    define("DBNAME","forum");
    define("USER","root");
    define("PASS","");

    $conn = new PDO("mysql:host=".HOST.";dbname=".DBNAME."",USER,PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // if($conn==TRUE){
    //     echo"";
    // }else{
    //     echo "error";
    // }
        
} catch (PDOException $Exception) {
   echo $Exception->getMessage();
}
?>