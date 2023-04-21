<script setup>
import {
  Roadmap,
} from "@/Layouts";
import {
  Container,
  FormError,
  FormInput,
  FormLabel,
  FormTextArea,
} from '@/Components/UI';
import {
  useForm,
} from "@inertiajs/vue3";

const form = useForm({
  name: '',
  description: '',
  category: ','
});

const submit = () => {
  form.post(route('ideas:store'), {
    preserveScroll: true,
    preserveState: true,
  })
}
</script>

<template>
  <Roadmap
    :categories="$page.props.categories"
  >
    <Container>
      <form @submit.prevent="submit">
        <div class="space-y-12">
          <div class="border-b border-white/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900 dark:text-white">
              Create new Idea
            </h2>
            <p class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-400">
              Use this form to submit an idea for consideration.
            </p>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="sm:col-span-4">
                <FormLabel class="block text-sm font-medium leading-6 text-gray-900 dark:text-white" for="name" value="Name" />
                <div class="mt-2">
                  <div
                    class="flex rounded-md bg-white/5 ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                    <FormInput
                      type="text"
                      name="name"
                      id="name"
                      v-model="form.name"
                      class="flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-600 dark:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                      placeholder="Give your idea a simple name."
                    />
                  </div>

                  <FormError class="mt-2" :message="form.errors.name" />
                </div>
              </div>

              <div class="col-span-full">
                <FormLabel class="block text-sm font-medium leading-6 text-gray-900 dark:text-white" for="description" value="Description" />
                <div class="mt-2">
                  <FormTextArea
                    id="description"
                    name="description"
                    v-model="form.description"
                    :rows="3"
                    class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-gray-600 dark:text-gray-400 shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
                  />

                  <FormError class="mt-2" :message="form.errors.description" />
                </div>
                <p class="mt-3 text-sm leading-6 text-gray-600 dark:text-gray-400">Write a few sentences about yourself.</p>
              </div>

              <div class="sm:col-span-3">
                <FormLabel class="block text-sm font-medium leading-6 text-gray-900 dark:text-white" for="category" value="Category" />
                <div class="mt-2">
                  <select
                    id="category"
                    name="category"
                    v-model="form.category"
                    class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-gray-600 dark:text-gray-400 shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
                  >
                    <option value>Please select ...</option>
                    <option v-for="(category, index) in $page.props.categories" :key="index" :value="category.name">
                      {{ category.value }} ({{ category.description }})
                    </option>
                  </select>
                  <FormError class="mt-2" :message="form.errors.category" />
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
          <button
            type="submit"
            class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-gray-600 dark:text-gray-400 shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500"
          >
            Create
          </button>
        </div>
      </form>
    </Container>
  </Roadmap>
</template>
