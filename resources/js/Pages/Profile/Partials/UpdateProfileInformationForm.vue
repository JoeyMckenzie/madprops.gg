<script lang="ts" setup>
import InputError from "@/components/InputError.vue";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Link, useForm, usePage } from "@inertiajs/vue3";

defineProps<{
    mustVerifyEmail?: boolean;
    status?: string;
}>();

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <section class="mx-auto">
        <Card>
            <CardHeader>
                <CardTitle>
                    Profile Information
                </CardTitle>
                <CardDescription>
                    Update your account's profile information and email address.
                </CardDescription>
            </CardHeader>
            <CardContent>
                <form
                    class="grid gap-6"
                    @submit.prevent="form.patch(route('profile.update'))"
                >
                    <div class="grid gap-2">
                        <Label for="name">Name</Label>
                        <Input
                            id="name"
                            v-model="form.name"
                            autocomplete="name"
                            autofocus
                            required
                            type="text"
                        />
                        <InputError :message="form.errors.name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="email">Email</Label>
                        <Input
                            id="email"
                            v-model="form.email"
                            autocomplete="username"
                            required
                            type="email"
                        />
                        <InputError :message="form.errors.email" class="mt-2" />
                    </div>

                    <div v-if="mustVerifyEmail && !user.email_verified_at">
                        <p class="mt-2 text-sm text-muted-foreground">
                            Your email address is unverified.
                            <Link
                                :href="route('verification.send')"
                                as="button"
                                class="rounded-md text-sm underline focus:outline-none focus:ring-2 focus:ring-offset-2"
                                method="post"
                            >
                                Click here to re-send the verification email.
                            </Link>
                        </p>

                        <div v-show="status === 'verification-link-sent'" class="mt-2 text-sm font-medium text-primary">
                            A new verification link has been sent to your email address.
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <Button :disabled="form.processing">
                            Save
                        </Button>

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
                    </div>
                </form>
            </CardContent>
        </Card>
    </section>
</template>
