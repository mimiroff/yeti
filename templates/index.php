<section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <?php
            $element_count = count($categories);
            $cur_element = 0;
        ?>
        <ul class="promo__list">
            <?php while ($cur_element < $element_count) { ?>
                <li class="promo__item">
                    <a class="promo__link" href="all-lots.html"><?=$categories[$cur_element];?></a>
                </li>
                <?php $cur_element++; } ?>
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <?php
            $el_count = count($goods);
            $cur_el = 0;
        ?>
        <ul class="lots__list">
                <?php while ($cur_el < $el_count) { ?>
                    <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?=strip_tags($goods[$cur_el]['picture_url']);?>" width="350" height="260" alt="<?=strip_tags($goods[$cur_el]['title']);?>">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?=strip_tags($goods[$cur_el]['category']);?></span>
                    <h3 class="lot__title"><a class="text-link" href="lot.php"><?=strip_tags($goods[$cur_el]['title']);?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?=strip_tags($goods[$cur_el]['price']);?><b class="rub">р</b></span>
                        </div>
                        <div class="lot__timer timer">
                            <?=$lot_time_remaining;?>
                        </div>
                    </div>
                </div>
            </li>
            <?php $cur_el++; } ?> 
        </ul>
    </section>