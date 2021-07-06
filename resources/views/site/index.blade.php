<!DOCTYPE html>
<html lang="pt-br">
<head>

    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="keywords" content="bootstrap 5, premium, multipurpose, sass, scss, saas, software"/>
    <meta name="description" content="HTML5 Template"/>
    <meta name="author" content="www.themeht.com"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>Softpro - Advogados</title>

    <!-- favicon icon -->
    <link rel="shortcut icon" href="assets/images/icon-adv.ico"/>

    <!-- inject css start -->

    <!--== bootstrap -->

    <link href="https://fonts.googleapis.com/css?family=Cabin:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="assets/site/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <!--== animate -->
    <link href="assets/site/css/animate.css" rel="stylesheet" type="text/css"/>

    <!--== fontawesome -->
    <link href="assets/site/css/fontawesome-all.css" rel="stylesheet" type="text/css"/>

    <!--== line-awesome -->
    <link href="assets/site/css/line-awesome.min.css" rel="stylesheet" type="text/css"/>

    <!--== magnific-popup -->
    <link href="assets/site/css/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css"/>

    <!--== owl-carousel -->
    <link href="assets/site/css/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css"/>

    <!--== base -->
    <link href="assets/site/css/base.css" rel="stylesheet" type="text/css"/>

    <!--== shortcodes -->
    <link href="assets/site/css/shortcodes.css" rel="stylesheet" type="text/css"/>

    <!--== default-theme -->
    <link href="assets/site/css/style.css" rel="stylesheet" type="text/css"/>

    <!--== responsive -->
    <link href="assets/site/css/responsive.css" rel="stylesheet" type="text/css"/>

    <!--== responsive -->
    <link href="assets/site/css/responsive.css" rel="stylesheet" type="text/css"/>

    <!--== color-customizer -->
    <link href="assets/site/css/theme-color/color-5.css" data-style="styles" rel="stylesheet">

    <!-- inject css end -->

</head>

<body class="home-5">

<!-- page wrapper start -->

