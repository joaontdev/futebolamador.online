<?php

require_once __DIR__ . '../../controllers/EquipeController.php';
use App\Controllers\EquipeController;


?>


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
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/style.css">
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
                        <a class="nav-link" href="<?= BASE_URL ?>/app/views/feed-confrontos.html">Início</a>
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
                        <a class="nav-link btn btn-outline-light ms-2 px-3" href="<?= BASE_URL ?>/nova-equipe">Cadastrar
                            Equipe</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="form-container pt-5">
                        <!-- Header -->
                        <div class="text-center mb-5 mt-5">
                            <div
                                class="form-icon bg-custom text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4">
                                <i class="bi bi-people-fill fs-2"></i>
                            </div>
                            <h1 class="display-6 fw-bold text-dark mb-3">Equipes cadastradas</h1>
                            <p class="lead text-muted">
                                Preencha os dados da sua equipe para começar a usar o FutPlay
                            </p>
                        </div>
                        <div class="list-group">

                            <?php

                            // Criar a listagem ser usando apenas o require onde, pois o name space nao funciona em minha hospedagem
                            
                            echo EquipeController::listarEquipes();




                            ?>

                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">NOME DA EQUIPE</h5>
                                    <small class="text-body-secondary">-</small>
                                </div>
                                <p class="mb-1">Representante: Nome do representante</p>
                                <small class="text-body-secondary">Localizcao e ano de fundação</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


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
                            <a href="<?= BASE_URL ?>/nova-equipe" class="text-light text-decoration-none">
                                <i class="bi bi-people-fill me-2"></i>Cadastrar Equipe
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="<?= BASE_URL ?>/novo-confronto" class="text-light text-decoration-none">
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
    <script src="<?= BASE_URL ?>/public/assets/js/script.js"></script>
</body>

</html>