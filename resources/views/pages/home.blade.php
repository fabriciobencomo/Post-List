<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Repositories-Crud</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    <body class="bg-gray-100 container">
        <div class="flex flex-col mx-5 my-2 gap-3">
        @forelse($repositories as $repository)
            <div class="bg-blue-800 rounded-md shadow-sm px-4 py-2 my-4 flex flex-col">
                <div class="flex">
                    <img class="rounded-full w-12 h-12 mr-2" src="{{$repository->user->profile_photo_url}}">
                    <h2 class="text-md font-medium text-white flex-grow-1">{{$repository->user->name}}</h2>
                </div>
                <h3 class="text-sm text-white">{{$repository->url}}</h3>
                <p>{{$repository->description}}</p>
            </div>
        @empty
            <h1 class="text-xl text-gray-700 font-medium">No Repositories Yet ...</h1>
        @endforelse
        </div>
    </body>
</html>
