<template>
    <div class=" bg-white mt-7 mb-7 mx-auto rounded-md">
        <div class="rounded-t-md w-full bg-purple-darken p-4 text-white">
            <h1 class="text-xl">
                Payment Information <span class="cursor-pointer" @click="toggleEdit()"> [ Edit ]</span>
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
    </div>
</template>

<script>
import { ref } from 'vue'

export default {
    setup () {
        const isEdit = ref(false)
        function toggleEdit(){
            isEdit.value = !isEdit.value
        }

        return { isEdit, toggleEdit }
    }
}
</script>
