<script lang="ts" setup>
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { Link } from "@inertiajs/vue3";

defineProps<{
    madProp: App.Data.MadPropData;
}>();
</script>

<template>
    <div class="flex flex-row gap-x-2">
        <Avatar class="size-16">
            <AvatarImage v-if="madProp.author.avatar" :alt="madProp.author.username" :src="madProp.author.avatar" />
            <AvatarFallback>{{ madProp.author.initials }}</AvatarFallback>
        </Avatar>
        <div>
            <p class="font-semibold text-muted-foreground">
                {{ madProp.author.fullName }}
            </p>
            <p class="text-sm text-gray-500">
                @
                <Link
                    :href="route('profile.show', {
                        id: madProp.author.username,
                    })" class="-ml-1 hover:underline"
                >
                    {{ madProp.author.username }}
                </Link>
            </p>
            <p class="mt-1 text-sm text-muted-foreground">
                {{ madProp.author.jobTitle }} at {{ madProp.author.companyName }}
            </p>
        </div>
    </div>
</template>

<style scoped></style>
