<?php require base_path("/views/partials/head.php"); ?>

<body>
<main class="h-min-screen bg-gray-100">
    <?php require base_path("/views/partials/header.php"); ?>
    <div class="relative isolate px-6 pt-24 lg:px-8">
        <div class="container mx-auto py-8">
            <!-- Display success message -->
            <?php if (isset($_SESSION['success_message'])) : ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Succès !</strong>
                    <span class="block sm:inline"><?= $_SESSION['success_message'] ?></span>
                </div>
                <?php unset($_SESSION['success_message']); ?>
            <?php endif; ?>
            
            <!-- Display errors -->
            <?php if (isset($errors) && count($errors) > 0) : ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Erreur !</strong>
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
                        <?php if (empty($teamPlayers)): ?>
                            <div class="text-center py-8">
                                <p class="text-gray-600 mb-4">Aucun joueur dans l'équipe pour le moment.</p>
                                <p class="text-sm text-gray-500">
                                    Utilisez le bouton "Add a Player" pour ajouter des joueurs PUBG Xbox à votre équipe et voir leurs statistiques.
                                </p>
                            </div>
                        <?php endif; ?>
                        <!-- Dynamically generated player cards -->
                        <?php foreach ($teamPlayers as $player) : ?>
                            <div class="flex flex-row justify-between items-center bg-gray-200 p-4 rounded-lg mb-4">
                                <img src="https://i.pravatar.cc/150" class="w-16 h-16 bg-gray-300 rounded-full mr-4">
                                <div class="flex-grow">
                                    <h3 class="font-bold"><?php echo $player->player->attributes->name; ?></h3>
                                    <p><?php echo strtoupper($player->player->attributes->shardId); ?></p>
                                </div>
                                <div>
                                    <?php if ($player->playerSeasonStats): ?>
                                        <div class="text-sm">
                                            <div class="grid grid-cols-2 gap-4 mb-2">
                                                <div>
                                                    <span class="font-semibold text-green-600"><?= $player->playerSeasonStats->kills ?></span>
                                                    <span class="text-gray-600">Kills</span>
                                                </div>
                                                <div>
                                                    <span class="font-semibold text-blue-600"><?= $player->playerSeasonStats->wins ?></span>
                                                    <span class="text-gray-600">Wins</span>
                                                </div>
                                                <div>
                                                    <span class="font-semibold text-purple-600"><?= number_format($player->playerSeasonStats->kd, 2) ?></span>
                                                    <span class="text-gray-600">K/D</span>
                                                </div>
                                                <div>
                                                    <span class="font-semibold text-orange-600"><?= $player->playerSeasonStats->roundsPlayed ?></span>
                                                    <span class="text-gray-600">Games</span>
                                                </div>
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                Longest Kill: <?= number_format($player->playerSeasonStats->longestKill, 0) ?>m
                                                • Headshots: <?= $player->playerSeasonStats->headshotKills ?>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="text-sm text-gray-500">
                                            Stats non disponibles
                                        </div>
                                    <?php endif; ?>
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