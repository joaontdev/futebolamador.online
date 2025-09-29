<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FutPlay - Plataforma de Futebol Amador</title>
    <meta name="description"
        content="FutPlay - A plataforma completa para gerenciar equipes de futebol amador e seus confrontos">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?=BASE_URL?>/public/assets/css/style.css">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-custom fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="#">
                <i class="bi bi-trophy-fill me-2"></i>FutPlay
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=BASE_URL?>/app/views/feed-confrontos.html">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#como-funciona">Como Funciona</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#recursos">Recursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contato">Contato</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light ms-2 px-3" href="<?=BASE_URL?>/nova-equipe">Cadastrar
                            Equipe</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="inicio" class="hero-section">
        <div class="container">
            <div class="row align-items-center min-vh-100 py-5">
                <div class="col-lg-6">
                    <div class="hero-content text-white">
                        <h1 class="display-4 fw-bold mb-4 animate-fade-in">
                            Gerencie seu Futebol Amador com o <span class="text-warning">FutPlay</span>
                        </h1>
                        <p class="lead mb-4 animate-fade-in-delay">
                            A plataforma completa para cadastrar equipes, organizar confrontos e acompanhar resultados
                            do futebol amador. Simples, rápido e eficiente.
                        </p>
                        <div class="d-flex flex-column flex-sm-row gap-3 animate-fade-in-delay-2">
                            <a href="<?=BASE_URL?>/nova-equipe" class="btn btn-warning btn-lg px-4 py-3 fw-semibold">
                                <i class="bi bi-people-fill me-2"></i>Cadastrar Equipe
                            </a>
                            <a href="<?=BASE_URL?>/novo-confronto"
                                class="btn btn-outline-light btn-lg px-4 py-3 fw-semibold">
                                <i class="bi bi-calendar-event me-2"></i>Adicionar Confronto
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image-container animate-slide-in">
                        <img src="<?=BASE_URL?>/public/assets/images/hero-image.png" alt="Futebol Amador"
                            class="img-fluid rounded-4 shadow-lg">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Como Funciona Section -->
    <section id="como-funciona" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-5 fw-bold text-dark mb-3">Como Funciona o FutPlay</h2>
                    <p class="lead text-muted">Três passos simples para começar a usar nossa plataforma</p>
                </div>
            </div>

            <div class="row g-4">
                <!-- Passo 1 -->
                <div class="col-lg-4">
                    <div class="feature-card card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon bg-custom text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
                                style="width: 80px; height: 80px;">
                                <i class="bi bi-people-fill fs-2"></i>
                            </div>
                            <h4 class="fw-bold mb-3">1. Cadastre sua Equipe</h4>
                            <p class="text-muted">
                                Primeiro, você deve cadastrar sua equipe na plataforma. Se a equipe já existir, você
                                pode pular esta etapa. O cadastro é simples e rápido, incluindo nome da equipe, cidade e
                                informações básicas.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Passo 2 -->
                <div class="col-lg-4">
                    <div class="feature-card card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon bg-custom text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
                                style="width: 80px; height: 80px;">
                                <i class="bi bi-calendar-event fs-2"></i>
                            </div>
                            <h4 class="fw-bold mb-3">2. Adicione o Confronto</h4>
                            <p class="text-muted">
                                Depois, você adiciona o confronto entre duas equipes informando ambas as equipes
                                participantes, a data do jogo, o local onde será realizado e o resultado final da
                                partida.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Passo 3 -->
                <div class="col-lg-4">
                    <div class="feature-card card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon bg-custom text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
                                style="width: 80px; height: 80px;">
                                <i class="bi bi-trophy-fill fs-2"></i>
                            </div>
                            <h4 class="fw-bold mb-3">3. Visualize os Resultados</h4>
                            <p class="text-muted">
                                Assim que o confronto for adicionado, o resultado será automaticamente exibido na página
                                inicial da plataforma, permitindo que todos acompanhem os jogos e resultados das
                                equipes.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recursos Section -->
    <section id="recursos" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-5 fw-bold text-dark mb-3">Recursos da Plataforma</h2>
                    <p class="lead text-muted">Tudo que você precisa para gerenciar seu futebol amador</p>
                </div>
            </div>

            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <img src="<?=BASE_URL?>/public/assets/images/team-image.jpg" alt="Equipes de Futebol" class="img-fluid rounded-4 shadow">
                </div>
                <div class="col-lg-6">
                    <div class="ps-lg-4">
                        <h3 class="fw-bold mb-4">Gerencie suas Equipes</h3>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="fw-semibold mb-1">Cadastro Simples</h5>
                                        <p class="text-muted mb-0">Cadastre equipes rapidamente com informações
                                            essenciais</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="fw-semibold mb-1">Organização de Confrontos</h5>
                                        <p class="text-muted mb-0">Agende e organize jogos entre equipes facilmente</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0">
                                        <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="fw-semibold mb-1">Resultados em Tempo Real</h5>
                                        <p class="text-muted mb-0">Visualize resultados na página inicial
                                            instantaneamente</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-custom text-white">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="display-5 fw-bold mb-3">Pronto para Começar?</h2>
                    <p class="lead mb-4">Cadastre sua equipe agora e comece a organizar seus confrontos</p>
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                        <a href="<?=BASE_URL?>/nova-equipe" class="btn btn-warning btn-lg px-4 py-3 fw-semibold">
                            <i class="bi bi-people-fill me-2"></i>Cadastrar Equipe
                        </a>
                        <a href="<?=BASE_URL?>/novo-confronto" class="btn btn-outline-light btn-lg px-4 py-3 fw-semibold">
                            <i class="bi bi-calendar-event me-2"></i>Adicionar Confronto
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-bg text-white py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-trophy-fill me-2"></i>FutPlay
                    </h5>
                    <p class="text-light">
                        A plataforma completa para gerenciar equipes de futebol amador e seus confrontos. Simples,
                        rápido e eficiente.
                    </p>
                </div>

                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3">Links Rápidos</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="<?=BASE_URL?>/nova-equipe" class="text-light text-decoration-none">
                                <i class="bi bi-people-fill me-2"></i>Cadastrar Equipe
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="<?=BASE_URL?>/novo-confronto" class="text-light text-decoration-none">
                                <i class="bi bi-calendar-event me-2"></i>Adicionar Confronto
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#como-funciona" class="text-light text-decoration-none">
                                <i class="bi bi-info-circle me-2"></i>Como Funciona
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3">Contato</h5>
                    <div class="mb-3">
                        <p class="text-light mb-2">
                            <i class="bi bi-envelope-fill me-2"></i>contato@futplay.com.br
                        </p>
                        <p class="text-light mb-2">
                            <i class="bi bi-telephone-fill me-2"></i>(11) 99999-9999
                        </p>
                    </div>

                    <h6 class="fw-semibold mb-3">Redes Sociais</h6>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-light fs-4" title="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="text-light fs-4" title="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="text-light fs-4" title="Twitter">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="#" class="text-light fs-4" title="WhatsApp">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>

            <hr class="my-4 border-secondary">

            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-light mb-0">
                        &copy; 2024 FutPlay. Todos os direitos reservados.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="<?=BASE_URL?>/public/assets/js/script.js"></script>
</body>

</html>