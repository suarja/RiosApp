<?php require base_path("/views/partials/head.php"); ?>

<main class="h-screen bg-gray-100">
    <?php require base_path("/views/partials/header.php"); ?>
    <div class="relative isolate px-6 pt-24 lg:px-8">
        <div class="container mx-auto py-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 px-4">
                <!-- Form for adding a new player -->
                <div class="col-span-3">
                    <div class="bg-white p-8 rounded-lg shadow-lg">
                        <form method="POST" action="#">
                            <div class="mb-6">
                                <label for="playerName" class="block text-gray-700 text-sm font-bold mb-2">Player Name:</label>
                                <input type="text" id="playerName" name="playerName" placeholder="Enter player name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <div class="flex items-center justify-between">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Add to Team
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Player list -->
                <div class="col-span-9">
                    <div class="bg-white shadow rounded-lg p-6">
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