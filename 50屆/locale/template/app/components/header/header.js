export default {
    data() {
        return {

        }
    },
    mounted() {
        console.log('header work!');
    },
    methods: {
        logout() {
            localStorage.removeItem('user');
            this.$root.user = {};
            this.route.to('login');
        }
    }
}