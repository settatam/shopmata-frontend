<template>
    <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M0 5.00006L5 6.10352e-05L5.7 0.700061L1.4 5.00006L5.7 9.30006L5 10.0001L0 5.00006Z" :fill="fill || '#D3D3D9'"/>
    </svg>
</template>

<script>
export default {
    name: 'prev-icon',
    props: ['fill']
}
</script>
