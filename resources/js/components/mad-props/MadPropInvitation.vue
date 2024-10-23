<script lang="ts" setup>
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import { Icon } from "@iconify/vue";
import { Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps<{
    user: App.Data.UserData;
}>();

const currentUser = usePage().props.auth?.user;
const currentUserIsViewing = computed(() => !!currentUser && currentUser.username === props.user.username);
</script>

<template>
    <Card v-if="currentUserIsViewing" class="mx-auto max-w-sm">
        <CardHeader class="text-center">
            <CardTitle>
                You don't have props yet.
            </CardTitle>
            <CardDescription>
                Invite a colleague to add one!
            </CardDescription>
        </CardHeader>
        <CardContent>
            <Button class="w-full">
                Invite a friend
                <Icon class="ml-1 size-4" icon="mdi:arrow-right" />
            </Button>
        </CardContent>
    </Card>
    <Card v-else class="mx-auto max-w-sm">
        <CardHeader class="text-center">
            <CardTitle>
                This user doesn't have props.
            </CardTitle>
            <CardDescription>
                Want to give them a shout out?
            </CardDescription>
        </CardHeader>
        <CardContent>
            <Link
                :href="route('mad-props.create', {
                    id: user.username,
                })"
                class="w-full"
            >
                <Button class="w-full">
                    Give props
                    <Icon class="ml-1 size-4" icon="mdi:arrow-right" />
                </Button>
            </Link>
        </CardContent>
    </Card>
</template>
