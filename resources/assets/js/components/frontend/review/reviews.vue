

<script>

    import StarRating from 'vue-star-rating'
    
    export default {
        data: function () {
            return {
                rating: 1,
                comment: '',
                reviews: [],
                err: [],
                current_page: 1,
                meta: [],
                total_pages: null,
                can_review: false,
            }
        },    
        components: {
            StarRating
        },
        
        props: [
            'course',
            'user_can_review'
        ],
        
        methods: {
            saveReview(){
                axios.post('/courses/api/'+ this.course.id + '/review', {
                    rating: this.rating,
                    comment: this.comment,
                    course_id: this.course.id
                }).then(function (response){
                    this.rating = 1;
                    this.comment = '';
                    this.can_review = false;
                    this.fetchReviews();
                }.bind(this)).catch(function (error){
                    console.log(error);
                })
            },
            
            fetchReviews(){
                return axios.get('/courses/'+ this.course.id + '/reviews?page=' + this.current_page).then(function (response) {
                    this.reviews = response.data.data;
                    this.meta = response.data.meta.pagination;
                    this.total_pages = this.meta.total_pages;
                    this.current_page = 1;
                }.bind(this))
                .catch(function(error){
                    console.log(error);
                });
            },
            
            fetchMoreReviews(){
                return axios.get('/courses/'+ this.course.id + '/reviews?page=' + parseInt(this.current_page+1)).then(function (response) {
                    this.reviews = this.reviews.concat(response.data.data);
                    this.current_page = this.current_page+1;
                }.bind(this))
                .catch(function(error){
                    console.log(error);
                });
            }
          
            
            
        },
        
        mounted() {
            this.fetchReviews();
            this.can_review = this.user_can_review
        }
        
    }
</script>

<style type="text/css">
    .avg_rating{
        font-weight: bold;
        font-size: 1.9em;
        border: 1px solid #cfcfcf;
        padding-left: 10px;
        padding-right: 10px;
        border-radius: 5px;
        color: #999;
        background: #fff;
    }
</style>