// Confrontos - JavaScript

document.addEventListener('DOMContentLoaded', function() {
    const confrontosList = document.getElementById('confrontosList');
    const loadingState = document.getElementById('loadingState');
    const emptyState = document.getElementById('emptyState');
    const searchInput = document.getElementById('searchInput');
    const filterTipo = document.getElementById('filterTipo');
    const filterResultado = document.getElementById('filterResultado');
    const paginationContainer = document.getElementById('pagination');

    // Stat cards
    const totalConfrontosEl = document.getElementById('totalConfrontos');
    const totalVitoriasEl = document.getElementById('totalVitorias');
    const totalEmpatesEl = document.getElementById('totalEmpates');
    const totalEquipesEl = document.getElementById('totalEquipes');

    let allConfrontos = [];
    let filteredConfrontos = [];
    let currentPage = 1;
    const itemsPerPage = 5;

    // Simulate fetching data
    function fetchConfrontos() {
        return new Promise(resolve => {
            setTimeout(() => {
                // Simulate some dummy data
                const dummyData = [
                    {
                        equipeMandante: 'Flamengo FC',
                        equipeVisitante: 'Vasco da Gama',
                        tipoConfronto: 'campeonato',
                        dataConfronto: '2025-09-10',
                        horaConfronto: '20:00',
                        logradouroConfronto: 'Estádio Maracanã',
                        cidadeConfronto: 'Rio de Janeiro',
                        estadoConfronto: 'RJ',
                        golsMandante: 2,
                        golsVisitante: 1,
                        statusConfronto: 'realizado',
                        resultado: { vencedor: 'Flamengo FC', tipo: 'vitoria_mandante', placar: '2 x 1' }
                    },
                    {
                        equipeMandante: 'Corinthians FC',
                        equipeVisitante: 'Palmeiras FC',
                        tipoConfronto: 'amistoso',
                        dataConfronto: '2025-09-05',
                        horaConfronto: '15:30',
                        logradouroConfronto: 'Arena Corinthians',
                        cidadeConfronto: 'São Paulo',
                        estadoConfronto: 'SP',
                        golsMandante: 1,
                        golsVisitante: 1,
                        statusConfronto: 'realizado',
                        resultado: { vencedor: 'Empate', tipo: 'empate', placar: '1 x 1' }
                    },
                    {
                        equipeMandante: 'Grêmio FC',
                        equipeVisitante: 'Internacional FC',
                        tipoConfronto: 'copa',
                        dataConfronto: '2025-09-12',
                        horaConfronto: '21:45',
                        logradouroConfronto: 'Arena do Grêmio',
                        cidadeConfronto: 'Porto Alegre',
                        estadoConfronto: 'RS',
                        golsMandante: 0,
                        golsVisitante: 0,
                        statusConfronto: 'agendado',
                        resultado: { vencedor: 'Aguardando', tipo: 'agendado', placar: '0 x 0' }
                    },
                    {
                        equipeMandante: 'Cruzeiro FC',
                        equipeVisitante: 'Atlético-MG',
                        tipoConfronto: 'campeonato',
                        dataConfronto: '2025-09-08',
                        horaConfronto: '19:00',
                        logradouroConfronto: 'Mineirão',
                        cidadeConfronto: 'Belo Horizonte',
                        estadoConfronto: 'MG',
                        golsMandante: 3,
                        golsVisitante: 2,
                        statusConfronto: 'realizado',
                        resultado: { vencedor: 'Cruzeiro FC', tipo: 'vitoria_mandante', placar: '3 x 2' }
                    },
                    {
                        equipeMandante: 'São Paulo FC',
                        equipeVisitante: 'Santos FC',
                        tipoConfronto: 'torneio',
                        dataConfronto: '2025-09-15',
                        horaConfronto: '16:00',
                        logradouroConfronto: 'Morumbi',
                        cidadeConfronto: 'São Paulo',
                        estadoConfronto: 'SP',
                        golsMandante: 0,
                        golsVisitante: 0,
                        statusConfronto: 'agendado',
                        resultado: { vencedor: 'Aguardando', tipo: 'agendado', placar: '0 x 0' }
                    },
                    {
                        equipeMandante: 'Bahia FC',
                        equipeVisitante: 'Vitória FC',
                        tipoConfronto: 'campeonato',
                        dataConfronto: '2025-09-01',
                        horaConfronto: '18:00',
                        logradouroConfronto: 'Arena Fonte Nova',
                        cidadeConfronto: 'Salvador',
                        estadoConfronto: 'BA',
                        golsMandante: 2,
                        golsVisitante: 2,
                        statusConfronto: 'realizado',
                        resultado: { vencedor: 'Empate', tipo: 'empate', placar: '2 x 2' }
                    },
                    {
                        equipeMandante: 'Fortaleza EC',
                        equipeVisitante: 'Ceará SC',
                        tipoConfronto: 'copa',
                        dataConfronto: '2025-09-20',
                        horaConfronto: '20:30',
                        logradouroConfronto: 'Castelão',
                        cidadeConfronto: 'Fortaleza',
                        estadoConfronto: 'CE',
                        golsMandante: 0,
                        golsVisitante: 0,
                        statusConfronto: 'agendado',
                        resultado: { vencedor: 'Aguardando', tipo: 'agendado', placar: '0 x 0' }
                    }
                ];
                resolve(dummyData);
            }, 1000);
        });
    }

    // Render confrontation cards
    function renderConfrontos(confrontosToRender) {
        confrontosList.innerHTML = '';

        if (confrontosToRender.length === 0) {
            emptyState.style.display = 'block';
            loadingState.style.display = 'none';
            return;
        }

        emptyState.style.display = 'none';

        confrontosToRender.forEach(confronto => {
            const card = document.createElement('div');
            card.className = 'col-md-6 col-lg-4';
            card.innerHTML = `
                <div class="confronto-card">
                    <div class="card-header">
                        <span class="badge rounded-pill ${confronto.statusConfronto === 'realizado' ? 'status-realizado' : 'status-agendado'}">
                            ${confronto.statusConfronto === 'realizado' ? 'Realizado' : 'Agendado'}
                        </span>
                        <span class="badge bg-secondary">${confronto.tipoConfronto.charAt(0).toUpperCase() + confronto.tipoConfronto.slice(1)}</span>
                    </div>
                    <div class="card-body text-center">
                        <div class="d-flex justify-content-around align-items-center mb-3">
                            <div>
                                <h5 class="team-name">${confronto.equipeMandante}</h5>
                                <span class="score">${confronto.golsMandante}</span>
                            </div>
                            <span class="vs-text">VS</span>
                            <div>
                                <h5 class="team-name">${confronto.equipeVisitante}</h5>
                                <span class="score">${confronto.golsVisitante}</span>
                            </div>
                        </div>
                        <p class="result-text ${confronto.resultado.tipo === 'vitoria_mandante' || confronto.resultado.tipo === 'vitoria_visitante' ? 'vitoria' : (confronto.resultado.tipo === 'empate' ? 'empate' : '')}">
                            ${confronto.resultado.tipo === 'agendado' ? 'Aguardando resultado' : (confronto.resultado.tipo === 'empate' ? 'Empate' : `${confronto.resultado.vencedor} venceu!`)}
                        </p>
                        <hr>
                        <div class="info-item">
                            <i class="bi bi-calendar3"></i> ${formatDate(confronto.dataConfronto)} às ${confronto.horaConfronto}
                        </div>
                        <div class="info-item">
                            <i class="bi bi-geo-alt"></i> ${confronto.logradouroConfronto}, ${confronto.cidadeConfronto} - ${confronto.estadoConfronto}
                        </div>
                    </div>
                </div>
            `;
            confrontosList.appendChild(card);
        });
    }

    // Format date for display
    function formatDate(dateString) {
        const date = new Date(dateString + 'T00:00:00');
        return date.toLocaleDateString('pt-BR');
    }

    // Update statistics cards
    function updateStats(confrontos) {
        totalConfrontosEl.textContent = confrontos.length;

        let vitorias = 0;
        let empates = 0;
        const equipesParticipantes = new Set();

        confrontos.forEach(c => {
            if (c.statusConfronto === 'realizado') {
                if (c.resultado.tipo === 'vitoria_mandante' || c.resultado.tipo === 'vitoria_visitante') {
                    vitorias++;
                } else if (c.resultado.tipo === 'empate') {
                    empates++;
                }
            }
            equipesParticipantes.add(c.equipeMandante);
            equipesParticipantes.add(c.equipeVisitante);
        });

        totalVitoriasEl.textContent = vitorias;
        totalEmpatesEl.textContent = empates;
        totalEquipesEl.textContent = equipesParticipantes.size;
    }

    // Filter and search logic
    function applyFilters() {
        loadingState.style.display = 'block';
        confrontosList.innerHTML = '';
        emptyState.style.display = 'none';

        setTimeout(() => { // Simulate loading
            const searchTerm = searchInput.value.toLowerCase();
            const selectedTipo = filterTipo.value;
            const selectedResultado = filterResultado.value;

            filteredConfrontos = allConfrontos.filter(confronto => {
                const matchesSearch = (
                    confronto.equipeMandante.toLowerCase().includes(searchTerm) ||
                    confronto.equipeVisitante.toLowerCase().includes(searchTerm) ||
                    confronto.cidadeConfronto.toLowerCase().includes(searchTerm)
                );

                const matchesTipo = selectedTipo === '' || confronto.tipoConfronto === selectedTipo;

                let matchesResultado = true;
                if (selectedResultado === 'vitoria') {
                    matchesResultado = confronto.resultado.tipo === 'vitoria_mandante' || confronto.resultado.tipo === 'vitoria_visitante';
                } else if (selectedResultado === 'empate') {
                    matchesResultado = confronto.resultado.tipo === 'empate';
                }

                return matchesSearch && matchesTipo && matchesResultado;
            });

            currentPage = 1;
            renderPage(currentPage);
            updatePagination();
            updateStats(filteredConfrontos);
            loadingState.style.display = 'none';

            if (filteredConfrontos.length === 0) {
                emptyState.style.display = 'block';
            }
        }, 300);
    }

    // Pagination rendering
    function renderPage(page) {
        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const confrontosToRender = filteredConfrontos.slice(start, end);
        renderConfrontos(confrontosToRender);
    }

    function updatePagination() {
        paginationContainer.innerHTML = '';
        const totalPages = Math.ceil(filteredConfrontos.length / itemsPerPage);

        if (totalPages <= 1) return;

        const createPaginationItem = (text, page, isActive = false, isDisabled = false) => {
            const li = document.createElement('li');
            li.className = `page-item ${isActive ? 'active' : ''} ${isDisabled ? 'disabled' : ''}`;
            const a = document.createElement('a');
            a.className = 'page-link';
            a.href = '#';
            a.innerHTML = text;
            a.addEventListener('click', (e) => {
                e.preventDefault();
                if (!isDisabled && !isActive) {
                    currentPage = page;
                    renderPage(currentPage);
                    updatePagination();
                }
            });
            li.appendChild(a);
            return li;
        };

        paginationContainer.appendChild(createPaginationItem('&laquo;', currentPage - 1, false, currentPage === 1));

        for (let i = 1; i <= totalPages; i++) {
            paginationContainer.appendChild(createPaginationItem(i, i, i === currentPage));
        }

        paginationContainer.appendChild(createPaginationItem('&raquo;', currentPage + 1, false, currentPage === totalPages));
    }

    // Event listeners for filters
    searchInput.addEventListener('input', applyFilters);
    filterTipo.addEventListener('change', applyFilters);
    filterResultado.addEventListener('change', applyFilters);

    // Initial load
    fetchConfrontos().then(data => {
        allConfrontos = data;
        applyFilters(); // Apply initial filters and render
    });

    console.log('Página de Confrontos carregada com sucesso!');
});
});

