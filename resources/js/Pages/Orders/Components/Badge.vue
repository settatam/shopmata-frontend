<template>
    <p class="text-xs py-2 px-3 mb-1 cursor-pointer" :class="primary ? 'bg-green-medium text-white' :  'bg-gray-300 text-gray-400'" @click="toggled"><slot>A badge</slot></p>
</template>
<script>
export default {
    props: ['primary'],
    methods: {
        toggled () {
            this.$emit('toggled')
        }
    }
}
</script>