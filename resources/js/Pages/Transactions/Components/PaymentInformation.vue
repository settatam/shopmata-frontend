<template>
    <div class="bg-white mt-7 mb-7 mx-auto rounded-md">
        <div class="rounded-t-md w-full bg-purple-darken p-4 text-white">
            <h1 class="text-xl">
                Payment Information
                <span
                    class="cursor-pointer hover:text-gray-400"
                    @click="toggleEdit()"
                >
                    [ Edit ]
                </span>
            </h1>
        </div>

        <div v-if="isEdit" class="p-6 space-y-3 text-gray-lighter">
<!--            <payment-method-->
<!--                :payment_method_name="-->
<!--                    payment_address.payment_type.name-->
<!--                "-->
<!--                :payment="payment_address"-->
<!--            />-->
        </div>

        <div v-else>
            <div class="py-4 px-4 space-y-2 flex flex-col">
                <label
                    class="font-semibold w-full mt-2 bg-transparent"
                    for="pay_method"
                    >PAYMENT METHOD:
                </label>
                <select
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 w-full sm:text-sm border-gray-300 rounded-md"
                    name="pay_method"
                    id=""
                    v-model="method.id"
                >
                    <option value="">Choose Method</option>
                    <option v-for="option in options"
                            :key="option.id"
                            :value="option.payment_type_id"
                    >
                        {{ option.name }}
                    </option>
                </select>
            </div>

            <div class="mx-auto w-full">
                <Check method="method"
                       states="states"
                ></Check>
                <PayPal method="method"></PayPal>
                <Venmo method="method"></Venmo>
                <Ach method="method"></Ach>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, computed, onMounted } from "vue";
import Check from "./Dynamic/Check.vue";
import PayPal from "./Dynamic/PayPal.vue";
import Ach from "./Dynamic/Ach.vue";
import Venmo from "./Dynamic/Venmo.vue";
import PaymentMethod from "../../../Components/PaymentMethod.vue";
import urls from "../../../api/urls";

export default {
    props: {
        transaction_id: Number
    },
    components: {Venmo, PayPal, Check, PaymentMethod, Ach },

    setup(props) {
        onMounted(() => {
           getData()
        })

        const options = ref([]);
        const method = ref({
            payment_type_id: ''
        });
        const states = ref([]);

        const getData = async () => {
            //const cancelToken = axios.cancelToken;
            //const source = cancelToken.source();
        //source.cancel("Operation canceled by the user.");
        const res = await axios.get(
            urls.paymentInformation.get(props.transaction_id),
            {
                //cancelToken,
            },
            {
                //cancelToken: source.token,
            }
        );

        options.value = res.data.payment_types;
        method.value = res.data.payment_address;

        };

        const isEdit = ref(false);
        const payment_method = ref("choose");
        // let name = props.customer.payment_address.payment_type.name;
        // let checkPaymentMethod = computed(() => {
        //     switch (payment_method.value) {
        //         case "Check":
        //             return Check;
        //         case "ACH":
        //             return Ach;
        //         case "PayPal":
        //             return PayPal;
        //         case "Venmo":
        //             return Venmo;
        //         default:
        //             break;
        //     }
        // });

        function toggleEdit() {
            payment_method.value = null != name ? name : "choose";
            isEdit.value = !isEdit.value;
        }

        return { isEdit, toggleEdit, options, method, states};
    },
};
</script>
