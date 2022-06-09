<template>
<app-layout :navigation="navigation"></app-layout>
    <div>
        <h1> this is an index page</h1>
        <a href="/stores/create">CREATE STORE</a>

    </div>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout.vue'

export default {
    components:{
        AppLayout
    },
    props: ['navigation'],
    setup() {
        return {}
    }
}
</script>