<script lang="ts" setup>
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import ProfileSocials from "@/pages/profile/partials/ProfileSocials.vue";
import { Link } from "@inertiajs/vue3";

defineProps<{
    user: App.Data.UserData;
}>();
</script>

<template>
    <div class="text-center">
        <Avatar class="mx-auto size-32">
            <AvatarImage v-if="user.avatar" :alt="user.username" :src="user.avatar" />
            <AvatarFallback>{{ user.initials }}</AvatarFallback>
        </Avatar>
        <h2 class="mt-4 text-2xl font-bold">
            @
            <Link
                :href="route('profile.show', {
                    id: user.username,
                })" class="-ml-1.5 hover:underline"
            >
                {{ user.username }}
            </Link>
        </h2>
        <p class="mt-2 text-lg text-muted-foreground">
            {{ user.fullName }}
        </p>
        <p class="text-sm text-muted-foreground">
            {{ user.jobTitle }} at {{ user.companyName }}
        </p>
        <div v-if="user.displaySocials" class="mt-4 flex flex-row justify-center">
            <ProfileSocials :user="user" />
        </div>
        <p class="mt-2 text-lg text-muted-foreground">
            {{ user.bio }}
        </p>
    </div>
</template>

<style scoped>

</style>
