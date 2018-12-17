

<script>
    
    import draggable from 'vuedraggable';
    import vueSlider from 'vue-slider-component';
    export default {
        
        components: {
            draggable,
            vueSlider
            
        },
        
        data: function () {
            return {
                sections: [],
                editSection: [],
                editLesson: [],
                editContent: [],
                editing_question: false,
                questionBeingEdited: [],
                
                title: '',
                objective: '',
                showCreate: false,
                showEdit: false,
                saveStatus: null,
                showEditLesson: false,
                showEditContent: false,
                createLesson: false,
                content_type: null,
                contentLesson: null,
                videoLink: null,
                duration: 2,
                video_provider: null,
                err: [],
                lessonAction: '',
                showAddAttachment: false
            }
        },
        
        props: ['course', 'course_obj'],
        
        methods: {
            strippedContent(text) {
                let regex = /(<([^>]+)>)/ig;
                return text.replace(regex, "");
            },
  
            fetchSections(){
                return axios.get('/api/author/'+this.course+'/sections').then(function (response) {
                    this.sections = response.data;
                    this.showEdit = false;
                    this.duration = 2;
                    this.videoLink = null;
                    this.showEditContent=false;
                    this.editing_question=false
                }.bind(this))
                .catch(function(error){
                    console.log('Could not fetch sections');
                });
            },
            
            fetchSection(id){
                return axios.get('/api/author/section/'+id).then(function (response) {
                    this.editSection = response.data;
                    this.showEdit=true;
                }.bind(this))
                .catch(function(error){
                    console.log('Could not fetch section');
                });
            },
            
            updateSection(id){
                axios.put('/api/author/section/' + id, {
                    title: this.editSection.title,
                    objective: this.editSection.objective
                }).then(function (response){
                    this.fetchSections();  
                }.bind(this)).catch(function (error){
                    this.saveStatus = 'Error saving. Try again';
                    setTimeout(() => {
                       this.saveStatus = null 
                    }, 3000);
                    
                    this.err = error.response.data;
                })
            },
            
            fetchEditLesson(id){
                return axios.get('/api/author/lesson/'+id).then(function (response) {
                    this.editLesson = response.data;
                    this.showEditLesson=true;
                }.bind(this))
                .catch(function(error){
                    console.log('Could not fetch lesson');
                });
            },
            
            fetchEditContent(id){
                this.showEditContent=true;
                return axios.get('/api/author/lesson/content/'+id).then(function (response) {
                    this.editContent = response.data;
                    this.showEditContent=true;
                
                }.bind(this))
                .catch(function(error){
                    console.log('Could not fetch content');
                });
            },
            
            fetchEditVideoContent(lesson_id){
                this.showEditContent=true;
                return axios.get('/api/author/lesson/video-content/'+lesson_id).then(function (response) {
                    this.videoLink = response.data.video_path;
                    this.duration = response.data.video_duration;
                }.bind(this))
                .catch(function(error){
                    this.saveStatus = 'Error saving. Try again';
                    setTimeout(() => {
                       this.saveStatus = null 
                    }, 3000);
                    
                    this.err = error.response.data;
                });
            },
            
            setContentLesson(id, type, method, axn){
                this.showEditContent = true;
                this.contentLesson = id;
                this.lessonAction = axn;
                
                if(axn == 'edit'){
                    this.fetchEditVideoContent(id);
                }
                
                if(type=='video' && method=='upload'){
                    this.content_type = 'video_upload'
                }
                if(type=='video' && method=='youtube'){
                    this.content_type = 'video_youtube';
                }
                if(type=='video' && method=='vimeo'){
                    this.content_type = 'video_vimeo'
                }
                if(type=='video' && method=='s3'){
                    this.content_type = 'video_s3'
                }
                if(type=='article'){
                    this.content_type = 'article'
                }
                this.video_provider = method;
            },
            
            cancelEdit(){
                this.editSection = [],
                this.showEdit = false;
            },
            cancelLessonEdit(data){
                this.showEditLesson = false;
                this.fetchSections();
                this.content_type=null;
            },
            cancelLessonCreate(data){
                this.createLesson = false;
                this.fetchSections();
            },
            lessonCreated(data){
                this.createLesson = false;
                this.fetchSections();
            },
            
            updateSectionSort(e) {
                this.sections.map((section, index) => {
                    section.sortOrder = index+1
                    this.updateSectionSortOrder(section);
                })
            },
            
            updateLessonSort(e) {
                //console.log(e);
                this.sections.map((section) => {
                    section.lessons.map((lesson, index) => {
                        lesson.sortOrder = index+1
                        lesson.section_id = section.id;
                        this.updateLessonSortOrder(lesson);
                    });
                    
                });
            },
            
            updateSectionSortOrder(obj){
                axios.put('/api/author/sections/draggable', {
                    data: obj
                }).then(function (response){
                    this.saveStatus = 'Changes saved';
                    setTimeout(() => {
                       this.saveStatus = null 
                    }, 3000);
                    
                }.bind(this)).catch(function (error){
                    this.saveStatus = 'Error saving changes';
                    setTimeout(() => {
                       this.saveStatus = null 
                    }, 3000);
                })
            },
            
            updateLessonSortOrder(obj){
                axios.put('/api/author/lessons/draggable', {
                    data: obj
                }).then(function (response){
                    this.saveStatus = 'Changes saved';
                    setTimeout(() => {
                       this.saveStatus = null 
                    }, 3000);
                    
                }.bind(this)).catch(function (error){
                    this.saveStatus = 'Error saving changes';
                    setTimeout(() => {
                       this.saveStatus = null 
                    }, 3000);
                })
            },
            
            storeSection(){
                axios.post('/api/author/section', {
                    course_id: this.course,
                    title: this.title,
                    objective: this.objective
                }).then(function (response){
                    this.fetchSections();
                    this.title = '';
                    this.objective = '';
                    this.showCreate = false;
                    
                }.bind(this)).catch(function (error){
                    this.saveStatus = 'Error saving. Try again';
                    setTimeout(() => {
                       this.saveStatus = null 
                    }, 3000);
                    
                    this.err = error.response.data;
                })
            },
            
            deleteSection(id){
                swal({
                        title: this.trans('alerts.frontend.general.delete-confirm-title'),
                        text: this.trans('alerts.frontend.general.delete-confirm-text'),
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        cancelButtonText: this.trans('alerts.frontend.general.cancel'),
                        confirmButtonText: this.trans('alerts.frontend.general.yes-delete'),
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true
                    },
                function(){
                        axios.delete('/api/author/section/'+id).then((response) => {
                            swal(this.trans('alerts.frontend.general.deleted'));
                            this.fetchSections();
                        })
                    }.bind(this)
                );
                
            },
            
            deleteLesson(id){
                swal({
                        title: "Are you sure?",
                        text: "This lesson will be permanently deleted!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: true,
                        showLoaderOnConfirm: true
                    },
                function(){
                        axios.delete('/api/author/lesson/'+id).then((response) => {
                            //swal("Deleted");
                            this.fetchSections();
                        })
                    }.bind(this)
                );
            },
            
            storeEmbed(id){
                axios.post('/api/author/lesson/'+id+'/video/embed', {
                    videoLink: this.videoLink,
                    duration: this.duration,
                    video_provider: this.video_provider
                }).then(function (response){
                    this.videoLink = null;
                    this.duration = 2;
                    this.video_provider = null;
                    this.content_type=null;
                    this.fetchSections();
                    
                }.bind(this)).catch(function (error){
                    console.log(error);
                })
            },
            
            updateEmbed(id){
                axios.put('/api/author/lesson/'+id+'/video/update-embed', {
                    videoLink: this.videoLink,
                    duration: this.duration
                }).then(function (response){
                    this.videoLink = null;
                    this.duration = 2;
                    this.video_provider = null;
                    this.content_type=null;
                    this.lessonAction='';
                    this.fetchSections();
                    
                }.bind(this)).catch(function (error){
                    this.saveStatus = 'Error saving. Try again';
                    setTimeout(() => {
                       this.saveStatus = null 
                    }, 3000);
                    
                    this.err = error.response.data;
                })
            },
            
            clickAddAttachment(){
                this.showAddAttachment = true;
            },
            
            deleteAttatchment(lesson, attachment){
                swal({
                        title: this.trans('strings.frontend.are-you-sure'),
                        text: "",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: this.trans('strings.frontend.yes-delete'),
                        closeOnConfirm: true,
                        showLoaderOnConfirm: true
                    },
                function(){
                        axios.delete('/author/lesson/'+lesson+'/attachment/'+attachment+'/destroy').then((response) => {
                            //swal(this.trans('strings.frontend.deleted'));
                            this.fetchSections();
                        })
                    }.bind(this)
                )
            },
            
            fileSelected(){
                $('.attachment-submit-btn').prop("disabled", false);
            },
            
            questionCreated(){
                this.fetchSections();
            },
            
            editQuestion(q){
                this.editing_question = true
                this.questionBeingEdited = q
                //this.$emit('editing-question', id)
            },
            
            deleteQuestion(id){
                swal({
                        title: "Are you sure?",
                        text: "This question will be permanently deleted with all answers.",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: true,
                        showLoaderOnConfirm: true
                    },
                function(){
                        axios.delete('/api/author/quiz/'+id).then((response) => {
                            this.fetchSections();
                        })
                    }.bind(this)
                );
                
            },
            
        
        },
        
        mounted() {
            this.fetchSections();
        }
    }
</script>
<style type="text/css">
    .dragme, 
    .dragme-lesson { cursor: move; cursor: -webkit-grabbing; }
    
    .answer-choices {
        margin-left: 20px;
        margin-bottom: 15px;
    }
</style>
