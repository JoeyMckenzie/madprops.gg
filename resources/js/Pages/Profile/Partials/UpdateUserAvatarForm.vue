<script lang="ts" setup>
import InputError from "@/components/InputError.vue";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import Input from "@/components/ui/input/Input.vue";
import Label from "@/components/ui/label/Label.vue";
import { Icon } from "@iconify/vue";
import { useForm, usePage } from "@inertiajs/vue3";

defineProps<{
    mustVerifyEmail?: boolean;
    status?: string;
}>();

const user = usePage().props.auth.user;

const form = useForm({
    avatar: user.avatar,
});
</script>

<template>
    <section class="mx-auto">
        <Card class="flex flex-row justify-between">
            <CardHeader>
                <CardTitle>
                    Profile Image
                </CardTitle>
                <CardDescription>
                    Update your avatar to display to other users.
                </CardDescription>
                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-muted-foreground"
                    >
                        Saved.
                    </p>
                </Transition>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="form.patch(route('profile.update'))">
                    <div class="relative mt-4 inline-flex">
                        <Avatar class="size-24 cursor-pointer">
                            <AvatarImage :alt="user.username" :src="user.avatar" />
                            <AvatarFallback>User</AvatarFallback>
                        </Avatar>
                        <Label
                            class="absolute bottom-0 right-0 cursor-pointer rounded-full bg-muted p-1 shadow-md hover:text-muted-foreground"
                            for="avatar"
                        >
                            <Icon :size="16" icon="mdi:camera" />
                        </Label>
                        <Input
                            id="avatar"
                            accept="image/*"
                            class="hidden"
                            type="file"
                        />
                        <InputError :message="form.errors.avatar" />
                    </div>
                </form>
            </CardContent>
        </Card>
    </section>
</template>
