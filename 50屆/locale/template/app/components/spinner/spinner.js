export default {
    data() {
        return {
            show: true,
        }
    },
    mounted() {
        console.log('spinner work!');
    },
    created() {
        this.$root.spinner = this;
    },
    render(h) {
        if (this.show) {
            return h('div', {
                class: 'spinner'
            }, [
                h('div'),
                h('div'),
                h('div'),
                h('style', {}, `
                    body{
                        overflow:hidden;
                    }
                `)
            ])
        }
    },
    methods: {
        loading() {
            this.show = true;

            return new Promise(resolve => {
                setTimeout(() => {
                    resolve(callback => {
                        this.$nextTick(function () {
                            callback();
                        });
                    });
                }, 100);
            });
        },

        loaded() {
            this.show = false;
        }
    }
}