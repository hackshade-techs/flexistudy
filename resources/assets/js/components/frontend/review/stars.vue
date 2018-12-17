<template>

        <star-rating :inline="true" :show-rating="false" :increment="0.1" :rating="parseFloat(rating)" :read-only="true" :star-size="parseInt(size)" active-color="#2196f3"></star-rating>

</template>

<script>

    import StarRating from 'vue-star-rating'
    
    export default {
        
        components: {
            StarRating
        },
        
        props: [
            'rating',
            'size'
        ],
        
        methods: {
            
            
        },
        
        mounted() {
            
        }
        
    }
</script>