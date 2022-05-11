<template>
    <div class=" bg-white mt-7 mb-7 mx-auto rounded-md">
        <div class="rounded-t-md w-full bg-purple-darken p-4 text-white">
            <h1 class="text-xl">Customer Sales</h1>
        </div>

        <div class="p-6 space-y-3">
            <p>Total Transactions: {{customer.transactions.length}}</p>
            <p>Total Sales: ${{sum}}</p>
            <p>
                Customer Since: {{ moment(customer.date).format('MM-DD-YYYY') }}
            </p>
            <p>IP Address:</p>
        </div>
    </div>
</template>

<script>
import { ref, } from 'vue'
import moment from 'moment'

export default {
    created: function () {
        this.moment = moment
    },
    props: ['customer'],
    setup(props){
        const sum = ref(0)
        const customer = props.customer
        function transactionSum (){
            sum.value = customer.transactions.reduce((partialSum, a) => partialSum + a, 0)
        }

        return{
            sum,
            transactionSum
        }
    }
}
</script>
