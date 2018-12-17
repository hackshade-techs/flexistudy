
<script>
    import Quill from 'quill';
    import { quillEditor } from 'vue-quill-editor'
    
    export default {
        data: function () {
            return {
                question: '',
                addAnswer: false,
                newText: null,
                newCorrect: false,
                newExplanation: null,
                
                editorOption: {
                  modules: {
                    toolbar: [
                      ['bold', 'italic'],
                      ['code-block'],
                      [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                      ['link', 'image']
                    ],
                    history: {
                      delay: 1000,
                      maxStack: 50,
                      userOnly: false
                    },
                    imageImport: true,
                    imageResize: {
                      displaySize: true
                    }
                  }
                },
            }
        },    
        
        components: {
            quillEditor
        },
        
        props: [
            'q'    
        ],
        
        computed: {
            countCorrect: function () {
                return this.question.answers.filter(function(obj){
                    return obj.correct==true || obj.correct == 1
                }).length
                
            }
        },
        
        methods: {
            removeAnswer(index){
                 this.question.answers.splice(index, 1);
            },
            
            saveAnswer(){
                this.question.answers.push({
                    answer: this.newText,
                    correct: this.newCorrect,
                    explanation: this.newExplanation
                });
                
                this.newText = null;
                this.newCorrect = false;
                this.newExplanation = null;
                this.addAnswer = false;
                
            },
            
            updateQuestion(){
                return axios.put('/api/author/quiz/'+ this.question.id +'/update', {
                    question: this.question,
                    anwers: this.question.answers
                }).then(function (response){
                    this.$emit('question-created', 'cancel')
                }.bind(this)).catch(function (error){
                    console.log(error);
                })
            },
            
            cancelEdit(){
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
            this.question = this.q
            console.log(this.q)
        }
        
    }
</script>