<script setup>
import {
  Link,
  useForm,
  usePage,
} from '@inertiajs/vue3';
import {
  Avatar,
  FormInput,
  FormLabel,
  FormError,
  FormSubmit,
} from "@/Components/UI";

defineProps({
  mustVerifyEmail: {
    type: Boolean,
  },
  status: {
    type: String,
  },
});

const user = usePage().props.auth.user.data;

const form = useForm({
  name: user.name,
  email: user.email,
});
</script>

<template>
  <form @submit.prevent="form.patch(route('profile:update'))">
    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:max-w-xl sm:grid-cols-6">
      <div class="col-span-full flex items-center gap-x-8">
        <Avatar
          :url="$page.props.auth.user.data.avatar"
          :alt="$page.props.auth.user.data.name"
        />
      </div>

      <div class="sm:col-span-3">
        <FormLabel for="name" value="Name" class="block text-sm font-medium leading-6 text-gray-800 dark:text-white" />
        <div class="mt-2">
          <FormInput
            id="name"
            type="text"
            class="block w-full rounded-md border-0 bg-white/5 dark:bg-gray-800/5 py-1.5 text-gray-800 dark:text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
            v-model="form.name"
            required
            autofocus
          />
          <FormError class="mt-2" :message="form.errors.name" />
        </div>
      </div>

      <div class="sm:col-span-3">
        <FormLabel for="email" value="Email Address" class="block text-sm font-medium leading-6 text-gray-800 dark:text-white" />
        <div class="mt-2">
          <FormInput
            id="email"
            type="email"
            class="block w-full rounded-md border-0 bg-white/5 dark:bg-gray-800/5 py-1.5 text-gray-800 dark:text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
            v-model="form.email"
            required
          />
          <FormError class="mt-2" :message="form.errors.email" />
        </div>
      </div>

      <div class="sm:col-span-3" v-if="mustVerifyEmail && user.email_verified_at === null">
        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">-->
          Your email address is unverified.
          <Link
            :href="route('verification.send')"
            method="post"
            as="button"
            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
          >
            Click here to re-send the verification email.
          </Link>
        </p>

        <div v-show="status === 'verification-link-sent'" class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
          A new verification link has been sent to your email address.
        </div>
      </div>
    </div>

    <div class="mt-8 flex space-x-4">
      <FormSubmit :disabled="form.processing">
        Update
      </FormSubmit>
      <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
        <p v-if="form.recentlySuccessful" class="text-gray-600 dark:text-gray-400">Updated.</p>
      </Transition>
    </div>
  </form>
</template>
