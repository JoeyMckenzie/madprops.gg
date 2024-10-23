<script lang="ts" setup>
import InputError from "@/components/InputError.vue";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Textarea } from "@/components/ui/textarea";
import { useToast } from "@/components/ui/toast";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import { computed, watchEffect } from "vue";

defineProps<{
    mustVerifyEmail?: boolean;
    status?: string;
}>();

const BIO_CHARACTER_COUNT = 100;

const user = usePage().props.auth.user;
const { toast } = useToast();

const form = useForm({
    first_name: user.first_name,
    last_name: user.last_name,
    username: user.username,
    email: user.email,
    job_title: user.job_title,
    bio: user.bio,
    company_name: user.company_name,
});

const bioCharacterCount = computed(() => form.bio.length);

watchEffect(() => {
    if (form.recentlySuccessful) {
        toast({
            title: "Success!",
            description: "Your profile information has been updated.",
        });
    }
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
                    Update your account's profile information.
                </CardDescription>
            </CardHeader>
            <CardContent>
                <form
                    id="update-profile-info-form"
                    class="grid gap-4"
                    @submit.prevent="form.patch(route('profile.update'), { preserveScroll: true })"
                >
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-2">
                        <div class="grid gap-2">
                            <Label for="first_name">First name</Label>
                            <Input
                                id="first_name"
                                v-model="form.first_name"
                                autocomplete="first_name"
                                autofocus
                                required
                                type="text"
                            />
                            <InputError :message="form.errors.first_name" />
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
                            <InputError :message="form.errors.last_name" />
                        </div>
                    </div>

                    <div class="grid gap-2">
                        <Label for="username">Username</Label>
                        <Input
                            id="username"
                            v-model="form.username"
                            autocomplete="username"
                            required
                            type="text"
                        />
                        <InputError :message="form.errors.username" />
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
                        <InputError :message="form.errors.email" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="job_title">Job Title</Label>
                        <Input
                            id="job_title"
                            v-model="form.job_title"
                            autocomplete="job-title"
                            required
                            type="text"
                        />
                        <InputError :message="form.errors.job_title" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="company_name">Company</Label>
                        <Input
                            id="company_name"
                            v-model="form.company_name"
                            autocomplete="company-name"
                            required
                            type="text"
                        />
                        <InputError :message="form.errors.job_title" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="bio">Bio</Label>
                        <Textarea
                            id="bio"
                            v-model="form.bio"
                            :maxlength="BIO_CHARACTER_COUNT"
                            autocomplete="biography"
                            required
                            type="text"
                        />
                        <InputError :message="form.errors.bio" />
                        <p
                            :class="{ 'text-red-400': BIO_CHARACTER_COUNT - bioCharacterCount < 10 }"
                            class="text-sm text-muted-foreground"
                        >
                            {{ bioCharacterCount }}/{{ BIO_CHARACTER_COUNT }} characters
                        </p>
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
                </form>
            </CardContent>
            <CardFooter>
                <Button :disabled="form.processing" form="update-profile-info-form" type="submit">
                    Save
                </Button>
            </CardFooter>
        </Card>
    </section>
</template>
