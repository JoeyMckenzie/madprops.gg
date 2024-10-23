<script lang="ts" setup>
import AuthenticatedLayout from "@/layouts/AuthenticatedLayout.vue";
import CreateMadPropForm from "@/pages/mad-props/partials/CreateMadPropForm.vue";
import ProfileHeader from "@/pages/profile/partials/ProfileHeader.vue";
import { Head } from "@inertiajs/vue3";

defineProps<{
    user: App.Data.UserData;
}>();
</script>

<template>
    <AuthenticatedLayout>
        <Head :title="user.handle" />
        <div class="min-h-screen px-4 py-12 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl">
                <ProfileHeader :user="user" />
                <CreateMadPropForm :user="user" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
