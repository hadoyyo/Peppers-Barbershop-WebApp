<?php
session_start(); 
// Includes
include_once __DIR__ . '/functions/includes.php';

$userName = $um->getLoggedInUserName($db, $sessionId);
?>

<!doctype html>
<html class="h-100" lang="pl">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
  <meta name="description" content="PEPPER's BARBERSHOP - Mistrzowie w swoim fachu">
  <meta name="author" content="">
  <meta name="HandheldFriendly" content="true">
  <title>PEPPER's BARBERSHOP</title>
  <link rel="icon" href="img/icon.png" />
  <link rel="stylesheet" href="css/theme.css">

  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="bg-black text-white mt-0" data-bs-spy="scroll" data-bs-target="#navScroll">

<!-- Basic navbar -->
<?php include_once __DIR__ . '/views/navBasic.php'; ?>

  <main>
    <div class="container">
      <div class="row d-flex justify-content-center py-vh-5 pb-0">
      <div class="anti-navbar" style="height: 5rem">
      </div>
        <div class="col-12 col-lg-10 col-xl-8">
          <div class="row">
            <div class="col-12">
              <h1 class="display-1 fw-bold color-red mt-6" data-aos="fade-right">Poznaj
                <span class="fs-4">nasz</span><br>
                zespół
              </h1>
              <p class="lead border-top pt-5 mt-5 color-red" data-aos="fade-right">Jesteśmy zespołem doświadczonych barberów, którzy kochają to, co robią. Naszą misją jest nie tylko zadbać o Twój wygląd, ale także stworzyć atmosferę, w której poczujesz się swobodnie i wyjątkowo. Poznaj naszą ekipę, ludzi pełnych energii i zaangażowania, którzy zawsze stawiają na najwyższą jakość usług.
              </p>
            </div>
          </div>
        </div>
      <div class="col-12 col-lg-10 col-xl-8">
      <!-- Zespół -->
      <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow" data-wow-delay="0.1s">
                    <div class="team-item" data-aos="fade-right">
                        <div class="team-img position-relative overflow-hidden rounded-top">
                            <img class="img-fluid" src="img/barber1.jpg" alt="">
                            <div class="team-social">
                                <a class="btn btn" href=""><i class="bi bi-instagram"></i></i></a>
                                <a class="btn btn-square" href=""><i class="bi bi-facebook"></i></a>
                            </div>
                        </div>
                        <div class="bg-black text-center p-4 rounded-bottom">
                            <h5 class="text-uppercase">Tomek</h5>
                            <span class="color-red">13 lat w branży</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow" data-wow-delay="0.1s">
                  <div class="team-item" data-aos="fade-right">
                      <div class="team-img position-relative overflow-hidden rounded-top">
                          <img class="img-fluid" src="img/barber2.jpg" alt="">
                          <div class="team-social">
                              <a class="btn btn" href=""><i class="bi bi-instagram"></i></i></a>
                              <a class="btn btn-square" href=""><i class="bi bi-facebook"></i></a>
                          </div>
                      </div>
                      <div class="bg-black text-center p-4 rounded-bottom">
                          <h5 class="text-uppercase">Luis</h5>
                          <span class="color-red">14 lat w branży</span>
                      </div>
                  </div>
              </div>
              <div class="col-lg-3 col-md-6 wow" data-wow-delay="0.1s">
                <div class="team-item" data-aos="fade-right">
                    <div class="team-img position-relative overflow-hidden rounded-top">
                        <img class="img-fluid" src="img/barber3.jpg" alt="">
                        <div class="team-social">
                            <a class="btn btn" href=""><i class="bi bi-instagram"></i></i></a>
                            <a class="btn btn-square" href=""><i class="bi bi-facebook"></i></a>
                        </div>
                    </div>
                    <div class="bg-black text-center p-4 rounded-bottom">
                        <h5 class="text-uppercase">Bartek</h5>
                        <span class="color-red">9 lat w branży</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow" data-wow-delay="0.1s">
              <div class="team-item" data-aos="fade-right">
                  <div class="team-img position-relative overflow-hidden rounded-top">
                      <img class="img-fluid" src="img/barber4.jpg" alt="">
                      <div class="team-social">
                          <a class="btn btn" href=""><i class="bi bi-instagram"></i></i></a>
                          <a class="btn btn-square" href=""><i class="bi bi-facebook"></i></a>
                      </div>
                  </div>
                  <div class="bg-black text-center p-4 rounded-bottom">
                      <h5 class="text-uppercase">Damian</h5>
                      <span class="color-red">7 lat w branży</span>
                  </div>
              </div>
          </div>
                
            </div>
        </div>
    </div>
  <!-- /Zespoł -->
  
  <!-- Godziny otwarcia -->
  <div class="mb-4 border-bottom" data-aos="fade-right"></div>
      <h1 class="mt-5 mb-4 display-1 fw-bold color-red" data-aos="fade-right">Godziny otwarcia</h1>
  </div>
  <div class="col-12 col-lg-12 col-xl-10">
       <div class="container-xxl py-5" data-aos="fade-right">
        <div class="container">
            <div class="row g-0">
                <div class="about-pic col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="h-100">
                        <img class="img-fluid h-100" src="img/img1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="bg-black h-100 d-flex flex-column justify-content-center p-5">
                        <p class="d-inline-flex bg-black color-red py-1 px-4 me-auto">Obowiązuje od: 27.12.2024</p>
                        <h1 class="text-uppercase mb-4">Barbershop czynny:</h1>
                        <div>
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <h6 class="mb-0">Poniedziałek</h6>
                                <span class="text-uppercase">9 - 17</span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <h6 class="mb-0">Wtorek</h6>
                                <span class="text-uppercase">9 - 17</span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <h6 class="mb-0">Środa</h6>
                                <span class="text-uppercase">9 - 17</span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <h6 class="mb-0">Czwartek</h6>
                                <span class="text-uppercase">9 - 17</span>
                            </div>
                            <div class="d-flex justify-content-between border-bottom py-2">
                                <h6 class="mb-0">Piątek</h6>
                                <span class="text-uppercase">9 - 17</span>
                            </div>
                            <div class="d-flex justify-content-between py-2">
                                <h6 class="mb-0">Sobota / Niedziela</h6>
                                <span class="text-uppercase color-red">Zamknięte</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <!-- /Godziny otwarcia -->

  <!-- Kontakt -->
  <div class="col-12 col-lg-10 col-xl-8">
    <div class="mt-5 border-bottom" data-aos="fade-right"></div>
    <h1 class="mt-5 mb-4 display-1 fw-bold color-red" data-aos="fade-right">Kontakt
    </h1>
  </div>
  <div class="container-xxl py-5 mb-5" data-aos="fade-right">
    <div class="container">
        <div class="row g-0 mx-1 justify-content-center">
            <div class="col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                <div class="bg-black p-5">
                <b class="color-red">PEPPER's BARBERSHOP</b>
                <p class="color-red"><br><i class="bi bi-geo-alt-fill"></i> ul. Nadbystrzycka 38A<br>
                  20-618 Lublin<br>
                  <br>
                  <i class="bi bi-telephone-fill"></i> +48 696 455 878
                  <br>
                  <br>
                  <i class="bi bi-envelope-fill"></i> peppers@barbershop.pl<br>
                <br><a href="" class="link-fancy link-fancy-light"><i class="bi bi-facebook"></i> Pepper's Barbershop</a><br>
                <br><a href="" class="link-fancy link-fancy-light"><i class="bi bi-instagram"></i> Pepper's Barbershop</a></p>
                </div>
            </div>
            <div class="col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                <div class="h-100" style="min-height: 400px;">
                    <iframe class="google-map w-100 h-100"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1249.0182859816584!2d22.548838296663778!3d51.236821341413744!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47225770b90ed75f%3A0x1b6d4cc1142112fa!2sWydzia%C5%82%20Elektrotechniki%20i%20Informatyki%20Politechniki%20Lubelskiej!5e0!3m2!1spl!2spl!4v1735316979896!5m2!1spl!2spl"
                    frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0" style="filter: grayscale(100%) invert(92%) contrast(83%); border: 0;"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Kontakt -->
</main>

<!-- Footer -->
<?php include_once __DIR__ . '/views/footer.php'; ?>

<!-- Scripts -->
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/aos.js"></script>
<script>
  AOS.init({
    duration: 800,
  });
</script>
<script>
<?php include_once __DIR__ . '/scripts/navbar.js'; ?>
</script>

</body>

</html>