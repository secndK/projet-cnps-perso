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
                    <img src="assets/img/logo.png" alt="">
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


                    <div class="d-flex">
                        <p>Veuillez vérifier votre boite mail, un lien de vérification vous a été envoyé.</p>
                    </div>

                    @if (session('message'))
                        <p>{{ session('message') }}</p>
                    @endif


                    <form action="{{ route('verification.send') }}" method="POST">
                        @csrf

                        <div class="col-12">
                            <p class="m-0 text-center text-secondary">Je n'ai rien reçu &#x1F611;, <button type="submit" class=" btn btn-link">Renvoyer</button></p>
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
