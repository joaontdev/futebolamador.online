// Feed de Confrontos - JavaScript

document.addEventListener('DOMContentLoaded', function() {
    const feedItems = document.getElementById('feedItems');
    const loadingState = document.getElementById('loadingState');
    const emptyState = document.getElementById('emptyState');
    const searchInput = document.getElementById('searchInput');
    const filterTipo = document.getElementById('filterTipo');
    const loadMoreContainer = document.getElementById('loadMoreContainer');
    const loadMoreBtn = document.getElementById('loadMoreBtn');

    let allConfrontos = [];
    let filteredConfrontos = [];
    let displayedItems = 0;
    const itemsPerLoad = 6;

    // Simulate fetching data with more comprehensive dummy data
    function fetchConfrontos() {
        return new Promise(resolve => {
            setTimeout(() => {
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
                        resultado: { vencedor: 'Flamengo FC', tipo: 'vitoria_mandante', placar: '2 x 1' },
                        timestamp: new Date('2025-09-10T20:00:00').getTime()
                    },
                    {
                        equipeMandante: 'Corinthians FC',
                        equipeVisitante: 'Palmeiras FC',
                        tipoConfronto: 'amistoso',
                        dataConfronto: '2025-09-08',
                        horaConfronto: '15:30',
                        logradouroConfronto: 'Arena Corinthians',
                        cidadeConfronto: 'São Paulo',
                        estadoConfronto: 'SP',
                        golsMandante: 1,
                        golsVisitante: 1,
                        statusConfronto: 'realizado',
                        resultado: { vencedor: 'Empate', tipo: 'empate', placar: '1 x 1' },
                        timestamp: new Date('2025-09-08T15:30:00').getTime()
                    },
                    {
                        equipeMandante: 'Grêmio FC',
                        equipeVisitante: 'Internacional FC',
                        tipoConfronto: 'copa',
                        dataConfronto: '2025-09-15',
                        horaConfronto: '21:45',
                        logradouroConfronto: 'Arena do Grêmio',
                        cidadeConfronto: 'Porto Alegre',
                        estadoConfronto: 'RS',
                        golsMandante: 0,
                        golsVisitante: 0,
                        statusConfronto: 'agendado',
                        resultado: { vencedor: 'Aguardando', tipo: 'agendado', placar: '0 x 0' },
                        timestamp: new Date('2025-09-15T21:45:00').getTime()
                    },
                    {
                        equipeMandante: 'Cruzeiro FC',
                        equipeVisitante: 'Atlético-MG',
                        tipoConfronto: 'campeonato',
                        dataConfronto: '2025-09-05',
                        horaConfronto: '19:00',
                        logradouroConfronto: 'Mineirão',
                        cidadeConfronto: 'Belo Horizonte',
                        estadoConfronto: 'MG',
                        golsMandante: 3,
                        golsVisitante: 2,
                        statusConfronto: 'realizado',
                        resultado: { vencedor: 'Cruzeiro FC', tipo: 'vitoria_mandante', placar: '3 x 2' },
                        timestamp: new Date('2025-09-05T19:00:00').getTime()
                    },
                    {
                        equipeMandante: 'São Paulo FC',
                        equipeVisitante: 'Santos FC',
                        tipoConfronto: 'torneio',
                        dataConfronto: '2025-09-20',
                        horaConfronto: '16:00',
                        logradouroConfronto: 'Morumbi',
                        cidadeConfronto: 'São Paulo',
                        estadoConfronto: 'SP',
                        golsMandante: 0,
                        golsVisitante: 0,
                        statusConfronto: 'agendado',
                        resultado: { vencedor: 'Aguardando', tipo: 'agendado', placar: '0 x 0' },
                        timestamp: new Date('2025-09-20T16:00:00').getTime()
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
                        resultado: { vencedor: 'Empate', tipo: 'empate', placar: '2 x 2' },
                        timestamp: new Date('2025-09-01T18:00:00').getTime()
                    },
                    {
                        equipeMandante: 'Fortaleza EC',
                        equipeVisitante: 'Ceará SC',
                        tipoConfronto: 'copa',
                        dataConfronto: '2025-08-28',
                        horaConfronto: '20:30',
                        logradouroConfronto: 'Castelão',
                        cidadeConfronto: 'Fortaleza',
                        estadoConfronto: 'CE',
                        golsMandante: 1,
                        golsVisitante: 0,
                        statusConfronto: 'realizado',
                        resultado: { vencedor: 'Fortaleza EC', tipo: 'vitoria_mandante', placar: '1 x 0' },
                        timestamp: new Date('2025-08-28T20:30:00').getTime()
                    },
                    {
                        equipeMandante: 'Botafogo RJ',
                        equipeVisitante: 'Fluminense FC',
                        tipoConfronto: 'amistoso',
                        dataConfronto: '2025-08-25',
                        horaConfronto: '17:00',
                        logradouroConfronto: 'Estádio Nilton Santos',
                        cidadeConfronto: 'Rio de Janeiro',
                        estadoConfronto: 'RJ',
                        golsMandante: 0,
                        golsVisitante: 3,
                        statusConfronto: 'realizado',
                        resultado: { vencedor: 'Fluminense FC', tipo: 'vitoria_visitante', placar: '0 x 3' },
                        timestamp: new Date('2025-08-25T17:00:00').getTime()
                    },
                    {
                        equipeMandante: 'Sport Recife',
                        equipeVisitante: 'Náutico PE',
                        tipoConfronto: 'campeonato',
                        dataConfronto: '2025-08-22',
                        horaConfronto: '19:30',
                        logradouroConfronto: 'Ilha do Retiro',
                        cidadeConfronto: 'Recife',
                        estadoConfronto: 'PE',
                        golsMandante: 2,
                        golsVisitante: 1,
                        statusConfronto: 'realizado',
                        resultado: { vencedor: 'Sport Recife', tipo: 'vitoria_mandante', placar: '2 x 1' },
                        timestamp: new Date('2025-08-22T19:30:00').getTime()
                    },
                    {
                        equipeMandante: 'Chapecoense',
                        equipeVisitante: 'Avaí FC',
                        tipoConfronto: 'torneio',
                        dataConfronto: '2025-08-18',
                        horaConfronto: '20:00',
                        logradouroConfronto: 'Arena Condá',
                        cidadeConfronto: 'Chapecó',
                        estadoConfronto: 'SC',
                        golsMandante: 1,
                        golsVisitante: 1,
                        statusConfronto: 'realizado',
                        resultado: { vencedor: 'Empate', tipo: 'empate', placar: '1 x 1' },
                        timestamp: new Date('2025-08-18T20:00:00').getTime()
                    }
                ];
                
                // Sort by timestamp (most recent first)
                dummyData.sort((a, b) => b.timestamp - a.timestamp);
                resolve(dummyData);
            }, 1000);
        });
    }

    // Create feed item HTML
    function createFeedItem(confronto, isNew = false) {
        const timeAgo = getTimeAgo(confronto.timestamp);
        const resultClass = confronto.resultado.tipo === 'empate' ? 'empate' : 
                           confronto.resultado.tipo === 'agendado' ? 'agendado' : 'vitoria';
        
        return `
            <div class="feed-item ${isNew ? 'new-item' : ''}">
                ${isNew ? '<div class="new-item-indicator"></div>' : ''}
                <div class="feed-item-header">
                    <div class="d-flex gap-2 align-items-center">
                        <span class="match-type-badge type-${confronto.tipoConfronto}">
                            ${confronto.tipoConfronto.charAt(0).toUpperCase() + confronto.tipoConfronto.slice(1)}
                        </span>
                        <span class="status-badge status-${confronto.statusConfronto}">
                            ${confronto.statusConfronto === 'realizado' ? 'Realizado' : 'Agendado'}
                        </span>
                    </div>
                    <span class="time-ago">${timeAgo}</span>
                </div>
                <div class="feed-item-body">
                    <div class="match-teams">
                        <div class="team-info">
                            <div class="team-name">${confronto.equipeMandante}</div>
                            <div class="team-score">${confronto.golsMandante}</div>
                        </div>
                        <div class="vs-divider">
                            <div class="vs-text">VS</div>
                        </div>
                        <div class="team-info">
                            <div class="team-name">${confronto.equipeVisitante}</div>
                            <div class="team-score">${confronto.golsVisitante}</div>
                        </div>
                    </div>
                    
                    <div class="match-result">
                        <p class="result-text ${resultClass}">
                            ${confronto.resultado.tipo === 'agendado' ? 'Aguardando resultado' : 
                              confronto.resultado.tipo === 'empate' ? 'Empate!' : 
                              `${confronto.resultado.vencedor} venceu!`}
                        </p>
                    </div>
                    
                    <div class="match-details">
                        <div class="detail-item">
                            <i class="bi bi-calendar3"></i>
                            <span>${formatDate(confronto.dataConfronto)} às ${confronto.horaConfronto}</span>
                        </div>
                        <div class="detail-item">
                            <i class="bi bi-geo-alt"></i>
                            <span>${confronto.logradouroConfronto}</span>
                        </div>
                        <div class="detail-item">
                            <i class="bi bi-building"></i>
                            <span>${confronto.cidadeConfronto} - ${confronto.estadoConfronto}</span>
                        </div>
                        <div class="detail-item">
                            <i class="bi bi-trophy"></i>
                            <span>Placar: ${confronto.resultado.placar}</span>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    // Format date for display
    function formatDate(dateString) {
        const date = new Date(dateString + 'T00:00:00');
        return date.toLocaleDateString('pt-BR');
    }

    // Calculate time ago
    function getTimeAgo(timestamp) {
        const now = Date.now();
        const diff = now - timestamp;
        const minutes = Math.floor(diff / (1000 * 60));
        const hours = Math.floor(diff / (1000 * 60 * 60));
        const days = Math.floor(diff / (1000 * 60 * 60 * 24));

        if (timestamp > now) {
            const futureDays = Math.floor((timestamp - now) / (1000 * 60 * 60 * 24));
            const futureHours = Math.floor((timestamp - now) / (1000 * 60 * 60));
            
            if (futureDays > 0) {
                return `em ${futureDays} dia${futureDays > 1 ? 's' : ''}`;
            } else if (futureHours > 0) {
                return `em ${futureHours} hora${futureHours > 1 ? 's' : ''}`;
            } else {
                return 'em breve';
            }
        }

        if (days > 0) {
            return `há ${days} dia${days > 1 ? 's' : ''}`;
        } else if (hours > 0) {
            return `há ${hours} hora${hours > 1 ? 's' : ''}`;
        } else if (minutes > 0) {
            return `há ${minutes} minuto${minutes > 1 ? 's' : ''}`;
        } else {
            return 'agora mesmo';
        }
    }

    // Render feed items
    function renderFeedItems(items, append = false) {
        if (!append) {
            feedItems.innerHTML = '';
            displayedItems = 0;
        }

        const itemsToRender = items.slice(displayedItems, displayedItems + itemsPerLoad);
        
        itemsToRender.forEach((confronto, index) => {
            const itemHTML = createFeedItem(confronto, false);
            feedItems.insertAdjacentHTML('beforeend', itemHTML);
        });

        displayedItems += itemsToRender.length;

        // Show/hide load more button
        if (displayedItems >= items.length) {
            loadMoreContainer.style.display = 'none';
        } else {
            loadMoreContainer.style.display = 'block';
        }

        // Show/hide empty state
        if (items.length === 0) {
            emptyState.style.display = 'block';
            feedItems.style.display = 'none';
        } else {
            emptyState.style.display = 'none';
            feedItems.style.display = 'block';
        }
    }

    // Apply filters
    function applyFilters() {
        loadingState.style.display = 'block';
        feedItems.style.display = 'none';
        emptyState.style.display = 'none';
        loadMoreContainer.style.display = 'none';

        setTimeout(() => {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedTipo = filterTipo.value;

            filteredConfrontos = allConfrontos.filter(confronto => {
                const matchesSearch = (
                    confronto.equipeMandante.toLowerCase().includes(searchTerm) ||
                    confronto.equipeVisitante.toLowerCase().includes(searchTerm) ||
                    confronto.cidadeConfronto.toLowerCase().includes(searchTerm) ||
                    confronto.logradouroConfronto.toLowerCase().includes(searchTerm)
                );

                const matchesTipo = selectedTipo === '' || confronto.tipoConfronto === selectedTipo;

                return matchesSearch && matchesTipo;
            });

            displayedItems = 0;
            renderFeedItems(filteredConfrontos);
            loadingState.style.display = 'none';
        }, 300);
    }

    // Load more items
    function loadMoreItems() {
        loadMoreBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Carregando...';
        loadMoreBtn.disabled = true;

        setTimeout(() => {
            renderFeedItems(filteredConfrontos, true);
            loadMoreBtn.innerHTML = '<i class="bi bi-arrow-down-circle me-2"></i>Carregar Mais Confrontos';
            loadMoreBtn.disabled = false;
        }, 500);
    }

    // Highlight search terms
    function highlightSearchTerms(text, searchTerm) {
        if (!searchTerm) return text;
        
        const regex = new RegExp(`(${searchTerm})`, 'gi');
        return text.replace(regex, '<span class="highlight">$1</span>');
    }

    // Event listeners
    searchInput.addEventListener('input', debounce(applyFilters, 300));
    filterTipo.addEventListener('change', applyFilters);
    loadMoreBtn.addEventListener('click', loadMoreItems);

    // Scroll to top functionality
    const scrollToTopBtn = document.createElement('button');
    scrollToTopBtn.className = 'scroll-to-top';
    scrollToTopBtn.innerHTML = '<i class="bi bi-arrow-up"></i>';
    scrollToTopBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    document.body.appendChild(scrollToTopBtn);

    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            scrollToTopBtn.classList.add('visible');
        } else {
            scrollToTopBtn.classList.remove('visible');
        }
    });

    // Debounce function
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Auto-refresh functionality (simulate real-time updates)
    function autoRefresh() {
        // In a real application, this would fetch new data from the server
        console.log('Auto-refresh: Checking for new confrontos...');
        
        // Simulate occasionally adding a new confronto
        if (Math.random() < 0.1) { // 10% chance
            const newConfronto = {
                equipeMandante: 'Novo Time A',
                equipeVisitante: 'Novo Time B',
                tipoConfronto: 'amistoso',
                dataConfronto: new Date().toISOString().split('T')[0],
                horaConfronto: new Date().toTimeString().split(' ')[0].substring(0, 5),
                logradouroConfronto: 'Campo Novo',
                cidadeConfronto: 'Cidade Nova',
                estadoConfronto: 'SP',
                golsMandante: Math.floor(Math.random() * 4),
                golsVisitante: Math.floor(Math.random() * 4),
                statusConfronto: 'realizado',
                resultado: { vencedor: 'Novo Time A', tipo: 'vitoria_mandante', placar: '2 x 1' },
                timestamp: Date.now()
            };
            
            allConfrontos.unshift(newConfronto);
            applyFilters();
        }
    }

    // Set up auto-refresh every 30 seconds
    setInterval(autoRefresh, 30000);

    // Initial load
    fetchConfrontos().then(data => {
        allConfrontos = data;
        applyFilters();
    });

    console.log('Feed de Confrontos carregado com sucesso!');
});

