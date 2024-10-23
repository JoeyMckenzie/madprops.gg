<script lang="ts" setup>
import PinkaryIcon from "@/components/PinkaryIcon.vue";
import { Icon } from "@iconify/vue";

defineProps<{
    user: App.Data.UserData;
}>();
</script>

<template>
    <div class="flex flex-row items-center justify-center space-x-2">
        <a
            v-if="user.xUsername"
            :href="`https://x.com/${user.xUsername}`"
            class="transition duration-150 ease-in-out hover:scale-110"
        >
            <Icon class="size-4 text-muted-foreground" icon="prime:twitter" />
        </a>

        <a
            v-if="user.linkedinUsername"
            :href="`https://linkedin.com/in/${user.linkedinUsername}`"
            class="transition duration-150 ease-in-out hover:scale-110"
        >
            <Icon class="size-6 text-muted-foreground" icon="prime:linkedin" />
        </a>

        <a
            v-if="user.githubUsername"
            :href="`https://github.com/${user.githubUsername}`"
            class="transition duration-150 ease-in-out hover:scale-110"
        >
            <Icon class="size-6 text-muted-foreground" icon="prime:github" />
        </a>

        <a
            v-if="user.pinkaryUsername"
            :href="`https://pinkary.com/@${user.pinkaryUsername}`"
            class="transition duration-150 ease-in-out hover:scale-110"
        >
            <PinkaryIcon />
        </a>
    </div>
</template>
