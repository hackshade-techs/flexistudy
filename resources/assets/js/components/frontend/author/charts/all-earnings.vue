<template>
    <div class="container">
        <div v-if="this.showChart">
            <highcharts :options="options"></highcharts>
        </div>
        
    </div>
</template>

<script>
    
    
    export default {
        data: function () {
            
            return {
                sales: [],
                promo: [],
            
                options: {
                    chart: {
                        type: 'area'
                    },
                    title: {
                        text: "Revenue Report of Lifetime Earnings"
                    },
                    subtitle: {
                        text: 'All earnings to date, for all courses'
                    },
                    xAxis: {
                        categories: []
                    },
                    yAxis: {
                        title: {
                          text: 'Earnings'
                        },
                        labels: {
                            formatter: function () {
                                return '$' + this.axis.defaultLabelFormatter.call(this);
                            }   
                        },
                        plotLines: [{
                          value: 0,
                          width: 1,
                          color: '#808080'
                        }]
                    },
                    plotOptions: {
                        area: {
                            fillOpacity: 0.3,
                            marker: {
                                enabled: false,
                                symbol: 'circle',
                                radius: 2,
                                states: {
                                    hover: {
                                        enabled: true
                                    }
                                }
                            }
                        }
                    },
                    credits: {
                        enabled: false
                    },
                    tooltip: {
                        //valuePrefix: '$'
                    },
                    series: [
                        {
                            name: 'Total Earnings',
                            data: [],
                            color: '#14548e',
                            connectNulls: true
                        }
                    ],
                },
                
                showChart: false
            }
        },

        props: ['user_id'],
        
        
        methods: {
            fetchAllEarnings(){
                return axios.get('/author/allearnings/'+ this.user_id +'/fetch').then(function (response) {
                    this.showChart = true;
                    this.options.xAxis.categories = response.data.sales.name;
                    this.sales = response.data.sales;
                    this.options.series[0].data = this.sales.data;
                    //this.options.series[1].data = response.data.promo.data;
                    //this.options.series[2].data = response.data.organic.data;
                }.bind(this))
                .catch(function(error){
                    console.log(error);
                });
            },
  
        },
        
        mounted() {
            this.fetchAllEarnings();
        }
        
        
    }
</script>
