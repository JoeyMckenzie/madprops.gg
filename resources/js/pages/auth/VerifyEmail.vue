<script lang="ts" setup>
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardDescription, CardHeader } from "@/components/ui/card";
import GuestLayout from "@/layouts/GuestLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps<{
    status?: string;
}>();

const form = useForm({});

function submit() {
    form.post(route("verification.send"));
}

const verificationLinkSent = computed(
    () => props.status === "verification-link-sent",
);
</script>

<template>
    <GuestLayout>
        <Head title="Email Verification" />

        <Card>
            <CardHeader>
                <CardDescription>
                    Thanks for signing up! Before getting started, could you verify your
                    email address by clicking on the link we just emailed to you? If you
                    didn't receive the email, we will gladly send you another.
                </CardDescription>
            </CardHeader>
            <CardContent class="grid gap-2">
                <div
                    v-if="verificationLinkSent"
                    class="mb-4 text-sm font-medium text-green-600 dark:text-green-400"
                >
                    A new verification link has been sent to the email address you
                    provided during registration.
                </div>
                <form @submit.prevent="submit">
                    <div class="mt-4 flex items-center justify-between">
                        <Button
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            variant="outline"
                        >
                            Resend Verification Email
                        </Button>
                        <Link
                            :href="route('logout')"
                            as="button"
                            method="post"
                        >
                            <Button variant="ghost">
                                Log Out
                            </Button>
                        </Link>
                    </div>
                </form>
            </CardContent>
        </Card>
    </GuestLayout>
</template>
