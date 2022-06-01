<?php

declare(strict_types=1);

function drawOrderRow($order)
{ ?>
    <tr>
        <td class="td-order">
            <div class="order">
                <span class="order-restaurant"><?=$order['name']?></span>
                <span class="order-status"> - <?=$order['status']?></span>
            </div>
            <div class="date">
                <span><?=$order['date']?></span>
            </div>
            <div class="total">
                <span class="price">$<?=$order['total']?>,00</span>
            </div>
        </td>

        <td class="action-button">
            <div class="button-wrapper">
                <?php if($order['status']=='delivered') {?>
                <a href='../pages/review.php?order=<?=$order['idOrder']?>'><span>write review</span></a>
                <?php } ?>
            </div>
        </td>

    </tr>
<?php
}
?>