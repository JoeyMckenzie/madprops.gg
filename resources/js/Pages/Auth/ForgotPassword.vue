<script lang="ts" setup>
import InputError from "@/components/InputError.vue";
import InputLabel from "@/components/InputLabel.vue";
import PrimaryButton from "@/components/PrimaryButton.vue";
import TextInput from "@/components/TextInput.vue";
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from "@/components/ui/card";
import GuestLayout from "@/layouts/GuestLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

defineProps<{
    status?: string;
}>();

const form = useForm({
    email: "",
});

function submit() {
    form.post(route("password.email"));
}
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            Forgot your password? No problem. Just let us know your email
            address and we will email you a password reset link that will allow
            you to choose a new one.
        </div>

        <div
            v-if="status"
            class="mb-4 text-sm font-medium text-green-600 dark:text-green-400"
        >
            {{ status }}
        </div>

        <Card class="w-full max-w-sm">
            <CardHeader>
                <CardTitle class="text-2xl">
                    Login
                </CardTitle>
                <CardDescription>
                    Enter your email below to login to your account.
                </CardDescription>
            </CardHeader>
            <CardContent>
                <form class="grid gap-4" @submit.prevent="submit">
                    <div>
                        <InputLabel for="email" value="Email" />

                        <TextInput
                            id="email"
                            v-model="form.email"
                            autocomplete="username"
                            autofocus
                            class="mt-1 block w-full"
                            required
                            type="email"
                        />

                        <InputError :message="form.errors.email" class="mt-2" />
                    </div>

                    <div class="mt-4 flex items-center justify-end">
                        <PrimaryButton
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Email Password Reset Link
                        </PrimaryButton>
                    </div>
                </form>
            </CardContent>
            <CardFooter>
                <Button class="w-full">
                    Sign in
                </Button>
            </CardFooter>
        </Card>
    </GuestLayout>
</template>
