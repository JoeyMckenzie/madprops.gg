<script lang="ts" setup>
import ApplicationLogo from "@/components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center bg-muted pt-6 sm:justify-center sm:pt-0"
    >
        <div>
            <Link href="/">
                <ApplicationLogo class="size-20 fill-current text-gray-500" />
            </Link>
        </div>

        <div class="mt-6 w-full overflow-hidden px-6 py-4 sm:max-w-md">
            <slot />
        </div>
    </div>
</template>
