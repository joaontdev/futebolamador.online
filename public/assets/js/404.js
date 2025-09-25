// Página 404 - JavaScript

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchBtn = document.getElementById('searchBtn');
    const searchSuggestions = document.querySelectorAll('.search-suggestions .badge');

    // Search functionality
    function performSearch() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        
        if (!searchTerm) {
            alert('Por favor, digite algo para buscar.');
            searchInput.focus();
            return;
        }

        // Add loading state
        searchBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Buscando...';
        searchBtn.disabled = true;
        searchInput.classList.add('search-loading');

        // Simulate search delay
        setTimeout(() => {
            // Simple search logic - redirect to relevant pages
            if (searchTerm.includes('equipe') || searchTerm.includes('time') || searchTerm.includes('cadastr')) {
                window.location.href = 'cadastro-equipe.html';
            } else if (searchTerm.includes('confronto') || searchTerm.includes('jogo') || searchTerm.includes('partida')) {
                window.location.href = 'cadastro-confronto.html';
            } else if (searchTerm.includes('resultado') || searchTerm.includes('feed') || searchTerm.includes('placar')) {
                window.location.href = 'feed-confrontos.html';
            } else if (searchTerm.includes('visualizar') || searchTerm.includes('ver') || searchTerm.includes('lista')) {
                window.location.href = 'confrontos.html';
            } else {
                // If no match found, show message and redirect to home
                alert(`Não encontramos resultados para "${searchTerm}". Redirecionando para a página inicial.`);
                setTimeout(() => {
                    window.location.href = 'index.html';
                }, 1000);
            }
        }, 1500);
    }

    // Search button click
    searchBtn.addEventListener('click', performSearch);

    // Search on Enter key
    searchInput.addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            performSearch();
        }
    });

    // Search suggestions click
    searchSuggestions.forEach(suggestion => {
        suggestion.addEventListener('click', function(event) {
            event.preventDefault();
            const suggestionText = this.textContent.trim();
            searchInput.value = suggestionText;
            performSearch();
        });
    });

    // Auto-focus search input after page load
    setTimeout(() => {
        searchInput.focus();
    }, 1000);

    // Add some interactive animations
    const quickLinkCards = document.querySelectorAll('.quick-link-card');
    
    quickLinkCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Add click tracking for analytics (in a real app)
    const actionButtons = document.querySelectorAll('.error-actions .btn');
    
    actionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const action = this.textContent.trim();
            console.log(`404 Page Action: ${action}`);
            
            // Add ripple effect
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Add keyboard navigation
    document.addEventListener('keydown', function(event) {
        // Press 'H' to go home
        if (event.key.toLowerCase() === 'h' && !event.ctrlKey && !event.altKey) {
            if (document.activeElement !== searchInput) {
                window.location.href = 'index.html';
            }
        }
        
        // Press 'B' to go back
        if (event.key.toLowerCase() === 'b' && !event.ctrlKey && !event.altKey) {
            if (document.activeElement !== searchInput) {
                history.back();
            }
        }
        
        // Press '/' to focus search
        if (event.key === '/' && !event.ctrlKey && !event.altKey) {
            event.preventDefault();
            searchInput.focus();
        }
    });

    // Add helpful tooltips
    const tooltips = [
        { element: searchInput, text: 'Digite palavras-chave como "equipe", "confronto" ou "resultado"' },
        { element: searchBtn, text: 'Clique para buscar ou pressione Enter' }
    ];

    tooltips.forEach(tooltip => {
        const element = document.querySelector(`#${tooltip.element.id}`) || tooltip.element;
        if (element) {
            element.setAttribute('title', tooltip.text);
            element.setAttribute('data-bs-toggle', 'tooltip');
            element.setAttribute('data-bs-placement', 'top');
        }
    });

    // Initialize Bootstrap tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl, {
            customClass: 'error-tooltip'
        });
    });

    // Add some fun easter eggs
    let clickCount = 0;
    const soccerBall = document.querySelector('.soccer-ball');
    
    soccerBall.addEventListener('click', function() {
        clickCount++;
        
        if (clickCount === 5) {
            this.style.animation = 'bounce 0.5s ease-in-out 3';
            
            setTimeout(() => {
                alert('🏆 Você encontrou um easter egg! Parabéns pela persistência!');
                this.style.animation = 'bounce 2s infinite';
            }, 1500);
            
            clickCount = 0;
        }
    });

    // Add CSS for ripple effect
    const style = document.createElement('style');
    style.textContent = `
        .ripple {
            position: absolute;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }
        
        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        .error-tooltip {
            font-size: 0.875rem;
        }
    `;
    document.head.appendChild(style);

    // Log page view for analytics
    console.log('404 Page loaded at:', new Date().toISOString());
    
    // Check if user came from internal link
    const referrer = document.referrer;
    if (referrer && referrer.includes(window.location.hostname)) {
        console.log('Internal 404 - Referrer:', referrer);
    }

    console.log('Página 404 carregada com sucesso!');
    console.log('Dicas de navegação:');
    console.log('- Pressione "H" para ir ao início');
    console.log('- Pressione "B" para voltar');
    console.log('- Pressione "/" para focar na busca');
});
