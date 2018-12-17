
<script>
   
    import Quill from 'quill';
    import { quillEditor } from 'vue-quill-editor';
    
    export default {
        data: function () {
            return {
                questions: [],
                searching: false,
                keys: ["title", "body"],
                editQuestion: [],
                detailQuestion: [],
                results_count: null,
                showCreate: false,
                showEdit: false,
                showDetail: false,
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
                body: '',
                title: '',
                err: [],
                saveStatus: null,
                current_page: 1,
                meta: [],
                total_pages: null,
                showEdit: false,
                editComment: [],
            }
        },    
  
        components: {
            quillEditor
        },
        
        props: [
            'course_id'    
        ],
        methods: {
            fetchQuestions(){
                return axios.get('/questions/api/'+ this.course_id + '/get-questions?page=' + this.current_page).then(function (response) {
                    this.questions = response.data.data;
                    this.meta = response.data.meta.pagination;
                    this.total_pages = this.meta.total_pages;
                    this.current_page = 1;
                    this.showEdit = false;
                    this.showDetail = false;
                    this.detailQuestion = [];
                    
                }.bind(this))
                .catch(function(error){
                    //console.log('Could not fetch questions');
                    console.log(error);
                });
            },
            strippedHTML(msg) {
                return $(msg).text();
            },
          
            fetchMoreQuestions(){
                axios.get('/questions/api/'+ this.course_id + '/get-questions?page=' + parseInt(this.current_page+1)).then(response => {
                   this.questions = this.questions.concat(response.data.data)
                   this.current_page = this.current_page+1
                }, response => { 
                    console.log('Error fetching questions');
                });    
            },
            
            onEditorReady(editor) {

            },
            
            storeQuestion() {
                axios.post('/questions/api/'+this.course_id+'/store-question', {
                    title: this.title,
                    body: this.body
                }).then(function (response){
                    this.fetchQuestions();
                    this.title = '';
                    this.body = '';
                    this.showCreate = false;
                }.bind(this)).catch(function (error){
                    
                    this.err = error.response.data;
                })
            },
            
            fetchEditQuestion(id){
                this.showEdit = true;
                return axios.get('/questions/api/'+id+'/get-edit-question').then(function (response) {
                    this.editQuestion = response.data;
                    //console.log(this.editQuestion);
                }.bind(this))
                .catch(function(error){
                    console.log('Could not fetch question');
                });
            },
            
            updateQuestion(id){
                axios.put('/questions/api/'+id+'/update-question', {
                    title: this.editQuestion.title,
                    body: this.editQuestion.body
                }).then(function (response){
                    this.fetchQuestions();  
                }.bind(this)).catch(function (error){
                    this.err = error.response.data;
                })
            },
            
            deleteQuestion(id){
                swal({
                        title: "Are you sure?",
                        text: "This question will be permanently deleted with all answers.",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true
                    },
                function(){
                        axios.delete('/questions/api/'+id+'/delete-question').then((response) => {
                            swal("Deleted");
                            this.fetchQuestions();
                        })
                    }.bind(this)
                );
                
            }
            
            
        },
        
        created(){
            this.$on('fuseResultsUpdated', results => {
                
                if(results.length > 0){
                    this.questions = results;
                    this.results_count = null;
                } else {
                   this.results_count = results.length;
                }
                if($(".question-search .form-control").val() == ''){
                    this.results_count = null;
                    this.fetchQuestions();
                };
               
            });
            
        },
        
        mounted() {
            axios.get('/questions/api/'+ this.course_id + '/get-questions?page=' + this.current_page).then(function (response) {
                this.questions = response.data.data;
                this.meta = response.data.meta.pagination;
                this.total_pages = this.meta.total_pages;
                this.current_page = 1;
                this.showEdit = false;
                this.showDetail = false;
                this.detailQuestion = [];
                this.searching=true;
            }.bind(this));
            
        }
        
    }
</script>

<style>
    textarea.comment-box {
        width: 100%;
        height: 50px;
        font-size: 12px;
        color: #666;
        padding: 10px 14px;
        resize: none;
        line-height: 1.5em;
        border: 1px solid #d4d4d4;
    }
    
    ul.commentlist,
    ul.announcement{
        list-style-type: none;
        margin-top: 0;
        margin-bottom: 11.5px;
        padding-left: 0;
    }
    
    .avatar-img {
        margin-right: 8px;
    }
    
    .comment-content p {
        font-size: 13px;
        color: #666;
        position: absolute;
    }
    h6.question{
        margin-bottom: 0px;
    }
    .info-instructor {
        position: relative;
        line-height: 12px;
        margin-top: 0px;
        overflow: hidden;
    }
</style>