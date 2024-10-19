<script lang="ts" setup>
import InputError from "@/components/InputError.vue";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/components/ui/dialog";
import Input from "@/components/ui/input/Input.vue";
import Label from "@/components/ui/label/Label.vue";
import { useForm } from "@inertiajs/vue3";
import { useFocus } from "@vueuse/core";
import { ref } from "vue";

const confirmingUserDeletion = ref(false);
const passwordInput = ref<HTMLInputElement | null>(null);
const { focused } = useFocus(passwordInput);

const form = useForm({
    password: "",
});

function focusInput() {
    focused.value = true;
}

function deleteUser() {
    form.delete(route("profile.destroy"), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => focusInput(),
        onFinish: () => {
            form.reset();
        },
    });
}

function closeModal() {
    confirmingUserDeletion.value = false;
    form.clearErrors();
    form.reset();
}
</script>

<template>
    <section class="mx-auto space-y-6">
        <Dialog>
            <Card>
                <CardHeader>
                    <CardTitle>
                        Delete Account
                    </CardTitle>
                    <CardDescription>
                        Once your account is deleted, all of its resources and data will
                        be permanently deleted. Before deleting your account, please
                        download any data or information that you wish to retain.
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <DialogTrigger as-child>
                        <Button variant="destructive">
                            Delete Account
                        </Button>
                    </DialogTrigger>
                    <DialogContent class="w-full">
                        <DialogHeader>
                            <DialogTitle>
                                Are you sure you want to delete your account?
                            </DialogTitle>
                            <DialogDescription>
                                Once your account is deleted, all of its resources and data
                                will be permanently deleted. Please enter your password to
                                confirm you would like to permanently delete your account.
                            </DialogDescription>
                        </DialogHeader>
                        <div class="mt-6">
                            <Label
                                class="sr-only"
                                for="password"
                            >Password</Label>

                            <Input
                                id="password"
                                ref="passwordInput"
                                v-model="form.password"
                                placeholder="Password"
                                type="password"
                                @keyup.enter="deleteUser"
                            />

                            <InputError :message="form.errors.password" class="mt-2" />
                        </div>
                        <DialogFooter>
                            <DialogClose as-child>
                                <Button variant="secondary" @click="closeModal">
                                    Cancel
                                </Button>
                            </DialogClose>

                            <Button
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                                class="ms-3"
                                variant="destructive"
                                @click="deleteUser"
                            >
                                Delete Account
                            </Button>
                        </DialogFooter>
                    </DialogContent>
                </CardContent>
            </Card>
        </Dialog>
    </section>
</template>
