
<script>
    import Quill from 'quill';
    import { quillEditor } from 'vue-quill-editor'
    
    
    export default {
        data: function () {
            return {
                question: null,
                answer: {
                    text: null,
                    correct: false,
                    explanation: null
                },
                answers: [],
                addAnswer: false,
                addQuestion: false,
                
                editorOption: {
                  modules: {
                    toolbar: [
                      ['bold', 'italic'],
                      ['code-block'],
                      [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                      ['link']
                    ],
                    history: {
                      delay: 1000,
                      maxStack: 50,
                      userOnly: false
                    }
                  }
                }
            }
        },    
        
        computed: {
            countCorrect: function () {
                return this.answers.filter(function(obj){
                    return obj.correct==true
                }).length
                
            }
        },
        
        components: {
            quillEditor
        },
        
        
        props: [
            'lesson'    
        ],
        methods: {
            
            saveAnswer(){
                this.answers.push({
                    text: this.answer.text,
                    correct: this.answer.correct,
                    explanation: this.answer.explanation
                });
                
                this.answer.text = null;
                this.answer.correct = false;
                this.answer.explanation = null;
                this.addAnswer = false;
                
            },
            
            removeAnswer(index){
                this.answers.splice(index, 1);
            },
            
            saveQuestion(){
                axios.post('/api/author/quiz/'+this.lesson+'/question', {
                    lesson_id: this.lesson,
                    question: this.question,
                    answers: this.answers
                }).then(function (response){
                    this.question = null;
                    this.answers = [];
                    this.answer.text = null;
                    this.answer.correct = false;
                    this.answer.explanation = null;
                    this.addAnswer = false;
                    this.addQuestion = false;
                    this.$emit('question-created', 'created')
                }.bind(this)).catch(function (error){
                    console.log(error);
                })
            },
            
            
            
            
            cancelEdit(){
                this.addQuestion = false
                this.answers = [],
                this.addAnswer = false,
                this.$emit('cancel-edit-content', 'cancel')
            },
            
            onEditorBlur(editor) {
                // console.log('editor blur!', editor)
            },
            onEditorFocus(editor) {
                // console.log('editor focus!', editor)
            },
            onEditorReady(editor) {
                // console.log('editor ready!', editor)
            },
            
        },
        
        mounted() {
            
        }
        
    }
</script>