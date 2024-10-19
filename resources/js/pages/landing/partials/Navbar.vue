<script setup>
import Button from "@/components/ui/button/Button.vue";
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

const navigation = [
    { name: "Features", href: "#" },
    { name: "FAQ", href: "#" },
    { name: "Pricing", href: "#" },
    { name: "Get started", href: "#" },
];

const mobileMenuOpen = ref(false);
</script>

<template>
    <header class="bg-white">
        <nav aria-label="Global" class="mx-auto flex max-w-7xl items-center justify-between gap-x-6 p-6 lg:px-8">
            <div class="flex lg:flex-1">
                <Link :href="route('home')" class="-m-1.5 p-1.5">
                    <span class="sr-only">Your Company</span>
                    <img
                        alt="" class="h-8 w-auto"
                        src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=600"
                    >
                </Link>
            </div>
            <div class="hidden lg:flex lg:gap-x-12">
                <a
                    v-for="item in navigation" :key="item.name" :href="item.href"
                    class="text-sm font-semibold leading-6 text-gray-900"
                >{{ item.name }}</a>
            </div>
            <div class="flex flex-1 items-center justify-end gap-x-6">
                <Link :href="route('login')">
                    <Button class="hidden lg:block">
                        Log in
                    </Button>
                </Link>
                <Button
                    :href="route('register')"
                    variant="ghost"
                >
                    Sign up
                </Button>
            </div>
            <div class="flex lg:hidden">
                <button
                    class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
                    type="button"
                    @click="mobileMenuOpen = true"
                >
                    <span class="sr-only">Open main menu</span>
                    <Bars3Icon aria-hidden="true" class="size-6" />
                </button>
            </div>
        </nav>
    </header>
</template>