<div class="page-wrapper">

    <!-- preloader start -->

    <!--    <div id="ht-preloader">
            <div class="loader clear-loader">
                <div class="loader-box"></div>
                <div class="loader-box"></div>
                <div class="loader-box"></div>
                <div class="loader-box"></div>
                <div class="loader-wrap-text">
                    <div class="text"><span>S</span><span>O</span><span>F</span><span>T</span><span>I</span><span>N</span><span>O</span>
                    </div>
                </div>
            </div>
        </div>-->

    <!-- preloader end -->


    <!--header start-->

    <header id="site-header" class="header">
        <div class="container">
            <div id="header-wrap">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Navbar -->
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand logo" href="index.html">
                                <img id="logo-img" class="img-fluid" src="{{ url('assets/images/logo-the-place.png') }}"
                                     alt="">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                    aria-label="Toggle navigation"><span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <!-- Left nav -->
                                <ul class="nav navbar-nav ms-auto">
                                    <!-- Home -->
                                    <li class="nav-item"><a class="nav-link active" href="#home">Home</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="#about">Sobre</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="#service">Sistema</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="#pricing">Planos</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!--header end-->


    <!--hero section start-->

    <section id="home" class="fullscreen-banner banner p-0">
        <div class="align-center pt-0">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 img-side text-center">
                        <img class="img-fluid" src="assets/site/images/banner/05.png" alt="">
                        <div class="video-box">
                            <div class="video-btn video-btn-pos"><a class="play-btn popup-youtube"
                                                                    href="https://www.youtube.com/watch?v=P_wKDMcr1Tg"><i
                                        class="la la-play"></i></a>
                                <div class="spinner-eff">
                                    <div class="spinner-circle circle-1"></div>
                                    <div class="spinner-circle circle-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 ms-auto mt-5 mt-lg-0 mb-5 mb-lg-0">
                        <h1 class="mb-4 fw-normal wow fadeInUp" data-wow-duration="1.5s"><span class="fw-bold">SoftPro Advogado</span>
                        </h1>
                        <h2 class="mb-4 wow fadeInUp"  data-wow-duration="2s" data-wow-delay="0.3s">O sistema que você precisa para inovar a gestão
                            do seu escritório</h2>
                        <p class="lead mb-4 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.3s">Simplifique a sua
                            rotina, economize tempo e ganhe mais clientes.</p>
                    </div>
                </div>
            </div>
        </div>
        <svg class="wave-animation" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             viewBox="0 24 150 28" preserveAspectRatio="none">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0
    58-18 88-18s
    58 18 88 18
    58-18 88-18
    58 18 88 18
    v44h-352z"/>
            </defs>
            <g class="wave-bg">
                <use xlink:href="#gentle-wave" x="50" y="0" fill="#f8f8f8"/>
                <use xlink:href="#gentle-wave" x="50" y="3" fill="#fbfbfb"/>
                <use xlink:href="#gentle-wave" x="50" y="6" fill="#ffffff"/>
            </g>
        </svg>
    </section>

    <!--hero section end-->


    <!--body content start-->

    <div class="page-content">

        <!--about start-->

        <section id="about" class="p-0 position-relative">
            <div class="container">
                <div class="row custom-mt-15">
                    <div class="col-lg-12 col-md-12 mx-auto">
                        <div class="owl-carousel" data-items="1" data-autoplay="true">
                            <div class="item mx-3 my-3">
                                <div class="img-box box-shadow">
                                    <div class="box-loader"><span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <img class="img-fluid" src="assets/site/images/sistema/001.jpg" alt="">
                                </div>
                            </div>
                            <div class="item mx-3 my-3">
                                <div class="img-box box-shadow">
                                    <div class="box-loader"><span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <img class="img-fluid" src="assets/site/images/sistema/003.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--about end-->


        <!--about start-->

        <section class="position-relative">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <img class="img-fluid w-100" src="assets/site/images/svg/04.svg" alt="">
                    </div>
                    <div class="col-lg-6 col-md-12 mt-5 mt-lg-0">
                        <div class="section-title mb-3">
                            <div class="title-effect title-effect-2">
                                <div class="ellipse"></div>
                                <i class="la la-info"></i>
                            </div>
                            <h2>Software Moderno E Sofisticado para seu escritório de advocacia.</h2>
                        </div>
                        <p class="lead mb-5">Não gerencie apenas processos e atividades jurídicas, faça também a gestão financeira do seu escritório, com relatórios gerenciais que te ajudarão a crescer cada vez mais!</p>
                        <div class="owl-carousel no-pb" data-dots="false" data-items="2" data-margin="30"
                             data-autoplay="true">
                            <div class="item">
                                <div class="counter style-3">
                                    <div class="counter-icon">
                                        <img class="img-fluid" src="assets/site/images/counter/01.png" alt="">
                                    </div>
                                    <div class="counter-desc">
                                        <span>100%</span>
                                        <h5>Suporte de Excelência</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="counter style-3">
                                    <div class="counter-icon">
                                        <img class="img-fluid" src="assets/site/images/counter/02.png" alt="">
                                    </div>
                                    <div class="counter-desc">
                                        <span>+1000</span>
                                        <h5>Processos Gerenciados</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="counter style-3">
                                    <div class="counter-icon">
                                        <img class="img-fluid" src="assets/site/images/counter/03.png" alt="">
                                    </div>
                                    <div class="counter-desc">
                                        <span>+1000</span>
                                        <h5>Andamentos Processuais</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="counter style-3">
                                    <div class="counter-icon">
                                        <img class="img-fluid" src="assets/site/images/counter/04.png" alt="">
                                    </div>
                                    <div class="counter-desc">
                                        <span>+90%</span>
                                        <h5>Clientes satisfeitos</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--about end-->


        <!--feature start-->

        <section id="service" class="position-relative bg-effect-2 bg-effect-3 py-15" data-bg-color="#fbfbfb">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8 col-md-12">
                        <div class="section-title">
                            <div class="title-effect title-effect-2">
                                <div class="ellipse"></div>
                                <i class="la la-cubes"></i>
                            </div>
                            <h2 class="title">Invista seu tempo no que realmente importa, automatize seus processos
                                gerenciais</h2>
                            <p>Gerencie seus processos, agenda e financeiro em um só lugar</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="featured-item style-6">
                            <div class="featured-icon"><i class="flaticon-process"></i>
                            </div>
                            <div class="featured-title">
                                <h5>Processos</h5>
                            </div>
                            <div class="featured-desc">
                                <p>Organize os processos registrando o andamento, anexando arquivos importantes e
                                    acompanhando o progresso.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mt-5 mt-md-0">
                        <div class="featured-item style-6">
                            <div class="featured-icon"><i class="flaticon-resolution"></i>
                            </div>
                            <div class="featured-title">
                                <h5>Agenda</h5>
                            </div>
                            <div class="featured-desc">
                                <p>Compromissos e tarefas integrados ao processo.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mt-5 mt-lg-0">
                        <div class="featured-item style-6">
                            <div class="featured-icon"><i class="flaticon-analytics"></i>
                            </div>
                            <div class="featured-title">
                                <h5>Financeiro</h5>
                            </div>
                            <div class="featured-desc">
                                <p>Controle de valores a pagar e receber e relatórios gerenciais.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mt-5">
                        <div class="featured-item style-6">
                            <div class="featured-icon"><i class="flaticon-briefing"></i>
                            </div>
                            <div class="featured-title">
                                <h5>Permissões</h5>
                            </div>
                            <div class="featured-desc">
                                <p>Limite o acesso de acordo com os perfis de cada usuário.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mt-5">
                        <div class="featured-item style-6">
                            <div class="featured-icon"><i class="flaticon-customer-service"></i>
                            </div>
                            <div class="featured-title">
                                <h5>Suporte Técnico</h5>
                            </div>
                            <div class="featured-desc">
                                <p>Conte com nosso atendimento, com avaliação positiva superior a 90%, via help desk e
                                    chat online em horário comercial.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mt-5">
                        <div class="featured-item style-6">
                            <div class="featured-icon"><i class="flaticon-market"></i>
                            </div>
                            <div class="featured-title">
                                <h5>Tutoriais</h5>
                            </div>
                            <div class="featured-desc">
                                <p>Tenha acesso a plataforma de vídeos explicativos.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--feature end-->


        <!--tab start-->

        <section class="position-relative overflow-hidden">
            <div class="bg-animation">
                <img class="zoom-fade" src="assets/site/images/pattern/03.png" alt="">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="tab style-2">
                            <!-- Nav tabs -->
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-tab1" data-bs-toggle="tab"
                                       href="#tab1-1" role="tab" aria-selected="true"> <i class="flaticon-research"></i>
                                        <h5>Cadastros</h5>
                                    </a> <a class="nav-item nav-link" id="nav-tab2" data-bs-toggle="tab" href="#tab1-2"
                                            role="tab" aria-selected="false"><i class="flaticon-process"></i> <h5>
                                            Processos</h5></a>
                                    <a class="nav-item nav-link" id="nav-tab3" data-bs-toggle="tab" href="#tab1-3"
                                       role="tab" aria-selected="false"><i class="flaticon-resolution"></i> <h5>
                                            Agenda</h5></a>
                                    <a class="nav-item nav-link" id="nav-tab4" data-bs-toggle="tab" href="#tab1-4"
                                       role="tab" aria-selected="false"><i class="flaticon-analytics"></i> <h5>
                                            Financeiro</h5></a>
                                </div>
                            </nav>
                            <!-- Tab panes -->
                            <div class="tab-content" id="nav-tabContent">
                                <div role="tabpanel" class="tab-pane fade show active" id="tab1-1">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-12">
                                            <img class="img-fluid" src="assets/site/images/svg/07.svg" alt="">
                                        </div>
                                        <div class="col-lg-6 col-md-12 mt-5 mt-lg-0">
                                            <h4 class="mb-4">Importantes para a gestão do seu escritório</h4>
                                            <p class="mb-4">Cadastros que facilitam a gestão de pessoas, processos e geram mais segurança para a sua equipe na tomada de decisão.</p>
                                            <ul class="custom-li list-unstyled list-icon-2 d-inline-block">
                                                <li>Grupo de Ações</li>
                                                <li>Tipos de Ações</li>
                                                <li>Fases do Processo</li>
                                                <li>Etapas do Sistema</li>
                                                <li>Origem das Pessoas</li>
                                                <li>Permissões por usuário</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab1-2">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-12">
                                            <img class="img-fluid" src="assets/site/images/svg/03.svg" alt="">
                                        </div>
                                        <div class="col-lg-6 col-md-12 mt-5 mt-lg-0">
                                            <h4 class="mb-4">Prazos, Andamentos e Progresso</h4>
                                            <p class="mb-4">Controle os processos através do andamento, fases e etapas. Não perca prazos.</p>
                                            <ul class="custom-li list-unstyled list-icon-2 d-inline-block">
                                                <li>Acompanhe o progresso</li>
                                                <li>Registre os processos não ajuizados</li>
                                                <li>Anexe documentos importantes</li>
                                                <li>Controle seus honorários</li>
                                                <li>Vincule advogados envolvidos</li>
                                                <li>Adicione tarefas ao processo</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab1-3">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-12">
                                            <img class="img-fluid" src="assets/site/images/svg/05.svg" alt="">
                                        </div>
                                        <div class="col-lg-6 col-md-12 mt-5 mt-lg-0">
                                            <h4 class="mb-4">Tarefas e Compromissos</h4>
                                            <p class="mb-4">Registre tarefas e compromissos por advogado, acompanhe por dia, semana ou mês.</p>
                                            <ul class="custom-li list-unstyled list-icon-2 d-inline-block">
                                                <li>Compartilhamento de Agenda</li>
                                                <li>Vinculo do processo</li>
                                                <li>Registros de tarefas</li>
                                                <li>Controle por cores</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab1-4">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-12">
                                            <img class="img-fluid" src="assets/site/images/svg/02.svg" alt="">
                                        </div>
                                        <div class="col-lg-6 col-md-12 mt-5 mt-lg-0">
                                            <h4 class="mb-4">Gestão de Contas a Pagar e Receber</h4>
                                            <p class="mb-4">Faça previsões e baixas de valores a pagar e receber, analise relatórios financeiros.</p>
                                            <ul class="custom-li list-unstyled list-icon-2 d-inline-block">
                                                <li>Controle por Conta Financeira</li>
                                                <li>Emissão de Boletos</li>
                                                <li>Vinculo de Categoria Financeira</li>
                                                <li>Relatórios Gerenciais</li>
                                                <li>Gráficos</li>
                                                <li>Controle de Honorários</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--tab end-->


        <!--pricing start-->

        <section id="pricing" class="bg-effect-4 position-relative overflow-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="section-title">
                            <div class="title-effect title-effect-2">
                                <div class="ellipse"></div>
                                <i class="la la-money"></i>
                            </div>
                            <h2 class="title">Grátis por 7 dias</h2>
                            <p class="text-black">SoftPro Advogado: investimento que cabe no orçamento do seu escritório</p>
                        </div>
                        <ul class="list-unstyled list-icon mb-4">
                            <li class="mb-3"><i class="la la-check"></i> Diga adeus as planilhas</li>
                            <li class="mb-3"><i class="la la-check"></i> Centralize seus dados</li>
                            <li class="mb-3"><i class="la la-check"></i> Ganhe mais tempo</li>
                            <li class="mb-3"><i class="la la-check"></i> Invista em uma gestão profissional</li>
                        </ul>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="owl-carousel no-pb" data-dots="false" data-items="2" data-sm-items="1"
                             data-autoplay="true">
                            <div class="item">
                                <div class="price-table style-3 mx-3 my-3">
                                    <div class="price-inside">Básico</div>
                                    <div class="price-header">
                                        <div class="price-value">
                                            <h2>99,99</h2>
                                            <span>Pacote Mensal</span>
                                        </div>
                                        <h3 class="price-title">Básico</h3>
                                    </div>
                                    <div class="price-list">
                                        <ul class="list-unstyled">
                                            <li>Controle de Processos</li>
                                            <li>Agenda</li>
                                            <li>Controle de atividades</li>
                                            <li>Controle financeiro</li>
                                        </ul>
                                    </div>
                                    <a class="btn btn-theme btn-circle mt-4" href="#"
                                       data-text="Experimente 1 Mês grátis">
                                        <span>E</span><span>x</span><span>p</span><span>e</span><span>r</span><span>i</span><span>m</span><span>e</span><span>n</span><span>t</span><span>e <span>1</span> <span>M</span><span>ê</span><span>s </span> G</span><span>r</span><span>á</span><span>t</span><span>i</span><span>s</span>
                                    </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="price-table style-3 mx-3 my-3">
                                    <div class="price-inside">Completo</div>
                                    <div class="price-header">
                                        <div class="price-value">
                                            <h2>299,99</h2>
                                            <span>Pacote Mensal</span>
                                        </div>
                                        <h3 class="price-title">Completo</h3>
                                    </div>
                                    <div class="price-list">
                                        <ul class="list-unstyled">
                                            <li>Funções do Plano básico +</li>
                                            <li>Emissão de Boletos</li>
                                            <li>Relatórios gerenciais</li>
                                            <li>Permissões por usuário</li>
                                            <li>Logs de auditoria</li>
                                        </ul>
                                    </div>
                                    <a class="btn btn-theme btn-circle mt-4" href="#"
                                       data-text="Experimente 1 Mês grátis">
                                        <span>E</span><span>x</span><span>p</span><span>e</span><span>r</span><span>i</span><span>m</span><span>e</span><span>n</span><span>t</span><span>e <span>1</span> <span>M</span><span>ê</span><span>s </span> G</span><span>r</span><span>á</span><span>t</span><span>i</span><span>s</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--pricing end-->


        <!--testimonial start-->


        <!--testimonial end-->


        <!--blog start-->


        <!--blog end-->

    </div>

    <!--body content end-->


    <!--footer start-->

    <footer class="footer dark-bg position-relative animatedBackground" data-bg-img="images/pattern/03.png">
        <div class="footer-wave" data-bg-img="images/bg/08.png">
        </div>
        <div class="primary-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-logo">
                            <img id="logo-img" class="img-fluid" src="{{ url('assets/images/logo-the-place.png') }}"
                                 alt="">
                        </div>
                        <p class="mb-0">Softino Software Landing Page Is fully responsible, Build whatever you like with
                            the Softino, Softino is the creative, modern HTML5 Template suitable for Your business.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 ps-md-5 mt-5 mt-md-0 footer-list justify-content-between d-flex">
                        <ul class="list-unstyled w-100">
                            <li><a href="about-us.html">Sobre</a>
                            </li>
                            <li><a href="services.html">Service</a>
                            </li>
                            <li><a href="team.html">Team</a>
                            </li>
                            <li><a href="team-single.html">Team Single</a>
                            </li>
                            <li><a href="contact.html">Contact Us</a>
                            </li>
                        </ul>
                        <ul class="list-unstyled w-100">
                            <li><a href="blog-right-sidebar.html">Blog</a>
                            </li>
                            <li><a href="faq.html">Faq</a>
                            </li>
                            <li><a href="error-404.html">Error 404</a>
                            </li>
                            <li><a href="privacy-policy.html">Privacy Policy</a>
                            </li>
                            <li><a href="terms-and-conditions.html">Terms</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-12 mt-5 mt-lg-0">
                        <ul class="media-icon list-unstyled">
                            <li>
                                <p class="mb-0">Address: <b>423B, Road Wordwide Country, USA</b>
                                </p>
                            </li>
                            <li>Email: <a href="mailto:themeht23@gmail.com"><b>themeht23@gmail.com</b></a>
                            </li>
                            <li>Phone: <a href="tel:+912345678900"><b>+91-234-567-8900</b></a>
                            </li>
                            <li>Fax: <a href="tel:+912345678900"><b>+91-234-567-8900</b></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="secondary-footer">
            <div class="container">
                <div class="copyright">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12"><span>Copyright 2019 Softino Theme by <u><a href="#">ThemeHt</a></u> | All Rights Reserved</span>
                        </div>
                        <div class="col-lg-6 col-md-12 text-lg-end mt-3 mt-lg-0">
                            <div class="footer-social">
                                <ul class="list-inline">
                                    <li class="me-2"><a href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
                                    </li>
                                    <li class="me-2"><a href="#"><i class="fab fa-twitter"></i> Twitter</a>
                                    </li>
                                    <li><a href="#"><i class="fab fa-google-plus-g"></i> Google Plus</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!--footer end-->


