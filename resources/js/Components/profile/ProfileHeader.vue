<script lang="ts" setup>
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { Link } from "@inertiajs/vue3";

defineProps<{
    user: App.ValueObjects.UserProp;
}>();
</script>

<template>
    <div class="text-center">
        <Avatar class="mx-auto size-32">
            <AvatarImage :alt="user.username" :src="user.avatarUrl" />
            <AvatarFallback>{{ user.username.charAt(0) }}</AvatarFallback>
        </Avatar>
        <h2 class="mt-4 text-2xl font-bold text-muted-foreground">
            @
            <Link :href="route('profile.edit')" class="-ml-1.5 hover:underline">
                {{ user.username }}
            </Link>
        </h2>
        <p class="mt-2 text-lg text-muted-foreground">
            {{ user.fullName }}
        </p>
        <p class="text-sm text-muted-foreground">
            {{ user.jobTitle }} at {{ user.company }}
        </p>
    </div>
</template>

<style scoped>

</style>
