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
            <DropdownMenuLabel class="space-x-1">
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
                <Button
                    :variant="mode === 'auto' ? 'secondary' : 'ghost'"
                    type="button"
                    @click="mode = 'auto'"
                >
                    <Icon icon="solar:laptop-broken" />
                </Button>
            </DropdownMenuLabel>
            <DropdownMenuSeparator />
            <DropdownMenuItem>Profile</DropdownMenuItem>
            <DropdownMenuItem>Billing</DropdownMenuItem>
            <DropdownMenuItem>Team</DropdownMenuItem>
            <DropdownMenuItem>Subscription</DropdownMenuItem>
        </DropdownMenuContent>
    </DropdownMenu>
</template>
