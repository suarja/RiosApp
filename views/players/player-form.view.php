 <?php require base_path("/views/partials/head.php"); ?>
 <main class="flex justify-center h-screen bg-gray-100">
     <?php require base_path("/views/partials/header.php"); ?>
     <div class="relative isolate px-6 pt-24 lg:px-8 h-full items-center flex">
         <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full ">
             <form method="POST">
                 <div class="mb-6">
                     <input type="hidden" name="_method" value="POST">
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
 </main>