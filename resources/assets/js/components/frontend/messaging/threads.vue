

<script>
    
    export default {
        
        data() {
            return {
                threads: [],
                keys: ["subject", "creator"],
                selected_thread: null,
                searching: false
            }
        },
        
        
        props: [
           'is_admin',
           'first_thread'
        ],
        
        methods: {
            fetchThreads(){
                return axios.get('/threads/api/fetch').then(function (response) {
                    this.threads = response.data.data;
                }.bind(this))
                .catch(function(error){
                    console.log('Could not fetch threads');
                });
            },
            
            setThread(id){
                this.selected_thread = id;
            },
            
            markAsRead(id) {
                return axios.put('/threads/api/thread/'+id).then( function (response) {
                    this.fetchThreads();
                }.bind(this)).catch(function(error){
                  console.log(error);  
                });         
            },
            
            handler(arg){
                this.markAsRead(arg);
                this.setThread(arg);
            }
        },
        
        created(){
            this.$on('fuseResultsUpdated', results => {
                this.threads = results;
                if($(".thread-search .form-control").val() == ''){
                    this.fetchThreads();
                };
               
            });
            
        },
        mounted() {
            //this.fetchThreads();
            this.selected_thread = this.first_thread;
            axios.get('/threads/api/fetch').then(function (response) {
                this.threads = response.data.data;
                this.searching=true;
            }.bind(this));
        },
        
    }
    
</script>

