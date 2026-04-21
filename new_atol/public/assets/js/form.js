/**
 * SIFOPI - Form Utilities
 * Form validation, handling, and manipulation
 */

const FormUtils = (() => {
    'use strict';

    // Validation Rules
    const validators = {
        required: (value) => {
            return value && value.trim().length > 0;
        },
        email: (value) => {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(value);
        },
        phone: (value) => {
            const regex = /^[\d\s\-\+\(\)]{10,20}$/;
            return regex.test(value);
        },
        number: (value) => {
            return !isNaN(value) && value.trim().length > 0;
        },
        minLength: (value, min) => {
            return value.length >= min;
        },
        maxLength: (value, max) => {
            return value.length <= max;
        },
        match: (value, compareValue) => {
            return value === compareValue;
        },
    };

    // Validate single field
    const validateField = (input) => {
        const rules = input.dataset.validate?.split(',') || [];
        const value = input.value;
        let isValid = true;
        let errorMessage = '';

        for (let rule of rules) {
            rule = rule.trim();

            if (rule === 'required' && !validators.required(value)) {
                isValid = false;
                errorMessage = 'Field ini wajib diisi';
                break;
            }

            if (rule === 'email' && value && !validators.email(value)) {
                isValid = false;
                errorMessage = 'Format email tidak valid';
                break;
            }

            if (rule === 'phone' && value && !validators.phone(value)) {
                isValid = false;
                errorMessage = 'Format nomor telepon tidak valid';
                break;
            }

            if (rule === 'number' && value && !validators.number(value)) {
                isValid = false;
                errorMessage = 'Harus berupa angka';
                break;
            }

            // Min/Max length rules
            if (rule.startsWith('minLength:')) {
                const min = parseInt(rule.split(':')[1]);
                if (value && !validators.minLength(value, min)) {
                    isValid = false;
                    errorMessage = `Minimal ${min} karakter`;
                    break;
                }
            }

            if (rule.startsWith('maxLength:')) {
                const max = parseInt(rule.split(':')[1]);
                if (!validators.maxLength(value, max)) {
                    isValid = false;
                    errorMessage = `Maksimal ${max} karakter`;
                    break;
                }
            }
        }

        // Show/hide error message
        showFieldError(input, errorMessage, !isValid);

        return isValid;
    };

    // Show field error
    const showFieldError = (input, message, showError = true) => {
        const container = input.closest('.form-group');
        if (!container) return;

        // Remove existing error message
        const existingError = container.querySelector('.form-error');
        if (existingError) {
            existingError.remove();
        }

        // Update input styling
        input.classList.toggle('is-invalid', showError);
        input.classList.toggle('is-valid', !showError && input.value);

        // Add error message
        if (showError && message) {
            const errorEl = document.createElement('div');
            errorEl.className = 'form-error';
            errorEl.textContent = message;
            container.appendChild(errorEl);
        }
    };

    // Validate entire form
    const validateForm = (form) => {
        const inputs = form.querySelectorAll('[data-validate]');
        let isFormValid = true;

        inputs.forEach((input) => {
            if (!validateField(input)) {
                isFormValid = false;
            }
        });

        return isFormValid;
    };

    // Setup form validation on input
    const setupFormValidation = (form) => {
        const inputs = form.querySelectorAll('[data-validate]');

        inputs.forEach((input) => {
            // Validate on blur
            input.addEventListener('blur', () => {
                validateField(input);
            });

            // Clear error on input
            input.addEventListener('input', () => {
                if (input.classList.contains('is-invalid')) {
                    showFieldError(input, '', false);
                }
            });
        });

        // Validate on form submit
        form.addEventListener('submit', (e) => {
            if (!validateForm(form)) {
                e.preventDefault();
                SIFOPI.notify('Silakan perbaiki error yang ada', 'error');
            }
        });
    };

    // Get form data as object
    const getFormData = (form) => {
        const formData = new FormData(form);
        const data = {};

        for (let [key, value] of formData.entries()) {
            if (data[key]) {
                // Handle multiple values with same name
                if (!Array.isArray(data[key])) {
                    data[key] = [data[key]];
                }
                data[key].push(value);
            } else {
                data[key] = value;
            }
        }

        return data;
    };

    // Set form data from object
    const setFormData = (form, data) => {
        Object.keys(data).forEach((key) => {
            const input = form.querySelector(`[name="${key}"]`);
            if (input) {
                if (input.type === 'checkbox' || input.type === 'radio') {
                    input.checked = data[key];
                } else {
                    input.value = data[key];
                }
            }
        });
    };

    // Clear form
    const clearForm = (form) => {
        form.reset();
        form.querySelectorAll('.form-error').forEach((el) => el.remove());
        form.querySelectorAll('input').forEach((el) => {
            el.classList.remove('is-invalid', 'is-valid');
        });
    };

    // Disable form inputs
    const disableForm = (form, disabled = true) => {
        form.querySelectorAll('input, select, textarea, button').forEach((el) => {
            el.disabled = disabled;
        });
    };

    // Submit form via AJAX
    const submitFormAjax = async (form, options = {}) => {
        const defaultOptions = {
            showLoader: true,
            onSuccess: null,
            onError: null,
            resetForm: true,
        };

        const config = { ...defaultOptions, ...options };

        // Validate form first
        if (!validateForm(form)) {
            return;
        }

        try {
            if (config.showLoader) {
                disableForm(form, true);
            }

            const method = form.method.toUpperCase() || 'POST';
            const action = form.action || window.location.href;
            const data = new FormData(form);

            const response = await fetch(action, {
                method,
                body: data,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            const result = await response.json();

            if (response.ok && result.success) {
                SIFOPI.notify(result.message || 'Berhasil', 'success');

                if (config.resetForm) {
                    clearForm(form);
                }

                if (config.onSuccess) {
                    config.onSuccess(result);
                }

                return result;
            } else {
                throw new Error(result.message || 'Request gagal');
            }
        } catch (error) {
            console.error('Form submission error:', error);
            SIFOPI.notify(error.message || 'Terjadi kesalahan', 'error');

            if (config.onError) {
                config.onError(error);
            }

            throw error;
        } finally {
            if (config.showLoader) {
                disableForm(form, false);
            }
        }
    };

    // File input preview
    const setupFilePreview = (inputSelector, previewSelector) => {
        const input = SIFOPI.$(inputSelector);
        const preview = SIFOPI.$(previewSelector);

        if (!input || !preview) return;

        input.addEventListener('change', (e) => {
            const file = e.target.files[0];

            if (!file) {
                preview.style.display = 'none';
                return;
            }

            const reader = new FileReader();

            reader.onload = (event) => {
                if (file.type.startsWith('image/')) {
                    preview.src = event.target.result;
                    preview.style.display = 'block';
                } else {
                    preview.style.display = 'none';
                    SIFOPI.notify('File harus berupa gambar', 'warning');
                }
            };

            reader.readAsDataURL(file);
        });
    };

    // Initialize all forms on page
    const initAll = () => {
        document.querySelectorAll('form').forEach((form) => {
            setupFormValidation(form);
        });
    };

    // Export public API
    return {
        validateField,
        validateForm,
        setupFormValidation,
        getFormData,
        setFormData,
        clearForm,
        disableForm,
        submitFormAjax,
        setupFilePreview,
        initAll,
    };
})();

// Initialize on DOM ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => FormUtils.initAll());
} else {
    FormUtils.initAll();
}
