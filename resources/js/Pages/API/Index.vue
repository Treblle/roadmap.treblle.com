<script setup>
import { Roadmap } from "@/Layouts";
import ApiTokenManager from '@/Pages/API/Partials/ApiTokenManager.vue';

defineProps({
    tokens: Object,
    availablePermissions: Object,
});
</script>

<template>
    <Roadmap title="API Tokens">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                API Tokens
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <ApiTokenManager
                    :tokens="tokens"
                    :available-permissions="availablePermissions"
                />
            </div>
        </div>
    </Roadmap>
</template>
