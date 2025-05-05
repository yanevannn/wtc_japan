 @props(['title' => 'Ini Judul Pengumuman', 'description' => 'Ini deskripsi Pengumuman', 'file' => '#', 'date' ])

 <div class="mx-auto bg-brand-600 shadow-lg rounded-lg w-full">
     <div class="px-6 py-5">
         <div class="flex items-start">
             <!-- Icon -->
             <svg xmlns="http://www.w3.org/2000/svg" class="mr-5 mt-1 text-white" width="30" height="30"
                 viewBox="0 0 30 30" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                 stroke-linejoin="round" class="lucide lucide-newspaper-icon lucide-newspaper">
                 <path d="M15 18h-5" />
                 <path d="M18 14h-8" />
                 <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-4 0v-9a2 2 0 0 1 2-2h2" />
                 <rect width="8" height="4" x="10" y="6" rx="1" />
             </svg>
             <!-- Card content -->
             <div class="flex-grow truncate">
                 <!-- Card header -->
                 <div class="w-full sm:flex justify-between items-center mb-2">
                     <!-- Title -->
                     <h2 class="text-xl leading-snug font-extrabold text-gray-50 truncate mb-1 sm:mb-0">
                         {{ $title }}
                     </h2>
                     <p class="text-sm text-gray-50">{{ $date }}</p>
                 </div>
                 <!-- Card body -->
                 <div class="flex flex-col whitespace-normal">

                     <!-- Paragraph -->
                     <div class="max-w-md text-gray-100">
                         <p class="mb-2">{{ $description }}</p>
                     </div>
                     <!-- More link -->
                     <a href="{{ $file }}" target="_blank"
                         class="text-gray-100 underline-offset-2 underline hover:font-medium hover:text-white">Read more
                     </a>

                 </div>
             </div>
         </div>
     </div>
 </div>
