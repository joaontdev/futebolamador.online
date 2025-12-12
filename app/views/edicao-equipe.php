<?php

require_once __DIR__ . '../../controllers/LoginController.php';

use App\Controllers\LoginController;

LoginController::exigirLogin();


$equipeId = $_GET['id'] ?? null;
if (!$equipeId) {
    // Redireciona se o ID não for fornecido
    header("Location: " . BASE_URL . "/dashboard");
    exit;
}

require_once __DIR__ . '../../controllers/EquipeController.php';

use App\Controllers\EquipeController;

$equipeController = new EquipeController();
$equipe = $equipeController->buscarPorId($equipeId);


?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Equipe - FutPlay</title>
    <meta name="description" content="Cadastre sua equipe de futebol amador na plataforma FutPlay">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/cadastro.css">
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
                <div class="col-lg-8 col-xl-6">
                    <div class="form-container">
                        <!-- Header -->
                        <div class="text-center mb-5">
                            <div
                                class="form-icon bg-custom text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4">
                                <i class="bi bi-people-fill fs-2"></i>
                            </div>
                            <h1 class="display-6 fw-bold text-dark mb-3">Cadastro de Equipe</h1>
                            <p class="lead text-muted">
                                Preencha os dados da sua equipe para começar a usar o FutPlay
                            </p>
                        </div>

                        <!-- Form -->
                        <form action="<?= BASE_URL ?>/edicao-equipe/salvar" class="needs-validation" method="post" novalidate>
                            <div class="row g-4">

                                <div class="col-3">
                                    <label for="idEquipe" class="form-label fw-semibold">Identificação *
                                    </label>
                                    <input type="text" class="form-control form-control-lg" id="idEquipe"
                                        name="idEquipe" value="<?= $equipe->id ?>" required>
                                    <div class="invalid-feedback">
                                        Por favor, informe o id.
                                    </div>
                                </div>

                                <!-- Nome da Equipe -->
                                <div class="col-9">
                                    <label for="nomeEquipe" class="form-label fw-semibold">Nome da Equipe *
                                    </label>
                                    <input type="text" class="form-control form-control-lg" id="nomeEquipe"
                                        name="nomeEquipe" value="<?= $equipe->nome_equipe ?>" required>
                                    <div class="invalid-feedback">
                                        Por favor, informe o nome da equipe.
                                    </div>
                                </div>

                                <!-- Logradouro -->
                                <div class="col-12">
                                    <label for="logradouro" class="form-label fw-semibold">
                                        <i class="bi bi-geo-alt me-2 text-success"></i>Logradouro *
                                    </label>
                                    <input type="text" class="form-control form-control-lg" id="logradouro"
                                        name="logradouro" placeholder="Rua, Avenida, etc." value="<?= $equipe->logradouro ?>" required>
                                    <div class="invalid-feedback">
                                        Por favor, informe o logradouro.
                                    </div>
                                </div>

                                <!-- Cidade e Estado -->
                                <div class="col-md-8">
                                    <label for="cidade" class="form-label fw-semibold">
                                        <i class="bi bi-building me-2 text-success"></i>Cidade *
                                    </label>
                                    <input type="text" class="form-control form-control-lg" id="cidade" name="cidade" value="<?= $equipe->cidade ?>"
                                        required>
                                    <div class="invalid-feedback">
                                        Por favor, informe a cidade.
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="estado" class="form-label fw-semibold">
                                        <i class="bi bi-map me-2 text-success"></i>Estado *
                                    </label>
                                    <select class="form-select form-select-lg" id="estado" name="estado" value="<?= $equipe->estado ?>" required>


                                        <option value="">Selecione</option>
                                        <option value="AC" <?= ($equipe->estado == "AC" ? "selected" : "") ?>>Acre</option>
                                        <option value="AL" <?= ($equipe->estado == "AL" ? "selected" : "") ?>>Alagoas</option>
                                        <option value="AP" <?= ($equipe->estado == "AP" ? "selected" : "") ?>>Amapá</option>
                                        <option value="AM" <?= ($equipe->estado == "AM" ? "selected" : "") ?>>Amazonas</option>
                                        <option value="BA" <?= ($equipe->estado == "BA" ? "selected" : "") ?>>Bahia</option>
                                        <option value="CE" <?= ($equipe->estado == "CE" ? "selected" : "") ?>>Ceará</option>
                                        <option value="DF" <?= ($equipe->estado == "DF" ? "selected" : "") ?>>Distrito Federal</option>
                                        <option value="ES" <?= ($equipe->estado == "ES" ? "selected" : "") ?>>Espírito Santo</option>
                                        <option value="GO" <?= ($equipe->estado == "GO" ? "selected" : "") ?>>Goiás</option>
                                        <option value="MA" <?= ($equipe->estado == "MA" ? "selected" : "") ?>>Maranhão</option>
                                        <option value="MT" <?= ($equipe->estado == "MT" ? "selected" : "") ?>>Mato Grosso</option>
                                        <option value="MS" <?= ($equipe->estado == "MS" ? "selected" : "") ?>>Mato Grosso do Sul</option>
                                        <option value="MG" <?= ($equipe->estado == "MG" ? "selected" : "") ?>>Minas Gerais</option>
                                        <option value="PA" <?= ($equipe->estado == "PA" ? "selected" : "") ?>>Pará</option>
                                        <option value="PB" <?= ($equipe->estado == "PB" ? "selected" : "") ?>>Paraíba</option>
                                        <option value="PR" <?= ($equipe->estado == "PR" ? "selected" : "") ?>>Paraná</option>
                                        <option value="PE" <?= ($equipe->estado == "PE" ? "selected" : "") ?>>Pernambuco</option>
                                        <option value="PI" <?= ($equipe->estado == "PI" ? "selected" : "") ?>>Piauí</option>
                                        <option value="RJ" <?= ($equipe->estado == "RJ" ? "selected" : "") ?>>Rio de Janeiro</option>
                                        <option value="RN" <?= ($equipe->estado == "RN" ? "selected" : "") ?>>Rio Grande do Norte</option>
                                        <option value="RS" <?= ($equipe->estado == "RS" ? "selected" : "") ?>>Rio Grande do Sul</option>
                                        <option value="RO" <?= ($equipe->estado == "RO" ? "selected" : "") ?>>Rondônia</option>
                                        <option value="RR" <?= ($equipe->estado == "RR" ? "selected" : "") ?>>Roraima</option>
                                        <option value="SC" <?= ($equipe->estado == "SC" ? "selected" : "") ?>>Santa Catarina</option>
                                        <option value="SP" <?= ($equipe->estado == "SP" ? "selected" : "") ?>>São Paulo</option>
                                        <option value="SE" <?= ($equipe->estado == "SE" ? "selected" : "") ?>>Sergipe</option>
                                        <option value="TO" <?= ($equipe->estado == "TO" ? "selected" : "") ?>>Tocantins</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor, selecione o estado.
                                    </div>
                                </div>

                                <!-- Ano de Fundação -->
                                <div class="col-md-6">
                                    <label for="anoFundacao" class="form-label fw-semibold">
                                        <i class="bi bi-calendar-event me-2 text-success"></i>Ano de Fundação *
                                    </label>
                                    <input type="number" class="form-control form-control-lg" id="anoFundacao"
                                        name="anoFundacao" min="1900" max="2024" value="<?= $equipe->ano_fundacao ?>" required>
                                    <div class="invalid-feedback">
                                        Por favor, informe um ano válido (1900-2024).
                                    </div>
                                </div>

                                <!-- Nome do Comandante -->
                                <div class="col-md-6">
                                    <label for="nomeComandante" class="form-label fw-semibold">
                                        <i class="bi bi-person-badge me-2 text-success"></i>Nome do Atual Comandante *
                                    </label>
                                    <input type="text" class="form-control form-control-lg" id="nomeComandante"
                                        name="nomeComandante" value="<?= $equipe->nome_comandante ?>" required>
                                    <div class="invalid-feedback">
                                        Por favor, informe o nome do comandante.
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="col-12 mt-5">
                                    <div class="d-grid gap-3 d-md-flex justify-content-md-center">
                                        <button type="submit" class="btn btn-success btn-lg px-5 py-3 fw-semibold">
                                            <i class="bi bi-check-circle me-2"></i>Cadastrar Equipe
                                        </button>
                                        <a href="<?= BASE_URL ?>/dashboard"
                                            class="btn btn-outline-secondary btn-lg px-5 py-3 fw-semibold">
                                            <i class="bi bi-arrow-left me-2"></i>Cancelar
                                        </a>
                                    </div>
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
    <script>
        const url = "<?= BASE_URL ?>";
    </script>
    <script src="<?= BASE_URL ?>/public/assets/js/script.js"></script>
    <script src="<?= BASE_URL ?>/public/assets/js/cadastro.js"></script>
</body>

</html>