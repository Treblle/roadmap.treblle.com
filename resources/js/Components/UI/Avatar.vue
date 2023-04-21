<script setup>
defineProps({
  url: {
    required: true,
    type: String,
  },
  alt: {
    required: true,
    type: String,
  },
});
</script>

<template>
  <img
    :src="url"
    :alt="alt"
    :title="alt"
    class="h-12 w-12 flex-none rounded-lg bg-gray-900 dark:bg-white object-cover ring-1 ring-gray-900/10 dark:ring-white/10"
  />
</template>
