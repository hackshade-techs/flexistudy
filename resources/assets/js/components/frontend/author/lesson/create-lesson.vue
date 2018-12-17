

<script>
    export default {
        
        data: function () {
            return {
                title: null,
                description: null,
                preview: null,
                lesson_type: null
            }
        },
        
        props: ['course'],
        
        methods: {

            storeLesson(){
                axios.post('/api/author/lesson', {
                    course_id: this.course,
                    title: this.title,
                    lesson_type: this.lesson_type,
                    description: this.description,
                    preview: this.preview
                }).then(function (response){
                    this.title = null;
                    this.description = null;
                    this.lesson_type = null;
                    this.preview = null;
                    this.cancelCreate();
                }.bind(this)).catch(function (error){
                    console.log(error);
                })
            },
            
            cancelCreate(){
                this.$emit('cancel-create-lesson', 'cancel')
            }
            
        },
        
        
        mounted() {
            console.log('hello');
        }
        
        
    }
</script>
