@php
    $title = "ThundeR socialitA";
    $summary = "You can enter the room where you go a topic choosen. like anime, film, kpop, fisika, sains. or in specific like anime indonesia, anime malaysia, anime asia, etc.";
@endphp


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="dark:bg-amber-900">
    
<section class="bg-center bg-no-repeat bg-gray-700 bg-blend-multiply bg-cover min-h-screen flex items-center" style="background-image: url('img/background.jpg');">
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-lime-200 md:text-5xl lg:text-6xl dark:text-white">{{ $title }}</h1>
        <p class="mb-8 text-lg font-normal text-gray-200 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-400">{{ $summary }}</p>
        <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
            <a href="register" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900 capitalize">
                Sign Up
                <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
            <a href="login" class="py-3 px-5 sm:ms-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-700 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-70 capitalize">
                Sign In
            </a>  
        </div>
    </div>
</section>


</body>
</html>
