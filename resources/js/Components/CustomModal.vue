<template>
    <div>
        <t-modal
            v-model="showModal"
            :classes="classes"
        >
            <div class="flex justify-between items-center px-6" :class="styles.header">
                <p class="text-lg font-semibold my-6">
                    <slot name="header">Custom modal Header</slot>
                </p>
                <span @click="showModal=false" class="cursor-pointer"><img src="../../assets/ExitIcon.svg"></span>
            </div>
            
            <slot name="body">Custom Modal body</slot>
            <slot name="footer"></slot>
        </t-modal>
        <div @click="showModal = true">
            <slot name="trigger"></slot>
        </div>
    </div>
</template>

<script>
export default {
    props: ['styles', 'show'],
    data() {
        return {
            showModal: this.show,
            classes: {
                overlay: 'overflow-auto scrolling-touch left-0 top-0 bottom-0 right-0 w-full h-full fixed z-40 bg-black bg-opacity-50',
                // wrapper: 'relative z-50 w-62/100 px-4 py-12 ml-96',
                // modal: 'overflow-visible relative bg-white shadow rounded ml-32 py-6',
                wrapper: 'relative z-50 w-full md:w-62/100 px-4 py-12',
                modal: 'overflow-visible relative bg-white shadow rounded py-6',
                close: 'flex items-center justify-center',
            },
        }
    },
    methods: {
    }
}
</script>
<style scoped>
</style>