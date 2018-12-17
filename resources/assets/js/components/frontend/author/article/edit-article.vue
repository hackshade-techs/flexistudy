
<script>
    import Quill from 'quill';
    //import { ImageImport } from '../../modules/ImageImport.js'
    //import { ImageResize } from '../../modules/ImageResize.js'
    //Quill.register('modules/imageImport', ImageImport)
    //Quill.register('modules/imageResize', ImageResize)
    import { quillEditor } from 'vue-quill-editor'
    
    export default {
        data: function () {
            return {
                article: '',
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
            'edit_content'    
        ],
        methods: {
            updateArticle(){
                axios.put('/api/author/lesson/article/'+  this.edit_content.id, {
                    article_body: this.article.article_body
                }).then(function (response){
                    this.$emit('cancel-edit-content', 'cancel')
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
            this.article = this.edit_content;
        }
        
    }
</script>