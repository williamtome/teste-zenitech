<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Novo Usuário</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <h1>Novo Usuário</h1>
    <?php if (isset($errors['general'])): ?>
        <div class="alert alert-danger">
            <?= $errors['general'] ?>
        </div>
    <?php endif; ?>
    <form method="POST" action="/users/store" enctype="multipart/form-data">
        <label for="name">Nome</label>
        <input type="text" name="name" id="name">
        <?php if (isset($errors['name'])): ?>
            <div class="error-message"><?= $errors['name'] ?></div>
        <?php endif; ?>
        <br><br>
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email">
        <?php if (isset($errors['email'])): ?>
            <div class="error-message"><?= $errors['email'] ?></div>
        <?php endif; ?>
        <br><br>
        <label for="birth_date">Data de nascimento</label>
        <input type="date" name="birth_date" id="birth_date">
        <?php if (isset($errors['birth_date'])): ?>
            <div class="error-message"><?= $errors['birth_date'] ?></div>
        <?php endif; ?>
        <br><br>
        <label for="image">Foto</label>
        <input type="file" name="image" id="image">
        <?php if (isset($errors['image'])): ?>
            <div class="error-message"><?= $errors['file'] ?></div>
        <?php endif; ?>
        <br><br>
        <button type="submit">Cadastrar</button>
    </form>
<!--<script>-->
<!--    document.querySelector('form').addEventListener('submit', function (ev) {-->
<!--        ev.preventDefault()-->
<!--    })-->
<!--</script>-->
</body>
</html>
