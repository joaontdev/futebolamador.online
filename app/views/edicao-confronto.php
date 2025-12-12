<?php

require_once __DIR__ . '../../controllers/LoginController.php';

use App\Controllers\LoginController;

LoginController::exigirLogin();


require_once __DIR__ . '../../controllers/ConfrontoController.php';

use App\Controllers\ConfrontoController;

require_once __DIR__ . '../../controllers/EquipeController.php';

use App\Controllers\EquipeController;

$confrontoId = $_GET['id'] ?? null;
if (!$confrontoId) {
    // Redireciona se o ID não for fornecido
    header("Location: " . BASE_URL . "/dashboard");
    exit;
}

$confrontoModel = new ConfrontoController();
$confrontoData = $confrontoModel->getConfrontoById($confrontoId);
if (!$confrontoData) {
    // Redireciona se o confronto não for encontrado
    header("Location: " . BASE_URL . "/dashboard");
    exit;
}


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Confronto - FutPlay</title>
    <meta name="description" content="Cadastre um confronto de futebol amador na plataforma FutPlay">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="public/assets/css/style.css">
    <link rel="stylesheet" href="public/assets/css/cadastro.css">
    <link rel="stylesheet" href="public/assets/css/confronto.css">
</head>

<body>
    <?php
    // Inclui a nav bar da pasta partials
    require_once __DIR__ . '/../views/partials/navbar.php';

    ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <div class="form-container">

                        <form action="<?= BASE_URL ?>/edicao-de-confronto/atualizar" method="post" class="needs-validation">

                            <!-- Header -->
                            <div class="text-center mb-5">
                                <div
                                    class="form-icon bg-custom text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4">
                                    <i class="bi bi-people-fill fs-2"></i>
                                </div>
                                <h1 class="display-6 fw-bold text-dark mb-3">Edição de Confronto</h1>
                                <p class="lead text-muted">
                                    Preencha os dados do confronto para aparecer na time line
                                </p>
                            </div>

                            <div class="row mb-4">
                                <label class="form-label fw-semibold">
                                    Identificação do Confronto (ID)
                                </label>
                                <input type="text" class="form-control form-control-lg" id="id_confronto"
                                    name="id_confronto" placeholder="ID do Confronto" value="<?= $confrontoData->id ?>" readonly required>
                                <div class="invalid-feedback">
                                    Por favor, informe o ID do confronto.
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">
                                        Equipe Mandante
                                    </label>
                                    <select type="text" class="form-control " name="equipeMandante" required>
                                        <option value=""></option>
                                        <?= EquipeController::getEquipesOptions($confrontoData->id_equipe_mandante) ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor, informe a equipe mandante.
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label fw-semibold">
                                        Gols
                                    </label>
                                    <select type="text" class="form-control " name="golsEquipeVitoriosa" required>
                                        <?= ConfrontoController::gerarOptionsZeroADez($confrontoData->gols_equipe_mandante) ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor, informe os gols da equipe que venceu.
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">
                                        Equipe Visitante
                                    </label>
                                    <select type="text" class="form-control " name="equipeVisitante" required>
                                        <?= EquipeController::getEquipesOptions($confrontoData->id_equipe_visitante) ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor, informe a equipe visitante.
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label fw-semibold">
                                        Gols
                                    </label>
                                    <select type="text" class="form-control  form-control-lg" name="golsEquipePerdedora" required>
                                        <?= ConfrontoController::gerarOptionsZeroADez($confrontoData->gols_equipe_visitante) ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor, informe os gols da equipe que perdeu.
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">
                                        Equipe Vencedora
                                    </label>
                                    <select type="text" class="form-control " name="equipeVitoriosa" required>
                                        <option value=""></option>
                                        <?= ConfrontoController::gerarOptionsResultado($confrontoData->resultadoPartida) ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor, informe a equipe que venceu.
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <label for="logradouro" class="form-label fw-semibold">
                                        Rua, Bairro ou Comunidade
                                    </label>
                                    <input type="text" class="form-control form-control-lg" id="logradouro"
                                        name="logradouro" placeholder="Rua, Avenida, etc." value="<?= $confrontoData->logradouro ?>" required>
                                    <div class="invalid-feedback">
                                        Por favor, informe o logradouro.
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-4">

                                <div class="col-md-6">
                                    <label for="cidade" class="form-label fw-semibold">Cidade
                                    </label>
                                    <input type="text" class="form-control form-control-lg" id="cidade" name="cidade" value="<?= $confrontoData->cidade ?>"
                                        required>
                                    <div class="invalid-feedback">
                                        Por favor, informe a cidade.
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="estado" class="form-label fw-semibold">
                                        Estado
                                    </label>
                                    <select class="form-select form-select-lg" id="estado" name="estado" required>
                                        <?= ConfrontoController::gerarOptionsEstados($confrontoData->estado) ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor, selecione o estado.
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="" class="form-label fw-semibold">
                                        Data
                                    </label>
                                    <input type="date" class="form-control" name="dataPartida" value="<?= $confrontoData->data_partida ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="" class="form-label fw-semibold">
                                        Hora
                                    </label>
                                    <input type="time" class="form-control" name="horaPartida" value="<?= $confrontoData->hora_partida ?>">
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="col-12 mt-5">
                                <div class="d-grid gap-3 d-md-flex justify-content-md-center">
                                    <button type="submit" class="btn btn-success btn-lg px-5 py-3 fw-semibold">
                                        <i class="bi bi-check-circle me-2"></i>Cadastrar Confronto
                                    </button>
                                    <a href="<?= BASE_URL ?>/inicio"
                                        class="btn btn-outline-secondary btn-lg px-5 py-3 fw-semibold">
                                        <i class="bi bi-arrow-left me-2"></i>Cancelar
                                    </a>
                                </div>
                            </div>

                        </form>
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

    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <!-- <script src="public/assets/js/scrip
     t.js"></script> -->
    <!-- <script src="public/assets/js/cadastro.js"></script> -->
    <!-- <script src="public/assets/js/confronto.js"></script> -->
</body>

</html>