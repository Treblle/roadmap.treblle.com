<script setup>
defineProps({
  color: {
    required: false,
    type: String,
    default: 'green',
  },
  cursor: {
    required: false,
    type: String,
    default: 'cursor-pointer'
  }
})
</script>

<template>
  <span :class="`inline-flex items-center gap-x-2.5 rounded-md px-3 py-1.5 text-md shadow-sm font-medium text-gray-900 ring-1 ring-inset ring-gray-200 ${cursor}`">
    <svg :class="`h-1.5 w-1.5 fill-${color}-500 shadow-sm`" viewBox="0 0 6 6" aria-hidden="true">
      <circle cx="3" cy="3" r="3" />
    </svg>
    <slot />
  </span>
</template>
