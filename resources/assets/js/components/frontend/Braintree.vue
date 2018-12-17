
<script>

    import braintree from 'braintree-web';
    
    export default {
        data(){
            
            return {
                csrfToken: window.Laravel.csrfToken,
                loaded: false,
            }
            
        },
        
        props: [
            ''
        ],
        
        methods: {
             
        },
        
        mounted() {
            axios.get('/api/braintree/token').then((response) => {
                this.loaded = true;
                
                braintree.setup(response.data.data.token, 'dropin', {
                    container: 'dropin'
                });
            })
            
        }
    }
</script>

<style>
    #dropin {
        margin-bottom: 20px;
    }
</style>
