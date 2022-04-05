<template>
    <div class=" rounded-md py-8 bg-white px-8 lg:mx-2">
        <div class="my-4">
            <h1 class="font-bold text-2xl">
                Scans
            </h1>

            <h3>There are no scans</h3>
        </div>
    </div>
</template>

<script>
import { reactive, ref, computed } from '@vue/reactivity'
import AppLayout from '../../../Layouts/AppLayout.vue'

export default {
    components: { AppLayout,  }
}
</script>
