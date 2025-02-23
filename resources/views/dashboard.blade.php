<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Dashboard</title>
</head>
<body>

    <h1>Your Video Games</h1>

    <form method="GET" action="{{ url('dashboard') }}">
        <label for="genre">Filter by Genre:</label>
        <select name="genre" id="genre">
            <option value="">All Genres</option>
            <option value="RPG">RPG</option>
            <option value="Action">Action</option>
            <option value="Adventure">Adventure</option>
        </select>

        <label for="sort">Sort by Release Date:</label>
        <select name="sort" id="sort">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select>

        <button type="submit">Apply Filters</button>
    </form>

    <ul>
        @foreach ($games as $game)
            <li>
                <h3>{{ $game->title }}</h3>
                <p>{{ $game->description }}</p>
                <p>Release Date: {{ $game->release_date }}</p>
                <p>Genre: {{ $game->genre }}</p>
            </li>
        @endforeach
    </ul>

</body>
</html>
