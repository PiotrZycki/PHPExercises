<x-guest-layout>
    <h2>Creating new book</h2>

    <form action="{{route('books.store')}}" method="POST" >
        @csrf
        <div class="mt-4">
            <x-input-label for="isbn">ISBN:</x-input-label>
            <x-text-input type="text" name="isbn" value="{{old('isbn')}}"/>
            <x-input-error :messages="$errors->get('isbn')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="title">Title:</x-input-label>
            <x-text-input type="text" name="title" value="{{old('title')}}"/>
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="description">Description:</x-input-label>
            <x-text-input type="text" name="description" value="{{old('description')}}"/>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                Create
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
