export default {
    data() {
        return {
            username: '',
            password: ''
        }
    },
    mounted() {
        console.log('login work!');
    },
    methods: {
        login(e) {
            post('./api/login', { username: this.username, password: this.password }).then(user => {
                this.$root.user = user;
            });
        }
    }
} 
