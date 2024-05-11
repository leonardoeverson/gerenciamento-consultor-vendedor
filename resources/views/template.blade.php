<!doctype html>
<html>
<head>
    <title>Gerenciamento de Consultores e Feedbacks</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome/css/all.min.css') }}">
    <script src="https://unpkg.com/htmx.org@1.9.12" integrity="sha384-ujb1lZYygJmzgSwoxRggbCHcjc0rB2XoQrxeTUQyRjrOnlCoYta87iKBWq3EsdM2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<header>
    <div class="px-3 py-2 text-bg-dark border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="home"><use xlink:href="/home"></use></svg>
                </a>
                <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                    <li>
                        <a href="/" class="nav-link text-white">
                            <div class="d-block mx-auto mb-1 text-center">
                                <i class="bi bi-house me-1"></i>
                            </div>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="/feedbacks" class="nav-link text-white">
                            <div class="d-block mx-auto mb-1 text-center">
                                <i class="bi bi-chat me-1"></i>
                            </div>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="/consultores" class="nav-link text-white">
                            <div class="d-block mx-auto mb-1 text-center">
                                <i class="bi bi-people me-1"></i>
                            </div>
                            Consultores
                        </a>
                    </li>
                    <li>
                        <a href="/advertencias" class="nav-link text-white">
                            <div class="d-block mx-auto mb-1 text-center">
                                <i class="bi bi-exclamation-triangle me-1"></i>
                            </div>
                            Advertências
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

<div class="container-fluid" id="container">
    <main>
        <?= $view ?>
    </main>
</div>
</body>
</html>