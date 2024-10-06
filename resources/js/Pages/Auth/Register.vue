<script lang="ts" setup>
import InputError from "@/components/InputError.vue";
import Button from "@/components/ui/button/Button.vue";
import Input from "@/components/ui/input/Input.vue";
import Label from "@/components/ui/label/Label.vue";
import GuestLayout from "@/layouts/GuestLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import logo from "@svg/logoipsum-332.svg";

const form = useForm({
    first_name: "",
    last_name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

function submit() {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
}
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form
            class="min-h-screen w-full lg:grid lg:grid-cols-2"
            @submit="submit"
        >
            <div class="flex items-center justify-center px-4 py-12 lg:px-0">
                <div class="mx-auto grid w-[350px] gap-6">
                    <img :src="logo" class="mx-auto size-16">

                    <div class="grid gap-2 text-center">
                        <h1 class="text-3xl font-bold">
                            Register
                        </h1>
                        <p class="text-balance text-sm text-muted-foreground">
                            Enter your name and email below to sign up for an
                            account
                        </p>
                    </div>
                    <div class="grid gap-4">
                        <div class="grid grid-cols-2 gap-2">
                            <div class="grid gap-2">
                                <Label for="first_name">First name</Label>
                                <Input
                                    id="first_name"
                                    v-model="form.first_name"
                                    type="text"
                                    placeholder="Richard"
                                    required
                                />
                                <InputError :message="form.errors.first_name" />
                            </div>

                            <div class="grid gap-2">
                                <Label for="last_name">Last name</Label>
                                <Input
                                    id="last_name"
                                    v-model="form.last_name"
                                    type="text"
                                    placeholder="Hendricks"
                                    required
                                />
                                <InputError :message="form.errors.last_name" />
                            </div>
                        </div>

                        <div class="grid gap-2">
                            <Label for="email">Email</Label>
                            <Input
                                id="email"
                                v-model="form.email"
                                type="email"
                                placeholder="richard.hendricks@piedpiper.com"
                                required
                            />
                            <InputError :message="form.errors.email" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="password">Password</Label>
                            <Input
                                id="password"
                                v-model="form.password"
                                type="password"
                                required
                            />
                            <InputError :message="form.errors.password" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="password_confirmation">Confirm password</Label>
                            <Input
                                id="password_confirmation"
                                v-model="form.password_confirmation"
                                type="password"
                                required
                            />
                            <InputError
                                :message="form.errors.password_confirmation"
                            />
                        </div>
                        <Button type="submit" class="w-full">
                            Sign up
                        </Button>
                    </div>
                    <div class="mt-4 text-center text-sm">
                        Have an account?
                        <Link :href="route('login')" class="underline">
                            Sign in
                        </Link>
                    </div>
                </div>
            </div>
            <div class="hidden bg-muted lg:block">
                <img
                    src="https://www.shadcn-vue.com/placeholder.svg"
                    alt="Image"
                    width="1920"
                    height="1080"
                    class="size-full object-cover dark:brightness-[0.2] dark:grayscale"
                >
            </div>
        </form>
    </GuestLayout>
</template>
