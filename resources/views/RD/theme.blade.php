<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Theme</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="{{ $theme === 'dark' ? 'bg-dark' : 'bg-light' }}">
    <nav class="navbar navbar-expand-lg {{ $theme === 'dark' ? 'navbar-dark' : 'navbar-light' }}">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('theme.cookie.delete')}}" tabindex="-1"
                            aria-disabled="true">Delete Cookie</a>
                    </li>
                </ul>

                {{-- Change Theme --}}
                <span class="navbar-text">
                    <form action="{{route('theme.cookie.create-update')}}" method="post" class="d-flex">
                        @csrf
                        <input type="radio" name="theme" id="theme" value="{{ $theme === 'dark' ? 'light' : 'dark' }}"
                            class="btn-check" onchange="this.form.submit()">
                        <label for="theme" class="btn btn-secondary">
                            <i class="{{ $theme === 'dark' ? 'fas fa-sun text-warning' : 'fas fa-moon' }}">Mode</i>
                        </label>
                    </form>
                </span>

            </div>
        </div>
    </nav>
</body>
