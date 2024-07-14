<div class="bg-gray-100">
    <div class="container mx-auto py-8">
        <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">
            <div class="col-span-4 sm:col-span-3">
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="flex flex-col items-center">
                        <img src="./public/rios-logo.png" class="w-32 h-32 bg-gray-300 rounded-full mb-4 shrink-0"></img>
                        <h1 class="text-xl font-bold">
                            <p class="text-black"><?= $playerOne->attributes->name; ?></p>
                        </h1>
                        <p class="text-gray-700">
                            <?= strtoupper($playerOne->attributes->shardId); ?>
                        </p>
                        <div class="mt-6 flex flex-wrap gap-4 justify-center">
                            <a href="#" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Stats</a>
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
            <div class="col-span-4 sm:col-span-9">
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
            </div>
        </div>
    </div>
</div>