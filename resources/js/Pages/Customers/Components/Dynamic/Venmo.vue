<template>
    <div class=" px-4 space-y-3 w-full pb-4">
        <div class="flex flex-col space-y-2  space-y-2">
            <label
                class="font-semibold mt-2 w-full bg-transparent"
                for="payable_to"
                >PAYABLE TO:</label
            >
            <input
                :class="{
                    'border-red-600': v$.payable_to.$error,
                    'border-gray-300': !v$.payable_to.$error
                }"
                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                type="text"
                v-model="paymentInfo.payable_to"
                placeholder="Make check payable to"
            />
        </div>
        <div class="mt-1">
            <p class="text-red-600 text-xs" v-if="v$.payable_to.$error">
                {{ v$.payable_to.$errors[0].$message }}
            </p>
        </div>

        <div class="flex flex-col space-y-2 space-y-2">
            <label
                class="font-semibold mt-2 w-full bg-transparent"
                for="address"
                >ADDRESS:</label
            >
            <input
                :class="{
                    'border-red-600': v$.address.$error,
                    'border-gray-300': !v$.address.$error
                }"
                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500  w-full sm:text-sm border-gray-300 rounded-md"
                type="text"
                v-model="paymentInfo.address"
                placeholder="Send Check to this Street"
            />
        </div>
        <div class="mt-1">
            <p class="text-red-600 text-xs" v-if="v$.address.$error">
                {{ v$.address.$errors[0].$message }}
            </p>
        </div>

        <div class="flex flex-col space-y-2 ">
            <label class="font-semibold mt-2 w-full bg-transparent" for="city"
                >CITY:</label
            >
            <input
                :class="{
                    'border-red-600': v$.city.$error,
                    'border-gray-300': !v$.city.$error
                }"
                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500  w-full sm:text-sm border-gray-300 rounded-md"
                type="text"
                v-model="paymentInfo.city"
                placeholder="city"
            />
        </div>
        <div class="mt-1">
            <p class="text-red-600 text-xs" v-if="v$.city.$error">
                {{ v$.city.$errors[0].$message }}
            </p>
        </div>

        <div class="flex flex-col space-y-2 ">
            <label
                class="font-semibold mt-2 w-full bg-transparent"
                for="state_id"
                >STATE:</label
            >
            <select
                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 w-full sm:text-sm border-gray-300 rounded-md"
                name="state"
                id=""
                v-model="paymentInfo.state_id"
                :class="{
                    'border-red-600': v$.state_id.$error,
                    'border-gray-300': !v$.state_id.$error
                }"
            >
                <option value="choose">State/Province</option>
            </select>
        </div>
        <div class="mt-1">
            <p class="text-red-600 text-xs" v-if="v$.state_id.$error">
                {{ v$.state_id.$errors[0].$message }}
            </p>
        </div>

        <div class="flex flex-col space-y-2 ">
            <label class="font-semibold w-full mt-2 bg-transparent" for="zip"
                >ZIP:</label
            >
            <input
                :class="{
                    'border-red-600': v$.zip.$error,
                    'border-gray-300': !v$.zip.$error
                }"
                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500  w-full sm:text-sm border-gray-300 rounded-md"
                type="text"
                v-model="paymentInfo.zip"
                placeholder="Zip/Postal"
            />
        </div>
        <div class="mt-1">
            <p class="text-red-600 text-xs" v-if="v$.zip.$error">
                {{ v$.zip.$errors[0].$message }}
            </p>
        </div>

        <!-- submit -->
        <div class="flex justify-between w-2/3 mx-auto mb-9">
            <div class="">
                <button
                    class="text-gray-400 bg-gray-100 border border-gray-400 rounded-md px-6 py-3"
                >
                    Cancel
                </button>
            </div>
            <div class="">
                <button
                    v-if="!v$.$error"
                    :disabled="loading"
                    type="submit"
                    :class="{
                        disabled: loading,
                        'opacity-25 cursor-not-allowed': loading
                    }"
                    class="disabled:bg-gray-400 w-full flex justify-center py-3 px-12 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    @click="submit"
                >
                    <LoadingSpinner v-if="loading" />
                    Save
                </button>

                <!-- else -->
                <button
                    v-else
                    type="button"
                    class="bg-indigo-600 text-white rounded-md px-8 py-3"
                >
                    Save
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, reactive, computed } from 'vue'
import {
    required,
    maxLength,
    numeric,
    helpers,
    email
} from '@vuelidate/validators'
import useVuelidate from '@vuelidate/core'
import LoadingSpinner from '../../../../Components/LoadingSpinner.vue'

export default {
    components: {
        LoadingSpinner
    },
    setup () {
        const loading = ref(false)
        const paymentInfo = reactive({
            payment_method: 'check',
            payable_to: '',
            address: '',
            city: '',
            state_id: '',
            zip: ''
        })

        const rules = computed(() => {
            return {
                payable_to: {
                    required: helpers.withMessage('Enter an address', required)
                },
                address: {
                    required: helpers.withMessage('Enter an address', required)
                },
                city: {
                    required: helpers.withMessage('Enter a city', required)
                },
                state_id: {
                    required: helpers.withMessage('Select a state', required)
                },
                zip: {
                    required: helpers.withMessage(
                        'Enter a postal code',
                        required
                    )
                }
            }
        })

        const v$ = useVuelidate(rules, paymentInfo)

        function submit () {
            this.v$.$validate()
            if (this.v$.$error) {
                return
            }
            loading.value = true
            axios
                .put(``, paymentInfo)
                .then(res => {
                    successMessage.value = res.data.message
                    setTimeout(onClickTop, 2000)
                })
                .catch(error => {
                    loading.value = false
                    successMessage.value = 'Error processing your request'
                    setTimeout(onClickBot, 2000)
                })
        }

        return {
            v$,
            paymentInfo,
            loading,
            submit
        }
    }
}
</script>
