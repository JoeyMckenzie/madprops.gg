<script lang="ts" setup>
import InputError from "@/components/InputError.vue";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import GuestLayout from "@/layouts/GuestLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

const form = useForm({
    password: "",
});

function submit() {
    form.post(route("password.confirm"), {
        onFinish: () => {
            form.reset();
        },
    });
}
</script>

<template>
    <GuestLayout>
        <Head title="Confirm Password" />

        <Card>
            <CardHeader>
                <CardTitle>
                    Confirm Password
                </CardTitle>
                <CardDescription>
                    This is a secure area of the application. Please confirm your
                    password before continuing.
                </CardDescription>
            </CardHeader>
            <CardContent>
                <form id="confirm-password-form" @submit.prevent="submit">
                    <div class="grid gap-2">
                        <Label for="password">Password</Label>
                        <Input
                            id="password"
                            v-model="form.password"
                            autocomplete="current-password"
                            autofocus
                            required
                            type="password"
                        />
                        <InputError :message="form.errors.password" />
                    </div>
                </form>
            </CardContent>
            <CardFooter class="flex items-center justify-end">
                <Button
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    form="confirm-password-form"
                >
                    Confirm
                </Button>
            </CardFooter>
        </Card>
    </GuestLayout>
</template>
