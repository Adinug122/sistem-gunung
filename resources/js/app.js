

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.store('cart', {
    count: parseInt(document.querySelector('[data-cart-count]')?.dataset?.cartCount ?? '0', 10) || 0,
    toastMessage: '',
    showToast: false,

    async add(productId) {
        const res = await fetch(`/keranjang/tambah/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            },
        });
        const data = await res.json();
        if (data.success) {
            this.count = data.count;
            this.toast(data.message);
        }
    },

    async remove(productId) {
        const res = await fetch(`/keranjang/hapus/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            },
        });
        const data = await res.json();
        if (data.success) {
            this.count = data.count;
            this.toast(data.message);
        }
    },

    async clear() {
        const res = await fetch('/keranjang/hapus-semua', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            },
        });
        const data = await res.json();
        if (data.success) {
            this.count = 0;
            this.toast(data.message);
        }
    },

    toast(msg) {
        this.toastMessage = msg;
        this.showToast = true;
        setTimeout(() => { this.showToast = false; }, 3000);
    },
});

Alpine.start();


setTimeout(()=>{
const loading = document.getElementById('loading');
if (loading) {
    loading.style.display = 'none';
}
},1500);



(function () {
    var galleryItems = Array.from(document.querySelectorAll('.gallery-item'));
    var lightbox = document.getElementById('lightbox');

    if (galleryItems.length === 0 || !lightbox) {
        return;
    }

    var lightboxImg = document.getElementById('lightbox-img');
    var lightboxTitle = document.getElementById('lightbox-title');
    var lightboxDescription = document.getElementById('lightbox-description');
    var lightboxClose = document.getElementById('lightbox-close');
    var lightboxPrev = document.getElementById('lightbox-prev');
    var lightboxNext = document.getElementById('lightbox-next');
    var lightboxCurrent = document.getElementById('lightbox-current');
    var lightboxTotal = document.getElementById('lightbox-total');
    var currentIndex = 0;
    var triggerElement = null;
    var previousBodyOverflow = '';

    function updateLightbox() {
        var item = galleryItems[currentIndex];
        var image = item.querySelector('img');

        lightboxImg.src = item.dataset.src;
        lightboxImg.alt = image ? image.alt : item.dataset.title;
        lightboxTitle.textContent = item.dataset.title;
        lightboxDescription.textContent = item.dataset.description;
        lightboxCurrent.textContent = currentIndex + 1;
    }

    function openLightbox(index) {
        currentIndex = index;
        triggerElement = galleryItems[index];
        updateLightbox();
        lightboxTotal.textContent = galleryItems.length;
        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        lightbox.setAttribute('aria-hidden', 'false');
        previousBodyOverflow = document.body.style.overflow;
        document.body.style.overflow = 'hidden';
        lightboxClose.focus();
    }

    function closeLightbox() {
        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
        lightbox.setAttribute('aria-hidden', 'true');
        lightboxImg.removeAttribute('src');
        document.body.style.overflow = previousBodyOverflow;

        if (triggerElement) {
            triggerElement.focus();
        }
    }

    function showPrev() {
        currentIndex = (currentIndex - 1 + galleryItems.length) % galleryItems.length;
        updateLightbox();
    }

    function showNext() {
        currentIndex = (currentIndex + 1) % galleryItems.length;
        updateLightbox();
    }

    galleryItems.forEach(function (item, index) {
        item.addEventListener('click', function () {
            openLightbox(index);
        });
    });

    lightboxClose.addEventListener('click', closeLightbox);
    lightboxPrev.addEventListener('click', showPrev);
    lightboxNext.addEventListener('click', showNext);

    lightbox.addEventListener('click', function (event) {
        if (event.target === lightbox) {
            closeLightbox();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (lightbox.classList.contains('hidden')) {
            return;
        }

        if (event.key === 'Escape') {
            closeLightbox();
        } else if (event.key === 'ArrowLeft') {
            showPrev();
        } else if (event.key === 'ArrowRight') {
            showNext();
        }
    });
})();
