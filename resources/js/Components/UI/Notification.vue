<script setup>
import {
  computed,
  ref,
} from "vue";
import {
  usePage
} from "@inertiajs/vue3";
import {
  BellAlertIcon,
  XMarkIcon,
} from "@heroicons/vue/24/outline";

const show = ref(true);

const notification = computed(() => usePage().props.flash.message);

const close = () => {
  show.value = false;
  notification.value = null;
};
</script>

<template>
  <div
    class="fixed inset-0 z-50 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end">
    <Transition
      appear
      enter-active-class="transform ease-out duration-300 transition"
      enter-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
      enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
      leave-active-class="transition ease-in duration-100"
      leave-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div v-if="notification && show" class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow-2xl ring-1 ring-black ring-opacity-5">
        <div class="p-4">
          <div class="flex items-start">
            <div class="flex-shrink-0">
              <BellAlertIcon class="h-6 w-6 text-blue-400" aria-hidden="true" />
            </div>
            <div class="ml-3 w-0 flex-1 pt-0.5">
              <p class="text-sm font-medium text-gray-900 dark:text-white">
                {{ notification.heading }}
              </p>
              <p class="mt-1 text-sm text-gray-500 dark:text-gray-100">
                {{ notification.contents }}
              </p>
            </div>
            <div class="ml-4 flex flex-shrink-0">
              <button type="button" v-on:click.prevent="close" class="inline-flex rounded-md bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:blue focus:ring-offset-2">
                <span class="sr-only">Close</span>
                <XMarkIcon class="h-5 w-5" aria-hidden="true" />
              </button>
            </div>
          </div>
        </div>
      </div>
    </Transition>
  </div>
</template>
