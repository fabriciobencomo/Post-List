<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Repositories
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Url</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($repositories as $repository)
                            <tr>
                                <td class="border px-4 py-2">{{$repository->id}}</td>
                                <td class="border px-4 py-2">{{$repository->url}}</td>
                                <td class="px-4 py-2">
                                    <a href="{{route('repositories.show', ['repository' => $repository->id])}}">See</a>
                                </td>
                                <td class="px-4 py-2">
                                    <a href="{{route('repositories.edit', ['repository' => $repository->id])}}">Edit</a>
                                </td>
                                <td class="px-4 py-2">
                                    <a href="{{route('repositories.destroy', ['repository' => $repository->id])}}">Delete</a>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="4">No Repositories Yet ...</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
