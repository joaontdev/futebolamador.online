<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Não Encontrada - FutPlay</title>
    <meta name="description" content="Página não encontrada na plataforma FutPlay">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/404.css">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-custom fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="<?= BASE_URL ?>/inicio">
                <i class="bi bi-trophy-fill me-2"></i>FutPlay
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/inicio">Voltar ao Início</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-6 mt-5">
                    <div class="container py-5 mt-5 text-center">

                        <!-- Error Icon -->
                        <div class="mb-4">
                            <i class="bi bi-x-circle-fill text-danger display-1"></i>
                        </div>

                        <!-- Error Title -->
                        <h1 class="display-5 fw-bold text-danger mb-3">Algo deu errado!</h1>

                        <!-- Error Message -->
                        <p class="lead text-muted mb-4">
                            Não foi possível concluir a ação solicitada. Isso pode ter ocorrido por uma falha momentânea,
                            dados inválidos ou instabilidade na conexão.
                        </p>

                        <p class="text-muted mb-4">
                            Tente novamente em alguns instantes. Se o problema persistir, entre em contato com o suporte.
                        </p>

                        <!-- Action Buttons -->
                        <div class="d-grid gap-3 d-md-flex justify-content-md-center mb-5">
                            <button onclick="history.back()" class="btn btn-danger btn-lg px-5 py-3 fw-semibold">
                                <i class="bi bi-arrow-left me-2"></i>
                                Voltar
                            </button>

                            <a href="<?= BASE_URL ?>/inicio" class="btn btn-outline-danger btn-lg px-5 py-3 fw-semibold">
                                <i class="bi bi-house-fill me-2"></i>
                                Ir para o Início
                            </a>
                        </div>

                        <!-- Quick Links -->
                        <!-- <div class="mt-5">
                            <h5 class="fw-bold text-dark mb-3">Ações Rápidas</h5>

                            <div class="row g-3">

                                <div class="col-md-4">
                                    <a href="cadastro-equipe.html" class="text-decoration-none">
                                        <div class="card h-100 shadow-sm border-0">
                                            <div class="card-body text-center p-4">
                                                <i class="bi bi-plus-circle text-danger fs-2 mb-3"></i>
                                                <h6 class="fw-bold mb-2">Tentar Novamente</h6>
                                                <p class="text-muted small mb-0">Refazer o processo de cadastro</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-4">
                                    <a href="feed-confrontos.html" class="text-decoration-none">
                                        <div class="card h-100 shadow-sm border-0">
                                            <div class="card-body text-center p-4">
                                                <i class="bi bi-list-check text-danger fs-2 mb-3"></i>
                                                <h6 class="fw-bold mb-2">Ver Registros</h6>
                                                <p class="text-muted small mb-0">Confirme se o item foi salvo parcialmente</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-4">
                                    <a href="contato.html" class="text-decoration-none">
                                        <div class="card h-100 shadow-sm border-0">
                                            <div class="card-body text-center p-4">
                                                <i class="bi bi-headset text-danger fs-2 mb-3"></i>
                                                <h6 class="fw-bold mb-2">Suporte</h6>
                                                <p class="text-muted small mb-0">Fale com nossa equipe de atendimento</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        </div> -->

                    </div>

                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer-bg text-white py-5 mt-5">
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
                            <a href="cadastro-equipe.html" class="text-light text-decoration-none">
                                <i class="bi bi-people-fill me-2"></i>Cadastrar Equipe
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="cadastro-confronto.html" class="text-light text-decoration-none">
                                <i class="bi bi-calendar-event me-2"></i>Adicionar Confronto
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="feed-confrontos.html" class="text-light text-decoration-none">
                                <i class="bi bi-rss-fill me-2"></i>Feed de Confrontos
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
    <script src="<?= BASE_URL ?>/public/assets/js/script.js"></script>
    <script src="<?= BASE_URL ?>/public/assets/js/404.js"></script>
</body>

</html>