<script lang="ts" setup>
import Button from "@/components/ui/button/Button.vue";
import Input from "@/components/ui/input/Input.vue";
import Label from "@/components/ui/label/Label.vue";
import GuestLayout from "@/layouts/GuestLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

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
        onFinish: () => form.reset("password"),
    });
}
</script>

<template>
    <GuestLayout>
        <Head title="Login" />

        <form
            class="min-h-screen w-full lg:grid lg:grid-cols-2"
            @submit="submit"
        >
            <div class="flex items-center justify-center px-4 py-12 lg:px-0">
                <div class="mx-auto grid w-[350px] gap-6">
                    <img alt="app logo" class="mx-auto size-16" src="/svg/logoipsum-332.svg">

                    <div class="grid gap-2 text-center">
                        <h1 class="text-3xl font-bold">
                            Login
                        </h1>
                        <p class="text-balance text-muted-foreground">
                            Enter your email below to login to your account
                        </p>
                    </div>
                    <div class="grid gap-4">
                        <div class="grid gap-2">
                            <Label for="email">Email</Label>
                            <Input
                                id="email"
                                placeholder="m@example.com"
                                required
                                type="email"
                            />
                        </div>
                        <div class="grid gap-2">
                            <div class="flex items-center">
                                <Label for="password">Password</Label>
                                <a
                                    class="ml-auto inline-block text-sm underline"
                                    href="/forgot-password"
                                >
                                    Forgot your password?
                                </a>
                            </div>
                            <Input id="password" required type="password" />
                        </div>
                        <Button class="w-full" type="submit">
                            Login
                        </Button>
                        <Button class="w-full" variant="outline">
                            Login with Google
                        </Button>
                    </div>
                    <div class="mt-4 text-center text-sm">
                        Don't have an account?
                        <Link :href="route('register')" class="underline">
                            Sign up
                        </Link>
                    </div>
                </div>
            </div>
            <div class="hidden bg-muted lg:block">
                <img
                    alt="Image"
                    class="size-full object-cover dark:brightness-[0.2] dark:grayscale"
                    height="1080"
                    src="https://www.shadcn-vue.com/placeholder.svg"
                    width="1920"
                >
            </div>
        </form>
    </GuestLayout>
</template>
