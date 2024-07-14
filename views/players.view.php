<?php require './views/partials/head.php'; ?>
<main class="bg-white h-screen">
    <div>
        <h1>Players</h1>
        <div>
            <h2>Player 1</h2>
            <p><?php echo $playerOne->attributes->name; ?></p>
            <p><?php echo $playerOne->attributes->shardId; ?></p>
        </div>
    </div>
</main>


<?php require './views/partials/footer.php'; ?>