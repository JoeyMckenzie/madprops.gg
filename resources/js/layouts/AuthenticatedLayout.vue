<script lang="ts" setup>
import ApplicationLogo from "@/components/ApplicationLogo.vue";
import DropdownMenu from "@/components/DropdownMenu.vue";
import { Button } from "@/components/ui/button";
import { Toaster } from "@/components/ui/toast";
import { Icon } from "@iconify/vue";
import { Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const user = usePage();
const userIsAvailable = computed(() => !!user.props.auth.user);
</script>

<template>
    <div class="bg-background">
        <div class="min-h-screen">
            <nav>
                <!-- Primary Navigation Menu -->
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex shrink-0 items-center">
                                <Link
                                    v-if="userIsAvailable"
                                    :href="route('profile.show', {
                                        id: $page.props.auth.user.username,
                                    })"
                                >
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current"
                                    />
                                </Link>
                                <Link
                                    v-else
                                    :href="route('login')"
                                >
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current"
                                    />
                                </Link>
                            </div>
                        </div>

                        <div class="flex flex-row items-center space-x-1">
                            <Link :href="route('profile.show', { username: $page.props.auth.user.username })">
                                <Button variant="outline">
                                    <Icon class="size-6 text-muted-foreground" icon="mdi:home" />
                                </Button>
                            </Link>
                            <Button variant="outline">
                                <Icon class="size-6 text-muted-foreground" icon="mingcute:notification-fill" />
                            </Button>
                            <DropdownMenu />
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main>
                <slot />
                <Toaster />
            </main>
        </div>
    </div>
</template>
