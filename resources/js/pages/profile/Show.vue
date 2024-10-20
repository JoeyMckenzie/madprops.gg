<script lang="ts" setup>
import PropCardBoard from "@/components/props/PropCardBoard.vue";
import AuthenticatedLayout from "@/layouts/AuthenticatedLayout.vue";
import ProfileHeader from "@/pages/profile/partials/ProfileHeader.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps<{
    user: App.Data.UserData;
}>();

export type Recommendation = App.Data.UserData & { message: string };

const recommendations = ref<Recommendation[]>(
    [
        {
            username: "janedoe",
            handle: "@janedoe",
            bio: "asdfasdfasf",
            initials: "JD",
            fullName: "Jane Doe",
            jobTitle: "Software Developer",
            companyName: "Meta",
            avatar: "https://avatar.iran.liara.run/public/boy",
            message: "Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.",
        },
        {
            username: "janedoe",
            handle: "@janedoe",
            bio: "asdfasdfasf",
            initials: "JD",
            fullName: "Jane Doe",
            jobTitle: "Software Developer",
            companyName: "Meta",
            avatar: "https://avatar.iran.liara.run/public/boy",
            message: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.",
        },
        {
            username: "janedoe",
            handle: "@janedoe",
            bio: "asdfasdfasf",
            initials: "JD",
            fullName: "Jane Doe",
            jobTitle: "Software Developer",
            companyName: "Meta",
            avatar: "https://avatar.iran.liara.run/public/boy",
            message: "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).",
        },
    ],
);
</script>

<template>
    <AuthenticatedLayout>
        <Head :title="user.handle" />
        <div class="min-h-screen px-4 py-12 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl">
                <ProfileHeader :user="user" />
                <div class="mt-12 space-y-6">
                    <PropCardBoard :recommendations="recommendations" :user="user" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
