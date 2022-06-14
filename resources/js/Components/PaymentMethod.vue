<template>
    <div>
        <p
            class="font-bold text-xs lg:text-sm text-black"
            :key="key"
            v-for="(map, key) in methodList"
        >
            {{ key }} :
            <span class="ml-2 font-normal">{{ map }}</span>
        </p>
    </div>
</template>

<script>
import { ref, computed, watch } from "vue";

export default {
    props: {
        method: Object,
        payment_method_name: String,
    },

    setup(props) {

        const methodList = computed(() => {
            let methodData = {};
            switch (props.payment_method_name) {
                case 'Check':
                   methodData = {
                        "Pay Method": props.payment_method_name,
                        "Payable to": props.method.check_name,
                        Address: props.method.check_address,
                        City: props.method.check_city,
                        Zip: props.method.check_zip,
                        State: props.method.state ? props.method.state.name : "",
                    }
                    break;
                case 'Venmo':
                    methodData = {
                        "Pay Method": props.payment_method_name,
                        "Venmo address": props.method.venmo_address,
                    }
                    break;
                case 'PayPal':
                    methodData = {
                        "Pay Method": props.payment_method_name,
                        "Paypal address": props.method.paypal_address,
                    }
                    break;
                case 'ACH':
                    methodData = {
                        "Pay Method": props.payment_method_name,
                        "Bank Name": props.method.bank_name,
                        "Routing Number": props.method.routing_number,
                        "Account Number": props.method.account_number,
                        "Account Name": props.method.account_name,
                        "Account Type": props.method.account_type,
                    }
                    break;
                }
            return methodData;
        })

        return { methodList };
    },
};
</script>