</div>

<!-- page wrapper end -->


<!--back-to-top start-->

<div class="scroll-top"><a class="smoothscroll" href="#top"><i class="flaticon-go-up-in-web"></i></a></div>

<!--back-to-top end-->


<!-- inject js start -->

<!--== jquery -->
<script src="assets/site/js/theme.js"></script>

<!--== owl-carousel -->
<script src="assets/site/js/owl-carousel/owl.carousel.min.js"></script>

<!--== magnific-popup -->
<script src="assets/site/js/magnific-popup/jquery.magnific-popup.min.js"></script>

<!--== counter -->
<script src="assets/site/js/counter/counter.js"></script>

<!--== countdown -->
<script src="assets/site/js/countdown/jquery.countdown.min.js"></script>

<!--== canvas -->
<script src="assets/site/js/canvas.js"></script>

<!--== confetti -->
<script src="assets/site/js/confetti.js"></script>

<!--== step animation -->
<script src="assets/site/js/snap.svg.js"></script>
<script src="assets/site/js/step.js"></script>

<!--== contact-form -->
<script src="assets/site/js/contact-form/contact-form.js"></script>

<!--== wow -->
<script src="assets/site/js/wow.min.js"></script>

<!--== theme-script -->
<script src="assets/site/js/theme-script.js"></script>

<!-- inject js end -->

</body>

</html>

