<?php require base_path("/views/partials/head.php"); ?>

<body>
<main class="h-screen bg-white">
  <div class="bg-white h-min-screen w-full">
    <?php require base_path("/views/partials/header.php"); ?>


    <div class="relative isolate px-6 pt-14 lg:px-8 ">
      <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
        <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="
          clip-path: polygon(
            74.1% 44.1%,
            100% 61.6%,
            97.5% 26.9%,
            85.5% 0.1%,
            80.7% 2%,
            72.5% 32.5%,
            60.2% 62.4%,
            52.4% 68.1%,
            47.5% 58.3%,
            45.2% 34.5%,
            27.5% 76.7%,
            0.1% 64.9%,
            17.9% 100%,
            27.6% 76.8%,
            76.1% 97.7%,
            74.1% 44.1%
          );
        "></div>
      </div>
      <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
        <div class="text-center">
          <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
            RiosApp
          </h1>
          <p class="mt-6 text-lg leading-8 text-gray-600">
            Suivez les statistiques PUBG de Rios et son équipe "claqué"
          </p>
          <div class="mt-6 p-4 bg-blue-50 rounded-lg">
            <h3 class="text-lg font-semibold text-blue-900 mb-2">Comment ça marche :</h3>
            <ul class="text-blue-800 text-sm space-y-2">
              <li>🎮 <strong>Recherchez</strong> un joueur PUBG Xbox par son nom exact</li>
              <li>📊 <strong>Visualisez</strong> ses statistiques de la saison en cours</li>
              <li>👥 <strong>Gérez</strong> votre équipe de joueurs favoris</li>
            </ul>
          </div>
          <div class="mt-10 flex items-center justify-center gap-x-6">
            <a href="/player" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Player Stats</a>
            <a href="/players" class="text-sm font-semibold leading-6 text-gray-900">La Team <span aria-hidden="true">→</span></a>
          </div>
        </div>
      </div>
      <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
        <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="
          clip-path: polygon(
            74.1% 44.1%,
            100% 61.6%,
            97.5% 26.9%,
            85.5% 0.1%,
            80.7% 2%,
            72.5% 32.5%,
            60.2% 62.4%,
            52.4% 68.1%,
            47.5% 58.3%,
            45.2% 34.5%,
            27.5% 76.7%,
            0.1% 64.9%,
            17.9% 100%,
            27.6% 76.8%,
            76.1% 97.7%,
            74.1% 44.1%
          );
        "></div>
      </div>
    </div>
  </div>
</main>

<?php require base_path("/views/partials/footer.php"); ?>