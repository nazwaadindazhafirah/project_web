// ===========================================
// BUTTON ENHANCEMENT JAVASCRIPT
// Nazwaazhf Skincare - Interactive Button Effects
// ===========================================

document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize all button enhancements
    initializeButtonEffects();
    initializeConfirmationDialogs();
    initializeLoadingStates();
    initializeTooltips();
    
    // Button Click Sound Effect (optional)
    function playClickSound() {
        // Create audio context for click sound
        const audioContext = new (window.AudioContext || window.webkitAudioContext)();
        const oscillator = audioContext.createOscillator();
        const gainNode = audioContext.createGain();
        
        oscillator.connect(gainNode);
        gainNode.connect(audioContext.destination);
        
        oscillator.frequency.value = 800;
        oscillator.type = 'sine';
        
        gainNode.gain.setValueAtTime(0.1, audioContext.currentTime);
        gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.1);
        
        oscillator.start(audioContext.currentTime);
        oscillator.stop(audioContext.currentTime + 0.1);
    }
    
    // Add ripple effect to buttons
    function addRippleEffect(button, event) {
        const ripple = document.createElement('span');
        const rect = button.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = event.clientX - rect.left - size / 2;
        const y = event.clientY - rect.top - size / 2;
        
        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.classList.add('ripple');
        
        button.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    }
    
    // Initialize button effects
    function initializeButtonEffects() {
        const buttons = document.querySelectorAll('.btn, button, input[type="submit"], input[type="button"]');
        
        buttons.forEach(button => {
            // Add click effect
            button.addEventListener('click', function(e) {
                // Add ripple effect
                addRippleEffect(this, e);
                
                // Add loading state for submit buttons
                if (this.type === 'submit' && !this.classList.contains('no-loading')) {
                    this.classList.add('btn-loading');
                }
                
                // Play click sound (optional)
                // playClickSound();
            });
            
            // Add hover effect
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    }
    
    // Initialize confirmation dialogs
    function initializeConfirmationDialogs() {
        // Delete buttons
        const deleteButtons = document.querySelectorAll('.btn-danger, [data-action="delete"]');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                showConfirmationDialog(
                    'Konfirmasi Hapus',
                    'Apakah Anda yakin ingin menghapus item ini?',
                    () => {
                        if (this.tagName === 'A') {
                            window.location.href = this.href;
                        } else if (this.form) {
                            this.form.submit();
                        }
                    }
                );
            });
        });
        
        // Logout buttons
        const logoutButtons = document.querySelectorAll('[href*="logout"]');
        logoutButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                showConfirmationDialog(
                    'Konfirmasi Logout',
                    'Apakah Anda yakin ingin keluar?',
                    () => {
                        window.location.href = this.href;
                    }
                );
            });
        });
        
        // Checkout buttons
        const checkoutButtons = document.querySelectorAll('[name="checkout"], .btn-checkout');
        checkoutButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                showConfirmationDialog(
                    'Konfirmasi Checkout',
                    'Apakah Anda yakin ingin melanjutkan pembayaran?',
                    () => {
                        if (this.form) {
                            this.form.submit();
                        }
                    }
                );
            });
        });
    }
    
    // Show confirmation dialog
    function showConfirmationDialog(title, message, onConfirm) {
        // Create modal HTML
        const modalHTML = `
            <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="border-radius: 20px; border: 2px solid #ff69b4;">
                        <div class="modal-header" style="background: linear-gradient(135deg, #ff69b4, #ff1493); color: white; border-radius: 18px 18px 0 0;">
                            <h5 class="modal-title">${title}</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center" style="padding: 30px;">
                            <div style="font-size: 48px; margin-bottom: 20px;">💕</div>
                            <p style="font-size: 16px; margin-bottom: 30px;">${message}</p>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <button type="button" class="btn btn-pink btn-lg" id="confirmBtn">
                                    ✅ Ya, Lanjutkan
                                </button>
                                <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">
                                    ❌ Batal
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        // Remove existing modal if any
        const existingModal = document.getElementById('confirmModal');
        if (existingModal) {
            existingModal.remove();
        }
        
        // Add modal to body
        document.body.insertAdjacentHTML('beforeend', modalHTML);
        
        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
        modal.show();
        
        // Add confirm button event
        document.getElementById('confirmBtn').addEventListener('click', function() {
            modal.hide();
            onConfirm();
        });
        
        // Clean up modal after hiding
        document.getElementById('confirmModal').addEventListener('hidden.bs.modal', function() {
            this.remove();
        });
    }
    
    // Initialize loading states
    function initializeLoadingStates() {
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('[type="submit"]');
                if (submitBtn && !submitBtn.classList.contains('no-loading')) {
                    submitBtn.classList.add('btn-loading');
                    submitBtn.disabled = true;
                    
                    // Re-enable button after 5 seconds (failsafe)
                    setTimeout(() => {
                        submitBtn.classList.remove('btn-loading');
                        submitBtn.disabled = false;
                    }, 5000);
                }
            });
        });
    }
    
    // Initialize tooltips
    function initializeTooltips() {
        // Add tooltips to buttons
        const buttons = document.querySelectorAll('[data-tooltip]');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', function(e) {
                showTooltip(this, this.getAttribute('data-tooltip'));
            });
            
            button.addEventListener('mouseleave', function() {
                hideTooltip();
            });
        });
    }
    
    // Show tooltip
    function showTooltip(element, text) {
        const tooltip = document.createElement('div');
        tooltip.className = 'custom-tooltip';
        tooltip.textContent = text;
        tooltip.style.cssText = `
            position: absolute;
            background: #333;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            z-index: 1000;
            white-space: nowrap;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        `;
        
        document.body.appendChild(tooltip);
        
        const rect = element.getBoundingClientRect();
        tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
        tooltip.style.top = rect.top - tooltip.offsetHeight - 5 + 'px';
        
        tooltip.style.opacity = '0';
        tooltip.style.transition = 'opacity 0.3s';
        setTimeout(() => tooltip.style.opacity = '1', 10);
    }
    
    // Hide tooltip
    function hideTooltip() {
        const tooltip = document.querySelector('.custom-tooltip');
        if (tooltip) {
            tooltip.style.opacity = '0';
            setTimeout(() => tooltip.remove(), 300);
        }
    }
    
    // Add success notification
    function showSuccessNotification(message) {
        const notification = document.createElement('div');
        notification.className = 'success-notification';
        notification.innerHTML = `
            <div style="
                position: fixed;
                top: 20px;
                right: 20px;
                background: linear-gradient(135deg, #00ff7f, #98fb98);
                color: #006400;
                padding: 15px 25px;
                border-radius: 15px;
                box-shadow: 0 4px 15px rgba(0, 255, 127, 0.3);
                z-index: 1000;
                font-weight: bold;
                animation: slideIn 0.3s ease-out;
            ">
                ✅ ${message}
            </div>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
    
    // Add error notification
    function showErrorNotification(message) {
        const notification = document.createElement('div');
        notification.className = 'error-notification';
        notification.innerHTML = `
            <div style="
                position: fixed;
                top: 20px;
                right: 20px;
                background: linear-gradient(135deg, #ff6b6b, #ff4757);
                color: white;
                padding: 15px 25px;
                border-radius: 15px;
                box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
                z-index: 1000;
                font-weight: bold;
                animation: slideIn 0.3s ease-out;
            ">
                ❌ ${message}
            </div>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
    
    // Add CSS for animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            pointer-events: none;
            animation: ripple-animation 0.6s linear;
        }
        
        @keyframes ripple-animation {
            to {
                transform: scale(2);
                opacity: 0;
            }
        }
        
        .btn-loading {
            pointer-events: none;
            position: relative;
        }
        
        .btn-loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin-top: -10px;
            margin-left: -10px;
            border: 2px solid #ffffff;
            border-top: 2px solid transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    `;
    document.head.appendChild(style);
    
    // Expose functions globally
    window.showSuccessNotification = showSuccessNotification;
    window.showErrorNotification = showErrorNotification;
    window.showConfirmationDialog = showConfirmationDialog;
});

// Add specific button animations based on context
document.addEventListener('DOMContentLoaded', function() {
    // Add cart animation
    const cartButtons = document.querySelectorAll('[name="tambah"], .btn-cart');
    cartButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Add cart animation
            this.innerHTML = '🛒 Ditambahkan!';
            this.style.background = 'linear-gradient(135deg, #00ff7f, #98fb98)';
            this.style.color = '#006400';
            
            setTimeout(() => {
                this.innerHTML = '🛒 Tambah ke Keranjang';
                this.style.background = '';
                this.style.color = '';
            }, 2000);
        });
    });
    
    // Add special effects for important buttons
    const importantButtons = document.querySelectorAll('.btn-danger, .btn-checkout, [name="checkout"]');
    importantButtons.forEach(button => {
        button.classList.add('btn-glow');
    });
    
    // Add bounce effect to brand buttons
    const brandButtons = document.querySelectorAll('.brand-buttons a');
    brandButtons.forEach(button => {
        button.classList.add('btn-bounce');
    });
});
