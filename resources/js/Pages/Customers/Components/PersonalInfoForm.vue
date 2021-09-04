<template>
  <div class="w-full px-9">
    <div class="my-12">
      <p class="text-black font-semibold text-lg">Personal Information</p>
      <p class="text-gray-300">This information will be used to contact you</p>
    </div>
    <div class="">
      <div class="flex flex-wrap mb-10">
        <div class="form-group required w-full md:w-1/2 mb-6 md:pr-3 md:mb-0">
          <label
            class="block text-black font-semibold mb-2 bg-transparent"
            for="first_name"
          >
            First Name
          </label>
          <input
            type="text"
            name="email"
            id="email"
            class="
              shadow-sm
              focus:ring-indigo-500
              focus:border-indigo-500
              block
              w-full
              sm:text-sm
              border-gray-300
              rounded-md
            "
            placeholder="First Name"
            v-model="info.first_name"
          />
          
        </div>
        <div class="form-group required w-full md:w-1/2 mb-6 md:mb-0 md:pl-3">
          <label
            class="block text-black font-semibold mb-2 bg-transparent"
            for="last_name"
          >
            Last Name </label
          ><input
            type="text"
            name="email"
            id="email"
            class="
              shadow-sm
              focus:ring-indigo-500
              focus:border-indigo-500
              block
              w-full
              sm:text-sm
              border-gray-300
              rounded-md
            "
            placeholder="Last Name"
            v-model="info.last_name"
          />
        </div>
      </div>
      <div class="flex flex-wrap mb-10">
        <div class="form-group required w-full md:mb-0">
          <label
            class="block text-black font-semibold mb-2 bg-transparent"
            for="email"
          >
            Email
          </label>
          <input
            v-model="info.email"
            type="text"
            name="email"
            id="email"
            class="
              shadow-sm
              focus:ring-indigo-500
              focus:border-indigo-500
              block
              w-full
              sm:text-sm
              border-gray-300
              rounded-md
            "
            placeholder="you@example.com"
          />
        </div>
      </div>
      <div class="flex flex-wrap mb-10">
        <div class="form-group required w-full mb-6 md:mb-0">
          <label
            class="block text-black font-semibold mb-2 bg-transparent"
            for="phone_number"
          >
            Phone number
          </label>
          <div class="mt-1 relative rounded-md shadow-sm">
            <div class="absolute inset-y-0 left-0 flex items-center">
              <label for="country" class="sr-only">Country</label>
              <select
                id="country"
                name="country"
                class="
                  focus:ring-indigo-500
                  focus:border-indigo-500
                  h-full
                  py-0
                  pl-3
                  pr-7
                  border-transparent
                  bg-transparent
                  text-gray-500
                  sm:text-sm
                  rounded-md
                "
              >
                <option>US</option>
                <option>NG</option>
                <option>EU</option>
              </select>
            </div>
            <input
              v-model="info.phone_number"
              type="text"
              name="phone-number"
              id="phone-number"
              class="
                focus:ring-indigo-500
                focus:border-indigo-500
                block
                w-full
                pl-16
                sm:text-sm
                border-gray-300
                rounded-md
              "
              placeholder="+1 (555) 987-6543"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "personal-info-form",
  props: ["info"],
};
</script>