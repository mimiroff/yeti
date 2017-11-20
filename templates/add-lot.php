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
  <form class="form form--add-lot container <?=$classname;?>" action="../add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
    <?php $classname = isset($errors['lot-name']) ? 'form__item--invalid' : '';
    $value = isset($item['lot-name']) ? $item['lot-name'] : '';
    $error_message = isset($errors['lot-name']) ? $errors['lot-name'] : '';?>
      <div class="form__item <?=$classname;?>"> <!-- form__item--invalid -->
        <label for="lot-name">Наименование</label>
        <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?=$value;?>" required>
        <span class="form__error"><?=$error_message;?></span>
      </div>
      <?php $classname = isset($errors['category']) ? 'form__item--invalid' : '';
      $value = isset($item['category']) ? $item['category'] : '';
      $error_message = isset($errors['category']) ? $errors['category'] : '';
      $attr = (!$value) ? 'selected' : '';?>
      <div class="form__item <?=$classname;?>">
        <label for="category">Категория</label>
        <select id="category" name="category" required>
          <option <?=$attr?>>Выберите категорию</option>
          <?php
            $cur_element = 0;
            while ($cur_element < $element_count) { 
              $attr = ($value == $categories[$cur_element]) ? 'selected' : '';?>
          <option <?=$attr;?>><?=$categories[$cur_element];?></option>
          <?php $cur_element++; } ?>       
        </select>
        <span class="form__error"><?=$error_message;?></span>
      </div>
    </div>
    <?php $classname = isset($errors['message']) ? 'form__item--invalid' : '';
    $value = isset($item['message']) ? $item['message'] : '';
    $error_message = isset($errors['message']) ? $errors['message'] : '';?>
    <div class="form__item form__item--wide <?=$classname;?>">
      <label for="message">Описание</label>
      <textarea id="message" name="message" placeholder="Напишите описание лота" required><?=$value;?></textarea>
      <span class="form__error"><?=$error_message;?></span>
    </div>
    <div class="form__item form__item--file"> <!-- form__item--uploaded -->
      <label>Изображение</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
        </div>
      </div>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" name="file" id="photo2" value="">
        <label for="photo2">
          <span>+ Добавить</span>
        </label>
      </div>
    </div>
    <div class="form__container-three">
    <?php $classname = isset($errors['lot-rate']) ? 'form__item--invalid' : '';
    $value = isset($item['lot-rate']) ? $item['lot-rate'] : '';
    $error_message = isset($errors['lot-rate']) ? $errors['lot-rate'] : '';?>
      <div class="form__item form__item--small <?=$classname;?>">
        <label for="lot-rate">Начальная цена</label>
        <input id="lot-rate" type="number" name="lot-rate" placeholder="0" value="<?=$value;?>" required>
        <span class="form__error"><?=$error_message;?></span>
      </div>
      <?php $classname = isset($errors['lot-step']) ? 'form__item--invalid' : '';
      $value = isset($item['lot-step']) ? $item['lot-step'] : '';
      $error_message = isset($errors['lot-step']) ? $errors['lot-step'] : '';?>
      <div class="form__item form__item--small <?=$classname;?>">
        <label for="lot-step">Шаг ставки</label>
        <input id="lot-step" type="number" name="lot-step" placeholder="0" value="<?=$value;?>" required>
        <span class="form__error"><?=$error_message;?></span>
      </div>
      <?php $classname = isset($errors['lot-date']) ? 'form__item--invalid' : '';
      $value = isset($item['lot-date']) ? $item['lot-date'] : '';
      $error_message = isset($errors['lot-date']) ? $errors['lot-date'] : '';?>
      <div class="form__item <?=$classname;?>">
        <label for="lot-date">Дата окончания торгов</label>
        <input class="form__input-date" id="lot-date" type="date" name="lot-date" value="<?=$value;?>" required>
        <span class="form__error"><?=$error_message;?></span>
      </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
  </form>