<template>

    <a href="#" @click.prevent="handle" :class="{'text-danger' : userHasFollowed==true, 'text-success' : userHasFollowed==false}">
        <i class="fa fa-mail-forward"></i> {{userHasFollowed==true ? 'Unfollow this question' : 'Follow this question'}}
    </a>

</template>

<script>
    
    export default {
        data: function () {
            return {
                userHasFollowed: false
            }
        },    

        props: [
            'question_id'    
        ],
        methods: {
            follow(){
                axios.post('/questions/' + this.question_id +'/follow-question');
                this.userHasFollowed = true;
            },
            
            unfollow () {
                axios.delete('/questions/' + this.question_id + '/unfollow-question');
                this.userHasFollowed = false;
            },
            
            handle () {
                if (this.userHasFollowed==true) {
                    this.unfollow();
                } else {
                    this.follow();
                }
                
                
            },
            
            getFollowStatus() {
                axios.get('/questions/' + this.question_id + '/get-follow-status').then((response) => {
                    this.userHasFollowed = response.data;
                })
            },
            
        },
        
        mounted() {
            this.getFollowStatus();
        }
        
    }
</script>