    <section class="lot-item container">
        <h2><?=$item['name'];?></h2>
        <div class="lot-item__content">
            <div class="lot-item__left">
                <div class="lot-item__image">
                    <img src=<?=$item['picture'];?> width="730" height="548" alt="<?=$item['name'];?>">
                </div>
                <p class="lot-item__category">Категория: <span><?=$item['category'];?></span></p>
                <p class="lot-item__description"><?=$item['description'];?></p>
            </div>
            <div class="lot-item__right">
                <?php if ($user && !$is_bet && !$is_author && $is_time_left): ?>
                <div class="lot-item__state">
                    <div class="lot-item__timer timer">
                        <?=get_time_left($item['expire_date']);?>
                    </div>
                    <div class="lot-item__cost-state">
                        <div class="lot-item__rate">
                            <span class="lot-item__amount">Текущая цена</span>
                            <span class="lot-item__cost"><?=number_format($item['price'], 0, ',', ' ');?></span>
                        </div>
                        <div class="lot-item__min-cost">
                            Мин. ставка
                            <span><?=number_format($item['price'] + $item['step'], 0, ',', ' ');?></span>
                        </div>
                    </div>
                    <?php $classname = isset($errors) ? 'form--invalid' : '';?>
                    <form class="lot-item__form <?=$classname;?>" action="lot.php" method="post">
                        <?php $classname = isset($errors['cost']) ? 'form__item--invalid' : '';
                        $error_message = isset($errors['cost']) ? $errors['cost'] : '';?>
                        <p class="lot-item__form-item <?=$classname;?>">
                            <label for="cost">Ваша ставка</label>
                            <input id="cost" type="number" name="cost"
                            placeholder="<?=number_format($item['price'] + $item['step'], 0, ',', ' ');?>">
                            <span class="form__error"><?=$error_message;?></span>
                        </p>
                        <input type="hidden" name="lot-id" value="<?=$item['id'];?>">
                        <button type="submit" class="button">Сделать ставку</button>
                    </form>
                </div>
                <?php endif;?>
                <div class="history">
                    <?php
                        $bets_count = count($bets);
                        $cur_bet = 0;
                    ?>
                    <h3>История ставок (<span><?=$bets_count?></span>)</h3>
                    <table class="history__list">
                        <?php while ($cur_bet < $bets_count) { ?>
                            <tr class="history__item">
                                <td class="history__name"><?=$bets[$cur_bet]['name'];?></td>
                                <td class="history__price"><?=number_format($bets[$cur_bet]['cost'], 0, ',', ' ') . ' р';?></td>
                                <td class="history__time"><?=get_past_time($bets[$cur_bet]['date']);?></td>
                            </tr>
                        <?php $cur_bet++; } ?>
                    </table>
                </div>
            </div>
        </div>
    </section>