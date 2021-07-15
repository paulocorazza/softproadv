<header id="site-header" class="header">
    <div class="container">
        <div id="header-wrap">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Navbar -->
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand logo" href="{{ url('/') }}">
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
                                <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
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
                <div class="col-4" style="text-align: end; margin-top: 10px">
                    <a class="btn btn-theme btn-circle" href="{{ route('register.show') }}"
                       data-text="Experimente 7 Dias grátis">
                        <span>E</span><span>x</span><span>p</span><span>e</span><span>r</span><span>i</span><span>m</span><span>e</span><span>n</span><span>t</span><span>e <span>7</span> <span>D</span><span>i</span><span>a</span><span>s </span> G</span><span>r</span><span>á</span><span>t</span><span>i</span><span>s</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>


