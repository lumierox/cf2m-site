<?php

include_once '../modele/fonctions-db.php';
if(isset($_POST["value"])){
    $value = $_POST["value"];
    $table = $_POST["table"];
    $colonne = $_POST["colonne"];
    $condition = $_POST["condition"];
    
    $update_string = "";
    
    for($i=0;$i<count($colonne);$i++){
        if($i==0)
            $update_string .= $colonne[$i]." = '".$value[$i]."'";
        else
            $update_string .= ", ".$colonne[$i]." = '".$value[$i]."'";
        
    }
    
    /*print('**************');*/
    print update($table, $update_string, "WHERE id=$condition");
    /*print('**************');
    print 'HOLA---------'.$update_string.'!-------';*/
}else{
    print "Données non arrivées ...";
}