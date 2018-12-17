<template>
    <span data-toggle="tooltip" :title="userHasBookmarked==true ? 'Remove course from wishlist' : 'Add course to wishlist'">
        <a href="#" @click.prevent="handle">
            <i :class="{'fa fa-heart fa-2x text-primary' : userHasBookmarked==true, 'fa fa-heart-o fa-2x' : userHasBookmarked==false}"></i>
        </a>
    </span>
</template>

<script>
    
    export default {
        data: function () {
            return {
                userHasBookmarked: false,
                showBookmark: null,
                showUnbookmark: null
            }
        },    

        props: [
            'course_id'    
        ],
        methods: {
            addToWishlist(){
                axios.post('/courses/' + this.course_id +'/create-bookmark');
                this.userHasBookmarked = true;
            },
            
            removeFromWishlist () {
                axios.delete('/courses/' + this.course_id + '/delete-bookmark');
                this.userHasBookmarked = false;
            },
            
            handle () {
                if (this.userHasBookmarked==true) {
                    this.removeFromWishlist();
                } else {
                    this.addToWishlist();
                }
                
                
            },
            
            getBookmarkStatus() {
                axios.get('/courses/' + this.course_id + '/get-wishlist-status').then((response) => {
                    this.userHasBookmarked = response.data;
                })
            },
            
        },
        
        mounted() {
            this.getBookmarkStatus();
        }
        
    }
</script>