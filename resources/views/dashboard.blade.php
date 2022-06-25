<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des vêtements') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul>
                        @foreach ( $products as $product)
                        <div class="block flex flex-row items-center" style="gap:15px;">
                            <x-label :value="__('nom : ')" class="mx-10" />
                            <a id={{$product->id}} href="{{route('admin.products.edit', $product->id)}}">{{$product->name}}</a>  
                        </div>
                        <div class="block flex flex-row items-center" style="gap:15px;">
                            <x-label :value="__('reference : ')" class="mx-10" />
                            <p >{{$product->reference}}</p>  
                        </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
