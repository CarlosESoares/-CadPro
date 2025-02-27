<?php 
include("C:/xampp/htdocs/app/Models/pessoaDAO.php");

if (isset($_POST["acao"]) && $_POST["acao"] == "Cadastrar") {
    if (
        isset($_POST["nome"]) && !empty(trim($_POST["nome"])) &&
        isset($_POST["sobrenome"]) && !empty(trim($_POST["sobrenome"])) &&
        isset($_POST["idade"]) && is_numeric($_POST["idade"]) &&
        isset($_POST["tipoDocumento"])
    ) {
        if ($_POST["tipoDocumento"] == "cpf") {
            if (isset($_POST["cpf"]) && !empty(trim($_POST["cpf"]))) {
                echo "Cadastro realizado com CPF!";
            } else {
                echo "Erro: CPF não preenchido.";
            }
        } elseif ($_POST["tipoDocumento"] == "cnpj") {
            if (
                isset($_POST["cnpj"]) && !empty(trim($_POST["cnpj"])) &&
                isset($_POST["razaoSocial"]) && !empty(trim($_POST["razaoSocial"]))
            ) {
                echo "Cadastro realizado com CNPJ!";
            } else {
                echo "Erro: CNPJ ou Razão Social não preenchidos.";
            }
        } else {
            echo "Erro: Tipo de documento inválido.";
        }
    } else {
        echo "Erro: Preencha todos os campos obrigatórios.";
    }
    $nome = $_POST["nome"]; 
    $sobrenome = $_POST["sobrenome"];
    $idade = isset($_POST["idade"]) ? $_POST["idade"] : null;
    $razaosocial = isset($_POST["razaosocial"]) ? $_POST["razaosocial"] : null;
    $estadocivil = isset($_POST["estadocivil"]) ? $_POST["estadocivil"] : null;
    $cnpj = isset($_POST["cnpj"]) ? $_POST["cnpj"] : null;
    $cpf = isset($_POST["cpf"]) ? $_POST["cpf"] : null;
    if (!empty($cpf)) {
        if (validarCPF($cpf)) {
            echo "CPF válido!";
        } else {
            echo "CPF inválido!";
        }
    }
    
    if (!empty($cnpj)) {
        if (validarCNPJ($cnpj)) {
            echo "CNPJ válido!";
        } else {
            echo "CNPJ inválido!";
        }
    }

    $Resposta = Cadastrar ($nome,$sobrenome,$idade,$razaosocial,$estadocivil,$cnpj,$cpf);

    if ($Resposta == true){
            echo "Cadastro completo";
            header("Location: C:User\xampp\htdocs\app\view\Menu.php");
    }else{
        echo"Cadastro erro ao acessar o banco de dados";
    }
}










function validarCNPJ($cnpj) {
    $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

    if (strlen($cnpj) != 14) {
        return false;
    }

    if (preg_match('/^(.)\1*$/', $cnpj)) {
        return false;
    }

    $multiplicador1 = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    $multiplicador2 = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

    $soma = 0;
    for ($i = 0; $i < 12; $i++) {
        $soma += $cnpj[$i] * $multiplicador1[$i];
    }
    $resto = $soma % 11;
    $digito1 = ($resto < 2) ? 0 : 11 - $resto;

    $soma = 0;
    for ($i = 0; $i < 13; $i++) {
        $soma += $cnpj[$i] * $multiplicador2[$i];
    }
    $resto = $soma % 11;
    $digito2 = ($resto < 2) ? 0 : 11 - $resto;

    if ($cnpj[12] == $digito1 && $cnpj[13] == $digito2) {
        return true;
    }
    return false;
}
function validarCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    if (strlen($cpf) != 11) {
        return false;
    }

    if (preg_match('/^(.)\1*$/', $cpf)) {
        return false;
    }

    for ($t = 9; $t < 11; $t++) {
        $d = 0;
        for ($c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$t] != $d) {
            return false;
        }
    }
    return true;
}

?>