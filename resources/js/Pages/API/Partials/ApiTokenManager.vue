<script setup>
import {computed, ref} from 'vue';
import {useForm, usePage} from '@inertiajs/vue3';
import {
  ActionMessage,
  Border,
  Box,
  ConfirmationModal,
  Danger,
  DialogModal,
  FormCheckbox,
  FormError,
  FormInput,
  FormLabel,
  FormSection,
  FormSubmit,
  Secondary,
} from "@/Components/UI";

const props = defineProps({
  tokens: Object,
  availablePermissions: Object,
});

const createApiTokenForm = useForm({
  name: '',
  permissions: [],
});

const updateApiTokenForm = useForm({
  permissions: [],
});

const deleteApiTokenForm = useForm({});

const managingPermissionsFor = ref(null);
const apiTokenBeingDeleted = ref(null);

const createApiToken = () => {
  createApiTokenForm.post(route('manage:api:tokens:store'), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => {
      createApiTokenForm.reset();
    },
  });
};

const manageApiTokenPermissions = (token) => {
  updateApiTokenForm.permissions = token.abilities;
  managingPermissionsFor.value = token;
};

const updateApiToken = () => {
  updateApiTokenForm.put(route('manage:api:tokens:update', managingPermissionsFor.value), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => managingPermissionsFor.value = null,
  });
};

const confirmApiTokenDeletion = (token) => {
  apiTokenBeingDeleted.value = token;
};

const deleteApiToken = () => {
  deleteApiTokenForm.delete(route('manage:api:tokens:delete', apiTokenBeingDeleted.value), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => (apiTokenBeingDeleted.value = null),
  });
};
</script>

<template>
  <div>
    <!-- Generate API Token -->
    <FormSection @submitted="createApiToken">
      <template #title>
        Create API Token
      </template>

      <template #description>
        API tokens allow third-party services to authenticate with our application on your behalf.
      </template>

      <template #form>
        <!-- Token Name -->
        <div class="col-span-6 sm:col-span-4">
          <FormLabel for="name" value="Name"/>
          <FormInput
            id="name"
            v-model="createApiTokenForm.name"
            type="text"
            class="mt-1 block w-full"
            autofocus
          />
          <FormError :message="createApiTokenForm.errors.name" class="mt-2"/>
        </div>

        <!-- Token Permissions -->
        <div v-if="availablePermissions.data.length > 0" class="col-span-6">
          <FormLabel for="permissions" value="Permissions"/>

          <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div v-for="permission in availablePermissions.data" :key="permission.key">
              <div class="relative flex items-start">
                <div class="flex h-6 items-center">
                  <FormCheckbox
                    v-model:checked="createApiTokenForm.permissions"
                    :value="permission.key"
                    :for="permission.name"
                    :id="permission.name"
                    :aria-describedby="`${permission.name}-description`"
                    :name="permission.name"
                  />
                </div>
                <div class="ml-3 text-sm leading-6">
                  <label :for="permission.name" class="font-medium text-gray-900 dark:text-white">
                    {{ permission.name }}
                  </label>
                  <p :id="`${permission.name}-description`" class="text-gray-600 dark:text-gray-400">
                    {{ permission.description }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </template>

      <template #actions>
        <ActionMessage :on="createApiTokenForm.recentlySuccessful" class="mr-3">
          Created.
        </ActionMessage>

        <FormSubmit :class="{ 'opacity-25': createApiTokenForm.processing }" :disabled="createApiTokenForm.processing">
          Create
        </FormSubmit>
      </template>
    </FormSection>

    <div v-if="tokens.length > 0">
      <Border/>

      <!-- Manage API Tokens -->
      <div class="mt-10 sm:mt-0">
        <Box>
          <template #title>
            Manage API Tokens
          </template>

          <template #description>
            You may delete any of your existing tokens if they are no longer needed.
          </template>

          <!-- API Token List -->
          <template #content>
            <div class="space-y-6">
              <div v-for="token in tokens" :key="token.id" class="flex items-center justify-between">
                <div class="break-all dark:text-white">
                  {{ token.name }}
                </div>

                <div class="flex items-center ml-2">
                  <div v-if="token.last_used_ago" class="text-sm text-gray-400">
                    Last used {{ token.last_used_ago }}
                  </div>

                  <button
                    v-if="availablePermissions.data.length > 0"
                    class="cursor-pointer ml-6 text-sm text-gray-400 underline"
                    @click="manageApiTokenPermissions(token)"
                  >
                    Permissions
                  </button>

                  <button class="cursor-pointer ml-6 text-sm text-red-500" @click="confirmApiTokenDeletion(token)">
                    Delete
                  </button>
                </div>
              </div>
            </div>
          </template>
        </Box>
      </div>
    </div>

    <!-- API Token Permissions Modal -->
    <DialogModal :show="managingPermissionsFor != null" @close="managingPermissionsFor = null">
      <template #title>
        API Token Permissions
      </template>

      <template #content>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div v-for="permission in availablePermissions.data" :key="permission">
            <label class="flex items-center">
              <FormCheckbox v-model:checked="updateApiTokenForm.permissions" :value="permission.key"/>
              <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                              {{ permission.name }}
                            </span>
            </label>
          </div>
        </div>
      </template>

      <template #footer>
        <Secondary @click="managingPermissionsFor = null">
          Cancel
        </Secondary>

        <FormSubmit
          class="ml-3"
          :class="{ 'opacity-25': updateApiTokenForm.processing }"
          :disabled="updateApiTokenForm.processing"
          @click="updateApiToken"
        >
          Save
        </FormSubmit>
      </template>
    </DialogModal>

    <!-- Delete Token Confirmation Modal -->
    <ConfirmationModal :show="apiTokenBeingDeleted != null" @close="apiTokenBeingDeleted = null">
      <template #title>
        Delete API Token
      </template>

      <template #content>
        Are you sure you would like to delete this API token?
      </template>

      <template #footer>
        <Secondary @click="apiTokenBeingDeleted = null">
          Cancel
        </Secondary>

        <Danger
          class="ml-3"
          :class="{ 'opacity-25': deleteApiTokenForm.processing }"
          :disabled="deleteApiTokenForm.processing"
          @click="deleteApiToken"
        >
          Delete
        </Danger>
      </template>
    </ConfirmationModal>
  </div>
</template>
