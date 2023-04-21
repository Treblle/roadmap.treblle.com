<script setup>
import {
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
} from '@headlessui/vue'
import {
  Link,
  useForm,
  usePage,
} from "@inertiajs/vue3";
import {
  Avatar
} from "@/Components/UI";

const form = useForm({})

const submit = () => {
  form.post(route('logout'), {
    preserveState: true,
    preserveScroll: true,
  })
};

const user = usePage().props.auth.user;
</script>

<template>
  <Menu as="div" class="relative border-b border-gray-800 dark:border-gray-100 py-4">
    <div>
      <MenuButton class="flex max-w-xl pr-4 items-center rounded-full bg-transparent text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 text-gray-400 hover:text-gray-600 dark:hover:text-white space-x-2">
        <span class="sr-only">Open user menu</span>
        <Avatar
          :url="user.data.avatar"
          :alt="user.data.name"
          :title="user.data.name"
          class="h-8 w-8 rounded-full"
        />
        <span>{{ user.data.name }}</span>
      </MenuButton>
    </div>
    <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
      <MenuItems class="absolute right-0 z-10 mt-2 w-48 origin-top-right divide-y divide-gray-200 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
        <div class="py-1">
          <MenuItem v-slot="{ active }">
            <Link
              :href="route('profile:edit')"
              :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']"
            >
              Profile
            </Link>
          </MenuItem>
        </div>
        <div class="py-1">
          <MenuItem v-slot="{ active }">
            <a
              v-on:click.prevent="submit"
              href="#"
              :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']"
            >
              Logout
            </a>
          </MenuItem>
        </div>
      </MenuItems>
    </transition>
  </Menu>
</template>
