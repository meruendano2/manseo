<script src="https://unpkg.com/vue@3"></script>
<div id="app">
    <carta-flipbook></carta-flipbook>
</div>
<script>
const CartaFlipbook = {
    template: `
    <div class="section-container">
        <h2 class="section-title playfair">NUESTRA CARTA</h2>
        <p class="section-description">Descubre nuestra selección de platos y bebidas. Usa las flechas o desliza.</p>
        <div class="carta-container">
            <div class="carta-pdf">
                <button class="nav-arrow prev-arrow" @click="prevPage" v-show="currentPage > 1">❮</button>
                <div ref="flipbook" class="flipbook" @touchstart="touchStart" @touchend="touchEnd">
                    <div class="pages" :style="{ transform: 'translateX(-' + ((currentPage - 1) * 25) + '%)' }">
                        <div v-for="(img, index) in pages" :key="index" class="page">
                            <img :src="img" :alt="'Página ' + (index + 1)">
                        </div>
                    </div>
                </div>
                <button class="nav-arrow next-arrow" @click="nextPage" v-show="currentPage < pages.length">❯</button>
            </div>
            <div class="carta-buttons">
                <a href="img/carta_masneo.pdf" class="button button-primary" target="_blank">DESCARGAR CARTA</a>
            </div>
        </div>
    </div>
    `,
    data() {
        return {
            currentPage: 1,
            pages: [
                'img/carta_masneo_pages-to-jpg-0001.jpg',
                'img/carta_masneo_pages-to-jpg-0002.jpg',
                'img/carta_masneo_pages-to-jpg-0003.jpg',
                'img/carta_masneo_pages-to-jpg-0004.jpg'
            ],
            startX: 0,
            endX: 0
        };
    },
    mounted() {
        this.adjustSize();
        window.addEventListener('resize', this.adjustSize);
    },
    beforeUnmount() {
        window.removeEventListener('resize', this.adjustSize);
    },
    methods: {
        prevPage() {
            if (this.currentPage > 1) this.currentPage--;
        },
        nextPage() {
            if (this.currentPage < this.pages.length) this.currentPage++;
        },
        touchStart(e) {
            this.startX = e.touches[0].clientX;
        },
        touchEnd(e) {
            this.endX = e.changedTouches[0].clientX;
            const delta = this.endX - this.startX;
            if (Math.abs(delta) > 50) {
                if (delta > 0) this.prevPage();
                else this.nextPage();
            }
        },
        adjustSize() {
            const img = this.$refs.flipbook.querySelector('img');
            if (!img) return;
            const aspectRatio = img.naturalWidth / img.naturalHeight;
            this.$refs.flipbook.style.height = (this.$refs.flipbook.clientWidth / aspectRatio) + 'px';
        }
    }
};

Vue.createApp({
    components: {
        'carta-flipbook': CartaFlipbook
    }
}).mount('#app');
</script>
