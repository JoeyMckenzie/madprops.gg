<script lang="ts" setup>
import AuthenticatedLayout from "@/layouts/AuthenticatedLayout.vue";
import UpdateSocialsForm from "@/pages/profile/partials/UpdateSocialsForm.vue";
import UpdateUserAvatarForm from "@/pages/profile/partials/UpdateUserAvatarForm.vue";
import { Head } from "@inertiajs/vue3";
import DeleteUserForm from "./partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./partials/UpdateProfileInformationForm.vue";

defineProps<{
    mustVerifyEmail?: boolean;
    status?: string;
}>();
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
                <UpdateUserAvatarForm class="max-w-xl" />
                <UpdateProfileInformationForm
                    :must-verify-email="mustVerifyEmail"
                    :status="status"
                    class="max-w-xl"
                />
                <UpdatePasswordForm class="max-w-xl" />
                <UpdateSocialsForm class="max-w-xl" />
                <DeleteUserForm class="max-w-xl" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
