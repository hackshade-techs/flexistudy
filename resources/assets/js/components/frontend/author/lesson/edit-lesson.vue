<template>
    <div class="panel-body">
        <form @submit.prevent="updateLesson(editLesson.id)" class="form-horizontal">
	        <div class="form-group">
	            <label class="col-lg-2">Lesson title: </label>
	            <div class="col-lg-10">
    	            <input type="text" v-validate="'required|max:100'" name="title" id="title" class="form-control" placeholder="Enter lesson title" v-model="editLesson.title"> 
    	            <small class="text-danger" v-show="errors.has('title')">{{ errors.first('title') }}</small>
	            </div>
	        </div>
	        <div class="form-group">
	            <label class="col-lg-2">Lesson description: </label>
	            <div class="col-lg-10">
    	            <input type="text" v-validate="'max:200'" name="description" id="description" class="form-control" placeholder="Enter lesson description" v-model="editLesson.description"> 
    	            <small class="text-danger" v-show="errors.has('description')">{{ errors.first('description') }}</small>
	            </div>
	        </div>
	        <div class="form-group">
                <label class="custom-control custom-checkbox col-lg-12">
                  <input type="checkbox" class="custom-control-input" v-model="editLesson.preview">
                  <span class="custom-control-indicator"></span>
                  <span class="custom-control-description">Free preview?</span>
                </label>
            </div>
	        <div class="form-group pull-right">
	            <a href="#" @click.prevent="cancelEdit">Cancel</a>
    	        <button class="btn btn-success btn-sm" type="submit" >Save</button>
	        </div>
	    </form>
    </div>
</template>

<script>
    export default {
        
        data: function () {
            return {
                editLesson: this.lesson
            }
        },
        
        props: ['lesson', 'section'],
        
        methods: {
            updateLesson(id){
                axios.put('/api/author/lesson/' + id, {
                    title: this.editLesson.title,
                    description: this.editLesson.description,
                    preview: this.editLesson.preview
                }).then(function (response){
                    this.$emit('cancel-edit-lesson', 'cancel')
                }.bind(this)).catch(function (error){
                    console.log(error);
                })
            },
            
            cancelEdit(){
                this.$emit('cancel-edit-lesson', 'cancel')
            },
            
        },
        
        
        mounted() {
            
        }
        
        
    }
</script>
