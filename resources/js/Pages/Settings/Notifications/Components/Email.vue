<template>
    <div class="flex-1 max-h-screen xl:overflow-y-auto">
              <div class="w-auto  lg:ml-7 lg:mr-2">
                  <div class="flex justify-between items-center mb-2 lg:mb-0 ">
                    <div class="flex font-semibold items-center">
                        <inertia-link href="/admin/settings/notifications">
                          <arrow-left-icon class="w-5 h-5 mr-5"/>
                        </inertia-link>
                        <p class="text-base lg:text-2xl">{{notification.name}}</p>
                    </div>
                    <div class="flex items-center mb-0 lg:mb-5">
                        <div class="text-indigo-700 mr-7 hidden lg:flex" >
                            <EyeIcon class="w-5 h-5 font-semibold mr-2.5"/> <p> Preview </p>
                        </div>
                        <button type="button" class=" disabled:bg-gray-400 rounded-md border border-transparent shadow-sm px-4 lg:px-7 py-3 text-xs  lg:text-base font-medium text-white sm:text-sm" :class="order.subject.length>1 && order.message.length>1 ? 'bg-indigo-600': 'bg-gray-400' " :disabled='loading'  @click="submit" >
                        <i class="fas fa-spinner fa-pulse text-white m-2" v-if="loading"></i>{{save}}
                        </button>
                    </div>
                  </div>
                  <div class="px-4 md:px-8 pb-8 pt-6  mb-6 bg-white">
                    <h1 class="text-xl font-bold">Email</h1>
                        <div class="w-auto relative">
                            <label class="block mt-4 mb-2 bg-transparent">
                                Email subject
                            </label>
                            <input type="text"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" :placeholder="order.subject" v-model.trim="order.subject" required/>
                            <error-icon class="absolute top-11 right-2.5" v-show="subjectError"/>
                        </div>
                        <div class="w-auto relative">
                            <label class="block mt-4 mb-2 bg-transparent">
                                Email body (HTML)
                            </label>
                            <textarea  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm  border-gray-300 h-96 rounded-md"  v-model.trim="order.message" required></textarea>
                            <error-icon class="absolute top-1 left-40" v-show="bodyError "/>
                        </div>
                  </div>
                  <div class=" flex justify-between">
                    <button type="button" class=" rounded-md border border-gray-500 mr-4 shadow-sm px-3 lg:px-5 py-1.5 lg:py-3 bg-transparent text-base font-medium text-gray-500 focus:outline-none  sm:text-sm" >
                        Back to default
                    </button>
                    <button type="button" class=" rounded-md border border-transparent shadow-sm px-4 lg:px-7 py-3 text-xs  lg:text-base font-medium text-white focus:outline-none sm:text-sm disabled:bg-gray-400" :class="order.subject.length>1 && order.message.length>1 ? 'bg-indigo-600': 'bg-gray-400' " :disabled='loading' @click="submit" >
                        <i class="fas fa-spinner fa-pulse text-white m-1" v-if="loading"></i>{{save}}
                    </button>
                </div>
              </div>
              <NotificationGroup group="top" position="top" >
                <div class="fixed inset-0 mt-8 flex items-start justify-end p-6 px-4 py-6 pointer-events-none">
                    <div class="w-full max-w-sm">
                    <Notification
                        v-slot="{ notifications, close }"
                        enter="transform ease-out duration-300 transition"
                        enter-from="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
                        enter-to="translate-y-0 opacity-100 sm:translate-x-0"
                        leave="transition ease-in duration-500"
                        leave-from="opacity-100"
                        leave-to="opacity-0"
                        move="transition duration-500"
                        move-delay="delay-300"
                    >
                        <div
                        class="w-full max-w-sm mt-4 overflow-hidden bg-white rounded-lg shadow-lg pointer-events-auto ring-1 ring-black ring-opacity-5"
                        v-for="notification in notifications"
                        :key="notification.id"
                        >
                        <div class="p-4">
                            <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                <p class="font-semibold text-gray-800">{{ notification.title }}</p>
                                <p class="text-sm font-semibold text-gray-500">{{ notification.text }}</p>
                            </div>
                            <div class="flex flex-shrink-0 ml-4">
                                <button @click="close(notification.id)" class="inline-flex text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                                <span class="sr-only">Close</span>
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                                </button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </Notification>
                    </div>
                </div>
                </NotificationGroup>

                <NotificationGroup group="bottom" position="top">
                <div class="fixed inset-0 mt-8 flex items-start justify-end p-6 px-4 py-6 pointer-events-none">
                    <div class="w-full max-w-sm">
                    <Notification
                        v-slot="{ notifications }"
                        enter="transform ease-out duration-300 transition"
                        enter-from="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
                        enter-to="translate-y-0 opacity-100 sm:translate-x-0"
                        leave="transition ease-in duration-500"
                        leave-from="opacity-100"
                        leave-to="opacity-0"
                        move="transition duration-500"
                        move-delay="delay-300"
                    >
                        <div
                        class="flex w-full max-w-sm mx-auto mt-4 overflow-hidden bg-white rounded-lg shadow-md"
                        v-for="notification in notifications"
                        :key="notification.id"
                        >
                        <div class="flex items-center justify-center w-12 bg-red-500">
                            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z"
                            ></path>
                            </svg>
                        </div>

                        <div class="px-4 py-2 -mx-3">
                            <div class="mx-3">
                            <span class="font-semibold text-red-500">{{notification.title}}</span>
                            <p class="text-sm text-gray-600">{{notification.text}}</p>
                            </div>
                        </div>
                        </div>
                    </Notification>
                    </div>
                </div>
                </NotificationGroup>
            </div>

</template>

<script>
export default {
    props: ['notification']
}
</script>
