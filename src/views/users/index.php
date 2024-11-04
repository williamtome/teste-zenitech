<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<h1>Usuários</h1>

<a href="/users/create">Novo Usuário</a>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Ações</th>
    </tr>
    </thead>
    <tbody>
    <?php if (empty($users)) : ?>
        <tr>
            <td colspan="3">Não tem usuários cadastrados.</td>
        </tr>
    <?php endif; ?>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['id']) ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td>
                <a href="/users/edit/<?= $user['id'] ?>">Editar</a>
                <a href="/users/delete/<?= $user['id'] ?>">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
