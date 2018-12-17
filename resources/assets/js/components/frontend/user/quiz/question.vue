
<script>

    export default {
        
        data: function () {
            
            return {
                chosenAnswer: null,
                showNext: false
            }
            
        },    

        
        props: [
            'question',
            'is_last_question'
        ],
        
        methods: {
            choose(answer){
                this.showNext = true
                this.chosenAnswer = answer
            },
            
            nextQuestion(){
                this.showNext = false
                this.$emit('answer-chosen', this.question, this.chosenAnswer)
            }

        },
        
        mounted() {
            
        }
        
    }
</script>