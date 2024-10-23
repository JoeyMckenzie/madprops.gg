<script lang="ts" setup>
import InputError from "@/components/InputError.vue";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import Label from "@/components/ui/label/Label.vue";
import { useToast } from "@/components/ui/toast";
import { Icon } from "@iconify/vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";

const user = usePage().props.auth.user;
const photoInputRef = ref<HTMLInputElement | null>(null);
const { toast } = useToast();

const form = useForm({
    avatar: user.avatar,
});

function uploadAvatar(event: Event) {
    const fileEvent = event as Event & { target: HTMLInputElement };
    if (fileEvent?.target?.files?.[0]) {
        form.avatar = fileEvent.target.files[0];
        form.post(route("profile.avatar"), {
            onFinish: () => {
                toast({
                    title: "Success!",
                    description: "Your avatar has been updated.",
                });
            },
        });
    }
}

function clickAvatarInput() {
    if (photoInputRef?.value) {
        photoInputRef.value.click();
    }
}
</script>

<template>
    <section class="mx-auto">
        <Card class="flex flex-row justify-between">
            <CardHeader>
                <CardTitle>
                    Profile Image
                </CardTitle>
                <CardDescription>
                    Update your avatar as a JPG or PNG. 1MB max.
                </CardDescription>
                <InputError :message="form.errors.avatar" />
            </CardHeader>
            <CardContent>
                <div class="group relative mt-4 inline-flex">
                    <Avatar class="size-24 cursor-pointer" @click="clickAvatarInput">
                        <AvatarImage :alt="$page.props.auth.user.username" :src="$page.props.auth.user.avatar" />
                        <AvatarFallback>User</AvatarFallback>
                    </Avatar>
                    <Label
                        class="absolute bottom-0 right-0 cursor-pointer rounded-full bg-muted p-1 shadow-md group-hover:text-muted-foreground"
                        for="avatar"
                    >
                        <Icon :size="16" icon="mdi:camera" />
                    </Label>
                    <input
                        id="avatar"
                        ref="photoInputRef"
                        accept="image/*"
                        class="hidden"
                        name="profile photo"
                        type="file"
                        @input="uploadAvatar($event)"
                    >
                </div>
            </CardContent>
        </Card>
    </section>
</template>
