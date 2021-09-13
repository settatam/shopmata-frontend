<template>
  <div class="min-h-screen bg-white flex">
    <div class="hidden lg:block lg:w-1/2 relative w-0 lg:bg-indigo-700" />
    <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 lg:w-1/2">
      <div class="mx-auto w-full">
        <div>
          <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
            Let's Get Started
          </h2>
          <p class="mt-2 text-sm text-gray-600">
            Or
            {{ ' ' }}
            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
              start your 14-day free trial
            </a>
          </p>
        </div>

        <div class="mt-8">
          <div>
            <div>
              <p class="text-sm font-medium text-gray-700">
                Sign in with
              </p>

            </div>

            <div class="mt-6 relative">
              <div class="absolute inset-0 flex items-center" aria-hidden="true">

              </div>
            </div>
          </div>

          <div class="mt-6">
            <form action="#" method="POST" class="space-y-6" v-on:submit.prevent="loginUser">
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700">
                  Email address
                </label>
                <div class="mt-1 relative rounded-md shadow-sm">
                  <input id="email" name="email" type="email" autocomplete="email" required="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="user.email"/>
                  <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                      <svg class="h-5 w-5 text-red-500" x-description="Heroicon name: solid/exclamation-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                  </div>
                </div>
              </div>
              <div class="flex">
                <div class="lg:w-1/2 md:w-1/2">
                  <label for="first_name" class="block text-sm font-medium text-gray-700">
                    First Name
                  </label>
                  <div class="mt-1 relative rounded-md shadow-sm mr-4">
                    <input id="first_name" name="email" type="email" autocomplete="email" required="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="user.first_name"/>
                  </div>
                </div>
                <div class="lg:w-1/2 md:w-1/2">
                  <label for="last_name" class="block text-sm font-medium text-gray-700">
                    Last Name
                  </label>
                  <div class="mt-1 relative rounded-md shadow-sm">
                    <input id="last_name" name="email" type="email" autocomplete="email" required="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="user.last_name"/>
                  </div>
                </div>
              </div>

              <div class="space-y-1">
                <label for="password" class="block text-sm font-medium text-gray-700">
                  Password
                </label>
                <div class="mt-1">
                  <input id="password" name="password" type="password" autocomplete="current-password" required="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="user.password"/>
                </div>
              </div>

              <div class="space-y-1">
                <label for="confirm_password" class="block text-sm font-medium text-gray-700">
                  Confirm Password
                </label>
                <div class="mt-1">
                  <input id="confirm_password" name="confirm_password" type="password" autocomplete="current-password" required="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="user.confirm_password"/>
                </div>
              </div>

              <div class="flex items-center justify-between">
                <div class="text-sm">
                  <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                    Already have an account? Log In
                  </a>
                </div>
              </div>

              <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  Sign in
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      loading: false,
      notification: null,
      show: false,
      user: {
        email: "",
        password: "",
      },
      selectStore: false,
      stores: [],
      search: "",
    };
  },
  methods: {
    async registerUser() {
      this.loading = true;
      try {
        const res = await axios.post("/register", { ...this.user});
        const { notification, storeCount, stores } = res.data;
        if (storeCount > 1) {
          this.stores = stores;
          this.selectStore = true;
        } else {
          this.notification = notification;
          // window.location.href = "/dashboard";
        }
      } catch (error) {
        console.log(error);
        const { notification } = error.response.data;
        this.notification = notification;
        this.loading = false;
      }
    },
    toggleShow() {
      this.show = !this.show;
    },
  },
};
</script>
