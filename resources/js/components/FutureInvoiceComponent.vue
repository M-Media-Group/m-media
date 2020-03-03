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
<!--                               <td class="text-muted">{{item.quantity}}</td>
 -->                              <td>{{formatNumber((item.amount / 100), invoice.currency)}}</td>
                          </tr>
                          <tr>
                              <th>Total</th>
<!--                               <td></td>
 -->                              <td>{{formatNumber((invoice.total / 100), invoice.currency)}}</td>
                          </tr>
                      </tbody>
                  </table>
                </div>
            </div>
            <div v-if="invoice && !loading"  class="text-muted" key="nextpayment">Next payment will be {{invoice.collection_method === 'charge_automatically' ? 'charged automatically' : 'sent to you for manual payment'}} on {{ new Date(invoice.next_payment_attempt * 1000)}}. Total may change before payment date.</div>
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
