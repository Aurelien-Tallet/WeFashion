<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($submit . ' une categorie') }}
        </h2>
    </x-slot> 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ $action }}" enctype='multipart/form-data'>
                        @csrf
                        {{ method_field($method) }}
                        <div>
                            <x-label for="category" :value="__('nom de la catégorie')" />
                            <x-input id="category" class="block mt-1 w-full" type="text" name="category"
                                value="{{ old('category') }}" required autofocus />
                        </div>
                        <div class="p-3" style="margin-top:20px;">
                            <x-button class="m-3 block">
                                {{ __($submit) }}
                            </x-button>
                        </div>
                </div>
                </form>
                <div class="p-6 bg-white border-b border-gray-200 flex flex-col" style="gap:10px;">

                    @foreach ($categories as $category)
                        <div class="flex items-center" style='gap:15px;'>
                            <form method="POST" action="{{ route('admin.category.update', $category) }}" class="flex items-center" style='gap:15px;'>
                                @csrf
                                {{ method_field('PUT') }}
                                <x-input type="text" name="category" value="{{ $category->name }}" />
                                <x-button  type="submit" style="background:rgb(241, 176, 54);">Modifier</x-button>
                            </form>
                            <form action="{{ route('admin.category.destroy', $category) }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                                <x-button type="submit" style="background:rgb(241, 54, 54);"
                                    onclick="return confirm('Es-tu sûr de vouloir supprimer cette catégorie')">Supprimer
                                </x-button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
