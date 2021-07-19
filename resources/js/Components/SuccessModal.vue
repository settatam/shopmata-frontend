<template>
    <t-modal name="success-modal" :classes="classes">
        <div class="flex justify-end px-6 cursor-pointer" @click="close">
            <img src="../../assets/modal-close.svg" alt="close-icon" />
        </div>
        <slot name="custom-body"></slot>
    </t-modal>
</template>

<script>
export default {
    props: {
        opened: Function
    },
    data() {
        return{
            open: true,
            classes: {
                overlay: 'overflow-auto scrolling-touch left-0 top-0 bottom-0 right-0 w-full h-full fixed z-40 bg-purple-darker bg-opacity-20',
                wrapper: 'relative mx-auto z-50 max-w-2xl py-8 mt-40',
                modal: 'bg-white shadow',
                // wrapper: 'relative z-50 w-full md:w-62/100 px-4 py-12',
                // modal: 'overflow-visible relative bg-white shadow rounded py-6',
                // close: 'flex items-center justify-center',
            }
        }
    },
    methods: {
        close() {
            this.$emit("closeModal");
        }
    }
}
</script>

<style>

</style>