<script lang="ts" setup>
import InputError from "@/components/InputError.vue";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const passwordInput = ref<HTMLInputElement | null>(null);
const currentPasswordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
    current_password: "",
    password: "",
    password_confirmation: "",
});

function updatePassword() {
    form.put(route("password.update"), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
        onError: () => {
            if (form.errors.password) {
                form.reset("password", "password_confirmation");
                passwordInput.value?.focus();
            }
            if (form.errors.current_password) {
                form.reset("current_password");
                currentPasswordInput.value?.focus();
            }
        },
    });
}
</script>

<template>
    <section class="mx-auto">
        <header>
            <Card>
                <CardHeader>
                    <CardTitle>
                        Update Password
                    </CardTitle>
                    <CardDescription>
                        Ensure your account is using a long, random password to stay
                        secure.
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <form class="mt-6 space-y-6" @submit.prevent="updatePassword">
                        <div class="grid gap-2">
                            <Label for="current_password">Current Password</Label>

                            <Input
                                id="current_password"
                                ref="currentPasswordInput"
                                v-model="form.current_password"
                                autocomplete="current-password"
                                type="password"
                            />

                            <InputError
                                :message="form.errors.current_password"
                                class="mt-2"
                            />
                        </div>

                        <div class="grid gap-2">
                            <Label for="password">New Password</Label>

                            <Input
                                id="password"
                                ref="passwordInput"
                                v-model="form.password"
                                autocomplete="new-password"
                                type="password"
                            />

                            <InputError :message="form.errors.password" class="mt-2" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="password_confirmation">Confirm Password</Label>

                            <Input
                                id="password_confirmation"
                                v-model="form.password_confirmation"
                                autocomplete="new-password"
                                type="password"
                            />

                            <InputError
                                :message="form.errors.password_confirmation"
                                class="mt-2"
                            />
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
                                    class="text-sm"
                                >
                                    Saved.
                                </p>
                            </Transition>
                        </div>
                    </form>
                </CardContent>
            </Card>
        </header>
    </section>
</template>
