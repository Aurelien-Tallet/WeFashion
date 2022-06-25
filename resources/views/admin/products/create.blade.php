<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($submit . ' un article') }}
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
                            <x-label for="name" :value="__('nom')" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                value="{{ isset($product) ? old('name', $product->name) : '' }}" required autofocus />
                            {{-- value="{{isSet($product) ? old('name' , $product->name)  : ''}}" required autofocus /> --}}
                        </div>
                        <div>
                            <x-label for="reference" :value="__('Réference')" />
                            <x-input id="reference" class="block mt-1 w-full" type="text" name="reference"
                                value="{{ isset($product) ? old('reference', $product->reference) : '' }}" required
                                autofocus />
                        </div>
                        <div>
                            <x-label for="description" :value="__('description')" />
                            <x-input id="description" class="block mt-1 w-full" type="text" name="description"
                                value="{{ isset($product) ? old('', $product->description) : '' }}" required
                                autofocus />
                        </div>
                        <div>
                            <x-label for="price" :value="__('prix en €')" />
                            <input type="number" class="form-control" id="price" name="price" step="0.01"
                                min="0.01" max="9999.99"
                                value="{{ isset($product) ? $product->price : '' }}" placeholder="prix"
                                required>
                        </div>
                        <div class="flex" style="gap:30px;">
                            <div>
                                <x-label for="status" :value="__('status')" />
                                <select id="status" name="status" class="form-control block">
                                    <option value="publish"
                                        {{ isset($product) && $product->status == 'publish' ? 'selected' : '' }}>
                                        Publié
                                    </option>
                                    <option value="unpublish"
                                        {{ isset($product) && $product->status == 'unpublish' ? 'selected' : '' }}>Non
                                        Publié</option>
                                </select>
                            </div>
                            <div>
                                <x-label for="discount" :value="__('Réduction')" />
                                <select id="discount" name="discount" class="form-control block">
                                    <option value="discount"
                                        {{ isset($product) && old('discount', $product->discount) == 'discount' ? 'selected' : '' }}>
                                        Soldé</option>
                                    <option value="standard"
                                        {{ isset($product) && old('standard', $product->discount) == 'standard' ? 'selected' : '' }}>
                                        Standard</option>
                                </select>
                            </div>
                            <div>
                                <x-label for="category" :value="__('Categorie')" />
                                <select id="category" name="category" class="form-control block">
                                    <option value="">Choisir une catégorie</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ isset($product) && $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <x-label :value="__('Tailles')" />
                            <div class="flex" style="gap:15px; padding-bottom:20px;">
                                @foreach ($sizes as $size)
                                    <div>
                                        <x-label for="sizes" :value="__($size->name)" />
                                        <input type="checkbox" class="form-control block" name="sizes[]"
                                            value="{{ $size->id }}"
                                            {{ isset($productSizes[$size->id]) ? 'checked' : '' }}>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                        <div>
                            <x-label for="picture" :value="__('Image')" />
                            <input type="file" name="image" id="picture" accept="jpeg,png,jpg', image.jpeg"
                                {{ isset($product) ?: 'required' }} value="IMAGE" /> {{isSet($product) ? $product->picture->name : ''}}
                        </div>
                        @if (isset($product))
                            <div>
                                <img src="{{ asset('/storage/image/' . $product->picture->name) }}" />
                            </div>
                        @endif
                        <div style="margin-top:20px;">

                            <x-button class="m-3 block">
                                {{ __($submit) }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
