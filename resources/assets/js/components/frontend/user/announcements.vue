<template>
    <span>
        <div id="respond">
            <form @submit.prevent="storeComment()">
                <textarea class="comment-box" placeholder="Enter comment..." v-model="body"></textarea>
                <div class="form-submit">
                    <input type="submit" value="Post" class="btn btn-success btn-sm">
                </div>
            </form>
        </div>
        <h5>Comments: {{meta.total}}</h5>
        <ul class="commentlist" v-for="comment in comments">
            <li class="comment">
                <div class="comment-body">
                    <div class="comment-author">
                        <a href="#" class="pull-left avatar-img">
                            <avatar :fullname="comment.user.full_name" color="black" :size="parseInt(avatar_size)" :radius="avatar_radius"></avatar>
                        </a>
                        <!--<img :src="comment.user.image" alt="">-->
                        <span class="author-meta">
                            <a href="">{{comment.user.full_name}}</a>
                            <span class="text-muted">
                                <small>{{comment.created_at_human}}</small>
                                <small v-if="comment.updated_at_human">&nbsp;<em>edited: {{comment.updated_at_human}}</em></small>
                            </span>
                        </span>
                    </div>
                    <div class="comment-content">
                        <span class="pull-right">
                            <a href="#" @click.prevent="fetchEditComment(comment.id)" v-if="comment.user.can_edit && !showEdit">edit</a>
                            <a href="#" v-if="showEdit && editComment.id == comment.id" @click.prevent="showEdit=false">Cancel</a>
                            <a href="#" @click.prevent="deleteComment(comment.id)" v-if="comment.user.can_edit && !showEdit" class="text-danger">delete</a>
                        </span>
                        <p>{{ comment.body }}</p>
                        
                        <div v-if="showEdit && editComment.id == comment.id">
                            <form @submit.prevent="updateComment(comment.id)">
                                <textarea class="comment-box" v-model="editComment.body"></textarea>
                                <div class="form-submit">
                                    <input type="submit" value="Update" class="btn btn-success btn-sm pull-right">
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </li>
        </ul>
      
        <div class="load-more" v-if="comments.length > 0 && current_page < total_pages">
            <a href="" @click.prevent="fetchMoreComments()"><i class="icon md-time"></i>Load more comments</a>
        </div>
    </span>
</template>

<script>
    
    import Avatar from 'vue-avatar-component'
    
    export default {
        data: function () {
            return {
                comments: [],
                body: '',
                saveStatus: null,
                err: [],
                current_page: 1,
                meta: [],
                total_pages: null,
                showEdit: false,
                editComment: [],
                avatar_size: 35,
                avatar_radius: 25
            }
        },    
        
        components: {
            Avatar
        },
        
        props: [
            'announcement_id'    
        ],
        methods: {
            fetchComments(){
                return axios.get('/announcements/api/'+ this.announcement_id + '/get-comments?page=' + this.current_page).then(function (response) {
                    this.comments = response.data.data;
                    this.meta = response.data.meta.pagination
                    this.total_pages = this.meta.total_pages
                    this.current_page = 1
                    this.showEdit = false
                }.bind(this))
                .catch(function(error){
                    console.log('Could not fetch comments');
                });
            },
            
            fetchMoreComments(){
                axios.get('/announcements/api/'+ this.announcement_id + '/get-comments?page=' + parseInt(this.current_page+1)).then(response => {
                   this.comments = this.comments.concat(response.data.data)
                   this.current_page = this.current_page+1
                }, response => { 
                    console.log('Error fetching comments');
                });    
            },
            
            storeComment() {
                axios.post('/announcements/api/'+this.announcement_id+'/store-comment', {
                    body: this.body
                }).then(function (response){
                    this.fetchComments();
                    this.body = '';
                    this.saveStatus = 'Comment posted.';
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
            },
            
            fetchEditComment(id){
                this.showEdit = true;
                return axios.get('/announcements/api/comment/'+id+'/get-edit-comment').then(function (response) {
                    this.editComment = response.data;
                   
                }.bind(this))
                .catch(function(error){
                    console.log('Could not fetch comments');
                });
            },
            
            updateComment(id){
                axios.put('/announcements/api/comment/'+id+'/update-comment', {
                    body: this.editComment.body
                }).then(function (response){
                    this.fetchComments();  
                }.bind(this)).catch(function (error){
                    this.saveStatus = 'Error saving. Try again';
                    setTimeout(() => {
                       this.saveStatus = null 
                    }, 3000);
                    
                    this.err = error.response.data;
                })
            },

            deleteComment(id){
                axios.delete('/announcements/api/comment/'+id+'/delete-comment').then(function (response) {
                    this.fetchComments();
                }.bind(this))
                .catch(function(error){
                    console.log(error);
                });
            },
            
            
        },
        
        mounted() {
            this.fetchComments();
        }
        
    }
</script>

<style>
    textarea.comment-box {
        width: 100%;
        height: 50px;
        font-size: 12px;
        color: #666;
        padding: 10px 14px;
        resize: none;
        line-height: 1.5em;
        border: 1px solid #d4d4d4;
    }
    
    ul.commentlist,
    ul.announcement{
        list-style-type: none;
        margin-top: 0;
        margin-bottom: 11.5px;
        padding-left: 0;
    }
    
    .avatar-img {
        margin-right: 8px;
    }
    
    .comment-content p {
        font-size: 13px;
        color: #666;
        position: absolute;
    }
</style>