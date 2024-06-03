<h1>Tickets</h1>

<form method="post" action="/tickets/store">
    <label for="name">Name</label>
    <input type="text" name="name">
    <br>
    <label for="surname">Surname</label>
    <input type="text" name="surname">
    <br>
    <label for="email">E-Mail</label>
    <input type="email" name="email">
    <br>
    <h3>Select number of tickets</h3>
    <br>
    <label for="normal">Normal</label>
    <select name="normal">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select>
    <br>
    <label for="discounted">Discounted</label>
    <select name="discounted">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select>
    <br>
    <input type="submit" value="Book">
</form>