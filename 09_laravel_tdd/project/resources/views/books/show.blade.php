<x-guest-layout>
    <h2>Viewing a book</h2>
    <div>
        [{{$book->isbn}}] {{$book->title}}
        @markdown($book->description)
        <a href="{{route('books.edit', $book)}}">Edit</a></br>
        <form action="{{route('books.destroy', $book)}}" method="post">
            @csrf
            @method('delete')
            <input type="submit" value="Delete">
        </form>
    </div>
</x-guest-layout>
