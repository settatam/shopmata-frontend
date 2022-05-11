<template>
    <div class=" bg-white mt-7 mb-7 mx-auto rounded-md">
        <div class="rounded-t-md w-full bg-purple-darken p-4 text-white">
            <h1 class="text-xl">Customer Sales</h1>
        </div>

        <div class="p-6 space-y-3">
            <p>Total Transactions:</p>
            <p>Total Sales:</p>
            <p>
                Customer Since: {{ moment(customer.date).format('MM-DD-YYYY') }}
            </p>
            <p>IP Address:</p>
        </div>
    </div>
</template>

<script>
import moment from 'moment'

export default {
    created: function () {
        this.moment = moment
    },
    props: ['customer']
}
</script>
