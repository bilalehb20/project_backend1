import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Scroll Reveal Plugin with staggered animations
Alpine.data('scrollReveal', () => ({
    init() {
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            this.$el.querySelectorAll('.scroll-reveal').forEach(el => {
                el.classList.add('revealed');
            });
            return;
        }

        // Fallback: Reveal items after 1.5s if IntersectionObserver hasn't triggered
        const fallbackTimeout = setTimeout(() => {
            this.$el.querySelectorAll('.scroll-reveal:not(.revealed)').forEach((el, index) => {
                setTimeout(() => {
                    el.classList.add('revealed');
                }, index * 100);
            });
        }, 1500);

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    clearTimeout(fallbackTimeout);
                    // Add staggered delay based on index
                    setTimeout(() => {
                        entry.target.classList.add('revealed');
                    }, (index % 3) * 50); // Stagger by 50ms per item in row
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.05, // Lower threshold for earlier triggering
            rootMargin: '100px 0px 0px 0px' // Trigger 100px before item enters viewport
        });

        this.$nextTick(() => {
            const items = this.$el.querySelectorAll('.scroll-reveal');
            items.forEach((el, index) => {
                // Check if item is already in viewport
                const rect = el.getBoundingClientRect();
                const isInViewport = rect.top < window.innerHeight + 100 && rect.bottom > -100;
                
                if (isInViewport) {
                    // Item is already visible, reveal immediately with stagger
                    setTimeout(() => {
                        el.classList.add('revealed');
                    }, index * 50);
                } else {
                    // Item not yet visible, observe it
                    observer.observe(el);
                }
            });
        });
    }
}));

// Image lazy loading
document.addEventListener('DOMContentLoaded', () => {
    const images = document.querySelectorAll('img[loading="lazy"]');
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.addEventListener('load', () => {
                    img.classList.add('loaded');
                });
                if (img.complete) {
                    img.classList.add('loaded');
                }
                imageObserver.unobserve(img);
            }
        });
    });

    images.forEach(img => imageObserver.observe(img));
});

// ============================================================================
// LIKE FUNCTIONALITY - EVENT DELEGATION (1 LISTENER, NO DUPLICATES)
// ============================================================================

// STAP 1: Event delegation - 1 listener op document (VOORKOMT DUPLICATEN)
document.addEventListener('click', function(e) {
    const button = e.target.closest('.like-button');
    if (!button) return;
    
    e.preventDefault();
    e.stopPropagation();
    
    handleLikeClick(button);
});

// STAP 2 & 3: Hard blokkeren dubbele clicks + Server truth
function handleLikeClick(button) {
    // STAP 2: Hard blokkeren dubbele clicks
    if (button.dataset.loading === 'true') {
        console.log('⚠️ Like button already processing, ignoring click');
        return;
    }
    
    // Set loading state
    button.dataset.loading = 'true';
    button.disabled = true;
    
    // Get data attributes
    const likeableId = button.getAttribute('data-id');
    const likeableType = button.getAttribute('data-type') || 'Product';
    
    if (!likeableId) {
        console.error('❌ No likeable ID found');
        button.dataset.loading = 'false';
        button.disabled = false;
        return;
    }
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    if (!csrfToken) {
        console.error('❌ CSRF token not found');
        button.dataset.loading = 'false';
        button.disabled = false;
        return;
    }
    
    console.log('📡 Like toggle request:', { likeableId, likeableType });
    
    fetch('/likes/toggle', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            likeable_id: parseInt(likeableId),
            likeable_type: likeableType
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('✅ Like response received:', data);
        console.log('📊 USER LIKES COUNT FROM SERVER:', data.user_likes_count);
        
        // STAP 3: Server truth - gebruik ALTIJD data.user_likes_count
        const userLikesCount = data.user_likes_count !== undefined ? data.user_likes_count : 0;
        
        // Update button visual state
        updateButtonState(button, data.liked);
        
        // Update likes count display
        const countElement = document.getElementById('likes-count-' + likeableId);
        if (countElement) {
            countElement.textContent = data.likes_count + ' likes';
        }
        
        // Update navbar favorites links
        updateFavoritesLinks(userLikesCount);
        
        // STAP 4: Direct redirect if last like removed on favorites page
        if (userLikesCount === 0 && window.location.pathname === '/favorites') {
            console.log('🏠 Redirecting to home - last favorite removed');
            // Use replace() to prevent back-navigation bugs
            window.location.replace('/');
            return; // Stop execution
        }
        
        // STAP 5: DOM cleanup - verwijder item bij unlike op favorites page
        if (!data.liked && window.location.pathname === '/favorites') {
            const favoriteItem = button.closest('.favorite-item');
            if (favoriteItem) {
                favoriteItem.style.transition = 'opacity 0.3s, transform 0.3s';
                favoriteItem.style.opacity = '0';
                favoriteItem.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    favoriteItem.remove();
                }, 300);
            }
        }
        
        // Reset loading state
        button.dataset.loading = 'false';
        button.disabled = false;
    })
    .catch(error => {
        console.error('❌ Error toggling like:', error);
        // Reset loading state on error
        button.dataset.loading = 'false';
        button.disabled = false;
    });
}

// Helper: Update button visual state
function updateButtonState(button, isLiked) {
    const svg = button.querySelector('svg');
    const span = button.querySelector('span');
    
    if (isLiked) {
        button.classList.add('liked');
        if (svg) {
            svg.setAttribute('fill', 'currentColor');
            svg.classList.remove('text-gray-400', 'text-gray-500', 'text-gray-600', 'dark:text-gray-300', 'dark:text-gray-500');
            svg.classList.add('text-red-500');
        }
        if (span) span.textContent = 'Geliked';
        button.classList.remove('bg-gray-200', 'dark:bg-gray-700');
        button.classList.add('bg-red-500', 'dark:bg-red-600');
    } else {
        button.classList.remove('liked');
        if (svg) {
            svg.setAttribute('fill', 'none');
            svg.classList.remove('text-red-500');
            svg.classList.add('text-gray-400', 'dark:text-gray-500');
        }
        if (span) span.textContent = 'Like';
        button.classList.remove('bg-red-500', 'dark:bg-red-600');
        button.classList.add('bg-gray-200', 'dark:bg-gray-700');
    }
}

// Helper: Update favorites links in navbar
function updateFavoritesLinks(userLikesCount) {
    const favoritesLinkNavbar = document.getElementById('favorites-link-navbar');
    const favoritesLinkDropdown = document.getElementById('favorites-link-dropdown');
    
    if (favoritesLinkNavbar) {
        if (userLikesCount > 0) {
            favoritesLinkNavbar.classList.remove('hidden');
            console.log('✅ Favorieten link shown in navbar');
        } else {
            favoritesLinkNavbar.classList.add('hidden');
            console.log('❌ Favorieten link hidden from navbar');
        }
    }
    
    if (favoritesLinkDropdown) {
        if (userLikesCount > 0) {
            favoritesLinkDropdown.classList.remove('hidden');
            console.log('✅ Favorieten link shown in dropdown');
        } else {
            favoritesLinkDropdown.classList.add('hidden');
            console.log('❌ Favorieten link hidden from dropdown');
        }
    }
}

Alpine.start();
