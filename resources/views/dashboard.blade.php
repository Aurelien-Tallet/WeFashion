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
                    <div class="flex" style="gap:50px;">
                        <div class="block flex flex-row items-center  pl-30" style="width:70px;">
                            <x-label :value="__('image  ')" class="mx-10" />
                        </div>
                        <div class="block flex flex-row items-center  pl-30" style="width:200px;">
                            <x-label :value="__('nom  ')" class="mx-10" />
                        </div>
                        <div class="block flex flex-row items-center">
                            <x-label :value="__('reference ')" class="mx-10" />
                        </div>
                    </div>
                    @foreach ($products as $product)
                        <div class="flex pl-10 " style="gap:50px;">
                            <div class="block flex flex-row items-center pl-30" style="width:70px;">
                                <img src={{ asset('/storage/image/' . $product->picture->name) }}
                                    style="width:70px; height:70px; object-fit:cover;" />
                            </div>
                            <div class="block flex pl-30 flex-row items-center " style="width:200px;">
                                {{-- <x-label :value="__('nom : ')" class="mx-10" /> --}}
                                <a id={{ $product->id }}
                                    href="{{ route('admin.products.edit', $product->id) }}">{{ $product->name }}</a>
                            </div>
                            <div class="block flex flex-row items-center" style="width:200px;">
                                {{-- <x-label :value="__('reference : ')" class="mx-10" /> --}}
                                <p>{{ $product->reference }}</p>
                            </div>
                            <div class="block flex flex-row items-center">
                                <a id={{ $product->id }} href="{{ route('admin.products.edit', $product->id) }}"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                    style="background:rgb(241, 176, 54);">Modifier </a>
                            </div>
                            <div class="block flex flex-row items-center">
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <x-button type="submit" style="background:rgb(241, 54, 54);"
                                        onclick="return confirm('Es-tu sûr de vouloir supprimer cette catégorie')">
                                        Supprimer
                                    </x-button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
