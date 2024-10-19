<script lang="ts" setup>
import type { Recommendation } from "@/pages/profile/Show.vue";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { Link } from "@inertiajs/vue3";

defineProps<{
    recommendation: Recommendation;
}>();
</script>

<template>
    <div class="flex flex-row gap-x-2">
        <Avatar class="size-16">
            <AvatarImage :alt="recommendation.username" :src="recommendation.avatar" />
            <AvatarFallback>{{ recommendation.username.charAt(0) }}</AvatarFallback>
        </Avatar>
        <div>
            <p class="font-semibold text-muted-foreground">
                {{ recommendation.fullName }}
            </p>
            <p class="text-sm text-gray-500">
                @
                <Link
                    :href="route('profile.show', {
                        id: recommendation.username,
                    })" class="-ml-1 hover:underline"
                >
                    {{ recommendation.username }}
                </Link>
            </p>
            <p class="mt-1 text-sm text-muted-foreground">
                {{ recommendation.jobTitle }} at {{ recommendation.companyName }}
            </p>
        </div>
    </div>
</template>

<style scoped></style>
