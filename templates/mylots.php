<section class="rates container">
    <h2>Мои ставки</h2>
    <table class="rates__list">
        <?php
        $element_count = count($mybets);
        $cur_element = 0;
        while ($cur_element < $element_count) { ?>
        <tr class="rates__item">
            <td class="rates__info">
                <div class="rates__img">
                    <img src="<?=$mybets[$cur_element]['picture'];?>" width="54" height="40" alt="<?=$mybets[$cur_element]['name'];?>">
                </div>
                <h3 class="rates__title"><a href="lot.php?item_id=<?=$mybets[$cur_element]['lot_id'];?>"><?=$mybets[$cur_element]['name'];?></a></h3>
            </td>
            <td class="rates__category">
                <?=$mybets[$cur_element]['category'];?>
            </td>
            <td class="rates__timer">
                <div class="timer timer--finishing"><?=get_time_left($mybets[$cur_element]['date']);?></div>
            </td>
            <td class="rates__price">
                <?=number_format($mybets[$cur_element]['cost'], 0, ',', ' ') . ' р';?>
            </td>
            <td class="rates__time">
                <?=get_past_time($mybets[$cur_element]['time']);?>
            </td>
        </tr>
        <?php $cur_element++; } ?>
    </table>
</section>