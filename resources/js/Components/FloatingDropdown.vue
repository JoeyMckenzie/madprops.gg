<script lang="ts" setup>
import { Button } from "@/components/ui/button";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import { Icon } from "@iconify/vue";
import { Link } from "@inertiajs/vue3";
import { useColorMode } from "@vueuse/core";

const mode = useColorMode();
</script>

<template>
    <DropdownMenu>
        <DropdownMenuTrigger>
            <Button variant="outline">
                <Icon class="size-5 text-muted-foreground" icon="mdi:user" />
            </Button>
        </DropdownMenuTrigger>
        <DropdownMenuContent align="end">
            <DropdownMenuLabel class="flex flex-row justify-center space-x-1">
                <Button
                    :variant="mode === 'light' ? 'secondary' : 'ghost'"
                    type="button"
                    @click="mode = 'light'"
                >
                    <Icon icon="radix-icons:sun" />
                </Button>
                <Button
                    :variant="mode === 'dark' ? 'secondary' : 'ghost'"
                    type="button"
                    @click="mode = 'dark'"
                >
                    <Icon icon="radix-icons:moon" />
                </Button>
            </DropdownMenuLabel>
            <DropdownMenuSeparator />
            <Link :href="route('profile.edit')" class="w-full">
                <DropdownMenuItem>Profile</DropdownMenuItem>
            </Link>
            <DropdownMenuItem>Settings</DropdownMenuItem>
            <DropdownMenuItem>GitHub</DropdownMenuItem>
            <DropdownMenuSeparator />
            <Link
                :href="route('logout')"
                as="button"
                class="w-full"
                method="post"
            >
                <DropdownMenuItem>Sign out</DropdownMenuItem>
            </Link>
        </DropdownMenuContent>
    </DropdownMenu>
</template>
