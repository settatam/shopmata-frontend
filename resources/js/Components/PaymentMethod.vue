<template>
    <div>
        <p
            class="font-bold text-xs lg:text-sm text-black"
            :key="key"
            v-for="(map, key) in html"
        >
            {{ key }} :
            <span class="ml-2 font-normal">{{ map }}</span>
        </p>
    </div>
</template>

<script>
import { ref, computed } from "vue";

export default {
    props: {
        payment: Object,
        payment_method_name: String,
    },

    setup({ payment, payment_method_name }) {
        let payments = {
            Check: {
                "Pay Method": payment_method_name,
                "Payable to": payment.check_name,
                Address: payment.check_address,
                City: payment.check_city,
                Zip: payment.check_zip,
                State: payment.state ? payment.state.name : "",
            },
            Venmo: {
                "Pay Method": payment_method_name,
                "Venmo address": payment.venmo_address,
            },
            PayPal: {
                "Pay Method": payment_method_name,
                "Paypal address": payment.paypal_address,
            },
            ACH: {
                "Pay Method": payment_method_name,
                "Bank Name": payment.bank_name,
                "Routing Number": payment.routing_number,
                "Account Number": payment.account_number,
                "Account Name": payment.account_name,
                "Account Type": payment.account_type,
            },
        };

        const html = ref("");
        let e = "";
        for (const key in payments) {
            if (payments.hasOwnProperty.call(payments, payment_method_name)) {
                e = payments[payment_method_name];
            }
        }

        html.value = e;

        return { html };
    },
};
</script>
