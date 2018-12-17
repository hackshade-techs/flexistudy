<script>
    
    import Quill from 'quill';
    import { quillEditor } from 'vue-quill-editor';
    
    export default {
        data: function () {
            return {
                answers: [],
                body: '',
                saveStatus: null,
                err: [],
                current_page: 1,
                meta: [],
                total_pages: null,
                showEdit: false,
                editAnswer: [],
                avatar_size: 35,
                avatar_radius: 25,
                
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
                },
            }
        },    
        
        components: {
            quillEditor
        },
        
        props: [
            'question_id'    
        ],
        methods: {
            fetchAnswers(){
                return axios.get('/questions/api/'+ this.question_id + '/get-answers?page=' + this.current_page).then(function (response) {
                    this.answers = response.data.data;
                    this.meta = response.data.meta.pagination;
                    this.total_pages = this.meta.total_pages;
                    this.current_page = 1;
                    this.showEdit = false;
                    //console.log(this.answers);
                }.bind(this))
                .catch(function(error){
                    console.log('Could not fetch answers');
                });
            },
            
            fetchMoreAnswers(){
                axios.get('/questions/api/'+ this.question_id + '/get-answers?page=' + parseInt(this.current_page+1)).then(response => {
                   this.answers = this.answers.concat(response.data.data)
                   this.current_page = this.current_page+1
                }, response => { 
                    console.log('Error fetching answers');
                });    
            },
            
            storeAnswer() {
                axios.post('/questions/api/'+this.question_id+'/store-answer', {
                    body: this.body
                }).then(function (response){
                    this.current_page = 1;
                    this.fetchAnswers();
                    this.body = '';
                }.bind(this)).catch(function (error){
                    this.err = error.response.data;
                })
            },
            
            fetchEditAnswer(id){
                this.showEdit = true;
                return axios.get('/questions/api/answer/'+id+'/get-edit-answer').then(function (response) {
                    this.editAnswer = response.data;
                }.bind(this))
                .catch(function(error){
                    console.log('Could not fetch answers');
                });
            },
            
            updateAnswer(id){
                axios.put('/questions/api/answer/'+id+'/update-answer', {
                    body: this.editAnswer.body
                }).then(function (response){
                    this.fetchAnswers();  
                }.bind(this)).catch(function (error){
                    this.err = error.response.data;
                })
            },

            deleteAnswer(id){
                swal({
                        title: this.trans('alerts.frontend.general.delete-confirm-text'),
                        text: this.trans('strings.frontend.answer-delete'),
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        cancelButtonText: this.trans('alerts.frontend.general.cancel'),
                        confirmButtonText: this.trans('alerts.frontend.general.yes-delete'),
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true
                    },
                function(){
                        axios.delete('/questions/api/answer/'+id+'/delete-answer').then((response) => {
                            swal(this.trans('alerts.frontend.general.deleted'));
                            this.fetchAnswers();
                        })
                    }.bind(this)
                );
            
            },
            
            markAsAnswer(id){
                axios.put('/answers/api/'+id+'/mark-as-answer')
                    .then(function (response){
                        this.fetchAnswers();  
                }.bind(this)).catch(function (error){
                    this.err = error.response.data;
                })
            },
            
            onEditorReady(editor) {

            }
            
        },
        
        mounted() {
            this.fetchAnswers();
            
        }
        
    }
</script>

