
<script>
    import imageUpload from 'vue-core-image-upload';
    import Quill from 'quill';
    import { ImageImport } from '../../modules/ImageImport.js';
    import { ImageResize } from '../../modules/ImageResize.js';
    Quill.register('modules/imageImport', ImageImport);
    Quill.register('modules/imageResize', ImageResize);
    import { quillEditor } from 'vue-quill-editor';
    
    
    export default {
        data: function () {
            return {
                edit_course: [],
                tags: [],
                used_tags: '',
                saveStatus: null,
                src: '',
                uploadURL: '/api/author/course/image/'+this.course.id,
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
            quillEditor,
            imageUpload
        },
        
        props: [
            'course',
            'alltags',
            'course_tags'
        ],
        methods: {
            updateCourse(){
                this.saveStatus="Saving...";
                
                this.used_tags = $("input[type=text].tags" ).val();
                
                axios.put('/api/author/course/'+  this.edit_course.id, {
                    title: this.edit_course.title,
                    slug: this.edit_course.slug,
                    subtitle: this.edit_course.subtitle,
                    description: this.edit_course.description,
                    level: this.edit_course.level,
                    language: this.edit_course.language,
                    tags: this.used_tags
                }).then(function (response){
                    window.location.href = '/author/course/'+this.edit_course.slug+'/manage';
                    this.saveStatus = 'Changes saved';
                    setTimeout(() => {
                       this.saveStatus = null 
                    }, 3000);
                }.bind(this)).catch(function (error){
                    console.log(error);
                    this.saveStatus="Failed. Try again.";
                })
            },

            onEditorReady(editor) {

            },
            
            fileUploaded(response) {
                this.saveStatus = 'Upload complete';
                    setTimeout(() => {
                       this.saveStatus = null 
                    }, 3000);
                this.src=response.data.path;  
            },


        },
        
        mounted() {
            this.edit_course = this.course;
            this.src=this.course.default_image;
            this.tags = this.alltags;
            this.used_tags = this.course_tags;
            
        }
        
    }
</script>