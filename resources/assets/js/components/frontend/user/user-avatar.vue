<template>
    <span>
        <avatar :fullname="user_name" :color="color" :size="parseInt(size)" :image="image" :radius="parseInt(radius)"></avatar>
    </span>
</template>

<script>
    
    import Avatar from 'vue-avatar-component'
    
    export default {
        data: function () {
            return {
                usr: []
            }
        },    
        
        components: {
            Avatar
        },
        
        props: [
            'user_name',
            'color',
            'size',
            'radius',
            'image'
        ],
        methods: {
            
        },
        
        mounted() {
            
        }
        
    }
</script>
