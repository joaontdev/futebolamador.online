<?php

require_once __DIR__ . '../../controllers/LoginController.php';

use App\Controllers\ConfrontoController;
use App\Controllers\LoginController;

LoginController::exigirLogin();

require_once __DIR__ . '../../controllers/EquipeController.php';

use App\Controllers\EquipeController;


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - FutPlay</title>
    <!-- <meta name="description" content="Cadastre um confronto de futebol amador na plataforma FutPlay"> -->

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="public/assets/css/style.css">
    <link rel="stylesheet" href="public/assets/css/cadastro.css">
    <!-- <link rel="stylesheet" href="public/assets/css/confronto.css"> -->
</head>

<body>
    <?php
    // Inclui a nav bar da pasta partials
    require_once __DIR__ . '/../views/partials/navbar.php';
    ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="d-flex justify-content-end">
            <a href="<?= BASE_URL ?>/login/logout" class="btn btn-danger btn-sm">
                Logout
            </a>
        </div>
        <div class="table-responsive">
            <h4>Equipes no Sistema</h4>
            <hr>
            <table class="table table-hover align-middle mb-0">
                <thead class="table-success">
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Nome da equipe</th>
                        <th scope="col">Logradouro</th>
                        <th scope="col">Cidade</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Ano fundação</th>
                        <th scope="col">Nome comandante</th>
                        <th scope="col">Status</th>
                        <th scope="col">Excluído</th>
                        <th scope="col">Criado em</th>
                        <th scope="col">Atualizado em</th>
                        <th scope="col" class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?= EquipeController::listarEquipesDashboard() ?>
                </tbody>
            </table>
        </div>
        <br>
        <br>
        <br>
        <div class="table-responsive">
            <h4>Confrontos Registrados</h4>
            <hr>
            <table class="table table-hover align-middle mb-0">
                <thead class="table-success">
                    <tr>
                        <th>ID</th>
                        <th>ID Mandante</th>
                        <th>Gols Mandante</th>
                        <th>ID Visitante</th>
                        <th>Gols Visitante</th>
                        <th>Resultado</th>
                        <th>Logradouro</th>
                        <th>Cidade</th>
                        <th>Estado</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody id="tableBody">

                <?= ConfrontoController::listarConfrontosDashboard() ?>

                    <tr class="row-success">
                        <td>1</td>
                        <td>3</td>
                        <td>2</td>
                        <td>1</td>
                        <td>1</td>
                        <td><span class="badge bg-success">Vitória Mandante</span></td>
                        <td>Estádio Central</td>
                        <td>Quixeramobim</td>
                        <td>CE</td>
                        <td>2025-05-12</td>
                        <td>18:30</td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-outline-success btn-edit"><i class="bi bi-pencil"></i> Editar</button>
                        </td>
                    </tr>


                </tbody>
            </table>
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
                            <a href="<?= BASE_URL ?>/inicio#como-funciona" class="text-light text-decoration-none">
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



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <!-- <script src="public/assets/js/scrip
     t.js"></script> -->
    <!-- <script src="public/assets/js/cadastro.js"></script> -->
    <!-- <script src="public/assets/js/confronto.js"></script> -->
</body>

</html>