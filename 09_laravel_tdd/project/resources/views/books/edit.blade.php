<x-guest-layout>
    <h2>Editing a book</h2>

    <form action="/books/{{$book->id}}" method="POST" >
        @csrf
        @method('PUT')
        <div class="mt-4">
            <x-input-label for="isbn">ISBN:</x-input-label>
            <x-text-input type="text" name="isbn" value="{{$book->isbn}}"/>
            <x-input-error :messages="$errors->get('isbn')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="title">Title:</x-input-label>
            <x-text-input type="text" name="title" value="{{$book->title}}"/>
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="description">Description:</x-input-label>
            <x-text-input type="text" name="description" value="{{$book->description}}"/>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                Update
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
