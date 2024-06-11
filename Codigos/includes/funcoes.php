<?php 

//TODO - este é um exemplo de como vc pode organizar as funções

function documentosListar($user_id){
    global $conn;
    
    $sql = "SELECT * FROM documentos WHERE user_id = ?";
    $query = $conn->prepare($sql);    

    $query->bind_param("i", $user_id);
    $query->execute();
    $result = $query->get_result();

    return $result->fetch_all();
}

function documentosPegar($id){
    global $conn;
    
    $sql = "SELECT * FROM documentos WHERE id = ?";
    $query = $conn->prepare($sql);    

    $query->bind_param("i", $id);
    $query->execute();
    $query->get_result();
    
    return $query->fetch();
}