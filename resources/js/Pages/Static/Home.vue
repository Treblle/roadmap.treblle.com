<script setup>
import { Roadmap } from '@/Layouts';
import {IdeaCard} from "@/Components/UI";
import { Link } from "@inertiajs/vue3";

defineProps({
  ideas: {
    required: true,
    type: Object
  },
});
</script>

<template>
  <Roadmap>
    <section>
      <header class="flex items-center justify-between border-b border-gray-800/5 dark:border-white/5 px-4 py-4 sm:px-6 sm:py-6 lg:px-8">
        <h1 class="text-base font-semibold leading-7 text-gray-900 dark:text-white">
          Ideas
        </h1>

        <div class="relative">
          <Link
            :href="route('ideas:create')"
            title="Add your Idea"
            class="ml-3 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
          >
            Create Idea
          </Link>
        </div>

      </header>

      <section class="px-2 py-4">
        <ul role="list" class="grid grid-cols-1 gap-x-6 gap-y-8 lg:grid-cols-3 xl:gap-x-8">
          <IdeaCard v-for="idea in ideas.data" :key="idea.id" :idea="idea" />
        </ul>
      </section>
    </section>

  </Roadmap>
</template>
