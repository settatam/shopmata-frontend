<template>
    <div v-show="isActive">
        <slot></slot>
    </div>
</template>

<script>
export default {
    props: {
        name: { required: true },
        selected: { default: false},
        parent: {default: ''},
        default:  {default: false},
        label: { type: String }
    },
    
    data() {
        return {
            isActive: false
        };
    },
    
    computed: {
        href() {
            return (this.parent && !this.default) ? this.parent + '/' + this.name.toLowerCase().replace(/ /g, '-') : '';
        }
    },
    
    mounted() {
        this.isActive = this.selected;
    }
}
</script>