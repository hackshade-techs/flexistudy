

<script>
    import Bus from '../../bus' 
    export default {
        data() {
            return {
                razorpay_payment_id: '',
                coupon: this.appliedCoupon,
                options: {
                    key: this.settings('rzk'),
                    amount: this.price*100,
                    name: this.settings('site_name'),
                    image: '/logo.png',
                    handler: this.handler,
                    theme: {
                        color: "#168AFA"
                    }
                    
                    
                },
            }
        },
        
        props: [
            'price',
            'appliedCoupon'
        ],
        
        methods: {
            handler(response){
                $('#razorpay_payment_id').val(response.razorpay_payment_id);
                $('#razorpayform').submit();
            },
            
            
        },
        
        mounted() {
            
            var rzp_popup = new Razorpay(this.options);
            
            Bus.$on('price.changed', (data) => {
                this.options.amount = data.price*100;
                this.coupon = data.coupon
            })
            
            document.getElementById('razorpay-button').onclick = (e) => {
                e.preventDefault();
                var rzp_popup = new Razorpay(this.options);
                rzp_popup.open();
                
            }
        }
    }
</script>
