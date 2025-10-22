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
                <div class="col-lg-8 col-xl-6">
                    <div class="error-container text-center">
                        <!-- Error Icon -->
                        <div class="error-icon mb-4">
                            <div class="soccer-ball">
                                <i class="bi bi-emoji-frown fs-1"></i>
                            </div>
                        </div>

                        <!-- 404 Number -->
                        <div class="error-number mb-4">
                            <span class="number-4">4</span>
                            <span class="soccer-icon">
                                <i class="bi bi-circle-fill"></i>
                            </span>
                            <span class="number-4">4</span>
                        </div>

                        <!-- Error Message -->
                        <div class="error-message mb-5">
                            <h1 class="display-5 fw-bold text-dark mb-3">Ops! Página não encontrada</h1>
                            <p class="lead text-muted mb-4">
                                Parece que a página que você está procurando saiu de campo.
                                Não se preocupe, isso acontece até com os melhores jogadores!
                            </p>
                            <p class="text-muted">
                                A página pode ter sido movida, removida ou você pode ter digitado o endereço
                                incorretamente.
                            </p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="error-actions">
                            <div class="d-grid gap-3 d-md-flex justify-content-md-center">
                                <a href="index.html" class="btn btn-success btn-lg px-5 py-3 fw-semibold">
                                    <i class="bi bi-house-fill me-2"></i>Voltar ao Início
                                </a>
                                <button onclick="history.back()"
                                    class="btn btn-outline-success btn-lg px-5 py-3 fw-semibold">
                                    <i class="bi bi-arrow-left me-2"></i>Página Anterior
                                </button>
                            </div>
                        </div>

                        <!-- Quick Links -->
                        <div class="quick-links mt-5">
                            <h5 class="fw-bold text-dark mb-3">Ou acesse diretamente:</h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <a href="cadastro-equipe.html" class="quick-link-card">
                                        <div class="card h-100 border-0 shadow-sm">
                                            <div class="card-body text-center p-4">
                                                <i class="bi bi-people-fill text-success fs-2 mb-3"></i>
                                                <h6 class="fw-bold mb-2">Cadastrar Equipe</h6>
                                                <p class="text-muted small mb-0">Registre sua equipe na plataforma</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="cadastro-confronto.html" class="quick-link-card">
                                        <div class="card h-100 border-0 shadow-sm">
                                            <div class="card-body text-center p-4">
                                                <i class="bi bi-calendar-event text-success fs-2 mb-3"></i>
                                                <h6 class="fw-bold mb-2">Novo Confronto</h6>
                                                <p class="text-muted small mb-0">Cadastre um novo jogo</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="feed-confrontos.html" class="quick-link-card">
                                        <div class="card h-100 border-0 shadow-sm">
                                            <div class="card-body text-center p-4">
                                                <i class="bi bi-rss-fill text-success fs-2 mb-3"></i>
                                                <h6 class="fw-bold mb-2">Feed de Confrontos</h6>
                                                <p class="text-muted small mb-0">Veja todos os resultados</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Search Box -->
                        <div class="search-box mt-5">
                            <h5 class="fw-bold text-dark mb-3">Ou procure o que você precisa:</h5>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-custom text-white">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" class="form-control" id="searchInput"
                                    placeholder="Digite o que você está procurando...">
                                <button class="btn btn-success" type="button" id="searchBtn">
                                    Buscar
                                </button>
                            </div>
                            <div class="search-suggestions mt-3">
                                <small class="text-muted">Sugestões: </small>
                                <a href="cadastro-equipe.html"
                                    class="badge bg-light text-dark text-decoration-none me-2">cadastrar equipe</a>
                                <a href="cadastro-confronto.html"
                                    class="badge bg-light text-dark text-decoration-none me-2">novo jogo</a>
                                <a href="feed-confrontos.html"
                                    class="badge bg-light text-dark text-decoration-none me-2">resultados</a>
                            </div>
                        </div>
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