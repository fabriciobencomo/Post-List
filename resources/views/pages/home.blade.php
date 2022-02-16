<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Repositories-Crud</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    <body class="bg-gray-100">
        <div class="mx-auto flex flex-col">
        @forelse($repositories as $repository)
            <div class="bg-blue-900 rounded-md shadow-sm px-4 py-2 my-2 flex flex-col">
                <h2 class="text-md font-medium text-white">{{$repository->user->name}}</h2>
                <h3 class="text-sm text-white">{{$repository->url}}</h3>
                <p>{{$repository->description}}</p>
            </div>
        @empty
            <h1 class="text-xl text-gray-700 font-medium">No Repositories Yet ...</h1>
        @endforelse
        </div>
    </body>
</html>
