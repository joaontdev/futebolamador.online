// Cadastro de Equipe - JavaScript

document.addEventListener('DOMContentLoaded', function () {

    // Form elements
    const form = document.getElementById('cadastroEquipeForm');
    const submitButton = form.querySelector('button[type="submit"]');
    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
    const dangerModal = new bootstrap.Modal(document.getElementById('dangerModal'));

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
    async function handleFormSubmission() {
        // Show loading state
        showLoadingState();

        // Collect form data
        const formData = new FormData(form);


        let endpoint = url + "/nova-equipe/salvar";

        // 2. Faz a requisição POST para o controlador PHP
        const requisicao = await fetch(endpoint, {
            method: 'POST',
            // Envia o FormData diretamente. O PHP consegue ler isso via $_POST
            body: formData
        });

        const resposta = await requisicao.json();

        console.log(resposta);

        // Simulate API call
        setTimeout(() => {
            // Hide loading state
            hideLoadingState();

            if (resposta.success == true) {
                // Show success modal
                successModal.show();
                // Reset form
                form.reset();
                form.classList.remove('was-validated');
            } else {
                dangerModal.show();
            }


        }, 2000);
    }

    // Show loading state
    function showLoadingState() {
        submitButton.disabled = true;
        submitButton.classList.add('btn-loading');
        submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Cadastrando...';
    }

    // Hide loading state
    function hideLoadingState() {
        submitButton.disabled = false;
        submitButton.classList.remove('btn-loading');
        submitButton.innerHTML = '<i class="bi bi-check-circle me-2"></i>Cadastrar Equipe';
    }

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
    const anoFundacaoInput = document.getElementById('anoFundacao');
    anoFundacaoInput.addEventListener('input', function () {
        const currentYear = new Date().getFullYear();
        const year = parseInt(this.value);

        if (year && (year < 1900 || year > currentYear)) {
            this.setCustomValidity(`O ano deve estar entre 1900 e ${currentYear}`);
        } else {
            this.setCustomValidity('');
        }
    });

    // Nome da equipe validation (no special characters)
    const nomeEquipeInput = document.getElementById('nomeEquipe');
    nomeEquipeInput.addEventListener('input', function () {
        const value = this.value.trim();

        if (value.length < 2) {
            this.setCustomValidity('O nome da equipe deve ter pelo menos 2 caracteres');
        } else if (value.length > 50) {
            this.setCustomValidity('O nome da equipe deve ter no máximo 50 caracteres');
        } else {
            this.setCustomValidity('');
        }
    });

    // Nome do comandante validation
    const nomeComandanteInput = document.getElementById('nomeComandante');
    nomeComandanteInput.addEventListener('input', function () {
        const value = this.value.trim();
        const nameRegex = /^[a-zA-ZÀ-ÿ\s]+$/;

        if (value.length < 2) {
            this.setCustomValidity('O nome deve ter pelo menos 2 caracteres');
        } else if (!nameRegex.test(value)) {
            this.setCustomValidity('O nome deve conter apenas letras e espaços');
        } else {
            this.setCustomValidity('');
        }
    });

    // Auto-format inputs
    nomeEquipeInput.addEventListener('input', function () {
        // Capitalize first letter of each word
        this.value = this.value.replace(/\b\w/g, l => l.toUpperCase());
    });

    nomeComandanteInput.addEventListener('input', function () {
        // Capitalize first letter of each word
        this.value = this.value.replace(/\b\w/g, l => l.toUpperCase());
    });

    // Smooth scroll to form on page load
    setTimeout(() => {
        const formContainer = document.querySelector('.form-container');
        if (formContainer) {
            formContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }, 500);

    // Add tooltips to form labels
    const tooltips = [
        { element: 'nomeEquipe', text: 'Digite o nome completo da sua equipe' },
        { element: 'logradouro', text: 'Endereço onde a equipe está localizada' },
        { element: 'cidade', text: 'Cidade onde a equipe atua' },
        { element: 'estado', text: 'Estado brasileiro' },
        { element: 'anoFundacao', text: 'Ano em que a equipe foi fundada' },
        { element: 'nomeComandante', text: 'Nome do técnico ou responsável atual' }
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
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Form progress indicator (optional)
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
            }
        }
    });

    // Auto-save to localStorage (optional)
    function saveFormData() {
        const formData = new FormData(form);
        const data = {};
        for (let [key, value] of formData.entries()) {
            data[key] = value;
        }
        localStorage.setItem('futplay_cadastro_equipe', JSON.stringify(data));
    }

    function loadFormData() {
        const savedData = localStorage.getItem('futplay_cadastro_equipe');
        if (savedData) {
            const data = JSON.parse(savedData);
            Object.keys(data).forEach(key => {
                const field = form.querySelector(`[name="${key}"]`);
                if (field && data[key]) {
                    field.value = data[key];
                }
            });
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
        localStorage.removeItem('futplay_cadastro_equipe');
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

    console.log('Cadastro de Equipe carregado com sucesso!');
});

