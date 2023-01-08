<?php
$media;
$errorMessage = $statusMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // REVEBER NOTAS ENVIADAS
    $grade1 = $_POST['grade-1'];
    $grade2 = $_POST['grade-2'];
    $grade3 = $_POST['grade-3'];
    $grade4 = $_POST['grade-4'];

    // VERIFICAR SE ALGUMA NOTA ESTÁ VAZIA
    if (
        empty($grade1) ||
        empty($grade2) ||
        empty($grade3) ||
        empty($grade4)
    ) {
        $errorMessage = "Por favor, escrevas todas as notas.";
    } else {
        // VERIFICAR SE É VALOR NUMÉRICO
        if (
            !is_numeric($grade1) ||
            !is_numeric($grade2) ||
            !is_numeric($grade3) ||
            !is_numeric($grade4)
        ) {
            $errorMessage = "Por favor, escreva apenas números.";
        } else {
            // CALCULAR MÉDIA
            $media = ($grade1 + $grade2 + $grade3 + $grade4) / 4;

            // DEFINIR STATUS DO ALUNO
            if ($media <= 4) {
                $statusMessage = "Você está <span class='status-desapproved'>REPROVADO!</span> 😭";
            } elseif ($media <= 6) {
                $statusMessage = "Você está em <span class='status-recuperation'>RECUPERAÇÃO!</span> 🙁";
            } else {
                $statusMessage = "Você está <span class='status-approved'>APROVADO!</span> 😊";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcula Média</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
</head>

<body>

    <main class="container">
        <h1>Insira suas notas</h1>
        <form class="bimesters" method="POST">
            <!-- CAMPOS PARA INSERIR AS NOTAS -->
            <div class="bimester">
                <label for="">1º Bimestre:</label>
                <input class="grade" name="grade-1" type="text" autofocus <?php if (!empty($_POST["grade-1"])) echo "value='" . $_POST["grade-1"] . "'" ?>>
            </div>
            <div class="bimester">
                <label for="">2º Bimestre:</label>
                <input class="grade" name="grade-2" type="text" <?php if (!empty($_POST["grade-2"])) echo "value='" . $_POST["grade-2"] . "'" ?>>
            </div>
            <div class="bimester">
                <label for="">3º Bimestre:</label>
                <input class="grade" name="grade-3" type="text" <?php if (!empty($_POST["grade-3"])) echo "value='" . $_POST["grade-3"] . "'" ?>>
            </div>
            <div class="bimester">
                <label for="">4º Bimestre:</label>
                <input class="grade" name="grade-4" type="text" <?php if (!empty($_POST["grade-4"])) echo "value='" . $_POST["grade-4"] . "'" ?>>
            </div>
            <!--  -->
            <button class="calculate-button">Calcular Média</button>
        </form>

        <div class="result">
            <p>
            <!-- EXIBIR MENSAGEM DE ERRO -->
                <?php if ($errorMessage != '') {
                    echo $errorMessage;
            //  EXIBIR STATUS DO ALUNO
                } elseif (isset($media)) {
                    echo "Sua média é <span class='media'>$media</span><p class='status'>$statusMessage</p>";
                }
                ?>
            </p>
        </div>
    </main>

</body>

</html>