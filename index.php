<?php
require "game.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blackjack</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Blackjack but no hookers</h1>
        <section class="row">
            <article class="col">
                <strong><h3 id="playerScore" <?php echo $redDead; ?>><?php echo $playerScore; ?></h3></strong>
                <span>Your score</span>
            </article>
            <article class="col">
                <strong><h3 id="dealerScore"><?php echo $dealerScore; ?></h3></strong>
                <span>Dealer's score</span>
            </article>
        </section>
        <section class="row mt-3">
            <strong><p><?php echo $dead; ?></p></strong>
            <br/>
        </section>
        <section class="row mt-2">
            <form method="post">
                <?php echo $newGame; ?>
                <br/>
                <button type="submit" class="btn btn-primary" name="hit" value="hit" <?php echo $disable; ?>>HIT ME</button>
                <button type="submit" class="btn btn-primary" name="stand" value="stand" <?php echo $disable; ?>>STAND</button>
                <button type="submit" class="btn btn-danger" name="go" value="surrender" <?php echo $disable; ?>>SURRENDER</button>
                <br/>
            </form>
        </section>
        <form method="post">
        </form>
    </div>
</body>
</html>
