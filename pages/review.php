<?php

declare(strict_types=1);

session_start();

require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../templates/orders.tpl.php');


drawHeader();

$db = getDatabaseConnection();

if (!isset($_SESSION['id'])) {
    header('Location: http://localhost:9000/pages/login.php');
}

$order_id = $_GET['order'];
$stmt = $db->prepare("SELECT dish.name, dish.price,  dish_order.ammount FROM dish_order JOIN dish on dish_order.idDish = dish.idDish WHERE idOrder = ?");
$stmt->execute(array($order_id));
$ordered_dishes = $stmt->fetchAll();
$stmt = $db->prepare("SELECT idRestaurant, idUser, status from user_order where idOrder = ?");
$stmt->execute(array($order_id));
$result = $stmt->fetchAll();
$id_restaurant = $result[0]['idRestaurant'];
$id_user = $result[0]['idUser'];
$status = $result[0]['status'];
$stmt = $db->prepare("SELECT name from Restaurant where idRestaurant = ?");
$stmt->execute(array($id_restaurant));
$result = $stmt->fetchAll();
$name = $result[0]['name'];

if ($status == 'reviewed') {
    $stmt = $db->prepare("SELECT review, rating, user.name from Review JOIN user on review.idUser = user.idUser WHERE idOrder = ?");
    $stmt->execute(array($order_id));
    $review = $stmt->fetchAll()[0];
}

if ($status == 'answered') {
    $stmt = $db->prepare("SELECT review, rating, user.name from Review JOIN user on review.idUser = user.idUser WHERE idOrder = ?");
    $stmt->execute(array($order_id));
    $review = $stmt->fetchAll()[0];
    $stmt = $db->prepare("SELECT answer from Review_answer WHERE idOrder = ?");
    $stmt->execute(array($order_id));
    $answer = $stmt->fetchAll()[0];
}

?>
<link rel="stylesheet" href="../styles/style-review.css">
<div class="wrapper">
    <div class="title-wrapper">
        <h1>Ordered items from <?= $name ?></h1>
    </div>
    <table class="orders-table">
        <tbody>
            <?php
            $total = 0;
            foreach ($ordered_dishes as $row) {
                $total += floatval($row['price']) * intval($row['ammount']);
                drawReviewOrderRow($row);
            }
            ?>
            <tr>
                <td class="td-order">
                    <div class="order">
                        <span class="order-name">Total:</span>
                    </div>
                </td>
                <td>
                    <div class="total">
                        <span class="price">$<?= number_format($total,2,",") ?></span>
                    </div>
                </td>
            </tr>
            <?php if (isset($review)) { ?>
                <tr>
                    <td>
                        <span>
                            <?= $review['name'] ?>
                        </span>
                        <p><?= $review['review'] ?></p>
                        <p><?= $review['rating'] ?>/5</p>
                    </td>
                </tr>
            <?php
            }
            ?>
            <?php if (isset($answer)) { ?>
                <tr>
                    <td>
                        <span>
                            <?= $name ?>
                        </span>
                        <p><?= $answer['answer'] ?></p>
                    </td>
                </tr>
            <?php
            }
            ?>

        </tbody>
    </table>
    <?php if (($status == 'delivered') && ($id_user == $_SESSION['id'])) { ?>
        <h3>Review:</h3>
        <form method="POST" action="../actions/action_submit_rating.php">
            <div class="star-rating">
                <input type="radio" id="5-stars" name="rating" value="5" />
                <label for="5-stars" class="star">&#9733;</label>
                <input type="radio" id="4-stars" name="rating" value="4" />
                <label for="4-stars" class="star">&#9733;</label>
                <input type="radio" id="3-stars" name="rating" value="3" />
                <label for="3-stars" class="star">&#9733;</label>
                <input type="radio" id="2-stars" name="rating" value="2" />
                <label for="2-stars" class="star">&#9733;</label>
                <input type="radio" id="1-star" name="rating" value="1" />
                <label for="1-star" class="star">&#9733;</label>
                <input type="radio" id="0-star" name="rating" value="0" checked='checked' style='display:none' />
            </div>
            <input style="display:none" type='text' name="idOrder" value='<?= $order_id ?>' />
            <input style="display:none" type='text' name="idRestaurant" value='<?= $id_restaurant ?>' />

            <div class="text-wrapper">
                <textarea required id="subject" name="subject" placeholder="Write something about your experience" style="width: 50vw;height:200px"></textarea>
                <button type="submit">Submit</button>
            </div>
        </form>
    <?php
    }
    ?>
    <?php if ($status == 'reviewed') { ?>
        <h3>Reply to review:</h3>
        <!-- TODO action submit reply below -->
        <form method="POST" action="../actions/action_submit_answer.php">
            <input style="display:none" type='text' name="idOrder" value='<?= $order_id ?>' />
            <input style="display:none" type='text' name="res" value='<?= $_GET['res'] ?>' />
            <div class="text-wrapper">
                <textarea required id="subject" name="subject" placeholder="Reply to customer review" style="width: 50vw;height:200px"></textarea>
                <button type="submit">Submit</button>
            </div>
        </form>
    <?php
    }
    ?>

</div>