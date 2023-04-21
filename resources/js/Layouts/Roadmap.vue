<script setup>
import {
  ref,
} from 'vue'
import {
  Link, router,
} from "@inertiajs/vue3";
import {
  Dialog,
  DialogPanel,
  TransitionChild,
  TransitionRoot,
} from '@headlessui/vue'
import {
  XMarkIcon,
  LightBulbIcon,
  Cog8ToothIcon,
  UserCircleIcon,
  UserPlusIcon,
} from '@heroicons/vue/24/outline'
import {
  Bars3Icon,
  MagnifyingGlassIcon,
} from '@heroicons/vue/20/solid'
import {
  Avatar,
  Notification,
  UserMenu,
} from '@/Components/UI'

const navigation = [
  { name: 'Ideas', href: route('static:home'), icon: LightBulbIcon },
  { name: 'My Ideas', href: route('manage:ideas:index'), icon: LightBulbIcon },
  { name: 'API Tokens', href: route('manage:api:tokens:index'), icon: Cog8ToothIcon },
]

const sidebarOpen = ref(false)
</script>

<template>
  <div>
    <TransitionRoot as="template" :show="sidebarOpen">
      <Dialog as="div" class="relative z-50 xl:hidden" @close="sidebarOpen = false">
        <TransitionChild
          as="template"
          enter="transition-opacity ease-linear duration-300"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="transition-opacity ease-linear duration-300"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <div class="fixed inset-0 bg-gray-50/80 dark:bg-gray-900/80"/>
        </TransitionChild>

        <div class="fixed inset-0 flex">
          <TransitionChild
            as="template"
            enter="transition ease-in-out duration-300 transform"
            enter-from="-translate-x-full"
            enter-to="translate-x-0"
            leave="transition ease-in-out duration-300 transform"
            leave-from="translate-x-0"
            leave-to="-translate-x-full"
          >
            <DialogPanel class="relative mr-16 flex w-full max-w-xs flex-1">
              <TransitionChild
                as="template"
                enter="ease-in-out duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="ease-in-out duration-300"
                leave-from="opacity-100"
                leave-to="opacity-0"
              >
                <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                  <button type="button" class="-m-2.5 p-2.5" @click="sidebarOpen = false">
                    <span class="sr-only">Close sidebar</span>
                    <XMarkIcon class="h-6 w-6 text-gray-800 dark:text-white" aria-hidden="true"/>
                  </button>
                </div>
              </TransitionChild>
              <div
                class="flex grow flex-col gap-y-5 overflow-y-auto bg-gray-50 dark:bg-gray-900 px-6 ring-1 ring-gray-300/10 dark:ring-white/10">
                <div class="flex h-16 shrink-0 items-center">
                  <img
                    class="h-8 w-auto"
                    src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500"
                    alt="Your Company"
                  />
                </div>

                <template v-if="$page.props.auth.user">
                  <UserMenu />
                </template>

                <nav class="flex flex-1 flex-col">
                  <ul role="list" class="flex flex-1 flex-col gap-y-7">
                    <li>
                      <ul role="list" class="-mx-2 space-y-1">
                        <template v-if="! $page.props.auth.user">
                          <li>
                            <Link
                              :href="route('login')"
                              title="Log in"
                              class="text-gray-400 hover:text-gray-600 dark:hover:text-white hover:bg-gray-800 dark:hover:bg-gray-400 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold"
                            >
                              <UserCircleIcon class="h-6 w-6 shrink-0" aria-hidden="true" />
                              <span>Log In</span>
                            </Link>
                          </li>
                          <li>
                            <Link
                              :href="route('register')"
                              title="Register"
                              class="text-gray-400 hover:text-gray-600 dark:hover:text-white hover:bg-gray-800 dark:hover:bg-gray-400 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold"
                            >
                              <UserPlusIcon class="h-6 w-6 shrink-0" aria-hidden="true" />
                              <span>Register</span>
                            </Link>
                          </li>
                        </template>
                        <li v-for="item in navigation" :key="item.name">
                          <Link
                            :href="item.href"
                            :title="`Visit ${item.name}`"
                            class="text-gray-400 hover:text-gray-600 dark:hover:text-white hover:bg-gray-800 dark:hover:bg-gray-400 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold"
                          >
                            <component :is="item.icon" class="h-6 w-6 shrink-0" aria-hidden="true"/>
                            <span>{{ item.name }}</span>
                          </Link>
                        </li>
                      </ul>
                    </li>
                    <template v-if="$page.props.auth.user">
                      <li class="-mx-6 mt-auto">
                        <Link
                          :href="route('profile:edit')"
                          class="flex items-center gap-x-4 px-6 py-3 text-sm font-semibold leading-6 text-white hover:bg-gray-800"
                        >
                          <Avatar
                            :url="$page.props.auth.user.data.avatar"
                            :alt="$page.props.auth.user.data.name"
                          />
                          <span class="sr-only">Your profile</span>
                          <span aria-hidden="true">{{ $page.props.auth.user.data.name }}</span>
                        </Link>
                      </li>
                    </template>
                  </ul>
                </nav>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </Dialog>
    </TransitionRoot>

    <!-- Static sidebar for desktop -->
    <div class="hidden xl:fixed xl:inset-y-0 xl:z-50 xl:flex xl:w-72 xl:flex-col">
      <!-- Sidebar component, swap this element with another sidebar if you like -->
      <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-black/10 px-6 ring-1 ring-white/5">
        <div class="flex h-16 shrink-0 items-center">
          <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500"
               alt="Your Company"/>
        </div>
        <nav class="flex flex-1 flex-col">
          <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
              <ul role="list" class="-mx-2 space-y-1">
                <li v-for="item in navigation" :key="item.name">
                  <Link
                    :href="item.href"
                    onclick="e.prevent"
                    :class="[item.current ? 'bg-gray-800 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800', 'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold']"
                    :title="`Visit ${item.name}`"
                  >
                    <component :is="item.icon" class="h-6 w-6 shrink-0" aria-hidden="true"/>
                    <span>{{ item.name }}</span>
                  </Link>
                </li>
              </ul>
            </li>
            <template v-if="$page.props.auth.user">
              <li class="-mx-6 mt-auto">
                <Link :href="route('profile:edit')"
                      class="flex items-center gap-x-4 px-6 py-3 text-sm font-semibold leading-6 text-gray-800 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-800">
                  <Avatar
                    class="h-8 w-8 rounded-full bg-gray-100 dark:bg-gray-800"
                    :url="$page.props.auth.user.data.avatar"
                    :alt="$page.props.auth.user.data.name"
                  />
                  <span class="sr-only">Your profile</span>
                  <span aria-hidden="true">{{ $page.props.auth.user.data.name }}</span>
                </Link>
              </li>
            </template>
          </ul>
        </nav>
      </div>
    </div>

    <div class="xl:pl-72">
      <!-- Sticky search header -->
      <div
        class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-6 border-b border-gray-700/5 dark:border-white/5 bg-white dark:bg-gray-900 px-4 shadow-sm sm:px-6 lg:px-8">
        <button type="button" class="-m-2.5 p-2.5 text-gray-900 dark:text-white xl:hidden" @click="sidebarOpen = true">
          <span class="sr-only">Open sidebar</span>
          <Bars3Icon class="h-5 w-5" aria-hidden="true"/>
        </button>

        <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
          <form class="flex flex-1" action="#" method="GET">
            <label for="search-field" class="sr-only">Search</label>
            <div class="relative w-full">
              <MagnifyingGlassIcon class="pointer-events-none absolute inset-y-0 left-0 h-full w-5 text-gray-500"
                                   aria-hidden="true"/>
              <input id="search-field"
                     class="block h-full w-full border-0 bg-transparent py-0 pl-8 pr-0 text-gray-900 dark:text-white focus:ring-0 sm:text-sm"
                     placeholder="Search..." type="search" name="search"/>
            </div>
          </form>
        </div>
      </div>

      <main>
        <slot/>
      </main>

    </div>

    <Notification />
  </div>
</template>
