<script lang="ts" setup>
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { Card, CardContent } from "@/components/ui/card";
import { Separator } from "@/components/ui/separator";
import AuthenticatedLayout from "@/layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
}>();

const user = ref({
    username: "johndoe",
    fullName: "John Doe",
    jobTitle: "Software Developer",
    company: "Meta",
    avatarUrl: "https://avatar.iran.liara.run/public/boy",
});

const recommendations = ref(
    [
        {
            username: "janedoe",
            fullName: "Jane Doe",
            jobTitle: "Software Developer",
            company: "Meta",
            avatarUrl: "https://avatar.iran.liara.run/public/boy",
            message: "Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.",
        },
        {
            username: "janedoe",
            fullName: "Jane Doe",
            jobTitle: "Software Developer",
            company: "Meta",
            avatarUrl: "https://avatar.iran.liara.run/public/boy",
            message: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.",
        },
        {
            username: "janedoe",
            fullName: "Jane Doe",
            jobTitle: "Software Developer",
            company: "Meta",
            avatarUrl: "https://avatar.iran.liara.run/public/boy",
            message: "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).",
        },
    ],
);
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Welcome" />
        <div class="min-h-screen px-4 py-12 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl">
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

                <div class="mt-12 space-y-6">
                    <Card v-for="(recommendation, index) in recommendations" :key="`recommendation-${index}`">
                        <CardContent class="flex flex-col items-start p-6">
                            <div class="flex flex-row gap-x-2">
                                <Avatar class="size-16">
                                    <AvatarImage :alt="recommendation.username" :src="recommendation.avatarUrl" />
                                    <AvatarFallback>{{ recommendation.username.charAt(0) }}</AvatarFallback>
                                </Avatar>
                                <div>
                                    <p class="font-semibold text-muted-foreground">
                                        {{ recommendation.fullName }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        @
                                        <Link :href="route('profile.edit')" class="-ml-1 hover:underline">
                                            {{ recommendation.username }}
                                        </Link>
                                    </p>
                                    <p class="mt-1 text-sm text-muted-foreground">
                                        {{ user.jobTitle }} at {{ user.company }}
                                    </p>
                                </div>
                            </div>
                            <Separator class="my-2" />
                            <p class="mt-2 text-muted-foreground">
                                &quot;{{ recommendation.message }}&quot;
                            </p>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
