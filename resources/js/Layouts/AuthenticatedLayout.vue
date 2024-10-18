<script lang="ts" setup>
import ApplicationLogo from "@/components/ApplicationLogo.vue";
import DropdownMenu from "@/components/DropdownMenu.vue";
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

                        <div class="ms-6 flex items-center">
                            <!-- Settings Dropdown -->
                            <div class="relative ms-3">
                                <DropdownMenu />
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
