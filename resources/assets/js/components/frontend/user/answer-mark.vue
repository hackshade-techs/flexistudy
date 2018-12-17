<template>
    <a href="#" @click.prevent="handle" :class="{'text-info' : userHasMarked==true, 'text-primary' : userHasMarked==false}">
        <span v-show="markCount > 0">({{markCount}})</span> {{userHasMarked==true ? 'You marked as helpful' : 'Mark as helpful'}}
    </a>
</template>

<script>
    
    export default {
        data: function () {
            return {
                userHasMarked: false,
                markCount: 0
            }
        },    

        props: [
            'answer_id'    
        ],
        methods: {
            markAsHelpful(){
                axios.post('/answers/' + this.answer_id +'/mark-as-helpful');
                this.userHasMarked = true;
            },
            
            unmarkAsHelpful() {
                axios.delete('/answers/' + this.answer_id + '/unmark-as-helpful');
                this.userHasMarked = false;
                this.markCount = this.markCount--;
            },
            
            handle () {
                if (this.userHasMarked==true) {
                    this.unmarkAsHelpful();
                    this.markCount = this.markCount-1;
                } else {
                    this.markAsHelpful();
                    this.markCount = this.markCount+1;
                }
            },
            
            getMarkStatus() {
                axios.get('/answers/' + this.answer_id + '/get-mark-status').then((response) => {
                    this.userHasMarked = response.data.user_marked;
                    this.markCount = response.data.marks.length;
                    //console.log(response);
                })
            },
            
        },
        
        mounted() {
            this.getMarkStatus();
            
        }
        
    }
</script>