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
                    <a class="nav-link" href="<?= BASE_URL ?>/app/views/feed-confrontos.html">Feed de confrontos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>/equipes-cadastradas">Equipes Cadastradas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>/nova-equipe">Cadastrar
                        Equipe</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>/inicio">Voltar ao inicio
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>