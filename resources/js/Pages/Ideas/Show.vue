<script setup>
import {
  CalendarDaysIcon,
  UserCircleIcon,
} from '@heroicons/vue/20/solid';
import {
  TagIcon,
} from '@heroicons/vue/24/outline';
import {
  Roadmap,
} from "@/Layouts";
import {
  Avatar,
  BadgeDot,
  Vote,
} from "@/Components/UI";

defineProps({
  idea: {
    required: true,
    type: Object,
  },
})
</script>

<template>
  <Roadmap>
    <header class="relative isolate pt-16">
      <div class="absolute inset-0 -z-10 overflow-hidden" aria-hidden="true">
        <div class="absolute left-0 top-0 transform-gpu opacity-50 blur-3xl">
          <div class="aspect-[1154/678] w-[72.125rem] bg-gradient-to-br from-indigo-400 to-purple-600"
               style="clip-path: polygon(100% 38.5%, 82.6% 100%, 60.2% 37.7%, 52.4% 32.1%, 47.5% 41.8%, 45.2% 65.6%, 27.5% 23.4%, 0.1% 35.3%, 17.9% 0%, 27.7% 23.4%, 76.2% 2.5%, 74.2% 56%, 100% 38.5%)"/>
        </div>
        <div class="absolute inset-x-0 bottom-0 h-px bg-gray-900/5"/>
      </div>

      <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto flex max-w-2xl items-center justify-between gap-x-8 lg:mx-0 lg:max-w-none">
          <div class="flex items-center gap-x-6">
            <Avatar :alt="idea.data.user.name" :url="idea.data.user.avatar"
                    class="h-16 w-16 flex-none rounded-full ring-1 ring-gray-900/10"/>
            <h1>
              <div class="text-sm leading-6 text-gray-500">
                Submitted by
                <span class="text-gray-700">
                  {{ idea.data.user.name }}
                </span>
              </div>
              <div class="mt-1 text-base font-semibold leading-6 text-gray-900">
                {{ idea.data.name }}
              </div>
            </h1>
          </div>
        </div>
      </div>
    </header>
    <section class="">

      <!-- Invoice summary -->
      <div class="lg:col-start-3 lg:row-end-1">
        <h2 class="sr-only">Summary</h2>
        <div class="rounded-lg bg-gray-50 dark:bg-gray-800 shadow-sm ring-1 ring-gray-900/5">
          <dl class="flex flex-wrap">
            <div class="flex-auto pl-6 pt-6">
              <dt class="text-sm font-semibold leading-6 text-gray-900">Votes</dt>
              <dd class="mt-1 text-base font-semibold leading-6 text-gray-900">{{ idea.data.votes }}</dd>
            </div>
            <div class="flex-none self-end px-6 pt-4">
              <dt class="sr-only">Status</dt>
              <dd
                class="rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-600 ring-1 ring-inset ring-green-600/20">
                {{ idea.data.status.name }}
              </dd>
            </div>
          </dl>
          <div class="mt-6 border-t border-gray-900/5 px-6 py-6">
            <template v-if="! idea.data.voted">
              <Vote :identifier="idea.data.id" />
            </template>
            <template v-else>
              <BadgeDot cursor="cursor-not-allowed">Already Voted</BadgeDot>
            </template>
          </div>
        </div>
      </div>
      <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div
          class="mx-auto grid max-w-2xl grid-cols-1 grid-rows-1 items-start gap-x-8 gap-y-8 lg:mx-0 lg:max-w-none lg:grid-cols-3">
          <div class="-mx-4 px-4 py-8 shadow-md ring-1 ring-gray-900/5 sm:mx-0 sm:rounded-lg sm:px-8 sm:pb-14 lg:col-span-2 lg:row-span-2 lg:row-end-2 xl:px-16 xl:pb-20 xl:pt-16">
            <h2 class="text-base font-semibold leading-6 text-gray-900">Description</h2>
            <dl class="mt-6 grid grid-cols-1 text-sm leading-6 sm:grid-cols-2">
              <div class="sm:pr-4">
                {{ idea.data.description }}
              </div>
            </dl>
          </div>

          <div class="-mx-4 px-4 py-8 shadow-md ring-1 ring-gray-900/5 sm:mx-0 sm:rounded-lg sm:px-8 lg:col-span-1 lg:row-span-1 lg:row-end-1 xl:px-16 xl:pt-16">
            <div class="flex w-full flex-none gap-x-4">
              <dt class="flex-none">
                <span class="sr-only">Submitted by</span>
                <UserCircleIcon class="h-6 w-5 text-gray-400" aria-hidden="true"/>
              </dt>
              <dd class="text-sm font-medium leading-6 text-gray-900">
                {{ idea.data.user.name }} ({{ idea.data.user.role.name }})
              </dd>
            </div>
            <div class="mt-4 flex w-full flex-none gap-x-4">
              <dt class="flex-none">
                <span class="sr-only">Submitted on</span>
                <CalendarDaysIcon class="h-6 w-5 text-gray-400" aria-hidden="true"/>
              </dt>
              <dd class="text-sm leading-6 text-gray-500">
                <time datetime="2023-01-31">{{ idea.data.created.human }}</time>
              </dd>
            </div>
            <div class="mt-4 flex w-full flex-none gap-x-4">
              <dt class="flex-none">
                <span class="sr-only">Category</span>
                <TagIcon class="h-6 w-5 text-gray-400" aria-hidden="true"/>
              </dt>
              <dd class="text-sm leading-6 text-gray-500">{{ idea.data.category.name }}</dd>
            </div>
          </div>

        </div>
      </div>
    </section>
  </Roadmap>
</template>
