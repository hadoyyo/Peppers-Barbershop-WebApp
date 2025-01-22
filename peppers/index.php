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
        <!-- Carousel -->
        <div class="anti-navbar" style="height: 5rem"></div>
        <div class="container-fluid p-0 mb-5">
          <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                  <div class="carousel-item active">
                      <img class="w-100" src="img/carousel1.jpg" alt="Mistrzowie w swoim fachu">
                      <div class="carousel-caption d-flex align-items-center justify-content-center text-start">
                          <div class="mx-sm-5 px-5" style="max-width: 900px;">
                              <h1 class="display-1 fw-bold mb-4 animated slideInDown color-red">Mistrzowie w swoim fachu</h1>
                              <a href="bookings.php" class="link-fancy link-fancy-light"><h4 class="fw-bold mb-4 animated slideInDown color-red">Przekonaj się sam <i class="bi bi-arrow-right"></i></h4></a>
                          </div>
                      </div>
                  </div>
                  <div class="carousel-item">
                      <img class="w-100" src="img/carousel2.jpg" alt="Zarezerwuj wizytę - zadzwoń!">
                      <div class="carousel-caption d-flex align-items-center justify-content-center text-start">
                          <div class="mx-sm-5 px-5" style="max-width: 900px;">
                            <h1 class="display-1 fw-bold mb-4 animated slideInDown color-red">Zarezerwuj wizytę - zadzwoń!</h1>
                            <h4 class="fw-bold mb-4 animated slideInDown color-red"><i class="bi bi-telephone-fill"></i> +48 696 455 878</h4>
                          </div>
                      </div>
                  </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                  data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true" style="background-image: url('img/previous.png');"></span>
                  <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                  data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true" style="background-image: url('img/next.png');"></span>
                  <span class="visually-hidden">Next</span>
              </button>
          </div>
      </div>
      <!-- /Carousel -->
        <div class="col-12 col-lg-10 col-xl-8">
          <div class="row">
            <div class="col-12">
              <h1 class="display-1 fw-bold color-red" data-aos="fade-right">Stań się
                <span class="fs-4">naszą</span><br>
                wizytówką
              </h1>
              <p class="lead border-top border-bottom pb-5 pt-5 mt-5 color-red" data-aos="fade-right">Każdy z nas traktuje fryzjerstwo jak poważną karierę, a nie modny, krótkotrwały trend. Dlatego jeśli szukasz fryzjera na dłużej – wskocz do portfolio jednego z naszych ekspertów.
                Dbamy o włosy, brody i wąsy wszystkich panów, dla których liczy się styl i pięciogwiazdkowa usługa. Jeśli w salonie fryzjerskim stawiasz przede wszystkim na rezultaty na głowie, a modna barberska otoczka jest przez Ciebie słusznie stawiana dopiero na drugim miejscu – poczujesz się tu dobrze.
              </p>
            </div>
          </div>
        </div>
        <!-- Usługi -->
      <div class="col-12 col-lg-10 col-xl-8">
          <div class="mb-2 wow" data-aos="fade-right" style="max-width: 600px;">
            <h1 class="pt-5 pb-3 display-1 fw-bold color-red">Oferowane usługi</h1>
          </div>
      </div>
          <div class="row g-3 col-lg-10">
              <div class="col-lg-4 col-md-6 wow" data-aos="fade-up" data-wow-delay="0.1s">
                  <div class="rounded service-item position-relative overflow-hidden bg-secondary d-flex h-100 p-5 ps-0">
                      <div class="ps-4">
                          <h3 class="mb-3">Strzyżenie włosów</h3>
                          <p>Klasyczne fryzury męskie - dotyczy włosów krótkich, średnich i długich. Doradztwo, mycie, strzyżenie i modelowanie.</p>
                          <span class="text-uppercase color-red">100 PLN</span>
                      </div>
                      <a class="btn" href="bookings.php"><i class="bi bi-plus-lg"></i></a>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6 wow" data-aos="fade-up" data-wow-delay="0.3s">
                  <div class="rounded service-item position-relative overflow-hidden bg-secondary d-flex h-100 p-5 ps-0">
                      <div class="ps-4">
                          <h3 class=" mb-3">Strzyżenie zarostu</h3>
                          <p>Doradztwo, strzyżenie, trymowanie oraz wyrównyanie konturów, czyli wszystko, czego potrzebuje twoja broda.</p>
                          <span class="text-uppercase color-red">70 PLN</span>
                      </div>
                      <a class="btn" href="bookings.php"><i class="bi bi-plus-lg"></i></a>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6 wow" data-aos="fade-up" data-wow-delay="0.5s">
                  <div class="rounded service-item position-relative overflow-hidden bg-secondary d-flex h-100 p-5 ps-0">
                      <div class="ps-4">
                          <h3 class=" mb-3">Strzyżenie włosów i zarostu</h3>
                          <p>Komplet, czyli fachowe doradztwo, strzyżenie włosów i zarostu, zabiegi pielęgnacyjne.</p>
                          <span class="text-uppercase color-red">130 PLN</span>
                      </div>
                      <a class="btn" href="bookings.php"><i class="bi bi-plus-lg"></i></a>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6 wow" data-aos="fade-up" data-wow-delay="0.1s">
                  <div class="rounded service-item position-relative overflow-hidden bg-secondary d-flex h-100 p-5 ps-0">
                      <div class="ps-4">
                          <h3 class=" mb-3">Repigmentacja zarostu</h3>
                          <p>Młodszy wygląd, poprzez odzyskanie naturalnego koloru zarostu.</p>
                          <span class="text-uppercase color-red">35 PLN</span>
                      </div>
                      <a class="btn" href="bookings.php"><i class="bi bi-plus-lg"></i></a>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6 wow" data-aos="fade-up" data-wow-delay="0.3s">
                  <div class="rounded service-item position-relative overflow-hidden bg-secondary d-flex h-100 p-5 ps-0">
                      <div class="ps-4">
                          <h3 class=" mb-3">Repigmentacja zarostu i włosów</h3>
                          <p>Komplet usług repigmentacji, przywrócenie pierwotnego koloru włosów i zarostu.</p>
                          <span class="text-uppercase color-red">60 PLN</span>
                      </div>
                      <a class="btn" href="bookings.php"><i class="bi bi-plus-lg"></i></a>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6 wow" data-aos="fade-up" data-wow-delay="0.5s">
                  <div class="rounded service-item position-relative overflow-hidden bg-secondary d-flex h-100 p-5 ps-0">
                      <div class="ps-4">
                          <h3 class=" mb-3">Farbowanie</h3>
                          <p>Dopasowane do preferencji lub odcienia skóry - odśwież swój wizerunek pod okiem doświadczonego barbera.</p>
                          <span class="text-uppercase color-red">110 PLN</span>
                      </div>
                      <a class="btn" href="bookings.php"><i class="bi bi-plus-lg"></i></a>
                  </div>
              </div>
          </div>
          <div class="col-12 col-lg-10 col-xl-8">
            <div class="mt-6 mb-4 border-bottom" data-aos="fade-right"></div>
          </div>
  <!-- /Usługi -->

  <!-- Opinie -->
  <div class=" col-xl-8">
    <h1 class="mt-5 mb-4 display-1 fw-bold color-red" data-aos="fade-right">Opinie
      <span class="fs-4">naszych</span><br>
      klientów
    </h1>
  </div>
  <div>
    <div class="container px-vw-5 mb-5">
      <div class="row d-flex gx-4 align-items-center">
        <div class="col-12 col-lg-6">
          <div class="rounded-5 bg-black p-5 shadow mt-4 gradient1" data-aos="zoom-in-up">
            <div class="fs-star pb-2">
            <i class="bi bi-star-fill pe-2"></i><i class="bi bi-star-fill pe-2"></i><i class="bi bi-star-fill pe-2"></i><i class="bi bi-star-fill pe-2"></i><i class="bi bi-star-fill"></i>
            </div>
            <p class="lead">"Pierwszy raz fryzura po dwóch tygodniach wygląda ciągle świeżo. Super atmosfera i przede wszystkim profesjonalizm. W pełni polecam!"</p>
            <div class="d-flex justify-content-start align-items-center border-top1 pt-3 ">
              <img src="img/client1.jpg" width="72" height="72" class="rounded-circle me-3" alt="Klient">
              <div>
                <span class="h6 fw-5">Jakub Jankowski</span><br>
              </div>
            </div>
          </div>
          <div class="rounded-5 bg-black p-5 shadow mt-4 gradient2" data-aos="zoom-in-up">
          <div class="fs-star pb-2">
            <i class="bi bi-star-fill pe-2"></i><i class="bi bi-star-fill pe-2"></i><i class="bi bi-star-fill pe-2"></i><i class="bi bi-star-fill pe-2"></i><i class="bi bi-star-half"></i>
            </div>
            <p class="lead">"Trafiłem tu z przypadku. Barbershop mega klimatyczny, obsługa ziomalska, a robota Juniora przed wieczornym weselem pierwsza klasa 😎 Gorąco polecam! Nie będziecie żałować ✌🏼"</p>
            <div class="d-flex justify-content-start align-items-center border-top1 pt-3">
              <img src="img/client2.jpg" width="72" height="72" class="rounded-circle me-3" alt="Klient">
              <div>
                <span class="h6 fw-5">Łukasz Kabala</span><br>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6">
          <div class="rounded-5 bg-black p-5 shadow mt-4 gradient1" data-aos="zoom-in-up">
            <div class="fs-star pb-2">
            <i class="bi bi-star-fill pe-2"></i><i class="bi bi-star-fill pe-2"></i><i class="bi bi-star-fill pe-2"></i><i class="bi bi-star-fill pe-2"></i><i class="bi bi-star-fill"></i>
            </div>
            <p class="lead">"Z czystym sumieniem mogę polecić każdemu to miejsce. Przede wszystkim pracują tu profesjonaliści, którzy znają się na swojej robocie. Lokal mega klimatyczny i wyróżnia się pośród innych miejsc, super atmosfera, mega ludzie. Polecam!"</p>
            <div class="d-flex justify-content-start align-items-center border-top1 pt-3">
              <img src="img/client3.jpg" width="72" height="72" class="rounded-circle me-3" alt="Klient">
              <div>
                <span class="h6 fw-5">Maciej Kamiński</span><br>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Opinie -->
  <div class="col-12 col-lg-10 col-xl-8">
    <div class="mt-5 border-bottom" data-aos="fade-right"></div>
  </div>
  <div class="w-100 overflow-hidden position-relative bg-black text-white"  data-aos="fade-right">
    <div class="position-absolute w-100 h-100 bg-black opacity-75 top-0 start-0"></div>
    <div class="container py-vh-2 position-relative text-center">
      <div class="row d-flex align-items-center justify-content-center py-vh-5">
        <div class="col-12 col-xl-10">
          <span class="h5 text-secondary fw-lighter">Nie czekaj...</span>
          <h1 class="display-huge mb-3 lh-1 color-red">Skorzystaj z systemu rezerwacji online</h1>
        </div>
        <div class="col-12 col-xl-8">
          <p class="lead text-secondary">Załóż konto, wybierz ulubione usługi, datę i godzinę. Poczekaj na akceptecję terminu. Ciesz się najwyższą jakością usług barberskich.</p>
        </div>
        <div class="col-12 text-center">
          <a href="bookings.php" class="btn btn-xl custom-btn">Umów wizytę online
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              class="bi bi-arrow-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd"
                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
            </svg>
          </a>
        </div>
      </div>
    </div>

  </div>

  </main>

  <!-- Footer -->
  <?php include_once __DIR__ . '/views/footer.php'; ?>

  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/aos.js"></script>
  <script>
    AOS.init({
      duration: 800,
    });
  </script>

  <!-- Navbar scripts -->
  <script>
  <?php include_once __DIR__ . '/scripts/navbar.js'; ?>
  </script>

</body>

</html>