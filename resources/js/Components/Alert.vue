<template>
  <div class="pb-4">
    <div
      class=" border rounded-b text-green-900 px-4 py-3 shadow-md"
      role="alert"
      :class="{ 'bg-green-100 border-green-400 ': notification.type === 'success', 'errorClass': notification.type !== 'success' }"
    >
      <div class="flex">
        <div class="py-1">
            <!-- success -->
          <i class="fas fa-check-circle pr-4" v-if="notification.type === 'success'"></i>

          <!-- failure -->
          <svg
            class="fill-current h-6 w-6 text-green-500 mr-4 white"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
            v-else
          >
            <path
              d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"
            />
          </svg>

        </div>
        <div>
          <p class="font-bold">{{ notification.title }}</p>
          <p class="text-sm">
            {{ notification.message }}
          </p>
          <p v-if="notification.validationErrors">
            <span v-for="val, index in notification.validationErrors" :key="index">
              {{ val[0] }} 
            </span>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    notification: Object,
  },
  
};
</script>
<style scoped>
  .errorClass{
    background-color: #ff3636f5;
    color: #fff;
    border-color: #ff3636f5;
  }
  .white {
    color: white;
  }
</style>