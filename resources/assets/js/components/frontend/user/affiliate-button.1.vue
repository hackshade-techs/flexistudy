<template>
    <span>
        <button @click.prevent="getLink(link)" class="btn btn-info btn-xs">
            {{trans('strings.frontend.promote-this-course')}}
        </button>
        
        <vodal :show="showModal" 
            animation="fade" 
            @hide="showModal=false"
            :width="60"
            :height="40"
            measure="%"
            :close-button=false
            :duration="301">
            <div class="panel panel-default">
                <div class="panel-heading header">
                    {{trans('strings.frontend.copy-affiliate-link')}}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="input-group">
                          <input type="text" class="form-control" style="font-size:12px !important;" id="promoLink" :value="promoLink">
                          <span class="input-group-addon">
                              <a href="#" @click.prevent="copyToClipboard()">
                                  <i class="fa fa-clipboard"></i>
                              </a>
                          </span>
                        </div>
                        <small class="text-success">{{copyStatus}}</small>
                    </div>
                </div>
                <div class="panel-footer clearfix">
                    <button class="btn btn-danger btn-xs pull-right" @click="showModal = false">{{trans('strings.frontend.close')}}</button>
                </div>
                
            </div>
        </vodal>
    </span>
</template>

<script>
    
    import Vodal from 'vodal';
    export default {
        data: function () {
            return {
                showModal: false,
                promoLink: null,
                copyStatus: null
            }
                
        },
        
        props: ['link'],
        
        components: {
            Vodal
        },

        methods: {
            getLink(link){
                this.showModal=true; 
                this.promoLink=link;
            },
            copyToClipboard(){
                document.querySelector('#promoLink').select();
                document.execCommand('copy');  
                this.copyStatus = this.trans('strings.frontend.copied-to-clipboard');
                setTimeout(() => {
                   this.copyStatus = null 
                }, 3000);
            }, 
        }
        
    }
</script>
