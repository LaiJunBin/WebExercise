export default {
    data() {
        return {

        }
    },
    mounted() {
        console.log('error-messages work!');
    },
    computed: {
        errors: function () {
            return this.$parent.errors || [];
        }
    },
    methods: {

    }
} 
