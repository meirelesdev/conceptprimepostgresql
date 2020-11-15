<?php
require_once("classes/Sql.php");

$data = [
    'id'  => filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT),
    'first_name' => filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS),
    'last_name' => filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS),
    'zipcode' => filter_input(INPUT_POST, 'zipcode'),
    'logradouro' => filter_input(INPUT_POST, 'street'),
    'num' => filter_input(INPUT_POST, 'num', FILTER_VALIDATE_INT),
    'neighborhood' => filter_input(INPUT_POST, 'neighborhood', FILTER_SANITIZE_SPECIAL_CHARS),
    'uf' => filter_input(INPUT_POST, 'uf'),
    'complement' => filter_input(INPUT_POST, 'complement'),
    'city' => filter_input(INPUT_POST, 'city')
];
$hasID = false;
$dataOk = false;

    foreach($data as $key => $value){
        if($key == 'id' && $value > 0){
            $hasID = true;
        }
        if($key != 'id' && $value){
            $dataOk = true;
        }        
    }
    if( $hasID ){
       if($dataOk){
            $sql = new Sql();        
            $sql = $sql->updateData($id, $data);
            header("Location: / ");
            exit;
        }        
    }
    if( $dataOk ){
        $sql = new Sql();
        $sql = $sql->insertData($data);
        if(!$sql){
            header("Location: /form.php");
            exit;
        }
        header("Location: /");
        exit;
    }
header("Location: / form.php");
exit;

?>