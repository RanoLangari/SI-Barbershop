<x-admin-layout>

   <div id="content-container" class="content-container ml-64">
       <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
           <div class="bg-white shadow rounded-lg p-6 transform transition duration-500 hover:scale-105">
               <div class="flex items-center">
                   <div class="flex-shrink-0">
                       <svg class="h-12 w-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 4h10a2 2 0 012 2v11a2 2 0 01-2 2H7a2 2 0 01-2-2V9a2 2 0 012-2zm3 4h4m-4 4h4"></path>
                       </svg>
                   </div>
                   <div class="ml-4">
                       <h3 class="text-lg leading-6 font-medium text-gray-900">Total Reservasi</h3>
                       <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $totalReservasi}}</p>
                   </div>
               </div>
           </div>
           <div class="bg-white shadow rounded-lg p-6 transform transition duration-500 hover:scale-105">
               <div class="flex items-center">
               <div class="flex-shrink-0">
                   <svg class="h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M12 12a4 4 0 100-8 4 4 0 000 8zm6 8h-1.4a5.97 5.97 0 00-9.2 0H6"></path>
                   </svg>
               </div>
               <div class="ml-4">
                   <h3 class="text-lg leading-6 font-medium text-gray-900">Total Pelanggan</h3>
                   <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $pelangganCount}}</p>
               </div>
               </div>
           </div>
           <div class="bg-white shadow rounded-lg p-6 transform transition duration-500 hover:scale-105">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-12 w-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 7v-6m0 0L3 9m9 5l9-5-9 5z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Total Barberman</h3>
                    <p class="mt-1 text-2xl font-semibold text-gray-900"> {{$barbermanCount}}</p>
                </div>
            </div>
        </div>
       </div>
   </div>
   
   <script>
       document.addEventListener('DOMContentLoaded', function() {
           const contentContainer = document.getElementById('content-container');
           contentContainer.style.opacity = 0;
           contentContainer.style.transform = 'translateY(-50px)';
           setTimeout(() => {
               contentContainer.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
               contentContainer.style.opacity = 1;
               contentContainer.style.transform = 'translateY(0)';
               setTimeout(() => {
                   contentContainer.style.transition = 'transform 0.2s ease-in-out';
                   contentContainer.style.transform = 'translateY(5px)';
                   setTimeout(() => {
                       contentContainer.style.transform = 'translateY(0)';
                   }, 200);
               }, 500);
           }, 100);
       });
   </script>
   
   </x-admin-layout>