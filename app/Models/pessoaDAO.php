<?php
include("/app/Database/database");
function Cadastrar ($nome,$sobrenome,$idade,$razaosocial,$estadocivil,$cnpj,$cpf){
    $db = conecta();
    
    $sql = " insert into clientes (Nome,Sobrenome,Idade,CPF,CNPJ,RAZAOSOCIAL,EstadoCivil) Values (?,?,?,?,?,?,?)";
    $stmt=$db -> prepare($sql);
    $stmt->bindValue(1,$nome);
    $stmt->bindValue(2,$sobrenome);
    $stmt->bindValue(3,$idade);
    $stmt->bindValue(4,$razaosocial);
    $stmt->bindValue(5,$estadocivil);
    $stmt->bindValue(6,$cpf);
    $stmt->bindValue(7,$cnpj);
    $stmt->execute();

    return true;
}

?>