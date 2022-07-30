<?php
if (isset($_POST['submit'])) {
    $nombre = $_POST['fname'];
    $correo = $_POST['email'];
    $telefono = $_POST['tel'];
    $comentarios = $_POST['comentarios'];

    $ip = $_SERVER['REMOTE_ADDR'];
    $captcha = $_POST['g-recaptcha-response'];
    $secretKey = "6LddijMhAAAAAJBFYNRsEHax7PyngJN_y4sWFna-";

    $res = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha&remoteip=$ip");

    $atributos = json_decode($res, TRUE);

    // $errors = array();
    if (!$atributos['success']) {
        $errors[] = 'Verificación captcha obligatoria';
    }
    if (count($errors) == 0) {
        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );

        $from = 'admin@pvj.mx';
        $to = "fgcarpinteria@pvj.mx";
        $subject = "Contacto FG Carpinteria";

        $message = "NOMBRE : " . $nombre  . ",\r\n";
        $message .= "CORREO : " . $correo . " \r\n";
        $message .= "TELEFONO : " . $telefono . " \r\n";
        $message .= "IP : " . $ip . " \r\n";
        $message .= "COMENTARIOS : " . $comentarios . " \r\n";

        $headers = "From:" . $from . " \r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . " \r\n";
        $headers .= "Mime-Version: 1.0 \r\n";
        $headers .= "Content-Type: text/plain";
        mail($to,$subject, utf8_decode($message), $headers);
        echo "The email message was sent.";
        
        header("Location:https://fgcarpinteria.pvj.mx");
    }

  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Carpinteria en Puerto Vallarta y Bahía de Banderas. Reparación de muebles y elaboración de muebles."
    />
    <meta property="og:title" content="FG - Carpintería" />
    <meta
      property="og:description"
      content="Carpinteria en Puerto Vallarta y Bahía de Banderas. Reparación de muebles y elaboración de muebles."
    />
    <meta property="og:image" content="./assets/preview.png" />
    <title>FG Carpinteria</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link
      rel="shortcut icon"
      href="./assets/logo_black.ico"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" href="styles/navbar.css" />
    <link rel="stylesheet" href="styles/carousel.css" />
    <link rel="stylesheet" href="styles/togglebtn.css" />
    <link rel="stylesheet" href="styles/servicios.css" />
    <link rel="stylesheet" href="styles/galeria.css" />
    <link rel="stylesheet" href="styles/anuncio.css" />
    <link rel="stylesheet" href="styles/contacto.css" />
    <link rel="stylesheet" href="styles/footer.css" />
    <link rel="stylesheet" href="styles/modal.css" />
    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
  <?php
            if (isset($errors)) {
                if (count($errors) > 0) {
            ?>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php
                                foreach ($errors as $error) {
                                    echo $error . '<br>';
                                }
                                ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
    <header class="header">
      <nav class="nav container" id="nav">
        <a href="/" class="nav_logo">
          <img src="./assets/logo.png" alt="logo.png" />
        </a>
        <ul class="nav_links">
          <li class="nav_item">
            <a href="/" class="nav_link">INICIO</a>
          </li>
          <li class="nav_item">
            <a href="#productos-y-servicios" class="nav_link"
              >PRODUCTOS Y SERVICIOS</a
            >
          </li>
          <li class="nav_item">
            <a href="#gallery" class="nav_link">GALERIA</a>
          </li>
          <li class="nav_item">
            <a href="#contacto" class="nav_link">CONTACTO</a>
          </li>
          <p>
            <label class="switch">
              <input type="checkbox" class="check" />
              <span class="slider"></span>
            </label>
          </p>
        </ul>
        <a href="#nav" class="nav_hamburger"
          ><img
            class="nav_icon"
            src="../assets/nav_menu.svg"
            alt="icon_hamburguer"
        /></a>
        <a href="#" class="nav_close"
          ><img class="nav_icon" src="../assets/nav_close.svg" alt="icon_close"
        /></a>
      </nav>
    </header>

    <!-- START SLIDER -->

    <main id="container-slider">
      <a href="javascript: fntExecuteSlide('prev');" class="arrowPrev"
        ><i class="fas fa-chevron-circle-left"></i
      ></a>
      <a href="javascript: fntExecuteSlide('next');" class="arrowNext"
        ><i class="fas fa-chevron-circle-right"></i
      ></a>
      <ul class="listslider">
        <li><a itlist="itList_0" href="#" class="item-select-slid"></a></li>
        <li><a itlist="itList_1" href="#"></a></li>
        <li><a itlist="itList_2" href="#"></a></li>
      </ul>
      <ul id="slider">
        <li
          style="
            background-image: url('./assets/img/main.JPG');
            z-index: 0;
            opacity: 1;
          "
        >
          <div class="content_slider">
            <div>
              <h1>PRODUCTOS Y SERVICIOS DE CARPINTERIA</h1>
              <p>
                Descubre nuestra gran variedad de productos y servicios que
                tenemos para ti.
              </p>
              <a href="#productos-y-servicios" class="btnSlider">Ver más</a>
            </div>
          </div>
        </li>
        <li style="background-image: url('./assets/img/main_2.JPG')">
          <div class="content_slider">
            <div>
              <h2>DESCUBRE NUESTRO TRABAJO</h2>
              <p>
                Mira nuestro portafolio de trabajo en la sección de galería y
                descubre todo lo que podemos hacer para ti.
              </p>
              <a href="#gallery" class="btnSlider">Ver galería</a>
            </div>
          </div>
        </li>
        <li style="background-image: url('./assets/img/main_3.JPG')">
          <div class="content_slider">
            <div>
              <h2>PONTE EN CONTACTO</h2>
              <p>Escribenos y muy pronto nos pondremos en contacto contigo.</p>
              <a href="#contacto" class="btnSlider">Contactanos</a>
            </div>
          </div>
        </li>
      </ul>
    </main>
    <!-- END SLIDER -->

    <!-- Productos y servicios -->
    <section id="productos-y-servicios" class="servicios">
      <div class="servicios-contain">
        <div class="servicios-productos">
          <div class="servicios-list">
            <h2>Productos</h2>
            <ul class="list">
              <li class="list-item">Comedores para interiores y exteriores</li>
              <li class="list-item">Cocinas integrales</li>
              <li class="list-item">Salas</li>
              <li class="list-item">Muebles en general</li>
            </ul>
          </div>
          <div class="servicios-list">
            <h2>Servicios</h2>
            <ul class="list">
              <li class="list-item">Elaboración de muebles personalizados</li>
              <li class="list-item">Reparación de muebles dañados</li>
              <li class="list-item">Restauración de muebles maltratados</li>
              <li class="list-item">Tratamiento preventivo contra polilla</li>
            </ul>
          </div>
        </div>
        <div class="servicios-img">
          <img src="./assets/img/cama.JPG" alt="img_cama" />
          <img src="./assets/img/sala_juguetero.JPG" alt="sala_juguetero" />
          <img src="./assets/img/main_2.JPG" alt="recepcion" />
          <img src="./assets/img/servicios_3.JPG" alt="recepcion" />
        </div>
        <div class="servicios-info">
          <p>
            Los servicios solo estan disponibles para el área de Puerto Valalrta
            y Bahia de Banderas. El envio de productos se efectuara a través de
            paqueteria a convenir. Para más información no dude en contactarnos.
          </p>
        </div>
      </div>
    </section>
    <!-- Productos y servicios -->

    <!-- Division -->
    <section class="anuncio">
      <div class="anuncio-container">
        <div class="anuncio-imagen">
          <img src="./assets/madera.jpeg" alt="imagen-madera" />
        </div>
        <div>
          <h2>Expertos en todo tipo de madera.</h2>
          <h4>Conocemos muy bien nuestra materia prima.</h4>
          <p>
            Trabajo de calidad con todo tipo de madera como pino, parota,
            tablaroca y muchas más. Tus productos estarás hechos de la mejor
            calidad y protejidos completamente.
          </p>
        </div>
      </div>
    </section>
    <!-- Division -->

    <div id="boxes">
      <!-- #customize your modal window here -->

      <div class="window">
        <div id="modal-grid">
          <aside class="modal-box-img">
            <img
              class="modal-img"
              src="./assets/img/390e0628-7844-40f1-bf44-f58a504c8273.JPG"
              alt="modal"
            />
          </aside>
          <aside class="modal-text">
            <h1 id="modal-title"></h1>
            <p id="modal-desc"></p>
          </aside>
          <!-- close button is defined as close class -->
          <!-- <a class="close" popup-close="popup-1" href="javascript:void(0)">x</a>     -->
        </div>
      </div>
    </div>
    <!-- Do not remove div#mask, because you'll need it to fill the whole screen -->
    <div id="mask"></div>
    <!-- Gallery -->
    <section id="gallery" class="gallery-bg">
      <div class="grid-gallery">
        <!-- Name Gallery -->
        <div id="name-gallery">
          <h2 class="gallery-name">Galeria</h2>
          <p>Descrubre nuestro trabajo.</p>
        </div>
        <!-- Top Gallery -->
        <div id="top-gallery">
          <div id="grid-pictures">
            <div class="gallery-picture" href=".window">
              <img
                class="main-img"
                src="./assets/img/galeria_1.jpg"
                alt="imagen-galeria"
              />
              <h1>Espejo</h1>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum
                reiciendis, repellat non vel cumque doloribus accusamus sunt
                provident recusandae a dolorum officiis, obcaecati at voluptates
                magnam labore, vero laboriosam delectus?
              </p>
              <div class="lupa-img">
                <div class="lupa">
                  <img src="./assets/svg/lupa.svg" width="100" height="100" />
                </div>
              </div>
            </div>
            <div class="gallery-picture" href=".window">
              <img
                class="main-img"
                src="./assets/img/galeria_2.jpg"
                alt="imagen-galeria"
              />
              <h1>Isla Cocina</h1>
              <p>
                Cocina integral elaborada con madera de pino en color perla.
                Cajones corredizos amplios y gabinetes con puertas en partida de
                dos aguas. It was popularised in the 1960s with the release of
                Letraset sheets containing Lorem Ipsum passages.
              </p>
              <div class="lupa-img">
                <div class="lupa">
                  <img src="./assets/svg/lupa.svg" width="100" height="100" />
                </div>
              </div>
            </div>
            <div class="gallery-picture" href=".window">
              <img
                class="main-img"
                src="./assets/img/galeria_3.jpg"
                alt="imagen-galeria"
              />
              <h1>Cama</h1>
              <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                Tenetur hic repellat vel sit, obcaecati praesentium eius fugiat
                iure odio voluptatibus ut, placeat tempore perspiciatis dolorum
                sunt doloremque sequi est at!
              </p>
              <div class="lupa-img">
                <div class="lupa">
                  <img src="./assets/svg/lupa.svg" width="100" height="100" />
                </div>
              </div>
            </div>
            <div class="gallery-picture" href=".window">
              <img
                class="main-img"
                src="./assets/img/galeria_4.jpg"
                alt="imagen-galeria"
              />
              <h1>Espejo</h1>
              <p>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum
                labore libero alias, dolor eius fuga! Rerum eius, delectus nisi
                perspiciatis accusantium labore deleniti necessitatibus? Fugit
                mollitia iure recusandae quos magni?
              </p>
              <div class="lupa-img">
                <div class="lupa">
                  <img src="./assets/svg/lupa.svg" width="100" height="100" />
                </div>
              </div>
            </div>
            <div class="gallery-picture" href=".window">
              <img class="main-img" src="./assets/img/galeria_5.jpg" alt="" />
              <h1>Alacena</h1>
              <p>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                Consequatur vel hic veritatis itaque molestias, neque
                perferendis? Iure esse sapiente, quo praesentium nisi odit sed
                debitis doloribus voluptatum voluptate dolorum delectus.
              </p>
              <div class="lupa-img">
                <div class="lupa">
                  <img src="./assets/svg/lupa.svg" width="100" height="100" />
                </div>
              </div>
            </div>
            <div class="gallery-picture" href=".window">
              <img
                class="main-img"
                src="./assets/img/galeria_6.jpg"
                alt="galeria-6"
              />
              <h1>Sala</h1>
              <p>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                Necessitatibus qui magnam cupiditate facilis nihil, nulla in
                exercitationem quas unde quasi nemo ullam, expedita aliquam
                explicabo atque officia eius asperiores et?
              </p>
              <div class="lupa-img">
                <div class="lupa">
                  <img src="./assets/svg/lupa.svg" width="100" height="100" />
                </div>
              </div>
            </div>
            <div class="gallery-picture" href=".window">
              <img
                class="main-img"
                src="./assets/img/galeria_7.jpg"
                alt="galeria-7"
              />
              <h1>Baño</h1>
              <p>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                Delectus iure debitis in neque doloribus, consequuntur impedit
                laborum magni error laudantium? Architecto perferendis inventore
                tempora. Enim nemo quam veniam est? Fugiat!
              </p>
              <div class="lupa-img">
                <div class="lupa">
                  <img src="./assets/svg/lupa.svg" width="100" height="100" />
                </div>
              </div>
            </div>
            <div class="gallery-picture" href=".window">
              <img
                class="main-img"
                src="./assets/img/galeria_8.jpg"
                alt="galeria-8"
              />
              <h1>Silla</h1>
              <p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                Doloremque veniam magnam exercitationem provident dolor odit
                eligendi voluptates ipsum porro temporibus voluptatibus, impedit
                sunt laudantium architecto vitae in iusto quod esse!
              </p>
              <div class="lupa-img">
                <div class="lupa">
                  <img src="./assets/svg/lupa.svg" width="100" height="100" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Contacto -->
    <section id="contacto" class="contacto">
      <div class="contacto-container">
        <div class="formulario">
          <div class="title-contacto">
            <h2>Contacto</h2>
          </div>
          <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
            <label for="fname">Nombre completo</label>
            <input type="text" id="fname" name="fname" required />
            <label for="email">Correo electronico</label>
            <input type="email" id="email" name="email" required />
            <label for="tel">Teléfono</label>
            <input
              type="tel"
              id="tel"
              name="tel"
              pattern="[0-9]{10}"
              required
            />
            <label for="comentarios">Comentarios</label>
            <textarea
              name="comentarios"
              id="comentarios"
              rows="5"
              required
            ></textarea>
            <div
              class="g-recaptcha"
              data-sitekey="6LddijMhAAAAADaCmiyiJks_oXDVO0MwmxaWYRF9"
            ></div>
            <br />
            <button type="submit" name="submit">Enviar</button>
          </form>
        </div>

        <div class="mapa">
          <div class="title-contacto">
            <h2>Encuentranos</h2>
          </div>

          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3733.125546454686!2d-105.20260138525913!3d20.664470686196875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x84214f6c4a978259%3A0x8da98c7ccac1f863!2sFrancia%20957%2C%20Brisas%20del%20Pac%C3%ADfico%2C%2048290%20Puerto%20Vallarta%2C%20Jal.!5e0!3m2!1ses!2smx!4v1657302241557!5m2!1ses!2smx"
            style="border: 0"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
          ></iframe>
          <div class="iconomap">
            <img src="./assets/svg/location.svg" alt="" />
            <p>Francia 957, Brisas del Pacífico, 48290 Puerto Vallarta, Jal.</p>
          </div>

          <a
            href="https://wa.me/523221129888"
            target="_blank"
            rel="noopener noreferrer"
          >
            <div class="iconomap">
              <img src="./assets/svg/whatsapp.svg" alt="" />
              <p>322-112-98-88</p>
            </div>
          </a>
        </div>
      </div>
    </section>

    <!-- Fin contacto -->

    <!-- Footer -->
    <footer>
      <div class="logo-footer pt">
        <img src="./assets/logo_v2.png" alt="icono" />
      </div>
      <div class="pt">
        <div class="referencia">
          <h2>Contacto</h2>
          <p>
            Dirección: Francia 957, Brisas del Pacífico, 48290 Puerto Vallarta,
            Jal.
          </p>
          <p>Teléfono: 322-112-98-88</p>
          <div class="footer-icons">
            <a
              href="https://wa.me/523221129888"
              target="_blank"
              rel="noopener noreferrer"
              ><img src="./assets/svg/whatsapp_square.svg" alt="" />
            </a>
            <a
              href="https://www.facebook.com/"
              target="_blank"
              rel="noopener noreferrer"
              ><img src="./assets/svg/facebook.svg" alt=""
            /></a>
            <a
              href="https://www.instagram.com/"
              target="_blank"
              rel="noopener noreferrer"
              ><img src="./assets/svg/instagram.svg" alt=""
            /></a>
          </div>
        </div>
      </div>
      <div class="pt">
        <div class="referencia">
          <h2>Links</h2>
          <a href="#home">
            <p>Home</p>
          </a>
          <a href="#productos-y-servicios">
            <p>Productos y Servicios</p>
          </a>
          <a href="#gallery">
            <p>Galeria</p>
          </a>
          <a href="#contacto">
            <p>Contacto</p>
          </a>
        </div>
      </div>
      <div class="pt">
        <div class="powerby">
          <h2>Powered by</h2>
          <a
            href="https://www.racoondevs.com"
            target="_blank"
            rel="noopener noreferrer"
          >
            <img src="./assets/LOGO-CAJA-BLANCO.png" alt="" />
          </a>
          <p>Copyright 2022 Desarrollado por Racoon Devs</p>
        </div>
      </div>
    </footer>
    <script type="text/javascript" src="./js/navbar.js"></script>
    <script type="text/javascript" src="./js/lenguaje.js"></script>
    <script type="text/javascript" src="./js/main.js"></script>
    <script type="text/javascript" src="./js/gallery.js"></script>
    <script
      defer
      src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"
    ></script>
    <script defer src="./js/functions.js"></script>
  </body>
</html>