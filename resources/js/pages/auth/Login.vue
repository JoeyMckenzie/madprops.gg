<script lang="ts" setup>
import InputError from "@/components/InputError.vue";
import Button from "@/components/ui/button/Button.vue";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import Checkbox from "@/components/ui/checkbox/Checkbox.vue";
import Input from "@/components/ui/input/Input.vue";
import Label from "@/components/ui/label/Label.vue";
import GuestLayout from "@/layouts/GuestLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { route } from "ziggy-js";

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

function submit() {
    form.post(route("login"), {
        onFinish: () => {
            form.reset("password");
        },
    });
}
</script>

<template>
    <GuestLayout>
        <Head title="Sign in" />

        <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <Card class="mx-auto max-w-md">
                <CardHeader>
                    <CardTitle class="text-2xl">
                        Login
                    </CardTitle>
                    <CardDescription>
                        Enter your email below to login to your account
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <div class="grid gap-4">
                        <div class="grid gap-2">
                            <Label for="email">Email</Label>
                            <Input
                                id="email"
                                v-model="form.email"
                                autocomplete="username"
                                class="mt-1 block w-full"
                                required
                                type="email"
                            />
                            <InputError
                                :message="form.errors.email"
                            />
                        </div>
                        <div class="grid gap-2">
                            <div class="flex items-center">
                                <Label for="password">Password</Label>
                                <Link
                                    v-if="canResetPassword"
                                    :href="route('password.request')"
                                    class="ml-auto inline-block text-sm underline"
                                >
                                    Forgot your password?
                                </Link>
                            </div>
                            <Input
                                id="password"
                                v-model="form.password"
                                autocomplete="new-password"
                                class="mt-1 block w-full"
                                required
                                type="password"
                            />
                            <InputError
                                :message="form.errors.password"
                            />
                        </div>
                        <div class="flex flex-row justify-between text-sm">
                            <Label class="flex items-center justify-between">
                                <Checkbox
                                    v-model:checked="form.remember"
                                    name="remember"
                                />
                                <span class="ms-2 text-sm">Remember me</span>
                            </Label>
                        </div>
                        <Button
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            class="w-full"
                            type="submit"
                        >
                            Sign in
                        </Button>
                    </div>
                    <div class="mt-4 text-center text-sm">
                        Don't have an account?
                        <Link :href="route('register')" class="underline">
                            Sign up
                        </Link>
                    </div>
                </CardContent>
            </Card>
        </form>
    </GuestLayout>
</template>
