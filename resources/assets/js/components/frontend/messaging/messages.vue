
<script>
    
    export default {
        
        data() {
            return {
                messages: [],
                body: null,
                showMessages: false
            }
        },
        
        props: [
           'thread',
        ],
        
       
        methods: {
            fetchMessages(thread){
                return axios.get('/messages/api/'+thread+'/fetch').then(function (response) {
                    this.messages = response.data.data;
                    this.showMessages = true;
                }.bind(this))
                .catch(function(error){
                    console.log('Could not fetch messages');
                });
            },
            
            sendMessage(id) {
                return axios.put('/messages/api/'+this.thread, {
                    thread_id: this.thread,
                    body: this.body
                }).then(function (response){
                    this.body = null,
                    this.fetchMessages(this.thread)
                }.bind(this)).catch(function(error){
                   console.log(error); 
                });
            }
            
        },
        
        mounted() {
            this.fetchMessages(this.thread); 
            
        }
        
    }
    
</script>


<style>
    .fade-transition {
      transition: opacity 0.2s ease;
    }
    
    .fade-enter, .fade-leave {
      opacity: 0;
    }
</style>
