<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Web Crawler') }}</title>
</head>

<body>
    <h1>Web Crawler</h1>

    <!-- Display success or error messages -->
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <!-- Input form for the URL -->
    <form action="{{ route('crawls.store') }}" method="POST">
        @csrf
        <label for="url">Enter URL to Crawl:</label>
        <input type="url" id="url" name="url" required>
        <button type="submit">Crawl Data</button>
    </form>
</body>

</html>
