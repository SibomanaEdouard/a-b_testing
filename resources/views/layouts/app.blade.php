<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Application')</title>
</head>
<body>
    <header>
        <!-- There we put the header content -->
    </header>
    
    <main>
        @yield('content')
    </main>
    
    <footer>
   <!-- there we put the footer content -->
    </footer>


</body>
</html>
