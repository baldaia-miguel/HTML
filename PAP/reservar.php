
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $data = $_POST["data"];
    $hora = $_POST["hora"];
    $pessoas = $_POST["pessoas"];

    // 1. Guardar no ficheiro
    $linha = "$nome, $email, $telefone, $data, $hora, $pessoas\n";
    file_put_contents("reservas.txt", $linha, FILE_APPEND);

    // 2. Enviar e-mail para o restaurante
    $destinatario = "miguelbceprosec@gmail.com"; // <-- muda para o e-mail do restaurante
    $assunto = "Nova Reserva de Mesa";
    $mensagem = "Nova reserva recebida:\n\n" .
                "Nome: $nome\n" .
                "Email: $email\n" .
                "Telefone: $telefone\n" .
                "Data: $data\n" .
                "Hora: $hora\n" .
                "Nº de pessoas: $pessoas\n";

    $cabecalhos = "From: noreply@4platanos.com\r\n"; // ou outro domínio teu

    if (mail($destinatario, $assunto, $mensagem, $cabecalhos)) {
        echo "<h2>Reserva feita com sucesso!</h2>";
        echo "<p>Obrigado, $nome. Em breve receberá uma confirmação.</p>";
    } else {
        echo "<h2>Erro ao enviar e-mail.</h2>";
        echo "<p>Por favor tente novamente mais tarde.</p>";
    }
}
?> v