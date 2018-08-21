<?php $classname = isset($errors) ? 'form--invalid' : '';?>
<form class="form container" action="sign-up.php" method="post" enctype="multipart/form-data" <?=$classname;?>> <!-- form--invalid -->
    <h2>Регистрация нового аккаунта</h2>
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
    <div class="form__item <?=$classname;?>">
        <label for="password">Пароль*</label>
        <input id="password" type="text" name="password" placeholder="Введите пароль">
        <span class="form__error"><?=$error_message;?></span>
    </div>
    <?php $classname = isset($errors['name']) ? 'form__item--invalid' : '';
    $value = isset($fields['name']) ? $fields['name'] : '';
    $error_message = isset($errors['name']) ? $errors['name'] : '';?>
    <div class="form__item <?=$classname;?>">
        <label for="name">Имя*</label>
        <input id="name" type="text" name="name" placeholder="Введите имя" value="<?=$value;?>">
        <span class="form__error"><?=$error_message;?></span>
    </div>
    <?php $classname = isset($errors['message']) ? 'form__item--invalid' : '';
    $value = isset($fields['message']) ? $fields['message'] : '';
    $error_message = isset($errors['message']) ? $errors['message'] : '';?>
    <div class="form__item <?=$classname;?>">
        <label for="message">Контактные данные*</label>
        <textarea id="message" name="message" placeholder="Напишите как с вами связаться"><?=$value;?></textarea>
        <span class="form__error"><?=$error_message;?></span>
    </div>
    <?php $classname = isset($errors['avatar']) ? 'form__item--invalid' : '';
    $error_message = isset($errors['avatar']) ? $errors['avatar'] : '';?>
    <div class="form__item form__item--file form__item--last <?=$classname;?>">
        <label>Аватар</label>
        <div class="preview">
            <button class="preview__remove" type="button">x</button>
            <div class="preview__img">
                <img src="img/avatar.jpg" width="113" height="113" alt="Ваш аватар">
            </div>
        </div>
        <div class="form__input-file">
            <input class="visually-hidden" type="file" name="avatar" id="photo2" value="">
            <label for="photo2">
                <span>+ Добавить</span>
            </label>
        </div>
        <span class="form__error"><?=$error_message;?></span>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Зарегистрироваться</button>
    <a class="text-link" href="login.php">Уже есть аккаунт</a>
</form>