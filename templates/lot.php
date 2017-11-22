<nav class="nav">
    <?php
        if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
        }
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
    <section class="lot-item container">
        <h2><?=$item['title'];?></h2>
        <div class="lot-item__content">
            <div class="lot-item__left">
                <div class="lot-item__image">
                    <img src=<?=$item['picture_url'];?> width="730" height="548" alt="Сноуборд">
                </div>
                <p class="lot-item__category">Категория: <span><?=$item['category'];?></span></p>
                <p class="lot-item__description"><?=$item['description']  ?? 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив
                    снег
                    мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот
                    снаряд
                    отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом
                    кэмбер
                    позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется,
                    просто
                    посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла
                    равнодушным.';?></p>
            </div>
            <div class="lot-item__right">
                <?php if (isset($_SESSION['user'])): ?>
                <div class="lot-item__state">
                    <div class="lot-item__timer timer">
                        <?=$item['date'] ?? $lot_time_remaining;?>
                    </div>
                    <div class="lot-item__cost-state">
                        <div class="lot-item__rate">
                            <span class="lot-item__amount">Текущая цена</span>
                            <span class="lot-item__cost"><?=number_format($item['price'], 0, ',', ' ');?></span>
                        </div>
                        <div class="lot-item__min-cost">
                            Мин. ставка <?php if(array_key_exists('step', $item)): ?>
                            <span><?=number_format($item['price'] + $item['step'], 0, ',', ' ');?></span>
                            <?php else: ?>
                            <span>12 000 р</span>
                            <?php endif;?>
                        </div>
                    </div>
                    <form class="lot-item__form" action="https://echo.htmlacademy.ru" method="post">
                        <p class="lot-item__form-item">
                            <label for="cost">Ваша ставка</label>
                            <input id="cost" type="number" name="cost"
                            <?php if(array_key_exists('step', $item)): ?>
                            placeholder="<?=number_format($item['price'] + $item['step'], 0, ',', ' ');?>"
                            <?php else: ?>
                            placeholder="12 000"
                            <?php endif;?>>
                        </p>
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
                                <td class="history__price"><?=number_format($bets[$cur_bet]['price'], 0, ',', ' ') . ' р';?></td>
                                <td class="history__time"><?=get_past_time($bets[$cur_bet]['ts']);?></td>
                            </tr>
                        <?php $cur_bet++; } ?>
                    </table>
                </div>
            </div>
        </div>
    </section>