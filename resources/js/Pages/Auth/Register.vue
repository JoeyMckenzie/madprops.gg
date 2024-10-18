<script lang="ts" setup>
import InputError from "@/components/InputError.vue";
import Button from "@/components/ui/button/Button.vue";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import Input from "@/components/ui/input/Input.vue";
import Label from "@/components/ui/label/Label.vue";
import GuestLayout from "@/layouts/GuestLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { route } from "ziggy-js";

const form = useForm({
    first_name: "",
    last_name: "",
    username: "",
    email: "",
    password: "",
    password_confirmation: "",
});

function submit() {
    form.post(route("register"), {
        onFinish: () => {
            form.reset("password", "password_confirmation");
        },
    });
}
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <Card class="mx-auto max-w-lg">
                <CardHeader>
                    <CardTitle class="text-2xl">
                        Register
                    </CardTitle>
                    <CardDescription>
                        Enter your name and email below to register for an
                        account
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <div class="grid gap-6">
                        <div class="grid grid-cols-2 gap-2">
                            <div class="grid gap-2">
                                <Label for="first_name">First name</Label>
                                <Input
                                    id="first_name"
                                    v-model="form.first_name"
                                    autocomplete="first_name"
                                    autofocus
                                    placeholder="richard.hendrickson@email.com"
                                    required
                                    type="text"
                                />
                                <InputError
                                    :message="form.errors.first_name"
                                    class="mt-2"
                                />
                            </div>
                            <div class="grid gap-2">
                                <Label for="last_name">Last name</Label>
                                <Input
                                    id="last_name"
                                    v-model="form.last_name"
                                    autocomplete="last_name"
                                    autofocus
                                    required
                                    type="text"
                                />
                                <InputError
                                    :message="form.errors.last_name"
                                    class="mt-2"
                                />
                            </div>
                        </div>
                        <div class="grid gap-2">
                            <Label for="email">Email</Label>
                            <Input
                                id="email"
                                v-model="form.email"
                                autocomplete="username"
                                placeholder="richard.hendrickson@email.com"
                                required
                                type="email"
                            />
                            <InputError
                                :message="form.errors.email"
                                class="mt-2"
                            />
                        </div>
                        <div class="grid gap-2">
                            <Label for="password">Password</Label>
                            <Input
                                id="password"
                                v-model="form.password"
                                autocomplete="new-password"
                                required
                                type="password"
                            />
                            <InputError
                                :message="form.errors.password"
                                class="mt-2"
                            />
                        </div>
                        <div class="grid gap-2">
                            <Label for="password_confirmation">Confirm Password</Label>
                            <Input
                                id="password_confirmation"
                                v-model="form.password_confirmation"
                                autocomplete="new-password"
                                required
                                type="password"
                            />
                            <InputError
                                :message="form.errors.password_confirmation"
                                class="mt-2"
                            />
                        </div>
                        <Button
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            class="w-full"
                            type="submit"
                        >
                            Sign up
                        </Button>
                    </div>
                    <div class="mt-4 text-center text-sm">
                        Have an account?
                        <Link :href="route('login')" class="underline">
                            Sign in
                        </Link>
                    </div>
                </CardContent>
            </Card>
        </form>
    </GuestLayout>
</template>
