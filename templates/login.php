<?= renderTemplate('templates/nav.php', ['categories' => $categories]); ?>
<form class="form container" action="" method="post"> <!-- form--invalid -->
    <h2>Вход</h2>
    <div class="form__item <?=isset($errors['email'])? "form__item--invalid" : "";?>">
        <label for="email">E-mail*</label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=isset($form['email'])? $form['email'] : '';?>">
        <span class="form__error"><?=isset($errors['email'])? $errors['email'] : "";?></span>
    </div>
    <div class="form__item form__item--last <?=isset($errors['password'])? "form__item--invalid" : "";?>">
        <label for="password">Пароль*</label>
        <input id="password" type="text" name="password" placeholder="Введите пароль">
        <span class="form__error"><?=isset($errors['password'])? $errors['password'] : "";?></span>
    </div>
    <button type="submit" class="button">Войти</button>
</form>