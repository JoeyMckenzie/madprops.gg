<script lang="ts" setup>
import InputError from "@/components/InputError.vue";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from "@/components/ui/card";
import Input from "@/components/ui/input/Input.vue";
import Label from "@/components/ui/label/Label.vue";
import AuthenticatedLayout from "@/layouts/AuthenticatedLayout.vue";
import ProfileHeader from "@/pages/profile/partials/ProfileHeader.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps<{
    user: App.Data.UserData;
}>();

const form = useForm({
    user: props.user.username,
    worked_with_from: null,
    worked_with_to: null,
    message: null,
});
</script>

<template>
    <AuthenticatedLayout>
        <Head :title="user.handle" />
        <div class="min-h-screen px-4 py-12 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl">
                <ProfileHeader :user="user" />
                <Card class="mx-auto mt-12 max-w-2xl">
                    <CardHeader>
                        <CardTitle>
                            Give some props
                        </CardTitle>
                        <CardDescription>
                            To give {{ user.username }} some props, fill out the form below. If they choose to accept
                            your mad props, it'll be displayed on their profile.
                        </CardDescription>
                    </CardHeader>
                    <CardContent>
                        <form class="grid gap-4" @submit.prevent="form.post(route('mad-props.create'))">
                            <div class="grid gap-2">
                                <Label for="email">When did you work with {{ user.fullName }}?</Label>
                                <Input
                                    id="email"
                                    v-model="form.worked_with_from"
                                    autocomplete="username"
                                    class="mt-1 block w-full"
                                    required
                                    type="email"
                                />
                                <InputError
                                    :message="form.errors.worked_with_from"
                                />
                            </div>
                        </form>
                    </CardContent>
                    <CardFooter>
                        <Button class="w-full" type="submit">
                            Submit
                        </Button>
                    </CardFooter>
                </Card>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
