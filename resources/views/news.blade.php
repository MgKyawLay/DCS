<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('News') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-5">
            @foreach($news as $item)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col gap-5">
                    <div class="text-4xl">
                        {{$item->title}}
                    </div>
                    <div>
                        {{$item->content}}
                    </div>
                    <img src="{{$item->image_url}}" class="max-w-2xl ">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>