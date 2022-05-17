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
                "PAY METHOD": payment_method_name,
                "Payable to": payment.check_name,
                Address: payment.check_address,
                City: payment.check_city,
                Zip: payment.check_zip,
                State: payment.state ? payment.state.name : "",
            },
            Venmo: {
                "PAY METHOD": payment_method_name,
                "Venmo address": payment.venmo_address,
            },
            Paypal: {
                "PAY METHOD": payment_method_name,
                "Paypal address": payment.paypal_address,
            },
            ACH: {
                "PAY METHOD": payment_method_name,
                "BANK NAME": payment.bank_name,
                "ROUTING NUMBER": payment.routing_number,
                "ACCOUNT NUMBER": payment.account_number,
                "ACCOUNT NAME": payment.account_name,
                "ACCOUNT TYPE": payment.account_type,
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
