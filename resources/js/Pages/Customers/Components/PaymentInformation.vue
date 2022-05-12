<template>
    <div class=" bg-white mt-7 mb-7 mx-auto rounded-md">
        <div class="rounded-t-md w-full bg-purple-darken p-4 text-white">
            <h1 class="text-xl">
                Payment Information
                <span class="cursor-pointer" @click="toggleEdit()">
                    [ Edit ]</span
                >
            </h1>
        </div>

        <div v-if="!isEdit" class="p-6 space-y-3 text-gray-lighter">
            <p>IS LOAN:</p>
            <p>PAY METHOD:</p>
            <p>
                BANK NAME:
            </p>
            <p>ROUTING NUMBER:</p>
            <p>ACCOUNT NUMBER:</p>
            <p>ACCOUNT NAME:</p>
            <p>ACCOUNT TYPE:</p>
        </div>

        <div v-else>
            <div class="p-6 space-x-2">
                <label class="font-semibold mb-1 bg-transparent" for="pay_method">PAY METHOD:</label>
                <select class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 w-fit sm:text-sm border-gray-300 rounded-md" name="pay_method" id="" v-model="payment_method">
                    <option value="choose">Choose Method</option>
                    <option value="check">Check</option>
                    <option value="paypal">PayPal</option>
                    <option value="ach">ACH</option>
                    <option value="venmo">Venmo</option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue'

export default {
    setup () {
        const isEdit = ref(false)
        function toggleEdit () {
            isEdit.value = !isEdit.value
        }

        const payment_method = ref('choose')

        return { isEdit, toggleEdit, payment_method }
    }
}
</script>
