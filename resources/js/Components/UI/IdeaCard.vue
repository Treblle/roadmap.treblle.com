<script setup>
import {
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
} from '@headlessui/vue'
import {
  EllipsisHorizontalIcon,
} from '@heroicons/vue/20/solid'
import {
  Avatar,
} from "@/Components/UI";
import { Link } from "@inertiajs/vue3";
import { vote } from "@/Composables/vote";

const props = defineProps({
  idea: {
    required: true,
    type: Object,
  }
});
const statuses = {
  SUBMITTED: 'text-green-600 bg-green-50 ring-green-600/20',
  UNDER_REVIEW: 'text-gray-500 bg-gray-50 ring-gray-200',
  IN_PROGRESS: 'text-red-600 bg-red-50 ring-red-600/10',
  LIVE: 'text-red-600 bg-red-50 ring-red-600/10',
}

const submit = () => {
  vote(props.idea.id)
};
</script>

<template>
  <li class="overflow-hidden rounded-xl border border-gray-400">
    <div class="flex items-center gap-x-4 border-b border-gray-900/5 dark:border-gray-50/5 bg-gray-50 dark:bg-gray-800 p-6">
      <Avatar
        :alt="idea.user.name"
        :url="idea.user.avatar"
      />
      <div class="text-sm font-medium leading-6 text-gray-900 dark:text-white">
        {{ idea.name }}
      </div>
      <Menu as="div" class="relative ml-auto">
        <MenuButton class="-m-2.5 block p-2.5 text-gray-400 hover:text-gray-500">
          <span class="sr-only">Open options</span>
          <EllipsisHorizontalIcon class="h-5 w-5" aria-hidden="true" />
        </MenuButton>
        <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
          <MenuItems class="absolute right-0 z-10 mt-0.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none">
            <MenuItem v-slot="{ active }">
              <Link :href="route('ideas:show', idea.id)" :class="[active ? 'bg-gray-50' : '', 'block px-3 py-1 text-sm leading-6 text-gray-900']">
                View<span class="sr-only">, {{ idea.name }}</span>
              </Link>
            </MenuItem>
            <MenuItem v-slot="{ active }" v-if="$page.props.auth.user">
              <template v-if="! idea.voted">
                <a
                  v-on:click.prevent="submit"
                  :class="[active ? 'bg-gray-50' : '', 'block px-3 py-1 text-sm leading-6 text-gray-900']"
                >
                  Upvote<span class="sr-only">, {{ idea.name }}</span>
                </a>
              </template>
              <template v-else>
                <a
                  aria-disabled="true"
                  :class="[active ? 'bg-gray-50' : '', 'block px-3 py-1 text-sm leading-6 text-gray-900 opacity-30 cursor-not-allowed']"
                >
                  Already voted
                </a>
              </template>
            </MenuItem>
          </MenuItems>
        </transition>
      </Menu>
    </div>
    <dl class="divide-y divide-gray-100 px-6 py-4 text-sm leading-6">
      <div class="flex justify-between gap-x-4 py-3">
        <dt class="text-gray-600 dark:text-gray-200">Status</dt>
        <dd class="flex items-start gap-x-2">
          <div :class="[statuses[idea.status], 'rounded-md py-1 px-2 text-xs font-medium ring-1 ring-inset']">
            {{ idea.status.name }}
          </div>
        </dd>
      </div>
      <div class="flex justify-between gap-x-4 py-3">
        <dt class="text-gray-600 dark:text-gray-200">Category</dt>
        <dd class="text-gray-700 dark:text-gray-100">
          <span>{{ idea.category.name }}</span>
        </dd>
      </div>
      <div class="flex justify-between gap-x-4 py-3">
        <dt class="text-gray-600 dark:text-gray-200">Submitted</dt>
        <dd class="text-gray-700 dark:text-gray-100">
          <time :datetime="idea.created.string">{{ idea.created.human }}</time>
        </dd>
      </div>
      <div class="flex justify-between gap-x-4 py-3">
        <dt class="text-gray-600 dark:text-gray-200">Votes</dt>
        <dd class="flex items-start gap-x-2">
          <div class="font-medium text-gray-700 dark:text-gray-100">{{ idea.votes }}</div>
        </dd>
      </div>
    </dl>
  </li>
</template>
