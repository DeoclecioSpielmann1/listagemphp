<?php

require __DIR__ . '/config.php';


$busca = trim($_GET['q'] ?? '');

$sql = "SELECT * FROM alunos WHERE (:q = '' OR nome LIKE :like) ORDER BY id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':q' => $busca,
    ':like' => "%$busca%"
]);

$alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Alunos</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

<h1>Listagem de Alunos</h1>

<table border="1" cellpadding="7">
    <?php
    foreach (alunos as $aluno) {
        ?>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Idade</th>
            <th>Email</th>
            <th>Criado em</th>
            <th>Ações</th>
        </tr> 
        <tr>
            <td><?= (int)$aluno['id'] ?></td>
            <td><?= h($aluno['nome']) ?></td>
            <td><?= (int)$aluno['Idade'] ?></td>
            <td><?= h($aluno['email']) ?></td>
            <td><?= (int)$aluno['id'] ?></td>
            
        </tr> 
    <tbody>
        <?php if (empty($alunos)): ?>
            <tr>
                <td colspan="6">Nenhum aluno encontrado.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($alunos as $aluno): ?>
                <tr>
                    <td><?= htmlspecialchars($aluno['id']) ?></td>
                    <td><?= htmlspecialchars($aluno['nome']) ?></td>
                    <td><?= htmlspecialchars($aluno['idade']) ?></td>
                    <td><?= htmlspecialchars($aluno['email']) ?></td>
                    <td><?= htmlspecialchars($aluno['criado_em']) ?></td>
                    <td>
                        <a href="editar.php?id=<?= $aluno['id'] ?>">Editar</a> |
                        <a href="excluir.php?id=<?= $aluno['id'] ?>">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>