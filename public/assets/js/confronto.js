// Cadastro de Confronto - JavaScript

document.addEventListener('DOMContentLoaded', function () {

    // Form elements
    const form = document.getElementById('cadastroConfrontoForm');
    const submitButton = form.querySelector('button[type="submit"]');
    const successModal = new bootstrap.Modal(document.getElementById('successModal'));

    // Result display elements
    const golsMandanteInput = document.getElementById('golsMandante');
    const golsVisitanteInput = document.getElementById('golsVisitante');
    const resultadoDisplay = document.getElementById('resultadoDisplay');
    const resultDisplay = document.querySelector('.result-display');

    // Team inputs
    const equipeMandanteInput = document.getElementById('equipeMandante');
    const equipeVisitanteInput = document.getElementById('equipeVisitante');

    // Form validation
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        event.stopPropagation();

        // Validate form
        if (form.checkValidity()) {
            handleFormSubmission();
        } else {
            // Show validation errors
            form.classList.add('was-validated');

            // Focus on first invalid field
            const firstInvalidField = form.querySelector('.form-control:invalid, .form-select:invalid');
            if (firstInvalidField) {
                firstInvalidField.focus();
                firstInvalidField.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });

    // Handle form submission
    function handleFormSubmission() {
        // Show loading state
        showLoadingState();

        // Collect form data
        const formData = new FormData(form);
        const confrontoData = {
            equipeMandante: formData.get('equipeMandante'),
            equipeVisitante: formData.get('equipeVisitante'),
            tipoConfronto: formData.get('tipoConfronto'),
            dataConfronto: formData.get("dataConfronto"),
            horaConfronto: formData.get("horaConfronto"),
            statusConfronto: formData.get("statusConfronto"),
            logradouroConfronto: formData.get('logradouroConfronto'),
            cidadeConfronto: formData.get('cidadeConfronto'),
            estadoConfronto: formData.get('estadoConfronto'),
            golsMandante: parseInt(formData.get('golsMandante')),
            golsVisitante: parseInt(formData.get('golsVisitante'))
        };



        // Calculate result
        const resultado = calculateResult(confrontoData);
        confrontoData.resultado = resultado;

        // Simulate API call
        setTimeout(() => {
            // Hide loading state
            hideLoadingState();


            // Criar a requisição para salvar

            // Update modal with result
            updateSuccessModal(confrontoData);

            // Show success modal
            successModal.show();

            // Reset form
            form.reset();
            form.classList.remove('was-validated');
            updateResultDisplay();

            // Log data (in real app, this would be sent to server)
            console.log('Confronto cadastrado:', confrontoData);

        }, 2000);
    }

    // Calculate match result
    function calculateResult(data) {
        const golsMandante = data.golsMandante;
        const golsVisitante = data.golsVisitante;

        if (golsMandante > golsVisitante) {
            return {
                vencedor: data.equipeMandante,
                tipo: 'vitoria_mandante',
                placar: `${golsMandante} x ${golsVisitante}`
            };
        } else if (golsVisitante > golsMandante) {
            return {
                vencedor: data.equipeVisitante,
                tipo: 'vitoria_visitante',
                placar: `${golsMandante} x ${golsVisitante}`
            };
        } else {
            return {
                vencedor: 'Empate',
                tipo: 'empate',
                placar: `${golsMandante} x ${golsVisitante}`
            };
        }
    }

    // Update success modal with result
    function updateSuccessModal(data) {
        const modalResultado = document.getElementById('modalResultado');
        const resultado = data.resultado;

        let mensagem = `<strong>${data.equipeMandante} ${resultado.placar} ${data.equipeVisitante}</strong><br>`;

        if (resultado.tipo === 'empate') {
            mensagem += `Resultado: <span class="text-warning fw-bold">Empate</span>`;
        } else {
            mensagem += `Vencedor: <span class="text-success fw-bold">${resultado.vencedor}</span>`;
        }

        mensagem += `<br><small class="text-muted">Tipo: ${data.tipoConfronto.charAt(0).toUpperCase() + data.tipoConfronto.slice(1)} | Data: ${formatDate(data.dataConfronto)}</small>`;

        modalResultado.innerHTML = mensagem;
    }

    // Format date for display
    function formatDate(dateString) {
        const date = new Date(dateString + 'T00:00:00');
        return date.toLocaleDateString('pt-BR');
    }

    // Show loading state
    function showLoadingState() {
        submitButton.disabled = true;
        submitButton.classList.add('btn-loading');
        submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Cadastrando...';
        form.classList.add('loading');
    }

    // Hide loading state
    function hideLoadingState() {
        submitButton.disabled = false;
        submitButton.classList.remove('btn-loading');
        submitButton.innerHTML = '<i class="bi bi-check-circle me-2"></i>Cadastrar Confronto';
        form.classList.remove('loading');
    }

    // Update result display
    function updateResultDisplay() {
        const golsMandante = parseInt(golsMandanteInput.value) || 0;
        const golsVisitante = parseInt(golsVisitanteInput.value) || 0;
        const equipeMandante = equipeMandanteInput.value.trim();
        const equipeVisitante = equipeVisitanteInput.value.trim();

        if (!equipeMandante || !equipeVisitante) {
            resultadoDisplay.textContent = 'Preencha os nomes das equipes';
            resultadoDisplay.className = '';
            resultDisplay.classList.remove('filled');
            return;
        }

        if (golsMandanteInput.value === '' || golsVisitanteInput.value === '') {
            resultadoDisplay.textContent = 'Preencha os gols para ver o resultado';
            resultadoDisplay.className = '';
            resultDisplay.classList.remove('filled');
            return;
        }

        resultDisplay.classList.add('filled');

        let resultado = '';
        let className = '';

        if (golsMandante > golsVisitante) {
            resultado = `${equipeMandante} venceu por ${golsMandante} x ${golsVisitante}`;
            className = 'vitoria';
        } else if (golsVisitante > golsMandante) {
            resultado = `${equipeVisitante} venceu por ${golsMandante} x ${golsVisitante}`;
            className = 'vitoria';
        } else {
            resultado = `Empate: ${golsMandante} x ${golsVisitante}`;
            className = 'empate';
        }

        resultadoDisplay.textContent = resultado;
        resultadoDisplay.className = className;

        // Add success animation
        resultDisplay.classList.add('success-animation');
        setTimeout(() => {
            resultDisplay.classList.remove('success-animation');
        }, 600);
    }

    // Real-time result update
    golsMandanteInput.addEventListener('input', updateResultDisplay);
    golsVisitanteInput.addEventListener('input', updateResultDisplay);
    equipeMandanteInput.addEventListener('input', updateResultDisplay);
    equipeVisitanteInput.addEventListener('input', updateResultDisplay);

    // Real-time validation
    const inputs = form.querySelectorAll('.form-control, .form-select');
    inputs.forEach(input => {
        input.addEventListener('blur', function () {
            validateField(this);
        });

        input.addEventListener('input', function () {
            if (this.classList.contains('is-invalid')) {
                validateField(this);
            }
        });
    });

    // Validate individual field
    function validateField(field) {
        const isValid = field.checkValidity();

        if (isValid) {
            field.classList.remove('is-invalid');
            field.classList.add('is-valid');
        } else {
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
        }

        return isValid;
    }

    // Custom validations

    // Prevent same team names
    function validateTeamNames() {
        const mandante = equipeMandanteInput.value.trim().toLowerCase();
        const visitante = equipeVisitanteInput.value.trim().toLowerCase();

        if (mandante && visitante && mandante === visitante) {
            equipeVisitanteInput.setCustomValidity('A equipe visitante deve ser diferente da mandante');
            equipeMandanteInput.setCustomValidity('A equipe mandante deve ser diferente da visitante');
        } else {
            equipeVisitanteInput.setCustomValidity('');
            equipeMandanteInput.setCustomValidity('');
        }
    }

    equipeMandanteInput.addEventListener('input', validateTeamNames);
    equipeVisitanteInput.addEventListener('input', validateTeamNames);

    // Date validation
    const dataConfrontoInput = document.getElementById('dataConfronto');
    dataConfrontoInput.addEventListener('input', function () {
        const selectedDate = new Date(this.value);
        const today = new Date();
        const maxDate = new Date();
        maxDate.setFullYear(maxDate.getFullYear() + 1);

        today.setHours(0, 0, 0, 0);
        selectedDate.setHours(0, 0, 0, 0);

        if (selectedDate > maxDate) {
            this.setCustomValidity('A data não pode ser superior a um ano no futuro');
        } else {
            this.setCustomValidity('');
        }
    });

    // Goals validation
    function validateGoals(input) {
        const value = parseInt(input.value);

        if (isNaN(value) || value < 0) {
            input.setCustomValidity('O número de gols deve ser maior ou igual a 0');
        } else if (value > 50) {
            input.setCustomValidity('O número de gols parece muito alto. Verifique se está correto.');
        } else {
            input.setCustomValidity('');
        }
    }

    golsMandanteInput.addEventListener('input', function () {
        validateGoals(this);
    });

    golsVisitanteInput.addEventListener('input', function () {
        validateGoals(this);
    });

    // Auto-format team names
    function formatTeamName(input) {
        input.addEventListener('input', function () {
            // Capitalize first letter of each word
            this.value = this.value.replace(/\b\w/g, l => l.toUpperCase());
        });
    }

    formatTeamName(equipeMandanteInput);
    formatTeamName(equipeVisitanteInput);

    // Set default date to today
    const today = new Date().toISOString().split('T')[0];
    dataConfrontoInput.setAttribute('max', new Date(Date.now() + 365 * 24 * 60 * 60 * 1000).toISOString().split('T')[0]);

    // Add tooltips
    const tooltips = [
        { element: 'equipeMandante', text: 'Equipe que joga em casa' },
        { element: 'equipeVisitante', text: 'Equipe que joga fora de casa' },
        { element: 'tipoConfronto', text: 'Selecione o tipo de competição' },
        { element: 'dataConfronto', text: 'Data em que o confronto aconteceu ou acontecerá' },
        { element: 'logradouroConfronto', text: 'Endereço completo do local do jogo' },
        { element: 'golsMandante', text: 'Quantidade de gols marcados pela equipe mandante' },
        { element: 'golsVisitante', text: 'Quantidade de gols marcados pela equipe visitante' }
    ];

    tooltips.forEach(tooltip => {
        const element = document.getElementById(tooltip.element);
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
            customClass: 'confronto-tooltip'
        });
    });

    // Form progress indicator
    function updateFormProgress() {
        const totalFields = inputs.length;
        const validFields = form.querySelectorAll('.form-control.is-valid, .form-select.is-valid').length;
        const progress = (validFields / totalFields) * 100;

        // Update progress bar if exists
        const progressBar = document.querySelector('.form-progress');
        if (progressBar) {
            progressBar.style.width = progress + '%';
            progressBar.setAttribute('aria-valuenow', progress);
        }
    }

    // Listen for field changes to update progress
    inputs.forEach(input => {
        input.addEventListener('input', updateFormProgress);
        input.addEventListener('change', updateFormProgress);
    });

    // Auto-save to localStorage
    function saveFormData() {
        const formData = new FormData(form);
        const data = {};
        for (let [key, value] of formData.entries()) {
            data[key] = value;
        }
        localStorage.setItem('futplay_cadastro_confronto', JSON.stringify(data));
    }

    function loadFormData() {
        const savedData = localStorage.getItem('futplay_cadastro_confronto');
        if (savedData) {
            const data = JSON.parse(savedData);
            Object.keys(data).forEach(key => {
                const field = form.querySelector(`[name="${key}"]`);
                if (field && data[key]) {
                    field.value = data[key];
                }
            });
            updateResultDisplay();
        }
    }

    // Auto-save on input change
    inputs.forEach(input => {
        input.addEventListener('input', debounce(saveFormData, 1000));
    });

    // Load saved data on page load
    loadFormData();

    // Clear saved data on successful submission
    successModal._element.addEventListener('shown.bs.modal', function () {
        localStorage.removeItem('futplay_cadastro_confronto');
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function (event) {
        // Ctrl + Enter to submit form
        if (event.ctrlKey && event.key === 'Enter') {
            event.preventDefault();
            form.dispatchEvent(new Event('submit'));
        }

        // Escape to clear form
        if (event.key === 'Escape' && event.target.tagName !== 'INPUT' && event.target.tagName !== 'SELECT') {
            if (confirm('Deseja limpar o formulário?')) {
                form.reset();
                form.classList.remove('was-validated');
                inputs.forEach(input => {
                    input.classList.remove('is-valid', 'is-invalid');
                });
                updateResultDisplay();
            }
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

    // Initialize result display
    updateResultDisplay();

    console.log('Cadastro de Confronto carregado com sucesso!');
});

