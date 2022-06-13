<?php

declare(strict_types=1);
//User order templates
function drawOrderRow($order)
{ ?>
    <tr>
        <td class="td-order">
            <div class="order">
                <span class="order-restaurant"><?= $order['name'] ?></span>
                <span class="order-status"> - <?= $order['status'] ?></span>
            </div>
            <div class="date">
                <span><?= $order['date'] ?></span>
            </div>
            <div class="total">
                <span class="price">$<?= number_format(floatval($order['total']),2,",") ?></span>
            </div>
        </td>

        <td class="action-button">
            <div class="button-wrapper">
                <?php if ($order['status'] == 'delivered') { ?>
                    <a href='../pages/review.php?order=<?= $order['idOrder'] . '&user=' . $order['idUser'] ?>'><span>write review</span></a>
                <?php } ?>
                <?php if ($order['status'] != 'delivered') { ?>
                    <a href='../pages/review.php?order=<?= $order['idOrder'] . '&user=' . $order['idUser'] ?>'><span>order details</span></a>
                <?php } ?>
            </div>
        </td>

    </tr>
<?php
}
function drawReviewOrderRow($order)
{
    $total = floatval($order['ammount']) * floatval($order['price']);
?>
    <tr>
        <td class="td-order">
            <div class="order">
                <span class="order-name"><?= ucfirst($order['name']) ?></span>
            </div>
            <div class="total">
                <span id='total' class="price">$<?= number_format(floatval($order['price']),2,",") ?> x <?= $order['ammount'] ?></span>
            </div>
        </td>
        <td>
            <div class="total">
                <span class="price">$<?= number_format($total,2,",") ?></span>
            </div>
        </td>

    </tr>
<?php
}
//restaurant manager order templates

function getPossibleStatus($status){
    switch($status){
        case 'created':
            return ['created','ready', 'delivered'];
        case 'ready':
            return ['ready','delivered'];
        case 'delivered':
            return ['delivered'];
        default: return [];
    }
}

function drawOrderRowOwner($order)
{ 
    $status = getPossibleStatus($order['status']);
    ?>
    <tr>
        <td class="td-order">
            <div class="order">
                <span class="order-restaurant"><?= $order['name'] ?></span>

            </div>
            <div class="date">
                <span><?= $order['date'] ?></span>
            </div>
            <div class="date">
                <span id='idOrder'>Order reference: <?= $order['idOrder'] ?></span>
            </div>
            <div class="total">
                <span class="price">$<?= number_format(floatval($order['total']),2,",") ?></span>
            </div>
        </td>

        <td class="action-button">
            <div class="button-wrapper">
            <span class="order-status">
            <?php if(count($status) != 0) {?>
                Order status: 
                    <select class="status-dropdown" id="<?=$order['idOrder']?>" onchange="updateStatus('<?=$order['idOrder']?>')">
                        <?php
                        foreach($status as $st){?>
                        <option <?php echo ($order['status']==$st) ? "selected='selected'" : '' ?> value='{"status": "<?=$st?>", "id":"<?=$order['idOrder']?>", "res":"<?=$_GET['res']?>"}'><?=$st?></option>
                        <?php
                     }
                      ?>
                    </select>
                    <?php }
                    else{ ?>
                    Order status: Complete
                    <?php }
                    ?>

                </span>
                <?php if ($order['status'] == 'reviewed') { ?>
                    <a href='../pages/review.php?order=<?= $order['idOrder'] . '&user=' . $order['idUser'] ?>'><span>answer review</span></a>
                <?php } ?>
                <?php if ($order['status'] != 'reviewed') { ?>
                    <a href='../pages/review.php?order=<?= $order['idOrder'] . '&user=' . $order['idUser'] ?>'><span>see details</span></a>
                <?php } ?>
            </div>
        </td>

    </tr>
<?php
}
?>