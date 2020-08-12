<?php
session_start();
setlocale(LC_MONETARY, 'pt_BR');
function money_formats($format, $number)
{
    $regex  = '/%((?:[\^!\-]|\+|\(|\=.)*)([0-9]+)?' .
        '(?:#([0-9]+))?(?:\.([0-9]+))?([in%])/';
    if (setlocale(LC_MONETARY, 0) == 'C') {
        setlocale(LC_MONETARY, '');
    }
    $locale = localeconv();
    preg_match_all($regex, $format, $matches, PREG_SET_ORDER);
    foreach ($matches as $fmatch) {
        $value = floatval($number);
        $flags = array(
            'fillchar'  => preg_match('/\=(.)/', $fmatch[1], $match) ?
                $match[1] : ' ',
            'nogroup'   => preg_match('/\^/', $fmatch[1]) > 0,
            'usesignal' => preg_match('/\+|\(/', $fmatch[1], $match) ?
                $match[0] : '+',
            'nosimbol'  => preg_match('/\!/', $fmatch[1]) > 0,
            'isleft'    => preg_match('/\-/', $fmatch[1]) > 0
        );
        $width      = trim($fmatch[2]) ? (int) $fmatch[2] : 0;
        $left       = trim($fmatch[3]) ? (int) $fmatch[3] : 0;
        $right      = trim($fmatch[4]) ? (int) $fmatch[4] : $locale['int_frac_digits'];
        $conversion = $fmatch[5];

        $positive = true;
        if ($value < 0) {
            $positive = false;
            $value  *= -1;
        }
        $letter = $positive ? 'p' : 'n';

        $prefix = $suffix = $cprefix = $csuffix = $signal = '';

        $signal = $positive ? $locale['positive_sign'] : $locale['negative_sign'];
        switch (true) {
            case $locale["{$letter}_sign_posn"] == 1 && $flags['usesignal'] == '+':
                $prefix = $signal;
                break;
            case $locale["{$letter}_sign_posn"] == 2 && $flags['usesignal'] == '+':
                $suffix = $signal;
                break;
            case $locale["{$letter}_sign_posn"] == 3 && $flags['usesignal'] == '+':
                $cprefix = $signal;
                break;
            case $locale["{$letter}_sign_posn"] == 4 && $flags['usesignal'] == '+':
                $csuffix = $signal;
                break;
            case $flags['usesignal'] == '(':
            case $locale["{$letter}_sign_posn"] == 0:
                $prefix = '(';
                $suffix = ')';
                break;
        }
        if (!$flags['nosimbol']) {
            $currency = $cprefix .
                ($conversion == 'i' ? $locale['int_curr_symbol'] : $locale['currency_symbol']) .
                $csuffix;
        } else {
            $currency = '';
        }
        $space  = $locale["{$letter}_sep_by_space"] ? ' ' : '';

        $value = number_format(
            $value,
            $right,
            $locale['mon_decimal_point'],
            $flags['nogroup'] ? '' : $locale['mon_thousands_sep']
        );
        $value = @explode($locale['mon_decimal_point'], $value);

        $n = strlen($prefix) + strlen($currency) + strlen($value[0]);
        if ($left > 0 && $left > $n) {
            $value[0] = str_repeat($flags['fillchar'], $left - $n) . $value[0];
        }
        $value = implode($locale['mon_decimal_point'], $value);
        if ($locale["{$letter}_cs_precedes"]) {
            $value = $prefix . $currency . $space . $value . $suffix;
        } else {
            $value = $prefix . $value . $space . $currency . $suffix;
        }
        if ($width > 0) {
            $value = str_pad($value, $width, $flags['fillchar'], $flags['isleft'] ?
                STR_PAD_RIGHT : STR_PAD_LEFT);
        }

        $format = str_replace($fmatch[0], $value, $format);
    }
    return $format;
}
if (isset($_GET['pesquisa'])) {
    $titulo = $_POST['titulo'];
    $fotos = explode('|', $_POST['fotos']);
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $quadra = $_POST['quadra'];
    $cep = $_POST['cep'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $uni_fed = $_POST['uni_fed'];
    $regiao = $_POST['regiao'];
    $ponto_ref = $_POST['ponto_ref'];
    $anuncio = $_POST['anuncio'];
    $categoria = $_POST['categoria'];
    $finalidade = $_POST['finalidade'];
    $tipo = $_POST['tipo'];
    $categoria_item = $_POST['categoria_item'];
    $area_total = $_POST['area_total'];
    $area_terreno = $_POST['area_terreno'];
    $area_construida = $_POST['area_construida'];
    $area_util = $_POST['area_util'];
    $banheiro_auxiliar = $_POST['banheiro_auxiliar'];
    $banheiro_empregada = $_POST['banheiro_empregada'];
    $banheiro1 = $_POST['banheiro1'];
    $banheiro2 = $_POST['banheiro2'];
    $dormitorio = $_POST['dormitorio'];
    $valor = money_formats("%.2n", $_POST['valor']);
    $venda = $_POST['venda'];
    $temporada = $_POST['temporada'];
    $locacao = $_POST['locacao'];
    $condominio = $_POST['condominio'];
    $iptu = $_POST['iptu'];
?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>

        <!-- Meta -->
        <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Title -->
        <title>Aldeia Imobiliária</title>

        <!-- Favicons -->
        <!-- <link rel="shortcut icon" href="../assets/img/favicon.png">
        <link rel="apple-touch-icon" href="../assets/img/favicon_60x60.png">
        <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/favicon_76x76.png">
        <link rel="apple-touch-icon" sizes="120x120" href="../assets/img/favicon_120x120.png">
        <link rel="apple-touch-icon" sizes="152x152" href="../assets/img/favicon_152x152.png"> -->
        <!-- CSS Plugins -->
        <link rel="stylesheet" href="../assets/css/bootstrap.css">
        <link rel="stylesheet" href="../assets/plugins/bootstrap/dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../assets/plugins/slick-carousel/slick/slick.css" />
        <link rel="stylesheet" href="../assets/plugins/animate.css/animate.min.css" />
        <link rel="stylesheet" href="../assets/plugins/animsition/dist/css/animsition.min.css" />
        <link rel="stylesheet" href="../assets/plugins/photoswipe/dist/photoswipe.css" />
        <link rel="stylesheet" href="../assets/plugins/photoswipe/dist/default-skin/default-skin.css" />

        <!-- CSS Icons -->
        <link rel="stylesheet" href="../assets/css/themify-icons.css" />
        <link rel="stylesheet" href="../assets/plugins/font-awesome/css/font-awesome.min.css" />

        <!-- CSS Theme -->
        <link id="theme" rel="stylesheet" href="../assets/css/themes/theme-blue.css" />

    </head>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/5d41eb067d27204601c8a346/default';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->

    <body class="header-horizontal dark-overlay">

        <!-- Body Wrapper -->
        <div id="body-wrapper" class="animsition" data-animsition-overlay="true">

            <!-- Header -->
            <header id="header" class="header-horizontal dark">

                <!-- Module - Navigation Back -->
                <div class="module module-back">
                    <a onclick="window.history.back()" class="nav-back"><i class="fa fa-angle-left"></i></a>
                </div>

                <!-- Module - Navigation -->
                <nav id="navigation-main" class="module module-nav">
                    <ul class="nav nav-main-horizontal">
                        <li><a href="#informations">Informações</a></li>
                        <li><a href="#details">Detalhes e localização</a></li>
                        <li><a href="#features">Descrição</a></li>
                        <li><a href="#make-offer">Faça uma prosposta!</a></li>
                    </ul>
                    <div class="selector"></div>
                </nav>


            </header>
            <!-- Header / End -->

            <!-- Content -->
            <div id="content">

                <!-- Section / Informations -->
                <section id="informations" class="section section-object bg-dark cover dark">

                    <!-- BG Image -->
                    <div class="bg-image-holder bg-image-fixed"><img src="<?php echo $fotos[0]; ?>" alt=""></div>

                    <!-- Content -->
                    <div class="container object-single" data-local-scroll>
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <h1 class="mb-0">
                                    <span class="mr-3"><?php echo $titulo; ?></span>
                                    <i class="fa fa-check-circle text-success" data-toggle="tooltip" data-placement="top" title="Best choice!"></i>
                                </h1>
                                <ul class="list-inline lead">
                                    <?php
                                    echo '<li class="list-inline-item"><span class="text-muted">Área útil:</span> <strong>' . " " . $area_total . 'm<sup>2</sup></strong></li>';
                                    if ($dormitorio != "")
                                        echo '<li class="list-inline-item"><span class="text-muted">Número de quartos:</span> <strong>' . " " . $dormitorio . '</strong></li>';
                                    ?>
                                </ul>
                            </div>
                            <div class="col-lg-4 text-lg-right">
                                <span class="object-price mr-4"><?php echo $valor; ?></span>
                                <a href="#make-offer" class="btn btn-primary">Faça uma oferta</a>
                            </div>
                        </div>
                    </div>

                    <!-- Gallery Toggle -->
                    <a href="#" class="fullscreen-toggle" data-items="gallerySliderItems" data-toggle="gallery">
                        <span class="arrow-tl"></span>
                        <span class="arrow-tr"></span>
                        <span class="arrow-br"></span>
                        <span class="arrow-bl"></span>
                    </a>

                </section>

                <!-- Section / Details -->
                <section id="details" class="section section-details">

                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10 push-lg-1">
                                <h2 class="mb-0">Detalhes</h2>
                                <hr class="hr-primary">
                                <div class="row lead">
                                    <div class="col-md-6">
                                        <dl class="row">
                                            <?php
                                            echo    '<dt class="col-sm-6">Classificação:</dt>
                                    <dd class="col-sm-6">' . $categoria_item . '</dd>
                                    <dt class="col-sm-6">Categoria:</dt>
                                    <dd class="col-sm-6">' . $categoria . '</dd>
                                    <dt class="col-sm-6">Tipo:</dt>
                                    <dd class="col-sm-6">' . $tipo . '</dd>
                                    <dt class="col-sm-6">Finalidade:</dt>
                                    <dd class="col-sm-6">' . $finalidade . '</dd>';
                                            if ($area_terreno != "") {
                                                echo '<dt class="col-sm-6">Area terreno:</dt>
                                    <dd class="col-sm-6">' . $area_terreno . 'm<sup>2</sup></dd>';
                                            }
                                            echo    '<dt class="col-sm-6">Área construída:</dt>
                                    <dd class="col-sm-6">' . $area_construida . 'm<sup>2</sup></dd>
                                    <dt class="col-sm-6">Área útil:</dt>
                                    <dd class="col-sm-6">' . $area_util . 'm<sup>2</sup></dd>';
                                            ?>
                                        </dl>
                                    </div>
                                    <div class="col-md-6">
                                        <dl class="row">
                                            <?php
                                            if ($venda != "") {
                                                echo '<dt class="col-sm-6">Valor de venda:</dt>
                                    <dd class="col-sm-6">' . money_formats("%.2n", $_POST['venda']) . '</dd>';
                                            }
                                            if ($locacao != "") {
                                                echo '<dt class="col-sm-6">Valor do aluguel:</dt>
                                    <dd class="col-sm-6">' . money_formats("%.2n", $_POST['locacao']) . '</dd>';
                                            }
                                            if ($temporada != "") {
                                                echo '<dt class="col-sm-6">Valor da temporada:</dt>
                                    <dd class="col-sm-6">' . money_formats("%.2n", $_POST['temporada']) . '</dd>';
                                            }
                                            if ($condominio != "") {
                                                echo '<dt class="col-sm-6">Valor do condomínio:</dt>
                                    <dd class="col-sm-6">' . money_formats("%.2n", $_POST['condominio']) . '</dd>';
                                            }
                                            if ($iptu != "") {
                                                echo '<dt class="col-sm-6">Valor do IPTU:</dt>
                                    <dd class="col-sm-6">' . money_formats("%.2n", $_POST['iptu']) . '</dd>';
                                            }
                                            if ($dormitorio != "") {
                                                echo    '<dt class="col-sm-6">Quartos:</dt>
                                    <dd class="col-sm-6">' . $dormitorio . '</dd>';
                                            }
                                            if ($banheiro1 != "" && $banheiro1 != 0) {
                                                echo '<dt class="col-sm-6">Banheiro principal:</dt>
                                    <dd class="col-sm-6">' . $banheiro1 . '</dd>';
                                            }
                                            echo    '<dt class="col-sm-6">Banheiros:</dt>
                                    <dd class="col-sm-6">' . $banheiro2 . '</dd>
                                    <dt class="col-sm-6">Banheiro auxiliar:</dt>
                                    <dd class="col-sm-6">' . $banheiro_auxiliar . '</dd>
                                    <dt class="col-sm-6">Banheiro empregada:</dt>
                                    <dd class="col-sm-6">' . $banheiro_empregada . '</dd>';
                                            ?>
                                        </dl>
                                    </div>
                                </div>

                                <hr class="hr-sm" style="margin-bottom: 50px;">

                                <h2 class="mb-0">Localização</h2>
                                <hr class="hr-primary">
                                <div class="row lead">
                                    <div class="col-md-6">
                                        <dl class="row">
                                            <?php
                                            if ($endereco != "") {
                                                echo '<dt class="col-sm-6">Endereço:</dt>
                                    <dd class="col-sm-6">' . $endereco . '</dd>';
                                            }
                                            if ($numero != "") {
                                                echo '<dt class="col-sm-6">Numero:</dt>
                                    <dd class="col-sm-6">' . $numero . '</dd>';
                                            }
                                            if ($quadra != "") {
                                                echo '<dt class="col-sm-6">Quadra:</dt>
                                    <dd class="col-sm-6">' . $quadra . '</dd>';
                                            }
                                            echo    '<dt class="col-sm-6">CEP:</dt>
                                    <dd class="col-sm-6">' . $cep . '</dd>
                                    <dt class="col-sm-6">Bairro comercial:</dt>
                                    <dd class="col-sm-6">' . $bairro . '</dd>
                                    <dt class="col-sm-6">Cidade:</dt>
                                    <dd class="col-sm-6">' . $cidade . '</dd>
                                    <dt class="col-sm-6">UF:</dt>
                                    <dd class="col-sm-6">' . $uni_fed . '</dd>';
                                            if ($regiao != "") {
                                                echo '<dt class="col-sm-6">Região:</dt>
                                    <dd class="col-sm-6">' . $regiao . '</dd>';
                                            }
                                            if ($ponto_ref != "") {
                                                echo '<dt class="col-sm-6">Ponto de referência:</dt>
                                    <dd class="col-sm-6">' . $ponto_ref . '</dd>';
                                            }
                                            ?>
                                        </dl>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </section>

                <!-- Section - Galeria -->
                <section id="home" class="section h-fullheight bg-dark cover dark">

                    <!-- Slider Main -->
                    <div class="slider-main slider-kenburns inner-controls">
                        <!-- Slide -->
                        <?php
                        foreach ($fotos as $foto) {
                            echo
                                '<div class="slide">
                        <div class="slide-bg bg-image-holder bg-image-fixed">
                            <img src="' . $foto . '" alt="">
                        </div>
                        <div class="slide-content container text-center">
                        
                        </div>
                    </div>';
                        }
                        ?>
                    </div>

                    <!-- Slider Navigation -->
                    <div class="slider-main-nav">
                        <div class="slide"><img src="" alt=""></div>
                        <div class="slide"><img src="" alt=""></div>
                        <div class="slide"><img src="" alt=""></div>
                        <div class="slide"><img src="" alt=""></div>
                    </div>

                    <!-- Gallery Toggle -->
                    <a href="#" class="fullscreen-toggle" data-items="gallerySliderItems" data-toggle="gallery">
                        <span class="arrow-tl"></span>
                        <span class="arrow-tr"></span>
                        <span class="arrow-br"></span>
                        <span class="arrow-bl"></span>
                    </a>

                </section>
                <!-- Section -->
                <section class="section" id="features">

                    <div class="container">
                        <div class="row align-items-center" data-local-scroll>
                            <div class="col-lg-4 push-lg-2 pr-5">
                                <h2>Descrição</h2>
                                <p class="lead" style="text-align: justify;"><?php echo $anuncio; ?></p>
                                <a href="#make-offer" class="btn btn-secondary mb-4">Faça uma oferta</a>
                            </div>
                            <div class="col-lg-4 push-lg-2">
                                <img class="rounded shadow animated" src="../assets/img/photos/about03.jpg" alt="" data-animation="fadeIn">
                            </div>
                        </div>
                    </div>

                </section>

                <!-- Section - Offer -->
                <section id="make-offer" class="section bg-dark">
                    <!-- BG Image -->
                    <div class="bg-image-holder"><img src="../assets/img/photos/offer-bg.jpg" alt=""></div>

                    <!-- Content -->
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-4 push-lg-2">
                                <!-- Object - Vertical -->
                                <div class="object-box">
                                    <div class="object-image">
                                        <img src="<?php echo $fotos[0]; ?>" alt="">
                                    </div>
                                    <div class="object-content">
                                        <h5 class="object-title"><?php echo $titulo; ?></h5>
                                        <ul class="object-details list-unstyled">
                                            <li><span class="text-muted">Área útil:</span> <?php echo $area_util; ?>m<sup>2</sup></li>
                                            <?php if ($dormitorio != "")
                                                echo    '<li><span class="text-muted">Quartos:</span>' . " " . $dormitorio . '</li>'; ?>
                                        </ul>
                                        <div class="row">
                                            <div class="col-6">
                                                <strong class="text-muted">Preço:</strong>
                                                <span class="object-price text-primary text-lg"><?php echo $valor ?></span>
                                            </div>
                                            <!--div class="col-6">
                                        <strong class="text-muted">Price per m<sup>2</sup>:</strong>
                                        <span class="object-price">$3 200</span>
                                    </div-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 push-lg-2 pl-lg-5 pt-5 pt-lg-0 dark">
                                <h2 class="mb-2">Faça sua proposta! </h2>
                                <p class="lead"></p>
                                <form method="post" action="../assets/php/offer-form.php" id="offer-form">
                                    <div class="form-group">
                                        <label>Nome:</label>
                                        <input type="text" name="name" class="form-control" placeholder="Insira seu nome" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input type="email" name="email" class="form-control" placeholder="Insira o e-mail para contato" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Telefone:</label>
                                        <input type="text" name="phone" class="form-control" placeholder="Insira telefone para contato" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Deseja agendar visita ou fazer uma proposta?</label>
                                        <select class="custom-select form-control" name="tipo-contato" id="select-visita" required>
                                            <option value="visita">Agendar visita</option>
                                            <option value="oferta">Fazer proposta</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="texto-visita">
                                        <label id="label-visita">Sua disponibilidade de horário:</label>
                                        <input type="text" name="oferta" class="form-control" placeholder="Diga-nos sua disponibilidade de horário" id="input-visita" required>
                                    </div>
                                    <button class="btn btn-primary btn-submit btn-block" type="submit">
                                        <span class="description">Enviar Email!</span>
                                        <span class="success">
                                            <svg x="0px" y="0px" viewBox="0 0 32 32">
                                                <path stroke-dasharray="19.79 19.79" stroke-dashoffset="19.79" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M9,17l3.9,3.9c0.1,0.1,0.2,0.1,0.3,0L23,11" /></svg>
                                        </span>
                                        <span class="error">Tente novamente</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </section>

            </div>
            <!-- Content / End -->


            <!-- Body Overlay -->
            <div id="body-overlay"></div>

        </div>

        <!-- Panel - Objects -->
    

        <!-- Video Modal / Demo -->
        <div class="modal modal-video fade" id="modalVideo" role="dialog">
            <button class="close dark" data-dismiss="modal"></button>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <iframe height="500"></iframe>
                </div>
            </div>
        </div>

        <!-- JS Plugins -->
        <script src="../assets/plugins/jquery/dist/jquery.min.js"></script>
        <script src="../assets/plugins/animsition/dist/js/animsition.min.js"></script>
        <script src="../assets/plugins/tether/dist/js/tether.min.js"></script>
        <script src="../assets/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/plugins/slick-carousel/slick/slick.min.js"></script>
        <script src="../assets/plugins/jquery.appear/jquery.appear.js"></script>
        <script src="../assets/plugins/jquery.scrollto/jquery.scrollTo.min.js"></script>
        <script src="../assets/plugins/jquery.localscroll/jquery.localScroll.min.js"></script>
        <script src="../assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
        <script src="../assets/plugins/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="../assets/plugins/photoswipe/dist/photoswipe.min.js"></script>
        <script src="../assets/plugins/photoswipe/dist/photoswipe-ui-default.min.js"></script>
        <script src="../assets/plugins/twitter-fetcher/js/twitterFetcher_min.js"></script>
        <script src="imovel.js"></script>

        <!-- JS Core -->
        <script src="../assets/js/core.min.js"></script>

        <!-- JS Gallery -->
        <script>
            var gallerySliderItems = [
                <?php

                $tam = count($fotos);
                for ($i = 0; $i < ($tam); $i++) {
                    echo '{
                    src: "' . $fotos[$i] . '",
                    w: 1920,
                    h: 1080
                },';
                }
                ?>
            ];

            var galleryCarouselItems = [{
                    src: '../assets/img/gallery/gallery01.jpg',
                    w: 1100,
                    h: 750
                },
                {
                    src: '../assets/img/gallery/gallery02.jpg',
                    w: 1100,
                    h: 750
                },
                {
                    src: '../assets/img/gallery/gallery03.jpg',
                    w: 1100,
                    h: 750
                },
                {
                    src: '../assets/img/gallery/gallery04.jpg',
                    w: 1100,
                    h: 750
                },
                {
                    src: '../assets/img/gallery/gallery05.jpg',
                    w: 1100,
                    h: 750
                },
                {
                    src: '../assets/img/gallery/gallery06.jpg',
                    w: 1100,
                    h: 750
                }
            ];
        </script>

        <!-- JS Google Map -->
        <script src="https://maps.googleapis.com/maps/api/js"></script>

    </body>

    </html>


<?php
} else {
    header("Location: ../");
}
$_SESSION['var_titulo'] = $titulo;
?>