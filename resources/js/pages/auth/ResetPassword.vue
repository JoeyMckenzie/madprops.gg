<script lang="ts" setup>
import InputError from "@/components/InputError.vue";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import GuestLayout from "@/layouts/GuestLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps<{
    email: string;
    token: string;
}>();

const form = useForm({
    token: props.token,
    email: props.email,
    password: "",
    password_confirmation: "",
});

function submit() {
    form.post(route("password.store"), {
        onFinish: () => {
            form.reset("password", "password_confirmation");
        },
    });
}
</script>

<template>
    <GuestLayout>
        <Head title="Reset Password" />

        <Card>
            <CardHeader>
                <CardTitle>Reset Password</CardTitle>
                <CardDescription>Forgot your password? No problem. Reset it using the form below.</CardDescription>
            </CardHeader>
            <CardContent>
                <form id="reset-password-form" class="grid gap-4" @submit.prevent="submit">
                    <div class="grid gap-2">
                        <Label for="email">Email</Label>
                        <Input
                            id="email"
                            v-model="form.email"
                            autocomplete="username"
                            autofocus
                            required
                            type="email"
                        />
                        <InputError :message="form.errors.email" />
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

                        <InputError :message="form.errors.password" />
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
                        <InputError :message="form.errors.password_confirmation" />
                    </div>
                </form>
            </CardContent>
            <CardFooter>
                <Button
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    form="reset-password-form"
                >
                    Reset Password
                </Button>
            </CardFooter>
        </Card>
    </GuestLayout>
</template>
