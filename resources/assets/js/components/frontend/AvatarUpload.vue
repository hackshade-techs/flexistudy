
<script>
    import imageUpload from 'vue-core-image-upload';

    export default {
        data: function () {
            return {
                saveStatus: null,
                src: '',
                uploadURL: '/api/avatar/'+this.user.username,
            }
        },    
        
        components: {
            imageUpload
        },
        
        props: [
            'user',
            'gravatar'
        ],
        
        methods: {
            
            fileUploaded(response) {
                this.saveStatus = 'Upload complete';
                setTimeout(() => {
                   this.saveStatus = null 
                }, 3000);
                    
                this.src=response;  
            },


        },
        
        mounted() {
            this.src=this.gravatar;
        }
        
    }
</script>