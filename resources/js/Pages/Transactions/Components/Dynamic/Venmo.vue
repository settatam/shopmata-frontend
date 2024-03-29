<template>
    <div class="px-4 space-y-3 w-full pb-8">
        <div class="flex flex-col space-y-2">
            <label class="font-semibold mt-2 w-full bg-transparent" for="address">VENMO ADDRESS:</label>
            <input :class="{
                'border-red-600': v$.venmo_address.$error,
                'border-gray-300': !v$.venmo_address.$error,
            }" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                type="text" id="address" v-model="paymentInfo.venmo_address" placeholder="My Venmo address is" />
        </div>
        <div class="mt-1">
            <p class="text-red-600 text-xs" v-if="v$.venmo_address.$error">
                {{ v$.venmo_address.$errors[0].$message }}
            </p>
        </div>

        <!-- submit -->
        <div class="flex justify-between space-x-3 w-2/3 mx-auto pt-8 mt-8">
            <div class="">
                <button class="text-gray-400 bg-gray-100 border border-gray-400 rounded-md px-6 py-3"
                    @click="cancelPayment">
                    Cancel
                </button>
            </div>
            <div class="">
                <button v-if="!v$.$error" :disabled="loading" type="submit" :class="{
                    disabled: loading,
                    'opacity-25 cursor-not-allowed': loading,
                }" class="disabled:bg-gray-400 w-full flex justify-center py-3 px-12 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    @click="submit">
                    <LoadingSpinner v-if="loading" />
                    Save
                </button>

                <!-- else -->
                <button v-else type="button" class="bg-indigo-600 text-white rounded-md px-8 py-3">
                    Save
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, reactive, computed } from "vue";
import {
    required,
    maxLength,
    numeric,
    helpers,
    email,
} from "@vuelidate/validators";
import useVuelidate from "@vuelidate/core";
import LoadingSpinner from "../../../../Components/LoadingSpinner.vue";
import { Inertia } from "@inertiajs/inertia";

export default {
    props: {
        method: Object,
        loading: Boolean
    },
    components: {
        LoadingSpinner,
    },
    emits: ['payment-updated', 'cancel-payment'],
    setup(props, { emit }) {
        let payment = props.method;
        const paymentInfo = reactive({
            payment_method: "Venmo",
            venmo_address: payment.venmo_address,
        });

        const rules = computed(() => {
            return {
                venmo_address: {
                    required: helpers.withMessage("Enter an address", required),
                },
            };
        });

        const v$ = useVuelidate(rules, paymentInfo);

        function submit() {
            this.v$.$validate();
            if (this.v$.$error) {
                return;
            }
            emit('payment-updated', paymentInfo)
        }

        function cancelPayment() {
            emit('cancel-payment')
        }

        return {
            v$,
            paymentInfo,
            submit,
            cancelPayment
        };
    },
};
</script>
