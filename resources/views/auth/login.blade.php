<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login|Connexion</title>
</head>
                                                {{-- LIEN FONT AWESOME --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

                                                {{-- LIEN BOOSTRAP --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


                                                {{-- LIEN SWEET ALERT --}}


                                                {{-- LIEN TEMPLATE NICE ADMIN --}}
                                                <!-- Google Fonts -->
<link href="https://fonts.gstatic.com" rel="preconnect">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

                                                <!-- Vendor CSS Files -->
<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
<link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
<link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

                                                <!-- Template Main CSS File -->
<link href="assets/css/style.css" rel="stylesheet">


                                                {{-- lien font ubuntu --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Ubuntu+Sans+Mono:ital,wght@0,400..700;1,400..700&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

                                                {{-- ma feuille de style --}}
<style>

    body {
    font-family: "Ubuntu", serif;
    font-weight: 700;
    font-style: normal;
    background: linear-gradient(rgba(255, 165, 0, 0.5), rgba(255, 165, 0, 0.5)),
        url("{{ asset("img/ciel.jpg") }}");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh;
    margin: 0;
}

</style>
                                                {{-- LIEN TAILWINDS --}}
@vite('resources/css/app.css')

<body>


    <div class="container">

        <section class="py-4 section register min-vh-100 d-flex flex-column align-items-center justify-content-center">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="py-4 d-flex justify-content-center">
                  <a href="index.html" class="w-auto logo d-flex align-items-center">
                    <img src="" alt="">
                    <span class="d-none d-lg-block"></span>
                  </a>
                </div><!-- End Logo -->

                <div class="mb-3 card">

                  <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="content-center w-20 h-20 pt-2 pb-2 bg-gray-100 rounded-full" style="background-image: url('{{ asset("img/cnps.png") }}'); background-size: cover;background-position: center;">
                        </div>
                      <h1>GESTION DES INVENTAIRES</h1>
                    </div>
                    <form method="POST" action="{{ route('login') }}" class="mt-3 row g-3 needs-validation" novalidate>
                        @csrf


                        @session('error')
                            <div class="alert alert-danger" role="alert">
                                {{ $value }}
                            </div>
                        @endsession

                      <div class="col-12">
                        <label for="yourUsername" class="form-label">E-mail</label>
                        <div class="input-group has-validation">
                          <span class="input-group-text" id="inputGroupPrepend">@</span>
                          <input type="text" name="email" class="form-control" id="yourEmail" required>
                          @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                        </div>
                      </div>

                      <div class="col-12">
                        <label for="yourPassword" class="form-label">Mot de passe</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">*</span>
                            <input type="password" name="password" class="form-control" id="yourPassword" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>

                      </div>

                      <div class="col-12">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                          <label class="form-check-label" for="rememberMe">se souvenir de moi</label>
                        </div>
                      </div>
                      <div class="col-12">
                        <button class="bg-orange-600 hover:bg-orange-400 btn btn-sm w-100 text-cyan-50 hover:text-cyan-100" type="submit">connexion</button>
                      </div>
                      <div class="col-12">

                        <p class="m-0 text-center text-secondary">pas de compte ? &#x1F605; <a href="{{ route('register') }}" class="link-primary text-decoration-none">S'inscrire</a></p>

                      </div>
                    </form>

                  </div>
                </div>

                <div class="text-sm text-gray-100 ">
                  <a href="#">Koffi Kan Jean-Eudes|Stagiaire CNPS</a>
                </div>

              </div>
            </div>
          </div>

        </section>

      </div>





</body>

</html>
