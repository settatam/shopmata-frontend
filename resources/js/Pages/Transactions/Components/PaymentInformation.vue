<template>
    <div class="bg-white mt-7 mb-7 mx-2 rounded-md">
        <div class="rounded-t-md w-full bg-purple-darken p-4 text-white">
            <h1 class="">
                Payment Information
                <span
                    class="cursor-pointer hover:text-gray-400"
                    @click="toggleEdit()"
                >
                    [ Edit ]
                </span>
            </h1>
        </div>

        <div v-if="!isEdit" class="p-6 space-y-3 text-gray-lighter">
            <payment-method
                :payment_method_name="checkPaymentMethod"
                :method="method"
            />
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
                    id="pay_method"
                    v-model="method.payment_type_id"
                >
                    <option value="">Choose Method</option>
                    <option v-for="option in options"
                            :key="option.id"
                            :value="option.id"
                    >
                        {{ option.name }}
                    </option>
                </select>
            </div>

            <div class="mx-auto w-full">
                <Check
                    @payment-updated="updatePayment"
                    @cancel-payment="isEdit=!isEdit"
                    :method="method"
                    :states="states"
                    :loading="loading"
                    v-if="method.payment_type_id == getIdForMethod('Check')"
                ></Check>
                <PayPal
                    @payment-updated="updatePayment"
                    :method="method"
                    :loading="loading"
                    @cancel-payment="isEdit=!isEdit"
                    v-if="method.payment_type_id == getIdForMethod('PayPal')">
                </PayPal>
                <Venmo
                    @payment-updated="updatePayment"
                    :method="method"
                    :loading="loading"
                    @cancel-payment="isEdit=!isEdit"
                    v-if="method.payment_type_id == getIdForMethod('Venmo')">
                </Venmo>
                <Ach
                    @payment-updated="updatePayment"
                    :method="method"
                    :loading="loading"
                    @cancel-payment="isEdit=!isEdit"
                    v-if="method.payment_type_id == getIdForMethod('ACH')">
                </Ach>
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
        const loading =ref(false);
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
            states.value = res.data.states

        };

        const isEdit = ref(false);
        const payment_method = ref("choose");
        // let name = props.customer.payment_address.payment_type.name;
        const checkPaymentMethod = computed(() => {
            let methodOption = options.value.filter((filter) => {
                return filter.id == method.value.payment_type_id
            })
            return methodOption.length ? methodOption[0].name : '';
        });

        function getIdForMethod(method){
            let methodOption = options.value.filter((filter) => {
                return filter.name == method
            })
            return methodOption.length ? methodOption[0].id : '';
        }

        function toggleEdit() {
            payment_method.value = null != name ? name : "choose";
            isEdit.value = !isEdit.value;
        }

        function updatePayment(data) {
            loading.value = true;
            data.payment_type_id = method.value.payment_type_id
            axios.post(urls.paymentInformation.save(props.transaction_id), data).then((result) => {
                method.value = result.data
                isEdit.value = !isEdit.value;
                loading.value = false
            })
        }

        return {
            isEdit,
            toggleEdit,
            options,
            method,
            states,
            checkPaymentMethod,
            getIdForMethod,
            updatePayment,
            loading
        };
    },
};
</script>
