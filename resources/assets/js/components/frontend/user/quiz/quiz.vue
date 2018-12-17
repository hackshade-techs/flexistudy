
<script>
    
    export default {
        
        data: function () {
            
            return {
                questions: [],
                currentQuestion: [],
                answeredQuestions: [],
                currentQuestionNumber: 1,
                showResults: false,
                isLastQuestion: false
            }
            
        },    

        
        props: [
            'lesson'    
        ],
        
        computed: {
            totalCorrect: function () {
            
                return this.answeredQuestions.filter(function(obj){
                    return obj.question.selectedAnswer.correct==1
                }).length
                
            },
            
            percent: function() {
                return Math.round((this.totalCorrect / this.questions.length)*100);
            }
        },
        
        methods: {
            strippedContent(text) {
                let regex = /(<([^>]+)>)/ig;
                return text.replace(regex, "");
            },
            
            storeAnswer(question, answer){
                if(this.currentQuestionNumber == this.questions.length-1){
                    this.isLastQuestion = true;
                }
                
                if(this.currentQuestionNumber == this.questions.length){
                    this.showResults = true;
                }
                question.selectedAnswer = answer
                
                this.answeredQuestions.push({
                    question: question
                })

                this.currentQuestionNumber++
                this.currentQuestion = this.questions[this.currentQuestionNumber -1]
                
                // also write to the database if this is the last question
                if(this.showResults){
                    console.log(this.answeredQuestions)
                    axios.post('/api/user/quiz/'+this.lesson+'/saveAttempt', {
                        questions: this.answeredQuestions
                    }).then((response) => {
                        console.log(response)
                    }).catch((error) => {
                        console.log(error)
                    })
                }
            },


        },
        
        mounted() {
            return axios.get('/api/user/quiz/'+this.lesson+'/questions').then((response) => {
                this.questions = response.data
                this.currentQuestion = response.data[0]
            }); 
        }
        
    }
</script>