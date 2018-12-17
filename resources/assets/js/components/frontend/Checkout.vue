
<script>
    import braintree from 'braintree-web';
    import Bus from '../../bus' 
    
    export default {
        data() {
            return {
                oldPrice: null,
                haveCoupon: false,
                appliedCoupon: null,
                price: this.amount,
                couponCode: this.promocode,
                couponStatus: null,
                paymentMethod: 'stripe'
            }
        },
        
        props: [
            'course',
            'promocode',
            'amount',
            'enable_braintree'
        ],
        
        methods: {
            applyCoupon(){
                return axios.post('/courses/coupon', {
                    course: this.course,
                    code: this.couponCode,
                }).then(function(response){
                    if(response.data.status == 'valid'){
                        this.price = response.data.price;
                        this.appliedCoupon = response.data.code;
                        this.oldPrice = this.amount;
                        Bus.$emit('price.changed', { price: this.price, coupon: this.appliedCoupon })
                    }
                    
                    if(response.data.status == 'expired'){
                        this.couponStatus= this.trans('strings.frontend.expired-coupon');
                    }
                    if(response.data.status == 'exhausted'){
                        this.couponStatus= this.trans('strings.frontend.exhausted-coupon');
                    }
                    if(response.data.status == 'invalid'){
                        this.couponStatus= this.trans('strings.frontend.invalid-coupon');  
                    }
                    
                }.bind(this)).catch(function(error){
                   console.log(error); 
                });
            },
            
            resetForm(){
                this.oldPrice= null,
                this.haveCoupon= false,
                this.appliedCoupon= null,
                this.price= this.amount,
                this.couponCode= this.promocode,
                this.couponStatus= null,
                this.paymentMethod= null    
            },
            
            removeCoupon(){
                this.appliedCoupon = null;
                this.price = this.amount;
                this.haveCoupon = false;
                this.couponCode = this.promoCode;
                this.oldPrice = null;
                this.couponStatus = null;
                Bus.$emit('price.changed', { price: this.amount, coupon: this.appliedCoupon })
            }
            
            
        },
        
        mounted() {
            if(this.enable_braintree){
                axios.get('/api/braintree/token').then((response) => {
                    this.loaded = true;
                    
                    braintree.setup(response.data.data.token, 'dropin', {
                        container: 'dropin'
                    });
                })
            }
            
            if(this.promocode){
                this.haveCoupon = true;
                this.applyCoupon();
            }
            
        }
    }
</script>
