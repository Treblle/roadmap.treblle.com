<script setup>
import { vote } from "@/Composables/vote";

const props = defineProps({
  identifier: {
    required: true,
    type: String,
  }
})

const submit = () => {
  vote(props.identifier)
};
</script>

<template>
  <button
    v-on:click.prevent="submit"
    type="button"
    class="text-sm font-semibold leading-6 text-gray-900"
  >
    Add Vote <span aria-hidden="true">&rarr;</span>
  </button>
</template>
