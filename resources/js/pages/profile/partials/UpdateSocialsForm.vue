<script lang="ts" setup>
import InputError from "@/components/InputError.vue";
import PinkaryIcon from "@/components/PinkaryIcon.vue";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Switch } from "@/components/ui/switch";
import { useToast } from "@/components/ui/toast";
import { Icon } from "@iconify/vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { ref, watchEffect } from "vue";

const user = usePage().props.auth.user;
const displaySocials = ref(user.display_socials);
const { toast } = useToast();

const form = useForm({
    display_socials: user.display_socials,
    x_username: user.x_username,
    linkedin_username: user.linkedin_username,
    github_username: user.github_username,
    pinkary_username: user.pinkary_username,
});

function toggleDisplaySocialsFlag() {
    displaySocials.value = !displaySocials.value;
    form.display_socials = displaySocials.value;
    form.patch(route("profile.socials.update"), { preserveScroll: true });
}

watchEffect(() => {
    if (form.recentlySuccessful) {
        toast({
            title: "Success!",
            description: "Your socials has been updated.",
        });
    }
});
</script>

<template>
    <section class="mx-auto">
        <Card>
            <CardHeader class="flex flex-row items-end justify-between">
                <div class="grid gap-2">
                    <CardTitle>
                        Socials
                    </CardTitle>
                    <CardDescription>
                        Link your socials for display.
                    </CardDescription>
                </div>
                <div class="flex items-center space-x-2">
                    <Label class="hidden sm:block" for="display_socials">Display socials</Label>
                    <Switch
                        id="display_socials"
                        :aria-disabled="form.processing"
                        :checked="displaySocials"
                        :default-checked="form.display_socials"
                        :disabled="form.processing"
                        @update:checked="toggleDisplaySocialsFlag"
                    />
                </div>
            </CardHeader>
            <CardContent class="grid gap-4">
                <form
                    class="grid gap-6"
                    @submit.prevent="form.patch(route('profile.socials.update'), { preserveScroll: true })"
                >
                    <div class="grid gap-2">
                        <div class="relative items-center">
                            <Input
                                id="x_username"
                                v-model="form.x_username"
                                :aria-disabled="!form.display_socials"
                                :disabled="!form.display_socials"
                                autocomplete="x_username"
                                autofocus
                                class="w-full pl-10"
                                placeholder="Enter your X handle"
                                type="text"
                            />
                            <span class="absolute inset-y-0 start-0 flex items-center justify-center px-2">
                                <Icon class="text-muted-foreground" icon="prime:twitter" />
                            </span>
                        </div>
                        <InputError :message="form.errors.x_username" />
                    </div>

                    <div class="grid gap-2">
                        <div class="relative items-center">
                            <Input
                                id="linkedin_username"
                                v-model="form.linkedin_username"
                                :aria-disabled="!form.display_socials"
                                :disabled="!form.display_socials"
                                autocomplete="linkedin_username"
                                autofocus
                                class="w-full pl-10"
                                placeholder="Enter your LinkedIn username"
                                type="text"
                            />
                            <span class="absolute inset-y-0 start-0 flex items-center justify-center px-2">
                                <Icon class="size-5 text-muted-foreground" icon="mdi:linkedin" />
                            </span>
                        </div>
                        <InputError :message="form.errors.linkedin_username" />
                    </div>

                    <div class="grid gap-2">
                        <div class="relative items-center">
                            <Input
                                id="github_username"
                                v-model="form.github_username"
                                :aria-disabled="!form.display_socials"
                                :disabled="!form.display_socials"
                                autocomplete="github_username"
                                autofocus
                                class="w-full pl-10"
                                placeholder="Enter your GitHub username"
                                type="text"
                            />
                            <span class="absolute inset-y-0 start-0 flex items-center justify-center px-2">
                                <Icon class="size-5 text-muted-foreground" icon="mdi:github" />
                            </span>
                        </div>
                        <InputError :message="form.errors.github_username" />
                    </div>

                    <div class="grid gap-2">
                        <div class="relative items-center">
                            <Input
                                id="pinkary_username"
                                v-model="form.pinkary_username"
                                :aria-disabled="!form.display_socials"
                                :disabled="!form.display_socials"
                                autocomplete="pinkary_username"
                                autofocus
                                class="w-full pl-10"
                                placeholder="Enter your Pinkary handle"
                                type="text"
                            />
                            <span class="absolute inset-y-0 start-0 flex items-center justify-center px-2">
                                <PinkaryIcon />
                            </span>
                        </div>
                        <InputError :message="form.errors.github_username" />
                    </div>

                    <div class="flex items-center gap-4">
                        <Button :disabled="form.processing">
                            Save
                        </Button>
                    </div>
                </form>
            </CardContent>
        </Card>
    </section>
</template>
