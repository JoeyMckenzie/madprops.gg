<script lang="ts" setup>
import { Button } from "@/components/ui/button";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import { Icon } from "@iconify/vue";
import { useColorMode } from "@vueuse/core";

const mode = useColorMode({
    disableTransition: false,
});
</script>

<template>
    <DropdownMenu>
        <DropdownMenuTrigger as-child>
            <Button variant="outline">
                <Icon
                    class="size-[1.2rem] rotate-0 scale-100 text-muted-foreground transition-all dark:-rotate-90 dark:scale-0"
                    icon="radix-icons:moon"
                />
                <Icon
                    class="absolute size-[1.2rem] rotate-90 scale-0 text-muted-foreground transition-all dark:rotate-0 dark:scale-100"
                    icon="radix-icons:sun"
                />
                <span class="sr-only">Toggle theme</span>
            </Button>
        </DropdownMenuTrigger>
        <DropdownMenuContent align="end">
            <DropdownMenuItem @click="mode = 'light'">
                Light
            </DropdownMenuItem>
            <DropdownMenuItem @click="mode = 'dark'">
                Dark
            </DropdownMenuItem>
            <DropdownMenuItem class="flex items-center justify-between" @click="mode = 'auto'">
                System
                <Icon class="ml-2 size-6" icon="lsicon:computer-outline" />
            </DropdownMenuItem>
        </DropdownMenuContent>
    </DropdownMenu>
</template>
