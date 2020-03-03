<template>

        <transition-group name="fade" mode="out-in" tag="div" style="width: 100%">
            <div class="table-responsive" v-if="invoice && !loading" key="invoices">
                <div class="table-responsive" v-if="invoice.lines.data" key="items">
                  <table class="table">
                          <thead>
                              <tr>
                                  <th>Product / service</th>
<!--                                  <th>Quantity</th>
 -->                                 <th>Price</th>
                              </tr>
                          </thead>
                          <tbody>
                          <tr v-for="item in invoice.lines.data" :key="item['id']">
                              <td>{{item.description}}</td>
                              <td>{{formatNumber((item.amount / 100), invoice.currency)}}</td>
                          </tr>
                          <tr>
                              <th style="text-align: right;">Subtotal</th>
                              <td>{{formatNumber((invoice.subtotal / 100), invoice.currency)}}</td>
                          </tr>
                          <tr v-if="invoice.discount">
                              <th style="text-align: right;">Discount</th>
                              <td>{{invoice.discount.coupon.amount_off ? invoice.discount.coupon.amount_off : invoice.discount.coupon.percent_off + "% off" }}</td>
                          </tr>
                          <tr>
                              <th style="text-align: right;">Total</th>
                              <th>{{formatNumber((invoice.total / 100), invoice.currency)}}</th>
                          </tr>
                      </tbody>
                  </table>
                </div>
            </div>
            <div v-if="invoice && !loading"  class="text-muted" key="nextpayment">Next invoice will be {{invoice.collection_method === 'charge_automatically' ? 'charged automatically' : 'sent to you for manual payment'}} on {{invoice.next_payment_attempt ? new Date(invoice.next_payment_attempt * 1000) : new Date(invoice.created * 1000)}}. Total may change before payment date.</div>
            <div v-else-if="loading" key="loading" class="alert">
              Loading...
            </div>
            <div v-else class="alert text-muted" key="error">
               You have no upcoming invoice.
            </div>
        </transition-group>

</template>


<script>
export default{
    props: ['userid'],
    data(){
        return{
            loading: true,
            error: false,
            success: false,
            invoice: null,
        }
    },
    mounted() {
        this.getSub()
    },
    methods: {

      formatNumber: function(number, currency) {
        var formatter = new Intl.NumberFormat(undefined, {
          style: 'currency',
          currency: currency,
        });
        return formatter.format(number)
      },

    getSub: function () {
        this.loading = true
        //data.append('_method', 'put'); // add this
        axios.get('/api/users/'+this.userid+'/future-invoice') // change this to post )
        .then(res =>{
            this.invoice = res.data
            this.loading = false
            console.log(this.invoice)
        })
        .catch(error => {
            console.log(error)
            this.loading = false
            this.error = true
        });
        }
      }
    }

</script>
