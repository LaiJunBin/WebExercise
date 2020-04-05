export default {
    data() {
        return {
            username: '',
            password: '',

            errors: []
        }
    },
    mounted() {
        console.log('login work!');
    },
    methods: {
        login(e) {
            this.request.post('./api/login', {
                username: this.username,
                password: this.password
            }).then(res => {
                if (res.status) {
                    this.errors = [];
                    this.$root.user = res.data;
                    localStorage.user = JSON.stringify(res.data)
                    this.route.to('home');
                } else {
                    this.$root.user = {};
                    this.errors = ['帳號或密碼錯誤!'];
                }
            });
        }
    }
}