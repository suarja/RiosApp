<?php require base_path("/views/partials/head.php"); ?>

<main class="h-min-screen bg-gray-100">
    <?php require base_path("/views/partials/header.php"); ?>
    <div class="relative isolate px-6 pt-24 lg:px-8">
        <div class="container mx-auto py-8">
            <!-- Display errors -->
            <?php if (isset($errors) && count($errors) > 0) : ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <ul>
                        <?php foreach ($errors as $error) : ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="flex flex-col gap-4 px-4">
                <!-- Form for adding a new player -->
                <div class="">
                    <div class="bg-white p-8 rounded-lg shadow-lg flex justify-between">
                        <a class=" font-semibold leading-6 text-gray-900 bg-blue-200 hover:bg-blue-300 rounded-lg px-4 py-2" href="/player/store">Add a Player </a>
                        </form>
                    </div>
                </div>
                <!-- Player list -->
                <div class="col-span-9">
                    <div class="bg-white text-black shadow rounded-lg p-6">
                        <h2 class="text-xl font-bold mb-4">Team Members</h2>
                        <!-- Dynamically generated player cards -->
                        <?php foreach ($teamPlayers as $player) : ?>
                            <div class="flex flex-row justify-between items-center bg-gray-200 p-4 rounded-lg mb-4">
                                <img src="https://i.pravatar.cc/150" class="w-16 h-16 bg-gray-300 rounded-full mr-4">
                                <div class="flex-grow">
                                    <h3 class="font-bold"><?php echo $player->player->attributes->name; ?></h3>
                                    <p><?php echo strtoupper($player->player->attributes->shardId); ?></p>
                                </div>
                                <div>
                                    <ul class="text-sm text-gray-700">
                                        <li>Kills: <?php echo $player->stat("kills"); ?></li>
                                        <li>Assists: <?php echo $player->stat("assists"); ?></li>
                                        <!-- Add more stats as needed -->
                                        <li>Deaths: <?php echo $player->stat("losses"); ?></li>
                                        <li>K/D: <?php echo number_format($player->stat("kd"), 2); ?></li>
                                        <li>Best kill streak: <?php echo $player->stat("maxKillStreaks"); ?></li>

                                    </ul>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php require base_path("/views/partials/footer.php"); ?>