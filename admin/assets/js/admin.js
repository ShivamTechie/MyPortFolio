// Admin Panel JavaScript with AJAX
(function($) {
    'use strict';

    // Notification System
    function showNotification(message, type = 'success') {
        const notificationClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
        
        const notification = $(`
            <div class="alert ${notificationClass} alert-dismissible fade show notification-popup" role="alert">
                <i class="fas ${icon} me-2"></i>
                <span>${message}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `);
        
        $('body').append(notification);
        
        setTimeout(() => {
            notification.fadeOut(300, function() {
                $(this).remove();
            });
        }, 5000);
    }

    // Auto-hide existing alerts
    $('.alert').each(function() {
        const alert = $(this);
        setTimeout(() => {
            alert.fadeOut(300, function() {
                $(this).remove();
            });
        }, 5000);
    });

    // AJAX Form Handler
    function handleAjaxForm(form) {
        const formData = new FormData(form[0]);
        const submitBtn = form.find('button[type="submit"]');
        const originalBtnText = submitBtn.html();
        const actionUrl = form.attr('action');
        
        // Disable button and show loading
        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');
        
        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                if (response.success) {
                    showNotification(response.message || 'Operation completed successfully!', 'success');
                    
                    // Reload after success for list pages
                    if (response.reload) {
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else if (response.redirect) {
                        setTimeout(() => {
                            window.location.href = response.redirect;
                        }, 1500);
                    }
                } else {
                    showNotification(response.message || 'Operation failed. Please try again.', 'error');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                showNotification('An error occurred. Please try again.', 'error');
            },
            complete: function() {
                submitBtn.prop('disabled', false).html(originalBtnText);
            }
        });
    }

    // Handle all admin forms with AJAX
    $(document).on('submit', 'form[data-ajax="true"], form.ajax-form', function(e) {
        e.preventDefault();
        handleAjaxForm($(this));
    });

    // Auto-convert all admin forms to AJAX
    $('form').not('.no-ajax').each(function() {
        $(this).attr('data-ajax', 'true');
        console.log('Form converted to AJAX:', $(this).attr('action'));
    });
    
    console.log('Total forms found:', $('form').length);
    console.log('Forms with AJAX:', $('form[data-ajax="true"]').length);

    // Delete with AJAX
    $(document).on('click', '.btn-delete, .delete-item', function(e) {
        e.preventDefault();
        
        if (!confirm('Are you sure you want to delete this item?')) {
            return;
        }
        
        const deleteUrl = $(this).attr('href') || $(this).data('url');
        const btn = $(this);
        const row = btn.closest('tr');
        
        $.ajax({
            url: deleteUrl,
            type: 'POST',
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                if (response.success) {
                    showNotification(response.message || 'Item deleted successfully!', 'success');
                    row.fadeOut(300, function() {
                        $(this).remove();
                    });
                } else {
                    showNotification(response.message || 'Failed to delete item.', 'error');
                }
            },
            error: function() {
                showNotification('An error occurred while deleting.', 'error');
            }
        });
    });

    // Image preview for file uploads
    $('input[type="file"]').on('change', function() {
        const file = this.files[0];
        const previewContainer = $(this).siblings('.image-preview');
        
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                if (previewContainer.length === 0) {
                    $(this).after('<div class="image-preview mt-2"><img src="' + e.target.result + '" alt="Preview"></div>');
                } else {
                    previewContainer.html('<img src="' + e.target.result + '" alt="Preview">');
                }
            }.bind(this);
            reader.readAsDataURL(file);
        }
    });

    // Form validation
    function validateForm(form) {
        let isValid = true;
        form.find('[required]').each(function() {
            const input = $(this);
            if (!input.val().trim()) {
                isValid = false;
                input.addClass('is-invalid');
            } else {
                input.removeClass('is-invalid');
            }
        });
        return isValid;
    }

    // Real-time validation
    $('[required]').on('blur', function() {
        const input = $(this);
        if (!input.val().trim()) {
            input.addClass('is-invalid');
        } else {
            input.removeClass('is-invalid');
        }
    });

    // Character counter for textareas
    $('textarea[maxlength]').each(function() {
        const textarea = $(this);
        const maxLength = textarea.attr('maxlength');
        const counter = $('<div class="character-counter text-muted small mt-1"></div>');
        textarea.after(counter);
        
        function updateCounter() {
            const remaining = maxLength - textarea.val().length;
            counter.text(remaining + ' characters remaining');
        }
        
        updateCounter();
        textarea.on('input', updateCounter);
    });

    // Sortable tables (if needed for reordering)
    if (typeof $.fn.sortable !== 'undefined') {
        $('.sortable-table tbody').sortable({
            handle: '.drag-handle',
            update: function(event, ui) {
                const order = $(this).sortable('toArray', {attribute: 'data-id'});
                // Send AJAX request to update order
                $.post('?page=update-order', {order: order}, function(response) {
                    if (response.success) {
                        showNotification('Order updated successfully!', 'success');
                    }
                }, 'json');
            }
        });
    }

    // Confirm before leaving page with unsaved changes
    let formChanged = false;
    $('form input, form textarea, form select').on('change', function() {
        formChanged = true;
    });

    $('form').on('submit', function() {
        formChanged = false;
    });

    $(window).on('beforeunload', function() {
        if (formChanged) {
            return 'You have unsaved changes. Are you sure you want to leave?';
        }
    });

    // Rich text editor initialization (if using CKEditor or TinyMCE)
    if (typeof ClassicEditor !== 'undefined') {
        $('.rich-editor').each(function() {
            ClassicEditor.create(this).catch(error => console.error(error));
        });
    }

    // Copy to clipboard
    $(document).on('click', '.copy-btn', function() {
        const text = $(this).data('text');
        navigator.clipboard.writeText(text).then(() => {
            showNotification('Copied to clipboard!', 'success');
        });
    });

    // Toggle password visibility
    $(document).on('click', '.toggle-password', function() {
        const input = $(this).siblings('input');
        const icon = $(this).find('i');
        
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            input.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    // Search/Filter functionality
    $('.search-input').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $('.searchable-table tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Bulk actions
    $('.select-all').on('change', function() {
        $('.select-item').prop('checked', $(this).prop('checked'));
    });

    $('.bulk-action-btn').on('click', function() {
        const action = $('#bulk-action').val();
        const selected = $('.select-item:checked').map(function() {
            return $(this).val();
        }).get();
        
        if (selected.length === 0) {
            showNotification('Please select items first.', 'error');
            return;
        }
        
        if (confirm('Are you sure you want to perform this action?')) {
            $.post('?page=bulk-action', {
                action: action,
                ids: selected
            }, function(response) {
                if (response.success) {
                    showNotification(response.message, 'success');
                    setTimeout(() => window.location.reload(), 1500);
                }
            }, 'json');
        }
    });

    // Initialize tooltips
    if (typeof $().tooltip !== 'undefined') {
        $('[data-toggle="tooltip"]').tooltip();
    }

    // Initialize popovers
    if (typeof $().popover !== 'undefined') {
        $('[data-toggle="popover"]').popover();
    }

    console.log('%c✅ Admin Panel AJAX Loaded', 'color: #4caf50; font-weight: bold;');

})(jQuery);

// Add notification styles dynamically
const style = document.createElement('style');
style.textContent = `
    .notification-popup {
        position: fixed;
        top: 20px;
        right: 20px;
        min-width: 300px;
        z-index: 9999;
        animation: slideInRight 0.3s ease;
    }
    
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    .image-preview img {
        max-width: 200px;
        max-height: 200px;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
        margin-top: 10px;
    }
    
    .is-invalid {
        border-color: #dc3545 !important;
    }
`;
document.head.appendChild(style);
