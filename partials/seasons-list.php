<div class="mx-20 mt-20 w-Full p-4 shadow-md rounded-lg border-t-2 border-teal-400">
    <div class="flex justify-between pb-4">
        <p class="font-bold text-xl">PUBG Seasons</p>
    </div>

    <div class="grid gap-3  grid-cols-1 md:grid-cols-2 lg:grid-cols-3" id="accordion-collapse-body-1">

        <?php foreach ($seasonsList->data as $key => $season) : ?>

            <a href="#" class="flex border items-center rounded-md cursor-pointer transition duration-500 shadow-sm hover:shadow-md hover:shadow-teal-400">
                <div class="w-16 p-2 shrink-0">
                    <img src="https://www.svgrepo.com/show/502433/tool.svg" alt="" class="h-12 w-12">
                </div>
                <div class="p-2">
                    <p class="font-semibold text-lg">Season</p>
                    <span class="text-gray-600"><?= $key ?></span>
                </div>

            </a>
        <?php endforeach; ?>





    </div>
</div>