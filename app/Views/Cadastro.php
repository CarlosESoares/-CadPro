<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pessoa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000000;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #000000;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(30, 144, 255, 0.5);
            width: 350px;
            border: 2px solid #1E90FF;
        }
        h2 {
            text-align: center;
            color: #1E90FF;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
            color: #1E90FF;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #1E90FF;
            border-radius: 5px;
            background-color: #000000;
            color: white;
            outline: none;
        }
        button {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            background-color: #1E90FF;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0073e6;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
 
<div class="container">
    <h2>Cadastro de Pessoa</h2>
    
    <form action="/app/Controllers/PessoaController.php" method="post">
    <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="sobrenome">Sobrenome:</label>
        <input type="text" id="sobrenome" name="sobrenome" required>

        <label for="tipoDocumento">Tipo de Documento:</label>
        <select id="tipoDocumento" name="tipoDocumento" onchange="toggleDocumento()">
            <option value="cpf">CPF</option>
            <option value="cnpj">CNPJ</option>
        </select>

        <label for="cpf" id="cpfLabel">CPF:</label>
        <input type="text" id="cpf" name="cpf" maxlength="14" placeholder="000.000.000-00">

        <label for="cnpj" id="cnpjLabel" class="hidden">CNPJ:</label>
        <input type="text" id="cnpj" name="cnpj" maxlength="18" placeholder="00.000.000/0000-00" class="hidden">

        <label for="razaoSocial" id="razaoSocialLabel" class="hidden">Razão Social:</label>
        <input type="text" id="razaoSocial" name="razaoSocial" class="hidden">

        <label for="idade">Idade:</label>
        <input type="number" id="idade" name="idade" min="0" required>

        <label for="estadoCivil">Estado Civil:</label>
        <select id="estadoCivil" name="estadoCivil">
            <option value="solteiro">Solteiro(a)</option>
            <option value="casado">Casado(a)</option>
            <option value="divorciado">Divorciado(a)</option>
            <option value="viuvo">Viúvo(a)</option>
        </select>

        <button type="submit" value="Cadastrar">Cadastrar</button>
    </form>
</div>

<script>
    function toggleDocumento() {
        let tipo = document.getElementById("tipoDocumento").value;
        let cpfField = document.getElementById("cpf");
        let cpfLabel = document.getElementById("cpfLabel");
        let cnpjField = document.getElementById("cnpj");
        let cnpjLabel = document.getElementById("cnpjLabel");
        let razaoSocialField = document.getElementById("razaoSocial");
        let razaoSocialLabel = document.getElementById("razaoSocialLabel");

        if (tipo === "cpf") {
            cpfField.classList.remove("hidden");
            cpfLabel.classList.remove("hidden");
            cnpjField.classList.add("hidden");
            cnpjLabel.classList.add("hidden");
            razaoSocialField.classList.add("hidden");
            razaoSocialLabel.classList.add("hidden");
        } else {
            cpfField.classList.add("hidden");
            cpfLabel.classList.add("hidden");
            cnpjField.classList.remove("hidden");
            cnpjLabel.classList.remove("hidden");
            razaoSocialField.classList.remove("hidden");
            razaoSocialLabel.classList.remove("hidden");
        }
    }
</script>

</body>
</html>
