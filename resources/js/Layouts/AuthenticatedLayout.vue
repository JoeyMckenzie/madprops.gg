<script lang="ts" setup>
import ApplicationLogo from "@/components/ApplicationLogo.vue";
import FloatingDropdown from "@/components/FloatingDropdown.vue";
import ThemeToggle from "@/components/ThemeToggle.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="dark:bg-black">
        <div class="min-h-screen">
            <nav>
                <!-- Primary Navigation Menu -->
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex shrink-0 items-center">
                                <Link :href="route('dashboard')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current"
                                    />
                                </Link>
                            </div>
                        </div>

                        <div class="hidden sm:ms-6 sm:flex sm:items-center">
                            <!-- Settings Dropdown -->
                            <div class="relative ms-3">
                                <div class="flex flex-row items-center justify-center space-x-2">
                                    <ThemeToggle />
                                    <FloatingDropdown />
                                </div>
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
