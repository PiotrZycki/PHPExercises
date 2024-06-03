<x-guest-layout>
    <h2>List of books</h2>
    @if($books == "[]")
        <p>There are no books in the database.</p>
    @else
        <table>
            <tr>
                <th>ISBN</th>
                <th>Title</th>
                <th>Description</th>
                <th></th>
            </tr>
            @foreach($books as $book)
                <tr>
                    <td>{{$book->isbn}}</td>
                    <td>{{$book->title}}</td>
                    <td>@markdown($book->description)</td>
                    <td><a href="{{route('books.show', $book)}}">Details</a></td>
                </tr>
            @endforeach
        </table>
    @endif
    <button onclick="location.href='/books/create'">Create new book</button>
</x-guest-layout>
