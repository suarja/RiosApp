<main class="h-screen bg-gray-100">
    <?php require base_path("/views/partials/header.php"); ?>
    <div class="relative isolate px-6 pt-24 lg:px-8">
        <div class="">
            <div class="container mx-auto py-8">
                <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">
                    <div class="col-span-4 sm:col-span-3">
                        <div class="bg-white shadow rounded-lg p-6">
                            <div class="flex flex-col items-center">
                                <img src="<?php
                                            $playerOne->attributes->name === "Riosrap" ? print("./public/rios-logo.png") : print("https://i.pravatar.cc/150");
                                            ?>" class="w-32 h-32 bg-gray-300 rounded-full mb-4 shrink-0"></img>
                                <h1 class="text-xl font-bold">
                                    <p class="text-black"><?= $playerOne->attributes->name; ?></p>
                                </h1>
                                <p class="text-gray-700">
                                    <?= strtoupper($playerOne->attributes->shardId); ?>
                                </p>
                                <div class="mt-6 flex flex-wrap gap-4 justify-center">
                                    <form method="POST">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Stats</button>
                                    </form>
                                    <a href="#" class="bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 px-4 rounded">Team</a>
                                </div>
                            </div>
                            <hr class="my-6 border-t border-gray-300">
                            <div class="flex flex-col">
                                <span class="text-gray-700 uppercase font-bold tracking-wider mb-2">Skills</span>
                                <ul class="text-black">
                                    <!-- Skills can be dynamically generated here -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-4 sm:col-span-9 flex flex-col gap-8">
                        <div class="bg-white shadow rounded-lg p-6 text-black">
                            <h2 class=" text-xl text-center py-4 font-bold mb-4">Player Statistics</h2>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 ">
                                <!-- Individual Stats -->
                                <div>
                                    <h3 class="text-lg font-semibold pb-4 ">Individual Performance</h3>
                                    <ul class=" text-sm text-gray-700">
                                        <li>Kills: <?= $playerSeasonStats->attributes->gameModeStats->squad->getIndividualStats()['kills']; ?></li>
                                        <li>Headshot Kills: <?= $playerSeasonStats->attributes->gameModeStats->squad->getIndividualStats()['headshotKills']; ?></li>
                                        <li>Longest Kill: <?= $playerSeasonStats->attributes->gameModeStats->squad->getIndividualStats()['longestKill']; ?> meters</li>
                                        <li>Damage Dealt: <?= $playerSeasonStats->attributes->gameModeStats->squad->getIndividualStats()['damageDealt']; ?></li>
                                    </ul>
                                </div>
                                <!-- Collective Stats -->
                                <div>
                                    <h3 class="text-lg pb-4 font-semibold ">Team Contributions</h3>
                                    <ul class="text-sm text-gray-700">
                                        <li>Assists: <?= $playerSeasonStats->attributes->gameModeStats->squad->getCollectiveStats()['assists']; ?></li>
                                        <li>Revives: <?= $playerSeasonStats->attributes->gameModeStats->squad->getCollectiveStats()['revives']; ?></li>
                                        <li>Heals: <?= $playerSeasonStats->attributes->gameModeStats->squad->getCollectiveStats()['heals']; ?></li>
                                        <li>Boosts: <?= $playerSeasonStats->attributes->gameModeStats->squad->getCollectiveStats()['boosts']; ?></li>
                                    </ul>
                                </div>
                                <!-- Strategic Stats -->
                                <div>
                                    <h3 class="text-lg pb-4 font-semibold ">Strategic Metrics</h3>
                                    <ul class=" text-sm text-gray-700">
                                        <li>Ride Distance: <?= $playerSeasonStats->attributes->gameModeStats->squad->getStrategicStats()['rideDistance']; ?> meters</li>
                                        <li>Swim Distance: <?= $playerSeasonStats->attributes->gameModeStats->squad->getStrategicStats()['swimDistance']; ?> meters</li>
                                        <li>Walk Distance: <?= $playerSeasonStats->attributes->gameModeStats->squad->getStrategicStats()['walkDistance']; ?> meters</li>
                                        <li>Vehicle Destroys: <?= $playerSeasonStats->attributes->gameModeStats->squad->getStrategicStats()['vehicleDestroys']; ?></li>
                                        <li>Top 10s: <?= $playerSeasonStats->attributes->gameModeStats->squad->getStrategicStats()['top10s']; ?></li>
                                    </ul>
                                </div>
                            </div>



                            <!-- Social Media Links and Experience Sections as previously defined -->
                        </div>
                        <div class="flex justify-center">
                            <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
                                <form method="POST">
                                    <div class="mb-6">
                                        <label for="playerName" class="block text-gray-700 text-sm font-bold mb-2">Player Name:</label>
                                        <input type="text" id="playerName" name="playerName" placeholder="Enter player name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                            Submit
                                        </button>
                                        <button type="reset" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                            Clear
                                        </button>
                                    </div>
                                    <div>
                                        <ul class="text-red-500">
                                            <?php foreach ($errors as $error) : ?>
                                                <li><?= $error; ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

</main>