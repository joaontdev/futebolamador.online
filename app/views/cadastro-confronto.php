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
                <div class="col-lg-10 col-xl-8">
                    <div class="form-container">
                        <!-- Header -->
                        <div class="text-center mb-5">
                            <div
                                class="form-icon bg-custom text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4">
                                <i class="bi bi-calendar-event fs-2"></i>
                            </div>
                            <h1 class="display-6 fw-bold text-dark mb-3">Cadastro de Confronto</h1>
                            <p class="lead text-muted">
                                Registre o confronto entre duas equipes com todos os detalhes
                            </p>
                        </div>

                        <!-- Form -->
                        <form id="cadastroConfrontoForm" class="needs-validation" novalidate>
                            <div class="row g-4">
                                <!-- Seção: Equipes -->
                                <div class="col-12">
                                    <h4 class="fw-bold text-success mb-3">
                                        <i class="bi bi-people-fill me-2"></i>Equipes
                                    </h4>
                                </div>

                                <!-- Equipe Mandante -->
                                <div class="col-md-6">
                                    <label for="equipeMandante" class="form-label fw-semibold">
                                        <i class="bi bi-house-fill me-2 text-success"></i>Equipe Mandante *
                                    </label>
                                    <input type="text" class="form-control form-control-lg" id="equipeMandante"
                                        name="equipeMandante" placeholder="Nome da equipe da casa" required>
                                    <div class="invalid-feedback">
                                        Por favor, informe a equipe mandante.
                                    </div>
                                </div>

                                <!-- Equipe Visitante -->
                                <div class="col-md-6">
                                    <label for="equipeVisitante" class="form-label fw-semibold">
                                        <i class="bi bi-airplane me-2 text-success"></i>Equipe Visitante *
                                    </label>
                                    <input type="text" class="form-control form-control-lg" id="equipeVisitante"
                                        name="equipeVisitante" placeholder="Nome da equipe visitante" required>
                                    <div class="invalid-feedback">
                                        Por favor, informe a equipe visitante.
                                    </div>
                                </div>

                                <!-- Seção: Detalhes do Confronto -->
                                <div class="col-12 mt-5">
                                    <h4 class="fw-bold text-success mb-3">
                                        <i class="bi bi-info-circle-fill me-2"></i>Detalhes do Confronto
                                    </h4>
                                </div>

                                <!-- Tipo de Confronto -->
                                <div class="col-md-6">
                                    <label for="tipoConfronto" class="form-label fw-semibold">
                                        <i class="bi bi-flag me-2 text-success"></i>Tipo de Confronto *
                                    </label>
                                    <select class="form-select form-select-lg" id="tipoConfronto" name="tipoConfronto"
                                        required>
                                        <option value="">Selecione o tipo</option>
                                        <option value="campeonato">Campeonato</option>
                                        <option value="amistoso">Amistoso</option>
                                        <option value="copa">Copa</option>
                                        <option value="torneio">Torneio</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor, selecione o tipo de confronto.
                                    </div>
                                </div>

                                <!-- Data do Confronto -->
                                <div class="col-md-6">
                                    <label for="dataConfronto" class="form-label fw-semibold">
                                        <i class="bi bi-calendar3 me-2 text-success"></i>Data do Confronto *
                                    </label>
                                    <input type="date" class="form-control form-control-lg" id="dataConfronto"
                                        name="dataConfronto" required>
                                    <div class="invalid-feedback">
                                        Por favor, informe a data do confronto.
                                    </div>
                                </div>

                                <!-- Hora do Confronto -->
                                <div class="col-md-6">
                                    <label for="horaConfronto" class="form-label fw-semibold">
                                        <i class="bi bi-clock-fill me-2 text-success"></i>Hora do Confronto *
                                    </label>
                                    <input type="time" class="form-control form-control-lg" id="horaConfronto"
                                        name="horaConfronto" required>
                                    <div class="invalid-feedback">
                                        Por favor, informe a hora do confronto.
                                    </div>
                                </div>

                                <!-- Status do Confronto -->
                                <div class="col-md-6">
                                    <label for="statusConfronto" class="form-label fw-semibold">
                                        <i class="bi bi-hourglass-split me-2 text-success"></i>Status do Confronto *
                                    </label>
                                    <select class="form-select form-select-lg" id="statusConfronto"
                                        name="statusConfronto" required>
                                        <option value="">Selecione o status</option>
                                        <option value="realizado">Realizado</option>
                                        <option value="agendado">Agendado</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor, selecione o status do confronto.
                                    </div>
                                </div>

                                <!-- Seção: Local -->
                                <div class="col-12 mt-5">
                                    <h4 class="fw-bold text-success mb-3">
                                        <i class="bi bi-geo-alt-fill me-2"></i>Local do Confronto
                                    </h4>
                                </div>

                                <!-- Logradouro -->
                                <div class="col-12">
                                    <label for="logradouroConfronto" class="form-label fw-semibold">
                                        <i class="bi bi-geo-alt me-2 text-success"></i>Logradouro *
                                    </label>
                                    <input type="text" class="form-control form-control-lg" id="logradouroConfronto"
                                        name="logradouroConfronto" placeholder="Endereço do campo/estádio" required>
                                    <div class="invalid-feedback">
                                        Por favor, informe o logradouro.
                                    </div>
                                </div>

                                <!-- Cidade e Estado -->
                                <div class="col-md-8">
                                    <label for="cidadeConfronto" class="form-label fw-semibold">
                                        <i class="bi bi-building me-2 text-success"></i>Cidade *
                                    </label>
                                    <input type="text" class="form-control form-control-lg" id="cidadeConfronto"
                                        name="cidadeConfronto" required>
                                    <div class="invalid-feedback">
                                        Por favor, informe a cidade.
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="estadoConfronto" class="form-label fw-semibold">
                                        <i class="bi bi-map me-2 text-success"></i>Estado *
                                    </label>
                                    <select class="form-select form-select-lg" id="estadoConfronto"
                                        name="estadoConfronto" required>
                                        <option value="">Selecione</option>
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espírito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor, selecione o estado.
                                    </div>
                                </div>

                                <!-- Seção: Resultado -->
                                <div class="col-12 mt-5">
                                    <h4 class="fw-bold text-success mb-3">
                                        <i class="bi bi-trophy-fill me-2"></i>Resultado do Confronto
                                    </h4>
                                </div>

                                <!-- Gols Equipe Mandante -->
                                <div class="col-md-4">
                                    <label for="golsMandante" class="form-label fw-semibold">
                                        <i class="bi bi-house-fill me-2 text-success"></i>Gols Mandante *
                                    </label>
                                    <input type="number" class="form-control form-control-lg" id="golsMandante"
                                        name="golsMandante" min="0" max="50" required>
                                    <div class="invalid-feedback">
                                        Por favor, informe os gols da equipe mandante.
                                    </div>
                                </div>

                                <!-- VS -->
                                <div class="col-md-4 d-flex align-items-end justify-content-center">
                                    <div class="vs-container text-center mb-3">
                                        <span class="vs-text fw-bold text-success fs-2">VS</span>
                                    </div>
                                </div>

                                <!-- Gols Equipe Visitante -->
                                <div class="col-md-4">
                                    <label for="golsVisitante" class="form-label fw-semibold">
                                        <i class="bi bi-airplane me-2 text-success"></i>Gols Visitante *
                                    </label>
                                    <input type="number" class="form-control form-control-lg" id="golsVisitante"
                                        name="golsVisitante" min="0" max="50" required>
                                    <div class="invalid-feedback">
                                        Por favor, informe os gols da equipe visitante.
                                    </div>
                                </div>

                                <!-- Resultado Automático -->
                                <div class="col-12">
                                    <div class="result-display bg-light p-4 rounded-3 text-center">
                                        <h5 class="fw-bold mb-2">Resultado:</h5>
                                        <div id="resultadoDisplay" class="fs-4 fw-bold text-success">
                                            Preencha os gols para ver o resultado
                                        </div>
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">
                        <i class="bi bi-check-circle-fill me-2"></i>Confronto Cadastrado!
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <div class="mb-3">
                        <i class="bi bi-calendar-event text-success" style="font-size: 3rem;"></i>
                    </div>
                    <h6 class="fw-bold mb-3">Confronto Registrado!</h6>
                    <p class="text-muted mb-3" id="modalResultado">
                        O confronto foi cadastrado com sucesso na plataforma FutPlay.
                    </p>
                    <div class="alert alert-success" role="alert">
                        <i class="bi bi-info-circle me-2"></i>
                        O resultado será exibido na página inicial da plataforma.
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="<?= BASE_URL ?>/inicio" class="btn btn-success px-4">
                        <i class="bi bi-house-fill me-2"></i>Voltar ao Início
                    </a>
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                        Cadastrar Outro Confronto
                    </button>
                </div>
            </div>
        </div>
    </div>

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
    <script src="public/assets/js/script.js"></script>
    <script src="public/assets/js/cadastro.js"></script>
    <script src="public/assets/js/confronto.js"></script>
</body>

</html>