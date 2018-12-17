
<script>

    import draggable from 'vuedraggable'
    
    export default {
        
        data: function () {
            return {
                courses: [],
                featured_courses: [],
                saveStatus: null,
                err: [],
            }
        },
        
        components: {
            draggable,
        },
        
        props: [],
        
        methods: {
            
            fetchAllCourses(){
                return axios.get('/admin/courses/fetch-all').then(function (response) {
                    this.courses = response.data.data;
                }.bind(this))
                .catch(function(error){
                    console.log('Could not fetch courses');
                });
            },
            
            fetchFeaturedCourses(){
                return axios.get('/admin/courses/featured/fetch').then(function (response) {
                    this.featured_courses = response.data.data;
                }.bind(this))
                .catch(function(error){
                    console.log('Could not fetch courses');
                });
            },
            
            updateFeaturedList(){
                var updateIds = [];
                this.featured_courses.map((course, id) => {
                    updateIds = updateIds.concat(course.id)
                });
                axios.put('/admin/courses/featured/update', {
                    course_ids: updateIds
                }).then(function (response){
                    this.fetchFeaturedCourses();  
                    this.fetchAllCourses(); 
                    this.saveStatus = 'Updated';
                    setTimeout(() => {
                       this.saveStatus = null 
                    }, 3000);
                }.bind(this)).catch(function (error){
                    this.saveStatus = 'Error saving. Try again';
                    setTimeout(() => {
                       this.saveStatus = null 
                    }, 3000);
                    
                    this.err = error.response.data;
                })
            }
            
        },
        
        
        mounted() {
            console.log(this.trans('alerts'));
            
            this.fetchFeaturedCourses();
            axios.get('/admin/courses/fetch-all').then(function (response) {
                this.courses = response.data.data;
            }.bind(this))
        }
        
        
    }
</script>
