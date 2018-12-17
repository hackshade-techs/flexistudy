

<script>
import Datepicker from 'vuejs-datepicker';
import vueSlider from 'vue-slider-component';
import Vodal from 'vodal';

export default {
    data: function () {
        return {
            course: [],
            coupons: [],
            searching: false,
            search_keys: ["code", "percent"],
            saveStatus: null,
            showCreateForm: false,
            maxPercent: 100,
            code: null,
            percent: 5,
            quantity: 1,
            expires: null,
            showModal: false,
            couponLink: '',
            copyStatus: null,
            savedCoursePrice: 0,
            err: [],
            eventName: 'couponSearch'
        }
            
    },
    
    components: {
        Datepicker,
        vueSlider,
        Vodal
    },
    
    props: ['course_id'],
    
    methods: {
        fetchCourse(id){
            return axios.get('/api/author/course/'+id).then(function (response) {
                this.course = response.data;
                this.savedCoursePrice = this.course.price;
            }.bind(this))
            .catch(function(error){
                console.log('Could not fetch course');
            });
        },
        
        createCoupon(){
            this.saveStatus = this.trans('strings.frontend.saving');
            axios.post('/api/author/course/coupon', {
                course_id: this.course_id,
                code: this.code,
                percent: this.percent,
                quantity: this.quantity,
                expires: this.expires
            }).then(function (response){
                this.code = '';
                this.percent = 5;
                this.quantity = 1;
                this.expires = '';
                this.showCreateForm = false;
                this.saveStatus = this.trans('strings.frontend.coupon-saved');
                setTimeout(() => {
                   this.saveStatus = null 
                }, 3000);
                this.fetchCoupons();
            }.bind(this))
            .catch(function (error){
                this.saveStatus = this.trans('strings.frontend.error-saving-coupon');
                setTimeout(() => {
                   this.saveStatus = null 
                }, 3000);
                
                this.err = error.response.data;
                
            }.bind(this))
        },
        
        
        fetchCoupons(){
            return axios.get('/api/author/course/' + this.course_id + '/coupons').then(function (response){
                this.coupons = response.data.data;
            }.bind(this))
            .catch(function(error){
                console.log(error);
            })
        },
        toggleActive(id, status){
            this.saveStatus = this.trans('strings.frontend.updating-coupon-status');
            axios.put('/api/author/coupon/'+id+'/activate',{
                id: id,
                status:status
            }).then(function (response){
                this.fetchCoupons();
                this.saveStatus = this.trans('strings.frontend.status-updated');
                setTimeout(() => {
                   this.saveStatus = null 
                }, 3000);
            }.bind(this)).catch(function (error){
                console.log(error);
            })
        },
        getLink(link){
            this.showModal=true; 
            this.couponLink=link;
        },
        copyToClipboard(){
            document.querySelector('#couponLink').select();
            document.execCommand('copy');  
            this.copyStatus = this.trans('strings.frontend.copied-to-clipboard');
            setTimeout(() => {
               this.copyStatus = null 
            }, 3000);
        },
        updatePrice(){
            this.saveStatus = this.trans('strings.frontend.updating');
            axios.put('/api/author/course/price/' + this.course_id +'/update', {
                price: this.course.price
            }).then(function (response){
                this.saveStatus = this.trans('strings.frontend.price-updated');
                setTimeout(() => {
                   this.saveStatus = null 
                }, 3000);
                this.fetchCourse(this.course_id);
                this.fetchCoupons();
            }.bind(this)).catch(function (error){
                console.log(error);
            })
        },
        
        

    },
    
    created(){
        this.$on('couponSearch', result => {
            
            this.coupons = result;
            
            if($(".coupon-search .form-control").val() == ''){
                this.fetchCoupons();
            };
           
        });
        
    },
    
    mounted(){
        this.fetchCoupons();
        this.searching=true;
        
        return axios.get('/api/author/course/'+this.course_id).then(function (response) {
            this.course = response.data;
            this.savedCoursePrice = this.course.price;
        }.bind(this));
        
    }
}

</script>
<style>
    .vodal-dialog{background: transparent;}
</style>
