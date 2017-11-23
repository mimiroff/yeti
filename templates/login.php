<nav class="nav">
    <?php
    $element_count = count($categories);
    $cur_element = 0;
    ?>
    <ul class="nav__list container">
        <?php while ($cur_element < $element_count) { ?>
            <li class="nav__item">
                <a href=""><?=$categories[$cur_element];?></a>
            </li>
            <?php $cur_element++; } ?>
    </ul>
</nav>
<?php $classname = isset($errors) ? 'form--invalid' : '';?>
<form class="form container" action="../login.php" method="post" <?=$classname;?>> <!-- form--invalid -->
    <h2>Вход</h2>
    <?php $classname = isset($errors['email']) ? 'form__item--invalid' : '';
    $value = isset($fields['email']) ? $fields['email'] : '';
    $error_message = isset($errors['email']) ? $errors['email'] : '';?>
    <div class="form__item <?=$classname;?>"> <!-- form__item--invalid -->
        <label for="email">E-mail*</label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=$value;?>">
        <span class="form__error"><?=$error_message;?></span>
    </div>
    <?php $classname = isset($errors['password']) ? 'form__item--invalid' : '';
    $error_message = isset($errors['password']) ? $errors['password'] : '';?>
    <div class="form__item form__item--last <?=$classname;?>">
        <label for="password">Пароль*</label>
        <input id="password" type="password" name="password" placeholder="Введите пароль">
        <span class="form__error"><?=$error_message;?></span>
    </div>
    <button type="submit" class="button">Войти</button>
</form>