export default {
    data() {
        return {
            test: null
        }
    },
    mounted() {
        console.log('home work!');
        this.request.get(`./api/test`).then(res => {
            console.log(res);
            this.test = res.data;
        });
    },
    methods: {

    }
}