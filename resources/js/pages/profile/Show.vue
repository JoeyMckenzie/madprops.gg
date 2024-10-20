<script lang="ts" setup>
import MadPropsGrid from "@/components/props/MadPropsGrid.vue";
import AuthenticatedLayout from "@/layouts/AuthenticatedLayout.vue";
import ProfileHeader from "@/pages/profile/partials/ProfileHeader.vue";
import { Head } from "@inertiajs/vue3";

defineProps<{
    user: App.Data.UserData;
    madProps: App.Data.MadPropData[];
}>();
</script>

<template>
    <AuthenticatedLayout>
        <Head :title="user.handle" />
        <div class="min-h-screen px-4 py-12 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl">
                <ProfileHeader :user="user" />
                <div class="mt-12 space-y-6">
                    <MadPropsGrid :mad-props="madProps" :user="user" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
